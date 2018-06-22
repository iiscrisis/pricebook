<!-- Blue bar -->


<div class="dashboard-menu-small-transform hidden-lg">
  <div class="dashboard-menu-small-shape white3-bg">

    <div class="menu-small-list-transform">
      <div class="menu-small-list-shape">
        <div class="small-list-wrapper ">

            <?php include 'includes/dashboard/menu_list.php' ;?>


        </div>

      </div>
    </div>

    <div class="menu-small-arrow-transform">
      <div class="menu-small-arrow-shape menu-small-action-button">
        <div class="arrow-down black">

        </div>
      </div>
    </div>


    <div class="_right" id="dashboard_header_right-small">

      <?php

       if($_page==11)
      {
        ?>

        <div class="small_offer-title-transform">
          <div class="small_offer-title-shape hidden-lg">
            <h2 class="white4 grey5 condensed"> Αιτημα 1</h2>

            <div class="dashboard_header_description grey5 light">
              <p>
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                magna aliquam erat volutpat. Ut wisi enim ad minim
              </p>
            </div>
          </div>
        </div>

        <div class='certificate-transform'>
          <div class='certificate-shape'>
              <img src="<?php echo get_template_directory_uri() ;?>/images/certificate/cert.svg"/>
          </div>
        </div><div class="open_application_list_main-tools-transform">
          <div class="open_application_list_main-tools-shape">
            <div class="option-cell-transform">
              <div class="option-cell-shape white text-center">

                <div class="option-button-transform">
                  <div class="option-button-shape">
                    <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/handshake.svg"/>
                  </div>
                </div>

                <div class='option-button-title condensed _semi-bold grey1'>
                  ΟΛΟΚΛΗΡΩΣΗ
                </div>

              </div>
            </div> <!-- Single cell -->


            <div class="option-cell-transform">
              <div class="option-cell-shape white text-center">

                <div class="option-button-transform">
                  <div class="option-button-shape">
                    <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/refresh.svg"/>
                  </div>
                </div>

                <div class='option-button-title condensed  _semi-bold white4'>
                  ΑΝΑΝΕΩΣΗ
                </div>

              </div>
            </div> <!-- Single cell -->


            <div class="option-cell-transform">
              <div class="option-cell-shape white text-center">

                <div class="option-button-transform">
                  <div class="option-button-shape">
                    <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/delete.svg"/>
                  </div>
                </div>

                <div class='option-button-title condensed _semi-bold grey1'>
                  ΔΙΑΓΡΑΦΗ
                </div>

              </div>
            </div> <!-- Single cell -->
          </div>
        </div>
      <?php
    }else{
      ?>


      <div class='dashboard_tools-transform'>
        <div class='dashboard_tools-shape'>

          <div class="single_dashboard_tool-transform">
            <div class="single_dashboard_tool-shape text-center">

                <div class="header_info white2 bold">
                  5
                </div>
                <div class="header_info-title _semi-bold aqua">
                  ΛΗΓΟΥΝ
                </div>

            </div>
          </div> <!--single_dashboard_tool-transform-->

          <div class="single_dashboard_tool-transform">
            <div class="single_dashboard_tool-shape text-center">

                <div class="header_info white2 bold">
                  25
                </div>
                <div class="header_info-title _semi-bold aqua">
                  ΣΥΝΟΛΟ
                </div>

            </div>
          </div> <!--single_dashboard_tool-transform-->

        </div>
      </div>
      <?php
      }
      ?>
    </div>

  </div>
</div>

<!-- Dashboard header -->

