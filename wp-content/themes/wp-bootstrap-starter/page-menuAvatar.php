<?php
/**
* Template Name: Menu Avatar
*/


if (!is_user_logged_in()) {
?>
<ul class="nav navbar-nav ml-auto">
    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php" style="color:#ffffff;">Αρχική</a></li>
    <li class="nav-item" role="presentation"><a class="nav-link" href="works.php" style="color:#ffffff;">Πώς Λειτουργεί</a></li>

    <li class="nav-item" role="presentation" id="login-button"><a class="nav-link login-box" href="#" style="width:auto;color:#ffffff;">Σύνδεση / Εγγραφή</a></li>
</ul>

<?php
}else {

?>
  <ul class="nav navbar-nav ml-auto">
      <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php" style="color:#ffffff;">Αρχική</a></li>
      <li class="nav-item" role="presentation"><a class="nav-link" href="works.php" style="color:#ffffff;">Πώς Λειτουργεί</a></li>

  </ul>
    <div class="inline-block middle">
      <a class="nav-link" href="http://pricebook.gr/pricebook/"  >  <div class=" btn btn-primary">Dashboard</div></a>
    </div>
  <?php include("includes/avatar.php");?>

  <?php
}
?>
