<?php
include '../database/databaseConnection.php';
$GLOBALS['conn'] = $conn;

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
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars($_POST['titleAnnouncement']);
    $content = htmlspecialchars($_POST['content']);
    $image = isset($_FILES['image']['tmp_name']) ? base64_encode(resizeImage($_FILES['image']['tmp_name'],250,250)) : null;
    $sql = "INSERT INTO announcement_tbl (title, content,image) VALUES (?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $title, PDO::PARAM_STR);
    $stmt->bindParam(2, $content, PDO::PARAM_STR);
    $stmt->bindParam(3, $image, PDO::PARAM_LOB);
    $stmt->execute();
    header('Location: ../views/admin/announcement.php');
}
?>