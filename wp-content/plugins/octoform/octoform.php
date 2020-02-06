<?php
/**
 * Plugin Name: Octoform
 * Description: Custom form plugin for use @octopusplan/voetgangersbeweging.
 * Version: 2.3
 * Author: Bosschem Indy
 */

$dir = 'wp-content/plugins/octoform/';

foreach (glob($dir . "includes/*.php") as $filename) {
  require_once($filename);
}

foreach (glob($dir . "includes/components/*.php") as $filename) {
  require_once($filename);
}

wp_register_style('Octoform_style', '/'.$dir.'includes/css/octoform.css');
wp_enqueue_style( 'Octoform_style');
