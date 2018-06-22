<?php $debug =0;?>
<div class="login-form">

<div id="user_details" data-step="1" class="account_step step text-left  account_step_1">
    <h3 class="text-left  white-bg blue"><i class="material-icons">account_circle</i> Στοιχεια Λογαριασμού  </h3>


    <div class="input_row black shadow radius2 text-left _inline-block">
      <div class="">

      <div class="account-main inline-block">
        <div class=" single_seller_form-transform  inline-block text-left">
          <div class="single_seller_form-shape seller_details_company">
            <div class="input_label bold black">
          <h2 class="blue"><?php echo $seller_companyName;?></h2>
            </div>

          </div>
        </div>

        <div class="clearer">

        </div>

        <div class=" single_seller_form-transform  inline-block text-left accout_border">
          <div class="single_seller_form-shape ">
            <div class="input_label bold black">
              email
            </div>
            <div class="account_non_edit bold">
            <i class="material-icons blue md-24 middle">email</i>   <?php echo  $user_info->user_email ;?>
            </div>


          </div>

        </div>

        <div class="clearer">

        </div>

        <div class=" single_seller_form-transform  inline-block text-left accout_border">
          <div class="single_seller_form-shape ">
            <div class="input_label bold black">
              Διάρκεια Συνδρομής
            </div>
            <div class="account_non_edit bold">

            <i class="material-icons green md-24 middle">access_time</i>   <?php echo  $seller_details_renew_date; ?> μήνες
            </div>


          </div>

        </div>

        <div class=" single_seller_form-transform  inline-block text-left accout_border">
          <div class="single_seller_form-shape ">
            <div class="input_label bold black">
              Λήγει
            </div>
            <div class="account_non_edit bold">
            <i class="material-icons green md-24 middle">date_range</i>   <?php echo  $seller_details_renew_date; ?>
            </div>


          </div>

        </div>

        <div class="clearer">

        </div>

        <div class=" single_seller_form-transform  inline-block text-left accout_border">
          <div class="single_seller_form-shape ">
            <div class="input_label bold black">
                Νομική μορφή
            </div>
            <div class="account_non_edit ">
            <i class="material-icons blue md-24 middle">account_balance</i>  <?php echo $seller_details_ctype ;?>
            </div>


          </div>

        </div>
        <div class="clearer">

        </div>

        <div class=" single_seller_form-transform  inline-block text-left accout_border">
          <div class="single_seller_form-shape ">
            <div class="input_label bold black">
                ΑΦΜ
            </div>
            <div class="account_non_edit ">
            <i class="material-icons blue md-24 middle">featured_play_list</i>  <?php echo $seller_details_afm ;?>
            </div>


          </div>

        </div>


        <div class=" single_seller_form-transform  inline-block text-left accout_border">
          <div class="single_seller_form-shape ">
            <div class="input_label bold black">
                Τύπος παραστατικού
            </div>
            <div class="account_non_edit ">
            <i class="material-icons blue md-24 middle">receipt</i>
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

        <div class="clearer">

        </div>








      </div>








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

            <div class="single_sub-transform col-xs-12 col-md-4 inline-block" id="account-subscription">
              <div class="single_sub-shape form-group black shadow _radius2 <?php echo $checked; ?>">

                <div class="sub_title text-left white"  style="background-color:<?php echo $subscription_bg_color;?>">


                  <div class="sub_title_title inline-block">
                    <?php echo get_the_title($seller_details_subscription_id_ID) ;?>
                  </div>

                  <div class="right sub_image-transform">
                    <div class="sub_image-shape circle white-bg">
                      <img src="<?php echo get_template_directory_uri() ;?>/<?php echo $subscription_image;?>" />
                    </div>
                  </div>

                </div>
                <div class=" subscription-details">

                  <div class=" sub_price">
                    <div class=" grey inline-block text-center grey4">
                    <i class="material-icons "  style="color:<?php echo $subscription_bg_color;?>">local_offer</i>

                      Τιμή  <br/>
                      <span class="price  bold"  style="color:<?php echo $subscription_bg_color;?>"><?php echo $subscription_price;?>&euro;</span>
                    </div>

                  </div>

                  <div class="sub_length">
                    <div class=" grey inline-block text-center grey4">
                      <i class="material-icons grey4">date_range</i>
                      Διάρκεια :
                       <span class="black bold"><?php echo $subscription_length;?> μήνες</span>
                     </div>
                  </div>


                  <div class="col-xs-12">
                      <div class="sub_description light"><?php echo $subscription_description;?></div>
                  </div>
                </div>






              </div>
            </div>


            <div class="clearer">

            </div>




      </div>
    </div>

    <div class="clearer">

    </div>

    <div class="input_row black shadow radius2 text-left _inline-block">
      <div class="">
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

          <div class=" single_seller_form-transform text-left inline-block">
            <div class="single_seller_form-shape form-group">


            <input type="submit" class="btn btn-success btn-send blue-bg" value="Aποθήκευση" name="reg_submit" />
          </div>
          </div>
        </form>

      </div>
    </div>

    <div>

    </div>



  </div>





  <div id="receipt_info" data-step="2" class="account_step text-center account_step_2">


    <h3 class="text-left  white-bg blue "><i class="material-icons">receipt</i>Στοιχεία Τιμολόγησης </h3>






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
                value="<?php $seller_details_doy΄?>"
                placeholder="Δ.Ο.Υ" id="reg_doy" required/>
                <div class="help-block with-errors"></div>
              </div>

              <div class="single_seller_form-shape form-group inline-block" id="seller_details_address">
                <div class="input_label bold black">
                  Δραστηριότητες
                </div>

                <textarea name="reg_activities"  class="form-control login-field"
                value="<?php echo $seller_details_activities; ?>"
                placeholder="Δραστηριότητες" id="reg_activities" required></textarea>
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


              <div class=" single_seller_form-transform text-left inline-block">
                <div class="single_seller_form-shape form-group">


                <input type="submit" class="btn btn-success btn-send blue-bg" value="Aποθήκευση" name="reg_submit" />
              </div>
              </div>




            </div>

          </form>
        </div>
      </div>
