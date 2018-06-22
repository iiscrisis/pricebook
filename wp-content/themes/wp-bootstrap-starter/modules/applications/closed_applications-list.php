<div class="list-applications-transform">
  <div class="list-applications-shape">
    <div class="list-title-transform ">
      <div class="list-title-shape aqua-bg white radius4 no_bottom_radius bold">
        Αγορά Από
      </div>
    </div>
    <div class="open_application_list_main-transform">
      <div class="open_application_list_main-shape aqua-bg radius2">

        <?php include 'application-info-row.php';?>

      </div>
    </div>

    <div class="list-title-transform ">
      <div class="list-title-shape white3-bg grey5 radius4 no_bottom_radius bold">
        Υπόλοιπες Προσφορές
      </div>
    </div>

    <div class="open_application_list_main-transform">
      <div class="open_application_list_main-shape white3-bg radius2">

        <?php for($i=0;$i<5;$i++)
        {
          ?>

            <?php include 'application-info-row.php';?>



        <?php

        }

        ?>

      </div>
    </div>
  </div>
</div>
