<?php
if (!isset($_GET['seller'])) { wp_safe_direct(get_home_url()); }
$offer = getOffer($post->ID,$_GET['seller']);
$messages = getInquiryConversation($post->ID,$_GET['seller']);
//var_dump($offer);
$status = get_field('inquiry_status',$post->ID);
$catId =  get_field('inquiry_product_category',$post->ID);

foreach ($messages as $key => $value) {
  //var_dump($value);
  break;
}

$inquiries = array("0"=>4102);
 //remove_offers_from_inquiry($inquiries,214);

//var_dump($catId);

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
//  echo "HOTEL";
  break;

  case SERVICE :
  $isService = true;
  //echo "SERVICE";
  break;

  default:
  echo "Error";
  wp_die();
}


if ($status == 'active') {
  if (!empty($offer['pending'][0])) {
    $offer_section_title = "Προσφορά";
  } else {
    $offer_section_title ="Δίχως Προσφορά";
  }
} else {
  $offer_section_title ="  Προσφορά";
}




if(!empty($offer['pending']))
{
  $offer = $offer['pending'][0];

}else if(!empty($offer['succeeded']))
{
    $offer = $offer['succeeded'][0];
}else if(!empty($offer['failed']))
{
    $offer = $offer['failed'][0];
}



$active = "inactiveOffer";
if ($status == 'active') {
  $active = "activeOffer";
}


$sid = $offer['inquiry_seller']['ID'];
$companyName = get_field('seller_companyName','user_'.$offer['inquiry_seller']['ID']); ;

?>





<!--do not delete above - Those 3 divs close in single-client_inquiry.php -->



<div class="clearer">

</div>

<div id="application_summary" class="white2-bg col-xs-12 col-md-12 col-lg-3 text-center fullheight hidden-xs hidden-sm hidden-md client">

  <div class="offer-section-title black bold newapplication_headtitle hidden-lg">
    <i class="material-icons md-24">insert_drive_file</i> TO AITHMA
    <div class="application-details-toggle text-right">
      <div class="application-details-toggle-shape inline-block toggle-down">
        <i class="material-icons md-36 toggle-up pointer">expand_less</i>
        <i class="material-icons md-36 toggle-down pointer">expand_more</i>
      </div>
    </div>
  </div>


  <div class="application-summary-transform _toggle-summary">

    <div class="application-summary-shape blue inquiry_summary" id="buyer_view">
      <?php the_content(); ?>
    </div>

  </div>

</div>

<div class="col-xs-12 col-lg-6 left-new-application-col content_paddin">
  <div class='new-application-main-transform'>
    <div class='new-application-main-shape'>

      <div class="offer-section-title black  bold newapplication_headtitle white4-bg">
        <i class="material-icons md-24 black">chat_bubble_outline</i> Μηνύματα <i class="material-icons md-24 black hidden-md hidden-lg middle inline-block arrow_transform">keyboard_arrow_down</i>
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


            $msgs_array = array();


            if (!empty($messages['thread'])) {
              //  echo '<h1> a:'.empty($messages['thread']).'</h1>';
              $classSeller="client left ";
              if (!is_buyer(intval( $messages['thread']->user_id)))
              {
                $classSeller="seller right ";
              }

              $msgs_array[$messages['thread']->comment_date] = array('classSeller'=>$classSeller,'message'=>$messages['thread']);

              //    include(dirname(__FILE__).'/../buyers/single-thread.php');
            } ?>


            <?php
            //IF THERE ARE RESPONSES SHOW THEM INCLUDING REPLY FORM
            //  echo '<h1> b:'.empty($messages['messages']).'</h1>';
            if (!empty($messages['messages'])) {
              //  echo '<h1>'.empty($messages['messages']).'</h1>';
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
                $classSeller = $single_message['classSeller'];
                //  print_m($classSeller);
                $message = $single_message['message'];
                include(dirname(__FILE__).'/single-comment.php');
              }

            }

            ?>



          </div>
        </div>

      </div>



    </div> <!-- new-applications-shape -->
  </div> <!--new-application-top-transform-->
</div>


<div id="comment_editor" class="col-xs-12 col-lg-6 col-lg-offset-3  text-center invisible">

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
            $settings = array( 'textarea_rows' => 3);
            wp_editor( "", "comment_message",$settings);
            ?>
          </div>
          <!-- <input class="_btn _btn-primary chatbutton  action_button_shape shadow green-bg white3 radius4 text-center btn_submit radius4" type="submit" value="Aποστολή" />-->
          <div class="text-right">
          <span class="middle">Aποστολή μηνύματος</span>  <i class="material-icons middle inline-block blue md-36 submit_comments pointer">send</i>
          </div>

        </form>
      </div>
    <?php } ?>



  </div>
