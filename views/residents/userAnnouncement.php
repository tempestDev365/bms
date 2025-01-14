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
                            $fullname = $comment['first_name'] . " " . $comment['middle_name'] . " " . $comment['last_name'];
                            echo "
                            <div class='card-footer'>
                            <h3>Comments:</h3>
                            <p>{$fullname}: {$comment['comment']}</p>
                            <button class='btn btn-danger btn-sm' onclick ='deleteComment({$comment['id']})'>delete</button>
                            <button class='btn btn-primary btn-sm'  data-bs-toggle='modal' data-bs-target = '#editBtn' name = '{$comment['id']}' id = 'edit'>edit</button>
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


    <div class="modal" id="editBtn">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Announcement</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form = "" method="POST" id = "editForm">
                <div class="modal-body">
                        <div class="announcement-content">
                            <label for="content">New Content:</label>
                            <textarea class="form-control" id="content" name="content" required></textarea>
                        </div>
                        
                        <div class="announcement-save mt-3 d-flex justify-content-end">
                           <button class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../components/residentSidebar.js?v=<?php echo time(); ?>" defer type = "module"></script>
     <script type = "module">
     import { notificationCount} from '../components/residentSidebar.js';
    const unread = document.querySelectorAll('.unread');
let count = localStorage.getItem('notificationCount') || 0;
let readNotifications = JSON.parse(localStorage.getItem('readNotifications')) || [];

// Initialize count and mark read notifications
unread.forEach(notification => {
    if (readNotifications.includes(notification.id)) {
        notification.classList.remove('unread');
        notification.classList.add('read');
        notification.querySelector("#markAsReadBtn").style.display = "none";
    } else {
        count++;
    }
});

notificationCount(count);

const markAsReadBtn = document.querySelectorAll("#markAsReadBtn");
const notification = document.querySelectorAll(".notifContainer");

markAsReadBtn.forEach(btn => {
    btn.addEventListener('click', (e) => {
        const id = e.target.getAttribute('data-id');
        for (let i = 0; i < notification.length; i++) {
            if (notification[i].getAttribute('id') == id) {
                notification[i].classList.remove('unread');
                notification[i].classList.add('read');
                markAsReadBtn[i].style.display = "none";
                count--;

                // Save read notification ID to local storage
                readNotifications.push(id);
                localStorage.setItem('readNotifications', JSON.stringify(readNotifications));
                localStorage.setItem('notificationCount', count);
                notificationCount(count);
            }
        }
    });
});
window.deleteComment = async (id) => {
    const api = await fetch(`../../controllers/commentOptionsController.php?id=${id}&action=delete`);
    location.reload();
};
const editButtons = document.querySelectorAll('#edit');
const form = document.querySelector('#editForm'); 
editButtons.forEach(button => {
    button.addEventListener('click', (e) => {
        const id = e.target.name;
        form.action = `../../controllers/commentOptionsController.php?id=${id}&action=edit`;
       
    });
});

</script>
    </script>
</body>
</html>