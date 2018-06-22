<?php
/**
* Template Name: Seller Account WP
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
/*
else {
if (isset($_SESSION)) {
echo $_SESSION['userRole'];
}
}
*/

get_header();
//include('includes/header.php');

?>
<?php $debug =0;?>
<?php
$newSeller = "user_".get_current_user_id();

//User info2
$user_info = get_userdata( get_current_user_id() );
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
//echo " <br/>---BBBBBBBBB-------";
?>


<?php
$headTitle = $seller_companyName;
$bluebar_hidden = "hidden";
?>
<?php include('includes/header.php'); ?>



<?php if($seller_data_banner!=""){?>
	<?php
	$style = 'class="seller-banner-shape" style="background-image:url('.get_site_url().'/'.$seller_data_banner.')"';
}else {
	$style = 'class="seller-banner-shape blue-bg"';
} ?>

<div id="account_menu">

	<div class="custom-select">
  <select>
		<option value="1">Γενικές Πληροφορίες</option>
    <option value="1">Γενικές Πληροφορίες</option>
    <option value="2">Στοιχεία Λογαριασμού</option>
    <option value="3">Στοιχεία Τιμολόγησης</option>

  </select>
</div>

</div>


<div id="seller-banner" data-url="<?php echo $seller_data_banner?>">
	<div <?php echo $style;?>>

		<div id="seller-bg" class="black-bg">

		</div>

		<div class="container">
			<div id="seller-avatar-transform">
				<div class="seller-avatar-shape _shadow _white3-bg">
					<div class="container relative">


					<div class="seller-avatar-shape-image-transform inline-block middle ">
						<div class="seller-avatar-shape-image-shape  white-bg shadow ineditable">
							<?php  echo  get_avatar(get_current_user_id(),110);?>
						</div>

						<div id="upload_avatar" class="editable ">
							<?php echo do_shortcode('[avatar_upload]'); ?>
						</div>

					</div>



					<div class="seller-company-name-transform inline-block middle">
						<div class="seller-company-name-shape white2 bold">
							<?php echo $seller_companyName;?>
						</div>
					</div>


					<div class="edit-transform inline-block right">
						<div class="edit-shape pointer  green-bg radius6 shadow">



							<div class="edit-image-transform inline-block middle">
								<div class="edit-image-shape pointer circle green-bg">
										<i class="material-icons white">mode_edit</i>
								</div>
							</div>

							<div class="edit-title-transform inline-block middle ">
								<div class="edit-title-shape  white bold ">
									edit
								</div>
							</div>

						</div>
					</div>

				</div>
				</div>
			</div>
			</div>







		<div class="single_seller_form-transform  inline-block text-left right editable" id="seller_details_banner">
			<div class="single_seller_form-shape form-group white3-bg"  >
				<div class="input_label bold white4 hidden">
					Banner
				</div>

				<?php
				//  var_dump( $seller_data_banner);
				//echo " banner ". $seller_data_banner['url'] ;
				?>
				<div class="banner-transform" >
					<div class="banner-shape">


						<?php if($seller_data_banner!=""){
							?>

							<div class="gallery-transform inline-block" >
								<div class="gallery-shape" >
									<!--  -->
									<div class="gallery_delete-transform">
										<div class="banner_delete-shape pointer red-bg circle white shadow text-center">
											<i class="material-icons md-18 white inline-block middle">delete</i>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>

				<div class="banner-upload-transform">

					<div id="banner_preview">

						<form id="banner-upload" action="#" method="post">
							<input type="hidden" name="action" value="uploadImageFiles" />
							<div id="targetOuter">
								<div id="targetLayer"></div>

								<div class="icon-choose-image" >
									<input name="photo" id="bannerImage" type="file" class="inputFile" onChange="showPreview(this);" />
								</div>
							</div>
							<div>
								<input type="submit" class="btn btnSubmit btn-send blue-bg white" value="Ανέβασμα Banner" name="reg_submit">
							</div>
						</form>

					</div>

				</div>
				<?php

				?>
			</div>

		</div>



	</div>
</div>

<div id="account_page_1" class="account_page page_1">



	<form id="seller_general-data" method="post">


		<div class="input_row black shadow radius2 text-left _inline-block general_info" id="general_info">
			<div class="container">


				<div class="row text-left inline-block">

					<div class="col-xs-12 col-md-12  single_seller_form-transform inline-block text-center">


						<?php
						if($tmpl_post_type == "tmpl_products" || $debug ==1)
						{

							?>
							<div class="single_seller_form-shape form-group inline-block text-left bold grey"  id="seller_details_area">
								<div class="input_label light black">
									Έτος ίδρυσης
								</div>



								<input name="reg_data_founded" type="text" class="form-control login-field editable"
								value="<?php echo $seller_data_founded; ?>" minlength="4" maxlength="4" onkeypress='return isNumber(event)'
								placeholder="XXXX" id="reg_data_founded" />

								<span class="reg_data_founded ineditable"><?php  echo $seller_data_founded; ?></span>

							</div>

							<div class="single_seller_form-shape form-group inline-block bold grey" id="seller_details_address">
								<div class="input_label light black">
									Αριθμός εργαζομένων
								</div>


								<?php // echo $seller_data_employees; ?>
								<select name="reg_data_employees" class="editable" id="reg_data_employees" required>
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
								<!--  <input name="reg_data_employees" type="text" class="form-control login-field"
									value="<?php echo $seller_data_employees; ?>"
									placeholder="1-3000" id="reg_data_employees" required/>
									<div class="help-block with-errors"></div>-->

									<span class="reg_data_employees ineditable">	<?php  echo $seller_data_employees; ?></span>




								</div>
								<?php
							}
							?>



							<div class="single_seller_form-shape form-group inline-block bold" id="seller_details_address">
								<div class="input_label light black">
									LinkedIn
								</div>


								<input name="reg_linkedin" type="text" class="editable form-control login-field"
								value="<?php echo $seller_data_linkedin; ?>"
								placeholder="LinkedIn Url" id="reg_linkedin"  />



								<a   href="<?php echo $seller_data_linkedin; ?>" class="green reg_linkedin ineditable" target="blank">LinkedIn</a>

							</div>

							<div class="single_seller_form-shape form-group inline-block bold" id="seller_details_postcode">
								<div class="input_label light black">
									Facebook
								</div>
								<input name="reg_fb" type="text" class="editable form-control login-field"
								value="<?php echo $seller_data_facebook; ?>"
								placeholder="Facebook url" id="reg_fb"  />
								<a   href="<?php echo $seller_data_facebook; ?>" class="blue2 reg_fb ineditable" target="blank">facebook</a>


							</div>



							<div class="single_seller_form-shape form-group inline-block bold grey" id="seller_details_telephone">
								<div class="input_label light black">
									Website
								</div>
								<input name="reg_web" type="text" class="editable form-control login-field"
								value="<?php echo $seller_data_web; ?>"           placeholder="www.example.com"  />

								<a href="<?php echo $seller_data_web; ?>" class="blue2 reg_web ineditable"  target="blank"><?php echo $seller_data_web; ?></a>

							</div>



								<div class="single_seller_submit-shape form-group editable  inline-block bottom">


									<input type="submit" class=" btn btn-success btn-send blue-bg" value="Aποθήκευση" name="reg_submit" />
								</div>




							<div class="clearer">

							</div>

						</div>
					</div>

				</div>
			</div>


			<div id="seller-summary">
				<div class="seller-summary-shape">

					<div class="container">
						<div class="row">
							<div class="col-xs-12">
									<h3 class="text-left   _white-bg grey"><i class="material-icons white5 inline-block middle	">info</i>Περισσότερες Πληροφορίες</h3>
								<div class="seller-summary-shape-description grey light">
									<div class="editable">
										<?php
									$settings = array( 'textarea_rows' => 6,'teeny'=>true,'drag_drop_upload'=>true);
										wp_editor( stripslashes( $seller_data_summary ), "reg_seller_summary",$settings);
										?>
									</div>


											<span class="reg_seller_summary ineditable">	<?php echo $seller_data_summary; ?></span>


								</div>
								<div class=" single_seller_form-transform text-left inline-block editable ">
									<div class="single_seller_form-shape form-group">


										<input type="submit" class=" btn btn-success btn-send blue-bg" value="Aποθήκευση" name="reg_submit" />
									</div>
								</div>
							</div>
						</div>

					</div>


				</div>
			</div>

			<div id="seller-custom_message">
				<div class="seller-summary-shape">

					<div class="container">
						<div class="row">
							<div class="col-xs-12">
									<h3 class="text-left   _white-bg grey"><i class="material-icons white5 inline-block middle	">info</i>Αυτοματοποιημένο Μήνυμα</h3>
								<div class="seller-summary-shape-description grey light">
									<div class="editable">
										<?php
									$settings = array( 'textarea_rows' => 6,'teeny'=>true,'drag_drop_upload'=>true);
										wp_editor( stripslashes( $seller_custom_message ), "seller_custom_message",$settings);
										?>
									</div>


											<span class="reg_seller_summary ineditable">	<?php echo $seller_custom_message; ?></span>


								</div>
								<div class=" single_seller_form-transform text-left inline-block editable ">
									<div class="single_seller_form-shape form-group">


										<input type="submit" class=" btn btn-success btn-send blue-bg" value="Aποθήκευση" name="reg_submit" />
									</div>
								</div>
							</div>
						</div>

					</div>


				</div>
			</div>



			<?php

			?>
		</form>


		<?php include("includes/seller/seller-info.php")?>







		<div id="dashboard_main" class="site-content"> <?php // id="content" ?>
			<div class="container">
				<div class="row" id="">
					<div class="col-xs-12">
							<h3 class="text-left   _white-bg grey"><i class="material-icons white5 inline-block middle">collections</i>Gallery</h3>
						<?php

						if(isset($seller_data_gallery) && $seller_data_gallery != "")
						{?>

					<?php }?>
						<div id="seller-gallery_edit">



							<div id="seller-page-gallery" class="inline-block bottom">
								<div class="seller-page-gallery-shape text-left">



									<?php

									if(isset($seller_data_gallery) && $seller_data_gallery != "")
									{
										$gallery_array = explode(",",$seller_data_gallery);
										foreach($gallery_array as $gallery )
										{
											?>
											<div class="seller-gallery-transform inline-block middle" data-url="<?php echo $gallery;?>">
												<div class="seller-gallery-shape shadow">
													<a href="<?php echo get_site_url()."/".$gallery;?>">
														<img src="<?php echo get_site_url()."/".$gallery;?>)"/>
													</a>
												</div>

												<div class="gallery_delete-transform editable">
													<div class="gallery_delete-shape pointer red-bg shadow white circle text-center" >
														<i class="material-icons md-18 white inline-block middle">delete</i>
													</div>
												</div>
											</div>
											<?php
										}
									}
									?>

								</div>
							</div>

							<div class="gallery-upload-transform editable inline-block middle">

								<div id="gallery_preview" class=" white4-bg radius4 shadow image_upload_container">

									<?php

									/*


											<form action="#" method="post"  class="dropzone"   id="gallery_upload"></form>*/


									 ?>

									 <form id="gallery-upload" action="#" method="post">
		 								<input type="hidden" name="action" value="uploadImageFiles" />
		 								<div id="targetOuter">
		 									<div id="targetLayer"></div>

		 									<div class="icon-choose-image" >
		 										<input name="photo" id="userImage" type="file" class="inputFile" onChange="showPreview(this);" />
		 									</div>
		 								</div>
		 								<div>
		 									<input type="submit" value="Upload Photo" class="editable btn btn-success btn-send blue-bg" />
		 								</div>
		 							</form>

								</div>
							</div>
						</div>
					</div>
				</div>



				<div class="row" id="">
					<div class="col-xs-12">


						<div id="certificates-gallery_edit">

	<h3 class="text-left   _white-bg grey"><i class="material-icons white5 inline-block middle	">school</i>Πιστοποιητικά</h3>
							<?php
							if($tmpl_post_type == "tmpl_products" || $tmpl_post_type == "tmpl_hotels" || $debug ==1)
							{?>
								<?php //echo $seller_data_gallery;
								if(isset($seller_data_certifications) && $seller_data_certifications != "")
								{?>

								<?php }?>
								<div id="seller-page-certificate" class="inline-block bottom">
									<div class="seller-page-certificate-shape text-left">



										<?php //echo $seller_data_gallery;
										if(isset($seller_data_certifications) && $seller_data_certifications != "")
										{
											$gallery_array = explode(",",$seller_data_certifications);
											foreach($gallery_array as $gallery )
											{


												?>
												<div class="seller-gallery-transform inline-block" data-url="<?php echo $gallery;?>">
													<div class="seller-gallery-shape ">
														<a href="<?php echo get_site_url()."/".$gallery;?>">
															<img src="<?php echo get_site_url()."/".$gallery;?>)"/>
														</a>
													</div>

													<div class="gallery_delete-transform editable" >
														<div class="gallery_delete-shape pointer red-bg shadow white circle text-center">
															<i class="material-icons md-18 white inline-block middle">delete</i>
														</div>
													</div>
												</div>
												<?php
											}
										}
										?>

									</div>
								</div>

								<div class="certificates-upload-transfor editable inline-block middle">

									<div id="cert_preview"  class=" white4-bg radius4 shadow image_upload_container">

										<form id="certificates-upload" action="#" method="post">
											<input type="hidden" name="action" value="uploadImageFiles" />
											<div id="targetOuter">
												<div id="targetLayer"></div>

												<div class="icon-choose-image" >
													<input name="photo" id="certImage" type="file" class="inputFile" onChange="showPreview(this);" />
												</div>
											</div>
											<div>
												<input type="submit" value="Upload Photo" class="editable btn btn-success btn-send blue-bg" />
											</div>
										</form>

									</div>




								</div>

							<?php } ?>
						</div>
					</div>
				</div>









			</div><!-- end container-->

		</div> <!-- end public data -->




	</div> <!-- end page 1 -->




<?php include("includes/seller/seller-account.php")?>




	<div id="account_" class="_account_page _page_2 hidden">






		<div id="register-main" class="inline-block _shadow text-left">
			<div class="container ">


				<div class="clearer">

				</div>
				<div class="col-xs-4" id="meter_container">

					<div class="fixed hidden">
						<div class="steps_numbering">


							<div class="step_transform _inline-block  complete current white2-bg shadow  text-left step_button_1" data-step="1" active>
								<div class="step_transform-shape bold black2  white-bg inline-block middle">1</div>
								<div class="step_icon inline-block middle blue-bg">
									<i class="material-icons yellow">account_circle</i>
								</div>
								<div class="  step_title inline-block blue middle">
									Στοιχεια
									Λογαριασμού
								</div>

							</div>


							<div class="step_transform  _inline-block  current white2-bg shadow  text-left step_button_2" data-step="2">


								<div class="step_transform-shape bold black2  white-bg inline-block middle">2</div>
								<div class="step_icon inline-block middle blue-bg">
									<i class="material-icons yellow">receipt</i>
								</div>
								<div class="  step_title inline-block blue middle">
									Στοιχεια
									Τιμολόγησης
								</div>


							</div>


							<div class="step_transform  _inline-block current  white2-bg shadow  text-left step_button_3" data-step="3">


								<div class="step_transform-shape bold black2  white-bg inline-block middle">3</div>
								<div class="step_icon inline-block middle blue-bg">
									<i class="material-icons yellow">receipt</i>
								</div>
								<div class="  step_title inline-block blue middle">
									Πληροφορίες
									Επαγγελματία
								</div>


							</div>


							<div class="step_transform  _inline-block current  white2-bg shadow  text-left step_button_4" data-step="4">

								<div class="step_transform-shape bold black2  white-bg inline-block middle">4</div>
								<div class="step_icon inline-block middle blue-bg">
									<i class="material-icons yellow">credit_card</i>
								</div>
								<div class="  step_title inline-block blue middle">
									Επιλογή Κατηγοριών
								</div>


							</div>


							<div class="step_transform  _inline-block  current white2-bg shadow  text-left step_button_5" data-step="5">


								<div class="step_transform-shape bold black2  white-bg inline-block middle">5</div>
								<div class="step_icon inline-block middle blue-bg">
									<i class="material-icons yellow">check_circle</i>
								</div>
								<div class="  step_title inline-block blue middle">
									Επιλογή Περιοχών
								</div>


							</div>




						</div>
					</div>

				</div>


				<div class="col-xs-8" id="dashboard_main_area">



				</div>
			</div>


		</div>

	</div> <!-- account_page_2 -->

	<script type="text/javascript">
	var w =  jQuery(window).width() > 320 ? 320 :jQuery(window).width() ;
	 jQuery(".custom-select").width(w);
	create_custom_select("custom-select","account_pager")


 	jQuery(".account_pager div").live("click",function(){

		var page = jQuery(this).data("value");
		jQuery(".account_page").addClass("hidden");
		jQuery(".page_"+page).removeClass("hidden");

 });



 jQuery(".edit-shape").on("click",function(){


	 if(jQuery(this).hasClass("active"))
	 {
		 jQuery(this).removeClass("active")
		 jQuery("#wrap").removeClass("edit_mode");
	 }else {
		 jQuery(this).addClass("active")
	 		jQuery("#wrap").addClass("edit_mode");
	 }


 });

   jQuery(".edit-shape").trigger("click");
	</script>
