<?php
/**
 * Template Name: Seller Blacklist -orig
 */
get_header(); ?>
<?php
	$withSales = true;
	$blacklistedUsers = getSellerBlacklist($withSales);
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
		<li class="active"><a href="/sellerblacklist">BLACKLIST</a></li>
		<li><a href="/sellerstatistics">ΣΤΑΤΙΣΤΙΚΑ</a></li>
	</ul>
</aside>
<section id="primary" class="content-area col-md-12 col-lg-10">
	<main id="main" class="site-main" role="main">
		<div class="container-fluid">
			<?php
				if (!empty($blacklistedUsers)) {
					foreach ($blacklistedUsers as $blacklistedUser=>$val) { ?>
						<div id="blacklistedUser-<?php echo 1; ?>" class="col-md-4 userblacklist-item">
							<div class="col-md-12"><h3><?php echo get_user_by('ID',$blacklistedUser)->nickname; ?></h3></div>
							<div class="col-md-12"><h4>Πωλήσεις <?php echo $val[0]; ?></h4></div>
							<a class="btnremoveBlacklistedUser btn btn-default" href="#" data-user="<?php echo $blacklistedUser; ?>">Remove from blacklist</a>
						</div>
						<?php
					}
				}
				else {
					echo 'Blacklist empty';
				}
			?>
		</div>
	</main><!-- #main -->
</section><!-- #primary -->
<script type="text/javascript">
jQuery(".btnremoveBlacklistedUser").live("click", function(e) {
	e.preventDefault();
	var user = jQuery(this).attr('data-user');
	jQuery.ajax({
		'type'	: 'post',
		'url'	:	ajaxurl,
		'data'	:	{
			action	:	'removeBlacklistUser',
			user	:	user,
		},
		success: function(response) {
			var result = JSON.parse(response);
			if (result.status == 0) {
				alert(result.message);
				window.location.reload();
			}
			else {
				alert(result.message);
			}
		}
	});
	return false;
});
</script>

<?php get_footer(); ?>
