<?php session_start(); ?>
<?php var_dump($_SESSION); ?>
<form method="post" id="roleForm" action="" class="text-center">
  <input type="hidden" name="id" value="<?php ?>" />
  <h3>Login as</h3>
  <div class="col-12">
    <input type="submit" class="col-12 btn btn-default" name="role" value="Buyer" />
  </div>
  <div class="col-12">
    <input type="submit" class="col-12 btn btn-default" name="role" value="Seller" />
  </div>
</form>
