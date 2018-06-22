<?php
/**
* Template Name: Seller Profile
*/
//get_header();
if(isset($_GET['seller']))
{

	$seller = intval($_GET['seller']);
	$info = get_user_by('ID',intval($seller));

}else {
	wp_die();
}
$debug = 1;

$newSeller = "user_".$seller;

//User info2
$user_info = get_userdata( $seller );
$user_info->user_email = substr($user_info->user_email, 0, -3);
//echo " $user_info->display_name  - $user_info->user_email - $user_info->display_name ";

/*main info */

$seller_companyName = @get_field('seller_companyName',$newSeller);
$sellers_company_receipt = @get_field('sellers_company_receipt',$newSeller);
$seller_custom_message = @get_field('seller_custom_message',$newSeller);
$seller_details_doy =@get_field('seller_details_doy',					$newSeller);
$seller_details_email_receipt=@get_field('seller_details_email_receipt',					$newSeller);
$seller_details_city=@get_field('seller_details_city',					$newSeller);
$seller_details_activities=@get_field('seller_details_activities',					$newSeller);

$seller_details_subscription_id=@get_field('seller_details_subscription_id',					$newSeller);
$seller_details_subscription_tmpl_id=@get_field('seller_details_subscription_tmpl_id',		$newSeller,false);
$seller_details_company=@get_field('seller_details_company',						$newSeller);
$seller_details_receipt=@get_field('seller_details_receipt',		$newSeller);
$seller_details_afm=@get_field('seller_details_afm',					$newSeller);
$seller_details_address=@get_field('seller_details_address',			$newSeller);
$seller_details_area=@get_field('seller_details_area',									$newSeller);
$seller_details_postcode=@get_field('seller_details_postcode',						$newSeller);
$seller_details_ctype=@get_field('seller_details_ctype',								$newSeller);
$seller_details_telephone=@get_field('seller_details_telephone',								$newSeller);
$seller_details_renew_date=@get_field('seller_details_renew_date',							$newSeller);
$seller_details_registration_date=@get_field('seller_details_registration_date',			$newSeller);

//var_dump($seller_details_subscription_id);

//echo "a $seller_companyName  $seller_details_company  $seller_details_subscription_tmpl_id";// - $seller_details_company";

$tmpl_post_types =array('2751'=>'tmpl_products','2752'=>'tmpl_hotels','2750'=>array(0=>'tmpl_products',1=>'tmpl_services'));
$tmpl_post_type = "";

$seller_details_subscription_id_ID = $seller_details_subscription_id;

if(!isset($seller_details_company) || $seller_details_company=="")
{
	$seller_details_company=0;
}

//echo "b ".$seller_details_subscription_id_ID. " - ".$seller_details_company;


if($seller_details_subscription_id_ID == '2750')
{



	$tmpl_post_type = $tmpl_post_types[$seller_details_subscription_id_ID][$seller_details_company];
}else {
	$tmpl_post_type = $tmpl_post_types[$seller_details_subscription_id_ID];
}



//echo $tmpl_post_type ." ".$seller_details_subscription_tmpl_id." < ";
//var_dump($seller_details_subscription_tmpl_id);
if(is_array($seller_details_subscription_tmpl_id))
{
	$seller_details_subscription_tmpl_id = $seller_details_subscription_tmpl_id[0];
}
//General Sellers dataType
$seller_data_banner = @get_field("seller_data_banner",$seller_details_subscription_tmpl_id);
$seller_data_linkedin= @get_field("seller_data_linkedin",$seller_details_subscription_tmpl_id);
$seller_data_facebook= @get_field("seller_data_facebook",$seller_details_subscription_tmpl_id);
$seller_data_web= @get_field("seller_data_web",$seller_details_subscription_tmpl_id);
$seller_data_summary= @get_field("seller_data_summary",$seller_details_subscription_tmpl_id);
$seller_data_gallery= @get_field("seller_data_gallery",$seller_details_subscription_tmpl_id);

//echo " <br/>---AAAAAAAAA-------";
//$seller_data_userid


