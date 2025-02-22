<?php
    session_start();
    if(!isset($_SESSION['user_id'])) {
        header('Location: ./residentLogin.php');
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blotter</title>
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


        <div class="container-fluid p-3">
                        <h3>Blotter Schedule</h3>
                        <form action="../../controllers/addBlotterController.php" method="POST">
                            <div class="form-group">
                                <label>Time Of Accident</label>
                                <input type="time" class="form-control" name = "time_of_accident"  required>
                            </div>

                            <div class="form-group mt-2">
                                <label>Place Of Incident</label>
                                <input type="text" name = "place_of_accident" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>Select Date Schedule</label>
                                <input type="date" name="date_schedule" class="form-control" required min="<?php echo date('Y-m-d'); ?>" id="date_schedule">
                            </div>

                            <div class="form-group mt-2">
                                <label>Meeting Time</label>
                                <input type="time" name = "meeting_time" id = "date_selected" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>Description</label>
                                <textarea name="description" class="form-control"  required></textarea>    
                            </div>

                           
                            <div class="form-group mt-2 d-flex justify-content-end">
                                <button class="btn btn-sm btn-success" id="reportBtn">Report</button>
                            </div>
                        </form>
                    </div>
        
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
                        <a class="nav-link" href="./blotter.php">Blotter</a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

document.getElementById('reportBtn').addEventListener('click', function(event) {
    event.preventDefault();
    
    const timeOfAccident = document.querySelector('input[name="time_of_accident"]').value;
    const placeOfAccident = document.querySelector('input[name="place_of_accident"]').value;
    const dateSchedule = document.querySelector('input[name="date_schedule"]').value;
    const meetingTime = document.querySelector('input[name="meeting_time"]').value;
    const description = document.querySelector('textarea[name="description"]').value;

    if (!timeOfAccident || !placeOfAccident || !dateSchedule || !meetingTime || !description) {
        Swal.fire({
            icon: 'error',
            title: 'Incomplete Form',
            text: 'Please fill in all fields before submitting.',
            showConfirmButton: true
        });
        return;
    }

    Swal.fire({
        icon: 'success',
        title: 'Submission Successful!',
        text: 'Your blotter report has been submitted successfully and expired within 24 hours.',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        document.querySelector('form').submit();
    });
});

function setExpiry() {
    const now = new Date();
    const expiryDate = new Date(now.getTime() + 24 * 60 * 60 * 1000); // 24 hours from now
    document.cookie = `blotterExpiry=true; expires=${expiryDate.toUTCString()}; path=/`;
}

document.querySelector('form').addEventListener('submit', setExpiry);

document.getElementById('date_schedule').addEventListener('blur', function() {
    if (this.value) {
        const selectedDate = new Date(this.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selectedDate < today) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Date',
                text: 'Please select a future date.',
                showConfirmButton: true
            });
            this.value = '';
        }
    }
});
</script>
</body>
</html>