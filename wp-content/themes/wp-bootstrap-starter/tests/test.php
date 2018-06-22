<div id="application_offer_price" class="blue-bg">

<div class=" col-xs-12 col-md-12 col-lg-9 text-right offer_container_col">


  <div class="application_filters-transform">

    <div class="application_filters-shape">

<?php

      $qty  = (isset($offer['inquiry_seller_quantity']) ? $offer['inquiry_seller_quantity'] : 0);
      $cost = (isset($offer['inquiry_seller_unit_cost']) ? $offer['inquiry_seller_unit_cost'] : 0);
    //  $shipping = (isset($offer['inquiry_seller_delivery_cost']) ? $offer['inquiry_seller_delivery_cost'] : 0);


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

  //    $cash = (isset($offer['inquiry_seller_cashondelivery_cost']) ? $offer['inquiry_seller_cashondelivery_cost'] : 0);

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



      <div class="offer_details-transform inline-block middle">


        <div class="offer-section-title black bold newapplication_headtitle inline-block vertical-top hidden">
          <i class="material-icons md-24">local_offer</i> <?php echo  $offer_section_title;?>
        </div>

        <div class="offer_details-shape inline-block vertical-top">




          <div class="single-offer-detail-transform <?php echo $hide_offer_fields;?>">
            <div class="offer-details-title white2 text-center bold">

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
            <div class="offer-details-data white2 text-center bold">
              &euro;<?php echo (isset($offer['inquiry_seller_unit_cost']) ? $offer['inquiry_seller_unit_cost'] : NULL); ?>
            </div>
          </div>
          <?php
          $hidden="";

            if($isService)
              {

                $hidden="hidden";

              }
            ?>

          <div class="single-offer-detail-transform <?php echo $hidden;?> <?php echo $hide_offer_fields;?>">
            <div class="offer-details-title white2 text-center bold">
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
          }?>

            </div>



            <div class="offer-details-data white2 text-center bold">
              <?php echo (isset($offer['inquiry_seller_quantity']) ? $offer['inquiry_seller_quantity'] : NULL); ?>
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
            <div class="offer-details-title white2 text-center _bold">
              Μεταφορικά
            </div>
            <div class="offer-details-data white2 text-center bold">


               <?php echo $shipping;?> &euro;
              <?php// echo (isset($offer['inquiry_seller_delivery_cost']) ? number_format($offer['inquiry_seller_delivery_cost'],2) : NULL); ?>
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
            <div class="offer-details-title white2 text-center _bold">
              Αντικαταβολή
            </div>
            <div class="offer-details-data white2 text-center bold">


               <?php echo $cash;?> &euro;

            <?php// echo (isset($offer['inquiry_seller_cashondelivery_cost']) ? number_format($offer['inquiry_seller_cashondelivery_cost'],2) : NULL); ?>
            </div>
          </div>


          <div class="single-offer-detail-transform <?php echo $hidden;?>">
            <div class="offer-details-title white2 text-center bold">
              Σύνολο
            </div>
            <div class="offer-details-data yellow text-center bold">
              <?php if ($total != 0) { ?>
                &euro;<?php echo number_format($total,2); ?>
              <?php } else { ?>
                Χωρίς τιμή
              <?php } ?>
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


                <div class='option-button-title  _semi-bold grey'>
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

                <div class='option-button-title  _semi-bold grey'>
                  Favourite
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

                <div class='option-button-title   grey'>
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

  </div>
</div>

</div>
