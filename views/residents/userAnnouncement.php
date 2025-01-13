<?php
require_once '../../database/databaseConnection.php';
include '../../controllers/getAllResidentInformationController.php';
session_start();
if(!isset($_SESSION['resident_id'])) {
    header('Location: ./residentLogin.php');
}
$resident_information = getAllResidentInformation($_SESSION['resident_id']);
function getAllAnnouncement(){
    $conn = $GLOBALS['conn'];
    $qry = "SELECT * FROM announcement_tbl";
    $result = $conn->prepare($qry);
    $result->execute();
    $announcement = $result->fetchAll(PDO::FETCH_ASSOC);
    return $announcement;
}

function getComments( $announcement_id){
    $conn = $GLOBALS['conn'];
    $qry = "SELECT * FROM comments_tbl WHERE announcement_id = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $announcement_id);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $comments;
}
$announcements = getAllAnnouncement();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement</title>
    <link rel="shortcut icon" href="../../assets/img/logo-125.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
      @media (min-width: 701px) {
        .navbar-toggler {
            display: none !important;   
        }
    }

    @media (max-width: 700px) {

    .resident-sidebar {
        display: none !important;
    }

    .navbar-toggler {
        display: block !important;
        }
    }
</style>
<body>

    <div class="user-page d-flex" style="min-height: 100vh; min-width: 100%;"> 
        <div class="resident-sidebar">
            <!-- Sidebar header -->
        </div>

        <main class="flex-grow-1 p-3 bg-light" style="max-height: 100vh; overflow-y: scroll;">

            <div class="container-fluid d-flex justify-content-between align-items-center"> 
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Resident</li>
                        <li class="breadcrumb-item"><a href="./userResident.php">Announcement</a></li>
                    </ol>
                </nav>

                <button class="navbar-toggler navbar-light bg-light"
                        type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#mobile-sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="container-fluid p-3">
                <h2>Announcements</h2>

                <!--ANNOUNCEMENT DISPLAYED-->
                
                <div class="card mt-3">
                    <?php
                    foreach($announcements as $announcement){
                      
                        $comments = getComments($announcement['id']);
                        echo "
                        <div class='card-header'>
                        <p>Title: {$announcement['title']}</p>
                    </div>
                    <div class='card-body'>
                        <p>Content:{$announcement['content']}</p>
                    </div>";
                     
                    foreach($comments as $comment){
                        if($comment['announcement_id'] == $announcement['id']){
                            echo "
                            <div class='card-footer'>
                            <p>Comment: {$comment['comment']}</p>
                        </div>";
                       
                        }else{
                            echo "<p>No comments</p>";
                        }
                    }
                    echo"
                         <form action='../../controllers/addCommentsController.php' method = 'POST'>
                            <div class='card-input-comments mt-3'>
                                <textarea name='comment' id='comment' placeholder='Comment as {$resident_information['resident_fullname']}' class='form-control'></textarea>
                                <input type='hidden' name='announcement_id' value='{$announcement['id']}'>
                            </div>
                            <div class='comment-input-action mt-2 d-flex justify-content-end'>
                                <input type='submit' value='Comment' class='btn btn-secondary btn-sm'>
                            </div>
                        </form>
                        "
                        ;
                    }
                     
                    ?>
                </div>


            </div>

       

        </main>
    </div>

    <!--Offcanvas sidebar-->
    <div class="offcanvas offcanvas-end" id="mobile-sidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Brgy.Sinbanali</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="./userResident.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./userAnnouncement.php">Announcement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./userDocument.php">Document Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./userNotification.php">Notification</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./userResidentLogout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        
    </div>


    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../components/residentSidebar.js?v=<?php echo time(); ?>" defer></script>
</body>
</html>