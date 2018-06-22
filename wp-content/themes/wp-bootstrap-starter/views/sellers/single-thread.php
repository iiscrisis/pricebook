<div class="row align-items-center thread_<?php echo $messages['thread']->comment_ID; ?>" data-thread="<?php echo $messages['thread']->parent; ?>">
  <div class="col-2 buyer-info nopadding">
    <div class="col-12 nopadding text-center"><?php echo get_avatar($messages['thread']->user_id); ?></div>
    <div class="col-12 nopadding text-center"><a href="/userprofile?seller=<?php echo $messages['thread']->user_id; ?>"><?php echo get_field('seller_companyName','user_'.$messages['thread']->user_id); ?></a></div>
  </div>
  <div class="col-10">
    <?php echo $messages['thread']->comment_content; ?>
  </div>
</div>
