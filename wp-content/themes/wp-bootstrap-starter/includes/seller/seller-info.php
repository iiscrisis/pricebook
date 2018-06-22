<div id="seller_info" data-step="3" class=" text-center ">




    <div class="receipt_info-shape text-left">

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
                    $args = array(
                    	'post_parent' => HOTEL,
                    	'post_type'   => 'any',
                    	'numberposts' => -1,
                    	'post_status' => 'any'
                    );
                    $children = get_children( $args );


                    $hotel_type_array = array();
/*
                    $hotel_type_array[0] ='Ξενοδοχείο';
                    $hotel_type_array[1] ='Ενοικιαζόμενα Δωμάτια';
                    $hotel_type_array[2] ='Ξενώνας';
                    $hotel_type_array[3] ='Βίλα';
                    $hotel_type_array[4] ='Bed & Breakfast';
                    $hotel_type_array[5] ='Κάμπινγκ';


*/                  $counter = 0;
                    foreach($children as  $htype)
                    {
                      $hotel_type_array[$counter++] = $htype;
                    }

                    foreach($hotel_type_array as $key=> $type)
                    {

                      if($key == $seller_data_hotel_type)
                      {
                        $selected ="selected";
                        $cat_post_id  = $type->ID;
                      }else {
                        # code...
                        $selected ="";
                      }
                      ?>

                      <option value="<?php echo $key;?>" <?php echo $selected ;?>><?php  echo $type->post_title;?></option>
                      <?php
                    }
                    ?>
                  </select>

                  <div class="help-block with-errors"></div>
                </div>
              </div>



