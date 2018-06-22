<?php
/**
* The template for displaying all single posts
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package WP_Bootstrap_Starter
*/

get_header();




//Start pdf $tmpdests


//end pdf tests

$threadStarters = getInquiryThreads($post->ID);

$cats = get_field('inquiry_product_category',$post->ID);
$isService = false;
//print_m($cats[0]);
if ($cats != SERVICE || !in_array(SERVICE,$cats)) {
	foreach ($cats as $cat) {
		$parents = get_post_ancestors($cat);
		if (!empty($parents)) {
			foreach ($parents as $parent) {
				array_push($cats,$parent);
			}
		}
		//array_push($cats);
	}
}
if (in_array(SERVICE,$cats)) {
	$isService = true;
}
$blacklisted = isSellerBlacklisted($post->post_author);

if ($blacklisted)
{  echo "<script>window.location = 'http://pricebook.gr/home-sellers/?inquiries=active';</script>"; }
?>


			<?php

			$isBuyer = 0;
			$isSeller = 0;
			$sellers_offer=0;

			$col_lg = 12;

			if (is_buyer()) {
				$isBuyer = 1;
				if ($_GET['seller'] && $_GET['seller'] != '') {
					$sellers_offer=1;

				}
				else {

					$col_lg=10;
			}
			}else if (is_seller()) {
				$isSeller = 1;
			}
			?>

<div id="popup-bg" class="fullscreen">

</div>


<?php
if (is_buyer()) {
	if ($_GET['seller'] && $_GET['seller'] != '') {
		$linkBack = '<div class="offer-pagination"><a class="grey" href="'.get_permalink($post->ID).'"><i class="material-icons md-24 md-dark">keyboard_arrow_left</i>Όλες οι προσφορές</a></div>';

	}else {
		$linkBack = '<div class="offer-pagination"><a class="grey" href="'.get_site_url().'/home-buyers/?inquiries=active"><i class="material-icons md-24 md-dark">keyboard_arrow_left</i>Aνοικτά Αιτήματα</a></div>';
	}
}else {
	$linkBack = '<div class="offer-pagination"><a class="grey" href="'.get_site_url().'/home-sellers/?inquiries=active"><i class="material-icons md-24 md-dark">keyboard_arrow_left</i>Aνοικτά Αιτήματα</a></div>';
}
	$headTitle = $linkBack.$post->post_title;
 ?>

<?php  if (is_seller())
{
	$always_show_burger = 1;
}else {


	if (is_buyer()) {
		if ($_GET['seller'] && $_GET['seller'] != '') {
				$always_show_burger = 1;
		}
	}else {


			$always_show_burger = 0;
	}


}

include('includes/header.php'); ?>

<div id="dashboard_main" class="site-content"> <?php // id="content" ?>
	<div class="container-fluid">
		<div class="row" id="dashboard_main_area">


			<?php
			if($isBuyer && !$sellers_offer) // Check if we are viewing the list or the offer, if the list show menu
			{
			?>
			<div class="col-xs-12 col-md-12 col-lg-2 content_padding" id="dashboard-menu">

				<div class="dashboard-menu-transform hidden-xs hidden-sm hidden-md">

					<?php include('includes/menu_list.php');?>


				</div><!-- dashboard-menu-transform -->

			</div> <!-- dashboard-menu-->
			<?php
			}
			?>

			<?php
			$offers = getAllOffers($post->ID);
			$status = get_field('inquiry_status',$post->ID);
			//echo $status;
			?>



						<?php while ( have_posts() ) : the_post(); ?>




							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="post-thumbnail"> <?php the_post_thumbnail(); ?> </div>
							</article>
							<?php
							if (is_buyer()) {
								if ($_GET['seller'] && $_GET['seller'] != '') {
									include('includes/rating/rating.php');
									include('views/buyers/view-offer.php');
								}
								else { ?>
									<div class="col-xs-12 col-md-12 col-lg-<?php echo $col_lg;?> content_padding" id="dashboard-main-col">
										<!-- open applications -->
										<div class="main-area-transform">
											<div class="main-area-shape">

									<?php include('includes/offers-list.php'); ?>

										</div><!--main-area-shape-->
									</div><!--main-area-transform-->
								</div> <!--dashboard-main-col-->

								<?php }
							}else if (is_seller()) {

								include('views/sellers/view-inquiry.php');
							}
							?>

						<?php endwhile; ?>






			<?php get_footer();
