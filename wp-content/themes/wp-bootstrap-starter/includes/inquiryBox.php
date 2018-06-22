<?php $inq_status = get_field('inquiry_status',$request->ID) ;//!= 'complete'?>

<?php
$succeeded = "";

 if(is_array($offers['succeeded']) && sizeof($offers['succeeded']) > 0)
{
  //  $pendingClass = "";
  if(is_seller())
  {
    if($offers['succeeded'][0]['inquiry_seller']['ID'] == get_current_user_id())
    {
      $succeeded = "inquiry_succeeded seller_succeeded";

    }

  }else {
    $succeeded = "inquiry_succeeded";
  }

}else {




}?>

<div class="col-xs-12 col-md-6 col-lg-3 single_open_appliacation-col request_root <?php echo $pendingClass.' '.$succeeded;?>">

  <?php

  $closed_state= "";

  if(isset($state))
  {
    $closed_state = $state;
  }?>

  <div class="single_open_application-transform <?php echo $closed_state;?>">

    <div class="quick-read-content-transform ">
      <div class="quick-read-content-shape ">
        <?php echo $request->post_content; ?>
      </div>
    </div>



    <div class="single_open_application-shape _radius4 shadow ">



      <div class='single_appllication_top-transform'>
        <div class='single_appllication_top-shape   white4-bg'>


          <div class="col-xs-12 application-ended ">
            <div class="text-left appl-info-bottom">
              <div class="   black  _condensed inline-block middle">


                <?php if(  $closed_state != "")
                {
                  ?>  Έκλεισε

                  <?php
                }else {

                  ?>
                  Ανοικτό έως
                  <?php
                }
                ?>
                <span class="blue"><?php echo get_field('inquiry_end_date',$request->ID); ?></span>

              </div>
              <?php  if(is_seller())
                {
                  ?>
              <div class=" margin_left-10  black  _condensed inline-block middle">

                Από
              </div>




                                <div class="user_avatar-transform inline-block middle">
                                  <div class="user_avatar-shape white">

                                    <div class="info-avatar-transform inline-block middle">
                                      <div class="avatar_16-shape circle white-bg">
                                          <?php echo getCustomAvatar($request->post_author,true);

                                        //  get_avatar($request->post_author,32); ?>

                                      </div>
                                    </div>

                                    <span class="inline-block middle blue">
<?php echo get_user_by('id',$request->post_author)->nickname; ?>
                                    </span>




                                  </div>
                                </div>

                              <?php } ?>
                              <div class="clearer">

                              </div>

              <?php/*AREAS*/ ?>
              <div class="right application_area-transform">
                <div class="text-right application_area-shape  _bold black  ">
                  <i class="material-icons md-24 yellow  ">room</i>
                  <?php
                  foreach($areas as $area)
                  {
                    echo get_post($area)->post_title;
                  }
                  ?>
                </div>
              </div>







              <?php if($totalOffersCount > 0 || is_seller()){

                ?>

                <div class="quick_read_group inline-block hidden">
                  <a class="blue" href="<?php echo get_permalink($request->ID); ?>">
                    <div class="quick-read-shape grey34">

                      <div class="quick-offers-button-transform">

                        <div class="quick-offers-button-shape _action_button_shape _shadow grey31  radius4 text-center ">
                          <i class="material-icons md-24 yellow">class</i>
                          <br>
                          <?php
                          if(is_seller() || $totalOffersCount == 1)
                          {
                            ?>
                            <span class="white2">Προσφορά</span>
                            <?php
                          }else {
                            ?>
                            <span class="white2">Οι Προσφορές</span>
                            <?php
                          }
                          ?>

                        </div>



                      </div>


                    </div>
                  </a>
                </div>
                <?php
              }
              ?>


              <?php if(isset($theoffer))
              {


                if($theoffer['inquiry_new_messages'][0] && $theoffer['inquiry_new_messages'][0] > 0)
                {
                  ?>
                  <div class="new-messages-transform ">
                    <div class="new-messages-shape yellow-bg white4 circle">
                      <?php
                      echo $theoffer['inquiry_new_messages'][0];
                      ?>
                    </div>

                    <div class="new_message_notify-transform">
                      <div class="new_message_notify-shape yellow-bg radius2">

                      </div>
                    </div>
                  </div>
                  <?php
                }
              }
              ?>




            </div>
          </div>

          <div class="clearer">

          </div>

          <div class='col-xs-12 open_application-left white4-bg'>


            <div class="appl-subtitle grey35 hidden">
              <!-- TEΧΝΟΛΟΓΙΑ/ΗΥ -->  <?php echo $categoriesText; ?>
            </div>
            <a href="<?php echo get_permalink($request->ID); ?>">
              <div class="appl-title black _condensed">

                <h3><?php echo $request->post_title; ?> <small class="grey6">(ref:<?php echo $request->ID;?>)</small> </h3>

              </div>


            </a>


            <?php

              if(!is_seller()) { // IS BUYER
              ?>


              <?php
              if($totalOffersCount > 0 && !isset($closed_offers)){ //OPEN REQUESTS
                ?>
                <div class="info-button-transform offer-info">
                  <div class="info-button-shape pointer circle white2-bg ">
                    <i class="material-icons md-24 blue open-btn">info</i>
                    <i class="material-icons blue  md-24 close-btn">highlight_off</i>
                  </div>
                </div>

                <div class="latest_messages-transform hidden info_container">
                  <div class="latest_messages-shape _shadow  white2-bg black info_animate_main">

                    <?php if ($inq_status == 'active') { ?>

                      <div class="single_latest_messages-transform best info_animate">
                        <div class="latest_messages-title blue-bg inline-block bold white info_animate">
                          <i class="material-icons md-18 white">local_offer</i>
                          Καλύτερη Προσφορά
                        </div>
                        <div class="single_latest_messages-shape inline-block info_animate">
                          <a href="<?php echo SELLER_PROFILE.$offers['best'][0]['inquiry_seller']['ID'];?>" target="_blank">


                            <div class='messages_title medium   light black'>
                              <span class="messages_date  ">
                                <?php echo  !empty($offers['best'][0]['inquiry_seller_actiondate'])?date('d-m-Y', strtotime($offers['best'][0]['inquiry_seller_actiondate'])):"";?>
                              </span>
                              <div class="info-avatar-transform inline-block middle">

                                    <div class="avatar_16-shape circle white-bg">
                                          <?php
                                           echo getCustomAvatar($offers['best'][0]['inquiry_seller']['ID'],true);
                                        //  get_avatar($offers['best'][0]['inquiry_seller']['ID'],16);?>
                                    </div>
                                                             </div>
                                <?php echo get_field('seller_companyName','user_'.$offers['best'][0]['inquiry_seller']['ID']); ?>
                              </div>
                            </a>
                          </div>
                        </div>

                      <?php } ?>






                      <?php
                      $offerDates = array();
                      $theOffers = get_field('inquiry_offers',$request->ID);

                      ?>
                      <?php
                      $b_offer_seller = "";
                      $b_offer_date ="";
                      if (!empty($theOffers)) { ?>

                        <?php
                        foreach ($theOffers as $off) {
                          $offerDates[] = $off['inquiry_seller_actiondate'];
                        }
                        $max = max(array_map('strtotime', $offerDates));
                        // 2012-06-11 08:30:49

                        foreach ($theOffers as $off) {

                          if (strtotime($off['inquiry_seller_actiondate']) == $max) {
                            $b_offer_seller =  get_field('seller_companyName','user_'.$off['inquiry_seller']['ID']);
                            $b_offer_date = date('d-m-Y', $max);
                            break;
                          }

                        }


                      }
                      ?>

                      <div class="single_latest_messages-transform info_animate">
                        <div class="latest_messages-title inline-block blue-bg white bold  info_animate">
                          <i class="material-icons md-18 white">chat_bubble</i>
                          Τελευταία Προσφορά
                        </div>
                        <div class="single_latest_messages-shape inline-block info_animate">
                            <a href="<?php echo SELLER_PROFILE.$off['inquiry_seller']['ID'];?>" target="_blank">


                            <div class='messages_title medium   black '>
                              <span class="messages_date   "> <?php	echo $b_offer_date ; ?> </span>



                              <div class="info-avatar-transform inline-block middle">

                                    <div class="avatar_16-shape circle white-bg">
                                          <?php
                                             echo getCustomAvatar($off['inquiry_seller']['ID'],true);
                                        //  get_avatar( $off['inquiry_seller']['ID'],16);?>
                                    </div>
                                                      </div>
                                <?php echo   $b_offer_seller; ?>
                              </div>
                            </a>
                          </div>
                        </div>





                      </div>
                    </div>

                  <?php }else if(isset($closed_offers)) // IS BUYER AND CLOSED
                  {
                    ?>


                    <?php
                  }
                }
                ?>

              </div>

              <div class="col-xs-12 relative white3-bg">

                            <?php
                          //  if((is_seller() || $totalOffersCount < 1) ) //&& ( $totalsellersCost<1)
                          //  {
                            ?>








                            <div class="inline-block open_application-top-bottom">
                              <div class="  _circle grey34 2-bg inline-block" data-title="Διάλογοι">
                                <div class="text-center totalOffers-shape-number blue ">

                                  <?php if(!$isService && get_field('inquiry_product_quantities',$request->ID) != 0)
                                  {
                                    ?>
                                    <div class="inline-block price_margin">
                                    <span class="grey32 ">  Ποσότητα </span>  <div class="info_text bold blue inline-block">

                                      <?php if (get_field('inquiry_product_quantities',$request->ID) != 0) {
                                        echo get_field('inquiry_product_quantities',$request->ID);
                                      }?>
                                    </div>


                                    </div>
                                    <?php
                                  }
                                  ?>
                                  <?php
                                    $min_p =   get_field('inquiry_min_price',$request->ID) ;
                                    $max_p = get_field('inquiry_max_price',$request->ID);

                                    if($min_p !="-2100")
                                    {

                                      if ($min_p != -1)
                                    {?>
                                      <div class="inline-block price_margin">
                                      <span class="grey32 ">  Από </span>  <div class="info_text bold grey31 inline-block">

                                      <?php
                                      echo $min_p;?>  &euro;
                                    </div>


                                      </div>
                                      <?php
                                    }
                                    ?>


                                    <?php


                                    if ($max_p != 0)
                                    {?>
                                      <div class="inline-block price_margin">
                                        <span class="grey32 ">  Έως </span> <div class="info_text bold inline-block grey31">

                                      <?php
                                      echo $max_p;
                                  ?>   &euro; </div>
                                    </div>


                          <?php  }
                        }else {


                          ?>

                          <div class="inline-block price_margin">
                            <div class="info_text _bold inline-block blue">
                              Δίχως εύρος τιμών
                        </div>
                          </div>

                          <?php
                        }
                              ?>



                                  </div>
                                </div>


                              </div>
                            <?php                  //  }?>


                            <?php

                            if(is_seller())
                            {
                              ?>

                              <div class="offer-link-transform inline-block middle">
                                <a class="white" href="<?php echo get_permalink($request->ID); ?>">
                                  <div class="offer-link-shape pointer blue-bg">

                                    <i class="material-icons white md-18 inline-block middle">description</i>
                                    <span class="inline-block middle">Προσφορά</span>



                                  </div>
                                </a>
                              </div>

                              <?php
                            }?>
              </div>



              <div class="clearer">

              </div>

            </div>
          </div>

          <div class="clearer"></div>



          <div class="single_appllication_bottom-transform">
            <div class="single_appllication_bottom-shape white-bg  applications_cards action-box">


              <div class='options-wrapper'>
                <div class="options-box-transform ">
                  <div class="options-box-shape  white2-bg _options-bg vertical buyer-actions">

                    <div class="arrow_cell-transform">
                      <div class="arrow_cell-shape options-back-button">


                        <i class="material-icons md-36 blue">keyboard_arrow_right</i>
                      </div>
                    </div>




                    <?php

                    if(is_seller())
                    {
                      ?>

                      <?php if ($inq_status != 'complete')
                      { ?>




                        <div class="option-cell-transform">
                          <div class="option-cell-shape white text-center action deleteInquiryConfirm" data-value="<?php echo $request->ID; ?>">

                            <div class="option-button-transform">
                              <div class="option-button-shape">
                                <i class="material-icons md-24 red">no_sim</i>
                              </div>
                            </div>

                            <div class='option-button-title _condensed _semi-bold grey3'>
                              Aπόριψη
                            </div>

                          </div>
                        </div> <!-- Single cell -->

                        <div class="option-cell-transform-confirm hidden">
                          <div class="option-cell-shape white text-center action ">

                            <div class="delete-confirm-transform inline-block">
                              <div class="delete-confirm-shape black3 bold">
                                Είστε σίγουροι για την Aπόριψη;
                              </div>
                            </div>

                            <div class="confirm-options inline-block">

                              <div class="single-confirm-options inline-block ignoreInquiry"  data-value="<?php echo $request->ID; ?>">
                                <div class="option-button-transform">
                                  <div class="option-button-shape">
                                    <i class="material-icons md-24 red">no_sim</i>
                                  </div>
                                </div>

                                <div class='option-button-title _condensed _semi-bold grey3'>
                                  Aπόριψη
                                </div>
                              </div>

                              <div class="single-confirm-options inline-block canceldeleteInquiry">
                                <div class="option-button-transform">
                                  <div class="option-button-shape">
                                    <i class="material-icons md-24 blue">block</i>
                                  </div>
                                </div>

                                <div class='option-button-title _condensed _semi-bold grey3'>
                                  Ακύρωση
                                </div>
                              </div>

                            </div>



                          </div>
                        </div> <!-- Single cell -->

                      <?php } ?>

                      <?php
                    }else {

                      if($totalOffersCount > 0){

                        ?>

                        <div class="option-cell-transform">
                          <div class="option-cell-shape white text-center action">

                            <div class="option-button-transform">
                              <div class="option-button-shape btnGenerateCert" data-postid="<?php echo $request->ID; ?>">

                                <i class="material-icons md-24 blue">new_releases</i>
                              </div>
                            </div>

                            <div class='option-button-title _semi-bold grey3'>
                              Πιστοποιητικό
                            </div>

                          </div>
                        </div> <!-- Single cell -->
                      <?php }
                      ?>

                      <?php if ($inq_status != 'complete')
                      { ?>


                        <?php if(!isset($closed_offers)){
                          ?>



                          <div class="option-cell-transform ">
                            <div class="option-cell-shape white text-center action updateInquiry" data-value="<?php echo $request->ID; ?>">

                              <div class="option-button-transform">
                                <div class="option-button-shape">
                                  <i class="material-icons md-24 blue">autorenew</i>
                                </div>
                              </div>

                              <div class='option-button-title _condensed  _semi-bold grey3'>
                                Ανανέωση
                              </div>

                            </div>
                          </div> <!-- Single cell -->


                          <div class="option-cell-transform">
                            <div class="option-cell-shape white text-center action deleteInquiryConfirm" >

                              <div class="option-button-transform">
                                <div class="option-button-shape">
                                  <i class="material-icons md-24 red">no_sim</i>
                                </div>
                              </div>

                              <div class='option-button-title _condensed _semi-bold grey3'>
                                Διαγραφή
                              </div>

                            </div>
                          </div> <!-- Single cell -->

                          <div class="option-cell-transform-confirm hidden">
                            <div class="option-cell-shape white text-center action " data-value="<?php echo $request->ID; ?>">

                              <div class="delete-confirm-transform inline-block">
                                <div class="delete-confirm-shape black3 bold">
                                  Είστε σίγουροι για την διαγραφή;
                                </div>
                              </div>

                              <div class="confirm-options inline-block">

                                <div class="single-confirm-options inline-block deleteInquiry" data-value="<?php echo $request->ID; ?>">
                                  <div class="option-button-transform">
                                    <div class="option-button-shape">
                                      <i class="material-icons md-24 red">no_sim</i>
                                    </div>
                                  </div>

                                  <div class='option-button-title _condensed _semi-bold grey3'>
                                    Διαγραφή
                                  </div>
                                </div>

                                <div class="single-confirm-options inline-block canceldeleteInquiry">
                                  <div class="option-button-transform">
                                    <div class="option-button-shape">
                                      <i class="material-icons md-24 blue">block</i>
                                    </div>
                                  </div>

                                  <div class='option-button-title _condensed _semi-bold grey3'>
                                    Ακύρωση
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div> <!-- Single cell -->
                          <?php
                        }
                        ?>
                      <?php }

                    }?>



                  </div>
                </div>
              </div>




              <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 open_application-bottom-right _condensed text-left'>

                <div class="row">


                    <?php/// if(sizeof($offers['succeeded']) < 1)
                //    {
                      ?>

                  <div class="inline-block totalOffers-transform">

                    <div class="quick_read_group inline-block">
                      <div class="quick-read-shape grey34">

                        <div class="quick-read-button-transform">

                          <div class="quick-read-button-shape _action_button_shape _shadow grey31  pointer radius4 text-center ">
                            <i class="material-icons md-24  blue">pageview</i>
                            <br>
                            <span class="grey34">Το Αίτημα</span>
                          </div>



                        </div>


                      </div>
                    </div>
                  </div>

                  <?php

                  if($isHotel)
                  {
                     $inquiry_persons_quantities = get_field('inquiry_persons_quantities',$request->ID);
                     $inquiry_children_quantities= get_field('inquiry_children_quantities',$request->ID);

                     $inquiry_hotel_start_date = get_field('inquiry_hotel_start_date',$request->ID);
                     $inquiry_hotel_end_date= get_field('inquiry_hotel_end_date',$request->ID);
                     //inquiry_hotel_start_date
                    //inquiry_persons_quantities
                    ?>

                    <div class="inline-block totalOffers-transform ">
                      <div class="totalOffers-shape _circle grey34 -bg inline-block" data-title="">
                        <div class="text-center totalOffers-shape-number blue ">
                          <div class="text-left hotel_data_bottom">
                            <i class="material-icons blue inline-block middle  " data-wenk="Ενήλικες" data-wenk-pos="left">face</i> <span class="grey34 bold"><?php echo $inquiry_persons_quantities;?></span>
                            <?php
                              if(isset($inquiry_children_quantities) && $inquiry_children_quantities>0)
                              {
                                ?>

                             <i class="material-icons blue inline-block middle  "  data-wenk="Ανήλικοι" data-wenk-pos="left">child_friendly</i> <span class="grey34 bold"><?php echo $inquiry_children_quantities;?></span>
                             <?php
                             }
                           ?>
                          </div>

                          <div class="text-left hotel_data_bottom">
                            <i class="material-icons blue inline-block middle  " data-wenk="Check in-out" data-wenk-pos="left">date_range</i>
                            <span class="grey34"><?php echo $inquiry_hotel_start_date .'-- '.$inquiry_hotel_end_date ;?></span>

                          </div>



                          </div>
                        </div>
                      </div>

                <?php

                  }


                   ?>

  <?php // } ?>

                      <?php
                      if(is_seller())
                      {?>

                        <?php


                        if( $totalsellersCost>0){
                          ?>
                          <div class="inline-block totalOffers-transform">
                            <div class="totalOffers-shape _circle grey34 -bg inline-block" data-title="Προσφορές">
                              <div class="text-center totalOffers-shape-number blue ">

                                <span class="info_text bold">
                                  <?php
                                    echo $totalsellersCost;
                                  ?></span>
                                  <br/>

                                  <span class="grey34 _light">Προσφορά</span>

                                </div>
                              </div>
                            </div>
                        <?php
                        } ?>







                        <?php

                      }

