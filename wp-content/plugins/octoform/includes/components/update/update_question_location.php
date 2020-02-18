<?php

function update_question_location($a, $qid) {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT * FROM `wp_question` WHERE ID=" . $qid);


  $result = '<form action="/'. $a .'" method="post">
              <label for="question"><b>Vraag</b></label>
              <input type="text" placeholder="Vraag" name="question"';

  if (isset($conn[0]->question)) {
    $result .= 'value="'.$conn[0]->question.'"';
  }

  $result .= ' required><br>
              <input type="hidden" name="question_id" value="'.$qid.'">
              <input type="hidden" name="form_id" value="'.$_POST['form_id'].'">
              <input type="hidden" name="naam" value="'.$_POST['naam'].'">
              <input type="hidden" name="qtype" value="3">
              <input type="hidden" name="method" value="qupdate">
              <input type="hidden" name="alert" value="Locatie aangepast.">
              <input type="submit" name="submit" value="Aanpassen">
            </form>';

  return $result;
}
