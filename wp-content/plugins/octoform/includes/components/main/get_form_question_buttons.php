<?php

function get_form_question_buttons($questions_url, $form_id, $view_url) {
  $result = '
  <div style="display: grid;grid-column-gap: 10px;grid-row-gap: 15px;justify-content: right;grid-template-columns: auto auto auto auto auto;grid-template-rows: auto;margin-bottom: 15px;">
    <form action="/'. $questions_url .'" method="post">
      <input type="hidden" name="qtype" value="0">
      <input type="hidden" name="method" value="qadd">
      <input type="hidden" name="form_id" value="'.$form_id.'">
      <input type="hidden" name="naam" value="'.$_POST['naam'].'">
      <input type="submit" value="+ Keuzevraag">
    </form>
    <form action="/'. $questions_url .'" method="post">
      <input type="hidden" name="qtype" value="1">
      <input type="hidden" name="method" value="qadd">
      <input type="hidden" name="form_id" value="'.$form_id.'">
      <input type="hidden" name="naam" value="'.$_POST['naam'].'">
      <input type="submit" value="+ Multiple choice">
    </form>
    <form action="/'. $questions_url .'" method="post">
      <input type="hidden" name="qtype" value="2">
      <input type="hidden" name="method" value="qadd">
      <input type="hidden" name="form_id" value="'.$form_id.'">
      <input type="hidden" name="naam" value="'.$_POST['naam'].'">
      <input type="submit" value="+ Open vraag">
    </form>
    <form action="/'. $questions_url .'" method="post">
      <input type="hidden" name="qtype" value="3">
      <input type="hidden" name="method" value="qadd">
      <input type="hidden" name="form_id" value="'.$form_id.'">
      <input type="hidden" name="naam" value="'.$_POST['naam'].'">
      <input type="submit" value="+ locatie">
    </form>
    <form action="/'.$view_url.'" method="post">
      <input type="hidden" name="method" value="delete">
      <input type="hidden" name="form_id" value="'.$form_id.'">
      <input type="hidden" name="naam" value="'.$_POST['naam'].'">
      <input type="hidden" name="alert" value="Formulier verwijderd.">
      <input type="submit" class="del" value="Verwijder formulier">
    </form>
  </div>';

  return $result;
}
