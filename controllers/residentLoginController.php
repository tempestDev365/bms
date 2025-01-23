<?php
include_once "../database/databaseConnection.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $qry = "SELECT r.id, r.username, r.password, a.resident_id
    FROM approved_tbl a 
    JOIN residents_tbl r ON a.resident_id = r.id    
    WHERE r.username = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        header('Location: ../views/residents/residentLogin.php?error=4');
        echo "<script>alert('Account does not exist.');</script>";   
        return;
    }

    $get_account_status = "SELECT status FROM pending_accounts_tbl WHERE resident_id = ?";
    $stmt = $conn->prepare($get_account_status);
    $stmt->bindParam(1, $result['id']);
    $stmt->execute();
    $status = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($status && $status['status'] == "pending") {
        header('Location: ../views/residents/residentLogin.php?error=2');
        echo "<script>alert('Account is still pending.');</script>";   
        return;
    }
    if ($status && $status['status'] == "rejected") {
        header('Location: ../views/residents/residentLogin.php?error=3');
        echo "<script>alert('Account is rejected. Please contact the admin.');</script>";   
        return;
    }

    if ($result && password_verify($password, $result['password'])) {
        session_start();
        $_SESSION['resident_id'] = $result['id'];
        header('Location: ../views/residents/userResident.php');
    } else {
        header('Location: ../views/residents/residentLogin.php?error=1');
        echo "<script>alert('Incorrect password.');</script>";   
    }
}
?>