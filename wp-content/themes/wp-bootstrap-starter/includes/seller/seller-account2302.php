




<div class="row" id="dashboard_main_area">






  <div class="login-form">



    <div id="user_details" data-step="1" class="step text-center">

      <h3 class="text-center"><i class="material-icons">account_circle</i> Στοιχεια Λογαριασμού  </h3>



      <div class="input_row black shadow radius2 text-center inline-block">
        <div class="">

          <div class=" single_seller_form-transform  inline-block text-left">
            <div class="single_seller_form-shape seller_details_company">
              <div class="input_label bold black">
                <?php echo $seller_companyName;?>
              </div>

            </div>
          </div>

          <div class="clearer">

          </div>

          <div class=" single_seller_form-transform  inline-block text-left">
            <div class="single_seller_form-shape ">
              <div class="input_label bold black">
                <?php echo  $user_info->user_email ;?>
              </div>



            </div>

          </div>

          <div class="clearer">

          </div>

          <div class=" single_seller_form-transform  inline-block text-left">
            <div class="single_seller_form-shape ">
              <div class="input_label bold black">
                <?php echo get_the_title($seller_details_subscription_id_ID) ;?>
              </div>
            </div>

          </div>

          <div class="clearer">

          </div>

          <div class=" single_seller_form-transform  inline-block text-left">
            <div class="single_seller_form-shape ">
              <div class="input_label bold black">
                Λήγει : <?php echo  $seller_details_renew_date; ?>
              </div>
            </div>

          </div>




        </div>
      </div>

      <div class="clearer">

      </div>

      <div class="input_row black shadow radius2 text-center inline-block">
        <div class="">
          <form id="password_change" method="post">
            <div class=" single_seller_form-transform text-left">
              <div class="single_seller_form-shape form-group">

                <div class="input_label bold black">
                  Nέο Password
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

            <div class=" single_seller_form-transform text-left">
              <div class="single_seller_form-shape form-group">

                <div class="input_label bold black">
                  Eπαληθευση
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

            <div class="row col-md-12">
              <input type="submit" class="btn btn-success btn-send blue-bg" value="Aποθήκευση" name="reg_submit" />
            </div>
          </form>

        </div>
      </div>

      <div>

      </div>
      <?php if($seller_details_company)
      {
        $checked = "checked";
        ?>
        <div class="input_row black shadow radius2 text-center inline-block" id="fysiko">
          <div class="row">
            <div class="col-xs-12   single_seller_form-transform text-left">
              <div class="single_seller_form-shape form-group">
                <div class="inline-block">
                  <div class="input_label bold black">
                    Φυσικό Πρόσωπο
                  </div>

                </div>

              </div>
            </div>
          </div>
        </div>

        <?php
      }else {
        $checked = "";
      }
      ?>


    </div>





    <div id="receipt_info" data-step="2" class="step text-center">


      <h3 class="text-center"><i class="material-icons">receipt</i>Στοιχεία Τιμολόγησης   </h3>

      <div class="receipt_info-shape">
        <div class="input_row black shadow radius2 text-center inline-block">
          <div class="_row">



            <div class=" single_seller_form-transform  inline-block text-left company_only companyOnly" id="seller_details_ctype">
              <div class="single_seller_form-shape form-group">
                <div class="input_label bold black">
                  Νομική μορφή : <?php echo $seller_details_ctype ;?>
                </div>


              </div>

            </div>

            <div class="clearer">

            </div>

            <div class="single_seller_form-transform inline-block text-left" id="seller_details_afm">
              <div class="single_seller_form-shape form-group">
                <div class="input_label bold black">
                  ΑΦΜ : <?php echo $seller_details_afm;?>
                </div>


              </div>

            </div>


          </div>




        </div>

        <div class="clearer">

        </div>
        <div class="input_row black shadow radius2 text-center inline-block">
          <div class="row">
            <div class="col-xs-12 single_seller_form-transform inline-block text-left" id="seller_details_receipt">
              <div class="single_seller_form-shape  form-group">

                <div class="inline-block">
                  <div class="input_label bold black">
                    Τύπος παραστατικού :
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

            <div class="clearer">

            </div>
          </div>
        </div>


        <div class="clearer">

        </div>




        <div class="input_row black shadow radius2 text-center inline-block">
          <div class="_row">

            <form id="address-form" method="post">



              <div class="_col-xs-12 _col-md-12  single_seller_form-transform  inline-block text-left " >
                <div class="single_seller_form-shape form-group"  id="seller_details_area">
                  <div class="input_label bold black">
                    Περιοχή
                  </div>

                  <input name="reg_area" type="text" class="form-control login-field"
                  value="<?php echo $seller_details_area; ?>"
                  placeholder="Περιοχή" id="reg_area" required/>
                  <div class="help-block with-errors"></div>
                </div>

                <div class="single_seller_form-shape form-group" id="seller_details_address">
                  <div class="input_label bold black">
                    Διεύθυνση
                  </div>

                  <textarea name="reg_address"  class="form-control login-field"

                  placeholder=" (Οδός & Αριθμός)" id="reg_address" required><?php echo $seller_details_address; ?></textarea>
                  <div class="help-block with-errors"></div>
                </div>



                <div class="single_seller_form-shape form-group" id="seller_details_postcode">
                  <div class="input_label bold black">
                    Τ.Κ
                  </div>

                  <input name="reg_pc" type="text" class="form-control login-field"
                  value="<?php echo $seller_details_postcode; ?>"
                  placeholder="T.Κ" id="reg_pc" required="required" />
                  <div class="help-block with-errors"></div>
                </div>



                <div class="single_seller_form-shape form-group" id="seller_details_telephone">
                  <div class="input_label bold black">
                    Tηλέφωνο Επικοινωνίας.
                  </div>
                  <div class="country-code-transform inline-block hidden">
                    <div class="country-code-shape white4-bg grey bold">
                      +30.
                    </div>
                  </div>
                  <input name="reg_contactPhone" type="tel" class="form-control login-field"
                  value="<?php echo $seller_details_telephone; ?>"
                  placeholder="+30.XXXXXXXXXX" id="reg-contactPhone" required/>
                  <label class="login-field-icon fui-user" for="reg-contactPhone"></label>
                  <div class="help-block with-errors"></div>
                </div>


              </div>
              <div class="_row _col-md-12">
                <input type="submit" class="btn btn-success btn-send blue-bg" value="Aποθήκευση" name="reg_submit" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div> <!-- end step 2 -->

    <div id="seller_info" data-step="3" class="step text-center">


      <h3 class="text-center">
        <i class="material-icons">chrome_reader_mode</i> Πληροφορίες Επαγγελματία </h3>

        <div class="receipt_info-shape">

          <div class="input_row black shadow radius2 text-center inline-block">
            <div class="">



              <div class="single_seller_form-transform  inline-block text-left " >
                <div class="single_seller_form-shape form-group"  id="seller_details_area">
                  <div class="input_label bold black">
                    Banner
                  </div>

                  <?php
                  //  var_dump( $seller_data_banner);
                  //echo " banner ". $seller_data_banner['url'] ;
                  ?>
                  <div class="banner-transform" >
                    <div class="banner-shape">
                      <?php if($seller_data_banner!=""){
                        ?>

                        <div class="gallery-transform inline-block" data-url="<?php echo $seller_data_banner?>">
                          <div class="gallery-shape" >
                            <img src="<?php  echo get_site_url()."/".$seller_data_banner;?>"/>
                            <div class="gallery_delete-transform">
                              <div class="gallery_delete-shape pointer">
                                Διαγραφή
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
                          <input type="submit" value="Upload Photo" class="btnSubmit" />
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

          <div class="input_row black shadow radius2 text-center inline-block">
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
                  if($tmpl_post_type == "tmpl_products")
                  {

                    ?>
                    <div class="single_seller_form-shape form-group"  id="seller_details_area">
                      <div class="input_label bold black">
                        Έτος ίδρυσης : <?php echo $seller_data_founded; ?>
                      </div>

                    </div>

                    <div class="single_seller_form-shape form-group" id="seller_details_address">
                      <div class="input_label bold black">
                        Αριθμός εργαζομένων
                      </div>


                      <input name="reg_data_employees" type="text" class="form-control login-field"
                      value="<?php echo $seller_data_employees; ?>"
                      placeholder="1-3000" id="reg_data_employees" required/>
                      <div class="help-block with-errors"></div>



                    </div>
                    <?php
                  }
                  ?>



                  <div class="single_seller_form-shape form-group" id="seller_details_address">
                    <div class="input_label bold black">
                      LinkedIn
                    </div>

                    <input name="reg_linkedin" type="text" class="form-control login-field"
                    value="<?php echo $seller_data_linkedin; ?>"
                    placeholder="LinkedIn Url" id="reg_pc"  />
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="single_seller_form-shape form-group" id="seller_details_postcode">
                    <div class="input_label bold black">
                      Facebook
                    </div>

                    <input name="reg_fb" type="text" class="form-control login-field"
                    value="<?php echo $seller_data_facebook; ?>"
                    placeholder="Facebook url" id="reg_fb"  />
                    <div class="help-block with-errors"></div>
                  </div>



                  <div class="single_seller_form-shape form-group" id="seller_details_telephone">
                    <div class="input_label bold black">
                      Website
                    </div>

                    <input name="reg_web" type="text" class="form-control login-field"
                    value="<?php echo $seller_data_web; ?>"           placeholder="www.example.com"  />

                    <div class="help-block with-errors"></div>
                  </div>











                </div>
                <div class="_row _col-md-12">
                  <input type="submit" class="btn btn-success btn-send blue-bg" value="Aποθήκευση" name="reg_submit" />
                </div>
              </form>



            </div>
          </div>


          <div class="clearer">

          </div>
          <div class="input_row black shadow radius2 text-center inline-block">
            <div class="_row">
              <div class=" single_seller_form-transform inline-block text-left">

                <div class="single_seller_form-shape form-group" id="seller_details_gallery">
                  <div class="input_label bold black">
                    Gallery
                  </div>
                  <div class="gallery-container-transform">
                    <?php //echo $seller_data_gallery;

                    //var_dump($seller_data_gallery);

                    if(isset($seller_data_gallery) && $seller_data_gallery != "")
                    {
                      $gallery_array = explode(",",$seller_data_gallery);
                      foreach($gallery_array as $gallery )
                      {
                        //var_dump($gallery);
                        ?>
                        <div class="gallery-transform inline-block" data-url="<?php echo $gallery;?>">
                          <div class="gallery-shape">
                            <a href="<?php echo get_site_url()."/".$gallery;?>"><img src="<?php echo get_site_url()."/".$gallery;?>"/></a>

                            <div class="gallery_delete-transform">
                              <div class="gallery_delete-shape pointer">
                                Διαγραφή
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
          if($tmpl_post_type == "tmpl_hotels")
          {

            ?>

            <div class="input_row black shadow radius2 text-center inline-block">
              <div class="">

                <form id="hotel-form" method="post">


                <div class="  single_seller_form-transform  inline-block text-left " >
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

                <div class="clearer">

                </div>
                <div class="single_seller_form-transform  inline-block text-left " >
                  <div class="single_seller_form-shape form-group" id="seller_details_address">
                    <div class="input_label bold black">
                      Κατηγορία ξενοδοχείου
                    </div>
                    <input type="text" name="reg_seller_data_stars" value="<?php echo $seller_data_stars;?>" placeholder="..." />


                    <div class="help-block with-errors">

                    </div>
                  </div>

                </div>
                <div class="clearer">

                </div>
                <div class=" single_seller_form-transform  inline-block text-left " >
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
                <input type="submit" value="Aποθήκευση" class=" btn btn-success btn-send blue-bg" />
              </form>

              </div>
            </div>

            <div class="clearer">

            </div>


            <div class="input_row black shadow radius2 text-center inline-block">
              <div class="">



                <div class=" single_seller_form-transform  inline-block text-left " >
                  <div class="single_seller_form-shape form-group"  id="seller_details_area">
                    <div class="input_label bold black">
                      Παροχές καταλύματος
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
                          <div class="single_hotel-check">
                            <input type="checkbox" name="reg_amenities[]" value="<?php echo $counter;?>" <?php echo $checked_am;?> /><?php echo $paroxes_katal[$counter];?>
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
            </div>

            <div class="clearer">

            </div>

            <div class="input_row black shadow radius2 text-center inline-block">
              <div class="">



                <div class=" single_seller_form-transform  inline-block text-left " >
                  <div class="single_seller_form-shape form-group"  id="seller_details_area">
                    <div class="input_label bold black">
                      Παροχές δωματίων
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
                          <div class="single_hotel-check">
                            <input type="checkbox" name="reg_hotel_room_amenities[]" value="<?php echo $counter;?>" <?php echo $checked_am;?> /><?php echo $paroxes_katal[$counter];?>
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
            </div>

            <div class="clearer">

            </div>
            <?php
          }
          ?>

          <?php
          if($tmpl_post_type == "tmpl_services" )
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

                    <div class="education-button-transform">
                      <div class="education-button-shape pointer">
                          Προσθέστε εγγραφή
                      </div>

                      <div id="education_tmpl" class="hidden">
                        <div class="row single_table-row">
                          <div class="table-col col-xs-12 col-sm-6 col-md-3  ">
                              <div class="t_header bold">
                                Από - Έως
                              </div>
                              <input type="text" class="education_dates" value="" placeholder="πχ 2009 - 2011" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6 col-md-3 t_header bold">

                              <div class="t_header bold">
                                  Φορέας εκπαίδευσης
                              </div>
                              <input type="text" class="education_establishment" value="" placeholder="πχ Οικονομικό Πανεπιστήμιο Αθηνών" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6 col-md-3 t_header bold">

                              <div class="t_header bold">
                                Τίτλος
                              </div>
                              <input type="text" class="education_title" value="" placeholder="πχ Μεταπτυχιακό" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6 col-md-3 t_header bold">

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
                              <div class="table-col col-xs-12 col-sm-6 col-md-3  ">
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

                        <div class="row single_table-row" id="edu99">
                          <div class="table-col col-xs-12 col-sm-6 col-md-3  ">
                              <div class="t_header bold">
                                Από - Έως
                              </div>
                              <input type="text" class="education_dates" value="" placeholder="πχ 2009 - 2011" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6 col-md-3 t_header bold">

                              <div class="t_header bold">
                                  Φορέας εκπαίδευσης
                              </div>
                              <input type="text" class="education_establishment" value="" placeholder="πχ Οικονομικό Πανεπιστήμιο Αθηνών" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6 col-md-3 t_header bold">

                              <div class="t_header bold">
                                Τίτλος
                              </div>
                              <input type="text" class="education_title" value="" placeholder="πχ Μεταπτυχιακό" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6 col-md-3 t_header bold">

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

              <div class="row">
                <div class="col-xs-12 col-md-12  single_seller_form-transform  inline-block text-left " >
                  <div class="single_seller_form-shape form-group" id="seller_details_education">
                    <div class="input_label bold black">
                      Επαγγελματική εμπειρία
                    </div>

                    <?php
                                                  $field_titles=array(0=>'Από - Έως',1=>'Επιχείρηση',2=>'Θέση',3=>'Περιγραφή εργασίας');
                                                  $field_name=array(0=>'education_dates',1=>'education_establishment',2=>'education_title',3=>'education_educ_area');
                                                  $field_placeholders=array(0=>'πχ 2009 έως σήμερα',1=>'πχ Γιώργος Γεωργίου',2=>'πχ Ατομική Επιχείρηση',3=>'πχ Καθηγητής αγγλικής γλώσσας');?>


                    <div class="work-button-transform">
                      <div class="work-button-shape pointer">
                          Προσθέστε εγγραφή
                      </div>

                      <div id="work_tmpl" class="hidden">
                        <div class="row single_table-row">
                          <div class="table-col col-xs-12 col-sm-6 col-md-3  ">
                              <div class="t_header bold">
                                <?php echo $field_titles[0];?>
                              </div>
                              <input type="text" class="<?php echo $field_name[0];?>" value="" placeholder="<?php echo $field_placeholders[0];?>" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6 col-md-3 t_header bold">

                              <div class="t_header bold">
                                  <?php echo $field_titles[1];?>
                              </div>
                              <input type="text" class="<?php echo $field_name[1];?>" value="" placeholder="<?php echo $field_placeholders[1];?>" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6 col-md-3 t_header bold">

                              <div class="t_header bold">
                                <?php echo $field_titles[2];?>
                              </div>
                              <input type="text" class="<?php echo $field_name[2];?>" value="" placeholder="<?php echo $field_placeholders[2];?>" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6 col-md-3 t_header bold">

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
                              <div class="table-col col-xs-12 col-sm-6 col-md-3  ">
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

                          <div class="row single_table-row">
                            <div class="table-col col-xs-12 col-sm-6 col-md-3  ">
                                <div class="t_header bold">
                                  <?php echo $field_titles[0];?>
                                </div>
                                <input type="text" class="<?php echo $field_name[0];?>" value="" placeholder="<?php echo $field_placeholders[0];?>" />
                            </div>

                            <div class="table-col col-xs-12 col-sm-6 col-md-3 t_header bold">

                                <div class="t_header bold">
                                    <?php echo $field_titles[1];?>
                                </div>
                                <input type="text" class="<?php echo $field_name[1];?>" value="" placeholder="<?php echo $field_placeholders[1];?>" />
                            </div>

                            <div class="table-col col-xs-12 col-sm-6 col-md-3 t_header bold">

                                <div class="t_header bold">
                                  <?php echo $field_titles[2];?>
                                </div>
                                <input type="text" class="<?php echo $field_name[2];?>" value="" placeholder="<?php echo $field_placeholders[2];?>" />
                            </div>

                            <div class="table-col col-xs-12 col-sm-6 col-md-3 t_header bold">

                                <div class="t_header bold">
                                  <?php echo $field_titles[3];?>
                                </div>
                                <input type="text" class="<?php echo $field_name[3];?>" value="" placeholder="<?php echo $field_placeholders[3];?>" />
                            </div>
                          </div>



                      </div>
                      <input type="submit" value="Aποθήκευση" class=" btn btn-success btn-send blue-bg" />
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


                    <div class="certs-button-transform">
                      <div class="certs-button-shape pointer">
                          Προσθέστε εγγραφή
                      </div>

                      <div id="certs_tmpl" class="hidden">
                        <div class="row single_table-row">
                          <div class="table-col col-xs-12 col-sm-6 col-md-3  ">
                              <div class="t_header bold">
                                <?php echo $field_titles[0];?>
                              </div>
                              <input type="text" class="<?php echo $field_name[0];?>" value="" placeholder="<?php echo $field_placeholders[0];?>" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6 col-md-3 t_header bold">

                              <div class="t_header bold">
                                  <?php echo $field_titles[1];?>
                              </div>
                              <input type="text" class="<?php echo $field_name[1];?>" value="" placeholder="<?php echo $field_placeholders[1];?>" />
                          </div>

                          <div class="table-col col-xs-12 col-sm-6 col-md-6 t_header bold">

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

                          <div class="row single_table-row">
                            <div class="table-col col-xs-12 col-sm-6 col-md-3  ">
                                <div class="t_header bold">
                                  <?php echo $field_titles[0];?>
                                </div>
                                <input type="text" class="<?php echo $field_name[0];?>" value="" placeholder="<?php echo $field_placeholders[0];?>" />
                            </div>

                            <div class="table-col col-xs-12 col-sm-6 col-md-3 t_header bold">

                                <div class="t_header bold">
                                    <?php echo $field_titles[1];?>
                                </div>
                                <input type="text" class="<?php echo $field_name[1];?>" value="" placeholder="<?php echo $field_placeholders[1];?>" />
                            </div>

                            <div class="table-col col-xs-12 col-sm-6 col-md-6 t_header bold">

                                <div class="t_header bold">
                                  <?php echo $field_titles[2];?>
                                </div>
                                <input type="text" class="<?php echo $field_name[2];?>" value="" placeholder="<?php echo $field_placeholders[2];?>" />
                            </div>


                          </div>



                      </div>
                      <input type="submit" value="Aποθήκευση" class=" btn btn-success btn-send blue-bg" />
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
          if($tmpl_post_type == "tmpl_products" || $tmpl_post_type == "tmpl_hotels")
          {

            ?>
            <div class="input_row black shadow radius2 text-center inline-block">
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
                                <div class="gallery_delete-shape pointer">
                                  Διαγραφή
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


      <div id="categories_details" data-step="4" class="step text-center">

        <h3 class="text-center"><i class="material-icons">account_circle</i> Επιλογή Κατηγοριών </h3>
        <form id="categories-form" method="post">

          <input type="submit" name="submit_cats" class=" btn btn-success btn-send blue-bg" value="Αποθήκευση"/>
          <div class="cateogories_container-transform">



            <?php
            $subscription_cat = get_post($seller_details_subscription_id_ID);

            $subscription_root_category = @get_field("subscription_root_category",$subscription_cat->ID);

            echo getAccountSubcategories_html($subscription_root_category->ID);

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
  </form>
</div>



<?php
/*$array_temp = array("0"=>3396);

remove_offers_from_inquiry($array_temp,get_current_user_id());*/
?>

<div id="areas_details" data-step="5" class="step text-center">

  <h3 class="text-center"><i class="material-icons">account_circle</i> Επιλογή Περιοχών </h3>
  <form id="areas-form" method="post">

    <input type="submit" name="submit_areas"  class=" btn btn-success btn-send blue-bg" value="Αποθήκευση"/>
    <div class="areas_container-transform">



      <?php
      $subscription_cat = get_post($seller_details_subscription_id_ID);

      $subscription_root_category = @get_field("subscription_root_category",$subscription_cat->ID);

      echo getAreas_html(0);

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
</form>
</div>




</div>
</div>
