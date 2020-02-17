<?php
function get_form_questions($view_url, $form_id, $questions_url) {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT * FROM `wp_question` WHERE form_id=" . $form_id);
  $q = 1;

  $result = '<br><h3>Vragen</h3>';

  if ($conn[0]->ID == '') {
    $result = $result . 'Nog geen vragen in dit formulier.';
  }

  foreach ($conn as $c) {
    switch ($c->qtype) {
      case 0:
        $result = $result . get_question_edit_buttons($questions_url, $view_url, $form_id, $c->ID, $c->question, $c->qtype, true);
        $pieces = explode("|", $c->text);
        $result = $result .'<form>';
        for ($i=1; $i <= $c->parts; $i++) {
          $result = $result . '<input type="radio" name="question_'.$q.'_'.$i.'" value="question_'.$q.'_'.$i.'"> '.$pieces[$i].'<br>';
        }
        $result = $result . '</form>';
        break;
      case 1:
        $result = $result . get_question_edit_buttons($questions_url, $view_url, $form_id, $c->ID, $c->question, $c->qtype, true);
        $pieces = explode("|", $c->text);
        $result = $result .'<form>';
        for ($i=1; $i <= $c->parts; $i++) {
          $result = $result . '<input type="checkbox" name="question_'.$q.'_'.$i.'" value="question_'.$q.'_'.$i.'"> '.$pieces[$i].'<br>';
        }
        $result = $result . '</form>';
        break;
      case 2:
        $result = $result . get_question_edit_buttons($questions_url, $view_url, $form_id, $c->ID, $c->question, $c->qtype, true);
        $result = $result .'<form>';
        $result = $result . '<textarea name="question_'.$q.'"></textarea><br></form>';
        break;
      case 3:
        $result = $result . get_question_edit_buttons($questions_url, $view_url, $form_id, $c->ID, $c->question, $c->qtype, false);
        $result = $result .'<form>
        <label for="naam"><b>Plaatsnaam</b></label>
        <input type="text" placeholder="Kruispunt, oversteekplaats, ..." name="question_'.$q.'_1" required><br>
        <label for="straat"><b>Straatnaam & nummer</b></label>
        <input type="text" placeholder="Straat 1" name="question_'.$q.'_2" required><br>
        <label for="gemeente"><b>Gemeente & gemeentecode</b></label>
        <input type="text" placeholder="Gemeente 0001" name="question_'.$q.'_3" required><br>
        <label for="beschrijving"><b>Beschrijving</b></label>
        <textarea type="text" placeholder="Een gevaarlijk kruispunt ter hoogte van Straat 1 in Gemeente, ..." name="question_'.$q.'_4" required></textarea><br></form>';
        break;
    }
    $q ++;
  }

  return $result;
}
