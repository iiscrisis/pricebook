<?php
/**
 * Template Name: Homepage
 */
	session_start();


	if (is_user_logged_in()) {

		if (is_buyer()) {

			wp_safe_redirect('home-buyers');
			exit();
		}
		if (is_seller()) {

			wp_safe_redirect('home-sellers');
			exit();
		}
		/*if (current_user_can('administrator')) {
			echo "3c";
			wp_safe_redirect('http://localhost/pricebook/wp-admin');
			echo "3d";
			exit();
		}*/
	}

	get_header();

?>
<?php include('includes/header.php'); ?>
	<section id="primary" class="content-area col-sm-12 col-md-12 col-lg-8">
		<main id="main" class="site-main" role="main">


		</main>
	</section>

<?php
//get_sidebar();
get_footer();
