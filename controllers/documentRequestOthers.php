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
    $name = $_POST['name'];
    if(checkIfUserExist($name) == false){
        
        header('Location: ../views/residents/userDocument.php?error=1');
        exit();
    }
    $document= $_POST['selectDocument'];
    $purpose = $_POST['purpose'];
    $proof = isset($_FILES['proof']['tmp_name']) ? base64_encode(resizeImage($_FILES['proof']['tmp_name'],250,250)) : null;
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
function checkIfUserExist($full_name){
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM residents_information WHERE CONCAT(first_name, ' ', last_name) = :full_name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':full_name', $full_name, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}
?>