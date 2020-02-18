<?php
function get_admin_groups($selected) {
  global $wpdb;
  $result = '';
  if (current_user_can('administrator')) {
    $conn = $wpdb->get_results("SELECT DISTINCT group_id, group_name FROM wp_usergroups");
    $result .= '<label for="group"><b>Groep selecteren</b></label><select name="group">';
    foreach ($conn as $c) {
      $s ="";
      if ($selected == $c->group_id) {$s = 'selected';}
      $result .= "<option value='" . $c->group_id . "'".$s.">" . $c->group_name ."</option>";
    }
    $result .= '</select><br><br>';
  }
  return $result;
}
