<?php
include '../database/databaseConnection.php';
$id = $_GET['id'];
if($_GET['action'] == "approve"){
    approveAccount($id);
}
if($_GET['action'] == "reject"){
    rejectAccount($id);
}



function approveAccount($id){
   try{
    $conn = $GLOBALS['conn'];
    $check_status = "SELECT * FROM `pending_accounts_tbl` WHERE `id` = ?";
    $status_result = $conn->prepare($check_status);
    $status_result->bindParam(1, $id, PDO::PARAM_INT); 
    $status_result->execute();
    $get_status = $status_result->fetch(PDO::FETCH_ASSOC);
  
    $qry = "DELETE FROM `pending_accounts_tbl` WHERE `id` = ?";
    $result = $conn->prepare($qry);
    $result->bindParam(1, $id, PDO::PARAM_INT);
    $result->execute();
    $insert_into_approved_qry = "INSERT INTO approved_tbl (name,resident_id,time_Created) VALUES (?,?,NOW())";
    $insert_into_approved_result = $conn->prepare($insert_into_approved_qry);
    $insert_into_approved_result->bindParam(1, $get_status['Name'], PDO::PARAM_STR);
    $insert_into_approved_result->bindParam(2, $get_status['resident_id'], PDO::PARAM_INT);
    $insert_into_approved_result->execute();
    echo json_encode("success");
   }catch(Exception $e){
         echo json_encode($e->getMessage());
   }
}
function rejectAccount($id){
    try{
        
     $conn = $GLOBALS['conn'];
     $check_status = "SELECT * FROM `pending_accounts_tbl` WHERE `id` = ?";
    $status_result = $conn->prepare($check_status);
    $status_result->bindParam(1, $id, PDO::PARAM_INT); 
    $status_result->execute();
    $get_status = $status_result->fetch(PDO::FETCH_ASSOC);  
     $qry = "UPDATE `pending_accounts_tbl` SET `status` = 'rejected' WHERE `id` = ?";       
      $result = $conn->prepare($qry);
        $result->bindParam(1, $id, PDO::PARAM_INT);
        $result->execute();
        $insert_into_rejected_qry = "INSERT INTO rejected_tbl (name,resident_id,time_Created) VALUES (?,?,NOW())";
        $insert_into_rejected_result = $conn->prepare($insert_into_rejected_qry);
        $insert_into_rejected_result->bindParam(1, $get_status['Name'], PDO::PARAM_STR);
        $insert_into_rejected_result->bindParam(2, $get_status['resident_id'], PDO::PARAM_INT);
        $insert_into_rejected_result->execute();
        
    
    echo json_encode("success");
   }catch(Exception $e){
       echo json_encode("failed");
   }
}

?>