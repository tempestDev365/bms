<?php
$action = $_GET['action'];
$name = $_GET['name'];

function getInfo($name){
    include '../database/databaseConnection.php';
    $sql = "SELECT * FROM residents_information WHERE CONCAT(first_name, ' ', last_name) = :full_name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':full_name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();

    $qry = "SELECT proof, purpose,id, document_type FROM documents_requested_for_others WHERE name = :name";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $proof = $stmt->fetch();

    $get_contact = "SELECT phone_number FROM residents_contact_information WHERE resident_id = :resident_id";
    $stmt = $conn->prepare($get_contact);
    $stmt->bindParam(':resident_id', $result['id'], PDO::PARAM_INT);
    $stmt->execute();
    $contact = $stmt->fetch();

    return [
        'resident_name' => $result['first_name'] . ' ' . $result['last_name'],
        'resident_age' => $result['age'],
        'resident_birthdate' => $result['birthday'],
        'resident_mobile_number' => $contact['phone_number'] ?? "",
        'resident_proof' => $proof['proof'],
        'resident_purpose' => $proof['purpose'],
        'resident_document' => $proof['document_type'],
        'id' => $proof['id']
    ];
}

if($action == 'view'){
    header('Content-Type: application/json');   
    echo json_encode(getInfo($name));
}
?>