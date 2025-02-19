<?php
include '../database/databaseConnection.php';
$id = $_GET['resident_id'];
$document_requested = $_GET['id'];
function getDocumentRequestInformation($resident_id, $id){
    $conn = $GLOBALS['conn'];
    $sql = "SELECT d.*, ri.age, r.first_name, r.last_name, r.middle_name, rc.mobile_no,ri.resident_pictur,r.birthdate
            FROM document_requested d
            LEFT JOIN residents_information r ON r.id = d.resident_id
            LEFT JOIN residents_personal_information ri ON ri.id = d.resident_id
            LEFT JOIN residents_contact_information rc ON rc.residents_id = d.resident_id
            WHERE d.resident_id = :resident_id AND d.id = :id";    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $resident_id, PDO::PARAM_INT);
    $stmt->bindParam(':document_requested', $id, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    return [
        'resident_id'=>$result['id'],
        'resident_picture'=>$result['resident_pictur'],
        'resident_name'=>$result['first_name'].' '.$result['middle_name'].' '.$result['last_name'],
        'resident_age'=>$result['age'],
        'resident_birthdate'=>$result['birthdate'],
        'mobile_no'=>$result['phone_number'],
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