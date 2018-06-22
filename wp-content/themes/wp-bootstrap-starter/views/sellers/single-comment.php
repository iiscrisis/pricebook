<!--<div class="row align-items-center<?php echo ($i == ($length - 1) ? 'last_comment' : ''); ?> ">
  <div class="col-2 buyer-info nopadding">
    <div class="col-12 nopadding text-center"><?php echo get_avatar($message->user_id); ?></div>
    <div class="col-12 nopadding text-center">

      <a href="/userprofile/?seller=<?php echo $message->user_id; ?>"><?php echo get_field('seller_companyName','user_'.$message->user_id); ?>
      </a></div>
  </div>
  <div class="col-10">

  </div>
</div>
-->

<div class="single-chat-box-transform seller right comment_<?php echo $message->comment_ID; ?>" data-thread="<?php echo $message->comment_parent; ?>">
  <div class="single-chat-box-shape aqua-bg radius4">

    <div class="single-chat-box-avatar-transform">
      <div class="single-chat-box-avatar-shape circle white-bg">
        <!-- <img src="<?php echo get_template_directory_uri() ;?>/images/user/user.jpg">-->
        <?php echo get_avatar($message->user_id); ?>
      </div>
    </div>

    <div class="chat-box-details">
      <div class="chat-box-details-top-transform">
        <div class="chat-box-details-top-shape">
          <div class="chat-box-name white bold left">
            <a class="white" href="/userprofile/?seller=<?php echo $message->user_id; ?>"><?php echo get_field('seller_companyName','user_'.$message->user_id); ?>
            </a>
          </div>

          <div class="chat-box-date white right">
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
