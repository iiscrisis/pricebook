

<div class="single-chat-box-transform seller right thread_<?php echo $messages['thread']->comment_ID; ?>" data-thread="<?php echo $messages['thread']->parent; ?>">
  <div class="single-chat-box-shape aqua-bg radius4">

    <div class="single-chat-box-avatar-transform">
      <div class="single-chat-box-avatar-shape circle white-bg">
        <!-- <img src="<?php echo get_template_directory_uri() ;?>/images/user/user.jpg">-->
        <?php echo get_avatar($messages['thread']->user_id); ?>
      </div>
    </div>

    <div class="chat-box-details">
      <div class="chat-box-details-top-transform">
        <div class="chat-box-details-top-shape">
          <div class="chat-box-name white bold left">

            <?php
            if (is_buyer(intval( $messages['thread']->user_id)))
            {
              ?>
              <a href="<?php echo $messages['thread']->user_id; ?>"><?php echo get_field('seller_companyName','user_'.$messages['thread']->user_id); ?></a>
              <?php
            }else {
            echo get_userdata($messages['thread']->user_id)->display_name;
            }

              ?>

            </a>
          </div>

          <div class="chat-box-date white right">
               <?php echo date("d-m-Y G:i",strtotime($messages['thread']->comment_date)) ;?>
          </div>

          <div class='clearer'>

          </div>
        </div>
      </div>

      <div class="chat-box-message-transform">
        <div class="chat-box-message-shape white">
          <p>
            <?php echo $messages['thread']->comment_content; ?>
          </p>
        </div>
      </div>
    </div>



  </div>
</div> <!--single-chat-box-transform-->
<div class="clearer">

</div>
