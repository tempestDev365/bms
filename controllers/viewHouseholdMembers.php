<?php
$house_number = $_GET['house_number'] ?? " ";
function getMembers($house_number){
    
    include_once "../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    $qry = "SELECT first_name, last_name, middle_name, sex,age
        FROM residents_information 
        WHERE house_number = ?";
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