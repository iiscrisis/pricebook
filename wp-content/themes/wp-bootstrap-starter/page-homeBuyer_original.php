<?php


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
				$requests = getOpenUserInquiries();
				break;
			case 'inactive':
				$requests = getClosedUserInquiries();
				break;
			default:
				$requests = getOpenUserInquiries();
				break;
		}
	}
	else {
		echo '<script type="text/javascript">window.location="'.get_site_url().'/home-buyers/?inquiries=active";</script>';
		exit;
	}
?>
<?php get_header();
?>
<?php include('modules/header.php'); ?>

<div id="dashboard_main" class="site-content"> <?php // id="content" ?>
	<div class="container-fluid">
		<div class="row" id="dashboard_main_area">




<div class="col-xs-12 col-md-12 col-lg-2 content_padding" id="dashboard-menu">

	<div class="dashboard-menu-transform hidden-xs hidden-sm hidden-md">

		<?php include('modules/dashboard/menu_list.php');?>

	  <?php // include 'includes/dashboard/menu_list.php' ;?>

	</div><!-- dashboard-menu-transform -->

</div> <!-- dashboard-menu-->




<div class="col-md-12">
	<h1><?php the_title(); ?></h1>
</div>

<aside id="secondary" class="widget-area col-sm-12 col-md-12 col-lg-2 hidden" role="complementary">
	<ul class="sidebar-inquiries">
		<li class="<?php if (in_array($choice,array('active','waiting_approval'))) { echo 'active'; } ?>"><a href="/home-buyers/?inquiries=active">ΑΝΟΙΚΤΑ ΑΙΤΗΜΑΤΑ</a></li>
		<li class="<?php if (in_array($choice,array('complete','inactive','approved_waiting_rank'))) { echo 'active'; } ?>"><a href="/home-buyers/?inquiries=inactive">ΚΛΕΙΣΤΑ ΑΙΤΗΜΑΤΑ</a></li>
		<li><a href="/usermessages">ΜΗΝΥΜΑΤΑ</a><span class="messagesCount"></span></li>
		<li><a href="/buyerssellerslist">ΠΡΟΜΗΘΕΥΤΕΣ</a></li>
		<li><a href="/userblacklist">BLACKLIST</a></li>
		<li><a href="/userstatistics">ΣΤΑΤΙΣΤΙΚΑ</a></li>
	</ul>
</aside>

