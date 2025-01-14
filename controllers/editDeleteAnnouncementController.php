<?php
include_once "../database/databaseConnection.php";
$id = $_GET['id'];
function deleteAnnouncement($id){
    $conn = $GLOBALS['conn'];
     $deleteComments = "DELETE FROM comments_tbl WHERE announcement_id = $id";
    $result = $conn->prepare($deleteComments);
    $result->execute();
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
$action = $_GET['action'] ?? "";
if($action == "delete"){
    deleteAnnouncement($id);
}
?>