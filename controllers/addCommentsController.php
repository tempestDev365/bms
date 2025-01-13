<?php
include "../database/databaseConnection.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $comment = $_POST['comment'];
    $announcement_id  = $_POST['announcement_id'];
    $resident_id = $_POST['resident_id'];
    $qry = "INSERT into comments_tbl (comment, announcement_id,resident_id, time_Created) VALUES (?,?,?,NOW())";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $comment);
    $stmt->bindParam(2, $announcement_id);
    $stmt->bindParam(3, $resident_id);
    $stmt->execute();
    header('Location: ../views/residents/userAnnouncement.php');
}
?>
