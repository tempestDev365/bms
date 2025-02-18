<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $first = $_POST['1'];
    if($otp == $_SESSION['otp']){
        echo "OTP is correct";
    }else{
        echo "OTP is incorrect";
    }
}
?>