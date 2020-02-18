<?php

function update_question_choice($a, $qid) {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT * FROM `wp_question` WHERE ID=" . $qid);
  $pieces = explode("|", $conn[0]->text);


  $result = '<form action="/'. $a .'" method="post">
              <label for="question"><b>Vraag</b></label>
              <input type="text" placeholder="Vraag" name="question" ';

  if (isset($conn[0]->question)) {
    $result .= 'value="'.$conn[0]->question.'"';
  }

  $result .= ' required><br>';

  for ($i=1; $i < 16; $i++) {
    $result .=
    '<label for="choice_'.$i.'"  class="choiceLabel" ';
    if (isset($pieces[$i])) {
      $result .='style="display:block"';
    } else {
      if ($i != 1) {$result .='style="display:none"';}
    }

    $result .='><b>Keuze ' .$i.'</b></label><input type="text" placeholder="Keuze" name="choice_'.$i.'" class="choiceText" ';
    if (isset($pieces[$i])) {
      $res = 'value="'.$pieces[$i].'" style="display:block"';
    } else {
      if ($i != 1) {$result .='style="display:none"';}
      $res = '';
    }
    $result .= $res .'>';
  }

  $result .= '<br><a class="choiceBtn"><svg height="25pt" viewBox="0 0 512 512" width="25pt"><path d="m256 0c-141.164062 0-256 114.835938-256 256s114.835938 256 256 256 256-114.835938 256-256-114.835938-256-256-256zm112 277.332031h-90.667969v90.667969c0 11.777344-9.554687 21.332031-21.332031 21.332031s-21.332031-9.554687-21.332031-21.332031v-90.667969h-90.667969c-11.777344 0-21.332031-9.554687-21.332031-21.332031s9.554687-21.332031 21.332031-21.332031h90.667969v-90.667969c0-11.777344 9.554687-21.332031 21.332031-21.332031s21.332031 9.554687 21.332031 21.332031v90.667969h90.667969c11.777344 0 21.332031 9.554687 21.332031 21.332031s-9.554687 21.332031-21.332031 21.332031zm0 0"/></svg></a><br><br>';


  $result .=
  '<script>
      var text = document.getElementsByClassName("choiceText");
      var label = document.getElementsByClassName("choiceLabel");
      var btn = document.getElementsByClassName("choiceBtn");
      var i = '.$conn[0]->parts.';

      btn[0].addEventListener("click", function() {
        text[i].style.display = "block";
        label[i].style.display = "block";
        if (i == 14) {
          btn[0].style.display = "none";
        }
        i++
      });

  </script>';

  $result .='<input type="hidden" name="qtype" value="0">
              <input type="hidden" name="method" value="qupdate">
              <input type="hidden" name="question_id" value="'.$qid.'">
              <input type="hidden" name="form_id" value="'.$_POST['form_id'].'">
              <input type="hidden" name="naam" value="'.$_POST['naam'].'">
              <input type="hidden" name="alert" value="Keuzevraag aangepast.">
              <input type="submit" name="submit" value="Aanpassen">
            </form>';

  return $result;
}
