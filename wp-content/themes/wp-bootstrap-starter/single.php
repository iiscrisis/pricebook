<?php
	/**
	* The template for displaying all single posts
	*
	* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
	*
	* @package WP_Bootstrap_Starter
	*/

	get_header();
?>

<section id="primary" class="content-area col-sm-12 col-md-12 col-lg-8">
	<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post-thumbnail"> <?php the_post_thumbnail(); ?> </div>
				<header class="entry-header">
					<?php
						if ( is_single() ) :
							the_title( '<h1 class="entry-title">', '</h1>' );
						else :
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						endif;

						if ( 'post' === get_post_type() ) : ?>
						<div class="entry-meta"><?php wp_bootstrap_starter_posted_on(); ?></div>
					<?php endif; ?>
				</header><!-- .entry-header -->
				<div class="entry-content">
					<?php
						if ( is_single() ) :
							the_content();
						else :
							the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wp-bootstrap-starter' ) );
						endif;

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-starter' ),
							'after'  => '</div>',
							)
						);
					?>
				</div><!-- .entry-content -->

				<footer class="entry-footer"><?php wp_bootstrap_starter_entry_footer(); ?></footer>
			</article>

		<?php
			if ( comments_open() || get_comments_number() ) :
			comments_template();
			endif;
			endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</section><!-- #primary -->

<?php get_footer();
