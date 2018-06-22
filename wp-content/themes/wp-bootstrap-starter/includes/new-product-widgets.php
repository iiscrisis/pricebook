<div class="col-xs-12 col-sm-6 col-md-7 col-lg-6  _col-lg-offset-2 left-new-application-col">
  <div class='new-application-main-transform'>

    <div class='new-application-main-shape _content_padding'>

<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 select-category-lists">



    <div class="select-category-transform">

      <div class="select-category-shape <?php //echo $active;?>">


    <div class="summary-subtitle bold white-bg black2 _shadow">
      <?php echo $overtitle;?>
       <?php echo $headTitle;?>

    </div>


</div>
</div>

<div class="select-category-transform">

  <div class="select-category-shape <?php //echo $active;?>">

    <div class='select-category-input-transform'>
      <div class='select-category-input-shape input-style grey4 _shadow _input_row white-bg '>

        <div class="selection-list-transform">
          <div class="selection-list-shape">

            <div class="selection-list-wrapper">

              <div class="single-selection-title-transform ">

                <div class="single-selection-title-shape black bold">


                 Eνδιαφέρομαι για <span class="red">*</span>
                 <div class="info_box  inline-block pointer" data-wenk="blah blah blah" data-wenk-pos="right">
                  <i class="material-icons  white5" >info</i>
                </div>

                </div>

              </div>
              <div class="more-transform">
                <div class="more-shape">

                  <?php
                /*  $settings = array( 'textarea_rows' => 3);
                  wp_editor( "", "inquiry_text",$settings);*/

              /*    wp_editor('', 'inquiry_text', array('textarea_rows' => 3,
   'tinymce' => array(
       'init_instance_callback' => 'function(editor) {
                   editor.on("focus", function(){

                       console.log("Editor: " + editor.id + " focus.");
               });
           }'
       )
));*/
                  ?>
                  <textarea class="form-control black2" name="inquiry_text" placeholder="Περιγράψτε τι αναζητείτε"></textarea>
              </div>
            </div>

            <?php
                  if(is_user_logged_in()  )
                  {
                    ?>



                    <div class="image-upload-transform text-left ">
                      <div class="image-upload-shape">
                        <form id="image-upload" method="post" action="#">

                          <div id="banner_preview">

                            <div id="image-upload">
                              <input type="hidden" name="action" value="uploadImageFiles" />
                              <div id="targetOuter">
                                <div id="targetLayer"></div>

                                <div class="user-photo-btn white3-bg radius6 pointer bold blue">
                                  <i class="material-icons middle">
camera
</i>    Επιλέξτε Φωτογραφία
                                </div>

                                <div class="icon-choose-image inline-block middle" >
                                  <input name="photo" id="userImage" type="file" class="inputFile hidden" onChange="" />
                                </div>

                                <div class=" inline-block middle">
                                 <input type="submit" value="Ανεβάστε τη Φωτογραφία" class="btnSubmit _action_button_shape btn-success btn upload_inquiry_image disabledbutton  white"/>
                               </div>
                              </div>

                              <div class="grey6 file_name_display light">

                              </div>

                            </div>
                          </div>


                    </form>
                  </div>
                  </div>




                            <?php
                            }
                          ?>



            </div>

            <input type="hidden" name="inquiry_image" id="inquiry_image" value=""/>



          </div>

        </div> <!-- selection-list-transform -->

      </div>

    </div>

  </div>

