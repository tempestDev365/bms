<?php
$action = $_GET['action'];
$id = $_GET['resident_id'];
$document_id = $_GET['document'];

function approved($id, $document_id){
    include '../database/databaseConnection.php';
    $sql = "UPDATE documents_requested_for_others SET status = 'approved' WHERE id = :id AND document_type = :document_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':document_id', $document_id, PDO::PARAM_STR);
    $stmt->execute();
}

function cancelDocument($id, $document_id){
    include '../database/databaseConnection.php';
    $sql = "UPDATE documents_requested_for_others SET status = 'cancelled' WHERE id = :id AND document_type = :document_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':document_id', $document_id, PDO::PARAM_STR);
    $stmt->execute();
}

function rejected($id, $document_id){
    include '../database/databaseConnection.php';
    $sql = "UPDATE documents_requested_for_others SET status = 'rejected' WHERE id = :id AND document_type = :document_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':document_id', $document_id, PDO::PARAM_STR);
    $stmt->execute();
}

if($action == 'approve'){
    approved($id, $document_id);
    header('Location: ../views/admin/documentRequest.php');
}
if($action == 'reject'){
    rejected($id, $document_id);
    header('Location: ../views/admin/documentRequest.php');
}
if($action == 'cancel'){
    cancelDocument($id, $document_id);
    echo "Document Cancelled";
    header('Location: ../views/admin/documentRequest.php');
}
?>