if($tmpl_post_type == "tmpl_products" || $tmpl_post_type == "tmpl_hotels")
{
	$seller_data_certifications = @get_field("seller_data_certifications",$seller_details_subscription_tmpl_id);
}

//echo " <br/>---89-------$tmpl_post_type";
if($tmpl_post_type == "tmpl_products")
{
	$seller_data_founded = @get_field("seller_data_founded",$seller_details_subscription_tmpl_id);
	$seller_data_employees = @get_field("seller_data_employees",$seller_details_subscription_tmpl_id);
}else if($tmpl_post_type == "tmpl_hotels")
{
	//echo " <br/>---96-------";
	$seller_data_hotel_type= @get_field("seller_data_hotel_type",$seller_details_subscription_tmpl_id);
	$seller_data_stars= @get_field("seller_data_stars",$seller_details_subscription_tmpl_id);
	$seller_data_rooms = @get_field("seller_data_rooms",$seller_details_subscription_tmpl_id);
	$seller_data_amenities = @get_field("seller_data_amenities",$seller_details_subscription_tmpl_id);
	$seller_data_room_amenities= @get_field("seller_data_room_amenities",$seller_details_subscription_tmpl_id);

}else if($tmpl_post_type == "tmpl_services")
{
	# code...
	//echo " <br/>---105-------";
	$seller_data_age= @get_field("seller_data_age",$seller_details_subscription_tmpl_id);
	$seller_data_education= @get_field("seller_data_education",$seller_details_subscription_tmpl_id);
	$seller_data_work =  @get_field("seller_data_work",$seller_details_subscription_tmpl_id);
	$seller_data_qualifications_list = @get_field("seller_data_qualifications_list",$seller_details_subscription_tmpl_id);
	//	echo " <br/>---111-------";
}else {

	wp_die();

}




$areasArray = get_field('seller_areas','user_'.$seller,false);




$subscription_cat = get_post($seller_details_subscription_id_ID);
$subscription_root_category = @get_field("subscription_root_category",$subscription_cat->ID);

$catsArray = get_field('seller_product_categories','user_'.$seller);




?>


<?php if($seller_data_banner!=""){?>
	<?php
	$style = 'style="background-image:url('.get_site_url().'/'.$seller_data_banner.')"';
}else {
	$style = '';
} ?>

