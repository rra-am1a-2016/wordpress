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
         $sql = "SELECT * FROM `users` WHERE `id` = ".$_GET["id"];

         // Vuur de query af op de database
         $result = mysqli_query($conn, $sql);

         $record = mysqli_fetch_array($result, MYSQLI_ASSOC);

         var_dump($record);
         $formtekst = "";
         $formtekst .=  "<form action='index.php?content=change_password' method='post'>
                           <table>
                            <tr>
                               <td>oude wachtwoord: </td>
                               <td><input type='password' name='old_password' ";
                           
                               if ($_SESSION['userrole'] == 'admin') 
                               { 
                                  $formtekst .= "placeholder='Als admin niet invullen' ";
                                  $formtekst .= "readonly";

                               } 
                           
                                  $formtekst .= "></td>
                           </tr>
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
                  </form>";
         echo $formtekst;
         exit();
      }
   }

   add_shortcode("activateaccount", "activateaccount");
?>