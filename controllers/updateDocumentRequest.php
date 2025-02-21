<?php
include '../database/databaseConnection.php';
$id = $_GET['resident_id'] ?? null;
$document_requested = $_GET['document'] ?? null;
function approveDocument($id, $document_requested){
    $conn = $GLOBALS['conn'];
$qry = "UPDATE document_requested SET status = 'approved' WHERE resident_id = :id AND document = :document_requested";
$stmt = $conn->prepare($qry);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':document_requested', $document_requested, PDO::PARAM_STR);
$stmt->execute();

}
function rejectDocument($id, $document_requested){
    $conn = $GLOBALS['conn']; 
    $qry = "UPDATE document_requested SET status = 'rejected' WHERE resident_id = :id AND document = :document_requested";
$stmt = $conn->prepare($qry);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':document_requested', $document_requested, PDO::PARAM_STR);
$stmt->execute();


}
function cancelDocument($id, $document_requested){
    $conn = $GLOBALS['conn']; 
    $qry = "UPDATE document_requested SET status = 'pending' WHERE resident_id = :id AND document = :document_requested";
$stmt = $conn->prepare($qry);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':document_requested', $document_requested, PDO::PARAM_STR);
$stmt->execute();
}
if($_GET['action'] == "approve"){
    approveDocument($id, $document_requested);
}
if($_GET['action'] == "reject"){
    rejectDocument($id, $document_requested);
}
if($_GET['action'] == "cancel"){
    cancelDocument($id, $document_requested);
}
?>