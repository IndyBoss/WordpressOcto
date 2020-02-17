<?php
function get_created_form_group_id() {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT group_id FROM wp_forms ORDER BY Date DESC" );
  return $conn[0]->group_id;
}
