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

   function registrationform()
   {
      global $wpdb;

      if (isset($_POST["submit"]))
      {
            // Maak contact met de mysql-server en database 
      include("./connect_db.php");

      // Maak de functie sanitize() beschikbaar op deze pagina
      include("./functions.php");

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

      // Maak de selectiequery om te controleren of het emailadres al bestaat in de database
      $sql = "SELECT * FROM `users` WHERE `email` = '".$_POST["email"]."'";

      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) == 0)
      {

        // Maak de insert query..
        $sql = "INSERT INTO `users` (`id`,
                                    `firstname`,
                                    `infix`,
                                    `lastname`,
                                    `email`,
                                    `password`,
                                    `activate`)
                VALUES             (NULL,
                                    '".$firstname."',
                                    '".$infix."',
                                    '".$lastname."',
                                    '".$email."',
                                    '".$tempPassword."',
                                    'false')";
        
        // Vuur de query af op de database via de verbinding $conn
        $result = mysqli_query($conn, $sql);
      
        // Vraag het id op van het aangemaakt record
        $last_id = mysqli_insert_id($conn);

        
        // Als de query correct is ontvangen en uitgevoerd.
        if ($result)
        {
          $emailaddress = $_POST["email"];
          $subject = "Activatie account";
          
          /*
          $message = "Beste ".$firstname." ".$infix." ".$lastname."\n\n".
                      "Bedankt voor het registreren, klik op onderstaande link\n\n".
                      "http://localhost/2016-2017/am1a/inlogregistratiesysteem/index.php?content=activate&id=".
                      $last_id."&pw=".$tempPassword." \n\nom uw account te activeren\n\n". 
                      "Met vriendelijke groet,\n". 
                      "admin";
          */
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
                                "<p><a href='http://localhost/2016-2017/am1a/inlogregistratiesysteem/index.php?content=activate&id=".
                                $last_id."&pw=".$tempPassword."'>activatielink</a></p><p>om uw account te activeren</p>". 
                                "<p>Met vriendelijke groet,</p>". 
                                "<p>admin</p>
                            </body>
                          </html>";
          
          $headers = "Content-Type: text/html; charset=UTF-8"."\r\n";
          $headers .= "Cc: adruijter@fopmail.com, hans@testmail.com, frans@realmail.com"."\r\n";
          $headers .= "Bcc: rra@mboutrecht.nl"."\r\n";
          $headers .= "From: adruijter@gmail.com";



          mail($emailaddress, $subject, $messageHtml, $headers);
          // Geef een succes melding en stuur door naar de homepage..
          echo "Uw bent geregistreerd";
          // Wacht 3 seconden en stuur door naar index.php?content=home
          header("refresh:3; url=./index.php?content=home");
        $userdata = array(user_pass => "geheim",
                          user_login => $_POST["loginname"],
                          user_nicename => $_POST["loginname"],
                          first_name => $_POST["firstname"],
                          last_name => $_POST["lastname"],
                          user_email => $_POST["email"],
                          role => "subscriber");

         wp_insert_user($userdata);

         $output = "Uw bent succesvol geregistreerd. U ontvangt een activatiemail";
         header("Refresh: 4; url=http://localhost/2016-2017/am1a/groenten/");
                  
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