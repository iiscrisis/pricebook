<section id="side_menu" class="fullscreen invisible" style="">



    <div class="menu_wrapper white3-bg fullheight blue shadow_2" style="">

      <div class="menu_logo-transform ">
        <div class="menu_logo-shape _white3-bg _blue-bg text-center ">

          <div class="menu_logo_img-transform">
            <div class="menu_logo_img-shape">
            <a href="http://pricebook.gr/"><img src="<?php echo get_template_directory_uri() ;?>/images/theme0/logo.svg"/></a>
            </div>
          </div>

        </div>
      </div>

      <div class="menu_close-window ">
        <i class="material-icons black">close</i>
      </div>


      <div class="container-fluid">


        <div class="menu-category-transform menu_avatar">

          <div class="menu-category-shape white3-bg blue">
            <div class="avatar-transform">
							<div class="avatar-shape white">

								<div class="avatar-image-transform">
									<div class="avatar-image-shape">
										<?php echo  getCustomAvatar(get_current_user_id()); ?>
									</div>
								</div><!--avatar-image-transform-->

								<div class="avatar-details-transform">
									<div class="avatar-details-shape">

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
														<a class="condensed black2 _white bold" href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_url(bloginfo('name')); ?></a>
														<?php
													}
													else {
														if (is_seller()) {
															?>
															<a class="condensed black2 _white bold" href="<?php echo esc_url( home_url( '/' )); ?>home-seller/"><?php echo get_field("seller_companyName",'user_'.get_current_user_id()) ;?></a>
															<?php
														}
														if (is_buyer()) {
															?>
															<a class="condensed black2 _white bold" href="<?php echo esc_url( home_url( '/' )); ?>/home-buyer/"><?php
															 $user_info = get_userdata( get_current_user_id() );
															$user_info->user_email = substr($user_info->user_email, 0, -3);
															echo $user_info->user_email;?></a>
															<?php
														}
													}
													?>
												<?php endif; ?>



												<!--<a href="?p=9&s=<?php echo $_seller;?>" class="condensed black2 _white bold">YANO</a>-->
											</div>
										</div><!--avatar-image-transform-->

									</div>
								</div>
                <div class="clearer">

                </div>
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
                    else {/*
                      if (is_seller()) {
                      ?>
                      <a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>home-seller/"><?php esc_url(bloginfo('name')); ?></a>
                      <?php
                    }
                    if (is_buyer()) {
                    ?>
                    <a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>/home-buyer/"><?php esc_url(bloginfo('name')); ?></a>
                    <?php
                  }*/
                }


                $menu = '';
                if (!is_user_logged_in()) {
                  $menu = 'logged-out-menu';
                //	echo "123";

                echo '<li id="menu-item-58" class="nav-item triggerLogin menu-item menu-item-type-custom menu-item-object-custom menu-item-58"><a title="LOGIN" href="#" class="nav-link">LOGIN</a></li>';
                }
                else {
                  if (is_seller()) {
                //		echo "127";
                    $menu = 'logged-in-seller';
                  }
                  if (is_buyer()) {
                  //	echo "131";
                    $menu = 'logged-in-buyer';
                  }
                }
                /*wp_nav_menu([
                'theme_location'	=> 'primary',
                'container'				=> 'div',
                'menu'						=> $menu,
                'container_id'		=> '',
                'container_class'	=> 'collapse navbar-collapse justify-content-end',
                'menu_class'			=> 'navbar-nav',
                'depth'						=> 3,
                'fallback_cb'			=> 'wp_bootstrap_navwalker::fallback',
                'walker'					=> new wp_bootstrap_navwalker()
              ]);*/
                ?>

              <?php endif; ?>


              <?php
              $strclient="";
              if (is_seller()) {
                $strclient =  'Επαγγελματίας';
              }
              if (is_buyer()) {
                $strclient =  'Αγοραστής';
              }
              ?>



              <a href="?p=1&s=<?php echo $_seller_invert;?>" class="blue"><span class="grey light">Συνδεδεμένος ως </span><?php echo $strclient;?>, αλλαγή;</a>
                <a class="red" href="<?php echo get_site_url(); ?>/logout/">Aποσύνδεση</a>

          </div>
        </div>

        <!--

        <div class="menu_link-transform">
          <div class="menu_link-shape grey5">
            <a href="">ΕΠΙΚΟΙΝΩΝΙΑ</a>
          </div>
        </div>

        <div class="menu_link-transform">
          <div class="menu_link-shape grey5" id='how_it_works_btn'>
            <a href="">ΠΩΣ ΛΕΙΤΟΥΡΓΕΙ</a>
          </div>
        </div>

        -->

        <div class="menu-category-transform hidden">
          <div class="menu-category-shape horizontal_bars">


              <div class="single-dashboard-menu-transform">
                <div class="single-dashboard-menu-shape ">


                  <div class="dashboard_menu_link">
                    <div class="menu_link-transform how_it_works_col">
                      <div class="menu_link-shape grey5 how_it_works_btn">
                        <a href="">ΠΩΣ ΛΕΙΤΟΥΡΓΕΙ</a>
                      </div>
                    </div>
                  </div>

                  <div class="dashboard_menu_link">
                    <div class="menu_link-transform">
                      <div class="menu_link-shape grey5">
                        <a href="">ΕΠΙΚΟΙΝΩΝΙΑ</a>
                      </div>
                    </div>
                  </div>

                </div>
              </div> <!--single-dashboard-menu-transform-->

          </div>



        </div>


        <div class="menu-category-transform">
          <div class="menu-category-shape">
            <div class="menu-category-title-transform hidden">
              <div class="menu-category-title-shape bold grey4">
                Dashboard
              </div>
            </div>

              <?php // include 'includes/dashboard/menu_list.php' ;?>
              <?php include('menu_list.php');?>


          </div>



        </div>

        <div class="menu-category-transform hidden">
          <div class="menu-category-shape">


              <div class="single-dashboard-menu-transform">
                <div class="single-dashboard-menu-shape">

                  <div class="menu-image-transform">
                    <div class="menu-image-shape">
                    <i class="material-icons md-24 md-dark">portrait</i>

                    </div>
                  </div>

                  <div class="dashboard_menu_link">
                    <a href="?p=9&s=<?php echo $_seller;?>" class="black2">
                      Λογαριασμός
                    </a>
                  </div>

                </div>
              </div> <!--single-dashboard-menu-transform-->

          </div>



        </div>






      </div>
    </div>

    <div class="close_trigger">

    </div>
