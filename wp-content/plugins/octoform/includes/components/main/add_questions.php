<?php
function add_questions( $atts ) {
  global $wpdb;
  $a = shortcode_atts( array('add_url'=>'#', 'questions_url'=>'#', 'view_url'=>'#'), $atts );
  $add_url = esc_attr($a['add_url']);
  $questions_url = esc_attr($a['questions_url']);
  $result = '';

  if (isset($_POST['qtype']) && $_POST['method'] == 'qadd') {
    $result .= '<form action="/'.$add_url.'" method="post">
                          <input type="hidden" name="form_id" value="'.$_POST['form_id'].'">
                          <input type="hidden" name="naam" value="'.$_POST['naam'].'">
                          <input type="submit" name="submit" value="Terug">
                        </form><br><br>';
    switch ($_POST['qtype']) {
      case 0:
        $result .= list_question_choice($add_url, $view_url);
        break;
      case 1:
        $result .= list_question_multiple($add_url, $view_url);
        break;
      case 2:
        $result .= list_question_open($add_url, $view_url);
        break;
      case 3:
        $result .= list_question_location($add_url, $view_url);
        break;
      case 4:
        $result .= list_question_intro($add_url, $view_url);
        break;
      default:
        $result .= '<H1>ERROR 400</h1><h2>Woops, ga naar de hoofdpagina en probeer opnieuw.</h2>';
        break;
    }
  } elseif (isset($_POST['qtype']) && $_POST['method'] == 'qupdate') {
    $result .= '<form action="/'.$add_url.'" method="post">
                          <input type="hidden" name="form_id" value="'.$_POST['form_id'].'">
                          <input type="hidden" name="naam" value="'.$_POST['naam'].'">
                          <input type="submit" name="submit" value="Terug">
                        </form><br><br>';
    switch ($_POST['qtype']) {
      case 0:
        $result .= update_question_choice($add_url, $_POST['question_id']);
        break;
      case 1:
        $result .= update_question_multiple($add_url, $_POST['question_id']);
        break;
      case 2:
        $result .= update_question_open($add_url, $_POST['question_id']);
        break;
      case 3:
        $result .= update_question_location($add_url, $_POST['question_id']);
        break;
      case 4:
        $result .= update_question_intro($add_url);
        break;
      default:
        $result .= '<H1>ERROR 400</h1><h2>Woops, ga naar de hoofdpagina en probeer opnieuw.</h2>';
        break;
    }
  }

  return $result;
}
add_shortcode('addquestions', 'add_questions');
