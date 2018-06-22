<?php
/**
 * Template Name: Home Seller Original
 */
get_header();
?>
<?php
	if (!is_user_logged_in()) {
		echo '<script type="text/javascript">window.location="'.get_site_url().'";</script>';
		exit();
	}
	/*
	else {
		if (isset($_SESSION)) {
			echo $_SESSION['userRole'];
		}
	}
	*/
?>
<?php
	//request by sidebar call
	$choice = '';
	if (isset($_GET['inquiries'])) {
		$choice = $_GET['inquiries'];
		switch ($choice) {
			case 'active':
				$requests = getOpenSellerInquiries();
				break;
			case 'inactive':
				$requests = getClosedSellerInquiries();
				break;
			default:
				$requests = getOpenSellerInquiries();
				break;
		}
	}
	else {
		echo '<script type="text/javascript">window.location="'.get_site_url().'/home-sellers/?inquiries=active";</script>';
		exit;
	}
?>
<div class="col-md-12">
	<h1><?php the_title(); ?></h1>
</div>
<aside id="secondary" class="widget-area col-sm-12 col-md-12 col-lg-2" role="complementary">
	<ul class="sidebar-inquiries">
		<li class="<?php if (in_array($choice,array('active','waiting_approval'))) { echo 'active'; } ?>"><a href="/home-sellers/?inquiries=active">ΑΝΟΙΚΤΑ ΑΙΤΗΜΑΤΑ</a></li>
		<li class="<?php if (in_array($choice,array('complete','inactive','approved_waiting_rank'))) { echo 'active'; } ?>"><a href="/home-sellers/?inquiries=inactive">ΚΛΕΙΣΤΑ ΑΙΤΗΜΑΤΑ</a></li>
		<li class="<?php echo ($choice == 'messages'		? 'active' : ''); ?>"><a href="/sellermessages">ΜΗΝΥΜΑΤΑ</a><span class="messagesCount"></span></li>
		<li class="<?php echo ($choice == 'sellersclientlist'	? 'active' : ''); ?>"><a href="/sellersclientlist">ΠΕΛΑΤΟΛΟΓΙΟ</a></li>
		<li class="<?php echo ($choice == 'blacklist'		? 'active' : ''); ?>"><a href="/sellerblacklist">BLACKLIST</a></li>
		<li class="<?php echo ($choice == 'statistics'	? 'active' : ''); ?>"><a href="/sellerstatistics">ΣΤΑΤΙΣΤΙΚΑ</a></li>
	</ul>
</aside>
<section id="primary" class="content-area col-md-12 col-lg-10">
	<main id="main" class="site-main" role="main">
		<div class="col-md-12 inquiry">
			<?php
				if (!empty($requests)) {
					foreach($requests as $request) { ?>
						<div id="request-<?php echo $request->ID; ?>" class="row inquiryInner" style="margin-bottom:10px;">
							<div class="inquiry-section col-md-12 nopadding">
								<div class="inquiry-section col-md-11">
									<div class="col-md-11 inquiry-section-title">
										<?php
											$categories = get_field('inquiry_product_category',$request->ID);
											$categoriesText = '';
											foreach ($categories as $category) {
												$categoriesText .= get_post($category)->post_title;
											}
										?>
										<a href="<?php echo get_permalink($request->ID); ?>"><h3>Αίτημα <?php echo date('d/m/Y H:m:s',strtotime($request->post_date)); ?> - <?php echo $categoriesText; ?></h3></a>
									</div>
									<div class="col-md-1">
										<?php
											$status = get_field('inquiry_status',$request->ID);
											if ($status == 'complete') {
												$offers = get_field('inquiry_offers',$request->ID);
												$myOffer = array_filter($offers, function($offer) {
													return (intval($offer['inquiry_seller']['ID']) == get_current_user_id());
												});
												if (!empty($myOffer)) {
													switch ($myOffer[0]['inquiry_status']) {
														case 'succeeded':
															$class = 'succeeded';
															break;
														case 'failed':
															$class = 'failed';
															break;
														case 'ignored':
															$class = 'ignored';
															break;
														default:
															$class = '';
															break;
													}
												}
											}
										?>
										<div class="inquiry-status-mark <?php echo $class; ?>-inquiry"></div>
									</div>
								</div>
							</div>
							<hr>
							<div class="inquiry-details">
								<div class="col-md-11">
									<?php if (!in_array(get_field('inquiry_status',$request->ID),array('inactive','complete'))) { ?>
										<div class="col-md-12">
											<div class="col-md-12">ΑΝΟΙΧΤΟ ΕΩΣ <?php echo get_field('inquiry_end_date',$request); ?></div>
										</div>
									<?php } ?>
									<div class="col-md-12">
										<div class="col-md-31 buyerAvatar"><?php echo get_avatar($request->post_author,32); ?></div>
										<div class="col-md-11"><h4><?php echo get_user_by('id',$request->post_author)->nickname; ?></h4></div>
									</div>
									<div class="col-md-12">
									<?php $latest = getLatestCommentsForInquiry($request->ID); ?>
									<div class="col-md-12">
										<?php
											$myChat = array();
											foreach ($latest as $message) {
												if ($message->user_id == get_current_user_id()) {
													array_push($myChat,$message);
												}
											}
										?>
										<?php if (!empty($myChat)) { ?>
											<div class="col-md-4">ΤΕΛΕΥΤΑΙΟ ΜΗΝΥΜΑ</div>
											<div class="col-md-8">
											<?php echo date('d/m/Y',strtotime(end($myChat)->post_date)); ?>
										<?php } ?>

										</div>
									</div>
									<div class="col-md-12">
										<?php if (get_field('inquiry_product_quantities',$request->ID) != 0) { ?>
											<div class="col-md-6">
												<div class="col-md-12">ΑΡ.ΜΟΝΑΔΩΝ</div>
												<div class="col-md-12"><?php echo get_field('inquiry_product_quantities',$request->ID); ?></div>
											</div>
										<?php } ?>
										<?php if (get_field('inquiry_max_price',$request->ID) != 0) { ?>
											<div class="col-md-6">
												<div class="col-md-12">ΜΕΓ.ΤΙΜΗ</div>
												<div class="col-md-12"><?php echo get_field('inquiry_max_price',$request->ID); ?></div>
											</div>
									<?php } else { ?>
										<div class="col-md-6">
											<div class="col-md-12 nopadding">ΧΩΡΙΣ ΜΕΓ.ΤΙΜΗ</div>
										</div>
									<?php } ?>
									</div>
									<div class="col-md-12">
									<?php if (get_field('inquiry_status',$request->ID) == 'complete') { ?>
										<?php if (!is_null(get_field('inquiry_completion_date',$request->ID))) { ?>
											<h5>Έναρξη αιτήματος <?php echo $request->post_date; ?></h5>
											<h5>Ολοκληρώθηκε <?php echo get_field('inquiry_completion_date',$request->ID); ?></h5>
										<?php } ?>
									<?php } ?>
									</div>
								</div>
								</div>
								<div class="col-md-1 inquiry-actions">

								</div>
							</div>
						</div>
						<?php
					}
				}
				else {
					echo 'No inquiries';
				}
				//wp_insert_comment(array('comment_post_ID'=>234,'comment_author'=> wp_get_current_user()->user_login,'comment_content'=>'Ti xrwma to thelete?'));
			?>
		</div>
	</main><!-- #main -->
</section><!-- #primary -->

<?php get_footer(); ?>