<section id="primary" class="content-area col-md-12 col-lg-10">
	<main id="main" class="site-main" role="main">
		<div class="container-fluid">
			<?php
				if (!empty($requests)) {
					$today = date('Y-m-d H:i:s');
					foreach($requests as $request) { ?>
						<?php
							$categories = get_field('inquiry_product_category',$request->ID);
							$categoriesText = '';
							foreach ($categories as $category) {
								$categoriesText .= get_post($category)->post_title;
							}
							$totalOffersCount = 0;
							if (get_field('inquiry_status',$request->ID) == 'complete') {
								$totalOffersCount = (sizeof(getAllOffers($request->ID)['succeeded'])+sizeof(getAllOffers($request->ID)['failed']));
							}
							else {
								$totalOffersCount = (sizeof(getAllOffers($request->ID)['pending'])+sizeof(getAllOffers($request->ID)['interesting'])+sizeof(getAllOffers($request->ID)['best']));
							}
						?>
						<div data-id="<?php echo $request->ID; ?>" class="col-md-4 inquiry">
							<div id="request-<?php echo $request->ID; ?>" class="inquiryInner">

								<div class="inquiry-category col-12">
									<a href="<?php echo get_permalink($request->ID); ?>">
										<h3><?php echo $request->post_title; ?> - <?php echo $categoriesText; ?></h3>
									</a>
								</div>

								<div class="inquiry-category col-12">
									<?php $of = sizeof(getAllOffers($request->ID)['pending']); ?>
									<h3>Προσφορές <?php echo $totalOffersCount; ?></h3>
									<?php $best = getAllOffers($request->ID); ?>
									<?php if (get_field('inquiry_status',$request->ID) == 'active') { ?>
										<h5>Καλύτερη προσφορά <?php echo $best['best'][0]['inquiry_seller_actiondate']?> από <?php echo get_field('seller_companyName','user_'.$best['best'][0]['inquiry_seller']['ID']); ?></h5>
									<?php } ?>
										<?php if (get_field('inquiry_status',$request->ID) == 'complete') { ?>
											<h5>Καλύτερη προσφορά <?php echo $best['succeeded'][0]['inquiry_seller_actiondate']?> από <?php echo get_field('seller_companyName','user_'.$best['succeeded'][0]['inquiry_seller']['ID']); ?></h5>
										<?php } ?>
								</div>

								<div class="col-12">
									<div class="col-md-12">
										<strong>Σύνολο μηνυμάτων</strong><h4><?php echo sizeof(getCommentsForPost($request->ID)); ?></h4>
									</div>
									<div class="col-md-12">
										<strong>Απαντήσεις</strong><h3><?php echo sizeof(getSellersRepliesForInquiry($request->ID)); ?></h2>
									</div>
									<?php if (!in_array(get_field('inquiry_status',$request->ID),array('inactive','complete'))) { ?>
										<div class="col-md-12">
											<strong>Ανοικτό εώς:</strong> <?php echo get_field('inquiry_end_date',$request->ID); ?>
										</div>
									<?php } ?>
									<div class="col-md-12">
									<?php if (get_field('inquiry_status',$request->ID) == 'complete') { ?>
										<?php if (!is_null(get_field('inquiry_completion_date',$request->ID))) { ?>
											<h5>Ολοκληρώθηκε <?php echo get_field('inquiry_completion_date',$request->ID); ?></h5>
										<?php } ?>
									<?php } ?>
									</div>
									<div class="col-md-12">
										<?php
											$offerDates = array();
											$theOffers = get_field('inquiry_offers',$request->ID);

											if (!empty($theOffers)) { ?>
												<h5>Τελευταία προσφορά </h5>
												<?php
												foreach ($theOffers as $off) {
													$offerDates[] = $off['inquiry_seller_actiondate'];
												}
												$max = max(array_map('strtotime', $offerDates));
												echo date('Y-m-d H:i:s', $max); // 2012-06-11 08:30:49

												foreach ($theOffers as $off) {
													if (strtotime($off['inquiry_seller_actiondate']) == $max) {
														echo ' από '.get_field('seller_companyName','user_'.$off['inquiry_seller']['ID']);
														break;
													}
												}
											}
										?>
									</div>
								</div>

								<div class="col-10">
									<?php $latest = getLatestCommentsForInquiry($request->ID); ?>
									<?php if ($latest) { ?>
										<h4>ΤΕΛΕΥΤΑΙΑ ΜΗΝΥΜΑΤΑ</h4>
										<?php for ($i = 0; $i < sizeof($latest); $i++) { ?>
											<?php if ($i > 1) { break; } ?>
												<div class="col-md-12">
													<?php echo date('d/m/Y',strtotime($latest[$i]->post_date)); ?>
													<?php if (in_array('buyers',get_user_by('login',$latest[$i]->comment_author)->roles)) { ?>
														<h4><?php echo get_user_by('login',$latest[$i]->comment_author)->nickname ?></h4>
													<?php } else { ?>
														<h4><a href="/sellerprofile?seller=<?php echo get_user_by('login',$latest[$i]->comment_author)->ID; ?>"><?php echo get_field('seller_companyName','user_'.get_user_by('login',$latest[$i]->comment_author)->ID); ?></a></h4>
													<?php } ?>
												</div>
										<?php } ?>
									<?php } else { ?>
										<h4>ΔΕΝ ΥΠΑΡΧΟΥΝ ΜΗΝΥΜΑΤΑ</h4>
									<?php } ?>
								</div>

								<div class="buyer-actions col-md-12" data-target="<?php echo $request->ID; ?>">
									<?php if (get_field('inquiry_status',$request->ID) != 'complete') { ?><button class="action btn btn-info" data-action="update">Update</button><?php } ?>
									<?php if (get_field('inquiry_status',$request->ID) != 'complete') { ?><button class="action btn btn-danger" data-action="delete">Delete</button><?php } ?>
									<?php if (get_field('inquiry_status',$request->ID) == 'complete') { ?><button class="action btn btn-success" data-action="createsame" disabled>Δημιουργία νέας ίδιας αίτησης</button><?php } ?>
								</div>
							</div>
						</div>
						<?php
					}
				}
				else {
					echo 'None';
				}
			?>
		</div>
	</main><!-- #main -->
</section><!-- #primary -->
<div id="renewInquiry">
	<h3>Επιλέξτε νέα ημ/νια λήξης αιτήματος</h3>
	<div class="renewInquiry-inner">
		<form>
			<input type="hidden" name="inquiryId" value="" />
			<input type="text" class="form-control" name="inquiry_end_date" required />
			<input type="submit" class="btn btn-primary" value="Ανανέωση" />
		</form>
	</div>
</div>
<script type="text/javascript">
	jQuery('#renewInquiry input[name="inquiry_end_date"]').datepicker({	minDate: '+7D' }).datepicker("option", "maxDate", '+32D').datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", "+5");
</script>
<?php // get_footer(); ?>