</div>

    <div class="select-category-transform">

      <div class="select-category-shape <?php //echo $active;?>">

        <div class='select-category-input-transform'>

          <div class='select-category-input-shape dropdown input-style grey _shadow _input_row white-bg country_selection'>

            <div class="select-category-heightOffset grey4">
                Επιλέξτε Περιοχή
            </div>

            <div class="selection-list-transform">
              <div class="selection-list-shape">
                <div class="selection-list-wrapper">
                  <div class="single-selection-title-transform ">
                    <div class="single-selection-title-shape black bold">

                            Επιλέξτε Περιοχή
                            <div class="info_box  inline-block pointer" data-wenk="blah blah blah" data-wenk-pos="right">
                             <i class="material-icons  white5" >info</i>
                           </div>
                    </div>
                  </div>



                  <?php
                    $data = get_posts(array(
                      'numberposts'=>-1,
                      'post_type'=>'areas',
                      'orderby'=>'title',
                      'order' => 'ASC'
                    ));
                    $countIndex = 0;

                    $areas_array = array();

                    foreach($data as $area)
                    {
                      if($area->post_parent == 0)
                      {
                        $areas_array[$area->ID]['title'] = $area->post_title;
                      }else {
                        $areas_array[$area->post_parent]["areas"][$area->ID]['title'] = $area->post_title;
                        $areas_array[$area->post_parent]["areas"][$area->ID]['longlat'] = get_field('area_longlat',$area->ID,false);
                      }
                    }

                    //var_dump($areas_array);


                    ?>

                    <script type="text/javascript">

                    var states = [];
                    var states_value = [];
                    </script>
                    <select name="inquiry_areas" _multiple_ class="region_select black " id="inquiry_areas_select">
                      <option class="black area_option filtered" value="">  </option>
                            <?php
                            $group_cnt = 0;
                            $area_counter = 0;
                            foreach($areas_array as $area)
                            {?>
                              <optgroup class="black area_optgroup filtered" label="<?php echo $area['title'];?>">
                                <?php
                                foreach($area['areas'] as $key => $subarea)
                                {
                                  $id = "option_$group_cnt_$area_counter";
                                  ?>
                                  <option class="black area_option filtered" value="<?php echo $key; ?>" data-longlat="<?php echo $subarea['longlat'];?>" id="<?php echo $id;?>">
                                      <div class="area_option_title"  data-longlat="<?php echo $subarea['longlat'];?>">
                                        <?php echo $subarea['title']; ?>
                                      </div>



                                  </option>

                                  <script type="text/javascript">
                                    states.push("<?php echo $subarea['title']; ?>");
                                  //  var area_group_key = [<?php echo $group_cnt;?>,<?php echo $area_counter;?>];
                                    states_value['<?php echo $key;?>'] = '<?php echo $subarea['longlat'];?>';
                                  </script>
                                <?php
                                $area_counter++;
                                }
                                 ?>
                              </optgroup>
                              <?php
                              $group_cnt++;
                            }

                             ?>

                  </select>
                </div>
              </div>

            </div> <!-- selection-list-transform -->



            <div class="selection-list-arrow-transform">

              <div class="selection-list-arrow-shape">



                <div class="menu-small-arrow-shape selection-action-button">

                  <div class="arrow-down grey4">



                  </div>

                </div>



              </div>

            </div>



          </div>

        </div>

      </div>

    </div> <!--select-category-transform-->







    <div class="select-category-transform products-entry">

      <div class="select-category-shape <?php //echo $active;?>">

        <div class='select-category-input-transform'>

          <div class='select-category-input-shape input-style grey4 _shadow _input_row white-bg '>
            <div class="selection-list-transform">

              <div class="selection-list-shape">

                <div class="selection-list-wrapper">
                  <div class="single-selection-title-transform ">

                    <div class="single-selection-title-shape black bold">

                       Ποσότητα
                       <div class="info_box  inline-block pointer" data-wenk="blah blah blah" data-wenk-pos="right">
                        <i class="material-icons  white5" >info</i>
                      </div>

                    </div>

                  </div>


                  <div class="quantity-transform quantity _right">

                    <div class="quantity-shape">

                      <div class="counter-tool-transform">

                        <div class="counter-tool-shape">



                          <div class="counter-tool-button-transform">

                            <div class="counter-tool-button-shape  grey4 minus_button">

                              <i class="material-icons blue ">remove_circle</i>

                            </div>

                          </div>


                          <div class="counter-tool-button-transform">

                            <div class="counter-tool-input-shape  blue ">

                              <input type="text" class="form-control" name="inquiry_product_quantities" required value="1" onkeypress='return isNumber(event)'/>


                            </div>

                          </div>

                          <div class="counter-tool-button-transform">

                            <div class="counter-tool-button-shape  grey4 plus_button">

                               <i class="material-icons blue ">add_circle</i>

                            </div>

                          </div>
                        </div>

                      </div>

                    </div>

                  </div>
                </div>
              </div>

            </div> <!-- selection-list-transform -->

          </div>

        </div>

      </div>

    </div>





    <div class="select-category-transform hotel-entry">

      <div class="select-category-shape <?php //echo $active;?>">
        <div class='select-category-input-transform'>
          <div class='select-category-input-shape input-style grey4 _shadow _input_row white-bg '>
            <div class="selection-list-transform">

              <div class="selection-list-shape">

                <div class="selection-list-wrapper">
                  <div class="single-selection-title-transform ">

                    <div class="single-selection-title-shape black bold">

                          Άτομα
                          <div class="info_box  inline-block pointer" data-wenk="blah blah blah" data-wenk-pos="right">
                           <i class="material-icons  grey4" >info</i>
                         </div>

                    </div>

                  </div>

                  <div class="clearer">

                  </div>

                  <div class="quantity-transform persons inline-block">

                    <div class="quantity-shape">



                      <div class="counter-tool-transform">

                        <div class="counter-tool-shape">

                          <div class="counter-tool-button-transform">

                            <div class="counter-label-shape grey4 ">

                            Ενήλικες :

                            </div>
                          </div>


                          <div class="counter-tool-button-transform">
                            <div class="counter-tool-button-shape  grey4 minus_button">
                            <i class="material-icons blue ">remove_circle</i>
                            </div>
                          </div>


                          <div class="counter-tool-button-transform">

                            <div class="counter-tool-input-shape  blue ">

                              <input type='text'class="form-control" name="inquiry_persons_quantities" value="1" required onkeypress='return isNumber(event)'/>

                            </div>

                          </div>

                          <div class="counter-tool-button-transform">

                            <div class="counter-tool-button-shape  grey4 plus_button">

                             <i class="material-icons blue ">add_circle</i>

                            </div>
                          </div>



                        </div>

                      </div>





                    </div>

                  </div>


                  <div class="quantity-transform children  inline-block right" id="kids_counter">


                    <div class="quantity-shape">

                      <div class="counter-tool-transform">

                        <div class="counter-tool-shape">

                          <div class="counter-tool-button-transform">

                            <div class="counter-label-shape  grey4 ">

                            Aνήλικοι :

                            </div>
                          </div>


                          <div class="counter-tool-button-transform">
                            <div class="counter-tool-button-shape  grey4 minus_button">
                            <i class="material-icons blue ">remove_circle</i>
                            </div>
                          </div>

                          <div class="counter-tool-button-transform">

                            <div class="counter-tool-input-shape  blue ">

                              <input type='text' class="form-control" name="inquiry_children_quantities" value="0" onkeypress='return isNumber(event)' required />

                            </div>

                          </div>

                          <div class="counter-tool-button-transform">

                            <div class="counter-tool-button-shape  grey4 plus_button">

                               <i class="material-icons blue ">add_circle</i>

                            </div>
                          </div>



                        </div>

                      </div>





                    </div>

                  </div>

                  <div id="kids_tmpl" class="hidden">

                    <div class="kids_age-transform inline-block single_kids_age_list">
                      <div class="kids_age-shape login-form">
                        <select class="kids_age_list">
                          <?php for($i=1;$i<18;$i++)
                          {
                            ?>
                            <option value="<?php echo $i;?>">
                              <?php echo $i;?>
                            </option>

                            <?php
                          }?>
                          </select>
                      </div>
                    </div>

                  </div>
                  <div id="kids_age_container" class="hidden">
                    <div class="kids_container-title">
                      Hλικία Παιδιών κατα την άφιξη
                    </div>

                    <div id="kids_age_container_lists">

                    </div>
                  </div>

                </div>
              </div>

            </div> <!-- selection-list-transform -->

          </div>

        </div>

      </div>

    </div>


    <div class="select-category-transform hotel-entry">

      <div class="select-category-shape <?php //echo $active;?>">
        <div class='select-category-input-transform'>
          <div class='select-category-input-shape input-style grey4 _shadow _input_row white-bg '>
            <div class="selection-list-transform">

              <div class="selection-list-shape">

                <div class="selection-list-wrapper">
                  <div class="single-selection-title-transform ">

                    <div class="single-selection-title-shape black bold">
                        Δωμάτια
                        <div class="info_box  inline-block pointer" data-wenk="blah blah blah" data-wenk-pos="right">
                         <i class="material-icons  grey4" >info</i>
                       </div>
                    </div>

                  </div>

                  <div class="clearer">

                  </div>

                  <div class="quantity-transform single_rooms inline-block">
                    <div class="quantity-shape">
                      <div class="counter-tool-transform">
                        <div class="counter-tool-shape">
                          <div class="counter-tool-button-transform">
                            <div class="counter-label-shape grey4 ">
                            Μονόκλινα :
                            </div>
                          </div>

                          <div class="counter-tool-button-transform">
                            <div class="counter-tool-button-shape  grey4 minus_button">
                          <i class="material-icons blue ">remove_circle</i>
                            </div>
                          </div>

                          <div class="counter-tool-button-transform">
                            <div class="counter-tool-input-shape  blue ">
                              <input type='text' class="form-control" name="inquiry_single_rooms_quantities" value="1" onkeypress='return isNumber(event)' required />
                            </div>

                          </div>

                          <div class="counter-tool-button-transform">
                            <div class="counter-tool-button-shape  grey4 plus_button">
                                <i class="material-icons blue ">add_circle</i>
                            </div>
                          </div>



                        </div>

                      </div>





                    </div>

                  </div>



                  <div class="quantity-transform double_rooms inline-block right">

                    <div class="quantity-shape">

                      <div class="counter-tool-transform">

                        <div class="counter-tool-shape">

                          <div class="counter-tool-button-transform">

                            <div class="counter-label-shape  grey4 ">

                            Δίκλινα :

                            </div>
                          </div>


                          <div class="counter-tool-button-transform">
                            <div class="counter-tool-button-shape  grey4 minus_button">

                                <i class="material-icons blue ">remove_circle</i>
                            </div>
                          </div>

                          <div class="counter-tool-button-transform">

                            <div class="counter-tool-input-shape  blue ">

                              <input type='text' class="form-control" name="inquiry_double_rooms_quantities" value="0" onkeypress='return isNumber(event)' required />

                            </div>

                          </div>

                          <div class="counter-tool-button-transform">

                            <div class="counter-tool-button-shape  grey4 plus_button">

                            <i class="material-icons blue ">add_circle</i>

                            </div>
                          </div>



                        </div>

                      </div>





                    </div>

                  </div>

                </div>
              </div>

            </div> <!-- selection-list-transform -->

          </div>

        </div>

      </div>

    </div>





    <div class="select-category-transform"  id="price-range">

      <div class="select-category-shape <?php //echo $active;?>">
        <div class='select-category-input-transform'>
          <div class='select-category-input-shape input-style grey4 _shadow _input_row white-bg '>
            <div class="selection-list-transform" >

              <div class="selection-list-shape">

                <div class="selection-list-wrapper">

                  <div class="single-selection-title-transform ">

                    <div class="single-selection-title-shape black bold">

                      <span class="services-entry">  Τιμή</span>
                         <span class="hotel-entry">  Τιμή Διανυκτέρευσης</span>
                          <span class="products-entry">  Τιμή Μονάδος</span>
                    </div>
                  </div>

                  <div class="price-transform">
                    <div class="price-shape">

                    <div class="row">
                      <div class="inline-block middle price_range_input">
                        <div class="_input-set-transform text-left inline-block">
                          <div class="input_label-transform inline-block">
                            <div class="input_label-shape grey">
                              Από
                            </div>
                          </div>

                          <div class="price-tool-button-transform inline-block middle">
                            <div class="price-tool-input-shape  black2 ">
                              <input type="number" class="form-control inline-block middle" name="inquiry_min_price" required placeholder="0.00" value="0" onkeypress='return makeFloat(event)' /> &euro;
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="inline-block middle price_range_input">
                        <div class="_input-set-transform text-left inline-block right">
                          <div class="input_label-transform inline-block">
                            <div class="input_label-shape grey">
                              Έως
                            </div>
                          </div>



                          <div class="counter-tool-button-transform inline-block ">
                            <div class="price-tool-input-shape  black2 ">
                              <input type="number" class="form-control inline-block middle" name="inquiry_max_price" onkeypress='return makeFloat(event)' required placeholder="..."/> &euro;
                            </div>
                          </div>
                        </div>

                      </div>




                      <div class="clearer">
                        <br/>

                      </div>

                      <div class="col-xs-12 ">
                        <div class="_input-set-transform text-left inline-block text-left">



                          <div class="counter-tool-button-transform inline-block">
                            <div class="ckbx-style-8">
                              <input id="ckbx-style-8-1" value="0" name="inquiry_no_range" type="checkbox">
                              <label for="ckbx-style-8-1"></label>
                            </div>
                          </div>

                          <div class="input_label-transform inline-block">
                            <div class="input_label-shape blue">
                              Επιθυμώ συγκεκριμένο έυρος τιμών
                            </div>
                          </div>

                        </div>
                      </div>



                    </div>




                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- selection-list-transform -->
          </div>
        </div>
      </div>
    </div>

    <div class="select-category-transform hotel-entry"  >

      <div class="select-category-shape <?php //echo $active;?>">

        <div class='select-category-input-transform'>

          <div class='select-category-input-shape input-style grey4 _shadow _input_row white-bg '>

            <div class="selection-list-transform"  id="date-range-hotel">

              <div class="selection-list-shape">

                <div class="selection-list-wrapper">


                  <div class="single-selection-title-transform ">

                    <div class="single-selection-title-shape black bold">

                          Ημερομηνίες
                          <div class="info_box  inline-block pointer" data-wenk="blah blah blah" data-wenk-pos="right">
                           <i class="material-icons  white5" >info</i>
                         </div>

                    </div>

                  </div>


                  <div class="date-transform">

                    <div class="date-shape">

                      <div class="date-tool-transform">

                        <div class="date-tool-shape">

                          <div class="input-set-transform text-left">

                            <div class="input_label-transform">

                              <div class="input_label-shape grey">

                                Από

                              </div>

                            </div>



                            <div class="date-tool-button-transform">
                              <div class="date-tool-input-shape  blue ">
                                <input type="text" class="form-control" name="inquiry_hotel_start_date" onkeydown="return false" required />
                              </div>

                            </div>



                            <div class="calendar-icon-transform">

                              <div class="calendar-icon-shape">
                                <i class="material-icons blue">date_range</i>


                              </div>

                            </div>

                          </div>



                          <div class="input-set-transform text-left right">
                            <div class="input_label-transform">
                              <div class="input_label-shape grey">
                                Έως
                              </div>

                            </div>



                            <div class="date-tool-button-transform">
                              <div class="date-tool-input-shape  blue ">
                                <input type="text" class="form-control" name="inquiry_hotel_end_date" onkeydown="return false" required />
                              </div>

                            </div>



                            <div class="calendar-icon-transform">

                              <div class="calendar-icon-shape">

                                <i class="material-icons blue">date_range</i>

                              </div>

                            </div>

                          </div>



                        </div>

                      </div>

                    </div>

                  </div>





                </div>





              </div>

            </div> <!-- selection-list-transform -->

          </div>

        </div>

      </div>

    </div>

    <div class="select-category-transform services-entry"  >

      <div class="select-category-shape <?php //echo $active;?>">

        <div class='select-category-input-transform'>

          <div class='select-category-input-shape input-style grey4 _shadow _input_row white-bg '>

            <div class="selection-list-transform"  id="date-range-hotel">

              <div class="selection-list-shape">

                <div class="selection-list-wrapper">


                  <div class="single-selection-title-transform ">

                    <div class="single-selection-title-shape black bold">

                        Ημερομηνίες
                        <div class="info_box  inline-block pointer" data-wenk="blah blah blah" data-wenk-pos="right">
                         <i class="material-icons  white5" >info</i>
                        </div>
                    </div>

                  </div>


