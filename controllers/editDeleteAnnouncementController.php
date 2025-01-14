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
function editAnnouncement($id){
    $conn = $GLOBALS['conn'];
    $new_titile = $_POST['title'];
    $new_content = $_POST['content'];
    $qry = "UPDATE announcement_tbl SET title = ?, content = ? WHERE id = $id";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $new_titile);
    $stmt->bindParam(2, $new_content);
    $stmt->execute();
    if($stmt){
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
if($action == "edit"){
    editAnnouncement($id);
}
?>