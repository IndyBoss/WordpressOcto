<?php
function get_alerts() {
  if (isset($_POST['alert'])) {
    $color = '#13aff0';
    if (isset($_POST['alert_color'])) {$color = $_POST['alert_color'];}
    $result = '<div class="alert" style="padding: 20px;background-color: '.$color.';color: white;margin-bottom: 15px;"><span class="closebtn" style="margin-left: 15px;color: white;font-weight: bold;float: right;font-size: 22px;line-height: 20px;cursor: pointer;transition: 0.3s;">&times;</span>'.$_POST['alert'].'</div><script>var close = document.getElementsByClassName("closebtn");var i;for (i = 0; i < close.length; i++) {close[i].onclick = function(){var div = this.parentElement;div.style.opacity = "0";setTimeout(function(){ div.style.display = "none"; }, 600);}}</script>';
  }
  return $result;
}
