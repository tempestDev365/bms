<?php
include '../database/databaseConnection.php';
$GLOBALS['conn'] = $conn;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars($_POST['titleAnnouncement']);
    $content = htmlspecialchars($_POST['content']);
    $sql = "INSERT INTO announcement_tbl (title, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $title, PDO::PARAM_STR);
    $stmt->bindParam(2, $content, PDO::PARAM_STR);
    $stmt->execute();
    header('Location: ../views/admin/main.php');
}
?>