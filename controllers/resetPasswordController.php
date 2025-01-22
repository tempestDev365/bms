<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../database/databaseConnection.php';
    $id = $_POST['id'];
    $conn = $GLOBALS['conn'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    if($password != $confirmPassword){
        header('Location: ../views/residents/resetPassword.php?id='.$id.'&error=1');
        return;
    }
    $sql = "UPDATE residents_tbl SET password = '$hash' WHERE id = $id";
    $conn->query($sql);
    header('Location: ../views/residents/residentLogin.php?success=1');
    
}
?>