<!--     </div> -->
  </div> <!-- end step 2 -->

  <div id="seller_info" data-step="3" class="account_step text-center account_step_3">


      <h3 class="text-left  text-left   white-bg blue">
      <i class="material-icons">chrome_reader_mode</i> Πληροφορίες Επαγγελματία </h3>

      <div class="receipt_info-shape">

        <div class="input_row black shadow radius2 text-left _inline-block">
          <div class="">



            <div class="single_seller_form-transform  inline-block text-left " id="seller_details_gallery">
              <div class="single_seller_form-shape form-group"  >
                <div class="input_label bold black">
                  Banner
                </div>

                <?php
                //  var_dump( $seller_data_banner);
                //echo " banner ". $seller_data_banner['url'] ;
                ?>
                <div class="banner-transform" >
                  <div class="banner-shape">

                    <div class="banner-image-transform">
                      <div class="banner-image-shape" >
                          <img src="<?php  echo get_site_url()."/".$seller_data_banner;?>"/>
                      </div>
                    </div>
                    <?php if($seller_data_banner!=""){
                      ?>

                      <div class="gallery-transform inline-block" data-url="<?php echo $seller_data_banner?>">
                        <div class="gallery-shape" >
                        <!--  -->
                          <div class="gallery_delete-transform">
                            <div class="gallery_delete-shape pointer  black">
                              <i class="material-icons md-18 green inline-block middle">delete</i> Διαγραφή
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php
                    }
                    ?>


                  </div>


                </div>


                <div class="banner-upload-transform">

                  <div id="banner_preview">

                    <form id="banner-upload" action="#" method="post">
                      <input type="hidden" name="action" value="uploadImageFiles" />
                      <div id="targetOuter">
                        <div id="targetLayer"></div>

                        <div class="icon-choose-image" >
                          <input name="photo" id="userImage" type="file" class="inputFile" onChange="showPreview(this);" />
                        </div>
                      </div>
                      <div>


                        <input type="submit" class="btn btnSubmit btn-send blue-bg white" value="Ανέβασμα Banner" name="reg_submit">
                      </div>
                    </form>

                  </div>




                </div>
                <?php

                ?>
              </div>

            </div>
          </div>
        </div>


        <div class="clearer">

        </div>

        <div class="input_row black shadow radius2 text-left _inline-block">
          <div class="row">
            <form id="seller_general-data" method="post">

              <div class="col-xs-12 col-md-12  single_seller_form-transform inline-block text-left">




                <div class="single_seller_form-shape form-group" id="seller_details_address">
                  <div class="input_label bold black">
                    Περίληψη
                  </div>
                  <?php

                  $settings = array( 'textarea_rows' => 6);
                  wp_editor( $seller_data_summary, "reg_seller_summary",$settings); ?>

                  <?php
                  /*<textarea name="reg_seller_summary"  class="form-control login-field"
                  value=""
                  placeholder=" ..." id="reg_seller_summary" >echo esc_html($seller_data_summary) ;</textarea>
                  */
                  ?>
                  <div class="help-block with-errors"></div>
                </div>




                <?php
                if($tmpl_post_type == "tmpl_products" || $debug ==1)
                {
                  ?>
                  <div class="single_seller_form-shape form-group inline-block"  id="seller_details_area">
                    <div class="input_label bold black">
                      Έτος ίδρυσης :
                      <input name="reg_data_founded" type="text" class="form-control login-field"
                      value=" <?php echo $seller_data_founded; ?>" minlength="4" maxlength="4" onkeypress='return isNumber(event)'
                      placeholder="XXXX" id="reg_data_founded" required/>
                      <div class="help-block with-errors"></div>
                    </div>

                  </div>

                  <div class="single_seller_form-shape form-group inline-block" id="seller_details_address">
                    <div class="input_label bold black">
                      Αριθμός εργαζομένων
                    </div>
                    <select name="reg_data_employees"  id="reg_data_employees" required>
                      <option value="1 εργαζόμενος">
                      1 εργαζόμενος
                      </option>
                      <option value="2-10 εργαζόμενοι">
                      2-10 εργαζόμενοι
                      </option>
                      <option value="11-50 εργαζόμενοι">
                      11-50 εργαζόμενοι
                      </option>
                      <option value="51-200 εργαζόμενοι">
                      51-200 εργαζόμενοι
                      </option>
                      <option value="201-500 εργαζόμενοι">
                      201-500 εργαζόμενοι
                      </option>
                      <option value="501-1000 εργαζόμενοι">
                      501-1000 εργαζόμενοι
                      </option>
                      <option value="1001+ εργαζόμενοι">
                      1001+ εργαζόμενοι
                      </option>
                    </select>
                  <!--  <input name="reg_data_employees" type="text" class="form-control login-field"
                    value="<?php echo $seller_data_employees; ?>"
                    placeholder="1-3000" id="reg_data_employees" required/>
                    <div class="help-block with-errors"></div>-->
                  </div>
                  <?php
                }
                ?>



                <div class="single_seller_form-shape form-group inline-block" id="seller_details_address">
                  <div class="input_label bold black">
                    LinkedIn
                  </div>

                  <input name="reg_linkedin" type="text" class="form-control login-field"
                  value="<?php echo $seller_data_linkedin; ?>"
                  placeholder="LinkedIn Url" id="reg_pc"  />
                  <div class="help-block with-errors"></div>
                </div>

                <div class="single_seller_form-shape form-group inline-block" id="seller_details_postcode">
                  <div class="input_label bold black">
                    Facebook
                  </div>

                  <input name="reg_fb" type="text" class="form-control login-field"
                  value="<?php echo $seller_data_facebook; ?>"
                  placeholder="Facebook url" id="reg_fb"  />
                  <div class="help-block with-errors"></div>
                </div>



                <div class="single_seller_form-shape form-group inline-block" id="seller_details_telephone">
                  <div class="input_label bold black">
                    Website
                  </div>

                  <input name="reg_web" type="text" class="form-control login-field"
                  value="<?php echo $seller_data_web; ?>"           placeholder="www.example.com"  />

                  <div class="help-block with-errors"></div>
                </div>



                <div class="clearer">

                </div>

                <div class=" single_seller_form-transform text-left inline-block">
                  <div class="single_seller_form-shape form-group">


                  <input type="submit" class="btn btn-success btn-send blue-bg" value="Aποθήκευση" name="reg_submit" />
                </div>
                </div>





              </div>

            </form>



          </div>
        </div>


        <div class="clearer">

        </div>
        <div class="input_row black shadow radius2 text-left _inline-block">
          <div class="_row">
            <div class=" single_seller_form-transform text-left">

              <div class="single_seller_form-shape form-group" id="seller_details_gallery">
                <div class="input_label bold black">
                  Gallery
                </div>
                <div class="gallery-container-transform row">
                  <?php //echo $seller_data_gallery;

                  //var_dump($seller_data_gallery);

                  if(isset($seller_data_gallery) && $seller_data_gallery != "")
                  {
                    $gallery_array = explode(",",$seller_data_gallery);
                    foreach($gallery_array as $gallery )
                    {
                      //var_dump($gallery);
                      ?>
                      <div class="gallery-transform col-xs-12 col-sm-6 col-md-4" data-url="<?php echo $gallery;?>">
                        <div class="gallery-shape">
                            <a href="<?php echo get_site_url()."/".$gallery;?>">
                            <div class="gallery-image-transform">
                              <div class="gallery-image-shape" style="background:url(<?php echo get_site_url()."/".$gallery;?>)">

                              </div>
                            </div>
                            </a>

                          <div class="gallery_delete-transform">
                            <div class="gallery_delete-shape pointer  black">
                              <i class="material-icons md-18 green inline-block middle">delete</i> Διαγραφή
                            </div>
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
              <div class="gallery-upload-transform">

                <div id="gallery_preview">

                  <form id="gallery-upload" action="#" method="post">
                    <input type="hidden" name="action" value="uploadImageFiles" />
                    <div id="targetOuter">
                      <div id="targetLayer"></div>

                      <div class="icon-choose-image" >
                        <input name="photo" id="userImage" type="file" class="inputFile" onChange="showPreview(this);" />
                      </div>
                    </div>
                    <div>
                      <input type="submit" value="Upload Photo" class=" btn btn-success btn-send blue-bg" />
                    </div>
                  </form>

                </div>




              </div>


            </div>
          </div>
        </div>

        <div class="clearer">

        </div>
        <?php
        if($tmpl_post_type == "tmpl_hotels" || $debug ==1)
        {

          ?>

          <div class="input_row black shadow radius2 text-left  _inline-block">
            <div class="">

              <form id="hotel-form" method="post">


                <div class="  single_seller_form-transform vertical-top inline-block text-left " >
                  <div class="single_seller_form-shape form-group"  id="seller_details_area">
                    <div class="input_label bold black">
                      Τύπος καταλύματος
                    </div>
                    <select name="reg_data_hotel_type">
                      <?php

                      $hotel_type_array = array();

                      $hotel_type_array[0] ='Ξενοδοχείο';
                      $hotel_type_array[1] ='Ενοικιαζόμενα Δωμάτια';
                      $hotel_type_array[2] ='Ξενώνας';
                      $hotel_type_array[3] ='Βίλα';
                      $hotel_type_array[4] ='Bed & Breakfast';
                      $hotel_type_array[5] ='Κάμπινγκ';





                      foreach($hotel_type_array as $key=> $type)
                      {

                        if($key == $seller_data_hotel_type)
                        {
                          $selected ="selected";
                        }else {
                          # code...
                          $selected ="";
                        }
                        ?>

                        <option value="<?php echo $key;?>" <?php echo $selected ;?>><?php  echo $type;?></option>
                        <?php
                      }
                      ?>
                    </select>

                    <div class="help-block with-errors"></div>
                  </div>
                </div>


                <div class="single_seller_form-transform vertical-top inline-block text-left " >
                  <div class="single_seller_form-shape form-group" id="seller_details_address">
                    <div class="input_label bold black">
                      Κατηγορία ξενοδοχείου
                    </div>
                    <input type="text" class="form-control login-field" name="reg_seller_data_stars" value="<?php echo $seller_data_stars;?>" placeholder="..." />


                    <div class="help-block with-errors">

                    </div>
                  </div>

                </div>

                <div class=" single_seller_form-transform vertical-top inline-block text-left " >
                  <div class="single_seller_form-shape form-group" id="seller_details_address">
                    <div class="input_label bold black">
                      Αριθμός δωματίων
                    </div>


                    <input name="reg_hotel_rooms" type="text" class="form-control login-field"
                    value="<?php echo $seller_data_rooms; ?>"
                    placeholder="1 - 2000" id="reg_hotel_rooms" required/>
                    <div class="help-block with-errors"></div>

                  </div>

                </div>
                <div class="clearer">

                </div>


                <div class=" single_seller_form-transform text-left inline-block">
                  <div class="single_seller_form-shape form-group">


                    <input type="submit" value="Aποθήκευση" class=" btn btn-success btn-send blue-bg" />
                </div>
                </div>


              </form>

            </div>
          </div>

          <div class="clearer">

          </div>


          <div class="input_row black shadow radius2 text-center _inline-block" id="amenities">
            <div class="">



              <div class=" single_seller_form-transform  col-xs-12 col-md-6  text-left " >
                <div class="single_seller_form-shape form-group"  id="seller_details_area">
                  <div class="input_label bold white2 yellow-bg">
                  <i class="material-icons inline-block middle">hotel</i>  Παροχές καταλύματος
                  </div>


                  <form id="hotel_amenities-form" method="post">


                    <div class="hotel-check-transform">
                      <div class="hotel-check-shape">




                        <?php
                        $paroxes_katal = array();

                        $paroxes_katal[0]="Δωρεάν Wi-Fi";
                        $paroxes_katal[1]="Δωρεάν Parking";
                        $paroxes_katal[2]="Δωρεάν μετακίνηση από / προς το αεροδρόμιο";
                        $paroxes_katal[3]="24ωρη reception";
                        $paroxes_katal[4]="Εστιατόριο";
                        $paroxes_katal[5]="Bar";
                        $paroxes_katal[6]="Καθαριστήριο";
                        $paroxes_katal[7]="Εξωτερική πισίνα";
                        $paroxes_katal[8]="Εσωτερική πισίνα";
                        $paroxes_katal[9]="Ξαπλώστρες για την παραλία / πισίνα";
                        $paroxes_katal[10]="Ομπρέλες για την παραλία / πισίνα";
                        $paroxes_katal[11]="Πετσέτες για την παραλία / πισίνα";
                        $paroxes_katal[12]="Κέντρο ευεξίας / Spa";
                        $paroxes_katal[13]="Γυμναστήριο";
                        $paroxes_katal[14]="Κομμωτήριο";
                        $paroxes_katal[15]="Ιατρός";
                        $paroxes_katal[16]="Room service";
                        $paroxes_katal[17]="Δωμάτια για ΑΜΕΑ";
                        $paroxes_katal[18]="Δωμάτια για μη καπνίζοντες";
                        $paroxes_katal[19]="Αντιαλλεργικά δωμάτια";
                        $paroxes_katal[20]="Συνεδριακός χώρος";
                        $paroxes_katal[21]="Επιτρέπονται τα κατοικίδια";

                        //var_dump($seller_data_amenities);
                        for($counter=0; $counter < sizeof($paroxes_katal); $counter++){
                          $checked_am = "";
                          if(isset($seller_data_amenities) && !empty($seller_data_amenities))
                          {
                            if(in_array($counter,$seller_data_amenities))
                            {
                              $checked_am = "checked";
                            }
                          }


                          ?>
                          <div class="single_hotel-check form-group">


                            <div class="icon_action hotel_checkbox_action inline-block pointer middle <?php echo $checked_am;?>">
                              <i class="material-icons md-18 yellow _md-dark check ">check_box</i>
                              <i class="material-icons  md-18 yellow _md-dark uncheck">check_box_outline_blank</i>
                            </div>



                            <input  class="hidden" type="checkbox" name="reg_amenities[]" value="<?php echo $counter;?>" <?php echo $checked_am;?> /><?php echo $paroxes_katal[$counter];?>
                          </div>
                          <?php

                        }
                        ?>



                      </div>
                    </div>
                    <div class="help-block with-errors"></div>
                    <input type="submit" value="Aποθήκευση" class=" btn btn-success btn-send blue-bg" />
                  </form>

                </div>
              </div>



              <div class=" single_seller_form-transform  col-xs-12 col-md-6 text-left " >
                <div class="single_seller_form-shape form-group"  id="seller_details_area">
                  <div class="input_label bold white green-bg">
                      <i class="material-icons white middle inline-block">room_service</i> Παροχές δωματίων
                  </div>
                  <form id="hotel_amenities-room-form" method="post">
                    <div class="hotel-check-transform">
                      <div class="hotel-check-shape">




                        <?php
                        $paroxes_katal = array();

                        $paroxes_katal[0]="Κλιματισμός";
                        $paroxes_katal[1]="Καλοριφέρ";
                        $paroxes_katal[2]="Τηλεόραση";
                        $paroxes_katal[3]="Πλυντήριο ρούχων";
                        $paroxes_katal[4]="Χρηματοκιβώτιο";
                        $paroxes_katal[5]="Φούρνος μικροκυμάτων";
                        $paroxes_katal[6]="Κουζίνα";
                        $paroxes_katal[7]="Ψυγείο";
                        $paroxes_katal[8]="Τζάκι";
                        $paroxes_katal[9]="Πιστολάκι μαλλιών";
                        $paroxes_katal[10]="Βραστήρας";
                        $paroxes_katal[11]="Καφετιέρα";
                        $paroxes_katal[12]="Θέα";
                        $paroxes_katal[13]="Μπαλκόνι";
                        $paroxes_katal[14]="Βεράντα / Αυλή";



                        for($counter=0; $counter <  sizeof($paroxes_katal); $counter++){
                          $checked_am = "";


                          if(isset($seller_data_room_amenities) && !empty($seller_data_room_amenities))
                          {
                            if(in_array($counter,$seller_data_room_amenities))
                            {
                              $checked_am = "checked";
                            }
                          }


                          ?>
                          <div class="single_hotel-check form-group">

                            <div class="icon_action hotel_checkbox_action inline-block pointer <?php echo $checked_am;?>">
                              <i class="material-icons md-18 green _md-dark check ">check_box</i>
                              <i class="material-icons  md-18 green _md-dark uncheck">check_box_outline_blank</i>
                            </div>
                            <input type="checkbox" class="hidden" name="reg_hotel_room_amenities[]" value="<?php echo $counter;?>" <?php echo $checked_am;?> /><?php echo $paroxes_katal[$counter];?>
                          </div>
                          <?php

                        }
                        ?>



                      </div>
                    </div>
                    <div class="help-block with-errors"></div>
                    <input type="submit" value="Aποθήκευση" class=" btn btn-success btn-send blue-bg" />
                  </form>
                </div>
              </div>
            </div>
            <div class="clearer">

            </div>
          </div>

          <div class="clearer">

          </div>
          <?php
        }
        ?>

        <?php
        if($tmpl_post_type == "tmpl_services" || $debug ==1)
        {

          ?>
          <div class="input_row black shadow radius2 text-center inline-block">
            <div class="row">
              <div class="col-xs-12 col-md-12  single_seller_form-transform  inline-block text-left " >
                <div class="single_seller_form-shape form-group" id="seller_details_address">
                  <div class="input_label bold black">
                    Hλικία
                  </div>



                  <input name="reg_age" type="text" class="form-control login-field"
                  value="<?php echo $seller_data_age; ?>"
                  placeholder="18 - 100" id="reg_hotel_rooms" required/>
                  <div class="help-block with-errors"></div>

                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-md-12  single_seller_form-transform  inline-block text-left " >
                <div class="single_seller_form-shape form-group" id="seller_details_education">
                  <div class="input_label bold black">
                    Εκπαίδευση
                  </div>

                  <div class="education-button-transform right">
                    <div class="education-button-shape pointer">
                      <i class="material-icons middle green">add_circle_outline</i>Προσθέστε εγγραφή
                    </div>

                    <div id="education_tmpl" class="hidden">
                      <div class="row single_table-row">


                        <div class="single-table-counter-transform">
                          <div class="single-table-counter-shape circle green-bg blue bold">

                          </div>
                        </div>

                        <div class="table-col col-xs-12 col-sm-6 ">
                          <div class="t_header bold">
                            Από - Έως
                          </div>
                          <input type="text" class="education_dates" value="" placeholder="πχ 2009 - 2011" />
                        </div>

                        <div class="table-col col-xs-12 col-sm-6 t_header bold">

                          <div class="t_header bold">
                            Φορέας εκπαίδευσης
                          </div>
                          <input type="text" class="education_establishment" value="" placeholder="πχ Οικονομικό Πανεπιστήμιο Αθηνών" />
                        </div>

                        <div class="table-col col-xs-12 col-sm-6  t_header bold">

                          <div class="t_header bold">
                            Τίτλος
                          </div>
                          <input type="text" class="education_title" value="" placeholder="πχ Μεταπτυχιακό" />
                        </div>

                        <div class="table-col col-xs-12 col-sm-6  t_header bold">

                          <div class="t_header bold">
                            Τομέας εκπαίδευσης
                          </div>
                          <input type="text" class="education_educ_area" value="" placeholder="πχ Οργάνωση και Διοίκηση Επιχειρήσεων" />
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="table-transform">	<form id="education-form" method="post">
                    <div class="table-shape" id="education-rows">



                      <?php


                      $field_titles=array(0=>'Από - Έως',1=>'Φορέας εκπαίδευσης',2=>'Τίτλος',3=>'Τομέας εκπαίδευσης');
                      $field_name=array(0=>'education_dates',1=>'education_establishment',2=>'education_title',3=>'education_educ_area');
                      $field_placeholders=array(0=>'πχ 2009 - 2011',1=>'πχ Οικονομικό Πανεπιστήμιο Αθηνών',2=>'πχ Μεταπτυχιακό',3=>'πχ Οργάνωση και Διοίκηση Επιχειρήσεων');
                      //		echo $seller_data_education;
                      $seller_data_education = str_replace("<p>","",$seller_data_education);
                        $seller_data_education = str_replace("</p>","",$seller_data_education);
                        $education = explode("@@",$seller_data_education);
                        $row_count = 0;
                        foreach($education as $single_row)
                        {	$counter = 0;
                          if($single_row=="")
                          {
                            continue;
                          }
                          ?>
                          <div class="row single_table-row" id="edu<?php echo $row_count++;?>">
                            <?php
                            $single_row = str_replace("##","",$single_row);
                            $single_row = str_replace("@@","",$single_row);

                            $fields = explode("@#",$single_row);
                            foreach($fields as $field)
                            {
                              //	echo $counter." - ".$field;

                              ?>
                              <div class="table-col col-xs-12 col-sm-6  ">
                                <div class="t_header bold">
                                  <?php echo $field_titles[$counter];?>
                                </div>
                                <input type="text" class="<?php echo $field_name[$counter];?>" value="<?php echo $field;?>" placeholder="<?php echo $field_placeholders[$counter];?>" />
                              </div>
                              <?php
                              $counter++;
                            }
                            ?>
                          </div>
                          <?php
                        }


                        ?>

                        <div class="row single_table-row" id="edu<?php echo $row_count++;?>">

                          <div class="single-table-counter-transform">
                            <div class="single-table-counter-shape circle green-bg blue bold">
                                <?php echo $row_count;?>
                            </div>
                          </div>

                          <div class="table-col col-xs-12 col-sm-6   ">
                            <div class="t_header bold">
                              Από - Έως
                            </div>
                            <input type="text" class="education_dates" value="" placeholder="πχ 2009 - 2011" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6  t_header bold">

                            <div class="t_header bold">
                              Φορέας εκπαίδευσης
                            </div>
                            <input type="text" class="education_establishment" value="" placeholder="πχ Οικονομικό Πανεπιστήμιο Αθηνών" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6 t_header bold">

                            <div class="t_header bold">
                              Τίτλος
                            </div>
                            <input type="text" class="education_title" value="" placeholder="πχ Μεταπτυχιακό" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6  t_header bold">

                            <div class="t_header bold">
                              Τομέας εκπαίδευσης
                            </div>
                            <input type="text" class="education_educ_area" value="" placeholder="πχ Οργάνωση και Διοίκηση Επιχειρήσεων" />
                          </div>
                        </div>



                      </div>
                      <input type="submit" value="Aποθήκευση" class=" btn btn-success btn-send blue-bg" />
                    </form>
                  </div>






                </div>

              </div>
            </div>





            <div class="row ">

              <div class="col-xs-12 col-md-12  single_seller_form-transform  inline-block text-left " >
                <div class="single_seller_form-shape form-group" id="seller_details_education">
                  <div class="input_label bold black">
                    Επαγγελματική εμπειρία
                  </div>

                  <?php
                  $field_titles=array(0=>'Από - Έως',1=>'Επιχείρηση',2=>'Θέση',3=>'Περιγραφή εργασίας');
                  $field_name=array(0=>'education_dates',1=>'education_establishment',2=>'education_title',3=>'education_educ_area');
                  $field_placeholders=array(0=>'πχ 2009 έως σήμερα',1=>'πχ Γιώργος Γεωργίου',2=>'πχ Ατομική Επιχείρηση',3=>'πχ Καθηγητής αγγλικής γλώσσας');?>


                  <div class="work-button-transform right">
                    <div class="work-button-shape pointer">
                    <i class="material-icons middle yellow">add_circle_outline</i>  Προσθέστε εγγραφή
                    </div>

                    <div id="work_tmpl" class="hidden">
                      <div class="row single_table-row">

                        <div class="single-table-counter-transform">
                          <div class="single-table-counter-shape circle yellow-bg blue bold">

                          </div>
                        </div>
                        <div class="table-col col-xs-12 col-sm-6  ">
                          <div class="t_header bold">
                            <?php echo $field_titles[0];?>
                          </div>
                          <input type="text" class="<?php echo $field_name[0];?>" value="" placeholder="<?php echo $field_placeholders[0];?>" />
                        </div>

                        <div class="table-col col-xs-12 col-sm-6 t_header bold">

                          <div class="t_header bold">
                            <?php echo $field_titles[1];?>
                          </div>
                          <input type="text" class="<?php echo $field_name[1];?>" value="" placeholder="<?php echo $field_placeholders[1];?>" />
                        </div>

                        <div class="table-col col-xs-12 col-sm-6  t_header bold">

                          <div class="t_header bold">
                            <?php echo $field_titles[2];?>
                          </div>
                          <input type="text" class="<?php echo $field_name[2];?>" value="" placeholder="<?php echo $field_placeholders[2];?>" />
                        </div>

                        <div class="table-col col-xs-12 col-sm-6  t_header bold">

                          <div class="t_header bold">
                            <?php echo $field_titles[3];?>
                          </div>
                          <input type="text" class="<?php echo $field_name[3];?>" value="" placeholder="<?php echo $field_placeholders[3];?>" />
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="table-transform">	<form id="work-form" method="post">
                    <div class="table-shape" id="work-rows">



                      <?php


                      //		echo $seller_data_education;
                      $seller_data_work = str_replace("<p>","",$seller_data_work);
                        $seller_data_work = str_replace("</p>","",$seller_data_work);
                        $education = explode("@@",$seller_data_work);
                        $row_count = 0;
                        foreach($education as $single_row)
                        {	$counter = 0;
                          if($single_row=="")
                          {
                            continue;
                          }
                          ?>
                          <div class="row single_table-row" id="edu<?php echo $row_count++;?>">
                            <?php
                            $single_row = str_replace("##","",$single_row);
                            $single_row = str_replace("@@","",$single_row);

                            $fields = explode("@#",$single_row);
                            foreach($fields as $field)
                            {
                              //	echo $counter." - ".$field;

                              ?>
                              <div class="table-col col-xs-12 col-sm-6  ">
                                <div class="t_header bold">
                                  <?php echo $field_titles[$counter];?>
                                </div>
                                <input type="text" class="<?php echo $field_name[$counter];?>" value="<?php echo $field;?>" placeholder="<?php echo $field_placeholders[$counter];?>" />
                              </div>
                              <?php
                              $counter++;
                            }
                            ?>
                          </div>
                          <?php
                        }


                        ?>

                        <div class="row single_table-row" id="work<?php echo $row_count++;?>">

                          <div class="single-table-counter-transform">
                            <div class="single-table-counter-shape circle yellow-bg blue bold">
                                <?php echo $row_count;?>
                            </div>
                          </div>


                          <div class="table-col col-xs-12 col-sm-6   ">
                            <div class="t_header bold">
                              <?php echo $field_titles[0];?>
                            </div>
                            <input type="text" class="<?php echo $field_name[0];?>" value="" placeholder="<?php echo $field_placeholders[0];?>" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6 t_header bold">

                            <div class="t_header bold">
                              <?php echo $field_titles[1];?>
                            </div>
                            <input type="text" class="<?php echo $field_name[1];?>" value="" placeholder="<?php echo $field_placeholders[1];?>" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6  t_header bold">

                            <div class="t_header bold">
                              <?php echo $field_titles[2];?>
                            </div>
                            <input type="text" class="<?php echo $field_name[2];?>" value="" placeholder="<?php echo $field_placeholders[2];?>" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6 t_header bold">

                            <div class="t_header bold">
                              <?php echo $field_titles[3];?>
                            </div>
                            <input type="text" class="<?php echo $field_name[3];?>" value="" placeholder="<?php echo $field_placeholders[3];?>" />
                          </div>
                        </div>



                      </div>
                      <input type="submit" value="Aποθήκευση" class=" btn btn-success btn-send green-bg" />
                    </form>
                  </div>






                </div>

              </div>
            </div>




            <div class="row">
              <div class="col-xs-12 col-md-12  single_seller_form-transform  inline-block text-left " >
                <div class="single_seller_form-shape form-group" id="seller_details_certs">
                  <div class="input_label bold black">
                    Πιστοποιήσεις
                  </div>

                  <?php
                  $field_titles=array(0=>'Από - Έως',1=>'Φορέας πιστοποίησης',2=>'Τομέας εκπαίδευσης');
                  $field_name=array(0=>'education_dates',1=>'education_establishment',2=>'education_title');
                  $field_placeholders=array(0=>'πχ 2012',1=>'πχ Οικονομικό επιμελητήριο',2=>'Λογιστής Ά Τάξης');?>


                  <div class="certs-button-transform right">
                    <div class="certs-button-shape pointer">
                    <i class="material-icons middle blue">add_circle_outline</i>  Προσθέστε εγγραφή
                    </div>

                    <div id="certs_tmpl" class="hidden">
                      <div class="row single_table-row">

                        <div class="single-table-counter-transform">
                          <div class="single-table-counter-shape circle blue-bg white bold">

                          </div>
                        </div>
                        <div class="table-col col-xs-12 col-sm-6  ">
                          <div class="t_header bold">
                            <?php echo $field_titles[0];?>
                          </div>
                          <input type="text" class="<?php echo $field_name[0];?>" value="" placeholder="<?php echo $field_placeholders[0];?>" />
                        </div>

                        <div class="table-col col-xs-12 col-sm-6 t_header bold">

                          <div class="t_header bold">
                            <?php echo $field_titles[1];?>
                          </div>
                          <input type="text" class="<?php echo $field_name[1];?>" value="" placeholder="<?php echo $field_placeholders[1];?>" />
                        </div>

                        <div class="table-col col-xs-12 col-sm-6 t_header bold">

                          <div class="t_header bold">
                            <?php echo $field_titles[2];?>
                          </div>
                          <input type="text" class="<?php echo $field_name[2];?>" value="" placeholder="<?php echo $field_placeholders[2];?>" />
                        </div>


                      </div>
                    </div>

                  </div>

                  <div class="table-transform">
                    <form id="certs-form" method="post">
                      <div class="table-shape" id="certs-rows">



                        <?php


                        //		echo $seller_data_education;
                        $seller_data_qualifications_list = str_replace("<p>","",$seller_data_qualifications_list);
                          $seller_data_qualifications_list = str_replace("</p>","",$seller_data_qualifications_list);
                          $education = explode("@@",$seller_data_qualifications_list);
                          $row_count = 0;
                          foreach($education as $single_row)
                          {	$counter = 0;
                            if($single_row=="")
                            {
                              continue;
                            }
                            ?>
                            <div class="row single_table-row" id="edu<?php echo $row_count++;?>">
                              <?php
                              $single_row = str_replace("##","",$single_row);
                              $single_row = str_replace("@@","",$single_row);

                              $fields = explode("@#",$single_row);
                              foreach($fields as $field)
                              {
                                //echo $counter." - ".$field;
                                if($counter==2)
                                {
                                  $cols_n="6";
                                }else {
                                  $cols_n="3";
                                }


                                ?>
                                <div class="table-col col-xs-12 col-sm-6 col-md-<?php echo $cols_n;?>  ">
                                  <div class="t_header bold">
                                    <?php echo $field_titles[$counter];?>
                                  </div>
                                  <input type="text" class="<?php echo $field_name[$counter];?>" value="<?php echo $field;?>" placeholder="<?php echo $field_placeholders[$counter];?>" />
                                </div>
                                <?php
                                $counter++;
                              }
                              ?>
                            </div>
                            <?php
                          }


                          ?>

                          <div class="row single_table-row" id="certs<?php echo $row_count++;?>">


                            <div class="single-table-counter-transform">
                              <div class="single-table-counter-shape circle blue-bg white bold">
                                  <?php echo $row_count;?>
                              </div>
                            </div>

                            <div class="table-col col-xs-12 col-sm-6  ">
                              <div class="t_header bold">
                                <?php echo $field_titles[0];?>
                              </div>
                              <input type="text" class="<?php echo $field_name[0];?>" value="" placeholder="<?php echo $field_placeholders[0];?>" />
                            </div>

                            <div class="table-col col-xs-12 col-sm-6 t_header bold">

                              <div class="t_header bold">
                                <?php echo $field_titles[1];?>
                              </div>
                              <input type="text" class="<?php echo $field_name[1];?>" value="" placeholder="<?php echo $field_placeholders[1];?>" />
                            </div>

                            <div class="table-col col-xs-12 col-sm-6  t_header bold">

                              <div class="t_header bold">
                                <?php echo $field_titles[2];?>
                              </div>
                              <input type="text" class="<?php echo $field_name[2];?>" value="" placeholder="<?php echo $field_placeholders[2];?>" />
                            </div>


                          </div>



                        </div>
                        <input type="submit" value="Aποθήκευση" class=" btn btn-success btn-send yellow-bg" />
                      </form>
                    </div>






                  </div>

                </div>
              </div>


            </div>

            <?php
          }
          ?>

          <?php
          if($tmpl_post_type == "tmpl_products" || $tmpl_post_type == "tmpl_hotels" || $debug ==1)
          {

            ?>
            <div class="input_row black shadow radius2 text-center _inline-block">
              <div class="row">
                <div class="col-xs-12 col-md-6  single_seller_form-transform inline-block text-left">

                  <div class="single_seller_form-shape form-group" id="seller_details_postcode">
                    <div class="input_label bold black">
                      Πιστοποιήσεις
                    </div>
                    <div class="certificates-container-transform">


                      <?php //echo $seller_data_gallery;

                      //var_dump($seller_data_certifications);
                      if(isset($seller_data_certifications) && $seller_data_certifications != "")
                      {
                        $gallery_array = explode(",",$seller_data_certifications);
                        foreach($gallery_array as $gallery )
                        {
                          //var_dump($gallery);
                          ?>


                          <div class="gallery-transform inline-block" data-url="<?php echo $gallery;?>">
                            <div class="gallery-shape">
                              <img src="<?php echo get_site_url()."/".$gallery;?>"/>

                              <div class="gallery_delete-transform">
                                <div class="gallery_delete-shape pointer  black">
                                  <i class="material-icons md-18 green inline-block middle">delete</i> Διαγραφή
                                </div>
                              </div>
                            </div>


                          </div>


                          <?php
                        }
                      }
                      ?>
                    </div>
                  </div>



                  <div class="certificates-upload-transform">

                    <div id="cert_preview">

                      <form id="certificates-upload" action="#" method="post">
                        <input type="hidden" name="action" value="uploadImageFiles" />
                        <div id="targetOuter">
                          <div id="targetLayer"></div>

                          <div class="icon-choose-image" >
                            <input name="photo" id="userImage" type="file" class="inputFile" onChange="showPreview(this);" />
                          </div>
                        </div>
                        <div>
                          <input type="submit" value="Upload Photo" class=" btn btn-success btn-send blue-bg" />
                        </div>
                      </form>

                    </div>




                  </div>
                </div>
              </div>
            </div>

            <?php
          }
          ?>


        </div>
      </div>


      <div id="categories_details" data-step="4" class="account_step text-center account_step_4">

        <h3 class="text-left  white-bg blue"><i class="material-icons">account_circle</i> Επιλογή Κατηγοριών </h3>

        <div class="input_row black shadow radius2 text-left _inline-block">
          <div class="open_areas-transform left">
              <div class="open_categories pointer bold blue">
                  <i class="material-icons middle md-32 blue">add_circle_outline</i>  Προσθέστε Κατηγορία
              </div>

          </div>

          <div class="clearer">

          </div>

          <form id="categories-form" method="post">

            <div id="cat_tmpl" class="hidden">
              <div class="single_selected_item-transform inline-block" data-cat="">
                <input class="hidden" type="checkbox" value="" name="" checked/>
                <div class="single_selected_item-shape shadow white-bg radius2">
                  <div class="delete_area-transform">
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

            <input type="submit" name="submit_cats" class=" btn btn-success btn-send blue-bg" value="Αποθήκευση"/>
            <div class="categories_container-transform">
                <div class="selected_cats text-left">
                </div>
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
                <div class="single_selected_item-transform inline-block category_parent_<?php echo get_post($cat)->post_parent;?>" data-cat="<?php echo $cat;?>">
                  <input class="hidden" type="checkbox" value="<?php echo $cat;?>" name="cats[]" checked/>
                  <div class="single_selected_item-shape shadow white-bg radius2">
                    <div class="delete_area-transform">
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
    </form>



        </div>


</div>



<?php
/*$array_temp = array("0"=>3396);

remove_offers_from_inquiry($array_temp,get_current_user_id());*/
?>

<div id="areas_details" data-step="5" class="account_step text-center account_step_5">

    <h3 class="text-left  white-bg blue "><i class="material-icons">account_circle</i> Επιλογή Περιοχών </h3>

    <div class="input_row black shadow radius2 text-left _inline-block">

      <div class="open_areas-transform left">
                          <div class="open_areas pointer bold blue">
                          <i class="material-icons middle md-32 blue">add_circle_outline</i>  Προσθέστε Περιοχή
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
          <div class="delete_area-transform">
            <div class="delete_area-shape pointer">
              <i class="material-icons md-24">delete_forever</i>
            </div>
          </div>


          <div class="selected_item_title blue bold">

          </div>
          <div class="selected_item_parent grey3 ">

          </div>
          <div class="map green">

          </div>
        </div>
      </div>
    </div>

    <input type="submit" name="submit_areas"  class=" btn btn-success btn-send blue-bg" value="Αποθήκευση"/>
    <div class="areas_container-transform">

      <div class="selected_areas text-left">

        <?php $areasArray = get_field('seller_areas','user_'.get_current_user_id(),false);?>

        <?php

          $areas_filter_array = array();
        foreach ($areasArray as $key => $area){

            $areas_filter_array[get_post($area)->post_parent] = get_post(get_post($area)->post_parent)->post_title ;
          ?>
          <div class="single_selected_item-transform inline-block area_parent_<?php echo get_post($area)->post_parent;?>" data-area="<?php echo $area;?>">
            <input class="hidden" type="checkbox" value="<?php echo $area;?>" name="areas[]" checked/>
            <div class="single_selected_item-shape shadow white-bg radius2">
              <div class="delete_area-transform">
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
              <div class="map green">
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
              echo  getAccountSubcategories_html($subscription_root_category->ID);

              ?>
          </div>



        </div>
        <?php
      /*  $subscription_cat = get_post($seller_details_subscription_id_ID);

        $subscription_root_category = @get_field("subscription_root_category",$subscription_cat->ID);*/



        /*

        HTML MARK UP  -for styling

        <div class="single-account-category-transform inline-block <?php echo $hasChildren;?>">

          <div class="single-account-category-shape ">
            <div class="single-account-category-title inline-block">
              <?php echo $category->post_title;?>
            </div>

            <div  class="bold inline-block open_subcats"> <i class="material-icons">add_circle_outline</i> </div><div  class="bold inline-block all_subcats"> όλες τις υποκατηγορίες</div>

            <input type="checkbox" value="<?php echo $category->ID;?>" name="categories[]" />

          </div>
        </div>



        */

        ?>
      </div>


<div id="area_selector" class="fixed text-center hidden item_selection_windows">


  <div class="area_selector-shape inline-block white-bg shadow text-left">
    <h3 class="blue-bg white">Eπιλογή Περιοχων  <div class="pointer close_areas right">
        <i class="material-icons white md-24">close</i>
      </div></h3>

    <div class="areas_container-shape">

        <?php   echo getAreas_html(0); ?>
    </div>



  </div>
  <?php
/*  $subscription_cat = get_post($seller_details_subscription_id_ID);

  $subscription_root_category = @get_field("subscription_root_category",$subscription_cat->ID);*/



  /*

  HTML MARK UP  -for styling

  <div class="single-account-category-transform inline-block <?php echo $hasChildren;?>">

    <div class="single-account-category-shape ">
      <div class="single-account-category-title inline-block">
        <?php echo $category->post_title;?>
      </div>

      <div  class="bold inline-block open_subcats"> <i class="material-icons">add_circle_outline</i> </div><div  class="bold inline-block all_subcats"> όλες τις υποκατηγορίες</div>

      <input type="checkbox" value="<?php echo $category->ID;?>" name="categories[]" />

    </div>
  </div>



  */

  ?>
</div>

    </div>
  </form>

  </div>
</div>

</div>
