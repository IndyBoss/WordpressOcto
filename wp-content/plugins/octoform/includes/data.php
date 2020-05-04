<?php
function data() {
	global $wpdb;
	$result = '';
	$charts = "";
	$legend_list .= "";

	$choiceQ="";
	$multipleQ="";
	$openQ="";
	$locationQ="";

  $f = $wpdb->get_results("SELECT * FROM `wp_forms` WHERE ID='" . $_POST['form_id'] . "'");
  $conn = $wpdb->get_results("SELECT * FROM `wp_question` WHERE form_id=" . $f[0]->ID);
  $count = 1;

  $result = '<div><h1>'.$f[0]->name.'</h1>';

  $result = '<button id="export">Exporteren</button>';

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

				$choiceQ .= "
				<tr>
					<td>".$c->question."</td>
					<td></td>
				</tr>";

        $pieces = explode("|", $c->text);
        for ($i=1; $i <= $c->parts; $i++) {
          foreach ($qanswer as $qa) {
            if ($qa->answer == $pieces[$i]) {
              $qtotal[$i] += 1;
            } else {$qtotal[$i] += 0;}
          }
					$perc = number_format(($qtotal[$i] / $totalChoice) * 100, 2, ',', '');
					$choiceQ .= "
					<tr>
						<td></td>
						<td>".$pieces[$i]. " (".$perc."%)</td>
					</tr>";

					$charts .= ',["' . $pieces[$i] . '",'. str_replace(",", ".", $qtotal[$i]) .']';
        }
        $result .= '</ul></br>
				<div id="chart_'.$count.'"></div>
				<script>
				      google.charts.load("current", {"packages":["corechart"]});
				      google.charts.setOnLoadCallback(drawChart);

				      function drawChart() {

				        var data = google.visualization.arrayToDataTable([
				          ["Task", "Hours per Day"]'.$charts.'
				        ]);

				        var options = {};

				        var chart = new google.visualization.PieChart(document.getElementById("chart_'.$count.'"));

				        chart.draw(data, options);
				      }
				</script>';
				$charts = "";
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

				$multipleQ .= "
				<tr>
					<td>".$c->question."</td>
					<td></td>
				</tr>";

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
          $perc = number_format(($qtotal[$i] / $totalMultiple) * 100, 2, ',', '');
					$charts .= ',["' . $pieces[$i] . '(' . $perc . '%)",'. $qtotal[$i] .']';
					$multipleQ .= "
					<tr>
						<td></td>
						<td>".$pieces[$i]. " (".$perc."% / ".$qtotal[$i]." keuzes)</td>
					</tr>";
        }
        $result .= '</ul></br>
				<div id="chart_'.$count.'"></div>
				<script>
				      google.charts.load("current", {"packages":["bar"]});
				      google.charts.setOnLoadCallback(drawChart);

				      function drawChart() {

				        var data = google.visualization.arrayToDataTable([
				          ["Antwoorden", "Antwoorden"]'.$charts.'
				        ]);

				        var options = {
									legend: { position: "none" }
								};
								var chart = new google.charts.Bar(document.getElementById("chart_'.$count.'"));

				        chart.draw(data, options);
				      }
				</script>';
				$charts = "";
        break;
      case 2:
				$totalMultiple = 0;
				$qanswer = $wpdb->get_results("SELECT * FROM `wp_question_results_open` WHERE form_id=" . $f[0]->ID . " AND question_id=" . $c->ID);
				foreach ($qanswer as $qa) {
					$totalMultiple += 1;
				}
				$result .= '<br><h5 style="margin-bottom:0;">('.$totalMultiple.' antwoorden) '. $count . '. ' . $c->question .'</h5><ul>';

				$openQ .= "
				<tr>
					<td>".$c->question."</td>
					<td></td>
				</tr>";

				$pieces = explode("|", $c->text);
				for ($i=1; $i <= $c->parts; $i++) {
					$qtotal = array();
					foreach ($qanswer as $qa) {
						$result .= '<li>'.$qa->answer.'</li>';
						$openQ .= "
						<tr>
							<td></td>
							<td>".$qa->answer."</td>
						</tr>";
					}
					$result .= '</ul>';
				}
        break;
			case 3:
				$qanswer = $wpdb->get_results("SELECT * FROM `wp_markers` WHERE form_id=" . $f[0]->ID . " AND question_id=" . $c->ID);
				$locationQ .= "
				<tr>
					<td>".$c->question."</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>";
				foreach ($qanswer as $qa) {
					$locationQ .= "
					<tr>
						<td></td>
						<td>".$qa->name."</td>
						<td>".$qa->location."</td>
						<td>".$qa->description."</td>
						<td>".$qa->lat."</td>
						<td>".$qa->lng."</td>
					</tr>";
				}
				break;
    }
    $count ++;
  }
  $result .= '<br>';

  $result .= get_form_map();

	$result .= "<table id='myTable' style='display:none'>" .
	"<tr>
		<th><b>Keuzenvragen</b></th>
		<th><b>Antwoord</b></th>
	</tr>"
	.$choiceQ .
	"<tr><td></td><td></td></tr>
	<tr>
		<th><b>Meerkeuze vragen</b></th>
		<th><b>Antwoord</b></th>
	</tr>"
	.$multipleQ.
	"<tr><td></td><td></td></tr>
	<tr>
		<th><b>Open vragen</b></th>
		<th><b>Antwoord</b></th>
	</tr>"
	.$openQ.
	"<tr><td></td><td></td></tr>
	<tr>
		<th><b>Locatie vraag</b></th>
		<th><b>Naam</b></th>
		<th><b>Locatie</b></th>
		<th><b>Beschrijving</b></th>
		<th><b>lat</b></th>
		<th><b>long</b></th>
	</tr>"
	.$locationQ."</table>";

	return $result;
}
add_shortcode('data', 'data');

?>
