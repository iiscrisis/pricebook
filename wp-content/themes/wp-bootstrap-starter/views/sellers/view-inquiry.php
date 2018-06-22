<?php


//print_m($post->post_author;
$currentBlacklist = get_field('user_blacklist','user_'.$post->post_author,false);
if (!is_array($currentBlacklist)) { $currentBlacklist = (array)$currentBlacklist; }
if(in_array(get_current_user_id(),$currentBlacklist))
{
  ?>

  <div id="message_wrapper">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="blue text-center">Το αίτημα δεν είναι πλέον διαθέσιμο για προσφορά</h2>
          <p class="text-center">
            <a class="red bold " href="<?php echo get_site_url(); ?>/home-seller/?inquiries=active">επιστροφή στα Ανοικτά Αιτήματα</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <?php

return 0;
}


$offer = getOffer($post->ID,get_current_user_id());

//var_dump($offer);
if (!empty($offer['pending'][0])) {
  //  $offer = $offer['pending'][0];


}
$messages = getInquiryConversation($post->ID,$post->post_author);

$seller_custom_message = @get_field('seller_custom_message',"user_".get_current_user_id());

$offers =  get_field("inquiry_offers",$post);
//var_dump($offers);
$count = 0;
if($offers)
{
  foreach ($offers as $offer_n) {
    $count++;
    if ($offer_n['inquiry_seller']['ID'] == get_current_user_id()) {
      $counter = 1;
      if($offer_n['inquiry_seller_lastmessage'] != "")
      {
        $counter = 1 + count($messages['messages']);// getInquiryConversation($post,get_post($post)->post_author);
      }

      update_sub_field(array('field_598537c81b335',$count,'field_5a60c8a8e7c30'),$counter, $post);
    }
  }
}





$catId =  get_field('inquiry_product_category',$post->ID);
$parentId = getParentId(get_post($catId[0]));
$isService = false;
$isProduct = false;
$isHotel = false;
//echo SERVICE;
//echo "CAT $parentId > ".$catId[0] ;

switch($parentId)
{
  case PRODUCT:
  $isProduct =true;
  //echo "PRODUCT";
  break;

  case HOTEL:
  $isHotel =true;
  //echo "HOTEL";
  break;

  case SERVICE :
  $isService = true;
  //echo "SERVICE";
  break;

  default:
  echo "Error";
  wp_die();
}


$status = get_field('inquiry_status',$post->ID);
//echo "20 Status $status";
//echo '<h1>'.get_field('inquiry_status',$post->ID).'</h1>';
/*if ($status == 'complete') {
  $mine = getOffer($post->ID,get_current_user_id());
  foreach ($mine as $theOffer) {
    if (intval($theOffer[0]['inquiry_seller']['ID']) == intval(get_current_user_id())) {
      $offer = $theOffer[0];

      break;
    }
  }
}*/

?>


<div class="hidden-lg">
    <?php include('seller_buyer_actions.php');?>
</div>

<div id="application_summary" class="white2-bg col-xs-12 col-md-12 col-lg-3 text-center _fullheight _hidden-xs _hidden-sm _hidden-md ">

  <div class="offer-section-title blue-bg white bold newapplication_headtitle text-left">
    <?php echo $post->post_title;?> <small class="light">( ref : <?php echo $post->ID;?> )</small>
    <div class="application-details-toggle text-right">

    </div>
  </div>
<div class="hidden-xs hidden-sm hidden-md">
    <?php include('seller_buyer_actions.php');?>
</div>





  <div class="application-summary-transform _toggle-summary">

    <div class="application-summary-shape blue inquiry_summary" id="seller_view">
      <?php the_content(); ?>
    </div>

  </div>








</div>


