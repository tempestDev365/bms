<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include_once '../database/databaseConnection.php';
    $name = $_POST['name'];
    $document= $_POST['selectDocument'];
    $purpose = $_POST['purpose'];
    $qry = "INSERT INTO `documents_requested_for_others`( `resident_id`, `name`, `document_type`, `purpose`, `time_Created`)
     VALUES (?,?,?,?, NOW())";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $_SESSION['user_id']);
    $stmt->bindParam(2, $name);
    $stmt->bindParam(3, $document);
    $stmt->bindParam(4, $purpose);
    $stmt->execute();
     header('Location: ../views/residents/userDocument.php');

}
?>