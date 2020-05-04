<?php
function questionaire_send() {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT * FROM `wp_question` WHERE form_id=" . $_POST['form_id']);
  $q = 1;

  foreach ($conn as $c) {
    switch ($c->qtype) {
      case 0:
        if (isset($_POST['question_'.$q])) {
          $text = $_POST['question_'.$q];
        }
        $wpdb->insert('wp_question_results_choice', array(
          'answer' => $text,
          'question_id' => $c->ID,
          'form_id' => $_POST['form_id']
        ));
        break;
      case 1:
        $text = '';
        for ($i=1; $i <= $c->parts; $i++) {
          if (isset($_POST['question_'.$q.'_'.$i])) {
            $text .= '|'.$_POST['question_'.$q.'_'.$i];
          }
        }
        $wpdb->insert('wp_question_results_multiple', array(
          'answer' => $text,
          'question_id' => $c->ID,
          'form_id' => $_POST['form_id']
        ));
        break;
      case 2:
      $result .= '';
      $text = $_POST['question_'.$q];
        $wpdb->insert('wp_question_results_open', array(
          'answer' => $text,
          'question_id' => $c->ID,
          'form_id' => $_POST['form_id']
        ));
        break;
      case 3:
        $loc = $_POST['question_'.$q.'_2'] . ', ' . $_POST['question_'.$q.'_3'];
        $wpdb->insert('wp_markers', array(
          'name' => $_POST['question_'.$q.'_1'],
          'location' => $loc,
          'description' => $_POST['question_'.$q.'_4'],
          'lat' => get_lat_lng($loc)['lat'],
          'lng' => get_lat_lng($loc)['long'],
          'question_id' => $c->ID,
          'form_id' => $_POST['form_id']
        ));
        break;
    }
    $q ++;
  }


  return $result;
}
add_shortcode('questionaire_send', 'questionaire_send');
