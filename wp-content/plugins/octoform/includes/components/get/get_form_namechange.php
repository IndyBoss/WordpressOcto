<?php

function get_form_namechange($g, $questions_url, $name, $view_url) {
  $result = get_form_question_buttons($questions_url, $_POST['form_id'], $view_url) .
  '<form action="" method="post">
    <label for="naam"><b>Formulier naam</b></label>
    <input type="text" placeholder="Naam" name="naam" value="'.$name.'" required>
    '.get_admin_groups($g).'

    <input type="hidden" name="form_id" value="'.$_POST['form_id'].'">
    <input type="hidden" name="method" value="update">
    <input type="hidden" name="alert" value="wijzigingen opgeslagen.">
    <input type="submit" name="submit" value="Sla wijzigingen op">
  </form>';

  return $result;
}
