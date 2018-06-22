<?php
/**
* Template Name: Home Buyer
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


//var_dump($_GET['pageno']);
if(isset($_GET['num']))
{
	if( intval($_GET['num']))
	{
		$posts_per_page =  intval($_GET['num']);
	}
}



?>



<?php
//request by sidebar call
//echo "> ".$order;
/*$choice = '';
if (isset($_GET['inquiries'])) {
	$choice = $_GET['inquiries'];
	switch ($choice) {
		case 'active':
		$openInquiries_query = getOpenUserInquiries($page,$posts_per_page,$order,$filters);
		$requests = $openInquiries_query->posts;
		break;
		case 'inactive':
		$requests = getClosedUserInquiries();
		break;
		default:
		$requests = getOpenUserInquiries();
		break;
	}

	//var_dump($requests);
}
else {
	echo '<script type="text/javascript">window.location="'.get_site_url().'/home-buyers/?inquiries=active";</script>';
	exit;
}*/
$openInquiries_query = getOpenUserInquiries($page,$posts_per_page,$order,$filters);
$requests = $openInquiries_query->posts;


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

$url_original = "?inquiries=active".$order_url.$filter_url;
?>
<?php get_header();

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

			<?php function getRootCategory($category)
			{
				//get_post($category)->post_title
			}

			?>

			<div class="col-xs-12 col-md-12 col-lg-10 content_padding" id="dashboard-main-col">
				<!-- open applications -->
				<div class="main-area-transform">
					<div class="main-area-shape">
							<?php




						//pagination
				 if (!empty($requests)) {
						$posts_per_page = $openInquiries_query->query['posts_per_page'];
						$paged =  $openInquiries_query->query['paged'];

						//echo " - YOYO $mymessages_total->post_count $mymessages_total->found_posts - $posts_per_page";

							$max_num_pages = $openInquiries_query->found_posts / $posts_per_page;

							$found_posts = $openInquiries_query->found_posts;


							if($max_num_pages > 1)
							{
									include('includes/navigation/pagination.php');
							}






						}


						include('includes/navigation/inquiries_toolbar.php');
					 ?>


						<div class='open-applications-transform'>
							<div class='open-applications-shape'>


								<?php if (!empty($requests)) {
									$today = date('Y-m-d H:i:s');
									foreach($requests as $request) { ?>


										<?php
										$categories = get_field('inquiry_product_category',$request->ID);
											$areas = get_field('inquiry_areas',$request->ID);
										$categoriesText = '';
										if($categories)
										{
											foreach ($categories as $category) {
												//	$categoriesText .= get_post($category)->post_title;
												//$categoriesText = createPagination($category);


												$current = get_post($category);
												//var_dump(get_object_vars($current));
												$categoriesText = createPagination($current,2);

											}
										}




										$totalOffersCount = 0;
										$offers = getAllOffers($request->ID);
										//		var_dump($offers['best'][0]['inquiry_seller']);

										//echo "<h1> -".$offers['best']['ID']."</h1>";
										//	echo '<div>'..'</div>'
										if (get_field('inquiry_status',$request->ID) == 'complete') {

											$totalOffersCount = (sizeof($offers['succeeded'])+sizeof($offers['failed']));
										}
										else {
											$totalOffersCount = (sizeof($offers['pending'])+sizeof($offers['interesting'])+sizeof($offers['best']));
										}
										?>
										<?php
										$pendingClass="";

										if($totalOffersCount > 0)
										{
											$pendingClass="pending";
										}

										include("includes/inquiryBox.php");
									}
								}
								else {

								}
								?>



							</div> <!-- end open-application-transform -->
						</div>

					</div><!--main-area-shape-->
				</div><!--main-area-transform-->
			</div> <!--dashboard-main-col-->



			<div id="renewInquiry">

				<div class="renewInquiry-shape shadow radius4 white3-bg">

					<div class="close_renew">
						<div class="close-renew-image text-right pointer">
							<i class="material-icons md-24 md-dark">clear</i>
						</div>
					</div>
					<h3 class="black2">Επιλέξτε νέα ημ/νια λήξης αιτήματος</h3>
					<div class="renewInquiry-inner green">
						<form>
							<input type="hidden" name="inquiryId" value="" />
							<input type="text" class="form-control black2" name="inquiry_end_date" required />
							<input type="submit" class="btn btn-primary aqua-bg" value="Ανανέωση" />
						</form>
					</div>
				</div>

			</div>

<?php include("includes/map_box.php") ;?>

			<script type="text/javascript">
				jQuery('#renewInquiry input[name="inquiry_end_date"]').datepicker({	minDate: '+7D' }).datepicker("option", "maxDate", '+32D').datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", "+5");

			/*	jQuery(".order_posts_radio").labelauty({
				//	checked_label: "Νεότερο > Παλαιότερο",
				//	unchecked_label: "You don't want it"
			});*/

			</script>
			<?php // get_footer(); ?>
