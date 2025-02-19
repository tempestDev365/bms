<?php
$house_number = $_GET['house_number'] ?? " ";
$purok = $_GET['purok'] ?? " ";
function getMembers($house_number, $purok){
    
    include_once "../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    $qry = "SELECT first_name, last_name, middle_name, sex,age
        FROM residents_information 
        WHERE house_number = '$house_number' AND purok = '$purok'";
    $result = $conn->prepare($qry);
    
    $result->execute();
    $household = $result->fetchAll(PDO::FETCH_ASSOC);
    return $household;
}
$action = $_GET['action'];
if($action == "view"){
    header('Content-Type: application/json');
    echo json_encode(getMembers($house_number, $purok));
}
?>