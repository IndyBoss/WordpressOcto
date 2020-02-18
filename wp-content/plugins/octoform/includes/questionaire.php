<?php
function questionaire_show( $atts ) {
  if (isset($_GET['q'])) {
    $a = shortcode_atts( array('questionaire_submit_url'=>'#'), $atts );
  	$questionaire_submit_url = esc_attr($a['questionaire_submit_url']);
    global $wpdb;
    $f = $wpdb->get_results("SELECT * FROM `wp_forms` WHERE link='" . $_GET['q'] . "'");
    $conn = $wpdb->get_results("SELECT * FROM `wp_question` WHERE form_id=" . $f[0]->ID);
    $q = 1;

    $result = '<h1>'.$f[0]->name.'</h1><br><h3>Intro</h3>';

    $resultArray = explode("\n", $f[0]->intro);
    foreach ($resultArray as $r) {
      if ($r != '') {
        $result .= '<p>'.$r.'</p>';
      }
    }

    $result .= '<br><h3>Vragen</h3>
    <form action="/'.$questionaire_submit_url.'" method="post">';

    if ($conn[0]->ID == '') {
      $result .= '<p>Nog geen vragen in dit formulier.</p>';
    }

    foreach ($conn as $c) {
      $result .= '<br><h5 style="margin-bottom:0;">'. $q . '. ' . $c->question .'</h5>';
      switch ($c->qtype) {
        case 0:
          $pieces = explode("|", $c->text);
          for ($i=1; $i <= $c->parts; $i++) {
            $result .= '<input type="radio" name="question_'.$q.'" value="'.$pieces[$i].'" style="margin-left:40px;" required> '.$pieces[$i].'<br>';
          }
          break;
        case 1:
          $pieces = explode("|", $c->text);
          for ($i=1; $i <= $c->parts; $i++) {
            $result .= '<input type="checkbox" name="question_'.$q.'_'.$i.'" value="'.$pieces[$i].'" style="margin-left:40px;"> '.$pieces[$i].'<br>';
          }
          break;
        case 2:
          $result .= '<textarea name="question_'.$q.'" style="margin-left:40px;" required></textarea><br>';
          break;
        case 3:
          $result .='
          <label for="naam" style="margin-left:40px;"><b>Plaatsnaam</b></label>
          <input type="text" placeholder="Kruispunt, oversteekplaats, ..." name="question_'.$q.'_1" style="margin-left:40px;" required><br>
          <label for="straat" style="margin-left:40px;"><b>Straatnaam & nummer</b></label>
          <input type="text" placeholder="Straat 1" name="question_'.$q.'_2" style="margin-left:40px;" required><br>
          <label for="gemeente" style="margin-left:40px;"><b>Gemeente & gemeentecode</b></label>
          <input type="text" placeholder="Gemeente 0001" name="question_'.$q.'_3" style="margin-left:40px;" required><br>
          <label for="beschrijving" style="margin-left:40px;"><b>Beschrijving</b></label>
          <textarea type="text" placeholder="Een gevaarlijk kruispunt ter hoogte van Straat 1 in Gemeente, ..." name="question_'.$q.'_4" style="margin-left:40px;" required></textarea><br>';
          break;
      }
      $q ++;
    }
    $result .= '<br><input type="hidden" name="form_id" value="'.$f[0]->ID.'"><input type="submit" name="submit" value="Versturen"></form>';

  } else {
    $result = "<h3>Geen geldig formulier opgegeven.</h3>";
  }


	return $result;
}
add_shortcode('questionaire', 'questionaire_show');
