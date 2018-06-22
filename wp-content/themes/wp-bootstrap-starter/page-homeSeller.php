<?php
/**
* Template Name: Home Seller
*/

?>

<?php
if (!is_user_logged_in()) {
	echo '<script type="text/javascript">window.location="'.get_site_url().'";</script>';
	exit();
}


//reset_post_field('user_successful_inquiries',"user_208");


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

$url_original = "?inquiries=active".$order_url.$filter_url;

//reset_post_field('sellers_successful_offers',"user_".get_current_user_id());

//reset_post_field('user_successful_inquiries',"user_207");

//request by sidebar call
/*if (isset($_GET['inquiries'])) {
	$choice = $_GET['inquiries'];
	switch ($choice) {
		case 'active':
	//getOpenSellerInquiries();
		break;
		case 'inactive':
		$response = getOpenSellerInquiriesFromList(get_current_user_id(),$page,$posts_per_page,$order,$filters);;
		break;
		default:
		$response = getOpenSellerInquiriesFromList(get_current_user_id(),$page,$posts_per_page,$order,$filters);
		break;
	}
}
else {
	echo '<script type="text/javascript">window.location="'.get_site_url().'/home-sellers/?inquiries=active";</script>';
	exit;
}*/

$response =  getOpenSellerInquiriesFromList(get_current_user_id(),$page,$posts_per_page,$order,$filters);

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





					}


					include('includes/navigation/inquiries_toolbar.php');



 			 	?>

						<div class='open-applications-transform'>
							<div class='open-applications-shape'>


								<?php if (!empty($requests)) {
									$today = date('Y-m-d H:i:s');
									foreach($requests as $request) {

										$cats = get_field('inquiry_product_category',$request->ID);
											$cats =  get_field('inquiry_product_category',$request->ID);
											$parentId = getParentId(get_post($cats[0]));
											$isService = false;
											$isProduct = false;
											$isHotel = false;
											//echo SERVICE;
											//echo "CAT $parentId > ".$catId[0] ;

											switch($parentId)
											{
											  case PRODUCT:
											  $isProduct =true;
											  //echo "PRODUCT";
											  break;

											  case HOTEL:
											  $isHotel =true;
											  //echo "HOTEL";
											  break;

											  case SERVICE :
											  $isService = true;
											  //echo "SERVICE";
											  break;

											  default:
											 // echo "Error";
											  //wp_die();
												continue;
											}



								$categories = get_field('inquiry_product_category',$request->ID);
								$areas = get_field('inquiry_areas',$request->ID);
								$pendingClass="";
								$theoffer = getOffer($request->ID,get_current_user_id());
								$totalsellersCost = 0;



								if(!empty($theoffer['pending']))
								{
									$pendingClass="pending";
									if($isService)
									{
										$sellers_quantity = 1;
									}else {
											$sellers_quantity = $theoffer['pending'][0]['inquiry_seller_quantity'] !=NULL ? $theoffer['pending'][0]['inquiry_seller_quantity']:0;
									}
									if(is_seller())
									{
											$sellers_unit_cost = $theoffer['pending'][0]['inquiry_seller_unit_cost'] !=NULL ? $theoffer['pending'][0]['inquiry_seller_unit_cost']:0;
											$sellers_delivery_cost = $theoffer['pending'][0]['inquiry_seller_delivery_cost'] !=NULL ? $theoffer['pending'][0]['inquiry_seller_delivery_cost']:0;
											$sellers_cashondelivery_cost = $theoffer['pending'][0]['inquiry_seller_cashondelivery_cost'] !=NULL ? $theoffer['pending'][0]['inquiry_seller_cashondelivery_cost']:0;
											$totalsellersCost =($sellers_unit_cost * $sellers_quantity )  +$sellers_delivery_cost + $sellers_cashondelivery_cost;
									}


								 	// var_dump($theoffer['pending'][0]);
								}
							include("includes/inquiryBox.php");
							}
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
				anim.to(parent.find(".option-cell-transform-confirm"),0.5,{opacity:1},0.8);

				anim.play();
				ShowConfirm(parent);
			}
			);

			//ignore inquiry confirmed, now call the ajax script
			jQuery(".single-confirm-options.ignoreInquiry").on("click",function(){
		//		alert("ignoring");
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
