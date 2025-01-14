<?php
session_start();
include '../database/databaseConnection.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $document= $_POST['selectDocument'];
    $purpose = $_POST['purpose'];
    $resident_id = $_SESSION['resident_id'];
    $qry = "INSERT INTO document_requested (resident_id,document,purpose,status, time_Created) VALUES (?,?,?,'pending', NOW())";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $resident_id);
    $stmt->bindParam(2, $document);
    $stmt->bindParam(3, $purpose);
    $stmt->execute();
    header('Location: ../views/residents/userDocument.php');
}
?>