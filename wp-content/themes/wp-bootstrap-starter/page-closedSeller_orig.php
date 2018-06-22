<?php
/**
 * __Template Name: Closed Seller
 */


?>

<?php
	if (!is_user_logged_in()) {
		echo '<script type="text/javascript">window.location="'.get_site_url().'";</script>';
		exit();
	}
	/*
	else {
		if (isset($_SESSION)) {
			echo $_SESSION['userRole'];
		}
	}
	*/
?>



<?php
	//request by sidebar call
	$choice = '';
	if (isset($_GET['inquiries'])) {
		$choice = $_GET['inquiries'];
		switch ($choice) {
			case 'active':
				$requests = getOpenSellerInquiries();
				break;
			case 'inactive':
				$requests = getClosedSellerInquiries();
				break;
			default:
				$requests = getOpenSellerInquiries();
				break;
		}
	}
	else {
		echo '<script type="text/javascript">window.location="'.get_site_url().'/home-sellers/?inquiries=active";</script>';
		exit;
	}
?>

<?php get_header();
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


			<div class='open-applications-transform'>
			  <div class='open-applications-shape'>


					<?php if (!empty($requests)) {
						$today = date('Y-m-d H:i:s');
						foreach($requests as $request) { ?>

								<?php var_dump($request); ?>

							<?php
								$categories = get_field('inquiry_product_category',$request->ID);
								$categoriesText = '';
								foreach ($categories as $category) {
									$categoriesText .= get_post($category)->post_title;
								}

							?>

							<?php
								$status = get_field('inquiry_status',$request->ID);
								if ($status == 'complete') {
									$offers = get_field('inquiry_offers',$request->ID);
									$myOffer = array_filter($offers, function($offer) {
										return (intval($offer['inquiry_seller']['ID']) == get_current_user_id());
									});

									$statusClass="";
									if (!empty($myOffer)) {
										switch ($myOffer[0]['inquiry_status']) {
											case 'succeeded':
												$statusClass = 'succeeded';
												break;
											case 'failed':
												$statusClass = 'failed';
												break;
											case 'ignored':
												$statusClass = 'ignored';
												break;
											default:
												$statusClass = '';
												break;
										}
									}
								}
							?>


					<div class="col-xs-12 col-md-6 col-lg-3 single_open_appliacation-col <?php echo $statusClass;?>">
							<div class="single_open_application-transform">
								<div class="single_open_application-shape _radius4 shadow ">

										<div class='single_appllication_top-transform'>
											<div class='single_appllication_top-shape   white-bg'>

												<?php if (!in_array(get_field('inquiry_status',$request->ID),array('inactive','complete'))) {

												}?>
												<div class="col-xs-12 application-ended ">
													<div class="text-left appl-info-bottom">
														<div class="header_info-title semi-bold black bold condensed">
															Άνοιξε <span class="black"><?php echo get_field('inquiry_end_date',$request); ?></span>
														</div>
														<div class="clearer">

														</div>
														<div class="header_info-title semi-bold black bold condensed">
															Ολοκληρώθηκε
															<span class="black"><?php echo get_field('inquiry_completion_date',$request->ID); ?></span>
														</div>





													</div>
												</div>

												<div class="clearer">

												</div>

												<div class='col-xs-3 open_application-right'>
			                    <div class="application-right-info">

			                      <div class="avatar-transform">
			                          <div class="avatar-shape white">

			                            <div class="avatar-image-transform">
			                              <div class="avatar-image-shape">

																			<?php echo get_avatar($request->post_author,32); ?>
			                                <!-- <img src="images/user/user.jpg"> -->
			                              </div>
			                            </div><!--avatar-image-transform-->
			                            <div class='clearer'>

			                            </div>
			                            <div class="avatar-details-transform">
			                              <div class="avatar-details-shape">
			                                <a href="" class="condensed  grey3 bold">
																				<?php echo get_user_by('id',$request->post_author)->nickname; ?>
																			</a>
			                              </div>
			                            </div><!--avatar-image-transform-->

			                          </div>
			                        </div>

			                    </div>
			                  </div>

												<div class='col-xs-6 open_application-left white-bg'>

													<a href="<?php echo get_permalink($request->ID); ?>">
														<div class="appl-subtitle grey5">
															<!-- TEΧΝΟΛΟΓΙΑ/ΗΥ -->  <?php echo $categoriesText; ?>
														</div>

														<div class="appl-title black condensed">

																<h3><?php echo $request->post_title; ?>  </h3>

														</div>
													</a>
												</div>

												<div class='col-xs-3 open_application-right _hidden'>
													<div class="application-right-info">


														<div class="chat-image-transform">
															<div class="chat-image-shape">
																<img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/chats.svg"/>
															</div>
														</div>

														<div class="header_info-title  grey5 text-right condensed">

														</div>
														<div class="header_info-title  grey1 bold text-left condensed hidden">
															ΝΕΕΣ <br/>AΠΑΝΤΗΣΕΙΣ
														</div>

														<div class="header_info white2 aqua _yellow _green bold text-right right">
															 <!-- 5 -->
															<?php echo sizeof(getSellersRepliesForInquiry($request->ID));?>

														</div>

														<div class="clearer">

														</div>

													</div>
												</div>

												<div class="clearer">

												</div>

											</div>
										</div>

										<div class="clearer"></div>



										<div class="single_appllication_bottom-transform">
											<div class="single_appllication_bottom-shape white-bg  applications_cards action-box">


												<div class='options-wrapper'>
													<div class="options-box-transform ">
														<div class="options-box-shape  white2-bg _options-bg vertical buyer-actions">

															<div class="arrow_cell-transform">
																<div class="arrow_cell-shape options-back-button">
																	<div class="arrow-right blue">

																	</div>
																</div>
															</div>




															<div class="option-cell-transform">
																<div class="option-cell-shape white text-center action">

																	<div class="option-button-transform">
																		<div class="option-button-shape">
																			<img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/handshake.svg"/>
																		</div>
																	</div>

																	<div class='option-button-title condensed semi-bold blue'>
																		ΟΛΟΚΛΗΡΩΣΗ
																	</div>

																</div>
															</div> <!-- Single cell -->


															<?php if (get_field('inquiry_status',$request->ID) != 'complete')
															{ ?>



															<div class="option-cell-transform ">
																<div class="option-cell-shape white text-center action" data-action="update">

																	<div class="option-button-transform">
																		<div class="option-button-shape">
																			<img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/refresh.svg"/>
																		</div>
																	</div>

																	<div class='option-button-title condensed  semi-bold blue'>
																		ΑΝΑΝΕΩΣΗ
																	</div>

																</div>
															</div> <!-- Single cell -->


															<div class="option-cell-transform">
																<div class="option-cell-shape white text-center action data-action="update"">

																	<div class="option-button-transform">
																		<div class="option-button-shape">
																			<img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/applications/delete.svg"/>
																		</div>
																	</div>

																	<div class='option-button-title condensed semi-bold blue'>
																		ΔΙΑΓΡΑΦΗ
																	</div>

																</div>
															</div> <!-- Single cell -->

													<?php } ?>


														</div>
													</div>
												</div>




													<div class='col-xs-4 col-sm-2 col-md-4 col-lg-3 open_application-left condensed text-right white2-bg hidden'>

															<div class="text-right appl-info-top">
																<div class="header_info-title condensed semi-bold black2 bold">
																	AΠΑΝΤΗΣΕΙΣ
																</div>
																<div class="header_info yellow _white5 bold ">
																	15
																</div>

															</div>


															<div class="clearer"></div>

													</div>

													<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 open_application-bottom-right condensed text-left'>
														<div class="row">
															<div class="col-xs-2 offer-details-col">
			                          <div class="offer-details-title blue3 text-center">
			                            ΠΟΣΟΤΗΤΑ
			                          </div>

			                          <div class="offer-details-data aqua text-center">
																	<?php if (get_field('inquiry_product_quantities',$request->ID) != 0) {
																		 echo get_field('inquiry_product_quantities',$request->ID);
																	 }?>
			                          </div>
			                        </div>

			                        <div class="col-xs-3 offer-details-col">
			                          <div class="offer-details-title blue3 text-center">
			                            ΤΙΜΗ ΑΠΟ
			                          </div>
			                          <div class="offer-details-data aqua text-center">
			                            $10
			                          </div>
			                        </div>

			                        <div class="col-xs-3 offer-details-col">
			                          <div class="offer-details-title blue3 text-center">
			                            ΤΙΜΗ ΕΩΣ
			                          </div>
			                          <div class="offer-details-data aqua text-center">
			                            	<?php if (get_field('inquiry_max_price',$request->ID) != 0) {
 																			echo get_field('inquiry_max_price',$request->ID);
																		}?>
			                          </div>
			                        </div>

															<div class="col-xs-4 text-right">
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
						</div> <!-- single_open_appliacation- -->


						<?php
					}
				}
				else {
					echo 'None';
				}
			?>



				</div> <!-- end open-application-transform -->
			</div>

		</div><!--main-area-shape-->
	</div><!--main-area-transform-->
</div> <!--dashboard-main-col-->



<div id="renewInquiry">
	<h3>Επιλέξτε νέα ημ/νια λήξης αιτήματος</h3>
	<div class="renewInquiry-inner">
		<form>
			<input type="hidden" name="inquiryId" value="" />
			<input type="text" class="form-control" name="inquiry_end_date" required />
			<input type="submit" class="btn btn-primary" value="Ανανέωση" />
		</form>
	</div>
</div>
<script type="text/javascript">
	jQuery('#renewInquiry input[name="inquiry_end_date"]').datepicker({	minDate: '+7D' }).datepicker("option", "maxDate", '+32D').datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", "+5");
</script>
<?php // get_footer(); ?>