<div class="col-xs-12 col-md-8 col-lg-6 left-new-application-col  " id="comments_area">
  <div class='new-application-main-transform'>

    <div class='new-application-main-shape'>


      <div class="offer-section-title grey bold newapplication_headtitle white4-bg">
        <i class="material-icons md-24 black">chat_bubble_outline</i> Μηνύματα <i class="material-icons md-24 greyhidden-md hidden-lg middle inline-block arrow_transform">keyboard_arrow_down</i>
        <div class="application-details-toggle text-right">

        </div>
      </div>

      <!-- Enter chat -->

      <div id='offer-chat-main'>

        <div class="chat-text-box-transform">
          <div class="chat-text-box-shape">
            <!-- Add Text Area Here ... -->
          </div>
        </div>

        <div class="chat-main-area-transform">
          <div class="chat-main-area-shape">
            <div class="clearer">
            </div>

            <div class="clearer">
            </div>

            <?php

            //IF THERE'S AN INITIAL MESSAGE FROM A SELLER SHOW IT AND CHECK FOR CHATS
            $msgs_array = array();


            if (!empty($messages['thread'])) {
              //  echo '<h1> a:'.empty($messages['thread']).'</h1>';

              $classSeller="client left ";
              if (!is_buyer(intval( $messages['thread']->user_id)))
              {
                $classSeller="seller right ";
              }

              $msgs_array[$messages['thread']->comment_date] = array('classSeller'=>$classSeller,'message'=>$messages['thread']);
              //  print_m(  $msgs_array[$messages['thread']->comment_date]['message']->comment_content);
              //    include(dirname(__FILE__).'/../buyers/single-thread.php');
            } ?>
            <?php
            //IF THERE ARE RESPONSES SHOW THEM INCLUDING REPLY FORM
            //  echo '<h1> b:'.empty($messages['messages']).'</h1>';
            if (!empty($messages['messages'])) {
              //  echo '<h1>'.empty($messages['messages']).'</h1>';
              //      print_m("273");
              $i=0;
              $length = count($messages['messages']);

              foreach ($messages['messages'] as $message) {

                if (is_buyer(intval($message->user_id))) {
                  $classSeller="buyer left ";
                  $msgs_array[$message->comment_date] = array('classSeller'=>$classSeller,'message'=>$message);
                }
                else {

                  $classSeller="seller right ";
                  $msgs_array[$message->comment_date] = array('classSeller'=>$classSeller,'message'=>$message);

                }
                $i++;
              }




            } //IF THERE ARE NO RESPONSES SHOW THE
            else {


            }

            if(!empty($msgs_array))
            {
              ksort($msgs_array);
              $reversed = array_reverse($msgs_array);
              foreach ($reversed as $key => $single_message) {
                //    print_m("295");
                $classSeller = $single_message['classSeller'];
                //  print_m($classSeller);
                $message = $single_message['message'];
                include(dirname(__FILE__).'/../buyers/single-comment.php');
              }
            }

            ?>



          </div>
        </div>

      </div>



    </div> <!-- new-applications-shape -->
  </div> <!--new-application-top-transform-->
</div>
<div class="clearer hidden-lg hidden-md">

</div>

<div id="comment_editor" class="col-xs-12 col-md-8 col-lg-6 col-lg-offset-3 text-center invisible">

  <div class="comment-editor-shape inline-block text-left ">


    <?php if (get_field('inquiry_status',$post->ID) != 'complete') { ?>
      <div id="comment-reply" class=" white-bg  shadow">

        <div class="editor-toggle-transform text-right  ">
          <div class="editor-toggle-shape inline-block toggle-down">
            <i class="material-icons md-36 toggle-up pointer">expand_less</i>
            <i class="material-icons md-36 toggle-down pointer">expand_more</i>
          </div>

        </div>

        <form method="post" autocomplete=off>
          <input name="post" type="hidden" value="<?php echo $post->ID; ?>" />
          <input name="thread" type="hidden" value="<?php echo $messages['thread']->comment_ID; ?>" />
          <div class="form-group">



            <?php


            $settings = array( 'textarea_rows' => 3,'teeny'=>true,'drag_drop_upload'=>true);
            wp_editor( "", "comment_message",$settings); ?>
          </div>
          <!--  <input class="_btn _btn-primary chatbutton  action_button_shape shadow green-bg white3 radius4 text-center btn_submit radius4" type="submit" value="Aποστολή" />-->
          <div class="text-right blue">
            <div class="inline-block middle blue bold submit_comments pointer">
              Aποστολή Μηνύματος <i class="material-icons blue md-36  inline-block middle">send</i>
            </div>
          </div>
        </form>
      </div>
    <?php } ?>



  </div>


