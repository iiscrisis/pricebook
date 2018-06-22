
<?php

  if(!isset($all_title))
  {
    $all_title = "Όλες";
  }

  if(!isset($with_title))
  {
    $with_title = "Με προσφορά";
  }

  if(!isset($withοut_title))
  {
    $withοut_title = "Δίχως προσφορά";
  }

  if(!isset($with_icon))
  {
    $with_icon = "speaker_notes";
  }

  if(!isset($without_icon))
  {
    $without_icon = "speaker_notes_off";
  }
 ?>

<div id="pages_toolbar" class="inline-block middle">

  <div class="order-transform inline-block middle">
    <div class="order-shape">

      <?php

      $older_first="";
      $new_first="checked";

      if($order == 1)
      {
        $older_first="checked";
        $new_first="";

      } ?>

      <a href="?inquiries=active&order=0<?php echo $filter_url;?>" class="<?php echo $new_first;?>">
        <div class="button inline-block middle">
          <i class="material-icons inline-block middle">
          arrow_drop_down
          </i>
          Νεότερα
        </div>

      </a>

    <a href="?inquiries=active&order=1<?php echo $filter_url;?>" class="<?php echo $older_first;?>">
      <div class="button inline-block middle">
        <i class="material-icons inline-block middle">
        arrow_drop_up
        </i>
        Παλαιότερα
      </div>

    </a>



    </div>
  </div> <!-- end order -->

  <div class="filter_offers-transform inline-block middle">
    <div class="filter_offers-shape">

      <?php

      $current_filter_all="checked";
      $current_filter_with="";
      $current_filter_without="";

      if($filters == 0)
      {
        $current_filter_all="";
        $current_filter_with="";
        $current_filter_without="checked";

      }else if($filters==2){
        // code...
        $current_filter_all="";
        $current_filter_with="checked";
        $current_filter_without="";
      } ?>

      <a href="?inquiries=active&filters=1<?php echo $order_url;?>" class="<?php echo $current_filter_all;?>">
        <div class="button inline-block middle">
          <i class="material-icons inline-block middle  md-18">
          web_asset
          </i>
          <?php echo $all_title;?>
        </div>

      </a>

      <a href="?inquiries=active&filters=2<?php echo $order_url;?>" class="<?php echo $current_filter_with;?>">
        <div class="button inline-block middle">
          <i class="material-icons inline-block middle md-18">
          <?php echo $with_icon;?>
          </i>
        <?php echo $with_title;?>
        </div>

      </a>

      <a href="?inquiries=active&filters=0<?php echo $order_url;?>" class="<?php echo $current_filter_without;?>">
        <div class="button inline-block middle">
          <i class="material-icons inline-block middle  md-18">
          <?php echo $without_icon;?>
          </i>
        <?php echo $withοut_title ;?>
        </div>

      </a>

    </div>
  </div>


</div>
