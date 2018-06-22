<div id="application_filters" class="white-bg col-xs-12 col-md-12 col-lg-2 text-center fullheigt hidden-xs hidden-sm hidden-md sellers_categories_wrapper">

  <div class="application_filters-transform">
    <div class="application_filters-shape">

      <div class='newapplication_headtitle bold black2 condensed'>
        <img src="images/icons/categories.svg"/> ΚΑΤΗΓΟΡΙΕΣ
      </div>
<?php for($i=0;$i<3;$i++){

  ?>

      <div class="seller-singlecategory-transform">
        <div class="seller-singlecategory-shape hasChild categoryroot">
          <span class="seller-category-name  black2">Ηλεκτρονικά <?php echo  $i;?></span>
          <div class="seller-category-plus-transform">
            <div class="seller-category-plus-shape bold circle white2 black2-bg">
              +
            </div>
          </div>

          <div class="category-children ">

            <div class="seller-singlecategory-shape hasChild ">
              <span class="seller-category-name  black2">Ηλεκτρονικά <?php echo  $i;?>1</span>
              <div class="seller-category-plus-transform">
                <div class="seller-category-plus-shape bold circle white2 black2-bg">
                  +
                </div>
              </div>

              <div class="category-children">

                <div class="seller-singlecategory-shape hasChild ">
                  <span class="seller-category-name  black2">Ηλεκτρονικά <?php echo  $i;?>11</span>
                  <div class="seller-category-plus-transform">
                    <div class="seller-category-plus-shape bold circle white2 black2-bg">
                      +
                    </div>
                  </div>

                  <div class="category-children">



                  </div>


                </div>

              </div>


            </div>

            <div class="seller-singlecategory-shape hasChild ">
              <span class="seller-category-name  black2">Ηλεκτρονικά <?php echo  $i;?>2</span>
              <div class="seller-category-plus-transform">
                <div class="seller-category-plus-shape bold circle white2 black2-bg">
                  +
                </div>
              </div>

              <div class="category-children">



              </div>


            </div>

          </div>


        </div>
      </div>


      <?php
    }
    ?>

    </div>
  </div>

</div>
