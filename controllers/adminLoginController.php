<?php
include '../database/databaseConnection.php';
$GLOBALS['conn'] = $conn;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM admin_tbl	 WHERE username = '$username' AND password = '$password'";
    $stmt = $conn->prepare($sql);
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