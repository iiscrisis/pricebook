<?php
/*
Plugin Name: Infinite Comment Replies
Plugin URI: https://www.webhostinghero.com/wp-plugins/infinite-comment-replies-plugin-for-wordpress/
Version: 1.0
Author: WebHostingHero.com
Author URI: https://www.webhostinghero.com
Author Email: info@webhostinghero.com
Description: Adds a "Reply" link even for comments at the maximum depth, so you can continue the conversation.
*/



	function add_a_reply_link($comment) {

				$comment_handle = get_comment(get_comment_id());

				$comment_link = get_comment_link($comment_handle);

				$comment_id = get_comment_id();

				$post_id = get_the_id();

				$author = get_comment_author();

				$reply_link ='<p><a class="comment-reply-link" href="'.get_page_link().'?replytocom='.$comment_id.'" lang=""
	
		onclick="return addComment.moveForm( this.lang, &quot;'.$comment_id.'&quot;, &quot;respond&quot;, &quot;'.$post_id.'&quot; )" 

		aria-label="Reply to '.$author.'">Reply</a></p>';

				return $comment . $reply_link;	
		}


		add_filter('get_comment_text', 'add_a_reply_link'); 

		function remove_reply_link() {

			return '';

		}

	add_filter('comment_reply_link', 'remove_reply_link');

	
	add_action('plugins_loaded','run_js');
	

	function run_js(){
                
        wp_enqueue_script('jquery-ui-core');
		
		wp_enqueue_style('script_name1',plugin_dir_url( __FILE__ ).'css/infinite.css');

		wp_enqueue_script('script_name2',plugin_dir_url( __FILE__ ).'js/reply-parent.js');

		if(is_admin()){
		
			wp_enqueue_script('script_name3',plugin_dir_url( __FILE__ ).'js/reply.js');

		}

	}


	

?>
