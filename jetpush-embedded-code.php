<?php
/*
Plugin Name: Jetpush Embedded Code
Plugin URI: http://jetpush.com/
Description: A simple Plugin to add Jetpush code on your pages. You simply enter your shop owner ID.
Version: 1.0.0
Author: Jetpush team
Author URI: http://jetpush.com
*/

	define('JEC_ROOT', dirname(plugin_basename(__FILE__))) ;
	define('JEC_DIRPATH', plugin_dir_path(__FILE__)) ;
	define('JEC_BASENAME', plugin_basename(__FILE__)) ;
	define('JEC_PLUGIN_TITLE', 'Jetpush Embedded Code') ; // Titre
	define('JEC_SETTINGS_AUTH', 'administrator') ;

	define('WP_DEBUG', false) ;
	define('WP_DEBUG_DISPLAY', false) ;
	
	@include('autoload.php') ;

	new Actions ;
	
?>
