<div class='new-applications-transform'>
  <div class='new-applications-shape'>

    <div class="col-xs-12 col-lg-8 left-new-application-col">

      <div class='new-application-top-transform'>
        <div class='new-application-top-shape text-center'>

          <div class="single-searchbox-transform products_search active">
            <a class='white5' href="?p=7&s=0">
            <div class="single-searchbox-shape medium ">

              <img src="images/search/products.svg" /> Προϊόντα

            </div>
          </a>
          </div>

          <div class="single-searchbox-transform  services_search">
            <a class='white5' href="?p=7&s=0"><div class="single-searchbox-shape medium ">

              <img src="images/search/services.svg" /> Yπηρεσίες

            </div>
          </a>
          </div>

          <div class="single-searchbox-transform  hotels_search">
            <a class='white5' href="?p=7&s=0">
              <div class="single-searchbox-shape medium ">

                <img src="images/search/hotels.svg" /> Ξενοδοχεία

              </div>
            </a>
          </div>

        </div>
      </div> <!--new-application-top-transform-->

      <div class='new-application-main-transform'>
        <div class='new-application-main-shape'>

          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 select-category-lists">
            <?php
              for($j=0;$j<3;$j++)
              {
                $active = "";
              if($j==2)
              {
                $active = "active";
              }
              ?>
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
                          <div class="single-selection-list-transform selected">
                            <div class="single-selection-list-shape">
                                  H/Y
                            </div>
                          </div>
                          <?php
                            for($i=0;$i<6;$i++)
                            {
                            ?>

                          <div class="single-selection-list-transform">
                            <div class="single-selection-list-shape">
                                  H/Y
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
            </div>


            <?php
            }
             ?>

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


                          <div class="single-selection-list-transform selected">
                            <div class="single-selection-list-shape ">
                                  Επιλέξτε Περιοχή
                            </div>
                          </div>
                          <?php
                            for($i=0;$i<6;$i++)
                            {
                            ?>

                          <div class="single-selection-list-transform">
                            <div class="single-selection-list-shape">
                                  ΑΘΗΝΑ
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
                                        <input type='text' value="1"  />
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
                                        <input type='text' value="1"  />
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

            <div class="select-category-transform"  id="date-range">
              <div class="select-category-shape <?php //echo $active;?>">



                <div class='select-category-input-transform'>
                  <div class='select-category-input-shape input-style grey4 radius4'>



                    <div class="selection-list-transform"  id="date-range">
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
                                        <input type='text' value="12/12/2017"  />
                                      </div>
                                    </div>

                                    <div class="calendar-icon-transform">
                                      <div class="calendar-icon-shape">
                                        <img src="images/dashboard/calendar.svg"/>
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
                                        <inputPխ    Pխ                    �(�            ��    �խ            pխ    �      pխ                           </div>

                                    <div class="calendar-icon-transform">
                                      <div class="calendar-icon-shape">
                                        <img src="images/dashboard/calendar.svg"/>
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

            <div class="select-category-transform"  id="date-range">
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
                                        <input type='text' value="12/12/2017"  />
                                      </div>
                                    </div>

                                    <div class="calendar-icon-transform">
                                      <div class="calendar-icon-shape">
                                        <img src="images/dashboard/calendar.svg"/>
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
                                        <input type='text' value="12/12/2017"  />
                                      </div>
                                    </div>

                                    <div class="calendar-icon-transform">
                                      <div class="calendar-icon-shape">
                                        <img src="images/dashboard/calendar.svg"/>
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

        </div>
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
                      <img src="images/user/user.jpg">
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
