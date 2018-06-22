<?php $t = 0; ?>
<ul class="nav nav-tabs">
	<?php foreach ($threadStarters as $key=>$val) { ?>
		<li <?php if ($t == 0) { echo "class='active'"; }?>>
			<a data-toggle="tab" href="#seller<?php echo $val; ?>"><?php echo get_field('seller_companyName',get_user_by('ID',$val)); ?></a>
		</li>
		<?php $t++; ?>
	<?php } ?>
</ul>
<?php $t = 0; $counter = 0; ?>
<div class="tab-content">
	<?php if (!empty($threadStarters)) { ?>

		<?php foreach ($threadStarters as $starter) { ?>

			<div id="seller<?php echo $starter; ?>" class="tab-pane fade <?php if ($t == 0) { echo 'in active'; }?>">
				<?php
					$conversation = getInquiryConversation($post->ID,$starter);

					$length = count($conversation['messages']);
					$counter = 0;
					?>
					<div class="row align-items-center thread_<?php echo $conversation['thread']->comment_ID; ?>" data-thread="<?php echo $conversation['thread']->parent; ?>">
					  <div class="col-2 buyer-info nopadding">
					    <div class="col-12 nopadding text-center"><?php echo get_avatar($conversation['thread']->user_id); ?></div>
					    <div class="col-12 nopadding text-center"><a href="/userprofile?seller=<?php echo $conversation['thread']->user_id; ?>"><?php echo get_field('seller_companyName','user_'.$conversation['thread']->user_id); ?></a></div>
					  </div>
					  <div class="col-10">
					    <?php echo $conversation['thread']->comment_content; ?>
					  </div>
					</div>

					<?php
					if (!empty($conversation['messages'])) {
					foreach ($conversation['messages'] as $message) {

						if (is_buyer(intval($message->user_id))) {
		          ?>
							<div class="row align-items-center<?php echo ($counter == ($length - 1) ? ' last_comment' : ''); ?> comment_<?php echo $message->comment_ID; ?>" data-thread="<?php echo $message->comment_parent; ?>">
								<div class="col-10">
									<?php echo $message->comment_content; ?>
								</div>
								<div class="col-2 buyer-info nopadding">
									<div class="col-12 nopadding text-center"><?php echo get_avatar($message->user_id); ?></div>
									<div class="col-12 nopadding text-center"><?php echo get_userdata($message->user_id)->display_name ?></div>
								</div>
							</div>
							<?php
		        }
		        else {
		          ?>
							<div class="row align-items-center<?php echo ($counter == ($length - 1) ? 'last_comment' : ''); ?> comment_<?php echo $message->comment_ID; ?>" data-thread="<?php echo $message->comment_parent; ?>">
							  <div class="col-2 buyer-info nopadding">
							    <div class="col-12 nopadding text-center"><?php echo get_avatar($message->user_id); ?></div>
							    <div class="col-12 nopadding text-center"><a href="/userprofile/?seller=<?php echo $message->user_id; ?>"><?php echo get_field('seller_companyName','user_'.$message->user_id); ?></a></div>
							  </div>
							  <div class="col-10">
							    <?php echo $message->comment_content; ?>
							  </div>
							</div>

							<?php
		        }

						if ($counter == ($length - 1) || $length == 0) { ?>
							<?php if (get_field('inquiry_status',$post->ID) != 'complete') { ?>
								<div class="comment-reply">
			            <h4>Reply</h4>
			            <form method="post">
			              <input name="post" type="hidden" value="<?php echo $post->ID; ?>" />
			              <input name="thread" type="hidden" value="<?php echo $conversation['thread']->comment_ID; ?>" />
			              <div class="form-group">
			                <textarea class="form-control" name="comment_message" rows="2" cols="50"></textarea>
			              </div>
			              <input class="btn btn-primary" type="submit" value="Submit" />
			            </form>
			          </div>
							<?php } ?>	
			      <?php } ?>
						<?php $counter++; ?>
					<?php } ?>
				<?php } else { ?>
					<?php if (get_field('inquiry_status',$post->ID) != 'complete') { ?>
						<div class="comment-reply">
							<h4>Reply</h4>
							<form method="post">
								<input name="post" type="hidden" value="<?php echo $post->ID; ?>" />
								<input name="thread" type="hidden" value="<?php echo $conversation['thread']->comment_ID; ?>" />
								<div class="form-group">
									<textarea class="form-control" name="comment_message" rows="2" cols="50"></textarea>
								</div>
								<input class="btn btn-primary" type="submit" value="Submit" />
							</form>
						</div>
					<?php } ?>
				<?php } ?>
	  	</div>
			<?php $t++; ?>
		<?php } ?>

	<?php } ?>
</div>
<?php $t = 0; ?>
<script type="text/javascript">
	jQuery(".comment-reply form").submit(function(e) {
		e.preventDefault();
			var trgt = jQuery(this);
      jQuery.ajax({
        type : "post",
        url : ajaxurl,
        data : { action: "postComment", thread : jQuery(trgt).find('input[name="thread"]').val(), text: jQuery(trgt).find('textarea[name="comment_message"]').val(), post : jQuery(trgt).find("input[name='post']").val(), seller : '<?php echo $starter; ?>' },
        success: function(response) {
					var result = JSON.parse(response);
          if (result.status == 0) {
            location.reload();
          }
          else {
            alert("Error adding comment");
          }
        }
      });
	});
</script>
