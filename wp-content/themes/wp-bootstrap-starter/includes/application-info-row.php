<?php
  $service_hidden = "";

if ($isService) { $offer['inquiry_seller_quantity'] = 1;

  $service_hidden = "hidden";
}
$total = (number_format((float)$offer['inquiry_seller_quantity'], 2, '.', '') * number_format((float)$offer['inquiry_seller_unit_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_cashondelivery_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_delivery_cost'], 2, '.', '') );
$ranking_price= number_format($total,2);//.'€';
?>

<div class="single-open_application_list-transform" data-seller="<?php echo $offer['inquiry_seller']['ID']; ?>" data-ranking="<?php echo $ranking_price;?>">
  <div class="single-open_application_list-shape white-bg radius2 shadow _overflow-hidden">
    <?php if(  $make_interesting_btn ==1)
    {
      ?>


    <div class="make_interesting-transform">
      <div class="make_interesting-shape make_interesting_btn  pointer" data-wenk="Μπορείς να σύρεις και να προσθέσεις (drag & drop) τις Λοιπές Προσφορές που προτιμάς στη λίστα με τις Ενδιαφέρουσες." data-wenk-pos="left">
        <i class="material-icons md-24 _md-dark favorite_icon">favorite</i>
      </div>
    </div>

    <?php
    }
  ?>
    <div class="_col-xs-12 _col-md-5 horizontal-bar-cols vertical-mid">


      <?php if(isset($i))
      {
        echo $i;
      }
