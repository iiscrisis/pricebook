

<div class="single-chat-box-transform shadow_2 <?php echo $classSeller;?> comment_<?php echo $message->comment_ID; ?>" data-thread="<?php echo $message->comment_parent; ?>">
  <div class="single-chat-box-shape grey-bg radius4">

    <div class="single-chat-box-avatar-transform">
      <div class="single-chat-box-avatar-shape circle white-bg">
        <img class="hidden" src="<?php echo get_template_directory_uri() ;?>/images/user/user.jpg">

          <?php
          echo getCustomAvatar($message->user_id,true);
        //  get_avatar($message->user_id); ?>
      </div>
    </div>

    <div class="chat-box-details">
      <div class="chat-box-details-top-transform">
        <div class="chat-box-details-top-shape">
          <div class="chat-box-name white2 bold left">
          <?php echo get_userdata($message->user_id)->display_name; ?>
          </div>

          <div class="chat-box-date white4 right">

             <?php echo date("d-m-Y G:i",strtotime($message->comment_date)) ;?>

          </div>

          <div class='clearer'>

          </div>
        </div>
      </div>

      <div class="chat-box-message-transform">
        <div class="chat-box-message-shape white">
          <p>
            <?php echo $message->comment_content; ?>
          </p>
        </div>
      </div>
    </div>



  </div>
</div> <!--single-chat-box-transform-->
<div class="clearer">

</div>
