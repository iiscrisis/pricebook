<?php
if (!isset($_GET['seller'])) { wp_safe_direct(get_home_url()); }
$offer = getOffer($post->ID,$_GET['seller']);
$messages = getInquiryConversation($post->ID,$_GET['seller']);

$blacklist_array = getUserBlacklist();
 var_dump($blacklist_array);
//var_dump($offer);
$status = get_field('inquiry_status',$post->ID);
?>




<div id="offer-mainframe">

  <div class='offer-mainframe-shape'>

    <div class="row">

      <div class="col-xs-12 col-md-6 col-lg-3" id="offer-summary">

        <div class="seller-actions-transform">
          <div class="seller-actions-shape">
            <button type="button" class="btn btn-default btn-sm btnAddSeller" data-seller="<?php echo $offer['pending'][0]['inquiry_seller']['ID']; ?>">
              <span class="glyphicon glyphicon-user"></span>Add to my sellers
            </button>
            <button type="button" class="btn btn-default btn-sm btnAddSellerBlacklist" data-seller="<?php echo $offer['pending'][0]['inquiry_seller']['ID']; ?>">
              <span class="glyphicon glyphicon-alert"></span>Add to blacklist
            </button>


          </div>
        </div>

        <?php
        if ($status == 'active') {
          if (!empty($offer['pending'][0])) { ?>
            <h3>Προσφορά επαγγελματία <?php echo get_field('seller_companyName','user_'.$offer['pending'][0]['inquiry_seller']['ID']); ?></h3>
          <?php } else { ?>
            <h3>Χωρίς προσφορά</h3>
          <?php } } else { ?>
            <h3>Προσφορά επαγγελματία</h3>
          <?php }

          if ($status == 'active') {
            $offer = $offer['pending'][0];

          }
          if ($status == 'complete') {
            $offer = $offer['succeeded'][0];

          }?>


          <?php
          $qty  = (isset($offer['inquiry_seller_quantity']) ? $offer['inquiry_seller_quantity'] : 0);
          $cost = (isset($offer['inquiry_seller_unit_cost']) ? $offer['inquiry_seller_unit_cost'] : 0);
          $shipping = (isset($offer['inquiry_seller_delivery_cost']) ? $offer['inquiry_seller_delivery_cost'] : 0);
          $cash = (isset($offer['inquiry_seller_cashondelivery_cost']) ? $offer['inquiry_seller_cashondelivery_cost'] : 0);
          ?>

          <div class="offer-summary-transform">
            <div class="offer-summary-shape blue2 white-bg">

              <div class="offer-summary-label-transform">
                <div class="offer-summary-label-shape _blue-bg blue semi-bold  ">

                  Προσφορά

                </div>
              </div>

              <div class="offer-transform">
                <div class="offer-shape round2 shadow">


                  <div class="offer-details-transform">
                    <div class="offer-details-shape _blue5-bg _white2-bg">
                      <div class="row bold">
                        <div class="col-xs-6 col-md-6 offer-details-col">
                          <div class="offer-details-wrapper  ">
                            <div class="offer-details-title black text-center">
                              TIMH ΜΟΝΑΔΟΣ
                            </div>

                            <div class="offer-details-data aqua text-center">
                              &euro;<?php echo (isset($offer['inquiry_seller_unit_cost']) ? $offer['inquiry_seller_unit_cost'] : NULL); ?>
                            </div>
                          </div>
                        </div>

                        <div class="col-xs-6 col-md-6 offer-details-col">
                          <div class="offer-details-wrapper">
                            <div class="offer-details-title black text-center">
                              ΜΕΤΑΦΟΡΙΚΑ
                            </div>
                            <div class="offer-details-data aqua text-center">
                              &euro;<?php echo (isset($offer['inquiry_seller_delivery_cost']) ? $offer['inquiry_seller_delivery_cost'] : NULL); ?>
                            </div>
                          </div>
                        </div>



                        <div class="col-xs-6 col-md-6 offer-details-col">
                          <div class="offer-details-wrapper">
                            <div class="offer-details-title black text-center">
                              ΠΟΣΟΤΗΤΑ
                            </div>

                            <div class="offer-details-data aqua text-center">
                              <?php echo (isset($offer['inquiry_seller_quantity']) ? $offer['inquiry_seller_quantity'] : NULL); ?>
                            </div>
                          </div>

                        </div>

                        <div class="col-xs-6 col-md-6 offer-details-col">
                          <div class="offer-details-wrapper">
                            <div class="offer-details-title black text-center">
                              ΑΝΤΙΚΑΤΑΒΟΛΗ
                            </div>
                            <div class="offer-details-data aqua text-center">
                              &euro;<?php echo (isset($offer['inquiry_seller_cashondelivery_cost']) ? $offer['inquiry_seller_cashondelivery_cost'] : NULL); ?>
                            </div>
                          </div>
                        </div>


                      </div>

                      <div class="total-transform">
                        <div class="total-shape _circle ">
                          <div class="offer-details-title blue2  bold text-center">
                            ΣΥΝΟΛΟ
                          </div>
                          <?php
                          if (!$isService) {
                            if ($qty != 0 && $cost != 0) { $total = ($cost * $qty) + $cash + $shipping; }
                            elseif ($qty == 0 && $cost != 0) { $total = $cost + $cash + $shipping; }
                            else { $total = 0; }
                          }
                          else {
                            if ($qty != 0 && $cost != 0) { $total = ($cost * $qty); }
                            elseif ($qty == 0 && $cost != 0) { $total = $cost; }
                            else { $total = 0; }
                          }
                          ?>
                          <div class="offer-details-data blue2 bold text-center">
                            <?php if ($total != 0) { ?>
                              &euro;<?php echo $total; ?>
                            <?php } else { ?>
                              Χωρίς τιμή
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> <!-- offer-info-transform"-->
                </div>


                <div class="offer-options-transform">
                  <div class="offer-options-shape white2-bg _options-bg vertical">

                    <?php

                    $active = "inactiveOffer";
                    if ($status == 'active') {
                      $active = "activeOffer";
                    }?>
                    <div class="option-cell-transform <?php echo $active;?>">
                      <div class="option-cell-shape white text-center">
                        <a href="#"  class="completeOffer">
                          <div class="option-button-transform">
                            <div class="option-button-shape">
                              <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/handshake.svg"/>
                            </div>
                          </div>


                          <div class='option-button-title  semi-bold blue'>
                            ΟΛΟΚΛΗΡΩΣΗ
                          </div>
                        </a>

                      </div>
                    </div> <!-- Single cell -->



                    <div class="option-cell-transform <?php echo $active;?>">
                      <div class="option-cell-shape white text-center  offer-intrested">
                        <a href="#" data-action="offer-intrested"  class="buyer-offer-actions">
                          <div class="option-button-transform">
                            <div class="option-button-shape">
                              <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/interest.svg"/>
                            </div>
                          </div>

                          <div class='option-button-title  semi-bold blue'>
                            <?php if ($offer['inquiry_seller_interesting'] == 1) { ?>
                              <span class="glyphicon"></span>
                              ΔΕΝ EΝΔΙΑΦΕΡΟΜΑΙ
                            <?php } else { ?>
                              <span class="glyphicon"></span>
                              EΝΔΙΑΦΕΡΟΜΑΙ
                            <?php } ?>

                          </div>
                        </a>
                      </div>
                    </div> <!-- Single cell -->


                    <div class="option-cell-transform <?php echo $active;?>">
                      <div class="option-cell-shape white text-center offer-ignore">
                        <a href="#" data-action="ignoreOffer" class="buyer-offer-actions">
                          <div class="option-button-transform">
                            <div class="option-button-shape">
                              <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/deny.svg"/>
                            </div>
                          </div>

                          <div class='option-button-title  semi-bold blue'>
                            ΑΠΟΡΙΨΗ
                          </div>
                        </a>
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
                <div class="offer-summary-label-shape white-bg blue bold  _shadow_3">

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

                  <div class="offer-details-transform hidden">
                    <div class="offer-details-shape white2-bg">
                      <div class="row bold">
                        <div class="col-xs-4 offer-details-col">
                          <div class="offer-details-title black text-center">
                            ΠΟΣΟΤΗΤΑ
                          </div>

                          <div class="offer-details-data aqua text-center">
                            20
                          </div>
                        </div>

                        <div class="col-xs-4 offer-details-col">
                          <div class="offer-details-title black text-center">
                            ΤΙΜΗ ΑΠΟ
                          </div>
                          <div class="offer-details-data aqua text-center">
                            $10
                          </div>
                        </div>

                        <div class="col-xs-4 offer-details-col">
                          <div class="offer-details-title black text-center">
                            ΤΙΜΗ ΕΩΣ
                          </div>
                          <div class="offer-details-data aqua text-center">
                            $10
                          </div>
                        </div>

                      </div>
                    </div>
                  </div> <!-- offer-info-transform"-->

                </div>
              </div>
            </div>
          </div> <!-- offer-summary-transform-->

        </div><!-- <div class="col-xs-12 col-md-6 col-lg-4" id="offer-summary"> -->

          <div class="col-xs-12 col-md-6 col-lg-8" id="offer-chat">

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
                  if (!empty($messages['thread'])) {
                    //  echo '<h1> a:'.empty($messages['thread']).'</h1>';
                    $classSeller="client left ";
                    if (is_buyer(intval( $messages['thread']->user_id)))
                    {
                      $classSeller="seller right ";
                    }

                    include(dirname(__FILE__).'/single-thread.php');
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
                        include(dirname(__FILE__).'/single-comment.php');
                      }
                      else {
                        include(dirname(__FILE__).'/../sellers/single-comment.php');
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










          <script type="text/javascript">
            jQuery("#comment-reply form").submit(function(e) {
              e.preventDefault();

              jQuery.ajax({
                type : "post",
                url : ajaxurl,
                data : { action: "postComment", thread : jQuery('input[name="thread"]').val(), text: jQuery('textarea[name="comment_message"]').val(), post : jQuery("input[name='post']").val(), seller: '<?php echo $_REQUEST['seller']; ?>' },
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

            jQuery(".btnAddSellerBlacklist").live("click", function(e) {
              e.preventDefault();
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
                    window.location.reload();
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

              jQuery("#seller_rating-transform").removeClass("hidden");

            });

            //rating_close-window

            jQuery(".rating_close-window ").click(function(e) {

              //seller_rating-transform
              e.preventDefault();

              jQuery("#seller_rating-transform").addClass("hidden");

            });

            jQuery(".btnAddSeller").live("click", function(e) {
              e.preventDefault();
              var seller = jQuery(this).attr('data-seller');
              jQuery.ajax({
                'type'	: 'post',
                'url'	:	ajaxurl,
                'data'	:	{
                  action	:	'addToMySellers',
                  seller	:	seller,
                },
                success: function(response) {
                  var result = JSON.parse(response);
                  if (result.status == 0) {
                    alert(result.message);
                    window.location.reload();
                  }
                  else {
                    alert(result.message);
                  }
                }
              });
              return false;
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
              //  alert("def");
                return false;
                break;
              }

              var rating = jQuery("input[name=seller-rating]:checked").val();
          //    alert(rating);
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
                    /*not used anymore
                    jQuery(result.message).appendTo("body");
                    jQuery(".body_mask").show();
                    jQuery("#rankInquiry").show();
                    jQuery("#rankInquiry button").live("mouseover", function() {
                    jQuery(this).find(".glyphicon").removeClass("glyphicon-star-empty").addClass("glyphicon-star");
                  });
                  jQuery("#rankInquiry button").live("mouseout", function() {
                  jQuery(this).find(".glyphicon").removeClass("glyphicon-star").addClass("glyphicon-star-empty");
                });

                jQuery("#rankInquiry button").live("click", function(e) {
                var value = jQuery(this).val();
                jQuery.ajax({
                'type'	: 'post',
                'url'	:	ajaxurl,
                'data'	:	{
                action	:	'rankSeller',
                inquiryId	:	'<?php echo $post->ID; ?>',
                seller			:	'<?php echo $_REQUEST['seller']; ?>',
                val				:	value
              },
              success: function(response) {
              var result = JSON.parse(response);
              if (result.status == 0) {
              jQuery("#rankInquiry").html(result.message);
              jQuery("#rankInquiry").delay(1500).fadeOut();
              jQuery(".body_mask").delay(1500).fadeOut();
              alert(result.message);
              window.location.reload();
            }
            else {
            alert(result.message);
            return false;
          }
        }
      });
    });
    */
    alert(result.message);
    window.location.reload();
  }
  else {
    alert(result.message);
    return false;
  }
}
});
});
</script>
