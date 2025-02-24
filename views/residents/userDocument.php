<?php
include '../../database/databaseConnection.php';
session_start();
if(!isset($_SESSION['user_id'])) {
    header('Location: ./residentLogin.php');
}
function getDocumentRequested($id){
    $conn = $GLOBALS['conn'];
    $qry = "SELECT * FROM document_requested WHERE resident_id = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $document_requested = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $document_requested;
}
function getOthersDocumentRequested($id){
    $conn = $GLOBALS['conn'];
    $qry = "SELECT * FROM documents_requested_for_others WHERE resident_id = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $document_requested = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $document_requested;
}

$others = getOthersDocumentRequested($_SESSION['user_id']);
$document_requested = getDocumentRequested($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Request</title>
    <link rel="shortcut icon" href="../../assets/img/logo-125.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                        <li class="breadcrumb-item"><a href="./userResident.php">Document Request</a></li>
                    </ol>
                </nav>

                <button class="navbar-toggler navbar-light bg-light"
                        type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#mobile-sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="container-fluid">
                <h2>Document Request</h2>

                <div class="container-fluid p-3 rounded-3 bg-white shadow-sm border">
                    <form action="../../controllers/documentRequestController.php" method="POST" onsubmit="showSweetAlert(event)">
                        <div class="form-group">
                            <label>SELECT TYPE OF DOCUMENT</label>
                            <select name="selectDocument" id="selectDocument" class="form-control">
                                <option value="barangay_id">Barangay ID</option>
                                <option value="barangay_certificate">Barangay Certificate</option>
                                <option value="barangay_indigency">Barangay Indigency</option>
                                <option value="certificate_resident">CERTIFICATE FOR RESIDENT</option>
                                <option value="certificate_non_resident">CERTIFICATE FOR NON RESIDENT</option>
                                <option value="certificate_business">CERTIFICATE FOR BUSINESS PERMIT</option>
                                <option value="certificate_guardian">CERTIFICATE FOR GUARDIANSHIP</option>
                                <option value="certificate_disaster">CERTIFICATE FOR DISASTER</option>
                                <option value="certificate_relationship">CERTIFICATE FOR RELATIONSHIP</option>
                                <option value="certificate_job_seeker">CERTIFICATE FOR FIRST TIME JOB SEEKER</option>
                                <option value="certificate_src_income">CERTIFICATE FOR NO SOURCE OF INCOME</option>
                                <option value="single_parent">SINGLE PARENT CERTIFICATE</option>

                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label>PURPOSE OF REQUEST</label>
                            <textarea name="purpose" id="purpose" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="form-group d-flex justify-content-end" style="gap: 5px;">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#requestForOthers" class="btn btn-primary btn-sm mt-3">
                                Request for Other Person                                
                            </button>
                            <input type="submit" value="Submit Request" class="btn btn-primary btn-sm mt-3">
                        </div>
                    </form>
                </div>

                <div class="container-fluid p-3 rounded-3 bg-white mt-3 shadow-sm border">
                    <label>REQUEST TRACKER</label>
                        <table class="table table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th>Tracking Number(TRN)</th>
                                    <th>Document Type</th>
                                    <th>Date Of Request</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($document_requested as $document){
                                        echo '<tr>';
                                        echo '<td>'.$document['id'].'</td>';
                                        echo '<td>'.$document['document'].'</td>';
                                        echo '<td>'.$document['time_Created'].'</td>';
                                        echo '<td>'.$document['status'].'</td>';
                                        echo '</tr>';
                                    }
                                    foreach($others as $document){
                                        echo '<tr>';
                                        echo '<td>'.$document['id'].'</td>';
                                        echo '<td>'.$document['document_type'].'</td>';
                                        echo '<td>'.$document['time_Created'].'</td>';
                                        echo '<td>'.$document['status'].'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
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
                        <a class="nav-link" href="./blotter.php">Blotter Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./residentConcerns.php">Concerns</a>
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


    <!--modal-->
    <div class="modal fade" id="requestForOthers">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request for Other Person</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form">
                        <form action="../../controllers/documentRequestOthers.php" method="POST" enctype="multipart/form-data"> 
                        <div class="form-group">
                            <label for="">First Name:</label>
                            <input type="text" class="form-control" name = "first_name" required>

                            <label for="">Last Name:</label>
                            <input type="text" class="form-control" name = "last_name" required>
                            <label for="">Middle Name:</label>
                            <input type="text" class="form-control" name = "middle_name">
                        </div>
                        <div class="form-group mt-3" >
                            <label>SELECT TYPE OF DOCUMENT</label>
                            <select name="selectDocument" id="selectDocument" class="form-control">
                                <option value="barangay_id">Barangay ID</option>
                                <option value="barangay_certificate">Barangay Certificate</option>
                                <option value="barangay_indigency">Barangay Indigency</option>
                                <option value="certificate_resident">CERTIFICATE FOR RESIDENT</option>
                                <option value="certificate_non_resident">CERTIFICATE FOR NON RESIDENT</option>
                                <option value="certificate_business">CERTIFICATE FOR BUSINESS PERMIT</option>
                                <option value="certificate_guardian">CERTIFICATE FOR GUARDIANSHIP</option>
                                <option value="certificate_disaster">CERTIFICATE FOR DISASTER</option>
                                <option value="certificate_relationship">CERTIFICATE FOR RELATIONSHIP</option>
                                <option value="certificate_job_seeker">CERTIFICATE FOR FIRST TIME JOB SEEKER</option>
                                <option value="certificate_src_income">CERTIFICATE FOR NO SOURCE OF INCOME</option>
                                <option value="single_parent">SINGLE PARENT CERTIFICATE</option>

                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label>PURPOSE OF REQUEST</label>
                            <textarea name="purpose" id="purpose" class="form-control" rows="3"></textarea>
                        </div>


                        <div class="form-group mt-3">
                            <label>PROOF OF REQUEST</label>
                            <input type="file" name = "proof" required class="form-control">
                            <label class="text-secondary mt-2" style="font-size: 0.8rem">Please upload proof of the other person making the request, such as an ID picture or a letter with a signature</label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit Request</button>
                 </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>


    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>

    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true
        });
    });

    function showSweetAlert(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Information',
            text: 'The total cost is only 20 pesos. However, students, persons with disabilities (PWDs), and senior citizens may avail of free admission.',
            icon: 'info',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });
    }
    </script>

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
const params = new URLSearchParams(window.location.search);
if(params.get('error') == 1){
    Swal.fire({
        title: 'Error',
        text: 'User does not exist',
        icon: 'error',
        confirmButtonText: 'OK'
    });
}
if(params.get('error') == 2){
    Swal.fire({
        title: 'Error',
        text: 'You already requested for this document',
        icon: 'error',
        confirmButtonText: 'OK'
    });
}

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
    </script>
</html>