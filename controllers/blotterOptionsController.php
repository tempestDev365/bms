<?php
$id = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;
function viewBlotterDetail($id){
    include_once "../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    $qry = "SELECT * FROM blotter_tbl where id = $id";
    $result = $conn->query($qry);
    $result->execute();
    $row = $result->fetch();
    return [
        'id' => $row['id'],
        'place' => $row['place_of_incident'],
        'complainant'=> $row['narrator_complaint'],   
        'first_witness' => $row['first_witness'],
        'second_witness' => $row['second_witness'],
        'date' => $row['time_Created'],
        'narrative' => $row['narrative'],
    ];
}
function deleteBlotter($id){
    include_once "../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    $qry = "DELETE FROM blotter_tbl where id = $id";
    $conn->query($qry);
    header('Location: ../views/admin/blotter.php');
}
function editBlotter($id){
include_once "../database/databaseConnection.php";
$conn = $GLOBALS['conn'];   
$place = $_POST['incident_place'];
$date = $_POST['date'];
$complainant = $_POST['complainant'];
$first_witness = $_POST['first_witness'];
$second_witness = $_POST['second_witness'];
$narrative = $_POST['narrative'];
$qry = "UPDATE blotter_tbl SET place_of_incident = ?, time_Created = ?, narrator_complaint = ? , first_witness = ?, second_witness = ?, narrative = ? WHERE id = $id";
$stmt = $conn->prepare($qry);
$stmt -> bindParam(1, $place);
$stmt -> bindParam(2, $date);
$stmt -> bindParam(3, $complainant);
$stmt -> bindParam(4, $first_witness);
$stmt -> bindParam(5, $second_witness);
$stmt -> bindParam(6, $narrative);
$stmt->execute();
header('Location: ../views/admin/blotter.php');

}
if($action == 'delete'){
    deleteBlotter($id);
}
if($action == 'view'){
    header('Content-Type: application/json');
    echo json_encode(viewBlotterDetail($id));
}
if($action == 'edit'){
    editBlotter($id);
}
?>