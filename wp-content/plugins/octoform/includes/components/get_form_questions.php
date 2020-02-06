<?php
function get_form_questions($form_id) {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT * FROM `wp_question` WHERE form_id=" . $form_id);
  $q = 1;

  $result = '<br><h3>Vragen</h3><form>';

  foreach ($conn as $c) {
    switch ($c->qtype) {
      case 0:
        $pieces = explode("|", $c->text);
        $result = $result .'<br><h5>'. $c->question .'</h5>';
        for ($i=1; $i <= $c->parts; $i++) {
          $result = $result . '<input type="radio" name="question_'.$q.'" value="question_'.$q.'_'.$i.'"> '.$pieces[$i].'<br>';
        }
        break;
      case 1:
        $pieces = explode("|", $c->text);
        $result = $result .'<br><h5>'. $c->question .'</h5>';
        for ($i=1; $i <= $c->parts; $i++) {
          $result = $result . '<input type="checkbox" name="question_'.$q.'" value="question_'.$q.'_'.$i.'"> '.$pieces[$i].'<br>';
        }
        break;
      case 2:
        $result = $result .'<br><h5>'. $c->question .'</h5>';
        $result = $result . '<textarea name="question_'.$q.'"></textarea><br>';
        break;
      case 3:

        break;

      default:

        break;
    }
    $q ++;
  }
  $result = $result . '</form>';

  return $result;
}
