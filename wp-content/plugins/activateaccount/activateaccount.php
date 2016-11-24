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
                

         }
         else
         {
            // Matchen ze niet dan moet je opnieuw doorverwezen worden naar de vorige pagina.
               
         }

         

         $sql = "SELECT * FROM `users` WHERE `id` = ".$_POST["id"];
         $result = mysqli_query($conn, $sql);
         $record = mysqli_fetch_array($result, MYSQLI_ASSOC);
      
         if ( $_SESSION["userrole"] == 'admin')
         {
            $old_password = $record["password"];
         }
         else
         {
            $old_password = sha1($_POST["old_password"]);
         }

         if ( strcmp($record["password"], $old_password) == 0)
         {
            $sql = "UPDATE `users` 
                    SET `password` = '".sha1($_POST["password"])."'
                    WHERE `id` = ".$_POST["id"];

            $result = mysqli_query($conn, $sql);
 
            if ($result)
            {
               echo "Uw password is succesvol gewijzigd";
               header("Refresh: 3; url=index.php?content=login_form");
            }
            else
            {
               echo "Er is iets mis gegaan. Probeer opnieuw";
               header("Refresh: 3; url=index.php?content=change_password");
            }
         }
         else
         {
               echo "Uw oude password klopt niet. Probeer het opnieuw";
               header("Refresh: 4; url=index.php?content=change_password&id=".$_POST["id"]);
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
                         <input type='hidden' name='pw' value='".$_GET["pw"]."'>
                        </form>";
            return $form;
         }
      }
   }

   add_shortcode("activateaccount", "activateaccount");
?>