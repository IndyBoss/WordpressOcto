<?php

function list_question_location($a) {
  $result = '<form action="/'. $a .'" method="post">
              <label for="question"><b>Vraag</b></label>
              <input type="text" placeholder="Vraag" name="question" required><br>
              <input type="hidden" name="form_id" value="'.$_POST['form_id'].'">
              <input type="hidden" name="naam" value="'.$_POST['naam'].'">
              <input type="hidden" name="qtype" value="3">
              <input type="hidden" name="method" value="qadd">
              <input type="hidden" name="alert" value="Locatie toegevoegd.">
              <input type="submit" name="submit" value="Toevoegen">
            </form>';

  return $result;
}
