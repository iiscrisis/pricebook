<div class='closed-applications-transform'>
  <div class='closed-applications-shape'>


    <?php

    $states= array('0' => 'completed','1' => 'incomplete');
    for($i=0 ;$i<7;$i++)
    {
      $state = $states[floor(rand(0,1))];
      ?>


    <div class="col-xs-12 col-md-6 col-lg-3 single_open_appliacation-col">
        <div class="single_open_application-transform">
          <div class="single_open_application-shape shadow <?php echo $state;?>">

              <div class='single_appllication_top-transform'>
                <div class='single_appllication_top-shape round2 white-bg'>

                  <div class='col-xs-12 open_application-left'>
                    <div class="appl-subtitle grey5">
                      TEΧΝΟΛΟΓΙΑ/ΗΥ
                    </div>

                    <div class="appl-title black condensed">
                      <h3>roin mauris lectus, condimentum
                      sit amet arcu vitae, consequat
                      finibus dui.</h3>
                    </div>
                  </div>




                </div>
              </div>

              <div class="col-xs-12 application-ended">
                <div class="text-left appl-info-bottom">
                  <div class="header_info-title semi-bold black2 bold condensed">
                    ΕΚΛΕΙΣΕ 12/10/2018
                  </div>


                </div>
              </div>

              <div class="clearer"></div>


              <div class="single_appllication_bottom-transform">
                <div class="single_appllication_bottom-shape white3-bg applications_cards action-box">

                  <div class='options-wrapper '>
                    <div class="options-box-transform ">
                      <div class="options-box-shape blue-bg _options-bg vertical">

                        <div class="arrow_cell-transform">
                          <div class="arrow_cell-shape options-back-button">
                            <div class="arrow-right white">

                            </div>
                          </div>
                        </div>




                        <div class="option-cell-transform">
                          <div class="option-cell-shape white text-center">

                            <div class="option-button-transform">
                              <div class="option-button-shape">
                                <img src="images/dashboard/applications/handshake.svg"/>
                              </div>
                            </div>

                            <div class='option-button-title  semi-bold white'>
                              OΛΟΚΛΗΡΩΣΗ
                            </div>

                          </div>
                        </div> <!-- Single cell -->







                      </div>
                    </div>
                  </div>






                    <div class='col-xs-12  open_application-bottom-right  text-center'>
                      <div class="row">
                        <div class="col-xs-3 white2-bg closed_applications-second-col">

                          <div class="latest_messages-transform">
                            <div class="latest_messages-shape">

                              <div class="latest_messages-title semi-bold black bold condensed text-center hidden">
                                AΓΟΡΑ
                              </div>



                                <div class='seller-avatar-transform'>

                                  <div class='seller-avatar-shape'>

                                    <div class="seller-avatar-image-transform text-center">
                                      <div class="seller-avatar-image-shape _circle">
                                        <img src="images/avatars/pb.svg"/>
                                      </div>

                                    </div>

                                    <div class='messages_title bold blue3 text-center'>
                                      Systems S.A
                                    </div>
                                  </div>

                                </div> <!--seller-avatar-transform-->






                            </div>
                          </div>

                        </div>

                        <div class="col-xs-7  closed_applications-third-col">

                          <div class="col-xs-4 offer-details-col">
                            <div class="offer-details-wrapper  ">
                              <div class="offer-details-title black text-left">
                                T.ΜΟΝΑΔΟΣ
                              </div>

                              <div class="offer-details-data aqua text-left">
                                $20
                              </div>
                            </div>
                          </div>

                          <div class="col-xs-4 offer-details-col">
                            <div class="offer-details-wrapper  ">
                              <div class="offer-details-title black text-left">
                                ΠΟΣΟΤΗΤΑ
                              </div>

                              <div class="offer-details-data aqua text-left">
                                $20
                              </div>
                            </div>
                          </div>

                          <div class="col-xs-4 offer-details-col">
                            <div class="offer-details-wrapper  ">
                              <div class="offer-details-title black text-left">
                                ΜΕΤΑΦΟΡΙΚΑ
                              </div>

                              <div class="offer-details-data aqua text-left">
                                $20
                              </div>
                            </div>
                          </div>

                          <div class="col-xs-8 offer-details-col">
                            <div class="offer-details-wrapper  ">
                              <div class="offer-details-title black text-left">
                                ΑΝΤΙΚΑΤΑΒΟΛΗ
                              </div>

                              <div class="offer-details-data aqua text-left">
                                $20
                              </div>
                            </div>
                          </div>
                          <div class="col-xs-4 offer-details-col">
                            <div class="offer-details-wrapper  ">
                              <div class="offer-details-title black bold text-left">
                                ΣΥΝΟΛΟ
                              </div>

                              <div class="offer-details-data blue bold text-left">
                                $20
                              </div>
                            </div>
                          </div>

                        </div>



                        <div class="col-xs-2 text-right">
                          <div class="appl_options_button-transform">
                            <div class="options_button-shape">

                                <div class="options-dots-transform">
                                  <div class="options-dots-shape circle blue-bg">

                                    <div class="options-dot-transform">
                                      <div class="options-dot-shape circle white-bg"></div>
                                    </div>

                                    <div class="options-dot-transform">
                                      <div class="options-dot-shape circle white-bg"></div>
                                    </div>

                                    <div class="options-dot-transform">
                                      <div class="options-dot-shape circle white-bg"></div>
                                    </div>

                                  </div>
                                </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                  <div class="clearer"></div>
                </div>
              </div><!-- single_appllication_bottom-transform -->


          </div>
        </div><!--single_open_application -->
      </div>

      <?php
      }

      ?>



  </div>
</div>
