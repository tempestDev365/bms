<?php
$id = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;

function deleteOfficial($id){
    include '../database/databaseConnection.php';
    $conn = $GLOBALS['conn'];
    $qry = "DELETE FROM officials_db WHERE id = $id";
    $conn->query($qry);
    header('Location: ../views/admin/officials.php');
}
function editOfficial($id){
    $name = $_POST['name'];
    $position = $_POST['position'];
    include '../database/databaseConnection.php';
    $conn = $GLOBALS['conn'];
    $qry = "UPDATE officials_db SET name = ?, role = ? WHERE id = $id";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $position);
    $stmt->execute();
    header('Location: ../views/admin/officials.php');
}
if($action == 'edit'){
    editOfficial($id);
}
if($action == 'delete'){
    deleteOfficial($id);
}

?>