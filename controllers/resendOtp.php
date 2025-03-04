<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';
var_dump($_SESSION['email']);
$mail = new PHPMailer(true);
if($_GET['action'] == "resend"){
    $email = $_SESSION['email'];
   if(!checkIfEmailInDb($email)){
         echo "Email not found";    
         return;
   }
   $otp = rand(100000,999999);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'macoroljamaica0702@gmail.com';                     //SMTP username
    $mail->Password   = 'sdvp eyuo lten uqej';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('macoroljamaica0702@gmail.com', 'Admin');

    $mail->addAddress($email);     //Add a recipient
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verification Link';
    $mail->Body    = "Please click the link to register
     <h1>NOTE: If you did not request this OTP please ignore this EMAIL</h1>
     <h2>Your OTP is: <b?>{$otp}</b></h2>
    ";
    $_SESSION['otp'] = $otp;
    $mail->send();
    header("Location: ../views/residents/otpVerificationLogin.php");
}
function checkIfEmailInDb($email){
    include_once '../database/databaseConnection.php';
    $qry = "SELECT * FROM residents_information WHERE email = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1,$email);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result){
        return true;
    }else{
        return false;
    }
}
?>