</div>


<div class="col-xs-12 col-lg-3 right-new-application-col fullheight" id="client_actions">
  <div class="offer-section-title white  blue-bg bold newapplication_headtitle ">
    <i class="material-icons md-24 white">monetization_on</i> <?php echo  $offer_section_title;?>
  </div>
  <div class="offer-seller-actions-transform">
    <div class="offer-seller-actions-shape">

      <div class='offer_seller_avatar bold black3 condensed inline-block middle'>


        <div class="offer_seller_avatar_cnt circle">
             <a class="black2" href="<?php echo SELLER_PROFILE.$sid;?>" target="_blank">
          <?php echo getCustomAvatar($sid,true);

           ?>
        </a>
        </div>


           <a class="black2" href="<?php echo SELLER_PROFILE.$sid;?>" target="_blank">

             <?php echo $companyName ;?>
          </a>


      </div>

      <div class="view-offer-user-options inline-block">

        <div class="option-cell-transform <?php echo $active;?> right">
          <div class="option-cell-shape white text-center btnAddSeller" data-seller="<?php echo $sid; ?>">
            <a href="#"  class="">
              <div class="option-button-transform">
                <div class="option-button-shape">
                  <i class="material-icons md-24 green">local_grocery_store</i>
                </div>
              </div>


              <div class='option-button-title  _semi-bold grey'>
                Προμηθευτής
              </div>
            </a>

          </div>
        </div> <!-- Single cell -->


        <div class="option-cell-transform <?php echo $active;?> right">
          <div class="info_box  inline-block pointer" data-wenk="blah blah blah" data-wenk-pos="right">
           <i class="material-icons  red" >info</i>
         </div>
          <div class="option-cell-shape white text-center btnAddSellerBlacklist" data-seller="<?php echo $sid; ?>">
            <a href="#"  class="aqua">
              <div class="option-button-transform">
                <div class="option-button-shape">
                  <i class="material-icons  md-24 red">sentiment_very_dissatisfied</i>
                </div>
              </div>


              <div class='option-button-title _semi-bold grey'>
                Blacklist
              </div>
            </a>

          </div>
        </div> <!-- Single cell -->
        <div class="clearer">

        </div>
      </div>




    </div>
  </div>





<!-- Start offer -->

<?php

    $qty  = (isset($offer['inquiry_seller_quantity']) ? $offer['inquiry_seller_quantity'] : 0);
    $cost = (isset($offer['inquiry_seller_unit_cost']) ? $offer['inquiry_seller_unit_cost'] : 0);
    $shipping = '0.00';
    if(isset($offer['inquiry_seller_delivery_cost']) && trim($offer['inquiry_seller_delivery_cost']) !="")
    {
    $shipping =  number_format($offer['inquiry_seller_delivery_cost'],2);
    }


    $cash = '0.00';
    if(isset($offer['inquiry_seller_cashondelivery_cost']) && trim($offer['inquiry_seller_cashondelivery_cost']) !="")
    {
      $cash =  number_format($offer['inquiry_seller_cashondelivery_cost'],2);
    }



    if ($isProduct) {
      if ($qty != 0 && $cost != 0) { $total = ($cost * $qty) + $cash + $shipping; }
      elseif ($qty == 0 && $cost != 0) { $total = $cost + $cash + $shipping; }
      else { $total = 0; }
    }
    else {
      if ($qty != 0 && $cost != 0) { $total = ($cost * $qty); }
      elseif ($qty == 0 && $cost != 0) { $total = $cost; }
      else { $total = 0; }
    }

    $hide_offer_fields = "";
    if ($total == 0) {
      $hide_offer_fields = "hidden";
    }

