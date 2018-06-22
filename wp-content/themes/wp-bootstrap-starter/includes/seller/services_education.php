<div id="education_tmpl" class="hidden">


  <div class="card info-card shadow2  single_table-row">
    <div class="card-body">
      <h4 class="card-title blue">
        <small>Από - Έως</small>
        <input type="text" class="education_dates" value="" placeholder="πχ 2009 - 2011" />

      </h4>
      <h6 class="text-muted card-subtitle mb-2">
        <small>Φορέας εκπαίδευσης</small>
        <input type="text" class="education_establishment" value="" placeholder="πχ Οικονομικό Πανεπιστήμιο Αθηνών" /></h6>
        <p class="card-text black">
          <small>Τίτλος</small>
          <input type="text" class="education_title" value="" placeholder="πχ Μεταπτυχιακό" />
          <br/>
          <small>Τομέας εκπαίδευσης</small>
          <span class="blue"><input type="text" class="education_educ_area" value="" placeholder="πχ Οργάνωση και Διοίκηση Επιχειρήσεων" /></span></p>
        </div>


        <div class="single-table-remove-transform">
          <div class="single-table-remove-shape pointer red bold">
            <i class="material-icons red  inline-block middle md-18">delete_forever</i> Διαγραφή
          </div>
        </div>


      </div>


    </div>

    <div class="row">
      <div class="col">
        <div class="services_details_box_button-shape grey-bg inline-block">
          <div class="<?php echo $button_prefix;?>-button-transform ">
            <div class="<?php echo $button_prefix;?>-shape pointer white bold services_button btn btn-success">
              <i class="material-icons middle white">add_circle_outline</i> Προσθέστε εγγραφή
            </div>
          </div>
        </div>
      </div>
    </div>

    <form id="<?php echo $form_id;?>" method="post">
      <div id="education-rows">


      <?php

      foreach($single_pool as $single_row)
      {
        $counter = 0;
        if($single_row=="")
        {
          continue;
        }


        $single_row = str_replace("##","",$single_row);
        $single_row = str_replace("@@","",$single_row);

        $fields = explode("@#",$single_row);

        ?>

        <div class="card info-card shadow2 single_table-row" id="edu<?php echo $row_count++;?>">

          <div class="card-body">
            <h4 class="card-title blue">
              <small>Από - Έως</small>
              <input type="text" class="education_dates" value="<?php echo $fields[0];?>" placeholder="πχ 2009 - 2011" />

            </h4>
            <h6 class="text-muted card-subtitle mb-2">
              <small>Φορέας εκπαίδευσης</small>
              <input type="text" class="education_establishment" value="<?php echo $fields[1];?>" placeholder="πχ Οικονομικό Πανεπιστήμιο Αθηνών" /></h6>
              <p class="card-text black">
                <small>Τίτλος</small>
                <input type="text" class="education_title" value="<?php echo $fields[2];?>" placeholder="πχ Μεταπτυχιακό" />
                <br/>
                <small>Τομέας εκπαίδευσης</small>
                <span class="blue"><input type="text" class="education_educ_area" value="<?php echo $fields[3];?>" placeholder="πχ Οργάνωση και Διοίκηση Επιχειρήσεων" /></span></p>
              </div>

              <div class="single-table-remove-transform">
                <div class="single-table-remove-shape pointer red bold">
                  <i class="material-icons red  middle inline-block md-18">delete_forever</i> Διαγραφή
                </div>
              </div>

            </div>
        <?php
      }

      ?>
        </div>
         <input type="submit" value="Aποθήκευση" class=" btn btn-primary btn-send " />
    </form>
