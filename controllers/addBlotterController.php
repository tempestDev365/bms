<?php
include '../database/databaseConnection.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $time_of_accident = $_POST['time_of_accident'];
    $place_of_accident = $_POST['place_of_accident'];
    $date_schedule = $_POST['date_schedule'];
    $meeting_time = $_POST['meeting_time'];
    $description = $_POST['description'];   
    $current_time = time();
    $qry = "INSERT INTO `blotter_tbl`( `time_of_accident`, `place_of_accident`, `date_schedule`, `meeting_time`, `description`,`status`, `time`)
     VALUES (?,?,?,?,?,active,$current_time)";

    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $time_of_accident, PDO::PARAM_STR);
    $stmt->bindParam(2, $place_of_accident, PDO::PARAM_STR);
    $stmt->bindParam(3, $date_schedule, PDO::PARAM_STR);
    $stmt->bindParam(4, $meeting_time, PDO::PARAM_STR);
    $stmt->bindParam(5, $description, PDO::PARAM_STR);
    
    $stmt->execute();
    header('Location: ../views/admin/blotter.php');
}
?>