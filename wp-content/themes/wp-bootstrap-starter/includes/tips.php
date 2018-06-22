<?php
  if(isset($all_tips) &&  is_array($all_tips))
  {
    $counter = 0;
    foreach($all_tips as $tip)
    {
      $counter++;
    //  var_dump($tip);
      $stip = get_post($tip);
?>



<div class="summarytips-transform">

  <div class="single-tip-box-transform text-left  left">

    <div class="single-tip-box-shape shadow_3 white4-bg radius4">

      <div class="single-tip-box-avatar-transform">

        <div class="single-tip-box-avatar-shape circle grey-bg">

          <img src="<?php echo get_template_directory_uri() ;?>/images/logo-single.svg">

        </div>

      </div>



      <div class="tip-box-details">

        <div class="chat-box-details-top-transform">

          <div class="chat-box-details-top-shape">

            <div class="chat-box-name black bold left">

              <?php // echo $stip->post_title; ?>
              Pricebook Tip
            </div>



            <div class="chat-box-date blue bold right">

              #<?php echo $counter;?>

            </div>



            <div class="clearer">



            </div>

          </div>

        </div>



        <div class="chat-box-message-transform">

          <div class="chat-box-message-shape black2">

          <?php echo $stip->post_content;?>
          </div>

        </div>

      </div>
    </div>

  </div>

</div>

<?php

    }
  }

 ?>
