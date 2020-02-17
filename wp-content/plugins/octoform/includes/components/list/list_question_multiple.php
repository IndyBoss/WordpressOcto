<?php

function list_question_multiple($a) {
  $result = '<form action="/'. $a .'" method="post">
              <label for="question"><b>Vraag</b></label>
              <input type="text" placeholder="Vraag" name="question" required><br>';

  for ($i=1; $i < 16; $i++) {
    $result = $result .
    '<label for="multiple_'.$i.'"  class="multipleLabel" ';
    if ($i != 1) {$result = $result .'style="display:none"';}
    $result = $result . '><b>Keuze '.$i.'</b></label>' .

    '<input type="text" placeholder="Keuze" name="multiple_'.$i.'" class="multipleText" ';
    if ($i != 1) {$result = $result .'style="display:none"';}
    $result = $result .'>';
  }
  $result = $result . '<br><a class="multipleBtn"><svg height="25pt" viewBox="0 0 512 512" width="25pt"><path d="m256 0c-141.164062 0-256 114.835938-256 256s114.835938 256 256 256 256-114.835938 256-256-114.835938-256-256-256zm112 277.332031h-90.667969v90.667969c0 11.777344-9.554687 21.332031-21.332031 21.332031s-21.332031-9.554687-21.332031-21.332031v-90.667969h-90.667969c-11.777344 0-21.332031-9.554687-21.332031-21.332031s9.554687-21.332031 21.332031-21.332031h90.667969v-90.667969c0-11.777344 9.554687-21.332031 21.332031-21.332031s21.332031 9.554687 21.332031 21.332031v90.667969h90.667969c11.777344 0 21.332031 9.554687 21.332031 21.332031s-9.554687 21.332031-21.332031 21.332031zm0 0"/></svg></a><br><br>';


  $result = $result .
  '<script>
      var text = document.getElementsByClassName("multipleText");
      var label = document.getElementsByClassName("multipleLabel");
      var btn = document.getElementsByClassName("multipleBtn");
      var i = 1;

      btn[0].addEventListener("click", function() {
        text[i].style.display = "block";
        label[i].style.display = "block";
        if (i == 14) {
          btn[0].style.display = "none";
        }
        i++
      });

  </script>';

  $result = $result .'<input type="hidden" name="qtype" value="1">
              <input type="hidden" name="method" value="qadd">
              <input type="hidden" name="form_id" value="'.$_POST['form_id'].'">
              <input type="hidden" name="naam" value="'.$_POST['naam'].'">
              <input type="hidden" name="alert" value="Multiple-choice vraag toegevoegd.">
              <input type="submit" name="submit" value="Toevoegen">
            </form>';

  return $result;
}
