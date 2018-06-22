<?php
/**
* Template Name: Seller Profile Orig
*/
get_header();
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

$seller_details_subscription_tmpl_id=@get_field('seller_details_subscription_tmpl_id',		$newSeller,false);
$seller_details_subscription_id=@get_field('seller_details_subscription_id',					$newSeller);
if(is_array($seller_details_subscription_tmpl_id))
{
	$seller_details_subscription_tmpl_id = $seller_details_subscription_tmpl_id[0];
}



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
<div id="seller-banner">
	<div <?php echo $style;?>>

		<div id="seller-bg" class="blue-bg">

		</div>

		<div class="container">
			<div id="seller-avatar-transform">
				<div class="seller-avatar-shape _shadow _white3-bg">
					<div class="seller-avatar-shape-image-transform inline-block middle">
						<div class="seller-avatar-shape-image-shape circle white-bg">
							<?php echo  get_avatar_url($seller,48);?>
						</div>
					</div>

					<div class="seller-company-name-transform inline-block middle">
						<div class="seller-company-name-shape white2 bold">
							<?php echo $seller_companyName;?>
						</div>
					</div>


				</div>
			</div>
		</div>

	</div>
</div>



<div class="input_row black shadow radius2 text-left _inline-block" id="general_info">
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

						<?php echo $seller_data_founded; ?>

					</div>

					<div class="single_seller_form-shape form-group inline-block bold grey" id="seller_details_address">
						<div class="input_label light black">
							Αριθμός εργαζομένων
						</div>
<?php echo $seller_data_employees; ?>




					</div>
					<?php
				}
				?>



				<div class="single_seller_form-shape form-group inline-block bold" id="seller_details_address">
					<div class="input_label light black">
						LinkedIn
					</div>
					<a class="green" href="<?php echo $seller_data_linkedin; ?>" target="blank">LinkedIn</a>

				</div>

				<div class="single_seller_form-shape form-group inline-block bold" id="seller_details_postcode">
					<div class="input_label light black">
						Facebook
					</div>

					<a class="blue2" href="<?php echo $seller_data_facebook; ?>" target="blank">facebook</a>


				</div>



				<div class="single_seller_form-shape form-group inline-block bold grey" id="seller_details_telephone">
					<div class="input_label light black">
						Website
					</div>

<a class="blue2" href="<?php echo $seller_data_web; ?>" target="blank"><?php echo $seller_data_web; ?></a>

				</div>



				<div class="clearer">

				</div>

			</div>
	</div>

	</div>
</div>







<?php if($seller_data_summary!="")
{
	?>


	<div id="seller-summary">
		<div class="seller-summary-shape">

			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="seller-summary-shape-description grey light">

							<?php echo $seller_data_summary; ?>

						</div>
					</div>
				</div>

			</div>


		</div>
	</div>

	<?php
}
?>

<div id="dashboard_main" class="site-content"> <?php // id="content" ?>
	<div class="container">
		<div class="row" id="dashboard_main_area">
<div class="col-xs-12">


			<div id="seller-page-gallery">
				<div class="seller-page-gallery-shape text-left">



			<?php //echo $seller_data_gallery;

			//var_dump($seller_data_gallery);

			if(isset($seller_data_gallery) && $seller_data_gallery != "")
			{
				$gallery_array = explode(",",$seller_data_gallery);
				foreach($gallery_array as $gallery )
				{

					?>
					<div class="seller-gallery-transform inline-block" data-url="<?php echo $gallery;?>">
						<div class="seller-gallery-shape shadow">
								<a href="<?php echo get_site_url()."/".$gallery;?>">
								<img src="<?php echo get_site_url()."/".$gallery;?>)"/>
								</a>

						</div>


					</div>
					<?php
				}
			}

			?>

	</div>
</div>

</div>
<script type="text/javascript">

(function($) {

	$(document).ready(function(){
		$('.seller-page-gallery-shape ').masonry({
		  columnWidth: 1,
		  itemSelector: '.seller-gallery-transform'
		});
	});

})(jQuery);


</script>
			<?php get_footer(); ?>
