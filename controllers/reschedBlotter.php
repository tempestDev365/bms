<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '../database/databaseConnection.php';
    $id = $_POST['id'];
    $date_schedule = $_POST['date_schedule'];
    $meeting_time = $_POST['meeting_time'];
    $qry = "UPDATE `blotter_tbl` SET `date_schedule`=?,`meeting_time`=?, `status` = 'rescheduled' WHERE `id`=?";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1,$date_schedule);
    $stmt->bindParam(2,$meeting_time);
    $stmt->bindParam(3,$id);
    $stmt->execute();
    header('Location: ../views/admin/blotter.php');
}
?>