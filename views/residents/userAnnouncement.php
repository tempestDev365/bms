<?php
require_once '../../database/databaseConnection.php';
include '../../controllers/getAllResidentInformationController.php';
session_start();
if(!isset($_SESSION['resident_id'])) {
    header('Location: ./residentLogin.php');
}
$qry = "SELECT * FROM residents_tbl WHERE id = ?";
$stmt = $conn->prepare($qry);
$stmt->bindParam(1, $_SESSION['resident_id']);
$stmt->execute();
$resident_information = $stmt->fetch(PDO::FETCH_ASSOC);
$resident_fullname = $resident_information['first_name'] . " " . $resident_information['middle_name'] . " " . $resident_information['last_name'];
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
    $qry = "SELECT c.*,r.first_name, r.middle_name, r.last_name
       
     FROM comments_tbl c
     JOIN residents_tbl r ON c.resident_id = r.id

     WHERE announcement_id = ?";
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

                <button class="navbar-toggler navbar-light bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                            $fullname = $comment['first_name'] . " " . $comment['middle_name'] . " " . $comment['last_name'];
                            echo "
                            <div class='card-footer'>
                            <h3>Comments:</h3>
                            <p>{$fullname}: {$comment['comment']}</p>
                        </div>";
                       
                        }else{
                            echo "<p>No comments</p>";
                        }
                    }
                    echo"
                         <form action='../../controllers/addCommentsController.php' method = 'POST'>
                            <div class='card-input-comments mt-3'>
                                <textarea name='comment' id='comment' placeholder='Comment as {$resident_fullname}' class='form-control'></textarea>
                                <input type='hidden' name='announcement_id' value='{$announcement['id']}'>
                                 <input type='hidden' name='resident_id' value='{$_SESSION['resident_id']}'>

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


    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../components/residentSidebar.js?v=<?php echo time(); ?>" defer></script>
</body>
</html>