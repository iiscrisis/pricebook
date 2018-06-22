
<?php
$logged = 0;
 if (!is_user_logged_in()) {
?>

<?php
}else{
$logged = 1;
?>
  <div class="inline-block middle hidden-xs" id="user_drop_down">

    <div class="avatar-transform">
      <div class="avatar-shape white">

        <div class="avatar-image-transform">
          <div class="avatar-image-shape" style="background-image: url(<?php echo getCustomAvatar(get_current_user_id());?>)">

          </div>
        </div><!--avatar-image-transform-->

        <div class="avatar-details-transform">
          <div class="avatar-details-shape">

          <?php
                    if (is_seller()) {
                      ?>
                      <a class="condensed black2 _white bold" href="<?php echo esc_url( home_url( '/' )); ?>home-seller/"><?php echo get_field("seller_companyName",'user_'.get_current_user_id()) ;?></a>
                      <?php
                    }else if (is_buyer()) {
                      ?>
                      <a class="condensed black2 _white bold" href="<?php echo esc_url( home_url( '/' )); ?>/home-buyer/"><?php
                       $user_info = get_userdata( get_current_user_id() );
                      $user_info->user_email = substr($user_info->user_email, 0, -3);
                      echo $user_info->user_email;?></a>
                      <?php
                    }
                    ?>

                <div class="arrow-down-avatar-transform inline-block middle pointer">
                  <div class="arrow-down-avatar-shape">
                    <i class="material-icons md-18 black">keyboard_arrow_down</i>
                  </div>
                </div>

                <!--<a href="?p=9&s=<?php echo $_seller;?>" class="condensed black2 _white bold">YANO</a>-->
              </div>
            </div><!--avatar-image-transform-->

          </div>
        </div>

        <div class="clearer">

        </div>

        <div class="menutop-left-transform text-right">
          <div class="menutop-left-shape semi-bold white-bg shadow">



            <?php
            $strclient="";
            if (is_seller()) {
                  $menu = 'logged-in-seller';
              $strclient =  'Επαγγελματίας';
            }
            if (is_buyer()) {
                $menu = 'logged-in-buyer';
              $strclient =  'Αγοραστής';
            }
            ?>
            <?php
            if (is_user_logged_in()) {
                $currentUser = wp_get_current_user();

                $roles = $currentUser->roles;

                if (in_array('sellers',$roles)) {

            ?>
            <div class="menu-link ">
                  <a href="#" class="blue switch_role"><span class="grey  light">Συνδεδεμένος ως </span><?php echo $strclient;?>, αλλαγή;</a>
            </div>

            <?php
                }
              }?>


            <a class="red" href="<?php echo get_site_url(); ?>/logout/">
              <div class="menu-logout btn btn-danger">
                Aποσύνδεση
                </div>
                </a>
          </div>
        </div>




  </div>


  <?php
}
?>

<script type="text/javascript">



jQuery(".switch_role").on("click",function(e) {
  e.preventDefault();
  //alert(1);

  var data ='action=switch_role';

  jQuery.ajax({
    url : ajaxurl,
    type : 'post',
    data : data,
    success : function( response ) {
      var response = JSON.parse(response);
      //alert(response.status)
      if (response.status == 1) {
        window.location="http://pricebook.gr/pricebook/";
      }
      else {
        alert(response.message);
      }

  },
  error:function()
  {
    alert("error");
  }
  });



});
</script>
