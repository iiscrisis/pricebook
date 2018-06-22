
<?php
$seller_data_pool= str_replace("<p>","",$seller_data_pool);
$seller_data_pool = str_replace("</p>","",$seller_data_pool);
$single_pool = explode("@@",$seller_data_pool);
//var_dump($single_pool);
$row_count = 0;
//		echo $seller_data_education;
 ?>
<div id="<?php echo $tmpl_id;?>" class="hidden">
  <div class="row single_table-row">


    <div class="single-table-counter-transform">
      <div class="single-table-counter-shape circle blue-bg white bold">

      </div>
    </div>


    <div class="single-table-remove-transform">
      <div class="single-table-remove-shape pointer circle red-bg white bold">
          <i class="material-icons white  md-18">delete_forever</i>
      </div>
    </div>


    <?php
    foreach($fields_array as $sfield)
    {
      ?>

      <div class="table-col <?php echo  $row_cols;?>">
        <div class="t_header bold">
          <?php echo $sfield['field_title'];?>
        </div>
        <input type="text" class="<?php echo $sfield['input_class'];?>" value="" placeholder="<?php echo $sfield['placeholder'];?>" />
      </div>
    <?php
    }
    ?>


  </div>
</div>

<div class="container services_info_container  login-form ">

  <div class="row">


    <div class="col-xs-12">

      <div class="services_details_box-transform">
        <div class="services_details_box-shape text-left white-bg shadow">
          <div class="services_details_box_title-shape blue-bg white bold">
              <?php echo $cat_title;?>
          </div>

          <div class="services_details_box_button-shape grey-bg inline-block">
            <div class="<?php echo $button_prefix;?>-button-transform ">
              <div class="<?php echo $button_prefix;?>-shape pointer white bold services_button">
                <i class="material-icons middle blue">add_circle_outline</i> Προσθέστε εγγραφή
              </div>



            </div>
          </div>

          <div class="clearer">

          </div>

          <div class="services_data_list-transform">
            <div class="services_data_list-shape">

              <div class="table-transform">
                <form id="<?php echo $form_id;?>" method="post">
                <div class="table-shape" id="<?php echo $rows_id;?>">



                  <?php




                    foreach($single_pool as $single_row)
                    {

                      //var_dump($single_pool);
                      	$counter = 0;
                      if($single_row=="")
                      {
                        continue;
                      }
                        //var_dump($single_pool);
                      ?>
                      <div class="row single_table-row" id="edu<?php echo $row_count++;?>">
                        <div class="single-table-counter-transform">
                          <div class="single-table-counter-shape circle blue-bg white bold">
                              <?php echo $row_count;?>
                          </div>
                        </div>

                        <div class="single-table-remove-transform">
                          <div class="single-table-remove-shape pointer circle red-bg white bold">
                              <i class="material-icons white  md-18">delete_forever</i>
                          </div>
                        </div>
                        <?php
                        $single_row = str_replace("##","",$single_row);
                        $single_row = str_replace("@@","",$single_row);

                        $fields = explode("@#",$single_row);
                        foreach($fields as $field)
                        {
                          //	echo $counter." - ".$field;

                          ?>
                          <div class="table-col <?php echo  $row_cols;?> ">
                            <div class="t_header bold">


                              <?php echo $fields_array[$counter]['field_title'];?>
                            </div>
                            <input type="text" name="reg_<?php echo $fields_array[$counter]['input_class'];?>_<?php echo $row_count;?>" class="<?php echo $fields_array[$counter]['input_class'];?>" value="<?php echo $field;?>" placeholder="<?php echo $fields_array[$counter]['placeholder'];?>" />
                          </div>
                          <?php
                          $counter++;
                        }
                        ?>
                      </div>
                      <?php
                    }


                    ?>

                    <div class="row single_table-row" id="<?php echo $id_prefix;?><?php echo $row_count++;?>">

                      <div class="single-table-counter-transform">
                        <div class="single-table-counter-shape circle blue-bg white bold">
                            <?php echo $row_count;?>
                        </div>
                      </div>

                      <div class="single-table-remove-transform">
                        <div class="single-table-remove-shape pointer circle red-bg white bold">
                            <i class="material-icons white md-18">delete_forever</i>
                        </div>
                      </div>


                          <?php
                          foreach($fields_array as $sfield)
                          {
                            ?>

                            <div class="table-col <?php echo  $row_cols;?>">
                              <div class="t_header bold">
                                <?php echo $sfield['field_title'];?>
                              </div>
                              <input type="text" name="<?php echo $rows_id?>_reg_<?php echo $fields_array[$counter]['input_class'];?>_<?php echo $row_count;?>" class="<?php echo $sfield['input_class'];?>" value="" placeholder="<?php echo $sfield['placeholder'];?>" />
                            </div>
                          <?php
                          }
                          ?>
                    </div>



                  </div>
                  <input type="submit" value="Aποθήκευση" class=" btn btn-success btn-send blue-bg" />
                </form>
              </div>

            </div>
          </div>

        </div>
      </div>

    </div>

  </div>

</div>
