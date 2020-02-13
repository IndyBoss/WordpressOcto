<?php

function popup($a) {
  $result = '<button type="submit" id="dropBtn" onclick="openForm()">Formulier toevoegen +</button>

  <div class="form-popup" id="myForm" style="display: none;z-index: 9;padding: 15px;background-color:#f5F5F5;">
    <form action="/'. $a .'" method="post">
      <label for="name"><b>Naam</b></label>
      <input type="hidden" name="method" value="add">
      <input type="hidden" name="alert" value="Formulier aangemaakt!">
      <input type="text" placeholder="Naam" name="naam" required>'.get_admin_groups(1).'
      <input type="submit" name="submit" value="Toevoegen">
    </form>
  </div>
  <script>
    function openForm() {
      if (document.getElementById("myForm").style.display == "block") {
        document.getElementById("myForm").style.display = "none";
        document.getElementById("dropBtn").innerHTML = "Formulier toevoegen +";
      } else {
        document.getElementById("myForm").style.display = "block";
        document.getElementById("dropBtn").innerHTML = "Formulier toevoegen - ";
      }
    }
  </script>';

  return $result;
}
