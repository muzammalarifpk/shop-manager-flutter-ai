<?php
   $to_email = "muzammal.arif134@amalacademy.org";
   $subject = "Simple Email Test via PHP Cron job";
   $body = "Hi,nn This is test email send by PHP Script. on Baseplan.php ".date("Y-M-d H:i:s");
   $headers = "From: norply@baseplan.pk";

   if ( mail($to_email, $subject, $body, $headers)) {
      echo("Email successfully sent to $to_email...");
   } else {
      echo("Email sending failed...");
   }
?>
