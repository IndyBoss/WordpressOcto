<?php
function update_question_intro($a) {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT * FROM `wp_forms` WHERE ID=" . $_POST['form_id']);

  $result = '<form action="/'. $a .'" method="post">
              <label for="intro"><b>Introtext</b></label>
              <textarea type="text" placeholder="Introtext" name="intro" required>';

  if (isset($conn[0]->intro)) {
    $result .=$conn[0]->intro;
  }

  $result .= '</textarea><br>
              <input type="hidden" name="qtype" value="4">
              <input type="hidden" name="method" value="qupdate">
              <input type="hidden" name="question_id" value="'.$qid.'">
              <input type="hidden" name="form_id" value="'.$_POST['form_id'].'">
              <input type="hidden" name="naam" value="'.$_POST['naam'].'">
              <input type="hidden" name="alert" value="Intro aangepast.">
              <input type="submit" name="submit" value="Aanpassen">
            </form>';

  $result .= '<p>(Voor vet gedrukte text, plaats <b>' .htmlspecialchars('<b>').'</b>text<b>'.htmlspecialchars('</b>').'</b> rond de text.)</p>';

  return $result;
}
