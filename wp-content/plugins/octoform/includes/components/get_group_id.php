<?php

function get_groupid() {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT group_id FROM wp_usergroups WHERE user_id = ". get_current_user_id() );
  $g_id = $conn[0]->group_id;
  return $g_id;
}
