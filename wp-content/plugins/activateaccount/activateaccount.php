<?php
    /*
      Plugin Name: Activate account
      Version: 1.0
      Author: Arjan de Ruijter
      Author URI: https://arjanderuijter.nl
      Description: Deze plugin activates an account and changes the password.
      Text Domain: arjanderuijter.nl/plugins/activateaccount
   */
   
   function activateaccount()
   {     
      if ( isset($_POST["submit"]))
      {
         // Matchen de twee ingevulde passwords. 
         if (strcmp($_POST["password"], $_POST["controle_password"]) == 0)
         {
               // Als ze matchen dan updaten passwords.
               wp_set_password($_POST["password"], $_POST["id"]);

               // Doorsturen naar de login_page
               header("Refresh: 2; url=http://localhost/2016-2017/am1a/groenten/wp-login.php");             
               return "Uw wachtwoord is gewijzigd.";
         }
         else
         {
               header("Refresh: 2; url=http://localhost/2016-2017/am1a/groenten/index.php/activeer-uw-account/?id=".
                                          $_POST["id"]."&pw=".$_POST["old_pw"]);
               return "De ingevoerde wachtwoorden zijn verschillend, probeer het nogmaals.";
         }
      }

      if ( isset($_GET["id"]))
      {
         // Selecteer het record op basis van een id
         $user = get_user_by("ID", $_GET["id"] );

         if ( strcmp($_GET["pw"], $user->data->user_pass) == 0)
         {
            $form = "";
            $form .=  "<form action='".$_SERVER['REQUEST_URI']."' method='post'>
                           <table>
                              <tr>
                                    <td>wachtwoord: </td>
                                    <td><input type='password' name='password'></td>
                              </tr>
                              <tr>
                                    <td>type nogmaals wachtwoord: </td>
                                    <td><input type='password' name='controle_password'> </td>
                              </tr>
                              <tr>
                                    <td></td>
                                    <td><input type='submit' name='submit' value='wijzig wachtwoord!'></td>
                              </tr>
                          </table>
                         <input type='hidden' name='id' value='".$_GET["id"]."'>
                         <input type='hidden' name='old_pw' value='".$_GET["pw"]."'>
                        </form>";
            return $form;
         }
      }
   }

   add_shortcode("activateaccount", "activateaccount");
?>