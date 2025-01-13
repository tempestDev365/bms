<?php
include '../database/databaseConnection.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $incident = $_POST['incident'];
    $place = $_POST['place'];
    $date = $_POST['date'];
    $complainant = $_POST['complainant'];
    $first_witness = $_POST['first_witness'];
    $second_witness = $_POST['second_witness'];
    $narrative = $_POST['narrative'];   
    $qry = "INSERT INTO blotter_tbl (incident,place_of_incident,narrator_complaint,first_witness,second_witness,time_Created) VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1,$incident);
    $stmt->bindParam(2,$place);
    $stmt->bindParam(3,$complainant);
    $stmt->bindParam(4,$first_witness);
    $stmt->bindParam(5,$second_witness);
    $stmt->bindParam(6,$date);
    $stmt->execute();
    header('Location: ../views/admin/blotter.php');
}
?>