</div>

<div id="offer_calculator" class="white2-bg col-xs-12 col-md-4 col-lg-3 text-center  _fullheight _hidden-xs _hidden-sm _hidden-md">


  <div class="application_filters-transform">

    <div class="application_filters-shape _content_padding _white4-bg">

      <?php


      if ($status == 'active') {
        if (!empty($offer['pending'][0])) {
          $offer_section_title = "Προσφορά";
        } else {
          $offer_section_title ="Δημιουργία Προσφοράς";
        }
      } else {
        $offer_section_title ="Προσφορά";
      }?>



      <?php if ($status == 'active') {
        $offer = $offer['pending'][0];

      }else {
      //  print_m( $offer['status'][0] );
        //$result['status']

        if ( $offer['status'][0] == 'succeeded') {

          $offer = $offer['succeeded'][0];
          //    var_dump($offer['succeeded']);

        }

        if ($offer['status'][0]  == 'failed') {

          $offer = $offer['failed'][0];
          //  var_dump($offer['failed']);

        }

        if ($offer['status'][0]  == 'ignored') {

          $offer = $offer['ignored'][0];
          //  var_dump($offer['ignored']);

        }


      }



      $qty  = (isset($offer['inquiry_seller_quantity']) ? $offer['inquiry_seller_quantity'] : 0);
      $cost = (isset($offer['inquiry_seller_unit_cost']) ? $offer['inquiry_seller_unit_cost'] : 0);
      $shipping = (isset($offer['inquiry_seller_delivery_cost']) ? $offer['inquiry_seller_delivery_cost'] : 0);
      $cash = (isset($offer['inquiry_seller_cashondelivery_cost']) ? $offer['inquiry_seller_cashondelivery_cost'] : 0);
      ?>








      <div class="offer_details-transform">
        <form method="post" id="sendOffer" data-hasOffer="<?php if (!empty($offer)) { echo '1'; } else { echo '0'; } ?>">
          <input type="hidden" name="inquiryId" value="<?php echo $post->ID; ?>" />

          <div class="offer-section-title white  blue-bg bold newapplication_headtitle ">
            <i class="material-icons md-24 white">monetization_on</i> <?php echo  $offer_section_title;?>
          </div>

          <?php
          $hidden="";
            $text_align = "";
          if($isService  )
          {
            $hidden = "hidden";
            $text_align = "text-center one_input";
          }
          ?>

          <div class="offer_details-shape white3-bg  <?php echo $text_align;?>">

            <div class="single-offer-detail-transform <?php echo $hidden;?>">
              <div class="offer-details-title grey text-left bold">
                <?php
                if($isProduct)
                {
                  ?>
                  Ποσότητα
                  <?php
                }else if($isHotel)
                {
                  ?>
                  Διανυκτέρευσεις
                  <?php
                }else if($isService)
                {
                  ?>
                  Ποσότητα
                  <?php
                }
                ?>
              </div>

              <div class="offer-details-data aqua text-center _bold">
                <div class="counter-tool-input-shape  grey ">
                  <input type="text" class="offer" name="inquiry_quantity" value="<?php if (is_null($offer['inquiry_seller_quantity'])) { echo get_field('inquiry_product_quantities',$post->ID); } else { echo get_field('inquiry_product_quantities',$post->ID); } ?>" disabled />
                </div>

              </div>
            </div>


            <div class="single-offer-detail-transform">
              <div class="offer-details-title grey text-left bold">
                <?php
                /*$isService = false;
                $isProduct = false;
                $isHotel = false;
                */
                if($isProduct)
                {
                  ?>
                  Tιμή Μονάδας
                  <?php
                }else if($isHotel)
                {
                  ?>
                  Tιμή Διανυκτέρευσης
                  <?php
                }else if($isService)
                {
                  ?>
                  Τιμή
                  <?php
                }
                ?>

              </div>
              <div class="offer-details-data aqua text-center _bold">
                <div class="counter-tool-input-shape  grey ">

                  <input type="number" placeholder="0.00"  step="0.01" name="inquiry_seller_unit_cost" value="<?php echo (isset($offer['inquiry_seller_unit_cost']) ? $offer['inquiry_seller_unit_cost'] : NULL); ?>" <?php if (get_field('inquiry_status',$post->ID) == 'complete') { echo 'disabled'; } ?>/>   &euro;
                </div>
              </div>
            </div>




            <?php
            $hidden="";
            if($isService || $isHotel)
            {
              $hidden = "hidden";
            }
            ?>




            <?php
            $hidden="";
            if($isService || $isHotel)
            {
              $hidden = "hidden";
            }
            ?>
            <div class="single-offer-detail-transform <?php echo $hidden;?>" >
              <div class="offer-details-title grey text-left bold">
                Μεταφορικά
              </div>
              <div class="offer-details-data grey text-center _bold">
                <div class="counter-tool-input-shape  grey ">

                  <input type="number" placeholder="0.00" step="0.01" name="inquiry_shipping_cost" value="<?php echo (isset($offer['inquiry_seller_delivery_cost']) ? $offer['inquiry_seller_delivery_cost'] : NULL); ?>" <?php if (get_field('inquiry_status',$post->ID) == 'complete') { echo 'disabled'; } ?>/>    &euro;

                </div>
              </div>
            </div>


            <?php
            $hidden="";
            if($isService || $isHotel)
            {
              $hidden = "hidden";
            }
            ?>
            <div class="single-offer-detail-transform <?php echo $hidden;?>">
              <div class="offer-details-title grey text-left bold">
                Αντικαταβολή
              </div>
              <div class="offer-details-data grey text-center _bold">
                <div class="counter-tool-input-shape  grey ">
                  <input type="number" placeholder="0.00" step="0.01" name="inquiry_cashondelivery_cost" value="<?php echo (isset($offer['inquiry_seller_cashondelivery_cost']) ? $offer['inquiry_seller_cashondelivery_cost'] : NULL); ?>"<?php if (get_field('inquiry_status',$post->ID) == 'complete') { echo 'disabled'; } ?>/>     &euro;

                </div>
              </div>
            </div>

            <hr/>


            <div class="single-offer-detail-transform total">
              <div class="offer-details-title grey text-left bold">
                Σύνολο
              </div>
              <div class="offer-details-data grey text-center _bold">
                <div class="counter-tool-input-shape  grey ">
                  <span class="offer-details-title grey bold ">
                    <?php  	if ($isService) {
                      $total = $offer['inquiry_seller_unit_cost'];
                    }
                    else {
                      $total = (number_format((float)$offer['inquiry_seller_quantity'], 2, '.', '') * number_format((float)$offer['inquiry_seller_unit_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_cashondelivery_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_delivery_cost'], 2, '.', '') );
                    }?>
                    <span id="totalCost"><?php echo number_format($total,2); ?></span>  &euro;
                  </span>
                </div>
              </div>
            </div>



            <div class="action_button-transform">

              <div class="action_button text-center">
                <?php
                //  var_dump(getOffer($post->ID, intval(get_current_user_id())['pending'] ));
                //      var_dump(getOffer($post->ID, intval(get_current_user_id()))['pending']);

                if(empty($offer) ) // && empty(getOffer($post->ID, intval(get_current_user_id())['interesting'] )) && empty(getOffer($post->ID, intval(get_current_user_id())['best'] )))
                {
                  ?>
                  <?php if (get_field('inquiry_status',$post->ID) != 'complete') { ?>
                    <div class="action_button_shape shadow aqua-bg white3 _radius4 text-center _inline-block send_offer_submit" data-action="create">

                      <i class="material-icons white inline-block middle">publish</i>Δημιουργία Προσφοράς</div>
                    <?php
                  } ?>
                  <?php
                }else{
                  ?>
                  <?php if (get_field('inquiry_status',$post->ID) != 'complete') { ?>
                    <div class="action_button_shape shadow aqua-bg white3 _radius4 text-center _inline-block send_offer_submit"  data-action="update">

                      <i class="material-icons white inline-block middle">publish</i>  Ανανέωση Προσφοράς</div>
                    <?php
                  } ?>
                  <?php
                }
                ?>




              </div>
            </div>


          </div>

        </div>
      </form>
    </div>
  </div>