<?php
              $has_category  = get_field("hotel_has_category",$cat_post_id);
              if($has_category == 1)
              {
                ?>
                <div class="single_seller_form-transform vertical-top inline-block text-left " >
                  <div class="single_seller_form-shape form-group" id="seller_details_address">
                    <div class="input_label bold black">
                      Κατηγορία ξενοδοχείου
                    </div>


                    <select name="reg_seller_data_stars">
                      <?php


                      $hotel_stars_array = array();

                      $hotel_stars_array[0] ='1 αστέρι';
                      $hotel_stars_array[1] ='2 αστέρια';
                      $hotel_stars_array[2] ='3 αστέρια';
                      $hotel_stars_array[3] ='4 αστέρια';
                      $hotel_stars_array[4] ='5 αστέρια';



                      $counter = 0;


                      foreach($hotel_stars_array as $key=> $type)
                      {

                        if($key == $seller_data_stars)
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

                    <div class="help-block with-errors">

                    </div>
                  </div>

                </div>
              <?php
              }


  ?>

  <?php
                $has_category  = get_field("hotel_has_rooms",$cat_post_id);
                if($has_category == 1)
                {
                  ?>
              <div class=" single_seller_form-transform vertical-top inline-block text-left " >
                <div class="single_seller_form-shape form-group" id="seller_details_address">
                  <div class="input_label bold black">
                  <?php echo get_field("hotel_rooms_title",$cat_post_id);?>
                  </div>


                  <input name="reg_hotel_rooms" type="text" class="form-control login-field"
                  value="<?php echo $seller_data_rooms; ?>"
                  placeholder="1 - 2000" id="reg_hotel_rooms" required/>
                  <div class="help-block with-errors"></div>

                </div>

              </div>

            <?php } ?>
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

        


                        $paroxes_katal[0]="24ωρη παροχή ζεστού νερού";
                        $paroxes_katal[1]="Πρόσβαση σε ηλεκτρικό ρεύμα";
                        $paroxes_katal[2]="Ανδρικά - Γυναικεία WC (ξεχωριστές εγκαταστάσεις)";
                        $paroxes_katal[3]="Ανδρικά - Γυναικεία Ντους (ξεχωριστές εγκαταστάσεις)";
                        $paroxes_katal[4]="Αποχέτευση για χημική τουαλέτα";
                        $paroxes_katal[5]="Δωρεάν Wi-Fi";
                        $paroxes_katal[6]="Δωρεάν Parking";
                        $paroxes_katal[7]="Δωρεάν μετακίνηση από / προς το αεροδρόμιο";
                        $paroxes_katal[8]="24ωρη reception";
                        $paroxes_katal[9]="Δωρεάν πρωινό γεύμα";
                        $paroxes_katal[10]="Αναψυκτήριο - Καφετέρια";
                        $paroxes_katal[11]="Εστιατόριο";
                        $paroxes_katal[12]="Bar";
                        $paroxes_katal[13]="Mini Market";
                        $paroxes_katal[14]="Καθαριστήριο";
                        $paroxes_katal[15]="Κουζίνα / Χώρος Μαγειρέματος";
                        $paroxes_katal[16]="Ψυγείο & Καταψύκτης";
                        $paroxes_katal[17]="Πλυντήριο Ρούχων";
                        $paroxes_katal[18]="Φαρμακείο";
                        $paroxes_katal[19]="Εξωτερική πισίνα";
                        $paroxes_katal[20]="Εσωτερική πισίνα";
                        $paroxes_katal[21]="Ξαπλώστρες για την παραλία / πισίνα";
                        $paroxes_katal[22]="Ομπρέλες για την παραλία / πισίνα";
                        $paroxes_katal[23]="Πετσέτες για την παραλία / πισίνα";
                        $paroxes_katal[24]="Κέντρο ευεξίας / Spa";
                        $paroxes_katal[25]="Γυμναστήριο";
                        $paroxes_katal[26]="Κομμωτήριο";
                        $paroxes_katal[27]="Ιατρός";
                        $paroxes_katal[28]="Προσωπικές θυρίδες ασφαλείας";
                        $paroxes_katal[29]="24ωρη φύλαξη";
                        $paroxes_katal[30]="Ναυαγοσώστης";
                        $paroxes_katal[31]="Water Sports";
                        $paroxes_katal[32]="Παιδότοπος / Παιδική Χαρά";
                        $paroxes_katal[33]="Μίσθωση Ποδηλάτων";
                        $paroxes_katal[34]="Μίσθωση Αυτοκινήτων";
                        $paroxes_katal[35]="Μίσθωση Σκαφών";
                        $paroxes_katal[36]="Γήπεδο beach soccer";
                        $paroxes_katal[37]="Γήπεδο beach volley";
                        $paroxes_katal[38]="Δορυφορική Τηλεόραση";
                        $paroxes_katal[39]="Room service";
                        $paroxes_katal[40]="Barbecue";
                        $paroxes_katal[41]="Δωμάτια για ΑΜΕΑ";
                        $paroxes_katal[42]="Χώροι υγιεινής για ΑΜΕΑ";
                        $paroxes_katal[43]="Δωμάτια για μη καπνίζοντες";
                        $paroxes_katal[44]="Αντιαλλεργικά δωμάτια";
                        $paroxes_katal[45]="Συνεδριακός χώρος";
                        $paroxes_katal[46]="Επιτρέπονται τα κατοικίδια";


                      //get hotel amenities

                      $hotel_amenities_list = get_field("hotel_amenities_list",$cat_post_id);

                      $hotel_amenities_array = explode(",",$hotel_amenities_list);
                    //  print_r($hotel_amenities_array);

                      //var_dump($seller_data_amenities);
                      for($counter=0; $counter < sizeof($paroxes_katal); $counter++){
                        $checked_am = "";
                        if(!in_array($counter,$hotel_amenities_array) && (sizeof($hotel_amenities_array) > 0 && $hotel_amenities_array[0]!="")  )
                        {
                          continue;
                        }

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

                      $room_amenities_list = get_field("room_amenities_list",$cat_post_id);
                      $room_amenities_array = explode(",",$hotel_amenities_list);

                      $paroxes_katal = array();
                      $paroxes_katal[0]="24ωρη παροχή ζεστού νερού";
                      $paroxes_katal[1]="Κλιματισμός";
                      $paroxes_katal[2]="Καλοριφέρ";
                      $paroxes_katal[3]="Τηλεόραση";
                      $paroxes_katal[4]="Πλυντήριο ρούχων";
                      $paroxes_katal[5]="Χρηματοκιβώτιο";
                      $paroxes_katal[6]="Φούρνος μικροκυμάτων";
                      $paroxes_katal[7]="Κουζίνα";
                      $paroxes_katal[8]="Ψυγείο";
                      $paroxes_katal[9]="Τζάκι";
                      $paroxes_katal[10]="Πιστολάκι μαλλιών";
                      $paroxes_katal[11]="Βραστήρας";
                      $paroxes_katal[12]="Καφετιέρα";
                      $paroxes_katal[13]="Θέα";
                      $paroxes_katal[14]="Μπαλκόνι";
                      $paroxes_katal[15]="Βεράντα / Αυλή";







                      for($counter=0; $counter <  sizeof($paroxes_katal); $counter++){
                        $checked_am = "";


                        if(!in_array($counter,$room_amenities_array) && (sizeof($room_amenities_array) > 0 && $room_amenities_array[0]!="")  )
                        {
                          continue;
                        }
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

    <?php include("services_info.php");?>




      </div>
    </div>
