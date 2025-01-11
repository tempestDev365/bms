<?php
if($_GET['action'] == "approve"){
    $id = $_GET['id'];
    $qry = "UPDATE `resident` SET `status` = 'approved' WHERE `id` = ?";
    $result = $conn->prepare($qry);
    $result->bindParam(1, $id, PDO::PARAM_INT);
    $result->execute();
    
}

?>