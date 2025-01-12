<?php
include '../database/databaseConnection.php';
$id = $_GET['resident_id'];
$document_requested = $_GET['document'];
function getDocumentRequestInformation($id, $document_requested){
    $conn = $GLOBALS['conn'];
    $sql = "SELECT d.*, ri.age, r.first_name, r.last_name, r.middle_name, rc.mobile_no,r.picture,ri.birthdate
            FROM document_requested d
            LEFT JOIN residents_tbl r ON r.id = d.resident_id
            LEFT JOIN resident_information ri ON ri.resident_id = d.resident_id
            LEFT JOIN residents_contacts rc ON rc.residents_id = d.resident_id
            WHERE d.resident_id = :id AND d.document = :document_requested";    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':document_requested', $document_requested, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    return [
        'resident_id'=>$result['id'],
        'resident_picture'=>$result['picture'],
        'resident_name'=>$result['first_name'].' '.$result['middle_name'].' '.$result['last_name'],
        'resident_age'=>$result['age'],
        'resident_birthdate'=>$result['birthdate'],
        'mobile_no'=>$result['mobile_no'],
        'document_request'=>$result['document'],
        'document_purpose'=>$result['purpose'],
        'document_status'=>$result['status'],
        'document_date_requested'=>$result['time_Created'],
    ];
}
$action = $_GET['action'] ?? null;
if($action == 'view'){
header('Content-Type: application/json');
echo json_encode(getDocumentRequestInformation($id, $document_requested));
}
?>