<?php  $all_tips = get_field("category_tip",PAGE_OPEN_SELLER,false);

 include(get_template_directory()."/includes/tips.php");?>


</div>


<?php //<div class="col-xs-12 col-lg-3 right-new-application-col "> ?>






<script type="text/javascript">


  function get_tinymce_content(){
    if (jQuery("#comment-reply").hasClass("tmce-active")){
      //  alert(1);
      return tinyMCE.activeEditor.getContent();
    }else{
      //    alert(2);
      tinyMCE.triggerSave();
      //    $('#comment_message').val();
      return jQuery('#comment_message').val();
    }
  }

  jQuery(".submit_comments").on("click",function(){

    jQuery("#comment-reply form").trigger("submit");

  });

  jQuery("#comment-reply form").submit(function(e) {
    e.preventDefault();

    text = get_tinymce_content();
    //alert(text);
    submit_comment(text,1);
  });

  function submit_comment(text,sendMail)
  {
    jQuery.ajax({
      type : "post",
      url : ajaxurl,
      data : { action: "postComment", thread : jQuery('input[name="thread"]').val(), text: text, post : jQuery("input[name='post']").val(), seller: '<?php echo get_current_user_id(); ?>' },
      success: function(response) {
        var result = JSON.parse(response);
        if (result.status == 0) {


          jQuery.ajax({
            type : "post",
            url : ajaxurl,
            dataType	: 'html',
            data : {
              action     : 'notifyUserOnComment',
              post_id  : '<?php echo $post->ID; ?>',
              user     : '<?php echo $post->post_author; ?>',
              comment     : text,
              sendemail :sendMail
            },
            success: function(response2) {
              var result2 = JSON.parse(response2);
              //  alert(result2.status);
                display_success(result2.message);
                window.location.reload();


            }
          });



        }
        else {
          alert("Error adding comment");
        }
      }
    });
  }


  jQuery(".btnAddUser").live("click", function(e) {
    e.preventDefault();
  //  alert(711);


    var user = jQuery(this).attr('data-user');
    jQuery.ajax({
      'type'	: 'post',
      'url'	:	ajaxurl,
      'data'	:	{
        action	:	'addUser',
        user	:	user,
      },
      success: function(response) {
        var result = JSON.parse(response);
        if (result.status == 0) {
          alert(result.message);
          //  window.location = '<?php echo get_bloginfo("url"); ?>/home-seller/?inquiries=active';
        }
        else {
          alert(result.message);
        }
      }
    });


    return false;
  });

  jQuery(".btnAddUserBlacklist").live("click", function(e) {
    var user = jQuery(this).attr('data-user');
  //  alert(user);
    e.preventDefault();

    if (confirm('If you have placed an offer to this inquiry it will be DELETED. Are you sure you want to add the user to blacklist?')) {

      jQuery.ajax({
        'type'	: 'post',
        'url'	:	ajaxurl,
        'data'	:	{
          action	:	'BlacklistUser',
          user	:	user,
        },
        success: function(response) {
          var result = JSON.parse(response);
          //alert(result.status);
          if (result.status == 0) {
        //    alert(result.message);
            window.location = '<?php echo get_bloginfo("url"); ?>/home-seller/?inquiries=active';
          }
          else {
            alert(result.message);
          }
        }
      });
    } else {
      return false;
    }

    return false;
  });


  jQuery('form').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
      e.preventDefault();
      return false;
    }
  });

  jQuery("form input").change(function() {
    console.log("keeeeey");
  /*    alert(" 1 > "+jQuery('form input[name=inquiry_quantity]').val());
        alert(" 2 > "+jQuery('form input[name=inquiry_seller_unit_cost]').val());
          alert(" 3 > "+jQuery('form input[name=inquiry_cashondelivery_cost]').val());
            alert(" 4 > "+jQuery('form input[name=inquiry_shipping_cost]').val());*/
    if (jQuery(this).val().indexOf(',') != -1) {
      jQuery(this).val(jQuery(this).val().replace(',','.'));
    }
    if (!isNaN(parseFloat(jQuery('form input[name="inquiry_quantity"]').val()))) {
      var qty = parseFloat(jQuery('form input[name="inquiry_quantity"]').val());
    }
    else {
      var qty = 0;
    }
    if (!isNaN(parseFloat(jQuery('form input[name="inquiry_seller_unit_cost"]').val()))) {
      var unitcost = parseFloat(jQuery('form input[name="inquiry_seller_unit_cost"]').val());
    }
    else {
      var unitcost = 0;
    }


    if (!isNaN(parseFloat(jQuery('form input[name="inquiry_cashondelivery_cost"]').val()))) {
      var cashcost = parseFloat(jQuery('form input[name="inquiry_cashondelivery_cost"]').val());
      //  alert(cashcost);
    }
    else {
      var cashcost = 0;
      //  alert(" 2 -" +cashcost);
    }
    if (!isNaN(parseFloat(jQuery('form input[name="inquiry_shipping_cost"]').val()))) {

      var scost = parseFloat(jQuery('form input[name="inquiry_shipping_cost"]').val());

    }
    else {
      var scost = 0;
    }
    var isService = '<?php echo $isService; ?>';
    if (isService == 1) {
      var total = unitcost;
    }
    else {
      var total = (qty * unitcost)+cashcost+scost;
    }
    if (total > '0') {
      total = total.toFixed(2);
      jQuery("#totalCost").text(total);
    }
    else {
      jQuery("#totalCost").text(0);
    }
  });



  jQuery("#application_summary").find(".offer-section-title").on("click",function(){
  //  alert(1);
    if(jQuery(this).hasClass("active"))
    {
        jQuery(this).removeClass("active");
        jQuery("#application_summary").find(".application-summary-transform").removeClass("show");
    }else {
    //  alert(1);
        jQuery(this).addClass("active");
        jQuery("#application_summary").find(".application-summary-transform").addClass("show");
    }

  });

  jQuery("#comments_area").find(".offer-section-title").on("click",function(){
  //  alert(1);
    if(jQuery(this).hasClass("active"))
    {
        jQuery(this).removeClass("active");
        jQuery("#offer-chat-main").removeClass("show");
        jQuery("#comment_editor").removeClass("show");

    }else {
    //  alert(1);
        jQuery(this).addClass("active");
          jQuery("#offer-chat-main").addClass("show");
        jQuery("#comment_editor").addClass("show");
    }

  });

