<?php
/**
 * Template Name: Seller Statistics original
 */
get_header(); ?>
<?php
	$statistics = getSellerStatistics();
?>

<div class="col-md-12">
	<h1><?php the_title(); ?></h1>
</div>
<aside id="secondary" class="widget-area col-sm-12 col-md-12 col-lg-2" role="complementary">
	<ul class="sidebar-inquiries">
		<li><a href="/home-sellers/?inquiries=active">ΑΝΟΙΚΤΑ ΑΙΤΗΜΑΤΑ</a></li>
		<li><a href="/home-sellers/?inquiries=inactive">ΚΛΕΙΣΤΑ ΑΙΤΗΜΑΤΑ</a></li>
		<li><a href="/sellermessages">ΜΗΝΥΜΑΤΑ</a><span class="messagesCount"></span></li>
		<li><a href="/sellersclientlist">ΠΕΛΑΤΟΛΟΓΙΟ</a></li>
		<li><a href="/sellerblacklist">BLACKLIST</a></li>
		<li class="active"><a href="/sellerstatistics">ΣΤΑΤΙΣΤΙΚΑ</a></li>
	</ul>
</aside>
<section id="primary" class="content-area col-md-12 col-lg-10">
	<main id="main" class="site-main" role="main">
		<div class="container-fluid">
			<div class="col-md-4 user-wonOffers">
				<div class="col-md-12"><h3>Επιτυχημένες προσφορές <?php echo $statistics['wonOffers']; ?></h3></div>
			</div>
			<div class="col-md-4 user-lostOffers">
				<div class="col-md-12"><h3>Αποτυχημένες προσφορές <?php echo $statistics['lostOffers']; ?></h3></div>
			</div>
			<div class="col-md-4 user-noParticipation">
				<div class="col-md-12"><h3>Χωρίς συμμετοχή <?php echo $statistics['noParticipation']; ?></h3></div>
			</div>
		</div>
	</main><!-- #main -->
</section><!-- #primary -->

<?php get_footer(); ?>
