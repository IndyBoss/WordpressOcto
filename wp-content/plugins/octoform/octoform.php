<?php
/**
 * Plugin Name: Octoform
 * Description: Custom form plugin for use @octopusplan/voetgangersbeweging.
 * Version: 2.3
 * Author: Bosschem Indy
 */

$dir = 'wp-content/plugins/octoform/';

wp_register_style('leaflet_style', '/'.$dir.'assets/leaflet/css/leaflet.css');
wp_enqueue_style( 'leaflet_style');
wp_register_style('leaflet_markercluster_style', '/'.$dir.'assets/leaflet/css/leaflet_markercluster.css');
wp_enqueue_style( 'leaflet_markercluster_style');
wp_register_style('leaflet_markercluster_def_style', '/'.$dir.'assets/leaflet/css/leaflet_markercluster_def.css');
wp_enqueue_style( 'leaflet_markercluster_def_style');

wp_enqueue_script( 'leaflet_plugin_js', '/'.$dir.'assets/leaflet/js/leaflet.js');
wp_enqueue_script( 'leaflet_cluster_js', '/'.$dir.'assets/leaflet/js/leaflet_markercluster.js');

wp_enqueue_script( 'JQuery_js', '/'.$dir.'assets/js/JQuery.js');
wp_enqueue_script( 'table2excel_js', '/'.$dir.'assets/js/table2excel.js');
wp_enqueue_script( 'export_listen_js', '/'.$dir.'assets/js/export_listen.js');

wp_register_style('Octoform_style', '/'.$dir.'assets/css/octoform.css');
wp_enqueue_style( 'Octoform_style');

wp_enqueue_script( 'google-charts', '/'.$dir.'assets/charts/charts.js');

foreach (glob($dir . "includes/*.php") as $filename) {
  require_once($filename);
}
foreach (glob($dir . "includes/components/main/*.php") as $filename) {
  require_once($filename);
}
foreach (glob($dir . "includes/components/get/*.php") as $filename) {
  require_once($filename);
}
foreach (glob($dir . "includes/components/list/*.php") as $filename) {
  require_once($filename);
}
foreach (glob($dir . "includes/components/update/*.php") as $filename) {
  require_once($filename);
}
