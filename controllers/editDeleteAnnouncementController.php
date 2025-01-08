<?php
include_once "../database/databaseConnection.php";
$id = $_GET['id'];
function deleteAnnouncement($id){
    $conn = $GLOBALS['conn'];
    $qry = "DELETE FROM announcement_tbl WHERE id = $id";
    $result = $conn->prepare($qry);
    $result->execute();
    if($result){
        header('Location: ../views/admin/announcement.php');
    }
    else{
        echo "Error";
    }
    
}

if(isset($_GET['action']) == 'delete'){
    deleteAnnouncement($id);
}
?>