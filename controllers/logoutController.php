<?php
session_start();
if(isset($_SESSION['admin'])) {
    session_unset();
    session_destroy();
    header('Location: ../views/admin/adminLogin.php');
}else{
    session_unset();
    session_destroy();
    header('Location: ../views/residents/residentLogin.php');
}


?>