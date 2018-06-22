<?php

if($tmpl_post_type == "tmpl_services" || $debug ==1)
{

  ?>


  <div class="container services_info_container  login-form ">

    <div class="row">


      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">

        <div class="services_details_box-transform">
          <div class="services_details_box-shape text-left white-bg shadow">
            <div class="services_details_box_title-shape blue-bg white bold">
               Έτη Προυπηρεσίας
            </div>

            <div class="services_data_list-transform">
              <div class="services_data_list-shape">
                <div class="single_seller_form-shape form-group" id="seller_details_address">

                  <select name="reg_age" class="editable" id="reg_data_age" required>
                    <?php
                      if( $seller_data_age == "1 έως 5")
                      {
                        $checked="checked";
                      }else {
                        $checked="";
                      }
                     ?>
                    <option value="1 έως 5" <?php echo $checked;?>>
                      1 έως 5
                    </option>

                    <?php
                      if( $seller_data_age == "6 έως 10")
                      {
                        $checked="checked";
                      }else {
                        $checked="";
                      }
                     ?>
                    <option value="6 έως 10" <?php echo $checked;?>>
                      6 έως 10
                    </option>

                    <?php
                      if( $seller_data_age == "11 έως 15")
                      {
                        $checked="checked";
                      }else {
                        $checked="";
                      }
                     ?>
                    <option value="11 έως 15" <?php echo $checked;?>>
                    11 έως 15
                    </option>

                    <?php
                      if( $seller_data_age == "16  έως 20")
                      {
                        $checked="checked";
                      }else {
                        $checked="";
                      }
                     ?>
                    <option value="16  έως 20" <?php echo $checked;?>>
                     16  έως 20
                    </option>

                    <?php
                      if( $seller_data_age == "20+")
                      {
                        $checked="checked";
                      }else {
                        $checked="";
                      }
                     ?>
                    <option value="20+" <?php echo $checked;?>>
                      20+
                    </option>

                  </select>

                    <?php
              /*    <input name="reg_age" type="text" class="form-control login-field"
                  value="<?php echo $seller_data_age; ?>"
                  placeholder="18 - 100" id="reg_hotel_rooms" required/>
                  <div class="help-block with-errors"></div>*/

                  ?>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>













<?php



$seller_data_pool = $seller_data_education;

$cat_title = "Εκπαίδευση";
$form_id= "education-form";
$rows_id="education-rows";
$tmpl_id="education_tmpl";

$button_prefix = "education-button";
$id_prefix="edu";
$fields_array = array();

$fields_array[0] = array('field_title'=>'Από - Έως','input_class'=>'education_dates','placeholder'=>'πχ 2009 - 2011');
$fields_array[1] = array('field_title'=>'Φορέας εκπαίδευσης','input_class'=>'education_establishment','placeholder'=>'πχ Οικονομικό Πανεπιστήμιο Αθηνών');
$fields_array[2] = array('field_title'=>'Τίτλος','input_class'=>'education_title','placeholder'=>'πχ Μεταπτυχιακό');
$fields_array[3] = array('field_title'=>'Τομέας εκπαίδευσης','input_class'=>'education_educ_area','placeholder'=>'πχ Οργάνωση και Διοίκηση Επιχειρήσεων');

$row_cols='col-xs-12 col-sm-6 col-md-4 col-lg-3';


    include("services_single_info.php");

    ?>



  <?php


  $seller_data_pool = $seller_data_work;
  $cat_title = "Επαγγελματική εμπειρία";
  $tmpl_id="work_tmpl";
  $form_id= "work-form";
  $rows_id="work-rows";

  $button_prefix = "work-button";
  $id_prefix="work";
  $fields_array = array();

  $fields_array[0] = array('field_title'=>'Από - Έως','input_class'=>'education_dates','placeholder'=>'πχ 2009 έως σήμερα');
  $fields_array[1] = array('field_title'=>'Επιχείρηση','input_class'=>'education_establishment','placeholder'=>'πχ Ατομική Επιχείρηση');
  $fields_array[2] = array('field_title'=>'Θέση','input_class'=>'education_title','placeholder'=>'πχ Υπάλληλος');
  $fields_array[3] = array('field_title'=>'Περιγραφή εργασίας','input_class'=>'education_educ_area','placeholder'=>'πχ Καθηγητής αγγλικής γλώσσας');


$row_cols='col-xs-12 col-sm-6 col-md-4 col-lg-3';


      include("services_single_info.php");

      ?>


      <?php

          $seller_data_pool = $seller_data_qualifications_list;
          $cat_title = "Πιστοποιήσεις";
          $tmpl_id="certs_tmpl";
          $form_id= "certs-form";
          $rows_id="certs-rows";

          $button_prefix = "certs-button";
          $id_prefix="certs";
          $fields_array = array();

          $fields_array[0] = array('field_title'=>'Από - Έως','input_class'=>'education_dates','placeholder'=>'πχ 2012');
          $fields_array[1] = array('field_title'=>'Φορέας πιστοποίησης','input_class'=>'education_establishment','placeholder'=>'πχ Οικονομικό επιμελητήριο');
          $fields_array[2] = array('field_title'=>'Τομέας εκπαίδευσης','input_class'=>'education_title','placeholder'=>'πχ Λογιστής Ά Τάξης');


$row_cols='col-xs-12 col-sm-6 col-md-4 col-lg-4';
          include("services_single_info.php");

      ?>


      <?php
    }
    ?>