?>

        <div class="open_application_list-sender-transform horizontal-bar-cols vertical-mid">
          <div class="open_application_list-sender-shape bold black">
            <div class="open_application_list-avatar-transform _horizontal-bar-cols text-center vertical-mid">
              <div class="open_application_list-avatar-shape circle">
              <!--  <img src="images/avatars/pb.svg" />-->
                 <a href="<?php echo SELLER_PROFILE.$offer['inquiry_seller']['ID'];?>" target="_blank">
                <?php  
                     echo getCustomAvatar($offer['inquiry_seller']['ID'],true);

                //get_avatar($offer['inquiry_seller']['ID']); ?>
              </a>
              </div>
            </div>


            <?php
              $user = 'user_'.$offer['inquiry_seller']['ID'];
              $path = get_template_directory().'/includes/seller/rating.php';
            //  echo $path;
            	include($path);


              ?>

          </div>
        </div>

        <div class="offer-list-seller-name">
          <div class="offer-list-seller-name-shape _white4-bg">

            <a class="black2" href="<?php echo SELLER_PROFILE.$offer['inquiry_seller']['ID'];?>" target="_blank">
              <?php echo get_field('seller_companyName','user_'.$offer['inquiry_seller']['ID']); ?>
            </a>
          </div>
        </div>

        <div class="clearer hidden-md hidden-lg">

        </div>

        <div class="open_application_list-info-transform horizontal-bar-cols vertical-mid hidden-xs hidden-sm">
          <div class="open_application_list-info-shape black3">

            <div class="info-image-transform">
              <div class="info-image-shape">
                <img src='<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/info1.svg' />
              </div>
            </div>

            <div class="info-title-transform">
              <div class="info-title-shape black">
                <div class="bold">
                  Τελευταία Προσφορά
                </div>
                <div class=''>
                  <?php echo  date('d-m-Y', strtotime($offer['inquiry_seller_actiondate']));?>
                </div>
              </div>
            </div>

          </div>
        </div>

        <?php //

          if(isset($offer['inquiry_seller_lastmessage']) )
          {
            if($offer['inquiry_seller_lastmessage'] !="")
            {
              ?>


              <div class="open_application_list-info-transform horizontal-bar-cols vertical-mid hidden-xs hidden-sm hidden">
                <div class="open_application_list-info-shape black3">

                  <div class="info-image-transform">
                    <div class="info-image-shape">
                      <img src='<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/info2.svg' />
                    </div>
                  </div>

                  <div class="info-title-transform ">
                    <div class="info-title-shape black">
                      <div class="bold">
                        Τελευταία Απάντηση
                      <div class=''>
                        <?php echo  date('d-m-Y', strtotime($offer['inquiry_seller_lastmessage']));?>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
              <?php
            }
          }
        ?>


      </div>

      <div class="clearer  hidden hidden-sm hidden-md hidden-lg">

      </div>

      <div class="_col-xs-12 _col-md-7 right offer_box_summary _text-right horizontal-bar-cols vertical-mid">
        <div class="application-offer-transform  no-margin-left vertical-mid">
          <div class="application-offer-shape blue offers-row-options action-box">


            <!-- options -->


            <!-- end options -->



            <div class="application-offer-info-transform horizontal-bar-cols vertical-mid <?php echo $service_hidden;?>">
              <div class="application-offer-info-shape ">

                <div class="offer-main-transform black _grey1">



                  <div class="offer-main-row row ">
                    <div class="left offer-main-row-title grey">
                      Ποσότητα
                    </div>
                    <div class="left bold text-right black2 bold price-cell">
                      <?php echo (isset($offer['inquiry_seller_quantity']) ? $offer['inquiry_seller_quantity'] : NULL); ?>
                    </div>
                  </div>

                  <div class="offer-main-row row row_top  ">
                    <div class="left offer-main-row-title grey">
                      Μονάδα
                    </div>
                    <div class="left bold text-right black2 bold price-cell ">
                      <?php echo (isset($offer['inquiry_seller_unit_cost']) ? str_replace(",","",number_format($offer['inquiry_seller_unit_cost'],2)) : NULL); ?> €

                    </div>
                  </div>


                </div>

              </div>
            </div>





            <div class="application-offer-info-transform horizontal-bar-cols vertical-mid <?php echo $service_hidden;?>">
              <div class="application-offer-info-shape">

                <div class="offer-main-transform black _grey1">

                  <div class="offer-main-row row row_top ">
                    <div class="left offer-main-row-title grey">
                      Μεταφορικά
                    </div>
                    <div class="left bold text-right bold price-cell">
                      <?php// echo (isset($offer['inquiry_seller_delivery_cost']) ? number_format($offer['inquiry_seller_delivery_cost'],2) : 0); ?>
                      <?php
                      if(!isset($offer['inquiry_seller_delivery_cost']) ||  $offer['inquiry_seller_delivery_cost'] == "")
                      {
                        $anti = "0.00";

                      }else {
                          $anti =  number_format($offer['inquiry_seller_delivery_cost'],2);
                      }

                      echo str_replace(",","",$anti);?> €
                    </div>
                  </div>

                  <div class="offer-main-row row">
                    <div class="left offer-main-row-title grey">
                      Αντικαταβολή
                    </div>
                    <div class="left bold text-right bold price-cell">
                      <?php
                      if(!isset($offer['inquiry_seller_cashondelivery_cost']) ||  $offer['inquiry_seller_cashondelivery_cost'] == "")
                      {
                        $anti = "0.00";

                      }else {
                          $anti = number_format($offer['inquiry_seller_cashondelivery_cost'],2);
                      }

                      echo $anti;?> €
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="clearer hidden hidden-sm hidden-md hidden-lg">

            </div>

            <div class="application-offer-info-transform horizontal-bar-cols vertical-mid offer-total-transform">
              <div class="application-offer-info-shape bold text-left">
                <div class="offer-total-title black">
                  Σύνολο
                </div>
                <div class="offer-total-price black">
                  <?php
                  if ($isService) { $offer['inquiry_seller_quantity'] = 1; }
                  $total = (number_format((float)$offer['inquiry_seller_quantity'], 2, '.', '') * number_format((float)$offer['inquiry_seller_unit_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_cashondelivery_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_delivery_cost'], 2, '.', '') );
                  echo str_replace(",","",number_format($total,2)).' €';
                  ?>
                </div>
              </div>
            </div>

            <div class="open_application_list-options_button-transform horizontal-bar-cols vertical-mid">

              <div class="action_button">
                <a class="" href="<?php echo get_permalink($post->ID)?>?seller=<?php echo $offer['inquiry_seller']['ID']; ?>">
                  <div class="action_button_shape shadow aqua-bg white3 radius4">
                      ΕΙΣΟΔΟΣ
                  </div>
                </a>
              </div>
            </div>
          </div>






        </div>



    </div>
    <div class='clearer'>

    </div>
  </div>


</div><!--single-message-transform-->
