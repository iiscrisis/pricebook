<div class="row image_uploader" data-target="<?php echo $target_div;?>">
  <div class="col">

        <input type="file" name="photo" >
      <!-- Drag and Drop container-->
      <div class="upload-area text-center file_uploader"  >

        <div class="loader drag_loader"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>

          <h1 class=" inline-block middle"><strong class="blue">Drag & Drop </strong>την εικόνα ή</h1>




        <div class="btn btn-primary inline-block middle">
          πατήστε εδώ
        </div>

        <?php if(isset($instructions) && $instructions!="")
        {
          ?>
          <p>
            <div class="grey4 instructions">
              <?php echo $instructions;?>
            </div>
          </p>

        <?php
        }
        ?>

      </div>
  </div>
</div>
