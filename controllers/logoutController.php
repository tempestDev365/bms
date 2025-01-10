<?php
session_start();
if(isset($_SESSION['admin'])) {
    header('Location: ../views/admin/adminLogin.php');
}else{
    header('Location: ../views/residents/residentLogin.php');
}
session_destroy();
session_unset();

?>