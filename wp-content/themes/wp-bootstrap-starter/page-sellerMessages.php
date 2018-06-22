<?php
/**
 * Template Name: User Messages
 */
get_header(); ?>

<?php
	$mymessages = getMyMessages();
?>

<?php include('includes/header.php'); ?>

<div id="dashboard_main" class="site-content"> <?php // id="content" ?>
	<div class="container-fluid">
		<div class="row" id="dashboard_main_area">


			<div class="col-xs-12 col-md-12 col-lg-2 content_padding" id="dashboard-menu">

				<div class="dashboard-menu-transform hidden-xs hidden-sm hidden-md">
<?php include('includes/seller/menu_list.php');?>

					<?php // include 'includes/dashboard/menu_list.php' ;?>

				</div><!-- dashboard-menu-transform -->

			</div> <!-- dashboard-menu-->


			<div class="col-xs-12 col-md-12 col-lg-10 content_padding" id="dashboard-main-col">
				<!-- open applications -->
				<div class="main-area-transform">
					<div class="main-area-shape">



						<div id='messages'>
						  <div class="messages-shape">

						    <div class="messages_counter-transform">
						      <div class="messages_countr-shape">

						      </div>
						    </div>


						    <div class="messages_main-transform">
						      <div class="messages_main-shape _white2-bg">
										<?php
										if (!empty($mymessages)) {
											foreach ($mymessages as $message) {?>


						        <!-- Open message -->

						        <div class="single-message-transform">
						          <div class="single-message-shape white-bg radius2 shadow _open message-item <?php if (get_field('user_messages_isRead',$message->ID)) { echo 'read'; }  ?>">
						            <div class="col-xs-12 col-sm-11 col-md-11 col-lg-11">


						              <div class="message-avatar-transform horizontal-bar-cols">
						                <div class="message-avatar-shape">
						                 <!-- <img src="images/avatars/pb.svg" />-->
															<?php if (get_field('user_messages_isRead',$message->ID) == "1") { ?>
																<span class="glyphicon glyphicon-folder-open" data-message="<?php echo $message->ID; ?>"></span>
															<?php } else { ?>
																<span class="glyphicon glyphicon-folder-close" data-message="<?php echo $message->ID; ?>"></span>
															<?php } ?>
															<span class="glyphicon glyphicon-trash" data-message="<?php echo $message->ID; ?>"></span>
						                </div>
						              </div>

						              <div class="message-sender-transform horizontal-bar-cols">
						                <div class="message-sender-shape bold black">
						                  <?php echo get_user_by('ID',$message->post_author)->nickname; ?>
						                </div>
						              </div>

						              <div class="message-date-transform horizontal-bar-cols">
						                <div class="message-date-shape bold">
						                    <?php echo $message->post_date; ?>
						                </div>
						              </div>

						              <div class="message-title-transform horizontal-bar-cols">
						                <div class="message-title-shape black3">

						                  <?php
															$word_limit = 10;
																$words = explode(" ",strip_tags($message->post_content));
																echo  implode(" ",array_splice($words,0,$word_limit));?>

						                </div>
						              </div>

						            </div>

						            <div class="_col-xs-12 _col-sm-2  _col-md-1 _col-lg-1 text-right messages_button_transform">
						              <div class="messages-options_button-transform">
						                <div class="options_button-shape">


						                    <div class="options-dots-transform ">
						                      <div class="options-dots-shape circle _white2-bg">

						                        <div class="menu-small-arrow-shape messages-action-button">
						                          <div class="arrow-down blue">

						                          </div>
						                        </div>


						                        <div class="options-dot-transform hidden">
						                          <div class="options-dot-shape circle white-bg"></div>
						                        </div>

						                        <div class="options-dot-transform hidden">
						                          <div class="options-dot-shape circle white-bg"></div>
						                        </div>

						                        <div class="options-dot-transform hidden">
						                          <div class="options-dot-shape circle white-bg"></div>
						                        </div>

						                      </div>
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
	});

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

	jQuery(".glyphicon-trash").click(function(e) {
		e.preventDefault();

		var id = jQuery(this).attr('data-message');

		jQuery.post(
			ajaxurl,
			{
				'action'		:	'deleteMessage',
				'messageId'	:	id
			},
			function (response) {
				var response = JSON.parse(response);
				if (response.status == 0) {
					jQuery(".glyphicon-trash[data-message='"+id+"']").parents(".message-item:first").remove();
				}
				else {
					alert(response.message);
				}
			});
	});
</script>
<?php get_footer(); ?>
