<?php
function view_forms( $atts ) {
	$a = shortcode_atts( array('add_url'=>'#', 'questionaire_url'=>'#', 'data_url'=>'#'), $atts );
	$add_url = esc_attr($a['add_url']);
	$questionaire_url = esc_attr($a['questionaire_url']);
	$data_url =  esc_attr($a['data_url']);
  $g_id = get_groupid();
	global $wpdb;
	$result = '';

	$result .= get_alerts();

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
		if ($_POST['method'] == 'mdelete') {
			$wpdb->delete( 'wp_markers', array( 'id' => $_POST['marker_id'] ) );
		}
	}

	$result .= paginate_forms($add_url, $view_url, $data_url, $g_id, $questionaire_url);
  $result .= get_full_map();

	return $result;
}
add_shortcode('viewforms', 'view_forms');
