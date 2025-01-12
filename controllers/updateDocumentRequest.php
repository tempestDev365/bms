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

if ($stmt->rowCount() > 0) {
    echo "success";
} else {
    echo json_encode([
        'error' => 'Already Approved'
    ]);  
}
}
if($_GET['action'] == "approve"){
    approveDocument($id, $document_requested);
}
?>