jQuery(".send_offer_submit").on("click",function(){

  jQuery("#sendOffer").trigger("submit");

});

  jQuery("#sendOffer").submit(function(e) {
    e.preventDefault();


    /*  var update = true; // If its the first offer flag it so as to create a message thread;
    if(jQuery(".action_button_shape").data("action")=="create")
    {
      update= false;
      jQuery('textarea[name="comment_message"]').val("<strong>Σας έχουμε κάνει προσφορα και ειμαστε στη διάθεση σας!</strong>");
    }*/
    var sendMail_flag = 0;
    if(jQuery(".send_offer_submit").data("action")=="update")
    {
      sendMail_flag=1;
    }

    jQuery.ajax({
      type : "post",
      url : ajaxurl,
      data : {
        action                       : "placeOffer",
        inquiryId                    : jQuery('#sendOffer input[name="inquiryId"]').val(),
        inquiry_seller_unit_cost     : jQuery('#sendOffer input[name="inquiry_seller_unit_cost"]').val(),
        inquiry_shipping_cost        : jQuery('#sendOffer input[name="inquiry_shipping_cost"]').val(),
        inquiry_quantity             : jQuery('#sendOffer input[name="inquiry_quantity"]').val(),
        inquiry_cashondelivery_cost  : jQuery('#sendOffer input[name="inquiry_cashondelivery_cost"]').val(),
      },
      success: function(response) {
        var result = JSON.parse(response);
        if (result.status == 100) {
          //  alert("s 100");
          var text = '<strong><?php echo $seller_custom_message;?></strong>';
          submit_comment(text,sendMail_flag);
        }else if(result.status == 1)
        {

          //  alert('700 '+result.message);
          window.location.reload();


        }
        else {
          //    alert("704");
          display_success(result.message);
        }
      }
    });
  });
</script>
