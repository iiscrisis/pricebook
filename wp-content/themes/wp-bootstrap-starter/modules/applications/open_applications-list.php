

<div class="open_application_list_main-transform best_offer">
  <div class="open_application_list_main-shape white4 white2-bg radius2">
    <div class="list-title black2 bold">
      Καλύτερη Προσφορά
    </div>
    <?php include 'application-info-row.php';?>

  </div>
</div>

<div class="open_application_list_main-transform interesting_offers">
  <div class="open_application_list_main-shape white4 white2-bg radius2">
    <div class="list-title black2 bold">
      Ενδιαφέρουσες Προσφορές
    </div>
    <?php for($i=0;$i<3;$i++)
    {
      ?>

        <?php include 'application-info-row.php';?>



    <?php

    }

    ?>

  </div>
</div>

<div class="open_application_list_main-transform">
  <div class="open_application_list_main-shape white2-bg white4 radius2 all-offers-list">
    <div class="list-title black2 bold">
      Λοιπές Προσφορές
    </div>

    <?php for($i=0;$i<5;$i++)
    {
      ?>

        <?php include 'application-info-row.php';?>



    <?php

    }

    ?>

  </div>
</div>
