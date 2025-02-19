<?php
session_start();
if($_SERVER['REQUEST_METHOD'] ==  "POST"){
    include_once "../database/databaseConnection.php";
    $concern_title = $_POST['concern'];
    $concern_message = $_POST['message'];
    $resident_id = $_SESSION['user_id'];
    $sql = "INSERT INTO concerns_tbl (concern_title, concern_message, resident_id,time_Created) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $concern_title);
    $stmt->bindParam(2, $concern_message);
    $stmt->bindParam(3, $resident_id);
    $stmt->execute();
    header("Location: ../views/residents/residentConcerns.php");

}
?>