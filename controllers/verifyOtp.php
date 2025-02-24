<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    include_once '../database/databaseConnection.php';
    $qry =  "SELECT * FROM residents_information WHERE email = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1,$_SESSION['email']);
    $stmt->execute();
    $result = $stmt->fetch();

    $first = $_POST['first'];
    $second = $_POST['second'];
    $third = $_POST['third'];
    $fourth = $_POST['fourth'];
    $fifth = $_POST['fifth'];
    $sixth = $_POST['sixth'];
    $otp = $first . $second . $third . $fourth . $fifth . $sixth;
    if($otp == $_SESSION['otp']){
        echo "OTP is correct";
        $_SESSION['user_id'] = $result['id'];
        unset($_SESSION['otp']);
        unset($_SESSION['email']);
        header("Location: ../views/residents/userNotification.php");
        
    }else{
       header("Location: ../views/residents/otpVerificationLogin.php?error=1");
        
    }

}
?>