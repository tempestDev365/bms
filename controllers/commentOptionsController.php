<?php
$id = $_GET['id'];
$action = $_GET['action'];
function deleteComment($id){
    include_once "../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    $sql = "DELETE FROM comments_tbl WHERE id = $id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header('Location: ../views/residents/userAnnouncement.php');
    
}
function editComment($id){
    include_once "../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    $comment = $_POST['content'];
    $sql = "UPDATE comments_tbl SET comment = '$comment' WHERE id = $id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header('Location: ../views/residents/userAnnouncement.php');
}
if($action == 'delete'){
    deleteComment($id);
}
if($action == 'edit'){
    editComment($id);
}
?>