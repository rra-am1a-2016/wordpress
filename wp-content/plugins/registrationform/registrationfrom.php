<?php
   /*
      Plugin Name: Registrationform
      Version: 1.0
      Author: Arjan de Ruijter
      Author URI: https://arjanderuijter.nl
      Description: Registratieformulier.
      Text Domain: registrationform.nl
   */
   ob_start();

   function sanitize($text)
   {
      
      // Haalt spaties, \n, returns, enz.. links en rechts weg
      $text = trim($text);

      // Verwijdert html en php tags
      $text = strip_tags($text);

      // escaped kritische tekens zoals ' en "
      $text = addslashes($text);

      // of gebruik...
      //$text = mysqli_real_escape_string($conn, $text);
      return $text;
   }

   function registrationform()
   {
      global $wpdb;

      if (isset($_POST["submit"]))
      {
            
            // Stel de juiste tijdzone in voor het bepalen van de tijd
            date_default_timezone_set("Europe/Amsterdam");

            // Maak een random tijdelijk password en haal dit door een sha1 hash
            $first3OfFirstname = substr(sanitize($_POST["firstname"]), 0, 3);
            $last4OfLastname = substr(sanitize($_POST["lastname"]), (strlen(sanitize($_POST["lastname"])) - 4), 4);
            $date = date("d-m-Y H:i:s");
            $tempPassword = $date." ".$first3OfFirstname." ".$last4OfLastname;
            $tempPassword = sha1($tempPassword);


            // Maak de waarden van het $_POST() array schoon
            $firstname = sanitize($_POST["firstname"]);
            $infix = sanitize($_POST["infix"]);
            $lastname = sanitize($_POST["lastname"]);
            $email = sanitize($_POST["email"]);
            $loginname = sanitize($_POST["loginname"]);

            // Maak de selectiequery om te controleren of het emailadres al bestaat in de database
            $user = get_user_by("email", $_POST["email"]);

            //var_dump($user); 

            if (!$user)
            {
                  // Voeg de gebruiker toe aan de database
                  $userdata = array(user_pass => $tempPassword,
                                    user_login => $loginname,
                                    user_nicename => $loginname,
                                    first_name => $firstname,
                                    last_name => $lastname,
                                    user_email => $email,
                                    role => "subscriber");

                  $last_id = wp_insert_user($userdata);        
        
                  //var_dump($result); exit();
                 
                  // Als de query correct is ontvangen en uitgevoerd.
                  if (!empty($last_id))
                  {
                        $emailaddress = $email;
                        $subject = "Activatie account";        
                   
                        $messageHtml = "<!DOCTYPE html>
                                          <html>
                                          <head>
                                                <title>Page Title</title>
                                                <style>
                                                body
                                                {
                                                      font-family: Verdana, Arial;
                                                      font-size: 1em;
                                                      color: rgb(30, 30, 30);
                                                }
                                                </style>
                                          </head>
                                          <body>
                                          <h3>Beste ".$firstname." ".$infix." ".$lastname.",</h3>".
                                                "<p>Bedankt voor het registreren, klik op onderstaande link<p>".
                                                "<p><a href='http://localhost/2016-2017/am1a/groenten/index.php/activeer-uw-account/?id=".
                                                $last_id."&pw=".$tempPassword."'>activatielink</a></p><p>om uw account te activeren</p>". 
                                                "<p>Met vriendelijke groet,</p>". 
                                                "<p>De beheerder van de site</p>
                                          </body>
                                          </html>";
          
                        $headers = "Content-Type: text/html; charset=UTF-8"."\r\n";
                        $headers .= "Cc: adruijter@fopmail.com, hans@testmail.com, frans@realmail.com"."\r\n";
                        $headers .= "Bcc: rra@mboutrecht.nl"."\r\n";
                        $headers .= "From: adruijter@gmail.com";

                        mail($emailaddress, $subject, $messageHtml, $headers);
                        
                        // Geef een succes melding en stuur door naar de homepage..
                        $output = "Uw bent succesvol geregistreerd. U ontvangt een activatiemail";
                        header("Refresh: 4; url=http://localhost/2016-2017/am1a/groenten/"); 
                        
                        return $output;
                   }
            }
            else
            {
                  $output = "Dit e-mailadres is al in gebruik. Kies een ander";
                  header("Refresh: 4; url=http://localhost/2016-2017/am1a/groenten/index.php/registratie/"); 
                  return $output;
            }
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