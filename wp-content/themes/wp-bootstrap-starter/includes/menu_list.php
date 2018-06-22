<div class="dashboard-menu-shape">

  <?php  $menu_array["open"]="Ανοικτά Αιτήματα";

  $menu_array["closed"]="Κλειστά Αιτήματα";

  $menu_array["messages"]="Μηνύματα";

  $menu_array["sellers"]="Προμηθευτές";

  $menu_array["black"]="Βlack List";

  $menu_array["stats"]="Στατιστικά";

  $menu_array["clients"]="Πελατολόγειο";

  //for($i=0; $i<6 ; $i++)

  //{



  $j = $i+1;

  ?>


  <!------------------------------------------------------------------------->
  <div class="single-dashboard-menu-transform">

    <div class="single-dashboard-menu-shape">



      <div class="menu-image-transform">

        <div class="menu-image-shape">

          <i class="material-icons md-dark md-24">import_contacts</i>



        </div>

      </div>



      <div class="dashboard_menu_link <?php if (in_array($choice,array('active','waiting_approval'))) { echo 'active'; } ?>">

        <?php

        if(is_buyer())
        {
          ?>
          <a class="black2" href="<?php echo get_site_url(); ?>/home-buyers/?inquiries=active">Ανοικτά Αιτήματα</a>
          <?php
        }else {
          ?>
          <a class="black2" href="<?php echo get_site_url(); ?>/home-seller/?inquiries=active">Ανοικτά Αιτήματα</a>
          <?php
        }
        ?>


      </div>



    </div>

  </div>
  <!--single-dashboard-menu-transform-->


  <!------------------------------------------------------------------------->
  <div class="single-dashboard-menu-transform">

    <div class="single-dashboard-menu-shape">


      <div class="menu-image-transform">

        <div class="menu-image-shape">

          <i class="material-icons md-24 md-dark">collections_bookmark</i>

        </div>

      </div>



      <div class="dashboard_menu_link <?php if (in_array($choice,array('complete','inactive','approved_waiting_rank'))) { echo 'active'; } ?>">

        <!--  <a href="?p=<?php echo $j;?>&s=<?php echo $_seller;?>" class="black2">

        <?php echo $menu_array[$i];?>

      </a>
    -->
    <?php
    if(is_buyer())
    {
      ?>
      <a class="black2" href="<?php echo get_site_url(); ?>/buyer-closed/?inquiries=inactive">Κλειστά Αιτήματα</a>
      <?php
    }else {
      ?>
      <a class="black2" href="<?php echo get_site_url(); ?>/closed-sellers/?inquiries=inactive">Κλειστά Αιτήματα</a>
      <?php
    }
    ?>


  </div>



</div>

</div>
<!--single-dashboard-menu-transform-->

<!------------------------------------------------------------------------->
<div class="single-dashboard-menu-transform">

  <div class="single-dashboard-menu-shape">



    <div class="menu-image-transform">

      <div class="menu-image-shape">

        <i class="material-icons md-dark md-24">email</i>



      </div>

    </div>



    <div class="dashboard_menu_link">

      <!--  <a href="?p=<?php echo $j;?>&s=<?php echo $_seller;?>" class="black2">

        <?php echo $menu_array[$i];?>

      </a>
    -->

    <?php
    if(is_buyer())
    {
      ?>

      <?php
    }
    ?>
    <a class="black2" href="<?php echo get_site_url(); ?>/usermessages">Μηνύματα</a>

    <?php if (isset($unread_messages) && $unread_messages > 0)
    {
      ?>
      <div class="messagesCount-transform ">
        <div class="messagesCount-shape circle red-bg white"><?php echo $unread_messages;?></div>
      </div>
      <?php
    }?>


  </div>



</div>

</div>
<!--single-dashboard-menu-transform-->


<!------------------------------------------------------------------------->
<div class="single-dashboard-menu-transform">

  <div class="single-dashboard-menu-shape">



    <div class="menu-image-transform">

      <div class="menu-image-shape">
        <?php
        if(is_buyer())
        {
          ?>
          <i class="material-icons md-24 md-dark">local_grocery_store</i>
          <?php
        }else{
          ?>
          <i class="material-icons  md-24 md-dark">perm_contact_calendar</i>
          <?php

        }
        ?>
      </div>

    </div>



    <div class="dashboard_menu_link">

      <!--  <a href="?p=<?php echo $j;?>&s=<?php echo $_seller;?>" class="black2">

        <?php echo $menu_array[$i];?>

      </a>
    -->
    <?php
    if(is_buyer())
    {
      ?>
      <a class="black2" href="<?php echo get_site_url(); ?>/buyerssellerslist">Προμηθευτές</a>
      <?php
    }else{
      ?>
      <a class="black2" href="<?php echo get_site_url(); ?>/sellersclientlist">Πελάτες</a>
      <?php

    }
    ?>

  </div>



