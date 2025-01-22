<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';
$mail = new PHPMailer(true);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../database/databaseConnection.php';
    $email = $_POST['email'];
    $conn = $GLOBALS['conn'];
    $sql = "SELECT rc.email, r.id 
    FROM residents_contacts  rc
    JOIN residents_tbl r
    ON rc.residents_id = r.id
    WHERE email = '$email'
    ";
    $result = $conn->query($sql);
    $result = $result->fetch();
    $userEmail = $result['email'];
    //Server settings
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
    $mail->addAddress($userEmail);     //Add a recipient
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Password Reset';
    $mail->Body    = "Please click the link to reset your password 
    NOTE: If you did not request a password reset, please ignore this email.
    <a href='http://localhost/bms/views/residents/resetPassword.php?id={$result['id']}'>Reset Password</a>
    ";
    $mail->send();
    header('Location: ../views/residents/residentLogin.php?success=1');
}
?>