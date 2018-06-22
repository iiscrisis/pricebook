<div class="col-xs-12 col-md-12 col-lg-10 content_padding" id="dashboard-main-col">
  <!-- open applications -->
  <div class="main-area-transform">
    <div class="main-area-shape">

      <div class='new-applications-transform'>

        <div class='new-applications-shape'>





          <form id="addInquiry" name="addInquiry" method="POST" action="">
            <input type="hidden" name="category" value="" />


          <div class="col-xs-12 col-lg-8 left-new-application-col">





            <div class='new-application-main-transform'>

              <div class='new-application-main-shape'>

                <div class="row">
      						<div class="col-xs-12">
      							<div class='new-application-top-transform'>

      								<div class='new-application-top-shape text-center'>

      									<div class="single-searchbox-transform products_search active">
      										<a class='white5' href="<?php echo get_site_url(); ?>/new-request/?cat=1718">
      													<div class="single-searchbox-shape medium ">

      											<img src="<?php echo get_template_directory_uri() ;?>/images/search/products.svg" /> Προϊόντα

      										</div>

      									</a>

      									</div>



      									<div class="single-searchbox-transform  services_search">

      										<a class='white5' href="<?php echo get_site_url(); ?>/new-request/?cat=376">
      											<div class="single-searchbox-shape medium ">

      											<img src="<?php echo get_template_directory_uri() ;?>/images/search/services.svg" /> Yπηρεσίες

      										</div>

      									</a>

      									</div>



      									<div class="single-searchbox-transform  hotels_search">

      										<a class='white5' href="<?php echo get_site_url(); ?>/new-request/?cat=1719">

      											<div class="single-searchbox-shape medium ">



      												<img src="<?php echo get_template_directory_uri() ;?>/images/search/hotels.svg" /> Ξενοδοχεία



      											</div>

      										</a>

      									</div>



      								</div>

      							</div> <!--new-application-top-transform-->
      						</div>
      					</div>



                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 select-category-lists">


                  <div class="select-category-transform">

                    <div class="select-category-shape <?php echo $active;?>">



                      <div class="number-transform">

                        <div class="number-shape circle grey4">

                          <?php $index = $j+1;

                           echo $index;?>

                        </div>

                      </div>



                      <div class='select-category-input-transform'>

                        <div class='select-category-input-shape input-style grey4 radius4'>



                          <div class="select-category-heightOffset grey4">

                              Επιλέξτε Κατηγορία

                          </div>



                          <div class="selection-list-transform">

                            <div class="selection-list-shape">

                              <div class="selection-list-wrapper">

                                <?php
                                  $parentCategories = get_posts(array(
                                    'post_type'		=>	'product_category',
                                    'hide_empty'	=> 0,
                                    'post_parent'	=>	1718
                                  ));
                                  foreach ($parentCategories as $inquiry_parentCategory) {
                                  ?>

                                  <div data-value="<?php echo $inquiry_parentCategory->ID; ?>" data-type="temp_category" class="single-selection-list-transform selected hidden">

                                    <div class="single-selection-list-shape">

                                        <?php echo $inquiry_parentCategory->post_title; ?>

                                    </div>

                                  </div>

                                  <option data-type="temp_category" type="checkbox" value="<?php echo $inquiry_parentCategory->ID; ?>"><?php echo $inquiry_parentCategory->post_title; ?></option>
                                <?php } ?>

                              </div> <!--selection-list-wrapper-->
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

                  </div>




                </div>



                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-5 select-category-lists">



                  <div class="select-category-transform">

                    <div class="select-category-shape <?php //echo $active;?>">







                      <div class='select-category-input-transform'>

                        <div class='select-category-input-shape input-style grey4 radius4'>



                          <div class="select-category-heightOffset grey4">

                              Επιλέξτε Περιοχή

                          </div>



                          <div class="selection-list-transform">

                            <div class="selection-list-shape">

                              <div class="selection-list-wrapper">







                                <?php
                                  $data = get_posts(array(
                                    'numberposts'=>-1,
                                    'post_type'=>'areas'
                                  ));
                                  $countIndex = 0;
                                  foreach ($data as $d) {
                                    $selected = "";
                                    if($countIndex == 0)
                                    {
                                      $selected = "selected";
                                    }
                                    $countIndex++;
                                    ?>
                                <div class="single-selection-list-transform <?php echo $selected;?>">

                                  <div class="single-selection-list-shape" data-value="<?php echo $d->ID; ?>">

                                        <?php echo $d->post_title; ?>

                                  </div>

                                </div>



                                <?php

                                  }

                                ?>

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







                  <div class="select-category-transform">

                    <div class="select-category-shape <?php //echo $active;?>">







                      <div class='select-category-input-transform'>

                        <div class='select-category-input-shape input-style grey4 radius4'>







                          <div class="selection-list-transform">

                            <div class="selection-list-shape">

                              <div class="selection-list-wrapper">





                                <div class="single-selection-title-transform ">

                                  <div class="single-selection-title-shape blue bold">

                                        Ποσότητα

                                  </div>

                                </div>


                                <div class="quantity-transform">

                                  <div class="quantity-shape">

                                    <div class="counter-tool-transform">

                                      <div class="counter-tool-shape">



                                        <div class="counter-tool-button-transform">

                                          <div class="counter-tool-button-shape circle grey4 plus_button">

                                            +

                                          </div>

                                        </div>



                                        <div class="counter-tool-button-transform">

                                          <div class="counter-tool-input-shape  green ">

                                            <input type="text" class="_form-control" name="inquiry_product_quantities" required />


                                          </div>

                                        </div>



                                        <div class="counter-tool-button-transform">

                                          <div class="counter-tool-button-shape circle grey4 minus_button">

                                            -

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





                  <div class="select-category-transform">

                    <div class="select-category-shape <?php //echo $active;?>">







                      <div class='select-category-input-transform'>

                        <div class='select-category-input-shape input-style grey4 radius4'>







                          <div class="selection-list-transform">

                            <div class="selection-list-shape">

                              <div class="selection-list-wrapper">





                                <div class="single-selection-title-transform ">

                                  <div class="single-selection-title-shape blue bold">

                                        Άτομα

                                  </div>

                                </div>





                                <div class="quantity-transform">

                                  <div class="quantity-shape">

                                    <div class="counter-tool-transform">

                                      <div class="counter-tool-shape">



                                        <div class="counter-tool-button-transform">

                                          <div class="counter-tool-button-shape circle grey4 plus_button">

                                            +

                                          </div>

                                        </div>



                                        <div class="counter-tool-button-transform">

                                          <div class="counter-tool-input-shape  green ">

                                            <input type='text' value="1"  />

                                          </div>

                                        </div>



                                        <div class="counter-tool-button-transform">

                                          <div class="counter-tool-button-shape circle grey4 minus_button">

                                            -

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

                        <div class='select-category-input-shape input-style grey4 radius4'>







                          <div class="selection-list-transform" >

                            <div class="selection-list-shape">

                              <div class="selection-list-wrapper">





                                <div class="single-selection-title-transform ">

                                  <div class="single-selection-title-shape blue bold">

                                        Τιμη Μονάδος

                                  </div>

                                </div>





                                <div class="price-transform">

                                  <div class="price-shape">



                                    <div class="range-tool-transform">

                                      <div class="range-tool-shape">



                                        <div class="input-set-transform text-left">

                                          <div class="input_label-transform">

                                            <div class="input_label-shape grey5">

                                              Από

                                            </div>

                                          </div>



                                          <div class="counter-tool-button-transform">

                                            <div class="counter-tool-input-shape  green ">

                                              <input type="text" class="_form-control" name="inquiry_min_price" required value="0" />

                                            </div>

                                          </div>

                                        </div>



                                        <div class="input-set-transform text-right">

                                          <div class="input_label-transform">

                                            <div class="input_label-shape grey5">

                                              Έως

                                            </div>

                                          </div>



                                          <div class="counter-tool-button-transform">

                                            <div class="counter-tool-input-shape  green ">

                                              <input type="text" class="_form-control" name="inquiry_max_price" required />

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



                  <div class="select-category-transform"  >

                    <div class="select-category-shape <?php //echo $active;?>">







                      <div class='select-category-input-transform'>

                        <div class='select-category-input-shape input-style grey4 radius4'>







                          <div class="selection-list-transform"  id="date-range-hotel">

                            <div class="selection-list-shape">

                              <div class="selection-list-wrapper">





                                <div class="single-selection-title-transform ">

                                  <div class="single-selection-title-shape blue bold">

                                      Ημερομηνίες

                                  </div>

                                </div>





                                <div class="date-transform">

                                  <div class="date-shape">



                                    <div class="date-tool-transform">

                                      <div class="date-tool-shape">



                                        <div class="input-set-transform text-left">

                                          <div class="input_label-transform">

                                            <div class="input_label-shape grey5">

                                              Από

                                            </div>

                                          </div>



                                          <div class="date-tool-button-transform">

                                            <div class="date-tool-input-shape  green ">


                                              <input type="text" class="_form-control" name="stay_start_date" required readonly disabled />



                                            </div>

                                          </div>



                                          <div class="calendar-icon-transform">

                                            <div class="calendar-icon-shape">

                                              <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/calendar.svg"/>

                                            </div>

                                          </div>

                                        </div>



                                        <div class="input-set-transform text-left">

                                          <div class="input_label-transform">

                                            <div class="input_label-shape grey5">

                                              Έως

                                            </div>

                                          </div>



                                          <div class="date-tool-button-transform">

                                            <div class="date-tool-input-shape  green ">

                                              <input type="text" class="_form-control" name="stay_end_date" required />

                                            </div>

                                          </div>



                                          <div class="calendar-icon-transform">

                                            <div class="calendar-icon-shape">

                                              <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/calendar.svg"/>

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



                  <div class="select-category-transform"  >

                    <div class="select-category-shape <?php //echo $active;?>">







                      <div class='select-category-input-transform'>

                        <div class='select-category-input-shape input-style grey4 radius4'>







                          <div class="selection-list-transform"  id="date-range">

                            <div class="selection-list-shape">

                              <div class="selection-list-wrapper">





                                <div class="single-selection-title-transform ">

                                  <div class="single-selection-title-shape blue bold">

                                        Aίτημα Ανοικτό

                                  </div>

                                </div>





                                <div class="date-transform">

                                  <div class="date-shape">



                                    <div class="date-tool-transform">

                                      <div class="date-tool-shape">



                                        <div class="input-set-transform text-left">

                                          <div class="input_label-transform">

                                            <div class="input_label-shape grey5">

                                              Από

                                            </div>

                                          </div>



                                          <div class="date-tool-button-transform">

                                            <div class="date-tool-input-shape  green ">

                                              <input type="text" class="_form-control" name="inquiry_start_date" required readonly disabled />

                                            </div>

                                          </div>



                                          <div class="calendar-icon-transform">

                                            <div class="calendar-icon-shape">

                                              <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/calendar.svg"/>

                                            </div>

                                          </div>

                                        </div>



                                        <div class="input-set-transform text-left">

                                          <div class="input_label-transform">

                                            <div class="input_label-shape grey5">

                                              Έως

                                            </div>

                                          </div>



                                          <div class="date-tool-button-transform">

                                            <div class="date-tool-input-shape  green ">

                                              <input type="text" class="_form-control" name="inquiry_end_date" required />

                                            </div>

                                          </div>



                                          <div class="calendar-icon-transform">

                                            <div class="calendar-icon-shape">

                                              <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/calendar.svg"/>

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

                  <div class="action_button">

                                          <a href="?p=12">

                                            <div class="action_button_shape shadow green-bg white3 radius4 text-center">



                                              SUBMIT



                                            </div>

                                          </a>

                  </div>
                </div>
                </form>
              </div> <!-- new-applications-shape -->



            </div> <!--new-application-top-transform-->
        </div>



          <div class="col-xs-12 col-lg-4 right-new-application-col">

            <div class="application-summary-transform">

              <div class="application-summary-shape blue">



                <div class="newapplication_headtitle bold blue3 condensed">ΣΥΝΟΨΗ</div>

                <div class="summary">

                  <div class="summary-subtitle bold">

                    Ψάχνω για

                  </div>

                  <div class="summary_general">

                    dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.



                  </div>



                  <div class="summary-subtitle bold">

                    Όθόνη

                  </div>

                  <div class="summary_general">

                    Μικρή (3.5" - 4.5")

                  </div>

                  <div class="summary-subtitle bold">

                    Τύπος

                  </div>

                  <div class="summary_general">

                    Flat

                  </div>
                  <div class="summary_general">

                    Dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.



                  </div>
                </div>
              </div>

            </div>



            <div class="summarytips-transform">



              <div class="single-tip-box-transform  left">

                      <div class="single-tip-box-shape shadow_3 white3-bg radius4">



                        <div class="single-tip-box-avatar-transform">

                          <div class="single-tip-box-avatar-shape circle white-bg">

                            <img src="<?php echo get_template_directory_uri() ;?>/images/user/user.jpg">

                          </div>

                        </div>



                        <div class="tip-box-details">

                          <div class="chat-box-details-top-transform">

                            <div class="chat-box-details-top-shape">

                              <div class="chat-box-name blue bold left">

                                PRICEBOOK TIPS

                              </div>



                              <div class="chat-box-date blue bold right">

                               #1

                              </div>



                              <div class="clearer">



                              </div>

                            </div>

                          </div>



                          <div class="chat-box-message-transform">

                            <div class="chat-box-message-shape black2">

                              <p>

                                Quis nostrud exerci tation ullamcorper uscipit

                                lobortis nislut aliquip ex eaommodo , vel illum dolore eu feugiat

                              </p>

                            </div>

                          </div>

                        </div>
                      </div>

                    </div>

            </div>



          </div>



        </div> <!--end new-application-shape -->

      </div><!--end new-application-transform -->











    </div><!--main-area-shape-->
  </div><!--main-area-transform-->
  </div> <!--dashboard-main-col-->
