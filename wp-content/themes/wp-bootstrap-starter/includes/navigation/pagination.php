<?php

  if(!isset($url_original))
  {
    $url_original="?";
  }else {
    $url_original .="&";
  }


 ?>

<div id="pagination" class="inline-block middle">


  <div class="messages_counter-transform">
    <div class="messages_counter-shape">


      <div class="pages_pagination-transform inline-block middle">
          <div class="pages_pagination-shape">
        <?php
        $current_first_post = ($paged-1) * $posts_per_page +1;
        //$found_posts
        $current_final = $current_first_post + $posts_per_page-1;
        if($current_final > $found_posts)
        {
          $current_final = $found_posts;
        }


        if($current_first_post > 1)
        {
            $prevp = $paged-1;
          ?>

          <a href="<?php echo $url_original;?>pageno=<?php echo $prevp;?>"><i class="material-icons md-18 blue inline-block middle">keyboard_arrow_left</i></a>

          <?php
        }

        for($i = 1; $i<=ceil($max_num_pages);$i++)
        {
          $active_page ="";
        //	echo "$paged == $i";
        ?>

        <?php
          if($paged == $i)
          {
              $active_page ="current bold";
            ?>
              <div class="single_page-counter middle  inline-block blue bold <?php echo $active_page;?>" data-page="<?php echo $i;?>">
                  <?php echo $i;?>
              </div>


                  <?php

        }else {
          ?>
          <div class="single_page-counter  inline-block middle grey " data-page="<?php echo $i;?>">
              <a href="<?php echo $url_original;?>pageno=<?php echo $i;?>" ><?php echo $i;?></a>
          </div>

<?php

        }
      }




      if($current_final < $found_posts)
      {
          $nextp = $paged+1;
        ?>

          <a href="<?php echo $url_original;?>pageno=<?php echo $nextp;?>"><i class="material-icons blue md-18 inline-block middle">keyboard_arrow_right</i></a>

    <?php
      }
        ?>


        </div>
      </div>

      <div class="pages_from inline-block">
          <div class="pages-from-shape grey5">
             <?php echo $current_first_post;?> έως  <?php echo $current_final;?> από <?php echo $found_posts;?>
          </div>
      </div>

    </div>
  </div>

  <div class="clearer">

  </div>
</div>
