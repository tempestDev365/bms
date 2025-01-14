<?php
$id = $_GET['id'];
function deleteResident($id){
    include_once '../database/databaseConnection.php';
    $conn = $GLOBALS['conn'];
    $qry = "DELETE FROM approved_tbl WHERE resident_id = $id";
    $result = $conn->query($qry);
    $result->execute();
   
}
if($_GET['action'] == 'delete'){
    deleteResident($id);
}   
?>