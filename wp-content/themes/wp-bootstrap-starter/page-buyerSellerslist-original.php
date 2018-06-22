<?php
/**
 * Template Name: Buyer Sellers List Orig
 */
get_header(); ?>
<?php
	$sellers = getUserSellersSummary();
	//update_field('user_sellerlist',null,'user_'.get_current_user_id());
?>
<div class="col-md-12">
	<h1><?php the_title(); ?></h1>
</div>

<aside id="secondary" class="widget-area col-sm-12 col-md-12 col-lg-2" role="complementary">
	<ul class="sidebar-inquiries">
		<li><a href="/home-buyers/?inquiries=active">ΑΝΟΙΚΤΑ ΑΙΤΗΜΑΤΑ</a></li>
		<li><a href="/home-buyers/?inquiries=inactive">ΚΛΕΙΣΤΑ ΑΙΤΗΜΑΤΑ</a></li>
		<li><a href="/usermessages">ΜΗΝΥΜΑΤΑ</a><span class="messagesCount"></span></li>
		<li class="active"><a href="/buyerssellerslist">ΠΡΟΜΗΘΕΥΤΕΣ</a></li>
		<li><a href="/userblacklist">BLACKLIST</a></li>
		<li><a href="/userstatistics">ΣΤΑΤΙΣΤΙΚΑ</a></li>
	</ul>
</aside>

<section id="primary" class="content-area col-md-12 col-lg-10">
	<main id="main" class="site-main" role="main">
		<div class="container-fluid">
			<?php
				if (!empty($sellers)) {
					foreach ($sellers as $seller=>$val) { ?>
						<?php $sellerObject = get_user_by('user_id',$seller); ?>
						<div id="seller-<?php echo $seller; ?>" class="col-md-4 seller-item">
							<div class="col-md-12"><h3><a href="/sellerprofile?seller=<?php echo $seller; ?>"><?php echo get_field('seller_companyName','user_'.$seller); ?></a></h3></div>
							<div class="col-md-12"><h4>Αγορές <?php echo $val[0]; ?></h4></div>
							<?php
								$clientInquiries = array();
								$inquiries = getClosedUserInquiries();
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
							<div class="col-md-12"><h4>Τελευταία αγορά <br /><?php echo $last->inquiry_completion_date; ?></h4></div>
							<button type="button" class="btn btn-default btn-sm btnRemoveFromSellers" data-seller="<?php echo $seller; ?>">
			          <span class="glyphicon glyphicon-user"></span>Remove from your list
			        </button>
							<button type="button" class="btn btn-default btn-sm btnAddSellerBlacklist" data-seller="<?php echo $seller; ?>">
			          <span class="glyphicon glyphicon-alert"></span>Add to blacklist
			        </button>
						</div>
						<?php
					}
				}
				else {
					echo 'Seller list empty';
				}
			?>
		</div>
	</main><!-- #main -->
</section><!-- #primary -->

<script type="text/javascript">
	jQuery(".btnAddSellerBlacklist").live("click", function(e) {
		e.preventDefault();
		var seller = jQuery(this).attr('data-seller');

		jQuery.ajax({
			'type'	: 'post',
			'url'		:	ajaxurl,
			'data'	:	{
				action	:	'BlacklistSeller',
				seller	:	seller,
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

	jQuery(".btnRemoveFromSellers").live("click", function(e) {
		e.preventDefault();
		var seller = jQuery(this).attr('data-seller');
		jQuery.ajax({
			'type'	: 'post',
			'url'	:	ajaxurl,
			'data'	:	{
				action	:	'removeFromMySellers',
				seller	:	seller,
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
