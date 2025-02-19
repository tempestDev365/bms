<?php
session_start();
date_default_timezone_set('Asia/Manila');
include '../database/databaseConnection.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $time_of_accident = $_POST['time_of_accident'];
    $place_of_accident = $_POST['place_of_accident'];
    $date_schedule = $_POST['date_schedule'];
    $meeting_time = $_POST['meeting_time'];
    $description = $_POST['description'];   
    $current_time = date("h:i:s A");
    $qry = "INSERT INTO `blotter_tbl`( `resident_id`, `time_of_accident`, `place_of_accident`, `date_schedule`, `meeting_time`, `description`,`status`, `time`)
     VALUES (?,?,?,?,?,?,'active',NOW())";

    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1,$_SESSION['user_id']);
    $stmt->bindParam(2,$time_of_accident);
    $stmt->bindParam(3,$place_of_accident);
    $stmt->bindParam(4,$date_schedule);
    $stmt->bindParam(5,$meeting_time);
    $stmt->bindParam(6,$description);
    

     
    $stmt->execute();
    header('Location: ../views/residents/blotter.php');
}
?>