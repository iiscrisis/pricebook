<div class="dashboard-menu-shape">
<?php  $menu_array[0]="Ανοικτά Αιτήματα";
$menu_array[1]="Κλειστά Αιτήματα";
$menu_array[2]="Μηνύματα";
$menu_array[3]="Προμηθευτές";
$menu_array[4]="Βlack List";
$menu_array[5]="Στατιστικά";
//for($i=0; $i<6 ; $i++)
//{

  $j = $i+1;
?>


<!------------------------------------------------------------------------->
  <div class="single-dashboard-menu-transform">
    <div class="single-dashboard-menu-shape">

      <div class="menu-image-transform">
        <div class="menu-image-shape">
          <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/menu/menu_1.svg" />

        </div>
      </div>

      <div class="dashboard_menu_link <?php if (in_array($choice,array('active','waiting_approval'))) { echo 'active'; } ?>">
      <!--  <a href="?p=<?php echo $j;?>&s=<?php echo $_seller;?>" class="black2">
          <?php echo $menu_array[$i];?>
        </a>-->
      <a class="black2" href="<?php echo get_site_url(); ?>/home-sellers/?inquiries=active">Ανοικτά Αιτήματα</a>

      </div>

    </div>
  </div>
  <!--single-dashboard-menu-transform-->

  <!------------------------------------------------------------------------->
    <div class="single-dashboard-menu-transform">

      <div class="single-dashboard-menu-shape">


        <div class="menu-image-transform">

          <div class="menu-image-shape">

            <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/menu/menu_2.svg" />

          </div>

        </div>



        <div class="dashboard_menu_link <?php if (in_array($choice,array('complete','inactive','approved_waiting_rank'))) { echo 'active'; } ?>">

        <!--  <a href="?p=<?php echo $j;?>&s=<?php echo $_seller;?>" class="black2">

            <?php echo $menu_array[$i];?>

          </a>
-->
    <a class="black2" href="<?php echo get_site_url(); ?>/closed-sellers/?inquiries=inactive">Κλειστά Αιτήματα</a>

        </div>



      </div>

    </div>
    <!--single-dashboard-menu-transform-->

    <!------------------------------------------------------------------------->
      <div class="single-dashboard-menu-transform">

        <div class="single-dashboard-menu-shape">



          <div class="menu-image-transform">

            <div class="menu-image-shape">

              <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/menu/menu_3.svg" />



            </div>

          </div>



          <div class="dashboard_menu_link <?php echo ($choice == 'messages'		? 'active' : ''); ?>">

          <!--  <a href="?p=<?php echo $j;?>&s=<?php echo $_seller;?>" class="black2">

              <?php echo $menu_array[$i];?>

            </a>
--><span class="messagesCount"></span></li>
        <a class="black2" href="<?php echo get_site_url(); ?>/sellermessages">Μηνύματα</a><span class="messagesCount hidden"></span>

          </div>



        </div>

      </div>
      <!--single-dashboard-menu-transform-->


      <!------------------------------------------------------------------------->
        <div class="single-dashboard-menu-transform">

          <div class="single-dashboard-menu-shape">



            <div class="menu-image-transform">

              <div class="menu-image-shape">

                <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/menu/menu_4.svg" />



              </div>

            </div>



            <div class="dashboard_menu_link <?php echo ($choice == 'sellersclientlist'	? 'active' : ''); ?>">

            <!--  <a href="?p=<?php echo $j;?>&s=<?php echo $_seller;?>" class="black2">

                <?php echo $menu_array[$i];?>

              </a>
-->
          <a class="black2" href="<?php echo get_site_url(); ?>/sellersclientlist">Πελατολόγειο</a>
            </div>



          </div>

        </div>
        <!--single-dashboard-menu-transform-->



        <!------------------------------------------------------------------------->
          <div class="single-dashboard-menu-transform">

            <div class="single-dashboard-menu-shape">



              <div class="menu-image-transform">

                <div class="menu-image-shape">

                  <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/menu/menu_5.svg" />



                </div>

              </div>


              <div class="dashboard_menu_link <?php echo ($choice == 'blacklist'		? 'active' : ''); ?>">

              <!--  <a href="?p=<?php echo $j;?>&s=<?php echo $_seller;?>" class="black2">

                  <?php echo $menu_array[$i];?>

                </a>
-->
        <a class="black2" href="<?php echo get_site_url(); ?>/sellerblacklist">Βlack List</a>
              </div>



            </div>

          </div>
          <!--single-dashboard-menu-transform-->



          <!------------------------------------------------------------------------->
            <div class="single-dashboard-menu-transform">

              <div class="single-dashboard-menu-shape">



                <div class="menu-image-transform">

                  <div class="menu-image-shape">

                    <img src="<?php echo get_template_directory_uri() ;?>/images/dashboard/menu/menu_6.svg" />



                  </div>

                </div>




                <div class="dashboard_menu_link <?php echo ($choice == 'statistics'	? 'active' : ''); ?>">

                <!--  <a href="?p=<?php echo $j;?>&s=<?php echo $_seller;?>" class="black2">

                    <?php echo $menu_array[$i];?>

                  </a>
-->
              <a class="black2" href="<?php echo get_site_url(); ?>/sellerstatistics">Στατιστικά</a>
                </div>



              </div>

            </div>
            <!--single-dashboard-menu-transform-->


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
