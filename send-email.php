<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if(isset($_POST["send"]))
{
   $name = htmlentities($_POST['name']);
   $email = htmlentities($_POST['email']);
   $subject = htmlentities($_POST['phone']);
   $message = htmlentities($_POST['message']);


   $mail = newPHPMailer(true);
   $mail->isSMTP();
   $mail->Host = 'smtp.gmail.com';
   $mail->SMTPAuth = true;
   $mail->Username = "marcelinowebdev@gmail.com
   ";
   $mail->Password = "cxqvqdwrscahqhos
   ";
   $mail->Port = 465;
   $mail->SMTPSecure = 'ssl';
   $mail->isHTML(true);
   $mail->setFrom($email, $name);
   $mail->addAddress('marcelinowebdev@gmail.com');
   $mail->Subject = ("$email ($subject)");
   $mail->Body = $message;
    $mail->send();
    
   header ("Location: index.php");
}


?>




