<?php
function view_forms( $atts ) {
	$a = shortcode_atts( array('add_url'=>'#'), $atts );
	$add_url = esc_attr($a['add_url']);
	$data_url = '#';
  $g_id = get_groupid();
	global $wpdb;
	$result = '';

	$result = $result . get_alerts();

	if (isset($_POST['method'])) {
		if ($_POST['method'] == 'delete') {
			$wpdb->delete( 'wp_forms', array( 'id' => $_POST['form_id'] ) );
			$sql = "DELETE FROM wp_question WHERE form_id = ".$_POST['form_id'];
			try {
				$wpdb->query($wpdb->prepare($sql));
			} catch (Exception $e) {
				return 'Error! '. $wpdb->last_error;
	    }
		}
	}

	if (current_user_can('administrator')) {
		$result = $result . popup($add_url, $view_url). "<table><tr><th>ID</th><th>Naam</th><th>Group</th><th>Link</th><th>Acties</th></tr>";
	} else {$result = $result . popup($add_url, $view_url). "<table><tr><th>ID</th><th>Naam</th><th>Link</th><th>Acties</th></tr>";}

  if ($g_id != 1) {
    $conn = $wpdb->get_results("SELECT * FROM wp_forms WHERE group_id = ". $g_id );
  } else {$conn = $wpdb->get_results("SELECT * FROM wp_forms");}

	if (!empty($conn[0]->ID)) {
		foreach ($conn as $c) {
	    $result = $result . "<tr><td>".$c->ID."</td><td>".$c->name."</td>";
			if (current_user_can('administrator')) {$result = $result . "<td>".get_group_name($c->group_id)."</td>";}
			$result = $result ."<td><a href='#'>Link</a></td><td>".
								'<div style="display: grid;grid-column-gap: 10px;justify-content: left;grid-template-columns: auto auto;grid-template-rows: auto;">
								<form action="/'.$add_url.'" method="post">
		              <input type="hidden" name="form_id" value="'.$c->ID.'">
									<input type="hidden" name="naam" value="'.$c->name.'">
		              <input type="submit" name="submit" value="Aanpassen">
		            </form>
								<form action="/'.$data_url.'" method="post">
		              <input type="hidden" name="form_id" value="'.$c->ID.'">
									<input type="hidden" name="naam" value="'.$c->name.'">
		              <input type="submit" name="submit" value="Resultaten">
		            </form>
								<div>';
		}
	} else {
		if (current_user_can('administrator')) {
			$result = $result . "<tr><td>#</td><td>Nog niet van toepassing</td><td>........</td><td>........</td><td>........</td></tr>";
		} else {$result = $result . "<tr><td>#</td><td>Nog niet van toepassing</td><td>........</td><td>........</td></tr>";}
	}
  $result = $result ."</table>" . get_full_map();

	return $result;
}
add_shortcode('viewforms', 'view_forms');