</section>

<div id="menu_trigger">

</div>
<section id="menu_section">
  <div id="menu" class='menu-transform '>
    <div class="menu-shape white-bg blue">





      <div class="menu_main-transform">
        <div class="menu_main-shape white-bg">

          <div class="col-xs-4 col-md-2 col-lg-1 menu-left">



            <div class="menu_logo-transform waypoint_scale">
              <div class="menu_logo-shape _white3-bg _blue-bg text-center">

                <div class="menu_logo_img-transform">
                  <div class="menu_logo_img-shape">
                    <a href="http://pricebook.gr/">  <img src="<?php echo get_template_directory_uri() ;?>/images/theme0/logo.svg"/></a>
                  </div>
                </div>

              </div>
            </div>
          </div> <!-- end menu-left -->

            <div class="col-xs-6 col-md-3 _hidden">

              <div class="_container search-container">
                  <div id="pages-search">
                      <div id="search-bar-general" class="_shadow1"><input type="text" name="search-bar" class="inset_shadow black2" placeholder="Ψάξτε Προϊόντα, Υπηρεσίες &amp; Ξενοδοχέια" id="search-bar"><button class="btn btn-primary blue-bg" type="button" id="search-button">Αναζήτηση</button></div>
                    <!--  <div class="d-flex justify-content-between hidden"
                          id="search-buttons-general">
                            <?php include 'cat_buttons.php';?>
                      </div>-->
                  </div>
              </div>

              </div>
              <div class="col-xs-8 col-md-8 text-right">











              <div class="menu_search-transform waypoint_scale2 hidden">
                <div class="menu_search-shape black3 ">

                  <div class="menu_search_icon-transform waypoint_scale3">
                    <div class="menu_search_icon-shape black3">
                      <i class="material-icons md-36 yellow inline-block middle">search</i>
                    </div>
                  </div>

                    <span class="search_btn hidden-xs ">ANAZHTHΣΗ</span>
                </div>
              </div>

                <?php include ('avatar.php');?>




              <?php

               if(isset($always_show_burger) && $always_show_burger==1)
              {
                //  print_m("b > ".$always_show_burger);
                $hidden_burger="";
              }else {
                $hidden_burger = "hidden-lg";
              }?>

              <div class="menu_burger-transform waypoint_scale2 <?php echo $hidden_burger;?>">
                <div class="menu_burger-wrapper">
                  <div class="menu_burger-shape grey5">

                      <div class='burger_transform'>
                        <div class='burger_shape '>
                          <div class='single-burger_shape black3-bg '></div>

                          <div class='single-burger_shape black3-bg '></div>

                        </div>
                      </div>

                  </div>
                </div>

              </div>
            </div>









        </div>
      </div> <!--menu_main-transform-->

    </div>


  </div>



