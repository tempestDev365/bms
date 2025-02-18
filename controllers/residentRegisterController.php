<?php

ini_set("display_errors", "1");
error_reporting(E_ALL);

include_once '../database/databaseConnection.php';
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
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $middleName = $_POST['middle_name'];
    $suffix = $_POST['suffix'] ?? "";
    $sex = $_POST['sex'];
    $birthDate = $_POST['birthday'];
    $age = $_POST['age'];
    $civil_status = $_POST['civil_status'];
    $purok = $_POST['purok'];
    $house_number = $_POST['house_number'];
    $street = $_POST['street'];
    $house_owner = $_POST['house_owner'];
    $employment_status = $_POST['employment_status'];
    $front_id = isset($_FILES['frontID']['tmp_name']) ? base64_encode(resizeImage($_FILES['frontID']['tmp_name'],250,250)) : null;
    $back_id = isset($_FILES['backID']['tmp_name']) ? base64_encode(resizeImage($_FILES['backID']['tmp_name'],250,250)) : null;
    $qry = "INSERT INTO `residents_information`( `first_name`, `middle_name`, `last_name`, `email`, `suffix`, `sex`, `age`,  `birthday`, `civil_status`, `purok`, `house_number`, `street`, `house_owner`, `id_front`, `id_back`, `time_Created`) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1,$firstName);
    $stmt->bindParam(2,$middleName);
    $stmt->bindParam(3,$lastName);
    $stmt->bindParam(4,$email);
    $stmt->bindParam(5,$suffix);
    $stmt->bindParam(6,$sex);
    $stmt->bindParam(7,$age);
    $stmt->bindParam(8,$birthDate);
    $stmt->bindParam(9,$civil_status);
    $stmt->bindParam(10,$purok);
    $stmt->bindParam(11,$house_number);
    $stmt->bindParam(12,$street);
    $stmt->bindParam(13,$house_owner);
    $stmt->bindParam(14,$front_id);
    $stmt->bindParam(15,$back_id);
    
    $stmt->execute();
    unset($_SESSION['email']);

    header("Location: ../views/residents/residentLogin.php?success=1");

}

?>