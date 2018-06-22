<?php
/**
* Template Name: Seller Registration
*/
get_header();
?>
<?php
/*if (is_user_logged_in()) {
if (is_seller()) {
header('Location: http://www.pricebook.gr/home-sellers');
}
if (is_buyer()) {
header('Location: http://www.pricebook.gr/home-buyers');
}
}*/
?>

<div id="dashboard_header" class="hidden-xs hidden-sm hidden-md _blue-bg">
	<div class="dashboard_header-shape white-bg">
		<div class="container-fluid">
			<div class="row relative">

				<div class="col-xs-12 col-md-12 col-lg-8 col-lg-offset-2" id="dashboard_header_left">

					<h2 class="black2 _condensed text-shadow productsTitle text-center"> Eγγραφή Επαγγελματία </h2>



					<div id="message_area" class="hidden">
						<div class="message-shape">

							<div class="info_close-window ">
								<img src="http://pricebook.gr/pricebook/wp-content/themes/wp-bootstrap-starter/images/icons/close-grey_menu.svg">
							</div>

							<div class="message_text">

							</div>


						</div>
					</div>
				</div>



			</div>
		</div>
	</div>
</div>


<div id="seller-register" class="white4-bg text-center">

	<div id="register_top" class="fixed text-left white4-bg">

		<div class="container">
			<div class="register_logo inline-block">
				<img src="<?php echo get_template_directory_uri() ;?>/images/theme0/logo.svg">
			</div>

			<div class="seller_register_title-transform inline-block bottom">
				<div class="seller_register_title-shape black2 bold">
					<h3 class="inline-block">Eγγραφή Eπαγγελματία</h3>
				</div>
			</div>

			<div class="pointer close_account right bold blue">
				<a class="blue" href="<?php echo get_site_url(); ?>/index.php">Eπιστροφή <i class="material-icons blue md-24 inline-block middle">close</i></a>
			</div>

			<div class="clearer">

			</div>

			<div class="col-xs-12" id="navigation-buttons">
				<div class="left hidden" id="prevButton" >
					<?php include("includes/navigation/prev-button.php");?>
				</div>
				<div class="right" id="nextButton">
					<?php include("includes/navigation/next-button.php");?>
				</div>





				<div class="clearer">

				</div>
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


						<div class="step_transform _inline-block  current white2-bg shadow  text-left step_button_1" data-step="1" active>
							<div class="step_transform-shape bold black2  white-bg inline-block middle">1</div>
							<div class="step_icon inline-block middle blue-bg">
								<i class="material-icons yellow">card_membership</i>
							</div>
							<div class="  step_title inline-block black2 middle">
								Eπιλογή
								Πακέτου
							</div>

						</div>


						<div class="step_transform  _inline-block   white2-bg shadow  text-left step_button_2" data-step="2">


							<div class="step_transform-shape bold black2  white-bg inline-block middle">2</div>
							<div class="step_icon inline-block middle blue-bg">
								<i class="material-icons yellow">account_circle</i>
							</div>
							<div class="  step_title inline-block black2 middle">
								Στοιχεια
								Λογαριασμού
							</div>


						</div>


						<div class="step_transform  _inline-block   white2-bg shadow  text-left step_button_3" data-step="3">


							<div class="step_transform-shape bold black2  white-bg inline-block middle">3</div>
							<div class="step_icon inline-block middle blue-bg">
								<i class="material-icons yellow">receipt</i>
							</div>
							<div class="  step_title inline-block black2 middle">
								Στοιχεια
								Τιμολόγησης
							</div>


						</div>


						<div class="step_transform  _inline-block   white2-bg shadow  text-left step_button_4" data-step="4">

							<div class="step_transform-shape bold black2  white-bg inline-block middle">4</div>
							<div class="step_icon inline-block middle blue-bg">
								<i class="material-icons yellow">credit_card</i>
							</div>
							<div class="  step_title inline-block black2 middle">
								Πληρωμή
							</div>


						</div>


						<div class="step_transform  _inline-block   white2-bg shadow  text-left step_button_5" data-step="5">


							<div class="step_transform-shape bold black2  white-bg inline-block middle">5</div>
							<div class="step_icon inline-block middle blue-bg">
								<i class="material-icons yellow">check_circle</i>
							</div>
							<div class="  step_title inline-block black2 middle">
								Ολοκλήρωση
							</div>


						</div>




					</div>
				</div>




				<div class="col-xs-12 hidden">


					<div id="stepCounter" data-step="1">
						<div class="row">


							<progress value="1" max="100"></progress>
						</div>

					</div>


				</div>
			</div>


			<div class="col-xs-8" id="dashboard_main_area">

				<?php  echo do_shortcode('[seller_registration]'); ?>

			</div>
		</div>


	</div>




</div>



<?php
//get_sidebar();
get_footer();
