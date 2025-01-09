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

    if ($result && password_verify($password, $result['password'])) {
        session_start();
        $_SESSION['resident_id'] = $result['id'];
        header('Location: ../views/residents/userResident.php');
    } else {
       header('Location: ../views/residents/residentLogin.php?error=1');
    }
}

?>