<?php
/*
<div class="pretty p-icon p-curve p-rotate">
        <input type="radio" name="radio66">
        <div class="state p-success-o">
            <i class="icon mdi mdi-check"></i>
            <label> Javascript</label>
        </div>
    </div>
    */
 ?>
                  <div class="services-date-range-transform">
                    <div class="services-date-range-shape">
                        <input type="hidden" name="inquiry_service_start_dates" value="Άμεσα" / >
                      <div class="inline-block service_start_date_select">


                    <input type="radio" class="" name="inquiry_service_start_date_select" value="now" checked> <span>Άμεσα</span>
                      </div>

                      <div class="inline-block service_start_date_select">
                        <input type="radio" class="" name="inquiry_service_start_date_select" value="7days"> <span>Εντός 15 ημερών</span>
                      </div>

                      <div class="inline-block service_start_date_select">
                        <input type="radio" class="between-days" name="inquiry_service_start_date_select" value="between"><span> Μεταξύ</span>
                      </div>

                      <div class="inline-block service_start_date_select">
                        <input type="radio" class="specific_day" name="inquiry_service_start_date_select" value="specific"> <span>Συγκεκριμένη ημέρα</span>
                      </div>

                    </div>
                  </div>


                  <div class="date-transform">

                    <div class="date-shape">

                      <div class="date-tool-transform">

                        <div class="date-tool-shape">

                          <div class="input-set-transform text-left services_disabled start-from-box" disabled>

                            <div class="input_label-transform">

                              <div class="input_label-shape grey">

                                Από

                              </div>

                            </div>



                            <div class="date-tool-button-transform">
                              <div class="date-tool-input-shape  blue ">
                                <input type="text" class="form-control" name="inquiry_service_start_date" onkeydown="return false"  required />
                              </div>

                            </div>



                            <div class="calendar-icon-transform">

                              <div class="calendar-icon-shape">

                                <i class="material-icons blue">date_range</i>

                              </div>

                            </div>

                          </div>



                          <div class="input-set-transform text-left services_disabled end-on-box" disabled>
                            <div class="input_label-transform">
                              <div class="input_label-shape grey">
                                Έως
                              </div>

                            </div>



                            <div class="date-tool-button-transform">
                              <div class="date-tool-input-shape  blue ">
                                <input type="text" class="form-control" name="inquiry_service_end_date" onkeydown="return false"  required />
                              </div>

                            </div>



                            <div class="calendar-icon-transform">

                              <div class="calendar-icon-shape">

                                  <i class="material-icons blue">date_range</i>

                              </div>

                            </div>

                          </div>



                        </div>

                      </div>

                    </div>

                  </div>





                </div>





              </div>

            </div> <!-- selection-list-transform -->

          </div>

        </div>

      </div>

    </div>


