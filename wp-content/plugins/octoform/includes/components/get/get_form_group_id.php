<?php
function get_form_group_id() {
  global $wpdb;
  $result = '';
  if (isset($_POST['form_id'])) {
    $conn = $wpdb->get_results("SELECT group_id FROM wp_forms WHERE ID = ". $_POST['form_id'] );
    $result = $conn[0]->group_id;
  }
  return $result;
}
