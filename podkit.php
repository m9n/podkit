<?php
/*
Plugin Name: Podkit
Plugin URI: https://github.com/m9n/podkit
Description: Functions and shortcodes to help you build (Even More) Amazing Things with Pods.
Version: 0.1
Author: Mina Nielsen
Author URI: minanielsen.net
License: GPL 2.0
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


function is_pods_active() { return defined('PODS_VERSION'); }

// Allow Pods Templates to use shortcodes
define('PODS_SHORTCODE_ALLOW_SUB_SHORTCODES',true);
add_filter( 'pods_shortcode', function( $tags )  {
  $tags[ 'shortcodes' ] = true;  
  return $tags;
});

require_once('functions/pk_gmap.php');
require_once('shortcodes/pk_dates.php');