<?php
  /*  <div class="select-category-transform hotel-entry"  >

      <div class="select-category-shape <?php //echo $active;?>">

        <div class='select-category-input-transform'>

          <div class='select-category-input-shape input-style grey4 _shadow _input_row white-bg '>

            <div class="selection-list-transform"  id="date-range-hotel">

              <div class="selection-list-shape">

                <div class="selection-list-wrapper">


                  <div class="single-selection-title-transform ">

                    <div class="single-selection-title-shape black bold">

                      <div class="info_box  inline-block pointer" data-wenk="blah blah blah" data-wenk-pos="right">
                       <i class="material-icons  grey4" >info</i>
                     </div>    Aστέρια

                    </div>

                  </div>

                  <div class="services-date-range-transform">
                    <div class="services-date-range-shape">
                        <input type="hidden" name="_inquiry_service_start_dates" value="3" / >
                      <div class="inline-block service_start_date_select">
                        <input type="radio" class="" name="inquiry_hotels_stars_select" value="1" > <span>1</span>
                      </div>

                      <div class="inline-block service_start_date_select">
                        <input type="radio" class="" name="inquiry_hotels_stars_select" value="2"> <span>2</span>
                      </div>

                      <div class="inline-block service_start_date_select">
                        <input type="radio" class="between-days" name="inquiry_hotels_stars_select" value="3" checked><span> 3</span>
                      </div>

                      <div class="inline-block service_start_date_select">
                        <input type="radio" class="specific_day" name="inquiry_hotels_stars_select" value="4"> <span>4</span>
                      </div>

                      <div class="inline-block service_start_date_select">
                        <input type="radio" class="specific_day" name="inquiry_hotels_stars_select" value="5"> <span>5</span>
                      </div>

                    </div>
                  </div>

                </div>

              </div>

            </div> <!-- selection-list-transform -->

          </div>

        </div>

      </div>

    </div>*/
