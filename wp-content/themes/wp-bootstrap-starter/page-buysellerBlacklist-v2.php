<?php
/**
 * */
get_header(); ?>
<?php
	$withSales = true;
	$blacklistedSellers = getSellerBlacklist($withSales);
	//update_field('user_blacklist',null,'user_'.get_current_user_id());
?>
<?php include('includes/header.php'); ?>

<div id="dashboard_main" class="site-content"> <?php // id="content" ?>
	<div class="container-fluid">
		<div class="row" id="dashboard_main_area">

			<div class="col-xs-12 col-md-12 col-lg-2 content_padding" id="dashboard-menu">

				<div class="dashboard-menu-transform hidden-xs hidden-sm hidden-md">

					<?php include('includes/seller/menu_list.php');?>

					<?php // include 'includes/dashboard/menu_list.php' ;?>

				</div><!-- dashboard-menu-transform -->

			</div> <!-- dashboard-menu-->


			<div class="col-xs-12 col-md-12 col-lg-10 content_padding" id="dashboard-main-col">
				<!-- open applications -->
				<div class="main-area-transform">
					<div class="main-area-shape">

						<div id="sellers">

						  <div class="sellers-transform">

								<?php

								if (!empty($blacklistedUsers)) {
	 		 						foreach ($blacklistedUsers as $blacklistedUser=>$val) { ?>





						    <div class="col-xs-12 col-md-6 col-lg-3 single_seller-col">



						        <div class='single_seller-transform'>

						          <div class='single_seller-shape shadow radius2'>



						            <div class="seller-top red-bg">



						              <div class='col-xs-4'>

						                <div class='seller-avatar-transform'>



						                  <div class='seller-avatar-shape'>



						                    <div class="seller-avatar-image-transform">

						                      <div class="seller-avatar-image-shape white-bg circle">

						                        <img src="<?php echo get_template_directory_uri() ;?>/images/avatars/pb.svg"/>

						                      </div>



						                    </div>



						                    <div class='seller-rating-transform'>

						                      <div class='seller-rating-shape text-center'>



						                        <div class="seller-rating circle yellow active"></div>

						                        <div class="seller-rating circle yellow active"></div>

						                        <div class="seller-rating circle yellow active"></div>

						                        <div class="seller-rating circle yellow active"></div>

						                        <div class="seller-rating circle yellow "></div>



						                      </div>

						                    </div>

						                  </div>



						                </div> <!--seller-avatar-transform-->

						              </div>





						              <div class='col-xs-8 seller-left'>

						                <div class="appl-subtitle white3">

						                  TEΧΝΟΛΟΓΙΑ/ΗΥ

						                </div>



						                <div class="appl-title black">

						                  <h3 class="black">  <?php echo get_field('seller_companyName','user_'.$blacklistedUser); ?></h3>

						                </div>



						                <div class="seller-descr white4">

						                  Nibh euismod tincidunt ut laoreet

						                </div>

						              </div>



						              <div class="clearer"></div>



						            </div> <!-- seller-top -->



						            <div class="seller-bottom-transform white3-bg">

						              <div class="seller-bottom-shape action-box">





						                <div class='options-wrapper _hidden'>

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

						                              <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/delete.svg"/>

						                            </div>

						                          </div>



						                          <div class='option-button-title  semi-bold white btnremoveBlacklistedSeller' data-seller="
												              	<?php echo $blacklistedUser; ?>">

						                            ΔΙΑΓΡΑΦΗ

						                          </div>



						                        </div>

						                      </div> <!-- Single cell -->





						                      <div class="option-cell-transform">

						                        <div class="option-cell-shape white text-center">



						                          <div class="option-button-transform">

						                            <div class="option-button-shape">

						                              <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/history.svg"/>

						                            </div>

						                          </div>



						                          <div class='option-button-title  semi-bold white'>

						                            ΙΣΤΟΡΙΚΟ

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



						                          <div class='option-button-title  semi-bold white'>

						                            ΠΡΟΜΗΘΕΥΤΗΣ

						                          </div>



						                        </div>

						                      </div> <!-- Single cell -->



						                    </div>

						                  </div>

						                </div>











						                <div class="seller-bottom-info-transform">

						                  <div class="seller-bottom-info-shape">



						                    <div class="single-info-transform">

						                      <div class="single_info-shape text-center">

						                        <div class="info_title blue3 bold">

						                          ΑΓΟΡΕΣ

						                        </div>

						                        <div class="info_data blue3 bold">

						                          <?php echo $val[0]; ?>

						                        </div>

						                      </div>

						                    </div>



						                    <div class="single-info-transform">

						                      <div class="single_info-shape text-center">

						                        <div class="info_title blue3 bold">

						                          ΠΡΟΣΦΟΡΕΣ

						                        </div>

						                        <div class="info_data blue3 bold">

						                          25

						                        </div>

						                      </div>

						                    </div>











						                  </div>

						                </div> <!-- seller-bottom-info-transform -->



						                <div class="seller-bottom-ratio-transform">

						                  <div class="seller-bottom-ratio-shape">

						                    <div class="ratio-info blue3 bold hidden">

						                      20%

						                    </div>

						                  </div>

						                </div>



						                <div class="seller-bottom-options_button-transform">

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

						        </div> <!--single_seller-transform'-->



						    </div> <!-- end single seller -->

						    <?php
									}
						    }

						    ?>
							</div>
						</div>


					</div><!--main-area-shape-->
				</div><!--main-area-transform-->
			</div> <!--dashboard-main-col-->









<?php get_footer(); ?>
<script type="text/javascript">
jQuery(".btnremoveBlacklistedSeller").on("click", function(e) {
	e.preventDefault();
	var seller = jQuery(this).attr('data-seller');
	jQuery.ajax({
		'type'	: 'post',
		'url'	:	ajaxurl,
		'data'	:	{
			action	:	'removeBlacklistSeller',
			seller	:	seller,
		},
		success: function(response) {
			var result = JSON.parse(response);
			if (result.status == 0) {
				alert(result.message);
				window.location.reload();
			}
			else {
				alert(result.message);
			}
		}
	});
	return false;
});
</script>
