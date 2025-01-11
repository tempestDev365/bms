<?php
include_once "../database/databaseConnection.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $qry = "SELECT id,username, password FROM residents_tbl WHERE username = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $result = $stmt->fetch();
    $get_account_status = "SELECT * FROM approved_tbl WHERE resident_id = ?";
    $stmt = $conn->prepare($get_account_status);
    $stmt->bindParam(1, $result['id']);
    $stmt->execute();
    $status = $stmt->fetch();
    if(!$status){
        header('Location: ../views/residents/residentLogin.php?error=2');
        echo "<script>alert('Account not yet approved by the admin.');</script>";   
        return;
    }

    if ($result && password_verify($password, $result['password'])) {
        session_start();
        $_SESSION['resident_id'] = $result['id'];
        header('Location: ../views/residents/userResident.php');
    } else {
       header('Location: ../views/residents/residentLogin.php?error=1');
    }
}

?>