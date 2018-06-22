<div class="offer-seller-actions-transform">
  <div class="offer-seller-actions-shape">
    <div class="filter-category-title-shape   "><small>Δημιουργήθηκε από </small></div>
    <span class='offer_seller_avatar bold black3 condensed'>
      <div class="offer_seller_avatar_cnt circle">
        <?php echo getCustomAvatar($post->post_author,true); // echo    get_avatar($post->post_author); ?>
      </div>

      <?php echo get_userdata($post->post_author)->display_name;; ?>
      <?php //echo $post->post_author; ?>


    </span>


    <div class="option-cell-transform <?php echo $active;?> hidden">
      <div class="option-cell-shape white text-center btnAddUser" data-user="<?php echo $post->post_author; ?>">
        <a href="#"  class="">
          <div class="option-button-transform">
            <div class="option-button-shape">
              <i class="material-icons md-24 aqua">perm_contact_calendar</i>
            </div>
          </div>


          <div class='option-button-title  _semi-bold grey'>
            Πελάτης
          </div>
        </a>

      </div>
    </div> <!-- Single cell -->

    <div class="option-cell-transform <?php echo $active;?>">
      <div class="option-cell-shape white text-center btnAddUserBlacklist" data-user="<?php echo $post->post_author; ?>">
        <a href="#"  class="aqua">
          <div class="info_box  inline-block pointer" data-wenk="blah blah blah" data-wenk-pos="right">
           <i class="material-icons  md-18 red" >info</i>
         </div>
          <div class="option-button-transform">
            <div class="option-button-shape">
              <i class="material-icons  md-24 red">sentiment_very_dissatisfied</i>
            </div>
          </div>


          <div class='option-button-title _semi-bold grey'>
            Blacklist
          </div>
        </a>

      </div>
    </div> <!-- Single cell -->



        <div class="option-cell-transform">
          <div class="option-cell-shape white text-center action deleteInquiryConfirm" data-value="<?php echo $post->ID; ?>">
            <div class="info_box  inline-block pointer" data-wenk="blah blah blah" data-wenk-pos="right">
             <i class="material-icons  md-18 red" >info</i>
           </div>
            <div class="option-button-transform">
              <div class="option-button-shape">
                <i class="material-icons md-24 red">no_sim</i>
              </div>
            </div>

            <div class='option-button-title _condensed _semi-bold grey3'>
              Aπόριψη
            </div>

          </div>
        </div> <!-- Single cell -->
        <script type="text/javascript">

        jQuery(".option-cell-shape.deleteInquiryConfirm").on("click",function(){

          var result = confirm("Eίστε σίγουροι για την απόριψη;");
          if(result)
          {
            var inquiryId = jQuery(this).data("value");

            //alert(inquiryId);
            jQuery.post(
            ajaxurl,
            {
              'action':	'ignoreInquiry',
              'data':		{
                'inquiryId'		:	inquiryId
                //'inquiry_direct_seller'				:	inquiry_direct_seller,
              }
            },
            function (response) {
              var response = JSON.parse(response);

              if (response.status == 1) {
                		<?php echo 'window.location="'.get_site_url().'/home-sellers/?inquiries=active";';?>
              }
              else{

              }

            }
            );

          }else {

          }
        }
      );




      </script>



  </div>
</div>
