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
if($action == 'delete'){
    deleteBlotter($id);
}
if($action == 'view'){
    header('Content-Type: application/json');
    echo json_encode(viewBlotterDetail($id));
}
?>