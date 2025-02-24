<?php
session_start();
function resizeImage($file, $max_width, $max_height) {
    list($width, $height) = getimagesize($file);
    $ratio = $width / $height;

    if ($max_width / $max_height > $ratio) {
        $max_width = $max_height * $ratio;
    } else {
        $max_height = $max_width / $ratio;
    }

    $src = imagecreatefromstring(file_get_contents($file));
    $dst = imagecreatetruecolor($max_width, $max_height);

    imagecopyresampled($dst, $src, 0, 0, 0, 0, $max_width, $max_height, $width, $height);

    ob_start();
    imagejpeg($dst);
    $data = ob_get_contents();
    ob_end_clean();

    imagedestroy($src);
    imagedestroy($dst);

    return $data;
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include_once '../database/databaseConnection.php';
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'] ?? " ";
    $last_name = $_POST['last_name'];
     $document= $_POST['selectDocument'];
    $purpose = $_POST['purpose'];
    $proof = isset($_FILES['proof']['tmp_name']) ? base64_encode(resizeImage($_FILES['proof']['tmp_name'],250,250)) : null;
    $name = $first_name." ".$middle_name." ".$last_name;
    if(checkIfUserExist($first_name,$middle_name,$last_name) == false){
        
        header('Location: ../views/residents/userDocument.php?error=1');
        exit();
    }
    if(checkIfDocumentRequestExist($name,$_POST['selectDocument']) == true){
        header('Location: ../views/residents/userDocument.php?error=2');
        exit();
    }
   
    $qry = "INSERT INTO `documents_requested_for_others`( `resident_id`, `name`, `document_type`, `purpose`,`proof`,`status`, `time_Created`)
     VALUES (?,?,?,?,?,'pending', NOW())";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1,$_SESSION['user_id']);
    $stmt->bindParam(2,$name);
    $stmt->bindParam(3,$document);
    $stmt->bindParam(4,$purpose);
    $stmt->bindParam(5,$proof);

    $stmt->execute();
     header('Location: ../views/residents/userDocument.php');

}
function checkIfUserExist($first_name, $middle_name, $last_name){
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM residents_information WHERE first_name = '$first_name' AND middle_name = '$middle_name' AND last_name = '$last_name'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}
function checkIfDocumentRequestExist($name, $document){
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM documents_requested_for_others WHERE name = '$name' AND document_type = '$document' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}
?>