?>

  <div class="offer_details-transform">
    <form method="post" id="sendOffer" data-hasOffer="<?php if (!empty($offer)) { echo '1'; } else { echo '0'; } ?>">
      <input type="hidden" name="inquiryId" value="<?php echo $post->ID; ?>" />



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
          <div class="offer-details-title black4 text-left">
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
              <input type="text" class="offer" name="inquiry_quantity" value="<?php echo (isset($offer['inquiry_seller_quantity']) ? $offer['inquiry_seller_quantity'] : NULL); ?>" disabled />
            </div>

          </div>
        </div>


        <div class="single-offer-detail-transform <?php echo $hide_offer_fields;?>">
          <div class="offer-details-title black4 text-left">
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

              <input type="text" class="offer" value="<?php echo (isset($offer['inquiry_seller_unit_cost']) ? $offer['inquiry_seller_unit_cost'] : NULL); ?>" disabled />   &euro;
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
        <div class="single-offer-detail-transform <?php echo $hidden;?>  <?php echo $hide_offer_fields;?>" >
          <div class="offer-details-title black4 text-left">
            Μεταφορικά
          </div>
          <div class="offer-details-data grey text-center _bold">
            <div class="counter-tool-input-shape  grey ">

              <input type="text" class="offer" value="<?php echo $shipping;?>" disabled/>    &euro;

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
        <div class="single-offer-detail-transform <?php echo $hidden;?> <?php echo $hide_offer_fields;?>">
          <div class="offer-details-title black4 text-left">
            Αντικαταβολή
          </div>
          <div class="offer-details-data grey text-center _bold">
            <div class="counter-tool-input-shape  grey ">
              <input type="text" class="offer" value="<?php echo $cash;?>" disabled />     &euro;

            </div>
          </div>
        </div>



        <div class="single-offer-detail-transform ">
          <div class="offer-details-title black4 text-left bold">
            Σύνολο
          </div>
          <div class="offer-details-data grey text-center _bold">
            <div class="counter-tool-input-shape  grey ">
              <span class="offer-details-title black  bold ">
                <?php  	if ($total != 0) {
                  $total = number_format($total,2);
                }
                else {
                  $total = number_format($total,2);
                }?>
                <span id="totalCost"><?php echo number_format($total,2); ?></span>  &euro;
              </span>

            </div>
          </div>
        </div>





      </div>



      <?php if($active !="inactiveOffer")
      {
        ?>


      <div class="offer-options-transform inline-block middle">
        <div class="offer-options-shape white3-bg _options-bg vertical">


          <div class="option-cell-transform <?php echo $active;?> <?php echo $hide_offer_fields;?>">
            <div class="option-cell-shape white text-center">
              <a href="#" data-action="offer-complete" class="buyer-offer-actions _completeOffer aqua">
                <div class="option-button-transform">
                  <div class="option-button-shape">
                    <i class="material-icons md-24 green">done</i>
                  </div>
                </div>


                <div class='option-button-title  _semi-bold grey text-center'>
                  Αποδοχή
                </div>
              </a>

            </div>
          </div> <!-- Single cell -->

          <?php if ($offer['inquiry_seller_interesting'] == 1) {

            $active_option = "yellow";

          } else {
            $active_option =  "grey";
          } ?>

          <div class="option-cell-transform <?php echo $active ;?> <?php echo $hide_offer_fields;?>">
            <div class="option-cell-shape white text-center  offer-intrested">
              <a href="#" data-action="offer-intrested"  class="buyer-offer-actions aqua">
                <div class="option-button-transform">
                  <div class="option-button-shape">

                    <i class="material-icons md-24 <?php echo $active_option;?>">favorite</i>
                  </div>
                </div>

                <div class='option-button-title  _semi-bold grey text-center'>
                  Ενδιαφέρουσα
                </div>
              </a>
            </div>
          </div> <!-- Single cell -->


          <div class="option-cell-transform <?php echo $active;?>">
            <div class="option-cell-shape white text-center offer-ignore">
              <a href="#" data-action="offer-ignore" class="buyer-offer-actions aqua">
                <div class="option-button-transform">
                  <div class="option-button-shape">

                    <i class="material-icons red">highlight_off</i>

                  </div>
                </div>

                <div class='option-button-title  text-center grey'>
                  Aπόριψη
                </div>
              </a>
            </div>
          </div> <!-- Single cell -->
        </div>
      </div>

      <?php
      }
      ?>

    </div>


<!-- end offer -->










  <?php

    $all_tips = get_field("category_tip",PAGE_OPEN_BUYER,false);

   include(get_template_directory()."/includes/tips.php");?>

</div>












