</div>

</div>
<!--single-dashboard-menu-transform-->



<!------------------------------------------------------------------------->
<div class="single-dashboard-menu-transform">

  <div class="single-dashboard-menu-shape">



    <div class="menu-image-transform">

      <div class="menu-image-shape">

        <i class="material-icons  md-24 md-dark">sentiment_very_dissatisfied</i>



      </div>

    </div>



    <div class="dashboard_menu_link">

      <!--  <a href="?p=<?php echo $j;?>&s=<?php echo $_seller;?>" class="black2">

        <?php echo $menu_array[$i];?>

      </a>
    -->

    <?php
    if(is_buyer())
    {
      ?>
      <a class="black2" href="<?php echo get_site_url(); ?>/userblacklist">Βlacklist</a>
      <?php
    }else {
      ?>
      <a class="black2" href="<?php echo get_site_url(); ?>/sellerblacklist">Βlacklist</a>
      <?php
    }
    ?>

  </div>



</div>

</div>
<!--single-dashboard-menu-transform-->



<!------------------------------------------------------------------------->
<!--single-dashboard-menu-transform-->
<div class="single-dashboard-menu-transform">

  <div class="single-dashboard-menu-shape">



    <div class="menu-image-transform">

      <div class="menu-image-shape">



        <i class="material-icons md-dark md-24">timeline</i>

      </div>

    </div>



    <div class="dashboard_menu_link">

      <!--  <a href="?p=<?php echo $j;?>&s=<?php echo $_seller;?>" class="black2">

        <?php echo $menu_array[$i];?>


      </a>
    -->
    <a class="black2" href="<?php echo get_site_url(); ?>/userstatistics">Στατιστικά</a>
  </div>



</div>

</div>



<!------------------------------------------------------------------------->
<!--single-dashboard-menu-transform-->
<div class="single-dashboard-menu-transform">

  <div class="single-dashboard-menu-shape">



    <div class="menu-image-transform">

      <div class="menu-image-shape">



        <i class="material-icons  md-dark md-24">account_circle</i>

      </div>

    </div>



    <div class="dashboard_menu_link">

      <!--  <a href="?p=<?php echo $j;?>&s=<?php echo $_seller;?>" class="black2">

        <?php echo $menu_array[$i];?>


      </a>
    -->

    <?php
    if (is_user_logged_in()) {
        $currentUser = wp_get_current_user();

        $roles = $currentUser->roles;

        if (in_array('sellers',$roles)) {
          ?>
            <a class="black2" href="http://pricebook.gr/profile_edit.php">Λογαριασμός</a>
    <?php
          }else{
    ?>
          <a class="black2" href="<?php echo get_site_url(); ?>/buyer-account/">Λογαριασμός</a>
  <?php
          }
      }
?>

  </div>



</div>

</div>



<?php

//}

?>

</div>




<aside id="secondary" class="widget-area col-sm-12 col-md-12 col-lg-2 hidden" role="complementary">
  <ul class="sidebar-inquiries">
    <li class="<?php if (in_array($choice,array('active','waiting_approval'))) { echo 'active'; } ?>"><a href="/home-buyers/?inquiries=active">ΑΝΟΙΚΤΑ ΑΙΤΗΜΑΤΑ</a></li>
    <li class="<?php if (in_array($choice,array('complete','inactive','approved_waiting_rank'))) { echo 'active'; } ?>"><a href="/home-buyers/?inquiries=inactive">ΚΛΕΙΣΤΑ ΑΙΤΗΜΑΤΑ</a></li>
    <li><a href="/usermessages">ΜΗΝΥΜΑΤΑ</a><span class="messagesCount"></span></li>
    <li><a href="/buyerssellerslist">ΠΡΟΜΗΘΕΥΤΕΣ</a></li>
    <li><a href="/userblacklist">BLACKLIST</a></li>
    <li><a href="/userstatistics">ΣΤΑΤΙΣΤΙΚΑ</a></li>
  </ul>
</aside>
