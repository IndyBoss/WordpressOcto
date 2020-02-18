<?php
function get_form_questions($view_url, $form_id, $questions_url) {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT * FROM `wp_question` WHERE form_id=" . $form_id);
  $ci = $wpdb->get_results("SELECT intro FROM `wp_forms` WHERE ID=" . $form_id);
  $q = 1;

  $result = '<br><h3>Intro</h3>';

  $resultArray = explode("\n", $ci[0]->intro);
  foreach ($resultArray as $r) {
    if ($r != '') {
      $result .= '<p>'.$r.'</p>';
    }
  }

  $result .= '<br><h3>Vragen</h3>';

  if ($conn[0]->ID == '') {
    $result .= '<p>Nog geen vragen in dit formulier.</p>';
  }

  foreach ($conn as $c) {
    switch ($c->qtype) {
      case 0:
        $result .= get_question_edit_buttons($questions_url, $view_url, $form_id, $c->ID, $c->question, $c->qtype, true, $q);
        $pieces = explode("|", $c->text);
        $result .='<form>';
        for ($i=1; $i <= $c->parts; $i++) {
          $result .= '<input type="radio" name="question_'.$q.'_'.$i.'" value="question_'.$q.'_'.$i.'"> '.$pieces[$i].'<br>';
        }
        $result .= '</form>';
        break;
      case 1:
        $result .= get_question_edit_buttons($questions_url, $view_url, $form_id, $c->ID, $c->question, $c->qtype, true, $q);
        $pieces = explode("|", $c->text);
        $result .='<form>';
        for ($i=1; $i <= $c->parts; $i++) {
          $result .= '<input type="checkbox" name="question_'.$q.'_'.$i.'" value="question_'.$q.'_'.$i.'"> '.$pieces[$i].'<br>';
        }
        $result .= '</form>';
        break;
      case 2:
        $result .= get_question_edit_buttons($questions_url, $view_url, $form_id, $c->ID, $c->question, $c->qtype, true, $q);
        $result .='<form>';
        $result .= '<textarea name="question_'.$q.'"></textarea><br></form>';
        break;
      case 3:
        $result .= get_question_edit_buttons($questions_url, $view_url, $form_id, $c->ID, $c->question, $c->qtype, false, $q);
        $result .='<form>
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