<script type="text/javascript">


  function get_tinymce_content(){
    if (jQuery("#comment-reply").hasClass("tmce-active")){
      //  //alert(1);
      return tinyMCE.activeEditor.getContent();
    }else{
      //    //alert(2);
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

    jQuery.ajax({
      type : "post",
      url : ajaxurl,
      data : { action: "postComment", thread : jQuery('input[name="thread"]').val(), text: text, post : jQuery("input[name='post']").val(), seller: '<?php echo $_REQUEST['seller']; ?>' },
      success: function(response) {
        var result = JSON.parse(response);
      //  alert(result.status);
        if (result.status == 0) {



          jQuery.ajax({
            type : "post",
            url : ajaxurl,
            dataType	: 'html',
            data : {
              action     : 'notifySellerOnComment',
              post_id  : '<?php echo $post->ID; ?>',
              seller     : '<?php echo $_REQUEST['seller']; ?>',
              comment     : text
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
          //alert("Error adding comment");
        }
      }
    });
  });

  //addToMySellers
  //btnAddSeller

  jQuery(".btnAddSeller").live("click", function(e) {
    e.preventDefault();
    console.log("Adding to sellers");
    var seller = jQuery(this).data('seller');

    jQuery.ajax({
      'type'	: 'post',
      'url'	:	ajaxurl,
      'data'	:	{
        action	:	'addToMySellers',
        seller	:	seller
      },
      success: function(response) {
        var result = JSON.parse(response);
        if (result.status == 0) {
          alert(result.message);

        }
        else {
          alert(result.message);
        }
      }
    });
    return false;
  });

  jQuery(".btnAddSellerBlacklist").live("click", function(e) {
    e.preventDefault();
    if (!confirm('Όλες οι προσφορες θα διαγραφούν'))
    {
      return 0;
    }
    var seller = jQuery(this).attr('data-seller');
    jQuery.ajax({
      'type'	: 'post',
      'url'	:	ajaxurl,
      'data'	:	{
        action	:	'BlacklistSeller',
        seller	:	seller,
      },
      success: function(response) {
        var result = JSON.parse(response);
        if (result.status == 0) {
          alert(result.message);
          window.location = "home-buyers/?inquiries=active";
        }
        else {
          alert(result.message);
        }
      }
    });
    return false;
  });

  //completeOffer
  jQuery("a.completeOffer").click(function(e) {

    //seller_rating-transform
    e.preventDefault();
    TweenMax.to(jQuery("#popup-bg"),0.5,{opacity:1});
    TweenMax.from(jQuery("#seller_rating-transformg"),2,{left:"-2000px",ease:Power2.easeOut});
    jQuery("#seller_rating-transform").removeClass("hidden");

  });

  //rating_close-window

  jQuery(".rating_close-window ").click(function(e) {

    //seller_rating-transform
    e.preventDefault();

    jQuery("#seller_rating-transform").addClass("hidden");

  });


jQuery(".buyer-offer-actions").on("mouseenter",function(){

    TweenMax.to(jQuery(this).find(".option-button-shape"),0.6,{css:{scale:1.5},ease:Quad.easeOut});

});


jQuery(".buyer-offer-actions").on("mouseleave",function(){

    TweenMax.to(jQuery(this).find(".option-button-shape"),0.6,{css:{scale:1},ease:Quad.easeIn});

});


  jQuery("a.buyer-offer-actions").click(function(e) {

    e.preventDefault();

    var action = jQuery(this).data("action");

    var run = '';
    switch (action) {
      case 'offer-complete':

      run = 'markOfferComplete';
      break;

      case 'offer-intrested':
      run = 'MarkInterestingOffer';
      break;

      case 'offer-ignore':
      run = 'ignoreOffer';
      break;  case 'offer-best':
      run = 'MarkBestOffer';
      break;

      default:
      //  //alert("def");
      return false;
      break;
    }
    alert(run);

    var rating = jQuery("input[name=seller-rating]:checked").val();
    //    //alert(rating);
    //    return 0;


    jQuery.ajax({
      type : "post",
      url : ajaxurl,
      dataType	: 'html',
      data : {
        action     : run,
        inquiryId  : '<?php echo $post->ID; ?>',
        seller     : '<?php echo $_REQUEST['seller']; ?>',
        rating     : rating
      },
      success: function(response) {
        var result = JSON.parse(response);
        if (result.status == 0) {

        //  alert("831 "+result.message);
          display_success(result.message);
          if(run=='ignoreOffer' || run == 'markOfferComplete')
          {
            //  window.location = "<?php echo get_site_url().'/home-buyers/?inquiries=active'; ?>"; //.reload();
          }

        }
        else {
        //  alert("835 "+result.message);
          display_error(result.message);
          return false;
        }
      }
    });
  });
</script>
