<?php
include '../database/databaseConnection.php';
$GLOBALS['conn'] = $conn;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT username,password FROM admin_tbl	 WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $password, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result) {
        session_start();
        $_SESSION['admin'] = $result;
        header('Location: ../views/admin/main.php');    
    } else {
        echo 'Invalid username or password';
    }
}
?>