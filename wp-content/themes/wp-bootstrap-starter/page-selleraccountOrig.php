<?php
/**
* Template Name: Seller Account ORIGINAL
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
<?php
$newSeller = "user_".get_current_user_id();

//User info2
$user_info = get_userdata( get_current_user_id() );
$user_info->user_email = substr($user_info->user_email, 0, -3);
//echo " $user_info->display_name  - $user_info->user_email - $user_info->display_name ";

/*main info */

$seller_companyName = @get_field('seller_companyName',$newSeller);
$sellers_company_receipt = @get_field('sellers_company_receipt',$newSeller);

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
?>

<div id="seller-account" class="white4-bg text-center">


	<div id="register_top" class="fixed text-left white4-bg">

		<div class="container-fluid">
			<div class="register_logo inline-block">
				<img src="<?php echo get_template_directory_uri() ;?>/images/theme0/logo.svg">
			</div>

			<div class="seller_register_title-transform inline-block bottom">
				<div class="seller_register_title-shape black2 bold">
					<h3 class="inline-block">Λογαριασμός Eπαγγελματία</h3>
				</div>
			</div>


			<div class="pointer close_account right bold blue">
        <a class="blue" href="<?php echo get_site_url(); ?>/home-seller/?inquiries=active">Eπιστροφή <i class="material-icons blue md-24 inline-block middle">close</i></a>
      </div>

			<div class="clearer">

			</div>


		</div>
	</div>



	<div id="register-main" class="inline-block _shadow text-left">
		<div class="container ">


			<div class="clearer">

			</div>
			<div class="col-xs-4" id="meter_container">

				<div class="fixed">
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

				<?php include("includes/seller/seller-account.php")?>

			</div>
		</div>


	</div>
