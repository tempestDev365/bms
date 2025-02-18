<?php
session_start();

$count = 0;
function getAllDocumentRequested($id){
    include_once "../../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM document_requested WHERE resident_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    return $stmt->fetchAll();
}
function getAllConcernsReplies(){
    include_once "../../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    $sql = "SELECT cr.*,c.id,c.resident_id 
    FROM concerns_replies_tbl cr
    JOIN concerns_tbl c 
    ON cr.concern_id = c.id
    WHERE c.resident_id = {$_SESSION['user_id']}";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
$allDocumentRequested = getAllDocumentRequested($_SESSION['user_id']);
$allConcernsReplies = getAllConcernsReplies();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
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
      .read {
        background-color: #f0f0f0; /* Light gray background */
        color: #888; /* Gray text color */
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
                        <li class="breadcrumb-item"><a href="./userResident.php">Notification</a></li>
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
                <h2>Notifications</h2>

                <div class="notification-container p-3" style="gap: 5px;">
                    <?php foreach($allDocumentRequested as $document): ?>
                        <?php 
                        $status = $document['status'] == "approved" ? "approved" : "rejected";    
                        ?>
                        <div class="notification">
                            <div class="notification-content">
                               <div class="notifContainer unread" id = "<?php echo $count ?>"   >
                                <input type="text" value = "<?php echo $_SESSION['resident_id']; ?>" hidden>
                                <h5 class="notification-title">Document Request</h5>
                                <p class="notification-message">Your request for <strong><?php echo $document['document']; ?></strong> has been <?php echo $status?>.</p>
                                <p class="notification-date"><?php echo $document['time_Created']; ?></p>
                                <button id = "markAsReadBtn" data-id = "<?php echo $count ?>">Mark As Read</button>
                            </div>
                            </div>
                            <?php $count ++?>
                        </div>
                    <?php endforeach; ?>
                    
                    <?php foreach($allConcernsReplies as $replies): ?>
                        <div class="notification">
                            <div class="notification-content">
                               <div class="notifContainer unread" id =  "<?php echo $count ?>">
                                <h5 class="notification-title">Concern reply</h5>
                                <p class="notification-message">The admin has replied to your concern:</p>
                                <p class="notification-date"><?php echo $replies['message']; ?></p>
                                <button id = "markAsReadBtn" data-id =  "<?php echo $count ?>">Mark As Read</button>
                               </div>
                            <?php  $count ++?>

                            </div>
                        </div>
                    <?php endforeach; ?>
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
    <script src="../components/residentSidebar.js?v=<?php echo time(); ?>" defer type = "module"></script>
     <script type = "module">
     import { notificationCount} from '../components/residentSidebar.js';
    const unread = document.querySelectorAll('.unread');
let count = localStorage.getItem('notificationCount') || 0;
let readNotifications = JSON.parse(localStorage.getItem('readNotification<?=$_SESSION['resident_id']?>')) || [];
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
                readNotifications.push(id);
                localStorage.setItem('readNotification<?= $_SESSION['resident_id']?>', JSON.stringify(readNotifications));
                localStorage.setItem('notificationCount', count);
                notificationCount(count);
            }
        }
    });
});
    </script>
</body>
</html>