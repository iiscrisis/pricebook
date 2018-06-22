<?php
/**
 * Template Name: Buyer Black List
 */
get_header(); ?>
<?php
	$sellers = getUserBlacklistClientsSummary(true);



	//var_dump($sellers);
	//update_field('user_sellerlist',null,'user_'.get_current_user_id());
?>


<?php include('includes/header.php'); ?>

<div id="dashboard_main" class="site-content"> <?php // id="content" ?>
	<div class="container-fluid">
		<div class="row" id="dashboard_main_area">

			<div class="col-xs-12 col-md-12 col-lg-2 content_padding" id="dashboard-menu">

				<div class="dashboard-menu-transform hidden-xs hidden-sm hidden-md">

					<?php include('includes/menu_list.php');?>

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
									if (!empty($sellers)) {
										foreach ($sellers as $seller) {

											if(!isset($seller['ID']) || $seller['ID'] =="")
											{
												continue;
											}
											$total_offers = count($seller["completed"]) + count($seller["closed"]) + count($seller["open"]); //=>$newquery);
											print_m()
										?>
										<?php $sellerObject = get_user_by('user_id',$seller['ID']); ?>
						    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 single_seller-col single_blacklist_seller" id="seller-<?php echo $seller['ID']; ?>" data-seller="<?php echo $seller['ID']; ?>">

						        <div class='single_seller-transform'>
						          <div class='single_seller-shape shadow radius2'>

						            <div class="seller-top black-bg ">

													 <div class='col-xs-12'>

														 <div class="seller-bottom-ratio-transform inline-block middle">
 						                  <div class="seller-bottom-ratio-shape">
 						                    	<div class="list_avatar blue2 bold circle">
 																		 <a class="white" href="<?php echo SELLER_PROFILE.$seller['ID'];?>" target="_blank">
 																		<?php  echo getCustomAvatar($seller['ID'],true); ;//echo get_avatar($seller['ID']); ?>
 																	</a>
 																		 </div>





 						                  </div>
 						                </div>


														 <div class="title-list bold inline-block middle">
															 <a class="white" href="<?php echo SELLER_PROFILE.$seller['ID'];?>" target="_blank">
															 			 	<?php echo get_field('seller_companyName','user_'.$seller['ID']); ?>
															 </a>
														 </div>


														 <div class="inline-block rating-list">
														 	<?php
														 	$user = 'user_'.$seller['ID'];
														 	$path = get_template_directory().'/includes/seller/rating.php';
														 	include($path);


														 		?>
														 </div>







						              </div>

						              <div class="clearer"></div>

						            </div> <!-- seller-top -->



						            <div class="seller-bottom-transform white-bg">
						              <div class="seller-bottom-shape action-box">


														<div class='options-wrapper'>
															<div class="options-box-transform ">
																<div class="options-box-shape  white2-bg _options-bg vertical buyer-actions">

																	<div class="arrow_cell-transform">
																		<div class="arrow_cell-shape options-back-button">


																			<i class="material-icons md-36 md-dark">keyboard_arrow_right</i>
																		</div>
																	</div>






																	<div class="option-cell-transform hidden">
																		<div class="option-cell-shape white text-center action">

																			<div class="option-button-transform">
																				<div class="option-button-shape ">

																					<i class="material-icons md-24 md-dark">new_releases</i>
																				</div>
																			</div>

																			<div class='option-button-title _semi-bold grey'>
																				Ιστορικό
																			</div>

																		</div>
																	</div> <!-- Single cell -->





																		<div class="option-cell-transform ">
																			<div class="option-cell-shape white text-center action btnAddSeller"   data-seller="<?php echo $seller['ID']; ?>">

																				<div class="option-button-transform">
																					<div class="option-button-shape">
																						 <i class="material-icons md-24 aqua">local_grocery_store</i>
																					</div>
																				</div>

																				<div class='option-button-title condensed  _semi-bold grey'>
																					Προμηθευτής
																				</div>

																			</div>
																		</div> <!-- Single cell -->


																		<div class="option-cell-transform">
																			<div class="option-cell-shape white text-center action btnremoveBlacklistedSeller"  data-seller="<?php echo $seller['ID']; ?>">

																				<div class="option-button-transform">
																					<div class="option-button-shape">
																						<i class="material-icons md-24 md-dark">no_sim</i>
																					</div>
																				</div>

																				<div class='option-button-title condensed _semi-bold grey'>
																					Aφαίρεση
																				</div>

																			</div>
																		</div> <!-- Single cell -->

																		<div class="option-cell-transform-confirm hidden">
																			<div class="option-cell-shape white text-center action " >

																				<div class="delete-confirm-transform inline-block">
																					<div class="delete-confirm-shape black3 bold">
																						Είστε σίγουροι για την αφαίρεση;
																					</div>
																				</div>

																				<div class="confirm-options inline-block">

																					<div class="single-confirm-options inline-block deleteInquiry" data-value="<?php echo $request->ID; ?>">
																						<div class="option-button-transform">
																							<div class="option-button-shape">
																								<i class="material-icons md-24 md-dark">no_sim</i>
																							</div>
																						</div>

																						<div class='option-button-title condensed _semi-bold grey'>
																							Διαγραφή
																						</div>
																					</div>

																					<div class="single-confirm-options inline-block canceldeleteInquiry">
																						<div class="option-button-transform">
																							<div class="option-button-shape">
																								<i class="material-icons md-24 md-dark">block</i>
																							</div>
																						</div>

																						<div class='option-button-title condensed _semi-bold grey'>
																							Ακύρωση
																						</div>
																					</div>

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
						                        <div class="info_title black bold">
						                          ΑΓΟΡΕΣ
						                        </div>
						                        <div class="info_data black bold">
						                         <?php echo sizeof($seller['completed']);?>
						                        </div>
						                      </div>
						                    </div>

						                    <div class="single-info-transform">
						                      <div class="single_info-shape text-center">
						                        <div class="info_title black bold">
						                          ΠΡΟΣΦΟΡΕΣ
						                        </div>
						                        <div class="info_data black bold">
							                       <?php echo $total_offers ;?>
						                        </div>
						                      </div>
						                    </div>





						                  </div>
						                </div> <!-- seller-bottom-info-transform -->



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

	alert(seller);
	var parentSeller = jQuery(this).closest(".single_seller-col");
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
			parentSeller.remove();
			}
			else {
				alert(result.message);
			}
		}
	});
	return false;
});
</script>
