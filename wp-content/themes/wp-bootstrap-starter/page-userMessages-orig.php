<?php
/**
 * Template Name: User Messages
 */
get_header(); ?>
<?php
	$mymessages = getMyMessages();
?>
<div class="col-md-12">
	<h1><?php the_title(); ?></h1>
</div>
<aside id="secondary" class="widget-area col-sm-12 col-md-12 col-lg-2" role="complementary">
	<ul class="sidebar-inquiries">
		<li><a href="/home-buyers/?inquiries=active">ΑΝΟΙΚΤΑ ΑΙΤΗΜΑΤΑ</a></li>
		<li><a href="/home-buyers/?inquiries=inactive">ΚΛΕΙΣΤΑ ΑΙΤΗΜΑΤΑ</a></li>
		<li class="active"><a href="/usermessages">ΜΗΝΥΜΑΤΑ</a><span class="messagesCount"></span></li>
		<li><a href="/buyerssellerslist">ΠΡΟΜΗΘΕΥΤΕΣ</a></li>
		<li ><a href="/userblacklist">BLACKLIST</a></li>
		<li><a href="/userstatistics">ΣΤΑΤΙΣΤΙΚΑ</a></li>
	</ul>
</aside>
<section id="primary" class="content-area col-md-12 col-lg-10">
	<main id="main" class="site-main" role="main">
		<div class="container-fluid">
			<?php
				if (!empty($mymessages)) {
					foreach ($mymessages as $message) { ?>
						<div class="col-md-12 message-item <?php if (get_field('user_messages_isRead',$message->ID)) { echo 'read'; }  ?>">
							<div class="row">
								<div class="col-2"><?php echo get_user_by('ID',$message->post_author)->nickname; ?></div>
								<div class="col-7"><?php echo $message->post_content; ?></div>
								<div class="col-2"><?php echo $message->post_date; ?></div>
								<div class="col-1">
									<?php if (get_field('user_messages_isRead',$message->ID) == "1") { ?>
										<span class="glyphicon glyphicon-folder-open" data-message="<?php echo $message->ID; ?>"></span>
									<?php } else { ?>
										<span class="glyphicon glyphicon-folder-close" data-message="<?php echo $message->ID; ?>"></span>
									<?php } ?>
									<span class="glyphicon glyphicon-trash" data-message="<?php echo $message->ID; ?>"></span>
								</div>
							</div>
						</div>
						<?php
					}
				}
				else {
					echo 'No messages';
				}
			?>
		</div>
	</main><!-- #main -->
</section><!-- #primary -->
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

	jQuery(".glyphicon-folder-close").live("click",function(e) {
		e.preventDefault();

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
	});

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