<section class="d-flex flex-row align-items-center blue-bg" id="profile-banner" <?php echo $style;?> >
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-lg-9 col-xl-8 d-flex d-lg-flex flex-column align-items-center flex-md-row">
			</div>
			<?php if(get_current_user_id() && get_current_user_id() != $seller)
			{
				?>
				<div class="col d-flex justify-content-center align-items-center justify-content-lg-end" id="profile-top-actions">
					<button class="btn btn-primary profile-action-button btnAddSeller blue-bg" type="button" data-seller="<?php echo $seller;?>"><i class="material-icons middle inline-block">work</i>&nbsp;Προμηθευτής</button>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</section>
<section id="main-menu" class="shadow2"></section>
<section id="main-area" class="white2-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-xl-4">
				<div id="profile-summary" class="card-margin">
					<div class="profile-card shadow2 radius_box">


						<div id="avatar-container" class="text-center">
							<div class="d-inline-block banner-image-transform">
								<div class="circle banner-image-shape " style="background-image: url(<?php echo  get_avatar_url($seller,192);?>)"></div>
							</div>
							<?php // echo get_avatar_data($seller);?>



							<div id="profile-title">
								<h1 id="profile-title-heading"><?php echo $seller_companyName;?></h1>
								<p class="black hidden">Paragraph</p>
							</div>
						</div>



						<h6 class="content_heading black4"><i class="material-icons middle">format_align_center</i>Στοιχεία</h6>
						<hr>
						<?php
						if($tmpl_post_type == "tmpl_products")
						{
							?>
							<?php
							if($seller_data_founded){
								?>
								<div class="general_data_transform">
									<div class="general_data_shape"><span class="grey4 general_data_title light">Έτος ίδρυσης<br></span><span class="black4 general_data_data bold"><?php echo $seller_data_founded;?><br></span></div>
								</div>
								<?php
							}
							?>

							<?php
							if($seller_data_employees){
								?>
								<div class="general_data_transform">
									<div class="general_data_shape"><span class="grey4 general_data_title light">Αριθμός εργαζομένων<br></span><span class="black4 general_data_data bold"><?php echo $seller_data_employees;?><br></span></div>
								</div>
								<?php
							}
							?>


							<?php

						}else if($tmpl_post_type == "tmpl_hotels")
						{?>


							<?php
							if($seller_data_hotel_type){
								?>
								<div class="general_data_transform">
									<div class="general_data_shape"><span class="grey4 general_data_title light">Τύπος καταλύματος<br></span>




										<?php
										$args = array(
										'post_parent' => HOTEL,
										'post_type'   => 'any',
										'numberposts' => -1,
										'post_status' => 'any'
										);
										$children = get_children( $args );


										$hotel_type_array = array();
										/*
										$hotel_type_array[0] ='Ξενοδοχείο';
										$hotel_type_array[1] ='Ενοικιαζόμενα Δωμάτια';
										$hotel_type_array[2] ='Ξενώνας';
										$hotel_type_array[3] ='Βίλα';
										$hotel_type_array[4] ='Bed & Breakfast';
										$hotel_type_array[5] ='Κάμπινγκ';


										*/                  $counter = 0;
										foreach($children as  $htype)
										{
											$hotel_type_array[$counter++] = $htype;
										}

										foreach($hotel_type_array as $key=> $type)
										{

											if($key == $seller_data_hotel_type)
											{

												$cat_post_id  = $type->ID;
												break;
											}else {
												# code...

												continue;
											}
											?>


											<?php
										}
										?>



										<span class="black4 general_data_data bold"><?php echo $hotel_type_array[$seller_data_hotel_type]->post_title;?><br></span></div>
									</div>
									<?php
								}
								?>

								<?php
								if($seller_data_stars){
									?>
									<div class="general_data_transform stars">
										<div class="general_data_shape"><span class="grey4 general_data_title light">Κατηγορία<br></span>
											<?php for($i=0;$i<$seller_data_stars;$i++)
											{
												?>
												<i class="material-icons yellow md-24 inline-block middle left stars">star_rate</i>
												<?php
											}
											?>
											<div class="clearfix">

											</div>
											<br>
										</div>
									</div>
									<?php
								}
								?>

								<?php
								if($seller_data_rooms){
									?>
									<div class="general_data_transform">
										<div class="general_data_shape"><span class="grey4 general_data_title light">	<?php echo get_field("hotel_rooms_title",$cat_post_id);?><br></span>
											<span class="black4 general_data_data bold"><?php echo $seller_data_rooms;?><br></span></div>
										</div>
										<?php
									}



								}else if($tmpl_post_type == "tmpl_services")
								{
									?>

									<?php
									if($seller_data_age){
										?>
										<div class="general_data_transform">
											<div class="general_data_shape"><span class="grey4 general_data_title light">Έτη Προυπηρεσίας<br></span>
												<span class="black4 general_data_data bold"><?php echo $seller_data_age;?><br></span></div>
											</div>
											<?php
										}


									}
									?>

									<h6 class="content_heading black4"><i class="material-icons middle">person_pin_circle</i>Social</h6>
									<hr>
									<div class="d-flex justify-content-between" id="social-data">
										<?php

										if($seller_data_facebook !="" )
										{?>
											<a href="<?php echo $seller_data_facebook;?>"><i class="fa fa-facebook-square fb-blue"></i></a>
											<?php

										} ?>

										<?php

										if($seller_data_linkedin !="" )
										{?>
											<a href="<?php echo $seller_data_linkedin;?>"><i class="fa fa-linkedin-square ln-blue"></i></a>
											<?php

										} ?>

										<?php

										if(	 $seller_data_web !="" )
										{?>
											<a href="<?php echo $seller_data_web;?>"><i class="fa fa-globe black"></i></a>
											<?php

										} ?>


									</div>
								</div>
							</div>


							<div id="profile-account-type" class="card-margin">
								<div class="profile-card shadow2 radius_box">
									<div class="d-flex justify-content-center align-items-center align-content-center blue-grad" id="category_box">
										<?php
										if($seller_details_subscription_id_ID == 2751)
										{
											?>
											<img src="assets/img/product.svg" class="category_box-image">
											<h6 class="blue">Προϊοντα</h6>
											<?php
										}


										if($seller_details_subscription_id_ID == 2752)
										{
											?>
											<img src="assets/img/hotel.svg" class="category_box-image">
											<h6 class="blue">Καταλύματα</h6>
											<?php
										}

										if($seller_details_subscription_id_ID == 2750)
										{
											?>
											<img src="assets/img/service.svg" class="category_box-image">
											<h6 class="blue">Υπηρεσίες</h6>
											<?php
										}
										?>





									</div>
							</div>
							</div>


							<div id="profile-summary-areas" class="card-margin">
								<div class="profile-card shadow2 radius_box">
									<h6 class="content_heading black4"><i class="material-icons middle">location_on</i>Περιοχές</h6>
									<hr>

									<?php

									foreach ($areasArray as $key => $area){


										?>

										<div class="single-area blue"><span class="area-title"><strong><?php echo get_post($area)->post_title ;?></strong><br>
										</span><span class="area-region">	<?php echo get_post(get_post($area)->post_parent)->post_title ;?><br></span></div>


										<?php

									}?>


								</div>
							</div>

							<?php //echo $seller_data_gallery;
							if(isset($seller_data_certifications) && $seller_data_certifications != "")
							{
								$gallery_array = explode(",",$seller_data_certifications);
								?>
								<div id="profile-summary-more" class="card-margin">
									<div class="profile-card shadow2 radius_box">
										<h6 class="content_heading black4"><i class="material-icons middle">beenhere</i>Πιστοποιησεις</h6>
										<hr>
										<div class="row photos">

											<?php
											foreach($gallery_array as $gallery )
											{?>
												<div class="col-4 col-sm-6 col-md-4 col-lg-3 item"><a href="<?php echo get_site_url()."/".$gallery;?>" data-lightbox="photos">
													<img class="img-fluid" src="<?php echo get_site_url()."/".$gallery;?>)"></a></div>

													<?php
												}
												?>

											</div>
										</div>
									</div>
									<?php
								}
								?>


							</div>
							<div class="col" id="main-profile">
								<div>
									<ul class="nav nav-tabs">
										<li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-general">Γενικά</a></li>
										<?php

										if($tmpl_post_type == "tmpl_services"){
											?>
											<li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-info">Πληροφορίες</a></li>
											<?php
										}
										?>
										<?php

										if($tmpl_post_type == "tmpl_hotels"){
											?>
											<li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-hotel">Παροχές</a></li>
											<?php
										}
										?>


										<?php if($tmpl_post_type != "tmpl_hotels")
										{

											?>

											<li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-categories">Kατηγορίες</a></li>
											<?php
										}
										?>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" role="tabpanel" id="tab-general">
											<div class="general-profile-text black">

												<?php echo $seller_data_summary ;?>



											</div>
											<?php
											if(isset($seller_data_gallery) && $seller_data_gallery != "")
											{
												$gallery_array = explode(",",$seller_data_gallery);
												?>
												<h6 class="content_heading black4">&nbsp;<i class="material-icons middle">image</i>&nbsp;Gallery</h6>
												<hr>
												<div class="row photos">

													<?php
													foreach($gallery_array as $gallery )
													{

														?>


														<div class="col-6 col-sm-6 col-md-3 col-lg-3 item">
															<a href="<?php echo get_site_url()."/".$gallery;?>" data-lightbox="photos">
																<img src="<?php echo get_site_url()."/".$gallery;?>)"/>
															</a>
														</div>


														<?php
													}
													?>


												</div>
												<?php
											}

											?>
										</div>



										<?php

										if($tmpl_post_type == "tmpl_services"){
											?>
											<div class="tab-pane" role="tabpanel" id="tab-info">
												<div id="education-box" class="single-info-box">
													<h6 class="content_heading black4"><i class="material-icons middle">verified_user</i><strong>Εκπαίδευση</strong><br></h6>
													<hr>
													<?php

													$seller_data_pool = $seller_data_education;
													$seller_data_pool= str_replace("<p>","",$seller_data_pool);
														$seller_data_pool = str_replace("</p>","",$seller_data_pool);
														$single_pool = explode("@@",$seller_data_pool);


														foreach($single_pool as $single_row)
														{
															$counter = 0;
															if($single_row=="")
															{
																continue;
															}


															$single_row = str_replace("##","",$single_row);
															$single_row = str_replace("@@","",$single_row);

															$fields = explode("@#",$single_row);

															?>

															<div class="card info-card shadow2">
																<div class="card-body">
																	<h4 class="card-title blue"><?php echo $fields[0];?></h4>
																	<h6 class="text-muted card-subtitle mb-2"><?php echo $fields[1];?></h6>
																	<p class="card-text black"><?php echo $fields[2];?>&nbsp;<span class="blue"><?php echo $fields[3];?></span></p>
																</div>
															</div>
															<?php
														}

														?>



													</div>


													<div id="work-box" class="single-info-box">
														<h6 class="content_heading black4"><i class="material-icons middle">work</i><strong>Επαγγελματική εμπειρία</strong><br></h6>
														<hr>


														<?php

														$seller_data_pool = $seller_data_work;
														$seller_data_pool= str_replace("<p>","",$seller_data_pool);
															$seller_data_pool = str_replace("</p>","",$seller_data_pool);
															$single_pool = explode("@@",$seller_data_pool);


															foreach($single_pool as $single_row)
															{
																$counter = 0;
																if($single_row=="")
																{
																	continue;
																}


																$single_row = str_replace("##","",$single_row);
																$single_row = str_replace("@@","",$single_row);

																$fields = explode("@#",$single_row);

																?>

																<div class="card info-card shadow2">
																	<div class="card-body">
																		<h4 class="card-title blue"><?php echo $fields[0];?></h4>
																		<h6 class="text-muted card-subtitle mb-2"><?php echo $fields[1];?></h6>
																		<p class="card-text black"><?php echo $fields[2];?>&nbsp;<span class="blue"><?php echo $fields[3];?></span></p>
																	</div>
																</div>
																<?php
															}

															?>
														</div>


														<div id="certificate-box" class="single-info-box">
															<h6 class="content_heading black4"><i class="material-icons middle">beenhere</i><strong>Πιστοποιήσεις</strong><br></h6>
															<hr>



															<?php

															$seller_data_pool = $seller_data_qualifications_list;
															$seller_data_pool= str_replace("<p>","",$seller_data_pool);
																$seller_data_pool = str_replace("</p>","",$seller_data_pool);
																$single_pool = explode("@@",$seller_data_pool);


																foreach($single_pool as $single_row)
																{
																	$counter = 0;
																	if($single_row=="")
																	{
																		continue;
																	}


																	$single_row = str_replace("##","",$single_row);
																	$single_row = str_replace("@@","",$single_row);

																	$fields = explode("@#",$single_row);

																	?>

																	<div class="card info-card shadow2">
																		<div class="card-body">
																			<h4 class="card-title blue"><?php echo $fields[0];?></h4>
																			<h6 class="text-muted card-subtitle mb-2"><?php echo $fields[1];?></h6>
																			<p class="card-text black"><span class="blue"><?php echo $fields[2];?></span></p>
																		</div>
																	</div>
																	<?php
																}

																?>



															</div>
														</div>
													<?php }?>

													<?php

													if($tmpl_post_type == "tmpl_hotels"){

														$paroxes_katal = array();






															$paroxes_katal[0]="24ωρη παροχή ζεστού νερού";
															$paroxes_katal[1]="Πρόσβαση σε ηλεκτρικό ρεύμα";
															$paroxes_katal[2]="Ανδρικά - Γυναικεία WC (ξεχωριστές εγκαταστάσεις)";
															$paroxes_katal[3]="Ανδρικά - Γυναικεία Ντους (ξεχωριστές εγκαταστάσεις)";
															$paroxes_katal[4]="Αποχέτευση για χημική τουαλέτα";
															$paroxes_katal[5]="Δωρεάν Wi-Fi";
															$paroxes_katal[6]="Δωρεάν Parking";
															$paroxes_katal[7]="Δωρεάν μετακίνηση από / προς το αεροδρόμιο";
															$paroxes_katal[8]="24ωρη reception";
															$paroxes_katal[9]="Δωρεάν πρωινό γεύμα";
															$paroxes_katal[10]="Αναψυκτήριο - Καφετέρια";
															$paroxes_katal[11]="Εστιατόριο";
															$paroxes_katal[12]="Bar";
															$paroxes_katal[13]="Mini Market";
															$paroxes_katal[14]="Καθαριστήριο";
															$paroxes_katal[15]="Κουζίνα / Χώρος Μαγειρέματος";
															$paroxes_katal[16]="Ψυγείο & Καταψύκτης";
															$paroxes_katal[17]="Πλυντήριο Ρούχων";
															$paroxes_katal[18]="Φαρμακείο";
															$paroxes_katal[19]="Εξωτερική πισίνα";
															$paroxes_katal[20]="Εσωτερική πισίνα";
															$paroxes_katal[21]="Ξαπλώστρες για την παραλία / πισίνα";
															$paroxes_katal[22]="Ομπρέλες για την παραλία / πισίνα";
															$paroxes_katal[23]="Πετσέτες για την παραλία / πισίνα";
															$paroxes_katal[24]="Κέντρο ευεξίας / Spa";
															$paroxes_katal[25]="Γυμναστήριο";
															$paroxes_katal[26]="Κομμωτήριο";
															$paroxes_katal[27]="Ιατρός";
															$paroxes_katal[28]="Προσωπικές θυρίδες ασφαλείας";
															$paroxes_katal[29]="24ωρη φύλαξη";
															$paroxes_katal[30]="Ναυαγοσώστης";
															$paroxes_katal[31]="Water Sports";
															$paroxes_katal[32]="Παιδότοπος / Παιδική Χαρά";
															$paroxes_katal[33]="Μίσθωση Ποδηλάτων";
															$paroxes_katal[34]="Μίσθωση Αυτοκινήτων";
															$paroxes_katal[35]="Μίσθωση Σκαφών";
															$paroxes_katal[36]="Γήπεδο beach soccer";
															$paroxes_katal[37]="Γήπεδο beach volley";
															$paroxes_katal[38]="Δορυφορική Τηλεόραση";
															$paroxes_katal[39]="Room service";
															$paroxes_katal[40]="Barbecue";
															$paroxes_katal[41]="Δωμάτια για ΑΜΕΑ";
															$paroxes_katal[42]="Χώροι υγιεινής για ΑΜΕΑ";
															$paroxes_katal[43]="Δωμάτια για μη καπνίζοντες";
															$paroxes_katal[44]="Αντιαλλεργικά δωμάτια";
															$paroxes_katal[45]="Συνεδριακός χώρος";
															$paroxes_katal[46]="Επιτρέπονται τα κατοικίδια";

														//get hotel amenities

														$hotel_amenities_list = get_field("hotel_amenities_list",$cat_post_id);

														$hotel_amenities_array = explode(",",$hotel_amenities_list);
														//  print_r($hotel_amenities_array);

														//var_dump($seller_data_amenities);
														?>






														<div class="tab-pane" role="tabpanel" id="tab-hotel">
															<div class="row">
																<div class="col-sm-12 col-md-6">
																	<h6 class="content_heading black4"><i class="material-icons middle yellow">hotel</i><strong>Παροχές καταλύματος</strong><br></h6>
																	<hr>
																	<?php 	for($counter=0; $counter < sizeof($paroxes_katal); $counter++){
																		$checked_am = "";
																		if(!in_array($counter,$hotel_amenities_array) && (sizeof($hotel_amenities_array) > 0 && $hotel_amenities_array[0]!="")  )
																		{
																			continue;
																		}


																		if(!in_array($counter,$seller_data_amenities))
																		{
																			continue;
																		}
																		?>


																		<div class="amenities_entry"><span class="black"><i class="material-icons md-18 yellow _md-dark middle ">check_box</i> <?php echo $paroxes_katal[$counter];?></span></div>

																		<?php


																	}
																	?>


																</div>




																<?php

																$room_amenities_list = get_field("room_amenities_list",$cat_post_id);
																$room_amenities_array = explode(",",$hotel_amenities_list);

																$paroxes_katal = array();

																$paroxes_katal[0]="24ωρη παροχή ζεστού νερού";
					                      $paroxes_katal[1]="Κλιματισμός";
					                      $paroxes_katal[2]="Καλοριφέρ";
					                      $paroxes_katal[3]="Τηλεόραση";
					                      $paroxes_katal[4]="Πλυντήριο ρούχων";
					                      $paroxes_katal[5]="Χρηματοκιβώτιο";
					                      $paroxes_katal[6]="Φούρνος μικροκυμάτων";
					                      $paroxes_katal[7]="Κουζίνα";
					                      $paroxes_katal[8]="Ψυγείο";
					                      $paroxes_katal[9]="Τζάκι";
					                      $paroxes_katal[10]="Πιστολάκι μαλλιών";
					                      $paroxes_katal[11]="Βραστήρας";
					                      $paroxes_katal[12]="Καφετιέρα";
					                      $paroxes_katal[13]="Θέα";
					                      $paroxes_katal[14]="Μπαλκόνι";
					                      $paroxes_katal[15]="Βεράντα / Αυλή";
																?>
																<div class="col">
																	<h6 class="content_heading black4"><i class="material-icons middle yellow">room_service</i><strong>Παροχές δωματίων</strong><br></h6>
																	<hr>
																	<?php 	for($counter=0; $counter < sizeof($paroxes_katal); $counter++){
																		$checked_am = "";
																		if(!in_array($counter,$hotel_amenities_array) && (sizeof($hotel_amenities_array) > 0 && $hotel_amenities_array[0]!="")  )
																		{
																			continue;
																		}

																		if(!in_array($counter,$seller_data_room_amenities))
																		{
																			continue;
																		}
																		?>


																		<div class="amenities_entry"><span class="black"><i class="material-icons md-18 yellow _md-dark middle ">check_box</i> <?php echo $paroxes_katal[$counter];?></span></div>

																		<?php


																	}
																	?>

																</div>
															</div>
														</div>

													<?php } ?>



													<?php if($tmpl_post_type != "tmpl_hotels")
													{

														?>


														<div class="tab-pane" role="tabpanel" id="tab-categories">

															<?php
															if(isset($catsArray))
															{


																foreach($catsArray as $key=>$cat)
																{

																	# code...
																	//  array_push($cat_filter_array[get_post($cat)->post_parent],get_post(get_post($cat)->post_parent)->post_title);
																	?>
																	<div class="single_selected_item-transform inline-block category_parent_<?php echo get_post($cat)->post_parent;?>" data-cat="<?php echo $cat;?>" id="cat<?php echo $cat;?>">

																		<div class="single_selected_item-shape shadow1 white-bg ">


																			<div class="selected_item_title blue bold">
																				<?php echo get_post($cat)->post_title ;?>
																			</div>
																			<div class="selected_item_parent black ">
																				<?php echo get_post(get_post($cat)->post_parent)->post_title ;?>
																			</div>

																		</div>
																	</div>

																	<?php
																	//    break;
																}
															}
															//  echo getAccountSubcategories_html($subscription_root_category->ID);
															?>
														</div>
														<?php
													}?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
