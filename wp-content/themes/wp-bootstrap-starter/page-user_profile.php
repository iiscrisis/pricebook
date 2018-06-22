<?php
/**
* Template Name: User Profile Page
*/
get_header();



if (!is_user_logged_in()) {
	echo '<script type="text/javascript">window.location="'.get_site_url().'";</script>';
	exit();
}

if(!is_buyer())
{
	echo '<script type="text/javascript">window.location="'.get_site_url().'";</script>';
	exit();
}



$user  = get_current_user_id();

include('includes/header.php');
?>


<div id="dashboard_main" class="site-content top_index"> <?php // id="content" ?>
	<div class="container-fluid">
		<div class="row" id="user_profile">




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


						<div id="avatar-container" class="text-center inline-block middle">
							<div class="d-inline-block banner-image-transform">
								<div class="circle banner-image-shape " style="background-image: url(<?php echo getCustomAvatar($user);?>)"></div>
							</div>
							<?php

							$target_div = "#avatar-container";
							$instructions="Iδανικές διαστάσεις Avatar, 140px x 140px.<br/>Μέγιστο μέγεθος 2ΜΒ. H εικόνα θα μετατραπει αυτοματα σε 140px μηκος. Aρχεία : jpg, png";
							include('includes/seller/draganddrop.php'); ?>

						</div>

						<div id="user_details" class="text-left inline-block middle">



														<?php

														$user_info = get_userdata( get_current_user_id() );
													 	$user_info->user_email = substr($user_info->user_email, 0, -3);


														 ?>


														<div id="profile-title">

															<p class="black hidden">Paragraph</p>
														</div>


														<div id="profile-summary-acount" class="card-margin">
																			<div class="profile-card shadow2 radius_box">

																				<h2 id="profile-title-heading" class="black2"><?php  echo $user_info->user_email;?></h2>
																				<br />
																				<form id="password_change" method="post">
																					<div class=" single_seller_form-transform text-left inline-block vertical-top">


																						<div class="single_seller_form-shape form-group">



																							<div class="input_label bold black">
																								Nέο Password
																							</div>

																							<input name="reg_pass" class="form-control login-field" value="" placeholder="Password" id="reg_pass" required="" type="password"><div class="view_password pointer inline-block middle">
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

																							<input name="reg_pass2" class="form-control login-field" value="" placeholder="Password Επαλήθευση" id="reg_pass2" required="" type="password">	<div class="view_password pointer">
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
																							<input class="btn btn-primary btn-send _blue-bg" value="Aποθήκευση" name="reg_submit"  type="submit">
																						</div>
																					</div>


																				</form>
																			</div>
																		</div>
						</div>


					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<script type="text/javascript">

 create_drag_and_drop();

function create_drag_and_drop()
{

		// preventing page from redirecting
		jQuery("html").on("dragover", function(e) {
				e.preventDefault();
				e.stopPropagation();
			//  jQuery("h1").text("");
		});

		jQuery("html").on("drop", function(e) { e.preventDefault(); e.stopPropagation(); });

		// Drag enter
		jQuery('.upload-area').on('dragenter', function (e) {
				e.stopPropagation();
				e.preventDefault();
			//  jQuery("h1").text("Drop");
		});

		jQuery('.upload-area').on('dragleave', function (e) {
				e.stopPropagation();
				e.preventDefault();
			//  jQuery("h1").text("Drop");
				jQuery(this).removeClass("dropping");
		});

		// Drag over
		jQuery('.upload-area').on('dragover', function (e) {
				e.stopPropagation();
				e.preventDefault();

				jQuery(this).addClass("dropping");
			//  jQuery("h1").text("Drop");
		});

		// Drop
		jQuery('.upload-area').on('drop', function (e) {
				e.stopPropagation();
				e.preventDefault();

			//  jQuery("h1").text("Upload");
				jQuery(this).removeClass("dropping");
				jQuery(this).addClass("uploading");

				var file = e.originalEvent.dataTransfer.files;
				var fd = new FormData();

				fd.append('photo', file[0]);
				fd.append('action','uploadImageFiles');
				fd.append('size',jQuery(this).closest(".image_uploader").data("target"));
				uploadData(fd,jQuery(this).closest(".image_uploader").data("target"),jQuery(this));
		});

		// Open file selector on div click
		jQuery(".file_uploader").click(function(){
				jQuery(this).closest(".image_uploader").find("input[type=file]").click();
		});

		// file selected
		jQuery(".image_uploader").find("input[type=file]").change(function(){
				var fd = new FormData();

				var files = jQuery(this)[0].files[0];
			//  alert(1);
				fd.append('photo',files);
				fd.append('action','uploadImageFiles');
				fd.append('size',jQuery(this).closest(".image_uploader").data("target"));
				jQuery(this).closest(".image_uploader").find(".upload-area").removeClass("dropping");
				jQuery(this).closest(".image_uploader").find(".upload-area").addClass("uploading");
				uploadData(fd,jQuery(this).closest(".image_uploader").data("target"),  jQuery(this).closest(".image_uploader").find(".upload-area"));
		});
}


function uploadData(formdata,target,jQuerysource)
{
	var class_list = 'col-6 col-sm-6 col-md-3 col-lg-3 item';
	var action="gallery";
	//alert(jQuerysource.closest(".image_uploader").data("target"));

	if(jQuerysource.closest(".image_uploader").data("target")==="#seller-page-certificate")
	{
	/*  var image_url = jQuery(this).closest(".seller-gallery-transform").data("url");
		var parent = jQuery(this).closest(".seller-gallery-transform");*/

		 action="certificate";
		 class_list = 'col-4 col-sm-6 col-md-4 col-lg-4 item';
	}else if(jQuerysource.closest(".image_uploader").data("target")==="#seller-page-gallery")
	{
	/*  var image_url = jQuery(this).closest(".seller-gallery-transform").data("url");
		var parent = jQuery(this).closest(".seller-gallery-transform");*/
		action="gallery";
	//  seller-gallery-transform
}else if(jQuerysource.closest(".image_uploader").data("target")==="#profile-banner")
{
	action ="banner";
}else if(jQuerysource.closest(".image_uploader").data("target")==="#avatar-container")
{
	action ="avatar";
}

				console.log(formdata);
			jQuery.ajax({
				url : ajaxurl,
				type : 'post',
				data :formdata,
			//  beforeSend: function(){jQuery("#body-overlay").show();},
				contentType: false,
				processData:false,
				success : function( response ) {
					var data = JSON.parse(response);
					console.log(data);
					if (data.status == 1) {
						// addThumbnail(data.image_url);

						jQuerysource.removeClass("uploading");

				 if(action == "avatar")
						{
							jQuery("#avatar-container").find(".banner-image-shape").css('background-image', 'url()');
								//alert(data.image_url);
									location.reload(true);
								/*  var src = root_p+"/"+data.image_url;
									jQuery("#avatar-container").find(".banner-image-shape").css('background-image', 'url(' + src+ ')');*/

						}

						/*
						<div class="gallery-transform inline-block">
							<div class="gallery-shape">
								<img src="<?php echo jQuerygallery['url'];?>"/>
							</div>
						</div>
						*/
					}
					else {
								jQuerysource.removeClass("uploading");
						display_error(data.message);
					}
				//  window.location.reload();

				}
			});
}
</script>