</section>

<div id="menu_offset">

</div>

<script type="text/javascript">

var pr_link = 'products.php?c=';
var dash_link = 'http://pricebook.gr/pricebook/new-request/?cat=';
dasboard_link="";
jQuery('document').ready(function(){

  getThesaurus();

  function getThesaurus()
  {
  	jQuery.ajax({
  			'type'	: 'post',
  			'url'	:	ajaxurl,
  			'data'	:	{
  				action	:	'getThesaurus',
  			},
  			success: function(response) {
  				var result = JSON.parse(response);
  			//	alert(result.message.services);

  			thesaurus = result.message;
  			console.log(JSON.stringify(thesaurus));

  			init_search(thesaurus);

  			},
  			error: function(response) {
  				//var result = JSON.parse(response);
  		//		alert("error");
  			}

  		});
  	}

    function init_search(thesaurus)
    {
    	/*$('#main_search_bar').selectize({
    				sortField: 'text'
    		})*/

    		var input = document.getElementById("search-bar");

    // Show label but insert value into the input:
    var searchbar = new Awesomplete(input, {
    	list:thesaurus,
    	replace:function (text) {
    	this.input.value = text;
    }
    });




    jQuery("#search-bar").on("awesomplete-selectcomplete",function(obj){
    	//alert(JSON.stringify());

    	jQuery("#search-value").val(obj.originalEvent.text.value);
    //	dasboard_link = obj.originalEvent.text.value;
    	//	window.locationc


    	category_link(obj.originalEvent.text.value);
    });


    }




    function category_link(id)
    {
    	//var id = obj.originalEvent.text.value;

      //  alert(id);
    	jQuery.ajax({
    			'type'	: 'post',
    			'url'	:	ajaxurl,
    			'data'	:	{
    				action	:	'checkLink',
    				cat_id 	:	id
    			},
    			success: function(response) {
    				var result = JSON.parse(response);
    				console.log(JSON.stringify(result.status)+ " > "+dasboard_link);
    				if(result.status == 3) // parent, go to regular
    				{
            //  alert(3);
    					window.location = pr_link+id;
    				}else if(result.status == 1){ // item, logged in, go to dashboard
          //    alert(1);
    					window.location=dash_link+id;


    				}else if(result.status==2)
    				{
    						dasboard_link=dash_link+id;
    					jQuery("#login-button").trigger("click");
    				}

    			},
    			error: function(response) {
    				//var result = JSON.parse(response);
    		//		alert("error");
    			}

    		});
    }


});
</script>
