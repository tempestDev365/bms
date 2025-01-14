<?php
$id = $_GET['id'];
$action = $_GET['action'];
function viewConcern($id){
    include_once "../database/databaseConnection.php";
    $sql = "SELECT * FROM concerns_tbl WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $concern = $stmt->fetch();
    return [
        'concern_id'=>$concern['id'],   
        'concern_title'=>$concern['concern_title'],
        'concern_message'=>$concern['concern_message'],

    ];
}
if($action == 'view'){
    $concern = viewConcern($id);
    header('Content-Type: application/json');
    echo json_encode($concern);
}
?>