<?php
if($_SERVER['REQUEST_METHOD'] ==  "POST"){
    include_once "../database/databaseConnection.php";
    $reply = $_POST['reply'];
    $concern_id = $_POST['concern_id'];
    $qry= "INSERT INTO concerns_replies_tbl (concern_id, message, time_Created) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $concern_id);
    $stmt->bindParam(2, $reply);
    $stmt->execute();
    header("Location: ../views/admin/concerns.php");
}
?>