
<?php
  if (is_user_logged_in()) {

    wp_logout();
    echo '<script type="text/javascript">window.location="http://pricebook.gr/";</script>';
    wp_die();
  }
	else {
      echo '<h2> LOGGED OUT</h2>';
	//	echo '<script type="text/javascript">window.location="'.get_site_url().'";</script>';
		wp_die();
	}
?>
<?php
/**
* Template Name: Logout
*/
get_header();
?>
