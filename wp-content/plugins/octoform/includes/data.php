<?php
function data() {
	global $wpdb;
	$result = '';

  $f = $wpdb->get_results("SELECT * FROM `wp_forms` WHERE ID='" . $_POST['form_id'] . "'");
  $conn = $wpdb->get_results("SELECT * FROM `wp_question` WHERE form_id=" . $f[0]->ID);
  $count = 1;


  $result = '<div><h1>'.$f[0]->name.'</h1>';

  if ($conn[0]->ID == '') {
    $result .= '<p>Nog geen vragen in dit formulier.</p>';
  }

  foreach ($conn as $c) {
    switch ($c->qtype) {
      case 0:
        $totalChoice = 0;
        $qtotal = array();
        $qanswer = $wpdb->get_results("SELECT * FROM `wp_question_results_choice` WHERE form_id=" . $f[0]->ID . " AND question_id=" . $c->ID);
        foreach ($qanswer as $qa) {
            $totalChoice += 1;
        }
        $result .= '<br><h5 style="margin-bottom:0;">('.$totalChoice.' antwoorden) '. $count . '. ' . $c->question .'</h5>';

        $result .= '<ul>';
        $pieces = explode("|", $c->text);
        for ($i=1; $i <= $c->parts; $i++) {
          foreach ($qanswer as $qa) {
            if ($qa->answer == $pieces[$i]) {
              $qtotal[$i] += 1;
            } else {$qtotal[$i] += 0;}
          }
          $perc = number_format(($qtotal[$i] / $totalChoice) * 100, 2, ',', ''); ;
          $result .= '<li style="margin-left:40px;"><b>'. $perc .'% ('.$qtotal[$i].')'.'</b> ' . $pieces[$i];
        }
        $result .= '</ul>';
        break;
      case 1:
        $totalMultiple = 0;
        $qanswer = $wpdb->get_results("SELECT * FROM `wp_question_results_multiple` WHERE form_id=" . $f[0]->ID . " AND question_id=" . $c->ID);
        foreach ($qanswer as $qa) {
          $p = explode("|", $qa->answer);
          for ($i=1; $i < count($p); $i++) {
            $totalMultiple += 1;
          }
        }
        $result .= '<br><h5 style="margin-bottom:0;">('.$totalMultiple.' antwoorden) '. $count . '. ' . $c->question .'</h5>';

        $result .= '<ul>';
        $pieces = explode("|", $c->text);
        for ($i=1; $i <= $c->parts; $i++) {
          $qtotal = array();
          foreach ($qanswer as $qa) {
            $p = explode("|", $qa->answer);
            for ($j=1; $j < count($p); $j++) {
              if ($p[$j] == $pieces[$i]) {
                $qtotal[$i] += 1;
              } else {$qtotal[$i] += 0;}
            }
          }

          $perc = number_format(($qtotal[$i] / $totalMultiple) * 100, 2, ',', ''); ;
          $result .= '<li style="margin-left:40px;list-style-type:square;"><b>'. $perc .'% ('.$qtotal[$i].')'.'</b> ' . $pieces[$i];
        }
        $result .= '</ul>';
        break;
      case 2:
        $result .= '<textarea name="question_'.$q.'" style="margin-left:40px;" required></textarea><br>';
        break;
    }
    $count ++;
  }
  $result .= '<br>';

  $result .= get_form_map();

	return $result;
}
add_shortcode('data', 'data');
