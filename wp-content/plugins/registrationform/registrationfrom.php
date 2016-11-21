<?php
   /*
      Plugin Name: Registrationform
      Version: 1.0
      Author: Arjan de Ruijter
      Author URI: https://arjanderuijter.nl
      Description: Registratieformulier.
      Text Domain: registrationform.nl
   */


   function registrationform()
   {
      global $wpdb;

      if (isset($_POST["submit"]))
      {
         $output = "Er is op de knop gedrukt";

         var_dump($_POST);

        $userdata = array(
           user_pass => "geheim",
           user_login => $_POST["loginname"],
           user_nicename => $_POST["loginname"],
           first_name => $_POST["firstname"],
           last_name => $_POST["lastname"],
           user_email => $_POST["email"],
           role => "administrator");

         wp_insert_user($userdata);

         /*
         $wpdb->query(
               $wpdb->prepare("INSERT INTO `wp_users` (`ID`,
                                          `user_login`,
                                          `user_pass`,
                                          `user_nicename`,
                                          `user_email`,
                                          `user_registered`,
                                          `user_status`,
                                          `display_name`)
                              VALUES       (NULL,
                                          %s,
                                          %s,
                                          %s,
                                          %s,
                                          %s,
                                          %d,
                                          %s)",
                                          $_POST["loginname"],
                                          MD5("geheim"),
                                          $_POST["loginname"],
                                          $_POST["email"],
                                          date("Y-m-d H:i:s"),
                                          0,
                                          $_POST["loginname"])
         );

         $id = $wpdb->insert_id;

         $wpdb->query(
            $wpdb->prepare("INSERT INTO `wp_usermeta` (`umeta_id`,
                                                       `user_id`,
                                                       `meta_key`,
                                                       `meta_value`)
                            VALUES                    (NULL,
                                                       %d,
                                                       %s,
                                                       %s)",
                                                       $id,
                                                       'first_name',
                                                       $_POST["firstname"])
         );

         $wpdb->query(
            $wpdb->prepare("INSERT INTO `wp_usermeta` (`umeta_id`,
                                                       `user_id`,
                                                       `meta_key`,
                                                       `meta_value`)
                            VALUES                    (NULL,
                                                       %d,
                                                       %s,
                                                       %s)",
                                                       $id,
                                                       'last_name',
                                                       $_POST["lastname"])
         );

        

      $wpdb->query(
            $wpdb->prepare("INSERT INTO `wp_usermeta` (`umeta_id`,
                                                       `user_id`,
                                                       `meta_key`,
                                                       `meta_value`)
                            VALUES                    (NULL,
                                                       %d,
                                                       %s,
                                                       %s)",
                                                       $id,
                                                       'wp_capabilities',
                                                       serialize(array("administrator" => true)))
         );
         */         
         return $output;
      }
      else
      {
         $output  = "<form action='' method='post'>";
         $output .= "<table>";
         $output .= "<tr>
                        <td>voornaam: </td>
                        <td><input type='text' name='firstname' ></td>
                     </tr>";
         $output .= "<tr>
                        <td>tussenvoegsel: </td>
                        <td><input type='text' name='infix' ></td>
                     </tr>";
         $output .= "<tr>
                        <td>achternaam: </td>
                        <td><input type='text' name='lastname' ></td>
                     </tr>";
         $output .= "<tr>
                        <td>gebruikersnaam: </td>
                        <td><input type='text' name='loginname' ></td>
                     </tr>";
         $output .= "<tr>
                        <td>e-mail: </td>
                        <td><input type='email' name='email' ></td>
                     </tr>";
         $output .= "<tr>
                        <td></td>
                        <td><input type='submit' name='submit' value='registreer'></td>
                     </tr>";
         $output .= "</table>";
         $output .= "</form>";
         return $output;
      }
   }

   add_shortcode("registration", "registrationform");
?>