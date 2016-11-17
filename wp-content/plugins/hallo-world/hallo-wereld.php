<?php
   /*
      Plugin Name: Hallo Wereld
      Version: 1.0
      Author: Arjan de Ruijter
      Author URI: https://arjanderuijter.nl
      Description: Deze plugin doet niets anders dan hallo wereld afbeelden op een pagina
      Text Domain: hallo-wereld.nl
   */

   function show_hallo_wereld()
   {
      echo "Hallo wereld, dit is mijn eerste plugin in wordpress.";
   }


   add_shortcode('hallo_world', 'show_hallo_wereld');
?>