<?php
/**
 * Template Name: Buyer Closed
 */
?>

<?php



	if (!is_user_logged_in()) {
		echo '<script type="text/javascript">window.location="'.get_site_url().'";</script>';
		exit();
	}



	$page = 1;
	$posts_per_page = 12;

	//var_dump($_GET['pageno']);
	if(isset($_GET['pageno']))
	{
		if( intval($_GET['pageno']))
		{
			$page =  intval($_GET['pageno']);
		}
	}

	$order = 0;

	if(isset($_GET['order'])  && intval($_GET['order'])==1)
	{
		//order 1 means Oldest First else 0 or not set means Newest posts first.

			$order =  intval($_GET['order']);

	}


	$filters = 1;
	//echo " - ". (intval($_GET['filters'])==0 || intval($_GET['filters'])==2);


	if(isset($_GET['filters'])  && ( intval($_GET['filters'])==0 || intval($_GET['filters'])==2))
	{
		//echo "> ".intval($_GET['filters']);
		//order 1 means Oldest First else 0 or not set means Newest posts first.
			$filters =  intval($_GET['filters']);

	}


	if(!isset($filters))
	{
		$filter_url="";
	}else {
		$filter_url = "&filters=".$filters;
	}

	if(!isset($order))
	{
		$order_url="";
	}else {
		$order_url = "&order=".$order;
	}

	$url_original = "?inquiries=inactive".$order_url.$filter_url;


	$closedInquiries_query = getClosedUserInquiries($page,$posts_per_page,$order,$filters);
	$requests = $closedInquiries_query->posts;;//['requests'];
/*
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
	}*/
?>
<?php get_header();

$closed_offers = 1;
?>
<?php include('includes/header.php'); ?>

<div id="dashboard_main" class="site-content top_index"> <?php // id="content" ?>
	<div class="container-fluid">
		<div class="row" id="dashboard_main_area">




<div class="col-xs-12 col-md-12 col-lg-2 content_padding" id="dashboard-menu">

	<div class="dashboard-menu-transform hidden-xs hidden-sm hidden-md">

		<?php include('includes/menu_list.php');?>

	  <?php // include 'includes/dashboard/menu_list.php' ;?>

	</div><!-- dashboard-menu-transform -->

</div> <!-- dashboard-menu-->



<div class="col-xs-12 col-md-12 col-lg-10 content_padding" id="dashboard-main-col">
	<!-- open applications -->
	<div class="main-area-transform">
		<div class="main-area-shape">

			<?php




					//pagination
			 if (!empty($requests)) {

					$paged =  $closedInquiries_query->query['paged'];

					//echo " - YOYO $mymessages_total->post_count $mymessages_total->found_posts - $posts_per_page";

						$max_num_pages = $closedInquiries_query->found_posts / $posts_per_page;

						$found_posts = $closedInquiries_query->found_posts;


						if($max_num_pages > 1)
						{
						include('includes/navigation/pagination.php');
						}
					//
	}

								$with_title = "Ολοκληρωμένες";
								$withοut_title = "Ανεπιτυχείς";
								$with_icon="done_outline";
								$without_icon="report_off";
								include('includes/navigation/inquiries_toolbar.php');





				 ?>



			<div class='open-applications-transform'>
			  <div class='open-applications-shape'>


					<?php if (!empty($requests)) {
						$states= array('0' => 'completed','1' => 'incomplete');
						$state = $states[1];
						$today = date('Y-m-d H:i:s');
						foreach($requests as $request) {


					?>

					<?php if (get_field('inquiry_status',$request->ID) == 'complete')
					{

								$state = $states[0];

					}?>


							<?php
								$categories = get_field('inquiry_product_category',$request->ID);
								$categoriesText = '';
								foreach ($categories as $category) {
									$categoriesText .= get_post($category)->post_title;
								}
								$totalOffersCount = 0;

								$offers = getAllOffers($request->ID);

								if (get_field('inquiry_status',$request->ID) == 'complete') {
									$totalOffersCount = (sizeof($offers['succeeded'])+sizeof($offers['failed']));
								}
								else {
									$totalOffersCount = (sizeof($offers['pending'])+sizeof($offers['interesting'])+sizeof($offers['best']));
								}

								$areas = get_field('inquiry_areas',$request->ID);


							include("includes/inquiryBox.php");
					}
				}
				else {
				//	echo 'None';
				}
			?>



				</div> <!-- end open-application-transform -->
			</div>

		</div><!--main-area-shape-->
	</div><!--main-area-transform-->
</div> <!--dashboard-main-col-->



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

<?php include("includes/map_box.php") ;?>
<script type="text/javascript">
	jQuery('#renewInquiry input[name="inquiry_end_date"]').datepicker({	minDate: '+7D' }).datepicker("option", "maxDate", '+32D').datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", "+5");
</script>
<?php // get_footer(); ?>
