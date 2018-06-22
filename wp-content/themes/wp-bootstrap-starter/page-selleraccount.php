<?php
/**
* Template Name: Seller Account
*/


if (!is_user_logged_in()) {
	echo '<script type="text/javascript">window.location="'.get_site_url().'";</script>';
	exit();
}

if(!is_seller())
{
	echo '<script type="text/javascript">window.location="'.get_site_url().'";</script>';
	exit();
}


$debug = 1;
$seller  = get_current_user_id();
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
$seller_customer_contact = @get_field("seller_customer_contact",$seller_details_subscription_tmpl_id);
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

			<div class="col d-flex justify-content-center align-items-center justify-content-lg-end" id="profile-top-actions">


				<?php
				$target_div = "#profile-banner";
				$instructions="Iδανικές διαστάσεις, 1200px x 320px.<br/>Μέγιστο μέγεθος 2ΜΒ. H εικόνα θα μετατραπει αυτοματα σε 1200px μηκος. Aρχεία : jpg, png";
				include('includes/seller/draganddrop.php'); ?>



			</div>

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
								<div class="circle banner-image-shape " style="background-image: url(<?php echo getCustomAvatar($seller);?>)"></div>
							</div>
							<?php

							$target_div = "#avatar-container";
							$instructions="Iδανικές διαστάσεις Avatar, 140px x 140px.<br/>Μέγιστο μέγεθος 2ΜΒ. H εικόνα θα μετατραπει αυτοματα σε 140px μηκος. Aρχεία : jpg, png";
							include('includes/seller/draganddrop.php'); ?>






							<div id="profile-title">
								<h1 id="profile-title-heading"><?php echo $seller_companyName;?></h1>
								<p class="black hidden">Paragraph</p>
							</div>
						</div>

						<hr>

						<form id="seller_general-data" method="post">


							<h6 class="content_heading black4 hidden"><i class="material-icons middle">format_align_center</i>Στοιχεία</h6>

							<?php
							if($tmpl_post_type == "tmpl_products")
							{
								?>
								<?php
								//		if($seller_data_founded){
									?>
									<div class="general_data_transform">
										<div class="general_data_shape"><span class="grey4 general_data_title light">Έτος ίδρυσης<br></span>


											<input id="reg_data_founded" type="text" placeholder="xxxx" value="<?php echo $seller_data_founded; ?>"  autofocus autocomplete="on" inputmode="numeric" maxlength="4" minlength="4" name="reg_data_founded" class="form-control" />

										</div>
									</div>
									<?php
									//	}
									?>

									<?php
									//	if($seller_data_employees){
										?>
										<div class="general_data_transform">
											<div class="general_data_shape single_seller_form-shape "><span class="grey4 general_data_title light">Αριθμός εργαζομένων<br></span>

												<select name="reg_data_employees" class="editable" id="reg_data_employees" required>
													<option value="" >
														Επιλέξτε πλήθος εργαζομένων
													</option>
													<?php
													$checked="";
													if($seller_data_employees =="1 εργαζόμενος")
													{
														$checked = "selected";
													}
													?>
													<option value="1 εργαζόμενος" <?php echo $checked;?>>
														1 εργαζόμενος
													</option>

													<?php
													$checked="";
													if($seller_data_employees =="2-10 εργαζόμενοι")
													{
														$checked = "selected";
													}
													?>
													<option value="2-10 εργαζόμενοι"  <?php echo $checked;?>>
														2-10 εργαζόμενοι
													</option>

													<?php
													$checked="";
													if($seller_data_employees =="11-50 εργαζόμενοι")
													{
														$checked = "selected";
													}
													?>
													<option value="11-50 εργαζόμενοι"  <?php echo $checked;?>>
														11-50 εργαζόμενοι
													</option>

													<?php
													$checked="";
													if($seller_data_employees =="51-200 εργαζόμενοι")
													{
														$checked = "selected";
													}
													?>
													<option value="51-200 εργαζόμενοι"  <?php echo $checked;?>>
														51-200 εργαζόμενοι
													</option>

													<?php
													$checked="";
													if($seller_data_employees =="201-500 εργαζόμενοι")
													{
														$checked = "selected";
													}
													?>
													<option value="201-500 εργαζόμενοι"  <?php echo $checked;?>>
														201-500 εργαζόμενοι
													</option>

													<?php
													$checked="";
													if($seller_data_employees =="501-1000 εργαζόμενοι")
													{
														$checked = "selected";
													}
													?>
													<option value="501-1000 εργαζόμενοι"  <?php echo $checked;?>>
														501-1000 εργαζόμενοι
													</option>

													<?php
													$checked="";
													if($seller_data_employees =="1001+ εργαζόμενοι")
													{
														$checked = "selected";
													}
													?>
													<option value="1001+ εργαζόμενοι"  <?php echo $checked;?>>
														1001+ εργαζόμενοι
													</option>
												</select>


											</div>
										</div>
										<?php
										//	}
										?>


										<?php

									}else if($tmpl_post_type == "tmpl_hotels")
									{?>










										<div class="general_data_transform single_seller_form-shape ">
											<div class="general_data_shape"><span class="grey4 general_data_title light">Τύπος καταλύματος<br></span>

												<select name="reg_data_hotel_type">
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
															$selected ="selected";
															$cat_post_id  = $type->ID;
														}else {
															# code...
															$selected ="";
														}
														?>

														<option value="<?php echo $key;?>" <?php echo $selected ;?>><?php  echo $type->post_title;?></option>
														<?php
													}
													?>
												</select>




											</div>
										</div>





										<?php
										$has_category  = get_field("hotel_has_category",$cat_post_id);
										if($has_category == 1)
										{
											?>

											<div class="general_data_transform stars">
												<div class="general_data_shape"><span class="grey4 general_data_title light">Κατηγορία<br></span></div>





												<div class="single_seller_form-transform vertical-top inline-block text-left " >
													<div class="single_seller_form-shape form-group" >



														<select name="reg_seller_data_stars">
															<?php


															$hotel_stars_array = array();

															$hotel_stars_array[0] ='1 αστέρι';
															$hotel_stars_array[1] ='2 αστέρια';
															$hotel_stars_array[2] ='3 αστέρια';
															$hotel_stars_array[3] ='4 αστέρια';
															$hotel_stars_array[4] ='5 αστέρια';



															$counter = 0;


															foreach($hotel_stars_array as $key=> $type)
															{

																if($key == $seller_data_stars)
																{
																	$selected ="selected";

																}else {
																	# code...
																	$selected ="";
																}
																?>

																<option value="<?php echo $key;?>" <?php echo $selected ;?>><?php  echo $type;?></option>
																<?php
															}
															?>
														</select>

														<div class="help-block with-errors">

														</div>
													</div>

												</div>

											</div>

											<?php
										}


										?>


										<?php
										$has_category  = get_field("hotel_has_rooms",$cat_post_id);
										if($has_category == 1)
										{
											?>
											<div class="general_data_transform">
												<div class="general_data_shape"><span class="grey4 general_data_title light">	<?php echo get_field("hotel_rooms_title",$cat_post_id);?><br></span>
												</div>

												<div class=" single_seller_form-transform vertical-top inline-block text-left " >
													<div class="single_seller_form-shape form-group" >





														<input id="reg_hotel_rooms" type="text" 	placeholder="1 - 2000" value="<?php echo $seller_data_rooms; ?>"  name="reg_hotel_rooms" class="form-control" />

														<div class="help-block with-errors"></div>

													</div>

												</div>


											</div>
											<?php
										}



									}else if($tmpl_post_type == "tmpl_services")
									{
										?>

										<?php

										?>
										<div class="general_data_transform single_seller_form-shape">
											<div class="general_data_shape "><span class="grey4 general_data_title light">Έτη Προυπηρεσίας<br></span>
											</div>
											<select name="reg_age" class="editable" id="reg_data_age" required>
												<option value="">

												</option>
												<?php
												if( $seller_data_age == "1 έως 5")
												{
													$checked="selected";
												}else {
													$checked="";
												}
												?>
												<option value="1 έως 5" <?php echo $checked;?>>
													1 έως 5
												</option>

												<?php
												if( $seller_data_age == "6 έως 10")
												{
													$checked="selected";
												}else {
													$checked="";
												}
												?>
												<option value="6 έως 10" <?php echo $checked;?>>
													6 έως 10
												</option>

												<?php
												if( $seller_data_age == "11 έως 15")
												{
													$checked="selected";
												}else {
													$checked="";
												}
												?>
												<option value="11 έως 15" <?php echo $checked;?>>
													11 έως 15
												</option>

												<?php
												if( $seller_data_age == "16  έως 20")
												{
													$checked="selected";
												}else {
													$checked="";
												}
												?>
												<option value="16  έως 20" <?php echo $checked;?>>
													16  έως 20
												</option>

												<?php
												if( $seller_data_age == "20+")
												{
													$checked="selected";
												}else {
													$checked="";
												}
												?>
												<option value="20+" <?php echo $checked;?>>
													20+
												</option>

											</select>
										</div>
										<?php



									}
									?>

									<h6 class="content_heading black4"><i class="material-icons middle">person_pin_circle</i>Web links</h6>
									<hr>
									<div class="_d-flex justify-content-between" id="social-data">
										<?php

										//	if($seller_data_facebook !="" )
										//	{?>
											<i class="fa fa-facebook-square fb-blue"></i>
											<input name="reg_fb" type="text" class="lowercase editable form-control login-field"
											value="<?php echo $seller_data_facebook; ?>"
											placeholder="Facebook" id="reg_fb"  />
											<div class="clearfix">	</div>
											<?php

											//	} ?>

											<?php

											//	if($seller_data_linkedin !="" )
											//	{?>
												<i class="fa fa-linkedin-square ln-blue"></i>
												<input name="reg_linkedin" type="text" class="lowercase editable form-control login-field"
												value="<?php echo $seller_data_linkedin; ?>"
												placeholder="LinkedIn" id="reg_linkedin"  />
												<div class="clearfix">	</div>
												<?php

												//		} ?>

												<?php

												//			if(	 $seller_data_web !="" )
												//	{?>
													<i class="fa fa-globe black"></i><input name="reg_web" type="text" class="lowercase editable form-control login-field"
													value="<?php echo $seller_data_web; ?>"           placeholder="www.example.com"  />
													<div class="clearfix">	</div>
													<?php

													//	} ?>


												</div>
												<input type="submit" class=" btn btn-primary btn-send " value="Aποθήκευση" name="reg_submit" />
											</form>
										</div>
									</div>





									<?php


									if($tmpl_post_type == "tmpl_hotels")
									{
										?>



										<div id="profile-hotel-location" class="card-margin">
											<div class="profile-card shadow2 radius_box">
												<h6 class="content_heading black4"><i class="material-icons middle">location_on</i>Περιοχή</h6>
												<hr>







												<div class="general_data_transform single_seller_form-shape">
													<div class="general_data_shape">
														<span class="grey4 general_data_title light">Επιλέξτε Περιοχη<br>
														</span>
													</div>







													<?php
													$data = get_posts(array(
													'numberposts'=>-1,
													'post_type'=>'areas',
													'orderby'=>'title',
													'order' => 'ASC'
													));
													$countIndex = 0;

													$areas_array = array();

													foreach($data as $area)
													{
														if($area->post_parent == 0)
														{
															$areas_array[$area->ID]['title'] = $area->post_title;
														}else {
															$areas_array[$area->post_parent]["areas"][$area->ID]['title'] = $area->post_title;
															$areas_array[$area->post_parent]["areas"][$area->ID]['longlat'] = get_field('area_longlat',$area->ID,false);
														}
													}

													//var_dump($areas_array);


													?>

													<form id="hotel_areas">
														<?php $areasArray = get_field('seller_areas','user_'.get_current_user_id(),false);?>

														<select name="areas[]" _multiple_ class="region_select black " id="hotel_areas_select">
															<option class="black area_option filtered" value="">  </option>
															<?php
															$group_cnt = 0;
															$area_counter = 0;
															foreach($areas_array as $area)
															{?>
																<optgroup class="black area_optgroup filtered" label="<?php echo $area['title'];?>">
																	<?php
																	foreach($area['areas'] as $key => $subarea)
																	{
																		$checked = "";

																		if($areasArray[0] == $key)
																		{
																			$checked = "selected";
																		}
																		$id = "option_$group_cnt_$area_counter";
																		?>
																		<option class="black area_option filtered" value="<?php echo $key; ?>" data-longlat="<?php echo $subarea['longlat'];?>" id="<?php echo $id;?>" <?php echo $checked;?>>
																			<div class="area_option_title"  data-longlat="<?php echo $subarea['longlat'];?>">
																				<?php echo $subarea['title']; ?>
																			</div>



																		</option>


																		<?php
																		$area_counter++;
																	}
																	?>
																</optgroup>
																<?php
																$group_cnt++;
															}

															?>

														</select>
													</form>
												</div>
											</div>
										</div>











										<?php
									}



									$isService="";
									if($seller_details_subscription_id_ID == 2750) //if services flag it
									{
										$isService="isservice";
									}?>


									<div id="profile-account-type" class="card-margin <?php echo $isService;?> ">
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




									<div id="profile-summary-more" class="card-margin">
										<div class="profile-card shadow2 radius_box">
											<h6 class="content_heading black4"><i class="material-icons middle">beenhere</i>Πιστοποιησεις</h6>
											<hr>



											<?php
											$target_div = "#seller-page-certificate";
											$instructions="Μέγιστο μέγεθος 2ΜΒ.<br/>H εικόνα θα μετατραπει αυτοματα σε 600px μηκος, Aρχεία : jpg, png .";
											include('includes/seller/draganddrop.php'); ?>

											<div class="row photos" id="seller-page-certificate">


												<?php
												if(isset($seller_data_certifications) && $seller_data_certifications != "")
												{
													$gallery_array = explode(",",$seller_data_certifications);

													foreach($gallery_array as $gallery )
													{?>



														<div class="col-4 col-sm-6 col-md-4 col-lg-4 item"  data-url="<?php echo $gallery;?>">
															<a href="<?php echo get_site_url()."/".$gallery;?>" class="user_certificate" data-lightbox="certs">

																<div class="photo_gallery_image" style="background-image:url(<?php echo get_site_url().'/'.$gallery; ?>)"></div>
															</a>

															<div class="gallery_delete-transform editable">
																<div class="gallery_delete-shape pointer white-bg shadow  circle text-center" >
																	<i class="material-icons md-18 red inline-block middle">delete</i>
																</div>
															</div>
														</div>


														<?php
													}
													?>
													<?php
												}

												?>

											</div>




										</div>
									</div>


								</div>
								<div class="col" id="main-profile">
									<div class="_row">

										<a href="#" id="leftArr" class="arrow">
											<i class="glyphicon glyphicon-chevron-left"></i>
										</a>
										<a href="#" id="rightArr" class="arrow">
											<i class="glyphicon glyphicon-chevron-right"></i>
										</a>

										<ul class="nav nav-pills" id="tabs">
											<li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-general">Προφίλ</a></li>
											<li class="nav-item"><a class="nav-link " role="tab" data-toggle="tab" href="#tab-account">Λογαριασμός</a></li>
											<li class="nav-item"><a class="nav-link " role="tab" data-toggle="tab" href="#tab-subscription">Συνδρομή</a></li>
											<?php

											if($tmpl_post_type == "tmpl_services"){
												?>
												<li class="nav-item "><a class="nav-link" role="tab" data-toggle="tab" href="#tab-info">Πληροφορίες</a></li>
												<?php
											}
											?>
											<?php

											if($tmpl_post_type == "tmpl_hotels"){
												?>
												<li class="nav-item border"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-hotel">Παροχές</a></li>
												<?php
											}
											?>




											<li class='nav-item dropdown collapsed-menu'>
												<a class="nav-link dropdown-toggle" data-toggle='dropdown' href='#' role='button' aria-haspopup="true" aria-expanded="false">
													<span class="glyphicon glyphicon-chevron-right"></span>
												</a>
												<div class="dropdown-menu collapsed-tabs" aria-labelledby="dropdownMenuButton">
												</div>
											</li>

										</ul>
										<div class="tab-content">





											<div class="tab-pane active" role="tabpanel" id="tab-general">



												<h6 class="content_heading black4">&nbsp;<i class="material-icons middle">image</i>&nbsp;Περιγραφή</h6>
												<hr>
												<div class="general-profile-text black">

													<textarea id="reg_seller_summary" name="reg_seller_summary">

														<?php echo  $seller_data_summary ;?>
													</textarea>

													<input type="submit" class=" btn btn-primary btn-send trigger_general_data" value="Aποθήκευση" name="reg_submit" />
												</div>







												<h6 class="content_heading black4">&nbsp;<i class="material-icons middle">image</i>&nbsp;Gallery</h6>
												<hr>
												<?php
												$target_div = "#seller-page-gallery";
												$instructions="Μέγιστο μέγεθος 2ΜΒ.<br/> H εικόνα θα μετατραπει αυτοματα σε 600px μηκος. Aρχεία : jpg, png";
												include('includes/seller/draganddrop.php'); ?>

												<div class="row photos" id="seller-page-gallery">


													<?php
													if(isset($seller_data_gallery) && $seller_data_gallery != "")
													{
														$gallery_array = explode(",",$seller_data_gallery);

														foreach($gallery_array as $gallery )
														{

															?>




															<div class="col-6 col-sm-6 col-md-3 col-lg-3 item"  data-url="<?php echo $gallery;?>">
																<a href="<?php echo get_site_url()."/".$gallery;?>" class="user_gallery" data-lightbox="photos">

																	<img src="<?php echo get_site_url()."/".$gallery;?>)"/>
																</a>

																<div class="gallery_delete-transform editable">
																	<div class="gallery_delete-shape pointer white-bg _shadow white circle text-center" >
																		<i class="material-icons md-18 red inline-block middle">delete</i>
																	</div>
																</div>
															</div>


															<?php
														}
														?>
														<?php
													}

													?>

												</div>

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


															$form_id= "education-form";
															$rows_id="education-rows";
															$tmpl_id="education_tmpl";

															$button_prefix = "education-button";
															$id_prefix="edu";
															$fields_array = array();

															include('includes/seller/services_education.php');

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

																$form_id= "work-form";
																$rows_id="work-rows";
																$tmpl_id="work_tmpl";

																$button_prefix = "work-button";
																$id_prefix="work";



																include('includes/seller/services_work.php');

																?>
															</div>


															<div id="certificate-box" class="single-info-box">
																<h6 class="content_heading black4"><i class="material-icons middle">beenhere</i><strong>Πιστοποιήσεις</strong><br></h6>
																<hr>



																<?php

																$seller_data_pool = $seller_data_qualifications_list;
																$cat_title = "Πιστοποιήσεις";
																$tmpl_id="certs_tmpl";
																$form_id= "certs-form";
																$rows_id="certs-rows";

																$button_prefix = "certs-button";
																$id_prefix="certs";


																$seller_data_pool= str_replace("<p>","",$seller_data_pool);
																	$seller_data_pool = str_replace("</p>","",$seller_data_pool);
																	$single_pool = explode("@@",$seller_data_pool);

																	include('includes/seller/services_certs.php');
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

															//  print_r($hotel_amenities_array);

															//var_dump($seller_data_amenities);
															?>






															<div class="tab-pane" role="tabpanel" id="tab-hotel">
																<div class="row">
																	<div class="col-sm-12 col-md-6">
																		<h6 class="content_heading black4"><i class="material-icons middle yellow">hotel</i><strong>Παροχές καταλύματος</strong><br></h6>
																		<hr>
																		<form id="hotel_amenities-form" method="post">
																			<?php

																			$hotel_amenities_list = get_field("hotel_amenities_list",$cat_post_id);

																			$hotel_amenities_array = explode(",",$hotel_amenities_list);

																			for($counter=0; $counter < sizeof($paroxes_katal); $counter++){
																				$checked_am = "";
																				if(!in_array($counter,$hotel_amenities_array) && (sizeof($hotel_amenities_array) > 0 && $hotel_amenities_array[0]!="")  )
																				{
																					continue;
																				}

																				if(isset($seller_data_amenities) && !empty($seller_data_amenities))
																				{

																					if(in_array($counter,$seller_data_amenities))
																					{
																						$checked_am = "checked";
																					}
																				}
																				?>

																				<div class="amenities_entry">

																					<div class="ckbx-style-8 ckbx-medium inline-block middle margin-right_15">
																						<input id="ckbx-style-8-1-<?php echo $counter;?>" value="<?php echo $counter;?>" name="reg_amenities[]" type="checkbox" <?php echo $checked_am;?>>

																						<label for="ckbx-style-8-1-<?php echo $counter;?>"></label>
																					</div>
																					<span class="black">
																						<?php echo $paroxes_katal[$counter];?>
																					</span>
																				</div>

																				<?php


																			}
																			?>
																			<input type="submit" value="Aποθήκευση" class=" btn btn-primary btn-send " />
																		</form>

																	</div>


																	<div class="col">
																		<h6 class="content_heading black4"><i class="material-icons middle yellow">room_service</i><strong>Παροχές δωματίων</strong><br></h6>
																		<hr>

																		<form id="hotel_amenities-room-form" method="post">
																			<div class="hotel-check-transform">
																				<div class="hotel-check-shape">




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




																					for($counter=0; $counter <  sizeof($paroxes_katal); $counter++){
																						$checked_am = "";


																						if(!in_array($counter,$room_amenities_array) && (sizeof($room_amenities_array) > 0 && $room_amenities_array[0]!="")  )
																						{
																							continue;
																						}
																						if(isset($seller_data_room_amenities) && !empty($seller_data_room_amenities))
																						{



																							if(in_array($counter,$seller_data_room_amenities))
																							{
																								$checked_am = "checked";
																							}
																						}


																						?>


																						<div class="amenities_entry">

																							<div class="ckbx-style-8 ckbx-medium inline-block middle margin-right_15">
																								<input id="ckbx-style-8-2-<?php echo $counter;?>" value="<?php echo $counter;?>" name="reg_hotel_room_amenities[]" type="checkbox" <?php echo $checked_am;?>>

																								<label for="ckbx-style-8-2-<?php echo $counter;?>"></label>
																							</div>
																							<span class="black">
																								<?php echo $paroxes_katal[$counter];?>
																							</span>
																						</div>


																						<?php

																					}
																					?>



																				</div>
																			</div>
																			<input type="submit" value="Aποθήκευση" class=" btn btn-primary btn-send " />
																		</form>




																	</div>
																</div>
															</div>

														<?php } ?>





															<div class="tab-pane" role="tabpanel" id="tab-account">

																<ul class="nav nav-pills" id="tabs-account">
																	<li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-account-setup">Ρυθμίσεις</a></li>
																	<li class="nav-item"><a class="nav-link " role="tab" data-toggle="tab" href="#tab-account-details">Στοιχεία</a></li>
																</ul>


																<div class="tab-content">



																	<div class="tab-pane active show" role="tabpanel" id="tab-account-setup">




																		<div class="profile-card shadow2 radius_box">

																			<h6 class="content_heading black4"><i class="material-icons middle">info</i>Τροπος Επικοινωνίας με τον πελάτη</h6>
																			<hr>

																				<div class=" single_seller_form-transform text-left inline-block vertical-top">
																					<div class="single_seller_form-shape form-group">



																						<input name="reg_customer_contact" type="text" class="form-control "
																						value="<?php  echo $seller_customer_contact;?>"
																						placeholder="email, τηλέφωνο..." id="reg_customer_contact" />

																					</div>

																				</div>

																				<input type="submit" class=" btn btn-primary btn-send trigger_general_data" value="Aποθήκευση" name="reg_submit" />






																		</div>



																			<div class="profile-card shadow2 radius_box">
																		<h6 class="content_heading black4">&nbsp;<i class="material-icons middle">info</i>Αυτοματοποιημένο Μήνυμα</h6>
																		<hr>


																			<textarea id="seller_custom_message" name="seller_custom_message">

																				<?php echo  $seller_custom_message ;?>
																			</textarea>

																			<input type="submit" class=" btn btn-primary btn-send trigger_general_data" value="Aποθήκευση" name="reg_submit" />
																		</div>

																													<?php if($tmpl_post_type != "tmpl_hotels")
																													{?>


																	<div class="profile-card shadow2 radius_box">
																		<div id="tab-categories">

																			<h6 class="content_heading black4">&nbsp;<i class="material-icons middle">info</i>Κατηγορίες</h6>
																			<hr>

																			<div class="">

																				<div class="open_areas-transform inline-block">
																					<div class="open_categories pointer bold blue-bg white _radius4 _shadow btn btn-primary">
																						<i class="material-icons middle md-32 white">add_circle_outline</i>  Προσθέστε Κατηγορία
																					</div>

																				</div>

																				<div class="open_areas-transform inline-block">
																					<div class="delete_categories pointer bold red-bg white _radius4 _shadow btn btn-error">
																						<i class="material-icons middle md-32 white">delete</i> Διαγραφή Όλων
																					</div>

																				</div>
																			</div>


																			<div class="clearer">

																			</div>
																			<form id="categories-form" method="post">

																				<div id="cat_tmpl" class="hidden">
																					<div class="single_selected_item-transform inline-block" data-cat="">
																						<input class="hidden" type="checkbox" value="" name="" checked/>
																						<div class="single_selected_item-shape shadow white-bg radius2">
																							<div class="delete_area-transform ">
																								<div class="delete_area-shape pointer">
																									<i class="material-icons md-24">delete_forever</i>
																								</div>
																							</div>


																							<div class="selected_item_title blue bold">

																							</div>
																							<div class="selected_item_parent grey3 ">

																							</div>

																						</div>
																					</div>
																				</div>


																				<div class="categories_container-transform">
																					<div class="selected_cats text-left">

																						<?php

																						$subscription_cat = get_post($seller_details_subscription_id_ID);
																						$subscription_root_category = @get_field("subscription_root_category",$subscription_cat->ID);

																						$catsArray = get_field('seller_product_categories','user_'.get_current_user_id());
																						$cat_filter_array = array();
																						foreach($catsArray as $key=>$cat)
																						{
																							$cat_filter_array[get_post($cat)->post_parent] = get_post(get_post($cat)->post_parent)->post_title ;
																							# code...
																							//  array_push($cat_filter_array[get_post($cat)->post_parent],get_post(get_post($cat)->post_parent)->post_title);
																							?>
																							<div class="single_selected_item-transform inline-block category_parent_<?php echo get_post($cat)->post_parent;?>" data-cat="<?php echo $cat;?>" id="cat<?php echo $cat;?>">
																								<input class="hidden" type="checkbox" value="<?php echo $cat;?>" name="cats[]" checked/>
																								<div class="single_selected_item-shape shadow white-bg radius2">
																									<div class="delete_area-transform ">
																										<div class="delete_area-shape pointer">
																											<i class="material-icons md-24">delete_forever</i>
																										</div>
																									</div>

																									<div class="selected_item_title blue bold">
																										<?php echo get_post($cat)->post_title ;?>
																									</div>
																									<div class="selected_item_parent grey3 ">
																										<?php echo get_post(get_post($cat)->post_parent)->post_title ;?>
																									</div>

																								</div>
																							</div>

																							<?php
																							//    break;
																						}
																						//  echo getAccountSubcategories_html($subscription_root_category->ID);
																						?>
																					</div>
																					<div class="filter-selection-transform hidden">
																						<div class="filter-selection-shape">

																							<select id="filter_categories">
																								<option value="-1">
																									Όλα
																								</option>
																								<?php
																								foreach ($cat_filter_array as $key => $filter) {
																									# code...
																									?>
																									<option id="cat_filter_<?php echo $key;?>" value="<?php echo $key;?>"><?php echo $filter;?></option>
																									<?php
																								}
																								?>
																							</select>
																						</div>
																					</div>
																				</div>
																				<input type="submit" name="submit_cats" class=" btn btn-primary btn-send_blue-bg" value="Αποθήκευση"/>
																			</form>
																		</div>
																	</div>

																		<div class="profile-card shadow2 radius_box">
																		<div id="tab-areas">



																		<h6 class="content_heading black4">&nbsp;<i class="material-icons middle">location_on</i>Περιοχές</h6>
																		<hr>

																			<div class="">
																				<div class="open_areas-transform inline-block">
																					<div class="open_areas pointer bold blue-bg  blue-bg white _radius4 _shadow btn btn-primary">
																						<i class="material-icons middle md-32 white">add_circle_outline</i>  Προσθέστε Περιοχή
																					</div>


																				</div>

																				<div class="open_areas-transform inline-block">
																					<div class="delete_areas pointer bold red-bg white _radius4 _shadow">
																						<i class="material-icons middle md-32 white">delete</i> Διαγραφή Όλων
																					</div>

																				</div>

																				<br/>

																				<div class="clearer">

																				</div>
																				<form id="areas-form" method="post">

																					<div id="area_tmpl" class="hidden">
																						<div class="single_selected_item-transform inline-block" data-area="">
																							<input class="hidden" type="checkbox" value="" name="" checked/>
																							<div class="single_selected_item-shape shadow white-bg radius2">
																								<div class="delete_area-transform ">
																									<div class="delete_area-shape pointer">
																										<i class="material-icons md-24">delete_forever</i>
																									</div>
																								</div>


																								<div class="selected_item_title blue bold">

																								</div>
																								<div class="selected_item_parent grey3 ">

																								</div>
																								<div class="map green hidden">

																								</div>
																							</div>
																						</div>
																					</div>


																					<div class="areas_container-transform">

																						<div class="selected_areas text-left">

																							<?php $areasArray = get_field('seller_areas','user_'.get_current_user_id(),false);?>

																							<?php

																							$areas_filter_array = array();
																							foreach ($areasArray as $key => $area){

																								$areas_filter_array[get_post($area)->post_parent] = get_post(get_post($area)->post_parent)->post_title ;
																								?>
																								<div id="cat<?php echo $area;?>" class="single_selected_item-transform inline-block area_parent_<?php echo get_post($area)->post_parent;?>" data-area="<?php echo $area;?>">
																									<input class="hidden" type="checkbox" value="<?php echo $area;?>" name="areas[]" checked/>
																									<div class="single_selected_item-shape shadow white-bg radius2">
																										<div class="delete_area-transform ">
																											<div class="delete_area-shape pointer">
																												<i class="material-icons md-24">delete_forever</i>
																											</div>
																										</div>

																										<div class="selected_item_title blue bold">
																											<?php echo get_post($area)->post_title ;?>
																										</div>
																										<div class="selected_item_parent grey3 ">
																											<?php echo get_post(get_post($area)->post_parent)->post_title ;?>
																										</div>
																										<div class="map green hidden">
																											<?php echo get_field("area_longlat",$area);?>
																										</div>
																									</div>
																								</div>
																								<?php

																							}?>
																							<div class="filter-selection-transform hidden">
																								<div class="filter-selection-shape">

																									<select id="filter_areas">
																										<option value="-1">
																											Όλες
																										</option>
																										<?php
																										foreach ($areas_filter_array as $key => $filter) {
																											# code...
																											?>
																											<option id="area_filter_<?php echo $key;?>" value="<?php echo $key;?>"><?php echo $filter;?></option>
																											<?php
																										}
																										?>
																									</select>
																								</div>
																							</div>
																						</div>

																						<div id="categories_selector" class="fixed text-center hidden item_selection_windows">


																							<div class="categories_selector-shape inline-block white-bg shadow text-left">
																								<h3 class="blue-bg white">Eπιλογή Κατηγοριών  <div class="pointer close_categories right">
																									<i class="material-icons white md-24">close</i>
																								</div></h3>

																								<div class="categories_container-shape">

																									<?php

																									$subscription_cat = get_post($seller_details_subscription_id_ID);
																									$subscription_root_category = @get_field("subscription_root_category",$subscription_cat->ID);
																									echo  getSellerAreasCats($subscription_root_category->ID,'seller_product_categories','product_category');;//getAccountSubcategories_html($subscription_root_category->ID);

																									?>
																								</div>



																							</div>

																						</div>


																						<div id="area_selector" class="fixed text-center hidden item_selection_windows">


																							<div class="area_selector-shape inline-block white-bg shadow text-left">
																								<h3 class="blue-bg white">Eπιλογή Περιοχων  <div class="pointer close_areas right">
																									<i class="material-icons white md-24">close</i>
																								</div></h3>

																								<div class="areas_container-shape">

																									<?php   echo   getSellerAreasCats(0,'seller_areas','areas');;//getAreas_html(0); ?>
																								</div>



																							</div>

																						</div>

																					</div>
																					<input type="submit" name="submit_areas"  class=" btn btn-primary btn-send _blue-bg" value="Αποθήκευση"/>
																				</form>


																			</div>
																		</div>
																	</div>
																		<?php
						}
																		?>

																	</div>





																	<div class="tab-pane" role="tabpanel" id="tab-account-details">
																		<div id="profile-summary-acount" class="card-margin">
																			<div class="profile-card shadow2 radius_box">

																				<h6 class="content_heading black4"><i class="material-icons middle">security</i>Password</h6>
																				<hr>
																				<form id="password_change" method="post">
																					<div class=" single_seller_form-transform text-left inline-block vertical-top">
																						<div class="single_seller_form-shape form-group">

																							<div class="input_label bold black">
																								Nέο Password
																							</div>

																							<input name="reg_pass" type="password" class="form-control login-field"
																							value=""
																							placeholder="Password" id="reg_pass" required/><div class="view_password pointer inline-block middle">
																								<i class="material-icons green">remove_red_eye</i>
																							</div>
																							<label class="login-field-icon fui-lock" for="reg-pass"></label>
																							<meter max="4" id="password-strength-meter"></meter>
																							<p id="password-strength-text" class="blue"></p>
																							<div class="help-block with-errors"></div>
																						</div>

																					</div>

																					<div class=" single_seller_form-transform text-left inline-block">
																						<div class="single_seller_form-shape form-group">

																							<div class="input_label bold black">
																								Eπαληθευση
																							</div>

																							<input name="reg_pass2" type="password" class="form-control login-field"
																							value=""
																							placeholder="Password Επαλήθευση" id="reg_pass2" required/>	<div class="view_password pointer">
																								<i class="material-icons green">remove_red_eye</i>
																							</div>
																							<label class="login-field-icon fui-lock" for="reg-pass2"></label>
																							<div id="divCheckPasswordMatch" class="red">		</div>
																						</div>

																						<div class="help-block with-errors"></div>

																					</div>
																					<div class="clearer">

																					</div>

																					<div class=" single_seller_form-transform text-left inline-block">
																						<div class="single_seller_form-shape form-group button_seller_form">
																							<input type="submit" class="btn btn-primary btn-send _blue-bg" value="Aποθήκευση" name="reg_submit" disabled />
																						</div>
																					</div>


																				</form>
																			</div>
																		</div>
																		<div id="profile-acount" class="card-margin">
																			<div class="profile-card shadow2 radius_box">

																				<h6 class="content_heading black4"><i class="material-icons middle">account_circle</i>Λογαριασμός</h6>
																				<hr>

																				<div class="general_data_transform inline-block middle">
																					<div class="general_data_shape">
																						<span class="grey4 general_data_title light">email
																							<br>
																						</span>
																						<span class="black4 general_data_data  bold">
																							<?php echo  $user_info->user_email ;?>
																							<br>
																						</span>
																					</div>
																				</div>


																				<div class="general_data_transform inline-block middle" >
																					<div class="general_data_shape">
																						<span class="grey4 general_data_title light">Διάρκεια Συνδρομής
																							<br>
																						</span>
																						<span class="black4 general_data_data bold">
																							<?php echo  $seller_details_renew_date ;?>
																							<br>
																						</span>
																					</div>
																				</div>

																				<div class="general_data_transform inline-block middle">
																					<div class="general_data_shape">
																						<span class="grey4 general_data_title light">Λήγει
																							<br>
																						</span>
																						<span class="black4 general_data_data bold">
																							<?php echo  $seller_details_renew_date  ;?>
																							<br>
																						</span>
																					</div>
																				</div>

																				<div class="general_data_transform inline-block middle">
																					<div class="general_data_shape">
																						<span class="grey4 general_data_title light">Νομική μορφή
																							<br>
																						</span>
																						<span class="black4 general_data_data bold">
																							<?php echo $seller_details_ctype ;?>
																							<br>
																						</span>
																					</div>
																				</div>

																				<div class="general_data_transform inline-block middle">
																					<div class="general_data_shape">
																						<span class="grey4 general_data_title light">ΑΦΜ
																							<br>
																						</span>
																						<span class="black4 general_data_data bold">
																							<?php echo  $seller_details_afm ;?>
																							<br>
																						</span>
																					</div>
																				</div>


																				<div class="general_data_transform inline-block middle">
																					<div class="general_data_shape">
																						<span class="grey4 general_data_title light">Τύπος παραστατικού
																							<br>
																						</span>
																						<span class="black4 general_data_data bold">
																							<?php
																							if($seller_details_receipt == 0)
																							{
																								?>

																								Τιμολόγιο
																								<?php
																							}else{
																								?>
																								Απόδειξη Λιανικής
																								<?php
																							}
																							?>
																							<br>
																						</span>
																					</div>
																				</div>


																			</div>
																		</div>
																	</div>

																</div>
															</div> <!-- end tab-account-->


															<div class="tab-pane" role="tabpanel" id="tab-subscription">
															</div>


													</div>
												</div>
											</div>
										</div>
									</section>

									<div id="categories_selector" class="fixed text-center hidden item_selection_windows categories_selector_box">
										<div class="container-fluid">

											<div class="categories_selector-shape inline-block white-bg shadow text-left">
												<h3 class="blue-bg white">Eπιλογή Κατηγοριών



													<div class="pointer discard_categories right hidden">
														<i class="material-icons black md-24">close</i>
													</div>
													<div class="pointer close_categories right">
														<i class="material-icons white md-24 inline-block middle">save</i>Aποθήκευση
													</div>
												</h3>

												<h3 class="blue2-bg small"><div class="white subtitle">Eπιλέξτε τις κατηγορίες που σας αφορούν.</div></h3>

												<div class="categories_container-shape row">

													<?php

													$subscription_cat = get_post($seller_details_subscription_id_ID);
													$subscription_root_category = @get_field("subscription_root_category",$subscription_cat->ID);
													echo  getSellerAreasCats($subscription_root_category->ID,'seller_product_categories','product_category');;//getAccountSubcategories_html($subscription_root_category->ID);

													?>
												</div>



											</div>
										</div>
									</div>


									<div id="area_selector" class="fixed text-center hidden item_selection_windows areas_selector_box ">

										<div class="container-fluid">


											<div class="area_selector-shape inline-block  text-left">
												<h3 class="blue-bg white">Eπιλογή Περιοχων  <div class="pointer close_areas right">
													<i class="material-icons white md-24">close</i>
												</div></h3>

												<div class="areas_container-shape row">

													<?php   echo   getSellerAreasCats(0,'seller_areas','areas');;//getAreas_html(0); ?>
												</div>



											</div>
										</div>
									</div>
