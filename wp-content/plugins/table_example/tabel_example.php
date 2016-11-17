<?php
   /*
      Plugin Name: Voorbeeld Tabel
      Version: 1.0
      Author: Arjan de Ruijter
      Author URI: https://arjanderuijter.nl
      Description: Deze plugin zet een tabel op het scherm
      Text Domain: table-example.nl
   */


   function show_table_example()
   {
      $table  = "<table id='example'>";
      $table .= "<tr><th>nr:</th><th>voornaam</th><th>tussenvoegsel</th><th>achternaam</th></tr>";
      $table .= "<tr><td>1</td><td>Arjan</td><td>de</td><td>Ruijter</td></tr>";
      $table .= "<tr><td>2</td><td>Sjors</td><td>van</td><td>Raven</td></tr>";
      $table .= "<tr><td>3</td><td>Harry</td><td></td><td>Tol</td></tr>";
      $table .= "<tr><td>4</td><td>Bert</td><td>den</td><td>Dolder</td></tr>";
      $table .= "<tr><td>5</td><td>Ditk-Jan</td><td>van de</td><td>Broek</td></tr>";
      $table .= "</table>";
      return $table;
   }

   add_shortcode("table_example", "show_table_example");
?>