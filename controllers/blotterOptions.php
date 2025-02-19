<?php
$action = $_GET['action'];
$id = $_GET['id'];
function approveBlotter($id){
    include '../database/databaseConnection.php';
        $qry = "UPDATE `blotter_tbl` SET `status`='approved' WHERE `id` = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        header('Location: ../views/admin/blotterOptions.php');
}
function disapproveBlotter($id){
    include '../database/databaseConnection.php';
       
        $qry = "UPDATE `blotter_tbl` SET `status`='reject' WHERE `id` = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        header('Location: ../views/admin/blotterOptions.php');
}
if($action == 'approve'){
    approveBlotter($id);
}
if($action == 'disapprove'){
    disapproveBlotter($id);
}
?>