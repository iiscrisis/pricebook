
<?php

?>






<div id="user_details" data-step="1" class="login-form  text-left account_page page_2 hidden">
  <div class="input_row black shadow radius2 text-left _inline-block general_info" id="general_info3">

    <div class="container">

      <div class="row text-left inline-block">



        <div class="col-xs-12 col-md-12  single_seller_form-transform inline-block text-center">
          <h3 class="text-left hidden  _white-bg blue"><i class="material-icons">account_circle</i> Στοιχεια Eπαγγελματία  </h3>



          <div class="single_seller_form-shape form-group inline-block text-left bold grey"  id="seller_details_area">
            <div class="input_label light black">
              email


            </div>

            <i class="material-icons grey5 md-18 middle">email</i>  <?php echo  $user_info->user_email ;?>

          </div>



          <div class="single_seller_form-shape form-group inline-block text-left bold grey"  id="seller_details_area">
            <div class="input_label light black">
              Διάρκεια Συνδρομής


            </div>

            <i class="material-icons grey5 md-18 middle">access_time</i>   <?php echo  $seller_details_renew_date; ?> μήνες

          </div>


          <div class="single_seller_form-shape form-group inline-block text-left bold grey"  id="seller_details_area">
            <div class="input_label light black">
              Λήγει


            </div>

            <i class="material-icons grey5 md-18 middle">date_range</i>     <?php echo  $seller_details_renew_date; ?>

          </div>

          <div class="single_seller_form-shape form-group inline-block text-left bold grey"  id="seller_details_area">
            <div class="input_label light black">
              Νομική μορφή


            </div>

            <i class="material-icons grey5 md-18 middle">account_balance</i>  <?php echo $seller_details_ctype ;?>

          </div>

          <div class="single_seller_form-shape form-group inline-block text-left bold grey"  id="seller_details_area">
            <div class="input_label light black">
              ΑΦΜ


            </div>

            <i class="material-icons grey5 md-18 middle">featured_play_list</i>  <?php echo $seller_details_afm ;?>

          </div>

          <div class="single_seller_form-shape form-group inline-block text-left bold grey"  id="seller_details_area">
            <div class="input_label light black">
              Τύπος παραστατικού


            </div>
            <i class="material-icons grey5 md-18 middle">receipt</i>
            <?php
            if($seller_details_receipt == 0)
            {
              ?>

              Τιμολόγιο
              <?php
            }else{
              ?>
              Απόδειξη Λιανικής
              <?php
            }
            ?>

          </div>
        </div>
      </div>
    </div>
  </div>




  <div class="input_row black shadow radius2 text-left white3-bg _inline-block general_info" id="general_info2">

    <div class="container">

      <div class="row">
        <div class="col-xs-12">
          <form id="password_change" method="post">
            <div class=" single_seller_form-transform text-left inline-block vertical-top">
              <div class="single_seller_form-shape form-group">

                <div class="input_label bold black">
                  Nέο Password
                </div>
                <div class="view_password pointer">
                  <i class="material-icons">remove_red_eye</i>
                </div>
                <input name="reg_pass" type="password" class="form-control login-field"
                value=""
                placeholder="Password" id="reg_pass" required/>
                <label class="login-field-icon fui-lock" for="reg-pass"></label>
                <meter max="4" id="password-strength-meter"></meter>
                <p id="password-strength-text"></p>
                <div class="help-block with-errors"></div>
              </div>

            </div>

            <div class=" single_seller_form-transform text-left inline-block">
              <div class="single_seller_form-shape form-group">

                <div class="input_label bold black">
                  Eπαληθευση
                </div>
                <div class="view_password pointer">
                  <i class="material-icons">remove_red_eye</i>
                </div>
                <input name="reg_pass2" type="password" class="form-control login-field"
                value=""
                placeholder="Password Επαλήθευση" id="reg_pass2" required/>
                <label class="login-field-icon fui-lock" for="reg-pass2"></label>
                <div class="help-block with-errors"></div>
                <div id="divCheckPasswordMatch">

                </div>
              </div>
            </div>
            <div class="clearer">

            </div>

            <div class=" single_seller_form-transform text-left inline-block">
              <div class="single_seller_form-shape form-group button_seller_form">
                <input type="submit" class="btn btn-success btn-send blue-bg" value="Aποθήκευση" name="reg_submit" />
              </div>
            </div>


          </form>

        </div>


      </div>



    </div>


  </div>


  <div class="input_row black shadow radius2 text-left blue-bg _inline-block general_info hidden" id="general_info4">

    <div class="container">

      <div class="row text-left inline-block">

        <?php


        $checked="";

        $counter++;

        $subscription_details = get_fields($seller_details_subscription_id_ID);

        $subscription_length = $subscription_details['subscription_length'];
        $subscription_type= $subscription_details['subscription_type'];
        $subscription_price= $subscription_details['subscription_price'];
        $subscription_description= $subscription_details['subscription_description'];
        $subscription_bg_color = $subscription_details['subscription_bg_color'];
        $subscription_image = $subscription_details['subscription_image'];

        ?>

        <div class="col-xs-12 col-md-12  single_seller_form-transform inline-block text-center">


          <h3 class="text-left white2  _white-bg "><i class="material-icons">account_circle</i> Στοιχεια Πακέτου</h3>

          <div class="single_seller_subscribe_form-shape form-group inline-block text-left bold grey"  id="seller_details_area">
            <div class="input_label light white4 bold">
              Πακέτο


            </div>

            <div class="sub_image-shape circle white-bg inline-block middle">
              <img src="<?php echo get_template_directory_uri() ;?>/<?php echo $subscription_image;?>" />
            </div>

            <div class="sub_title_title inline-block middle">
              <?php echo get_the_title($seller_details_subscription_id_ID) ;?>
            </div>

          </div>


          <div class="single_seller_subscribe_form-shape form-group inline-block text-left bold grey"  id="seller_details_area">
            <div class="input_label light white4 bold">
              Τιμή


            </div>

            <i class="material-icons grey5 md-18 middle">local_offer</i>    <span class="  bold"  style=""><?php echo $subscription_price;?>&euro;</span>

          </div>


          <div class="single_seller_subscribe_form-shape form-group inline-block text-left bold grey"  id="seller_details_area">
            <div class="input_label light white4 bold">
              Διάρκεια


            </div>

            <i class="material-icons grey5 md-18 middle">date_range</i>     <span class="black bold"><?php echo $subscription_length;?> μήνες</span>

          </div>


          <div class="subscription_details-transform hidden">
            <div class="subscription_details-shape">

              <div class="single_subscription_details-transform">
                <div class="single_subscription_details-shape">

                  <div class="sub_image-shape circle white-bg inline-block middle">
                    <img src="<?php echo get_template_directory_uri() ;?>/<?php echo $subscription_image;?>" />
                  </div>

                  <div class="sub_title_title inline-block middle">
                    <?php echo get_the_title($seller_details_subscription_id_ID) ;?>
                  </div>

                </div>
              </div>

              <div class="single_subscription_details-transform">
                <div class="single_subscription_details-shape">
                  <div class=" sub_price">
                    <div class=" grey inline-block text-center grey4">
                      <i class="material-icons "  style="color:<?php echo $subscription_bg_color;?>">local_offer</i>

                      Τιμή  <br/>
                      <span class="price  bold"  style="color:<?php echo $subscription_bg_color;?>"><?php echo $subscription_price;?>&euro;</span>
                    </div>

                  </div>
                </div>
              </div>

              <div class="single_subscription_details-transform">
                <div class="single_subscription_details-shape">
                  <div class="sub_length">
                    <div class=" grey inline-block text-center grey4">
                      <i class="material-icons grey4">date_range</i>
                      Διάρκεια :
                      <span class="black bold"><?php echo $subscription_length;?> μήνες</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="single_subscription_details-transform">
                <div class="single_subscription_details-shape">
                  <div class="sub_description light"><?php echo $subscription_description;?></div>
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>



    </div>
  </div>

  <div class="input_row black shadow radius2 text-left _inline-block general_info white4-bg" id="general_info5">

    <div class="container">

      <div class="row">
        <div class="col-xs-12">

          <h3 class="text-left   blue"><i class="material-icons">account_circle</i>Κατηγορίες</h3>

      <div id="categories_details" data-step="4" class="account_step text-center account_step_4">



        <div class="login-form  text-left _inline-block">



          <div class="">

            <div class="open_areas-transform inline-block">
              <div class="open_categories pointer bold blue-bg black radius4 shadow">
                <i class="material-icons middle md-32 black">add_circle_outline</i>  Προσθέστε Κατηγορία
              </div>

            </div>

            <div class="open_areas-transform inline-block">
              <div class="delete_categories pointer bold blue-bg black radius4 shadow">
                <i class="material-icons middle md-32 black">delete</i> Διαγραφή Όλων
              </div>

            </div>
          </div>


          <div class="clearer">

          </div>

          <form id="categories-form" method="post">

            <div id="cat_tmpl" class="hidden">
              <div class="single_selected_item-transform inline-block" data-cat="">
                <input class="hidden" type="checkbox" value="" name="" checked/>
                <div class="single_selected_item-shape shadow white-bg radius2">
                  <div class="delete_area-transform ">
                    <div class="delete_area-shape pointer">
                      <i class="material-icons md-24">delete_forever</i>
                    </div>
                  </div>


                  <div class="selected_item_title blue bold">

                  </div>
                  <div class="selected_item_parent grey3 ">

                  </div>

                </div>
              </div>
            </div>


            <div class="categories_container-transform">
              <div class="selected_cats text-left">

              <?php

              $subscription_cat = get_post($seller_details_subscription_id_ID);
              $subscription_root_category = @get_field("subscription_root_category",$subscription_cat->ID);

              $catsArray = get_field('seller_product_categories','user_'.get_current_user_id());
              $cat_filter_array = array();
              foreach($catsArray as $key=>$cat)
              {
                $cat_filter_array[get_post($cat)->post_parent] = get_post(get_post($cat)->post_parent)->post_title ;
                # code...
                //  array_push($cat_filter_array[get_post($cat)->post_parent],get_post(get_post($cat)->post_parent)->post_title);
                ?>
                <div class="single_selected_item-transform inline-block category_parent_<?php echo get_post($cat)->post_parent;?>" data-cat="<?php echo $cat;?>" id="cat<?php echo $cat;?>">
                  <input class="hidden" type="checkbox" value="<?php echo $cat;?>" name="cats[]" checked/>
                  <div class="single_selected_item-shape shadow white-bg radius2">
                    <div class="delete_area-transform ">
                      <div class="delete_area-shape pointer">
                        <i class="material-icons md-24">delete_forever</i>
                      </div>
                    </div>

                    <div class="selected_item_title blue bold">
                      <?php echo get_post($cat)->post_title ;?>
                    </div>
                    <div class="selected_item_parent grey3 ">
                      <?php echo get_post(get_post($cat)->post_parent)->post_title ;?>
                    </div>

                  </div>
                </div>

                <?php
                //    break;
              }
              //  echo getAccountSubcategories_html($subscription_root_category->ID);
              ?>
                </div>
              <div class="filter-selection-transform">
                <div class="filter-selection-shape">

                  <select id="filter_categories">
                    <option value="-1">
                      Όλα
                    </option>
                    <?php
                    foreach ($cat_filter_array as $key => $filter) {
                      # code...
                      ?>
                      <option id="cat_filter_<?php echo $key;?>" value="<?php echo $key;?>"><?php echo $filter;?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <input type="submit" name="submit_cats" class=" btn btn-success btn-send blue-bg" value="Αποθήκευση"/>
          </form>



        </div>


      </div>

    </div>
  </div>
</div>
</div>




<div class="input_row black shadow radius2 text-left _inline-block general_info white5-bg" id="general_info6">

  <div class="container">

    <div class="row">
      <div class="col-xs-12">
        <h3 class="text-left  _white-bg blue"><i class="material-icons">account_circle</i> Περιοχές </h3>

    <div id="areas_details" data-step="5" class="account_step text-center account_step_5">



      <div class="login-form text-left _inline-block">

        <div class="">
          <div class="open_areas-transform inline-block">
            <div class="open_areas pointer bold blue-bg  blue-bg black radius4 shadow">
              <i class="material-icons middle md-32 black">add_circle_outline</i>  Προσθέστε Περιοχή
            </div>


        </div>

        <div class="open_areas-transform inline-block">
          <div class="delete_areas pointer bold blue-bg black radius4 shadow">
            <i class="material-icons middle md-32 black">delete</i> Διαγραφή Όλων
          </div>

        </div>

        <br/>

        <div class="clearer">

        </div>
        <form id="areas-form" method="post">

          <div id="area_tmpl" class="hidden">
            <div class="single_selected_item-transform inline-block" data-area="">
              <input class="hidden" type="checkbox" value="" name="" checked/>
              <div class="single_selected_item-shape shadow white-bg radius2">
                <div class="delete_area-transform ">
                  <div class="delete_area-shape pointer">
                    <i class="material-icons md-24">delete_forever</i>
                  </div>
                </div>


                <div class="selected_item_title blue bold">

                </div>
                <div class="selected_item_parent grey3 ">

                </div>
                <div class="map green hidden">

                </div>
              </div>
            </div>
          </div>


          <div class="areas_container-transform">

            <div class="selected_areas text-left">

              <?php $areasArray = get_field('seller_areas','user_'.get_current_user_id(),false);?>

              <?php

              $areas_filter_array = array();
              foreach ($areasArray as $key => $area){

                $areas_filter_array[get_post($area)->post_parent] = get_post(get_post($area)->post_parent)->post_title ;
                ?>
                <div id="cat<?php echo $area;?>" class="single_selected_item-transform inline-block area_parent_<?php echo get_post($area)->post_parent;?>" data-area="<?php echo $area;?>">
                  <input class="hidden" type="checkbox" value="<?php echo $area;?>" name="areas[]" checked/>
                  <div class="single_selected_item-shape shadow white-bg radius2">
                    <div class="delete_area-transform ">
                      <div class="delete_area-shape pointer">
                        <i class="material-icons md-24">delete_forever</i>
                      </div>
                    </div>

                    <div class="selected_item_title blue bold">
                      <?php echo get_post($area)->post_title ;?>
                    </div>
                    <div class="selected_item_parent grey3 ">
                      <?php echo get_post(get_post($area)->post_parent)->post_title ;?>
                    </div>
                    <div class="map green hidden">
                      <?php echo get_field("area_longlat",$area);?>
                    </div>
                  </div>
                </div>
                <?php

              }?>
              <div class="filter-selection-transform">
                <div class="filter-selection-shape">

                  <select id="filter_areas">
                    <option value="-1">
                      Όλες
                    </option>
                    <?php
                    foreach ($areas_filter_array as $key => $filter) {
                      # code...
                      ?>
                      <option id="area_filter_<?php echo $key;?>" value="<?php echo $key;?>"><?php echo $filter;?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>


            </div>


            <div id="categories_selector" class="fixed text-center hidden item_selection_windows">


              <div class="categories_selector-shape inline-block white-bg shadow text-left">
                <h3 class="blue-bg white">Eπιλογή Κατηγοριών  <div class="pointer close_categories right">
                  <i class="material-icons white md-24">close</i>
                </div></h3>

                <div class="categories_container-shape">

                  <?php

                  $subscription_cat = get_post($seller_details_subscription_id_ID);
                  $subscription_root_category = @get_field("subscription_root_category",$subscription_cat->ID);
                  echo  getSellerAreasCats($subscription_root_category->ID,'seller_product_categories','product_category');;//getAccountSubcategories_html($subscription_root_category->ID);

                  ?>
                </div>



              </div>

            </div>


            <div id="area_selector" class="fixed text-center hidden item_selection_windows">


              <div class="area_selector-shape inline-block white-bg shadow text-left">
                <h3 class="blue-bg white">Eπιλογή Περιοχων  <div class="pointer close_areas right">
                  <i class="material-icons white md-24">close</i>
                </div></h3>

                <div class="areas_container-shape">

                  <?php   echo   getSellerAreasCats(0,'seller_areas','areas');;//getAreas_html(0); ?>
                </div>



              </div>

            </div>

          </div>
          <input type="submit" name="submit_areas"  class=" btn btn-success btn-send blue-bg" value="Αποθήκευση"/>
        </form>

      </div>
    </div>


  </div>

</div>
</div>
</div>

</div>

</div>




<div id="receipt_info" data-step="3" class="login-form account_step text-center account_step_3  account_page page_3 hidden">

  <div class="container">


    <h3 class="text-left  _white-bg blue "><i class="material-icons">receipt</i>Στοιχεία Τιμολόγησης </h3>






    <!-- <div class="receipt_info-shape">-->






      <div class="input_row black shadow radius2 text-left _inline-block">
        <div class="_row">

          <form id="address-form" method="post">



            <div class="_col-xs-12 _col-md-12  single_seller_form-transform  inline-block text-left " >








              <div class="single_seller_form-shape form-group inline-block"  id="seller_details_area">
                <div class="input_label bold black">
                  Περιοχή
                </div>

                <input name="reg_area" type="text" class="form-control login-field"
                value="<?php echo $seller_details_area; ?>"
                placeholder="Περιοχή" id="reg_area" required/>
                <div class="help-block with-errors"></div>
              </div>




              <div class="single_seller_form-shape form-group inline-block"  id="seller_details_area">
                <div class="input_label bold black">
                  Πόλη
                </div>

                <input name="reg_city" type="text" class="form-control login-field"
                value="<?php echo $seller_details_city; ?>"
                placeholder="Πόλη" id="reg_city" required/>
                <div class="help-block with-errors"></div>
              </div>

              <div class="single_seller_form-shape form-group inline-block" id="seller_details_address">
                <div class="input_label bold black">
                  Διεύθυνση
                </div>

                <textarea name="reg_address"  class="form-control login-field"

                placeholder=" (Οδός & Αριθμός)" id="reg_address" required><?php echo $seller_details_address; ?></textarea>
                <div class="help-block with-errors"></div>
              </div>

              <div class="single_seller_form-shape form-group inline-block" id="seller_details_postcode">
                <div class="input_label bold black">
                  Τ.Κ
                </div>

                <input name="reg_pc" type="text" class="form-control login-field"
                value="<?php echo $seller_details_postcode; ?>"
                placeholder="T.Κ" id="reg_pc" required="required" />
                <div class="help-block with-errors"></div>
              </div>


              <div class="single_seller_form-shape form-group inline-block"  id="seller_details_area">
                <div class="input_label bold black">
                  Δ.Ο.Υ
                </div>

                <input name="reg_doy" type="text" class="form-control login-field"
                value="<?php echo $seller_details_doy;?>"
                placeholder="Δ.Ο.Υ" id="reg_doy" required/>
                <div class="help-block with-errors"></div>
              </div>

              <div class="single_seller_form-shape form-group inline-block" id="seller_details_address">
                <div class="input_label bold black">
                  Δραστηριότητες
                </div>

                <textarea name="reg_activities"  class="form-control login-field"

                placeholder="Δραστηριότητες" id="reg_activities" required><?php echo $seller_details_activities; ?></textarea>
                <div class="help-block with-errors"></div>
              </div>



              <div class="single_seller_form-shape form-group inline-block" id="seller_details_telephone">
                <div class="input_label bold black">
                  Tηλέφωνο Επικοινωνίας.
                </div>
                <div class="country-code-transform inline-block ">
                  <div class="country-code-shape  grey bold">
                    +30
                  </div>
                </div>
                <input name="reg_contactPhone" type="tel" class="form-control login-field telephone_input"
                value="<?php echo $seller_details_telephone; ?>"
                placeholder="XXXXXXXXXX" id="reg-contactPhone" size="20" minlength="10" maxlength="10" onkeypress='return isNumber(event)'  required/>
                <label class="login-field-icon fui-user" for="reg-contactPhone"></label>
                <div class="help-block with-errors"></div>
              </div>

              <div class="single_seller_form-shape form-group inline-block">
                <div class="input_label bold black">
                  Email αποστολής τιμολογίων
                </div>
                <div class="input_info grey ">
                  Συμπληρώστε το email που επιθυμείτε να αποστέλλονται τα τιμολόγια
                </div>

                <input name="reg_email_receipt" type="email" class="form-control login-field" value="<?php echo $seller_details_email_receipt; ?>"
                placeholder="Email" id="reg-email_receipt"  />
                <div class="help-block with-errors"></div>
              </div>


              <div class=" single_seller_form-transform text-left _inline-block">
                <div class="single_seller_form-shape form-group">


                  <input type="submit" class="btn btn-success btn-send blue-bg" value="Aποθήκευση" name="reg_submit" />
                </div>
              </div>




            </div>

          </form>
        </div>
      </div>
    </div>
    <!--     </div> -->
  </div> <!-- end step 2 -->








  <?php
  /*$array_temp = array("0"=>3396);

  remove_offers_from_inquiry($array_temp,get_current_user_id());*/
  ?>

  <div class="login-form">
  </div>
