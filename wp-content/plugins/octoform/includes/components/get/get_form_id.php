<?php
function get_form_id() {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT ID FROM `wp_forms` ORDER BY Date DESC");
  $result = $conn[0]->ID;
  return $result;
}
