<?php
function update_question_open($a, $qid) {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT * FROM `wp_question` WHERE ID=" . $qid);

  $result = '<form action="/'. $a .'" method="post">
              <label for="question"><b>Vraag</b></label>
              <input type="text" placeholder="Vraag" name="question"';

  if (isset($conn[0]->question)) {
    $result = $result . 'value="'.$conn[0]->question.'"';
  }

  $result = $result . ' required><br>
              <input type="hidden" name="qtype" value="2">
              <input type="hidden" name="method" value="qupdate">
              <input type="hidden" name="question_id" value="'.$qid.'">
              <input type="hidden" name="form_id" value="'.$_POST['form_id'].'">
              <input type="hidden" name="naam" value="'.$_POST['naam'].'">
              <input type="hidden" name="alert" value="Open vraag aangepast.">
              <input type="submit" name="submit" value="Aanpassen">
            </form>';

  return $result;
}
