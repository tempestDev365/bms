<?php
$house_number = $_GET['house_number'] ?? " ";
function getMembers($house_number){
    
    include_once "../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    $qry = "SELECT r.first_name, r.last_name, r.middle_name, ri.sex,ri.age
        FROM residents_tbl r
        LEFT JOIN resident_information ri ON r.id = ri.resident_id
        LEFT JOIN residents_address ra ON r.id = ra.resident_id
        WHERE ra.house_number = ?";
    $result = $conn->prepare($qry);
    $result->bindParam(1, $house_number);
    $result->execute();
    $household = $result->fetchAll(PDO::FETCH_ASSOC);
    return $household;
}
$action = $_GET['action'];
if($action == "view"){
    header('Content-Type: application/json');
    echo json_encode(getMembers($house_number));
}
?>