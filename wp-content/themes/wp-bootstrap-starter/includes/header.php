
		<?php include('menu.php');?>

		<div id="bluebar-trigger">

		</div>

		<?php
		if(is_user_logged_in())
		{
			?>

			<?php

		}else {
			?>

			<?php
		}

		if(!isset($bluebar_hidden))
		{
			$bluebar_hidden = "";
		}

		$unread_messages = getunreadMessages();
		?>

		<div id="message_area" class="hidden red-bg">
			<div class="message-shape">

				<div class="info_close-window pointer">
					<i class="material-icons white">close</i>
				</div>

				<div class="message_text white">

				</div>


			</div>
		</div>

		<div id='blue_bar' class=" hidden-xs hidden-sm hidden shadow4 white2-bg <?php echo $bluebar_hidden;?>">

			<div class='blue_bar-shape white2-bg white3'>
				<div class="container-fluid">










						</div>
					</div>

				</div> <!-- blue_bar -->


				<!-- <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wp-bootstrap-starter' ); ?></a> -->
				<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
					<header id="masthead" class="site-header navbar-static-top hidden" role="banner" >
						<div class="container">
							<h3>STAGING</h3>

							<nav class="navbar navbar-toggleable-md navbar-light">
								<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="bs4navbar" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon"></span>
								</button>
								<div class="navbar-brand">
									<?php if ( get_theme_mod( 'wp_bootstrap_starter_logo' ) ): ?>
										<?php
										if (!is_user_logged_in()) {
											?>
											<a href="<?php echo esc_url( home_url( '/' )); ?>">
												<?php
											}
											else {
												if (is_seller()) {
													?>
													<a href="<?php echo esc_url( home_url( '/' )); ?>/home-seller/">
														<?php
													}
													if (is_buyer()) {
														?>
														<a href="<?php echo esc_url( home_url( '/' )); ?>/home-buyer/">
															<?php
														}
													}
													?>
													<img src="<?php echo get_theme_mod( 'wp_bootstrap_starter_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
												</a>
											<?php else : ?>
												<?php
												if (!is_user_logged_in()) {
													?>
													<a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>">
														<?php esc_url(bloginfo('name')); ?>
													</a>
													<?php
												}
												else {
													if (is_seller()) {
														?>
														<a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>home-seller/"><?php esc_url(bloginfo('name')); ?></a>
														<?php
													}
													if (is_buyer()) {
														?>
														<a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>/home-buyer/"><?php esc_url(bloginfo('name')); ?></a>
														<?php
													}
												}
												?>
											<?php endif; ?>

										</div>
										<?php
										$menu = '';
										if (!is_user_logged_in()) {
											$menu = 'logged-out-menu';
										}
										else {
											if (is_seller()) {
												$menu = 'logged-in-seller';
											}
											if (is_buyer()) {
												$menu = 'logged-in-buyer';
											}
										}
										wp_nav_menu([
										'theme_location'	=> 'primary',
										'container'				=> 'div',
										'menu'						=> $menu,
										'container_id'		=> '',
										'container_class'	=> 'collapse navbar-collapse justify-content-end',
										'menu_class'			=> 'navbar-nav',
										'depth'						=> 3,
										'fallback_cb'			=> 'wp_bootstrap_navwalker::fallback',
										'walker'					=> new wp_bootstrap_navwalker()
										]);
										?>
									</nav>
								</div>
							</header><!-- #masthead -->
							<?php if(is_home()): ?>
								<div id="page-sub-header" <?php if (has_header_image()) { ?>style="background-image: url('<?php header_image(); ?>');" <?php } ?>>
									<div class="container">
										<h1><?php esc_url(bloginfo('name')); ?></h1>
									</div>
								</div>
							<?php endif; ?>
						<?php endif; ?>

<div class="dashboard-menu-small-transform hidden-lg">
  <div class="dashboard-menu-small-shape white3-bg">

    <div class="menu-small-list-transform">
      <div class="menu-small-list-shape">
        <div class="small-list-wrapper ">

            <?php include 'menu_list.php' ;?>


        </div>

      </div>
    </div>

    <div class="menu-small-arrow-transform">
      <div class="menu-small-arrow-shape menu-small-action-button">
        <div class="arrow-down black">

        </div>
      </div>
    </div>




  </div>
</div>

<!-- Dashboard header -->

<div id="dashboard_header" class="hidden-xs hidden-sm hidden-md _blue-bg hidden">
  <div class="dashboard_header-shape white-bg">
    <div class="container-fluid">
      <div class="row relative">

        <div class="col-xs-12 col-md-12 col-lg-8 col-lg-offset-2" id="dashboard_header_left">

          <?php
               if(isset($headTitle))
               {
                 $classHead = "productsTitle";
               }else {
                 $classHead = "";
             }
             ?>
          <h2 class="black2 condensed text-shadow <?php echo $classHead;?>">



           <?php
                if(isset($headTitle ))
                {
                  echo $headTitle ;
                }else {
                the_title();
              }
              ?>
             </h2>

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

                    <div class="header_info-title grey4">
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

                    <div class="header_info-title grey4">
                      ΑΠΑΝΤΗΣΕΙΣ
                    </div>

                </div>
              </div> <!--single_dashboard_tool-transform-->

              <div class="single_dashboard_tool-transform">
                <div class="single_dashboard_tool-shape text-center">

                    <div class="header_info grey5 bold">
                      5
                    </div>
                    <div class="header_info-title grey4">
                      ΟΛΟΚΛΗΡΩΜΕΝΑ
                    </div>

                </div>
              </div> <!--single_dashboard_tool-transform-->

              <div class="single_dashboard_tool-transform">
                <div class="single_dashboard_tool-shape text-center">

                    <div class="header_info grey5 bold">
                      15
                    </div>
                    <div class="header_info-title grey4">
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
