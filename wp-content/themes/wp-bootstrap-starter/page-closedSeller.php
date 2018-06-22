<?php
/**
 * Template Name: Closed Seller
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

$url_original = "?inquiries=closed".$order_url.$filter_url;


/*
else {
if (isset($_SESSION)) {
echo $_SESSION['userRole'];
}
}
*/

//request by sidebar call
/*$choice = '';
if (isset($_GET['inquiries'])) {
	$choice = $_GET['inquiries'];
	switch ($choice) {
		case 'active':
		$requests =  getClosedSellerInquiriesFromList(get_current_user_id());//getOpenSellerInquiries();
		break;
		case 'inactive':
		$requests = getClosedSellerInquiriesFromList(get_current_user_id());
		break;
		default:
		$requests = getClosedSellerInquiriesFromList(get_current_user_id());
		break;
	}
}
else {
	echo '<script type="text/javascript">window.location="'.get_site_url().'/home-sellers/?inquiries=active";</script>';
	exit;
}*/


	$response = getClosedSellerInquiriesFromList(get_current_user_id(),$page,$posts_per_page,$order,$filters);
	$requests=	$response['requests'];
?>

<?php get_header();
?>
<?php include('includes/header.php');

//print_m(sizeof($requests));
/*var_dump($requests);
wp_die();*/

?>



<div id="dashboard_main" class="site-content top_index"> <?php // id="content" ?>
	<div class="container-fluid">
		<div class="row" id="dashboard_main_area">




			<div class="col-xs-12 col-md-12 col-lg-2 content_padding white2-bg" id="dashboard-menu">

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
				//	$posts_per_page = $openInquiries_query->query['posts_per_page'];
						$paged =  $page;//$openInquiries_query->query['paged'];

					//echo " - YOYO $mymessages_total->post_count $mymessages_total->found_posts - $posts_per_page";

						$found_posts = $response['total'];
					//	print_m($found_posts);
						$max_num_pages = $found_posts / $posts_per_page;




						if($max_num_pages > 1)
						{
							include('includes/navigation/pagination.php');
						}



														$with_title = "Ολοκληρωμένες";
														$withοut_title = "Ανεπιτυχείς";
														$with_icon="done_outline";
														$without_icon="report_off";
						include('includes/navigation/inquiries_toolbar.php');

					}






 			 	?>



						<div class='open-applications-transform'>
							<div class='open-applications-shape'>


								<?php if (!empty($requests)) {
									$states= array('0' => 'completed','1' => 'incomplete');
									$state = $states[1];
									$today = date('Y-m-d H:i:s');

									foreach($requests as $request) { ?>

										<?php if (get_field('inquiry_status',$request->ID) == 'complete')
										{

													$state = $states[0];

										}?>

										<?php
										$categories = get_field('inquiry_product_category',$request->ID);

										$categoriesText = '';

										if(!is_array($categories)){$categories =(array)$categories;}
										foreach ($categories as $category) {
											//	$categoriesText .= get_post($category)->post_title;
											//$categoriesText = createPagination($category);


											$current = get_post($category);
											//var_dump(get_object_vars($current));
											$categoriesText = createPagination($current,2);

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



										$areas = get_field('inquiry_areas',$request->ID);


									include("includes/inquiryBox.php");


									}
								}
								else {
									echo 'None';
								}
								?>



							</div> <!-- end open-application-transform -->
						</div>

					</div><!--main-area-shape-->
				</div><!--main-area-transform-->
			</div> <!--dashboard-main-col-->

			<?php include("includes/map_box.php") ;?>

			<script type="text/javascript">

			//ignoreInquiry
	jQuery(document).ready(function() {






		function HideConfirm(parent)
		{
			parent.find(".option-cell-transform-confirm").addClass("hidden");
			parent.find(".option-cell-transform-confirm").css("opacity",1);
		}

		function ShowConfirm(parent)
		{
			parent.find(".option-cell-transform-confirm").removeClass("hidden");
		}

		jQuery(".canceldeleteInquiry").on("click",function(){

			var parent = jQuery(this).closest(".options-wrapper");

			var anim = new TimelineMax({paused:true,onComplete:HideConfirm,onCompleteParams:[parent]});
			anim.to(parent.find(".option-cell-transform-confirm"),0.2,{opacity:0});
			anim.staggerTo(parent.find(".option-cell-transform"),0.5,{opacity:1},0.3,0.2);

			anim.play();

		}
	);

		jQuery(".option-cell-shape.deleteInquiryConfirm").on("click",function(){

			var parent = jQuery(this).closest(".options-wrapper");

			var anim = new TimelineMax({paused:true});

			anim.staggerTo(parent.find(".option-cell-transform"),0.5,{opacity:0},0.3);
			anim.from(parent.find(".option-cell-transform-confirm"),0.5,{opacity:0},0.8);

			anim.play();
			ShowConfirm(parent);
		}
		);

//ignore inquiry confirmed, now call the ajax script
		jQuery(".single-confirm-options.ignoreInquiry").on("click",function(){

			var inquiryId = jQuery(this).data("value");
			var requestParent = jQuery(this).closest(".request_root");
			//alert(inquiryId);
			jQuery.post(
			ajaxurl,
			{
				'action':	'ignoreInquiry',
				'data':		{
					'inquiryId'		:	inquiryId
					//'inquiry_direct_seller'				:	inquiry_direct_seller,
				}
			},
			function (response) {
				var response = JSON.parse(response);
				jQuery('html, body').animate({
					scrollTop: 0
				}, 500);
				if (response.status == 1) {
					console.log(" 0 "+response.message);
					jQuery('#message_area').find(".message_text").html(response.message);
					jQuery('#message_area').removeClass("hidden").fadeIn();
					jQuery('#message_area').addClass("active");
					requestParent.remove();
				}
				else {
					console.log(" else  "+response.message);
					jQuery('#message_area').find(".message_text").html(response.message);
					jQuery('#message_area').removeClass("hidden").fadeIn();
					jQuery('#message_area').addClass("active");
				}

			}
			);
			return false;
		});



	});


			</script>
