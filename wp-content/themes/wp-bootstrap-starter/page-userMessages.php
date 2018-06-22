<?php
/**
 * Template Name: User Messages
 */
get_header(); ?>

<?php
$page = 1;


//var_dump($_GET['pageno']);
if(isset($_GET['pageno']))
{
	if( intval($_GET['pageno']))
	{
		$page =  intval($_GET['pageno']);
	}
}

$filters = 0;
//echo " - ". (intval($_GET['filters'])==0 || intval($_GET['filters'])==2);


if(isset($_GET['filters'])  && ( intval($_GET['filters'])==1 || intval($_GET['filters'])==2))
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
	$order_url = "";
}

$url_original = "?msgs=1".$order_url.$filter_url;

	$mymessages_total = getMyMessages($page,$filters);
	//var_dump($mymessages_total);
	//$mymessages = array();
	//$post_count - The number of posts being displayed.
	//$found_posts -The total number of posts found matching the current query parameters
	//$max_num_pages
$posts_per_page = $mymessages_total->query['posts_per_page'];
$paged =  $mymessages_total->query['paged'];

//echo " - YOYO $mymessages_total->post_count $mymessages_total->found_posts - $posts_per_page";

	$max_num_pages = $mymessages_total->found_posts / $posts_per_page;
	$found_posts = $mymessages_total->found_posts;
	//echo $max_num_pages;

	$mymessages = $mymessages_total->get_posts();


?>

<?php include('includes/header.php'); ?>

<div id="dashboard_main" class="site-content"> <?php // id="content" ?>
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



						<div id='messages'>
						  <div class="messages-shape">

								<?php include('includes/navigation/pagination.php');


								?>

								<div id="pages_toolbar" class="inline-block middle">



								  <div class="filter_offers-transform inline-block middle">
								    <div class="filter_offers-shape">

								      <?php

								      $current_filter_all="checked";
								      $current_filter_with="";
								      $current_filter_without="";

								      if($filters == 2)
								      {
								        $current_filter_all="";
								        $current_filter_with="";
								        $current_filter_without="checked";

								      }else if($filters==1){
								        // code...
								        $current_filter_all="";
								        $current_filter_with="checked";
								        $current_filter_without="";
								      } ?>

								      <a href="?msg=1&filters=0" class="<?php echo $current_filter_all;?>">
								        <div class="button inline-block middle">
								          <i class="material-icons inline-block middle  md-18">
								          mail_outline
								          </i>
								          Όλα
								        </div>

								      </a>

								      <a href="?msg=1&filters=1" class="<?php echo $current_filter_with;?>">
								        <div class="button inline-block middle">
								          <i class="material-icons inline-block middle md-18">
								          markunread
								          </i>
													Αδιάβαστα

								        </div>

								      </a>

								      <a href="?inquiries=active&filters=2" class="<?php echo $current_filter_without;?>">
								        <div class="button inline-block middle">
								          <i class="material-icons inline-block middle  md-18">
								          drafts
								          </i>
								         	Διαβασμένα
								        </div>

								      </a>

								    </div>
								  </div>


								</div>





						    <div class="messages_main-transform">
						      <div class="messages_main-shape _white2-bg">
										<?php
										if (!empty($mymessages)) {
											foreach ($mymessages as $message) { ?>







						        <!-- Open message -->

						        <div class="single-message-transform" data-message="<?php echo $message->ID; ?>">
						          <div class="single-message-shape _white-bg radius6 shadow _open message-item <?php if (get_field('user_messages_isRead',$message->ID)) { echo 'read'; }  ?>">
						            <div class="col-xs-12 col-sm-11 col-md-11 col-lg-11 main_message pointer">






						              <div class="message-sender-transform horizontal-bar-cols text-center">
						                <div class="message-sender-shape  black" style="background-image:url(http://pricebook.gr/pricebook/wp-content/themes/wp-bootstrap-starter/images/theme0/logo.svg)">
															<?php   $user_info = get_userdata($message->post_author);
																		$user_nickname = $user_info->user_nicename;
																?>

						                </div>
						              </div>

						              <div class="message-date-transform horizontal-bar-cols">
						                <div class="message-date-shape bold">
						                    <?php echo $message->post_date; ?>
						                </div>
						              </div>

						              <div class="message-title-transform horizontal-bar-cols">
						                <div class="message-title-shape black3 bold">

						                  <?php
															$word_limit = 20;
																$words = explode(" ",strip_tags($message->post_content));
																echo  implode(" ",array_splice($words,0,$word_limit));?>

						                </div>
						              </div>

						            </div>

						            <div class="_col-xs-12 _col-sm-2  _col-md-1 _col-lg-1 text-right messages_button_transform">
						              <div class="messages-options_button-transform">
						                <div class="options_button-shape">




														<!-- 	<div class="menu-small-arrow-shape messages-action-button">
															 <i class="material-icons md-dark md-24">keyboard_arrow_down</i>
														 </div> -->



														 <div class="messages-action delete_msg text-center pointer white2-bg circle" >
															 <i class="material-icons red">delete_forever</i>

														 </div>



						                </div>
						              </div>
						            </div>
						            <div class='clearer'>

						            </div>


						            <div class="message-area-transform">
						              <div class="message-area-shape white-bg">
						                <div class="message-area-text">

						                    <?php echo  $message->post_content;?>
						                </div>
						              </div>

						            </div>
						          </div>


						        </div><!--single-message-transform-->
						        <?php

						        	}
										}
						        ?>

						      </div>
						    </div>

						  </div>
						</div>




					</div><!--main-area-shape-->
				</div><!--main-area-transform-->
			</div> <!--dashboard-main-col-->






<script type="text/javascript">



/*
	jQuery(".glyphicon-folder-open").live("click",function(e) {
		e.preventDefault();

		var id = jQuery(this).attr('data-message');

		jQuery.post(
			ajaxurl,
			{
				'action'		:	'markMessageUnread',
				'messageId'	:	id
			},
			function (response) {
				var response = JSON.parse(response);
				if (response.status == 0) {
					jQuery(".glyphicon-folder-open[data-message='"+id+"']").parents(".message-item:first").removeClass("read");
					jQuery(".glyphicon-folder-open[data-message='"+id+"']").removeClass("glyphicon-folder-open").addClass("glyphicon-folder-close");
				}
				else {
					alert(response.message);
				}
			});
	});*/

	/*jQuery(".glyphicon-folder-close").on("click",function(e) {
		e.preventDefault();
		alert(1);
		var id = jQuery(this).attr('data-message');

		jQuery.post(
			ajaxurl,
			{
				'action'		:	'markMessageRead',
				'messageId'	:	id
			},
			function (response) {
				var response = JSON.parse(response);
				if (response.status == 0) {
					jQuery(".glyphicon-folder-close[data-message='"+id+"']").parents(".message-item:first").addClass("read");
					jQuery(".glyphicon-folder-close[data-message='"+id+"']").removeClass("glyphicon-folder-close").addClass("glyphicon-folder-open");
				}
				else {
					alert(response.message);
				}
			});
	});*/


</script>
<?php get_footer(); ?>
