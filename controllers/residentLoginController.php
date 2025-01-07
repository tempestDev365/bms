<?php
include_once "../database/databaseConnection.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $qry = "SELECT * FROM residents WHERE username = '$username' AND password = '$password'";
    $result = $conn->prepare($qry);
    $result->execute();
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    if($row > 0){
        session_start();
        $_SESSION['id'] = $row['id'];
        header('location: ./userResident.php');
    }else{
        echo "<script>alert('Invalid username or password')</script>";
        return; 
    }
}

?>