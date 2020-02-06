<?php

function get_group_name($id) {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT group_name FROM wp_usergroups WHERE group_id = ". $id );
  $g_name = $conn[0]->group_name;
  return $g_name;
}