<div id="dashboard_header" class="hidden-xs hidden-sm hidden-md _blue-bg">
  <div class="dashboard_header-shape grey-bg">
    <div class="container-fluid">
      <div class="row relative">

        <div class="col-xs-12 col-md-12 col-lg-8 col-lg-offset-2" id="dashboard_header_left">
          <h2 class="white2 _black3 condensed text-shadow"> <?php the_title(); ?></h2>

          <div class="dashboard_header_description grey5 light hidden">
            <p>
              Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
              sed diam nonummy nibh euismod tincidunt ut laoreet dolore
              magna aliquam erat volutpat. Ut wisi enim ad minim
            </p>
          </div>
        </div>

        <div class="col-xs-12 col-md-6" id="dashboard_header_right">

          <div class='dashboard_tools-transform'>
            <div class='dashboard_tools-shape'>
              <?php

              if($_page==12)
             {
               ?>

               <div class="open_application_list_main-tools-transform">
                 <div class="open_application_list_main-tools-shape">

                   <div class="option-cell-transform ">
                     <div class="option-cell-shape white text-center">

                       <div class="option-button-transform">
                         <div class="option-button-shape">



                         </div>
                       </div>

                       <div class='option-button-title condensed __semi-bold grey1'>

                       </div>

                     </div>
                   </div> <!-- Single cell -->

                   <div class="option-cell-transform">
                     <div class="option-cell-shape white text-center">

                       <div class="option-button-transform">
                         <div class="option-button-shape">
                           <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/seller.svg"/>
                         </div>
                       </div>

                       <div class='option-button-title condensed _semi-bold grey1'>
                         ΠΡΟΜΗΘΕΥΤΗΣ
                       </div>

                     </div>
                   </div> <!-- Single cell -->


                   <div class="option-cell-transform">
                     <div class="option-cell-shape white text-center">

                       <div class="option-button-transform">
                         <div class="option-button-shape">
                           <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/blacklist.svg"/>
                         </div>
                       </div>

                       <div class='option-button-title condensed  _semi-bold white4'>
                         BLACKLIST
                       </div>

                     </div>
                   </div> <!-- Single cell -->



                 </div>
               </div>

            <?php
             }else  if($_page==11)
         {
           ?>
           <div class='certificate-transform'>
             <div class='certificate-shape'>
                 <img src="<?php echo get_template_directory_uri() ;?>/images/certificate/cert.svg"/>
             </div>
           </div>

           <div class="open_application_list_main-tools-transform">
             <div class="open_application_list_main-tools-shape">
               <div class="option-cell-transform">
                 <div class="option-cell-shape white text-center">

                   <div class="option-button-transform">
                     <div class="option-button-shape">
                       <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/handshake.svg"/>
                     </div>
                   </div>

                   <div class='option-button-title condensed white4'>
                     ΟΛΟΚΛΗΡΩΣΗ
                   </div>

                 </div>
               </div> <!-- Single cell -->


               <div class="option-cell-transform">
                 <div class="option-cell-shape white text-center">

                   <div class="option-button-transform">
                     <div class="option-button-shape">
                       <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/refresh.svg"/>
                     </div>
                   </div>

                   <div class='option-button-title condensed  _semi-bold white4'>
                     ΑΝΑΝΕΩΣΗ
                   </div>

                 </div>
               </div> <!-- Single cell -->


               <div class="option-cell-transform">
                 <div class="option-cell-shape white text-center">

                   <div class="option-button-transform">
                     <div class="option-button-shape">
                       <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/delete.svg"/>
                     </div>
                   </div>

                   <div class='option-button-title condensed _semi-bold white4'>
                     ΔΙΑΓΡΑΦΗ
                   </div>

                 </div>
               </div> <!-- Single cell -->
             </div>
           </div>
         <?php
       }else{
         ?>



              <div class="single_dashboard_tool-transform">
                <div class="single_dashboard_tool-shape text-center">

                   <div class="header_info_bubble">
                     <div class='header_info_bubble-transform'>

                         <div class="header_info_bubble-shape bold circle white2 yellow-bg">
                           12

                       </div>
                     </div>


                     <div class='header_info-image'>
                       <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/messages.svg">
                     </div>
                   </div>

                    <div class="header_info-title white4">
                      ΜΗΝΥΜΑΤΑ
                    </div>

                </div>
              </div> <!--single_dashboard_tool-transform-->

              <div class="single_dashboard_tool-transform">
                <div class="single_dashboard_tool-shape text-center">

                   <div class="header_info_bubble">
                     <div class='header_info_bubble-transform'>

                         <div class="header_info_bubble-shape bold circle white2 yellow-bg">
                           2

                       </div>
                     </div>


                     <div class='header_info-image'>
                       <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/chats.svg">
                     </div>
                   </div>

                    <div class="header_info-title white4">
                      ΑΠΑΝΤΗΣΕΙΣ
                    </div>

                </div>
              </div> <!--single_dashboard_tool-transform-->

              <div class="single_dashboard_tool-transform">
                <div class="single_dashboard_tool-shape text-center">

                    <div class="header_info white2 bold">
                      5
                    </div>
                    <div class="header_info-title white4">
                      ΟΛΟΚΛΗΡΩΜΕΝΑ
                    </div>

                </div>
              </div> <!--single_dashboard_tool-transform-->

              <div class="single_dashboard_tool-transform">
                <div class="single_dashboard_tool-shape text-center">

                    <div class="header_info white2 bold">
                      15
                    </div>
                    <div class="header_info-title white4">
                      AITHMATA
                    </div>

                </div>
              </div> <!--single_dashboard_tool-transform-->
            <?php }?>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div> <!-- Dashboard header -->
