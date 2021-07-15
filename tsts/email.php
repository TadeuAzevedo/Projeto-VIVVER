<?php
$to      = 'tadeu.cruz@vivver.com.br';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: ttadeu100@gmail.com'       . "\r\n" .
             'Reply-To: tadeu.cruz@vivver.com.com' . "\r\n" .
             'X-Mailer: PHP/';

mail($to, $subject, $message, $headers);
?>
