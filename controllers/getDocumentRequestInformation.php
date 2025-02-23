<?php
include '../database/databaseConnection.php';
$id = $_GET['resident_id'];
$document_requested = $_GET['id'];
function getDocumentRequestInformation($resident_id, $id){
    $conn = $GLOBALS['conn'];
    $sql = "SELECT d.*, r.age, r.first_name, r.last_name, r.middle_name, rc.phone_number,ri.resident_picture,r.birthday
            FROM document_requested d
            LEFT JOIN residents_information r ON r.id = d.resident_id
            LEFT JOIN residents_personal_information ri ON ri.resident_id = d.resident_id
            LEFT JOIN residents_contact_information rc ON rc.resident_id = d.resident_id
            WHERE d.resident_id = :resident_id AND d.id = :id";    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':resident_id', $resident_id, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    return [
        'resident_id'=>$result['id'],
        'resident_picture'=>$result['resident_picture'],
        'resident_name'=>$result['first_name'].' '.$result['middle_name'].' '.$result['last_name'],
        'resident_age'=>$result['age'],
        'resident_birthdate'=>$result['birthday'],
        'mobile_no'=>$result['phone_number'],
        'document_request'=>$result['document'],
        'document_purpose'=>$result['purpose'],
        'document_status'=>$result['status'],
        'document_date_requested'=>$result['time_Created'],
        'status'=>$result['status']
    ];
}
$action = $_GET['action'] ?? null;
if($action == 'view'){
header('Content-Type: application/json');
echo json_encode(getDocumentRequestInformation($id, $document_requested));
}
?>