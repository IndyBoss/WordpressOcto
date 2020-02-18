<?php
function add_form( $atts ) {
  global $wpdb;
  $a = shortcode_atts( array('add_url'=>'#', 'questions_url'=>'#', 'view_url'=>'#'), $atts );
  $add_url = esc_attr($a['add_url']);
  $view_url = esc_attr($a['view_url']);
  $questions_url = esc_attr($a['questions_url']);
  $g_id = get_groupid();
  $form_gid = get_form_group_id();
  $result = '';


  // ALERTS ON PAGE
  $result .= get_alerts();

  // ADDING AND EDITING FORM
  if (isset($_POST['method'])) {
    if (isset($_POST['group'])) {$gid = $_POST['group'];} else {$gid = $g_id;}
    if ($_POST['method'] == 'add') {
      $wpdb->insert('wp_forms', array(
        'name' => $_POST['naam'],
        'group_id' => $gid,
        'data_id' => '',
        'link' => uniqid()
      ));
      $result .= get_form_question_buttons($questions_url, get_form_id(), $view_url) . '<form action="/'.$add_url.'" method="post">
                            <label for="naam"><b>Formulier naam</b></label>
                            <input type="text" placeholder="Naam" name="naam" value="'.$_POST['naam'].'" required>
                            '.get_admin_groups($form_gid).'

                            <input type="hidden" name="form_id" value="'.get_form_id().'">
                            <input type="hidden" name="method" value="update">
                            <input type="hidden" name="alert" value="wijzigingen opgeslagen.">
                            <input type="submit" name="submit" value="Sla wijzigingen op">
                          </form>';
      $result .= get_form_questions($add_url,  get_form_id(), $questions_url);
    }
    if ($_POST['method'] == 'update') {
      if (isset($_POST['group'])) {$wpdb->update('wp_forms', array('name'=> $_POST['naam'], 'group_id'=>$_POST['group']), array('id'=> $_POST['form_id']));}
      $wpdb->update('wp_forms', array('name'=> $_POST['naam']), array('id'=> $_POST['form_id']));
      $result = $result. get_form_namechange(get_created_form_group_id(), $questions_url, $_POST['naam'], $view_url);
      $result .= get_form_questions($add_url,  $_POST['form_id'], $questions_url);
    }
    if ($_POST['method'] == 'qadd') {
      $text = '';
      $parts = 0;
      switch ($_POST['qtype']) {
        case 0:
          for ($i=1; $i < 16; $i++) {
            $postName = 'choice_' . $i;
            if ($_POST[$postName] != '') {
              $parts ++;
              $text = $text . '|' . $_POST[$postName];
            }
          }
          $wpdb->insert('wp_question', array(
            'question' => $_POST['question'],
            'text' => $text,
            'parts' => $parts,
            'qtype' => $_POST['qtype'],
            'form_id' => $_POST['form_id']
          ));
          break;
        case 1:
          for ($i=1; $i < 16; $i++) {
            $postName = 'multiple_' . $i;
            if ($_POST[$postName] != '') {
              $parts ++;
              $text = $text . '|' . $_POST[$postName];
            }
          }
          $wpdb->insert('wp_question', array(
            'question' => $_POST['question'],
            'text' => $text,
            'parts' => $parts,
            'qtype' => $_POST['qtype'],
            'form_id' => $_POST['form_id']
          ));
          break;
        case 2:
          $wpdb->insert('wp_question', array(
            'question' => $_POST['question'],
            'text' => '',
            'parts' => '1',
            'qtype' => $_POST['qtype'],
            'form_id' => $_POST['form_id']
          ));
          break;
        case 3:
          $wpdb->insert('wp_question', array(
            'question' => $_POST['question'],
            'text' => '',
            'parts' => '1',
            'qtype' => $_POST['qtype'],
            'form_id' => $_POST['form_id']
          ));
          break;
        default:
          "Er liep iets mis.";
          break;
      }
      $result = $result. get_form_namechange($form_gid, $questions_url, $_POST['naam'], $view_url);
      $result .= get_form_questions($add_url,  $_POST['form_id'], $questions_url);
    }
    if ($_POST['method'] == 'qupdate') {
      $text = '';
      $parts = 0;
      switch ($_POST['qtype']) {
        case 0:
          for ($i=1; $i < 16; $i++) {
            $postName = 'choice_' . $i;
            if ($_POST[$postName] != '') {
              $parts ++;
              $text = $text . '|' . $_POST[$postName];
            }
          }
          $wpdb->update('wp_question', array(
            'question' => $_POST['question'],
            'text' => $text,
            'parts' => $parts,
            'qtype' => $_POST['qtype'],
            'form_id' => $_POST['form_id']
          ), array('id'=> $_POST['question_id']));
          break;
        case 1:
          for ($i=1; $i < 16; $i++) {
            $postName = 'multiple_' . $i;
            if ($_POST[$postName] != '') {
              $parts ++;
              $text = $text . '|' . $_POST[$postName];
            }
          }
          $wpdb->update('wp_question', array(
            'question' => $_POST['question'],
            'text' => $text,
            'parts' => $parts,
            'qtype' => $_POST['qtype'],
            'form_id' => $_POST['form_id']
          ), array('id'=> $_POST['question_id']));
          break;
        case 2:
          $wpdb->update('wp_question', array(
            'question' => $_POST['question'],
            'text' => '',
            'parts' => '1',
            'qtype' => $_POST['qtype'],
            'form_id' => $_POST['form_id']
          ), array('id'=> $_POST['question_id']));
          break;
        case 3:
          $wpdb->update('wp_question', array(
            'question' => $_POST['question'],
            'text' => '',
            'parts' => '1',
            'qtype' => $_POST['qtype'],
            'form_id' => $_POST['form_id']
          ), array('id'=> $_POST['question_id']));
          break;
        case 4:
          $wpdb->update('wp_forms', array(
            'name' => $_POST['naam'],
            'group_id' => $gid,
            'data_id' => '',
            'intro' => $_POST['intro']
          ), array('id'=> $_POST['form_id']));
          break;
        default:
          "Er liep iets mis.";
          break;
      }
      $result = $result. get_form_namechange(get_created_form_group_id(), $questions_url, $_POST['naam'], $view_url);
      $result .= get_form_questions($add_url,  $_POST['form_id'], $questions_url);
    }
    if ($_POST['method'] == 'qdelete') {
      $wpdb->delete( 'wp_question', array( 'id' => $_POST['question_id'] ) );
      $result = $result. get_form_namechange($form_gid, $questions_url, $_POST['naam'], $view_url);
      $result .= get_form_questions($add_url,  $_POST['form_id'], $questions_url);
    }
  } elseif (isset($_POST['form_id'])) {
      $conn = $wpdb->get_results("SELECT group_id, name FROM wp_forms WHERE ID = ". $_POST['form_id'] );
      $result .= get_form_question_buttons($questions_url, $_POST['form_id'], $view_url) . '<form action="/'.$add_url.'" method="post">
                            <label for="naam"><b>Formulier naam</b></label>
                            <input type="text" placeholder="Naam" name="naam" value="'.$conn[0]->name.'" required>
                            '. get_admin_groups($conn[0]->group_id) .'

                            <input type="hidden" name="form_id" value="'.$_POST['form_id'].'">
                            <input type="hidden" name="method" value="update">
                            <input type="hidden" name="alert" value="wijzigingen opgeslagen.">
                            <input type="submit" name="submit" value="Sla wijzigingen op">
                          </form>';
      $result .= get_form_questions($add_url,  $_POST['form_id'], $questions_url);
  }

  return $result;
}
add_shortcode('addform', 'add_form');