?>



<?php
                      if(!is_seller())
                      {
                        ?>

                        <?php
                        if(isset($closed_offers))
                        {


                          if(sizeof($offers['succeeded'])>0)
                          {
                            ?>

                            <div class="inline-block totalOffers-transform">
                              <div class="totalOffers-shape _circle grey34 -bg inline-block" data-title="Προσφορές">
                                <div class="text-center totalOffers-shape-number yellow ">
                                  <div class="info-avatar-transform inline-block middle">
                                    <div class="avatar_32-shape circle white-bg">
                                        <a class="black2" href="<?php echo SELLER_PROFILE.$offers['succeeded'][0]['inquiry_seller']['ID'];?>" target="_blank">
                                      <?php
                                         echo getCustomAvatar($offers['succeeded'][0]['inquiry_seller']['ID'],true);
                                         //get_avatar($offers['succeeded'][0]['inquiry_seller']['ID'],32); ?>
                                    </a>
                                    </div>
                                  </div>

                                  <br/>

                                  <span class="grey34 _light">
                                    <a class="black2" href="<?php echo SELLER_PROFILE.$offers['succeeded'][0]['inquiry_seller']['ID'];?>" target="_blank">


                                  <?php
                                  echo   get_field('seller_companyName',"user_".$offers['succeeded'][0]['inquiry_seller']['ID']);
                                  ?>

                                </a>
                                </span>

                                </div>
                              </div>
                            </div>


                            <?php

                            $quantity =   1;
                            if(!$isService && $quantity==-666)
                            {
                            $quantity =   $offers['succeeded'][0]['inquiry_seller_quantity'];
                              ?>
                              <div class="inline-block totalOffers-transform">
                                <div class="totalOffers-shape _circle grey34 -bg inline-block" data-title="Προσφορές">
                                  <div class="text-center totalOffers-shape-number blue ">

                                    <span class="info_text bold">
                                      <?php
                                      //  var_dump($offers);

                                      echo $quantity ;

                                       ?>
                                      </span>
                                      <br/>

                                      <span class="grey34 _light">Ποσότητα</span>

                                    </div>
                                  </div>
                                </div>
                                <?php
                              }
                              ?>
                              <div class="inline-block totalOffers-transform">
                                <div class="totalOffers-shape _circle grey34 2-bg inline-block" data-title="Διάλογοι">
                                  <div class="text-center totalOffers-shape-number blue ">
                                    <span class="info_text bold">
                                      <?php
                                          $inquiry_seller_unit_cost = $offers['succeeded'][0]['inquiry_seller_unit_cost'] !=NULL ? $offers['succeeded'][0]['inquiry_seller_unit_cost']:0;
                                          $inquiry_seller_delivery_cost = $offers['succeeded'][0]['inquiry_seller_delivery_cost']!=NULL ? $offers['succeeded'][0]['inquiry_seller_delivery_cost']:0;
                                          $inquiry_seller_cashondelivery_cost =$offers['succeeded'][0]['inquiry_seller_cashondelivery_cost']!=NULL ? $offers['succeeded'][0]['inquiry_seller_cashondelivery_cost']:0;
                                          $totalCost =($inquiry_seller_unit_cost * $quantity )  +$inquiry_seller_delivery_cost + $inquiry_seller_cashondelivery_cost;

                                          echo  $totalCost;

                                       ?>
                                       &euro; </span> <br/>
                                      <span class="grey34 _light">Tελική Τιμή </span>

                                    </div>
                                  </div>


                                </div>
<?php
                          }

  ?>







                              <?php
                            }else {
                            if( $totalOffersCount > 0)
                              {

                              ?>
                              <div class="inline-block totalOffers-transform">


                                <div class="totalOffers-shape _circle grey34 -bg inline-block" data-title="Προσφορές">
                                  <div class="text-center totalOffers-shape-number black ">

                                    <a class="blue" href="<?php echo get_permalink($request->ID); ?>">
                                    <span class="info_text bold inline-block middle"><?php echo $totalOffersCount;?></span>
                                    <i class="material-icons blue md-18 inline-block middle">description</i>
                                    <br/>





                                          <?php
                                          if($totalOffersCount == 1)
                                          {
                                            ?>
                                            <span class="grey34">Προσφορά</span>
                                            <?php
                                          }else {
                                            ?>
                                            <span class="grey34">Προσφορές</span>
                                            <?php
                                          }
                                          ?>


                                        </a>




                                  </div>
                                </div>


                              </div>

                            <?php
                          }?>
                              <?php
                              $chats =  sizeof(getSellersRepliesForInquiry($request->ID));
                              if($chats > 0)
                              {
                                ?>
                                <div class="inline-block totalOffers-transform">
                                  <div class="totalOffers-shape _circle grey34 2-bg inline-block" data-title="Διάλογοι">
                                    <div class="text-center totalOffers-shape-number green ">
  <a class="blue" href="<?php echo get_permalink($request->ID); ?>">
                                      <span class="info_text bold inline-block middle"><?php echo $chats;?></span>
                                      <i class="material-icons green md-18 inline-block middle">chat_bubble</i>

                                      <br/>

                                      <span class="grey34 _light">Διάλογοι</span>
</a>
                                    </div>
                                  </div>
                                </div>
                                <?php
                              }
                              ?>
                              <?php
                            }
                            ?>

                            <?php
                          }

                          ?>
                          <?php   if(!isset($closed_offers) && is_seller())
                          //  {
                              ?>
                          <div class="options_button text-right right">
                            <div class="appl_options_button-transform">
                              <div class="options_button-shape">



                                <div class="options-dots-transform">
                                  <div class="options-dots-shape circle blue-bg">
                                    <!--
                                    <div class="options-dot-transform">
                                      <div class="options-dot-shape circle white-bg"></div>
                                    </div>

                                    <div class="options-dot-transform">
                                      <div class="options-dot-shape circle white-bg"></div>
                                    </div>

                                    <div class="options-dot-transform">
                                      <div class="options-dot-shape circle white-bg"></div>
                                    </div>
                                  -->
                                  <i class="material-icons md-24 black">more_vert</i>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>

                        <?php //} ?>

                        </div>
                      </div>


                      <div class="clearer"></div>
                    </div>
                  </div><!-- single_appllication_bottom-transform -->


                </div>
              </div><!--single_open_application -->
            </div> <!-- single_open_appliacation- -->
