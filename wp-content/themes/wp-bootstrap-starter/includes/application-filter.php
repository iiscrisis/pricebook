<div id="application-navigation-container" class="hidden-lg white-bg">
  <div class="row">
    <div class="col-xs-6 col-sm-12">
      <div id="application-filter-trigger">
        <div class="application-filter-trigger-shape  black pointer">
          <div class=' bold black condensed '>

            <i class="material-icons md-24 middle inline-block blue open_f">keyboard_arrow_left</i>
            <i class="material-icons md-24 middle inline-block red close_f hidden">close</i>

            <div class="inline-block middle">
            Φίλτρα
            </div>

          </div>
        </div>
      </div>
    </div>


    <div class="col-xs-6 hidden-md hidden-sm">
      <div id="summary-filter-trigger">
        <div class="application-summary-trigger-shape white-bg black pointer">
          <div class=' bold black condensed text-right'>

            <div class="inline-block middle">
              Αποστολή
            </div>

            <i class="material-icons md-24 middle inline-block blue open_f ">keyboard_arrow_right</i>
            <i class="material-icons md-24 middle inline-block red close_f hidden">close</i>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="application_filters" class="white3-bg _col-xs-12 col-md-3 col-lg-3 text-center _fullheight _hidden-xs _hidden-sm _hidden-md">


  <?php
   $catFilters = getCategoryFiltersArray($catId);

   ?>




  <div class="application_filters-transform">

    <div class="application_filters-shape">

      <div class="close_preview right pointer  hidden-lg">
        <i class="material-icons black">close</i>
      </div>

      <div class='newapplication_headtitle bold black condensed'>

        	<img src="<?php echo get_template_directory_uri() ;?>/images/icons/filters.svg"/> Φίλτρα

      </div>

      <div class="clear_filters-transform ">
        <div class="clear_filters-shape pointer">
          <i class="material-icons red inline-block middle">clear_all</i> Απαλοιφή
        </div>
      </div>


<?php
function printFilters($children,$level,$parentName="")
{
  $tempLevel = $level;
  $random_id = rand();
  ?>
  <!-- <h1> <?php echo $level;?></h1>-->

  <?php
  //echo '<h3 style="margin-top:0">'.$category->name.'</h3>';
  $filter_index=0;
  foreach ($children as $child) {
    $filter_index++;
    $checkbox_id =  $random_id."_".$filter_index ;
    $mandatory = get_field('filter_mandatory','filters_'.$child->term_id);

    if ($mandatory) {
      $mandatory = 1;
    }else{
      $mandatory = 0;
    }


    $ef_fields = array();
    $fields = get_fields('filters_'.$child->term_id);
    if( $fields ): ?>

    		<?php foreach( $fields as $name => $value ): ?>
    		    <?php $ef_fields[$name]= $value;
          //  echo  $name.' '.$value;
            ?>

    		<?php endforeach; ?>

    <?php endif; ?>

<?php
    $child->isMandatory = $mandatory;
    $order = 0;
    if(isset( $ef_fields['filter_οrder']))
    {
        $order = $ef_fields['filter_οrder'];
    }

    $child->order = $order;

    $other = 0;

    if(isset( $ef_fields['filter_other']))
    {
        $other = $ef_fields['filter_other'];
    }

    $child->other=$other;
    //filter_other
  //  $order = get_field('filter_οrder','filters_'.$child->term_id);


    if ($order) {
      $order = $order;
    }else {
      $order = 0;
    }
    ?>
    <?php
    if($tempLevel==0)
    {
      ?>

    <div class=" filter-container" data-order="<?php echo $order;?>">
  <?php
    }
    ?>
    <?php

    $parent = "";
      if (!empty($child->children)) {

      $parent = "parent_filter";

  }
      ?>
    <div class='application-filter-category-transform <?php echo $parent;?>' data-mandatory="<?php echo $mandatory;?>" data-filterId="<?php echo $child->term_id;?>">



      <div class='application-filter-category-shape opened <?php echo $parent;?>'>
    <?php
    $mandatory = 0;
    if (!empty($child->children)) {
  ?>
      <div class="application-title black bold pointer">
        <?php
        for($i=0;$i<$level;$i++)
        {
          ?>

        <?php
        }
        ?>

        <div class="bold inline-block open_filters pointer  inline-block middle">
          <i class="material-icons  close_filter md-18 black inline-block middle">remove</i>
          <i class="material-icons  open_filter md-18 black inline-block middle">add</i>
        </div>
        <span><?php echo $child->name;?></span>
        <a href="#" class="clearFilter bold black" data-filterId="<?php echo $child->term_id;?>"></a>
      </div>


          <?php
          $nextLevel = $level+1;
          printFilters($child->children,$nextLevel,$child->name);


      }else {
              ?>
        <div class="single-application-filter-transform ">

                <div class="single-application-filter-shape black">

                  <?php
                  for($i=0;$i<$level;$i++)
                  {
                    ?>

                  <?php
                  }


                  ?>
                <?php  if($child->other)
                  {
                      //If other has been choseν display inputText and add it to filters SplStack
                  ?>
                  <div class="ckbx-style-8 ckbx-small inline-block middle ">
                          <input id="ckbx-style-8-<?php echo $checkbox_id;?>" value="<?php echo $child->name;?>" data-value="<?php echo $child->name;?>" name="inquiry_filters[]" type="checkbox" class="filter_other_check">

                          <label for="ckbx-style-8-<?php echo $checkbox_id;?>"></label>
                      </div>
                 <span class="_bold margin_left-10"><?php echo $child->name;?></span>
                  <input type="text" placeholder="..." class="filter_other" name="other_filter[]"/>
                <?php
              }else {
                ?>
                <div class="ckbx-style-8 ckbx-small inline-block middle ">
                        <input id="ckbx-style-8-<?php echo $checkbox_id;?>" value="<?php echo $child->name;?>" name="inquiry_filters[]" type="checkbox">

                        <label for="ckbx-style-8-<?php echo $checkbox_id;?>"></label>
                    </div>
               <span class="_bold margin_left-10"><?php echo $child->name;?></span>

              <?php
              }
              ?>
              </div>

              </div>
            <?php

        }
            ?>


      </div>
    </div>


<?php
if($tempLevel==0)
{
  ?>

</div>
<?php
}
      }



}

  $categoryFilters = array();
  if($catFilters)
  {
    foreach ($catFilters as $child) {

      $ef_fields = array();
      $fields = get_fields('filters_'.$child->term_id);
      if( $fields ): ?>

          <?php foreach( $fields as $name => $value ): ?>
              <?php $ef_fields[$name]= $value;
            //  echo  $name.' '.$value;
              ?>

          <?php endforeach; ?>

      <?php endif;

      $order = 0;
      if(isset( $ef_fields['filter_οrder']))
      {
          $order = $ef_fields['filter_οrder'];
      }



      $categoryFilters[$order][$child->name]=   $child;

    //  echo " - ".$child->order;

    }


?>



<?php
       ksort($categoryFilters);
        // foreach ($catFilters as $category) {
        $catFilters= array_reverse($categoryFilters);

        foreach ($catFilters as $key => $children) {


          printFilters($children,0);
        }
       ?>



      <?php // if ($category->parent == 0 && !empty($category->children)) {

        //  printFilters($category->children,0);

        //  printFilters($catFilters,0);
      }



      //    }
          ?>


      <?php
    //  }


                    ?>

  </div>

  </div>



</div>
