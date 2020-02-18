<?php

function get_question_edit_buttons($questions_url, $add_url, $form_id, $question_id, $question, $question_type, $update, $counter) {
  $result = '<br><br>
  <div style="
  display:grid;
  grid-column-gap:10px;
  justify-content:left;
  grid-template-columns:auto auto auto;
  grid-template-rows:auto;
  ">';

  $result .= '
  <form action="/'. $questions_url .'" method="post">
    <input type="hidden" name="method" value="qupdate">
    <input type="hidden" name="question_id" value="'.$question_id.'">
    <input type="hidden" name="form_id" value="'.$form_id.'">
    <input type="hidden" name="naam" value="'.$_POST['naam'].'">
    <input type="hidden" name="qtype" value="'.$question_type.'">
    <input type="submit" value="&#9998;" style="font-size:20px; height:30px; width:30px; padding:0px;">
  </form>
  <form action="/'.$add_url.'" method="post">
    <input type="hidden" name="method" value="qdelete">
    <input type="hidden" name="question_id" value="'.$question_id.'">
    <input type="hidden" name="form_id" value="'.$form_id.'">
    <input type="hidden" name="naam" value="'.$_POST['naam'].'">
    <input type="hidden" name="qtype" value="'.$question_type.'">
    <input type="hidden" name="alert" value="Vraag verwijderd.">
    <input type="submit" class="del" value="&#10006;" style="font-size:20px; height:30px; width:30px; padding:0px;">
  </form>';

  $result .= '<h5 style="margin-bottom:0;">'. $counter . '. ' . $question .'</h5></div>';

  return $result;
}
