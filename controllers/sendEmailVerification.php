<?php

ini_set("display_errors", "1");
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
session_start();
require '../vendor/autoload.php';
$mail = new PHPMailer(true);

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'perez.menard.nomiddlename@gmail.com';                     //SMTP username
    $mail->Password   = 'wkpd ciuw emxq txhe';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('perez.menard.nomiddlename@gmail.com', 'Admin');
    $mail->addAddress($email);     //Add a recipient
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verification Link';
    $mail->Body    = "Please click the link to register
    NOTE: If you did not request a this, please ignore this email.
    <a href='http://localhost/bms/views/residents/registrationInfo.php?email={$email}'>Registration Link</a>
    ";
    $mail->send();
    $_SESSION['email'] = $email;
    echo "<script>alert('Email sent successfully')</script>";
    
}
?>