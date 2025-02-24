<?php
session_start();
include '../database/databaseConnection.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $document= $_POST['selectDocument'];
    $purpose = $_POST['purpose'];
    $resident_id = $_SESSION['user_id'];
    if(checkIfdocumentRequestExist()){
        header('Location: ../views/residents/userDocument.php?error=2');
        exit();
    }
    $qry = "INSERT INTO document_requested (resident_id,document,purpose,status, time_Created) VALUES (?,?,?,'pending', NOW())";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $resident_id);
    $stmt->bindParam(2, $document);
    $stmt->bindParam(3, $purpose);
    $stmt->execute();
    header('Location: ../views/residents/userDocument.php');
}
function checkIfdocumentRequestExist(){
    include '../database/databaseConnection.php';
    $resident_id = $_SESSION['user_id'];
    $qry = "SELECT * FROM document_requested WHERE resident_id = ? AND (status = 'pending' OR status = 'approved') AND document = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $resident_id);
    $stmt->bindParam(2, $_POST['selectDocument']);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result){
        return true;
    }else{
        return false;
    }
}
?>