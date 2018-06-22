<?php
	/**
	* Template Name: Buyer Registration
	*/
	get_header();
?>
	<?php
	if (is_user_logged_in()) {
		if (is_seller()) {
			header('Location: http://www.pricebook.gr/home-sellers');
		}
		if (is_buyer()) {
			header('Location: http://www.pricebook.gr/home-buyers');
		}
	}
	?>
	<section id="primary" class="content-area col-sm-12 col-md-12 ">
		<main id="main" class="site-main" role="main">
			<?php echo do_shortcode('[buyer_registration]'); ?>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar();
get_footer();
