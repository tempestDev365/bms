<?php
$id = $_GET['id'];
function deleteResident($id){
    include_once '../database/databaseConnection.php';
    $conn = $GLOBALS['conn'];
    $qry4 = "DELETE FROM document_requested WHERE resident_id = $id";
    $result4 = $conn->query($qry4);
    $qry5 = "DELETE FROM documents_requested_for_others WHERE resident_id = $id";  
    $result5 = $conn->query($qry5);
    $qry = "DELETE FROM residents_information WHERE id = $id";
    $result = $conn->query($qry);
    $qry1 = "DELETE FROM residents_personal_information WHERE resident_id = $id";
    $result1 = $conn->query($qry1);
    $qry2 = "DELETE FROM residents_contact_information WHERE resident_id = $id";
    $result2 = $conn->query($qry2);
    $qry3 = "DELETE FROM residents_additional_information WHERE resident_id = $id";
    $result3 = $conn->query($qry3);

    

}
if($_GET['action'] == 'delete'){
    deleteResident($id);
}   
?>