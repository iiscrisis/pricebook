<?php
$offer = getOffer($post->ID,get_current_user_id());


if (!empty($offer['pending'][0])) {
  $offer = $offer['pending'][0];


}
$messages = getInquiryConversation($post->ID,intval(get_current_user_id()));
?>


<?php

//echo '<h1>'.get_field('inquiry_status',$post->ID).'</h1>';
if (get_field('inquiry_status',$post->ID) == 'complete') {
  $mine = getOffer($post->ID,get_current_user_id());
  foreach ($mine as $theOffer) {
    if (intval($theOffer[0]['inquiry_seller']['ID']) == intval(get_current_user_id())) {
      $offer = $theOffer[0];
      break;
    }
  }
}

?>
































<div id="offer-mainframe">
  <div class='offer-mainframe-shape'>
    <div class="row">
      <div class="col-xs-12 col-md-6 col-lg-3" id="offer-summary">


        <a href="" class="btnAddUserBlacklist" data-user="<?php echo $post->post_author; ?>">Add user to blacklist</a><br />

        <div class="offer-summary-transform">
          <div class="offer-summary-shape blue2">

            <div class="offer-summary-label-transform">
              <div class="offer-summary-label-shape _blue-bg blue semi-bold  ">

                Προσφορά

              </div>
            </div>

            <div class="offer-transform">
              <div class="offer-shape round2 shadow">
                <form method="post" id="sendOffer" data-hasOffer="<?php if (!empty($offer)) { echo '1'; } else { echo '0'; } ?>">
                  <input type="hidden" name="inquiryId" value="<?php echo $post->ID; ?>" />


                  <div class="offer-details-transform">
                    <div class="offer-details-shape _blue5-bg _white2-bg">
                      <div class="row bold">
                        <div class="col-xs-6 offer-details-col">
                          <div class="offer-details-wrapper  ">
                            <div class="offer-details-title black text-center">
                              TIMH ΜΟΝΑΔΟΣ
                            </div>

                            <div class="offer-details-data aqua text-center">
                              <div class="counter-tool-input-shape  aqua ">

                                &euro;<input type="text" name="inquiry_seller_unit_cost" value="<?php echo (isset($offer['inquiry_seller_unit_cost']) ? $offer['inquiry_seller_unit_cost'] : NULL); ?>" <?php if (get_field('inquiry_status',$post->ID) == 'complete') { echo 'disabled'; } ?>/>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-xs-6 offer-details-col " style="visibility:<?php echo ($isService ? 'hidden' : 'visible'); ?>">
                          <div class="offer-details-wrapper">
                            <div class="offer-details-title black text-center">
                              ΜΕΤΑΦΟΡΙΚΑ
                            </div>
                            <div class="offer-details-data aqua text-center">
                              <div class="counter-tool-input-shape  aqua ">

                                &euro;<input type="text" name="inquiry_shipping_cost" value="<?php echo (isset($offer['inquiry_seller_delivery_cost']) ? $offer['inquiry_seller_delivery_cost'] : NULL); ?>" <?php if (get_field('inquiry_status',$post->ID) == 'complete') { echo 'disabled'; } ?>/>

                              </div>
                            </div>
                          </div>
                        </div>


                      </div>



                      <div class="row bold">
                        <div class="col-xs-6 offer-details-col">
                          <div class="offer-details-wrapper">
                            <div class="offer-details-title black text-center">
                              ΠΟΣΟΤΗΤΑ
                            </div>

                            <div class="offer-details-data aqua text-center">
                              <div class="counter-tool-input-shape  aqua ">
                                <input type="number" name="inquiry_quantity" value="<?php if (is_null($offer['inquiry_seller_quantity'])) { echo get_field('inquiry_product_quantities',$post->ID); } else { echo get_field('inquiry_product_quantities',$post->ID); } ?>" disabled />
                              </div>
                            </div>
                          </div>

                        </div>

                        <div class="col-xs-6 offer-details-col">
                          <div class="offer-details-wrapper">
                            <div class="offer-details-title black text-center">
                              ΑΝΤΙΚΑΤΑΒΟΛΗ
                            </div>
                            <div class="offer-details-data aqua text-center">
                              <div class="counter-tool-input-shape  aqua ">
                                &euro;	        <input type="text" name="inquiry_cashondelivery_cost" value="<?php echo (isset($offer['inquiry_seller_cashondelivery_cost']) ? $offer['inquiry_seller_cashondelivery_cost'] : NULL); ?>"<?php if (get_field('inquiry_status',$post->ID) == 'complete') { echo 'disabled'; } ?>/>

                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-xs-12 _col-xs-offset-6 offer-details-col update-offer-btn">
                          <div class="action_button">


                            <?php
                            //  var_dump(getOffer($post->ID, intval(get_current_user_id())['pending'] ));
                      //      var_dump(getOffer($post->ID, intval(get_current_user_id()))['pending']);

                            if(empty($offer) ) // && empty(getOffer($post->ID, intval(get_current_user_id())['interesting'] )) && empty(getOffer($post->ID, intval(get_current_user_id())['best'] )))
                            {
                              ?>
                              <?php if (get_field('inquiry_status',$post->ID) != 'complete') { ?>
                                <div class="action_button_shape shadow aqua-bg white3 radius4 text-center" data-action="create"><input type="submit" class="" value="Δημιουργία προσφοράς" /> <?php
                                } ?>
                                <?php
                              }else{
                                ?>
                                <?php if (get_field('inquiry_status',$post->ID) != 'complete') { ?>
                                  <div class="action_button_shape shadow aqua-bg white3 radius4 text-center"  data-action="update"><input type="submit" class="" value="Ανανέωση προσφοράς" /> <?php
                                  } ?>
                                  <?php
                                }
                                ?>


                              </div>

                            </div>
                          </div>


                        </div>

                        <div class="total-transform">
                          <div class="total-shape _circle ">
                            <div class="offer-details-title blue2  bold text-center">
                              ΣΥΝΟΛΟ
                            </div>
                            <div class="offer-details-data blue2 bold text-center" id="totalCost">
                              <?php  	if ($isService) {
                                $total = $offer['inquiry_seller_unit_cost'];
                              }
                              else {
                                $total = (number_format((float)$offer['inquiry_seller_quantity'], 2, '.', '') * number_format((float)$offer['inquiry_seller_unit_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_cashondelivery_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_delivery_cost'], 2, '.', '') );
                              }?>
                              <?php echo $total; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> <!-- offer-info-transform"-->

                  </form>
                </div>


                <div class="offer-options-transform hidden">
                  <div class="offer-options-shape blue-bg _options-bg vertical">

                    <div class="option-cell-transform">
                      <div class="option-cell-shape white text-center">

                        <div class="option-button-transform">
                          <div class="option-button-shape">
                            <img src="images/dashboard/applications/handshake.svg"/>
                          </div>
                        </div>

                        <div class='option-button-title  semi-bold white'>
                          ΟΛΟΚΛΗΡΩΣΗ
                        </div>

                      </div>
                    </div> <!-- Single cell -->


                    <div class="option-cell-transform">
                      <div class="option-cell-shape white text-center">

                        <div class="option-button-transform">
                          <div class="option-button-shape">
                            <img src="images/dashboard/applications/refresh.svg"/>
                          </div>
                        </div>

                        <div class='option-button-title  semi-bold white'>
                          EΝΔΙΑΦΕΡΟΜΑΙ
                        </div>

                      </div>
                    </div> <!-- Single cell -->


                    <div class="option-cell-transform">
                      <div class="option-cell-shape white text-center">

                        <div class="option-button-transform">
                          <div class="option-button-shape">
                            <img src="images/dashboard/applications/delete.svg"/>
                          </div>
                        </div>

                        <div class='option-button-title  semi-bold white'>
                          ΑΠΟΡΙΨΗ
                        </div>

                      </div>
                    </div> <!-- Single cell -->
                  </div>
                </div>

              </div>



            </div>
          </div>


          <div class="offer-summary-transform yellow">
            <div class="offer-summary-shape">
              <div class="offer-summary-label-transform">
                <div class="offer-summary-label-shape _aqua-bg blue bold  _shadow_3">

                  Aίτημα

                </div>
              </div>
              <div class="offer-transform">
                <div class="offer-shape round2 shadow">

                  <div class="offer-info-transform">
                    <div class="offer-info-shape black3 white-bg">
                      <?php the_content(); ?>
                    </div>
                  </div> <!-- offer-info-transform"-->



                </div>
              </div>
            </div>
          </div> <!-- offer-summary-transform-->

        </div><!-- <div class="col-xs-12 col-md-6 col-lg-4" id="offer-summary"> -->


          <div class="col-xs-12 col-md-6 col-lg-8 offset-lg-1" id="offer-chat">

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



                  <?php

                  //11IF THERE'S AN INITIAL MESSAGE FROM A SELLER SHOW IT AND CHECK FOR CHATS
                  if (!empty($messages['thread'])) {
                    //  echo '<h1> a:'.empty($messages['thread']).'</h1>';
                    $classSeller="client left ";
                    if (is_buyer(intval( $messages['thread']->user_id)))
                    {
                      $classSeller="seller right ";
                    }

                    include(dirname(__FILE__).'/../buyers/single-thread.php');
                  } ?>
                  <?php
                  //IF THERE ARE RESPONSES SHOW THEM INCLUDING REPLY FORM
                  //  echo '<h1> b:'.empty($messages['messages']).'</h1>';
                  if (!empty($messages['messages'])) {
                    echo '<h1>'.empty($messages['messages']).'</h1>';
                    $i=0;
                    $length = count($messages['messages']);

                    foreach ($messages['messages'] as $message) {

                      if (is_buyer(intval($message->user_id))) {
                        include(dirname(__FILE__).'/../buyers/single-comment.php');
                      }
                      else {
                        include(dirname(__FILE__).'/single-comment.php');
                      }
                      if ($i == $length - 1 && @sizeof($offer['succedded']) == 0 && get_field('inquiry_status',$post->ID) != 'complete') { ?>
                        <div id="comment-reply">

                          <form method="post" autocomplete=off>
                            <input name="post" type="hidden" value="<?php echo $post->ID; ?>" />
                            <input name="thread" type="hidden" value="<?php echo $messages['thread']->comment_ID; ?>" />
                            <div class="form-group">
                              <textarea class="form-control" name="comment_message" rows="2" cols="50" placeholder="Το κείμενο σας"></textarea>
                            </div>
                            <input class="btn btn-primary" type="submit" value="Submit" />
                          </form>
                        </div>
                      <?php } ?>
                      <?php
                      $i++;
                    }
                  } //IF THERE ARE NO RESPONSES SHOW THE
                  else {
                    if (get_field('inquiry_status',$post->ID) != 'complete') { ?>
                      <div id="comment-reply">

                        <form method="post" autocomplete=off>
                          <input name="post" type="hidden" value="<?php echo $post->ID; ?>" />
                          <input name="thread" type="hidden" value="<?php echo $messages['thread']->comment_ID; ?>" />
                          <div class="form-group">
                            <textarea class="form-control" name="comment_message" rows="2" cols="50" placeholder="Το κείμενο σας"></textarea>
                          </div>
                          <input class="btn btn-primary" type="submit" value="Submit" />
                        </form>
                      </div>
                    <?php } ?>
                    <?php
                  }
                  ?>



                </div>
              </div>

            </div>

          </div> <!-- end offer-chat -->




        </div>
      </div>
    </div>





  </div>
  <script type="text/javascript">
    jQuery("#comment-reply form").submit(function(e) {
      e.preventDefault();

      jQuery.ajax({
        type : "post",
        url : ajaxurl,
        data : { action: "postComment", thread : jQuery('input[name="thread"]').val(), text: jQuery('textarea[name="comment_message"]').val(), post : jQuery("input[name='post']").val(), seller: '<?php echo get_current_user_id(); ?>' },
        success: function(response) {
          var result = JSON.parse(response);
          if (result.status == 0) {
            window.location.reload();
          }
          else {
            alert("Error adding comment");
          }
        }
      });
    });

    jQuery(".btnAddUserBlacklist").live("click", function(e) {
      e.preventDefault();
      if (jQuery("#sendOffer").attr('data-hasOffer') == '1') {
        if (confirm('If you have placed an offer to this inquiry it will be DELETED. Are you sure you want to add the user to blacklist?')) {
          var user = jQuery(this).attr('data-user');
          jQuery.ajax({
            'type'	: 'post',
            'url'	:	ajaxurl,
            'data'	:	{
              action	:	'BlacklistUser',
              user	:	user,
            },
            success: function(response) {
              var result = JSON.parse(response);
              if (result.status == 0) {
                alert(result.message);
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
      }
      return false;
    });


    jQuery("form input").keyup(function() {

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
      }
      else {
        var cashcost = 0;
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
        jQuery("#totalCost").text(total);
      }
      else {
        jQuery("#totalCost").text(0);
      }
    });

    jQuery("#sendOffer").submit(function(e) {
      e.preventDefault();


      var update = true; // If its the first offer flag it so as to create a message thread;
      if(jQuery(".action_button_shape").data("action")=="create")
      {
        update= false;
        jQuery('textarea[name="comment_message"]').val("Ειμαστε εδω για να σας εξυπηρετήσουμε");
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
          if (result.status == 0) {

            if(!update)
            {
              jQuery("#comment-reply form").trigger("submit");

            }else {
              alert(result.message);
              window.location.reload();
            }

          }
          else {
            alert(result.message);
          }
        }
      });
    });
  </script>



          <?php
                                if ($i == $length - 1 && @sizeof($offer['succedded']) == 0 && get_field('inquiry_status',$post->ID) != 'complete') { ?>
                                  <div id="comment-reply" class="hidden">

                                    <form method="post" autocomplete=off >
                                      <input name="post" type="hidden" value="<?php echo $post->ID; ?>" />
                                      <input name="thread" type="hidden" value="<?php echo $messages['thread']->comment_ID; ?>" />
                                      <div class="form-group">
                                        <textarea class="form-control" name="comment_message" rows="2" cols="50" placeholder="Το κείμενο σας"></textarea>
                                      </div>
                                      <input class="btn btn-primary" type="submit" value="Submit" />
                                    </form>
                                  </div>
                                <?php } ?>