?>
















    <div class="select-category-transform"  >

      <div class="select-category-shape <?php //echo $active;?>">







        <div class='select-category-input-transform'>

          <div class='select-category-input-shape input-style grey4 _shadow _input_row white-bg '>







            <div class="selection-list-transform"  id="date-range">

              <div class="selection-list-shape">

                <div class="selection-list-wrapper">





                  <div class="single-selection-title-transform ">

                    <div class="single-selection-title-shape black bold">

                          Aίτημα Ανοικτό

                    </div>

                  </div>





                  <div class="date-transform">

                    <div class="date-shape">

                      <div class="date-tool-transform">

                        <div class="date-tool-shape">



                          <div class="input-set-transform text-left">

                            <div class="input_label-transform">

                              <div class="input_label-shape grey">

                                Από

                              </div>

                            </div>



                            <div class="date-tool-button-transform">

                              <div class="date-tool-input-shape  blue ">

                                <input type="text" class="form-control" name="inquiry_start_date" required readonly disabled />

                              </div>

                            </div>



                            <div class="calendar-icon-transform">

                              <div class="calendar-icon-shape">

                                  <i class="material-icons blue">date_range</i>

                              </div>

                            </div>

                          </div>



                          <div class="input-set-transform text-left">

                            <div class="input_label-transform">

                              <div class="input_label-shape grey">

                                Έως

                              </div>

                            </div>



                            <div class="date-tool-button-transform">

                              <div class="date-tool-input-shape  blue ">

                                <input type="text" class="form-control" name="inquiry_end_date" onkeydown="return false" required />

                              </div>

                            </div>



                            <div class="calendar-icon-transform">

                              <div class="calendar-icon-shape">

                                  <i class="material-icons blue">date_range</i>

                              </div>

                            </div>

                          </div>






                        </div>

                      </div>

                    </div>

                  </div>







                </div>
              </div>

            </div> <!-- selection-list-transform -->

          </div>

        </div>

      </div>



    </div>



    <div class="clearer">



    </div>


    <div class="action_button disabledbutton create_request"  id="create_request_center" >


        <div class="action_button_shape  aqua-bg white3 _radius4 text-center _btn_submit btn_preview">
        <i class="material-icons white inline-block middle">publish</i>  Αποστολή
        </div>

    </div>


  </div>

</div>

    </div> <!-- new-applications-shape -->
  </div> <!--new-application-top-transform-->
</div>
