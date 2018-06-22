<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WP_Bootstrap_Starter
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
	<script type="text/javascript">
	var root_images_path = "http://pricebook.gr/pricebook";


	</script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"   rel="stylesheet">

	<script src="https://use.typekit.net/kzp0lbw.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>

</head>
<?php

function print_m($str)
{
	echo '<h1>'.$str.'</h1>';
}
?>
<body <?php body_class('white3-bg'); ?>>


	<?php // include('modules/how.php');?>

	<div id="wrap" class="site"> <?php //id="page" ?>
