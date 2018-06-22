<section id="primary" class="content-area col-12">
	<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post-thumbnail"> <?php the_post_thumbnail(); ?> </div>
				<div class="entry-content">
					<?php
						if (is_buyer()) {
							if ($_GET['seller'] && $_GET['seller'] != '') {
								include('views/buyers/view-offer.php');
							}
							else { ?>
								<div class="col-md-12">
									<div class="col-md-4">
										<?php echo $post->post_content; ?>
								  </div>
									<?php include('views/buyers/list-offers.php'); ?>
								</div>
							<?php }
						}
						if (is_seller()) {
							include('views/sellers/view-inquiry.php');
						}
					?>
				</div>
			</article>


		<?php endwhile; ?>
	</main><!-- #main -->
</section><!-- #primary -->
