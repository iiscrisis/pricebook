<?php
/**
 * Template Name: Seller Clients List Orig
 */
get_header(); ?>
<?php
	$clients = getSellerClientsSummary();
	//var_dump($clients);
?>
<div class="col-md-12">
	<h1><?php the_title(); ?></h1>
</div>
<aside id="secondary" class="widget-area col-sm-12 col-md-12 col-lg-2" role="complementary">
	<ul class="sidebar-inquiries">
		<li><a href="/home-sellers/?inquiries=active">ΑΝΟΙΚΤΑ ΑΙΤΗΜΑΤΑ</a></li>
		<li><a href="/home-sellers/?inquiries=inactive">ΚΛΕΙΣΤΑ ΑΙΤΗΜΑΤΑ</a></li>
		<li><a href="/sellermessages">ΜΗΝΥΜΑΤΑ</a><span class="messagesCount"></span></li>
		<li class="active"><a href="/sellersclientlist">ΠΕΛΑΤΟΛΟΓΙΟ</a></li>
		<li><a href="/sellerblacklist">BLACKLIST</a></li>
		<li><a href="/sellerstatistics">ΣΤΑΤΙΣΤΙΚΑ</a></li>
	</ul>
</aside>
<section id="primary" class="content-area col-md-12 col-lg-10">
	<main id="main" class="site-main" role="main">
		<div class="container-fluid">
			<?php
				if (!empty($clients)) {
					foreach ($clients as $key => $val) {  ?>
						<?php
							$clientInquiries = array();
							$inquiries = getClosedSellerInquiries();
							foreach ($inquiries as $inquiry) {
								if (intval($inquiry->post_author == intval($key))) {
									$offers = getOffer($inquiry->ID,get_current_user_id());
									if (!empty($offers) && !empty($offers['succeeded']) && intval($offers['succeeded'][0]['inquiry_seller']['ID']) == get_current_user_id()) {
										array_push($clientInquiries,$inquiry);
									}
								}
							}

							$last = end($inquiries);
						?>
						<div id="user-<?php echo $key; ?>" class="col-md-4 user-item">
							<div class="col-md-12"><h3><?php echo get_user_by('id',$key)->nickname; ?></h3></div>
							<div class="col-md-12"><h4>Πωλήσεις <?php echo count($val); ?></h4></div>
							<div class="col-md-12"><h4>Τελευταία πώληση <br /><?php echo $last->inquiry_completion_date; ?></h4></div>
							<a class="btnAddUserBlacklist btn btn-default" href="#" data-user="<?php echo $key; ?>">Add to blacklist</a>
						</div>
						<?php
					}
				}
				else {
					echo 'Client list empty';
				}
			?>
		</div>
	</main><!-- #main -->
</section><!-- #primary -->
<script type="text/javascript">
jQuery(".btnAddUserBlacklist").live("click", function(e) {
	e.preventDefault();
	var user = jQuery(this).attr('data-user');
	jQuery.ajax({
		'type'	: 'post',
		'url'	:	ajaxurl,
		'data'	:	{
			action	:	'BlacklistUser',
			user	:	user,
		},
		success: function(response) {
			var result = JSON.parse(response);
			if (result.status == 0) {
				alert(result.message);
				window.location = '<?php echo get_bloginfo("url"); ?>/home-seller/?inquiries=active';
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
