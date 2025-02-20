<?php
session_start();
function getAllResidentInformation($id){
    include '../../database/databaseConnection.php';
    $qry = "SELECT * FROM residents_information WHERE id = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $resident_information = $stmt->fetch();
    $personal_information_qry = "SELECT * FROM residents_personal_information WHERE resident_id = ?";
    $stmt = $conn->prepare($personal_information_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $personal_information = $stmt->fetch();
    $additional_information_qry = "SELECT * FROM residents_additional_information WHERE resident_id = ?";
    $stmt = $conn->prepare($additional_information_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $additional_information = $stmt->fetch();
    $contact_information_qry = "SELECT * FROM residents_contact_information WHERE resident_id = ?";
    $stmt = $conn->prepare($contact_information_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $contact_information = $stmt->fetch();
    return [
        'resident_information' => $resident_information,
        'personal_information' => $personal_information,
        'additional_information' => $additional_information,
        'contact_information' => $contact_information
    ];
}
$resident_information = getAllResidentInformation($_SESSION['user_id']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brgy. Sinabanali</title>
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
                        <li class="breadcrumb-item"><a href="./userResident.php">Profile</a></li>
                    </ol>
                </nav>

                <button class="navbar-toggler navbar-light bg-light"
                        type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#mobile-sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="id-section mt-3">
                <div class="container-id border bg-white p-3 d-flex justify-content-center" style="gap: 1rem; flex-wrap: wrap;">
                     <img src="data:image/gif;base64,<?php echo $resident_information['personal_information']['resident_picture']; ?>" class="img-fluid" style="width:300px; height:200px" alt="Resident Picture">
                    <img src="data:image/gif;base64,<?php echo $resident_information['personal_information']['valid_id']; ?>" class="img-fluid" style="width:300px; height:200px" alt="Resident Picture">

                </div>
            </div>

            <div class="info-section mt-3">
                <div class="box bg-white shadow-sm border rounded-3 p-3">
                  
                
                   <div class='box-body row'>
                        <div class='personal-info col-md-12 col-lg-4 d-flex flex-column' style='gap: 5px;'>
                            <div class='box-header'>
                                <h4>Personal Information</h4>
                            </div>
                            <label class='first_name'>First Name: <?php echo $resident_information['resident_information']['first_name'] ?? ''; ?></label>
<label>Middle Name: <?php echo $resident_information['resident_information']['middle_name'] ?? ''; ?></label>
<label>Last Name: <?php echo $resident_information['resident_information']['last_name'] ?? ''; ?></label>
<label>Suffix: <?php echo $resident_information['resident_information']['suffix'] ?? ''; ?></label>
<label>Age: <?php echo $resident_information['resident_information']['age'] ?? ''; ?></label>
<label>Date Of Birth: <?php echo $resident_information['resident_information']['birthday'] ?? ''; ?></label>
<label>Civil Status: <?php echo $resident_information['resident_information']['civil_status'] ?? ''; ?></label>
<label>Purok: <?php echo $resident_information['resident_information']['purok'] ?? ''; ?></label>
<label>House Number: <?php echo $resident_information['resident_information']['house_number'] ?? ''; ?></label>
<label>Street: <?php echo $resident_information['resident_information']['street'] ?? ''; ?></label>
<label>Birth Place: <?php echo $resident_information['personal_information']['birth_place'] ?? ''; ?></label>
<label>Height: <?php echo $resident_information['personal_information']['height'] ?? ''; ?></label>
<label>Weight: <?php echo $resident_information['personal_information']['weight'] ?? ''; ?></label>
<label>Blood Type: <?php echo $resident_information['personal_information']['blood_type'] ?? ''; ?></label>
<label>Religion: <?php echo $resident_information['personal_information']['religion'] ?? ''; ?></label>
<label>Nationality: <?php echo $resident_information['personal_information']['nationality'] ?? ''; ?></label>
<label>Registered Voter: <?php echo $resident_information['personal_information']['registered_voter'] ?? ''; ?></label>
<label>Organization Member: <?php echo $resident_information['personal_information']['organization_member'] ?? ''; ?></label>
</div>

<div class='contact-header col-md-12 col-lg-4 d-flex flex-column' style='gap: 5px;'>
    <h4>Additional Information:</h4>
    <label>Employment Status: <?php echo $resident_information['additional_information']['employment_status'] ?? ''; ?></label>
    <label>Employment Field: <?php echo $resident_information['additional_information']['employment_field'] ?? ''; ?></label>
    <label>Occupation: <?php echo $resident_information['additional_information']['occupation'] ?? ''; ?></label>
    <label>Monthly Income: <?php echo $resident_information['additional_information']['monthly_income'] ?? ''; ?></label>
    <label>Higher Education Attainment: <?php echo $resident_information['additional_information']['highest_educational_attainment'] ?? ''; ?></label>
    <label>Type Of School: <?php echo $resident_information['additional_information']['type_of_school'] ?? ''; ?></label>
     
    <h4 class='mt-2'>Contact Information:</h4>
    <label>Phone Number: <?php echo $resident_information['contact_information']['phone_number'] ?? ''; ?></label>
    <label>Email: <?php echo $resident_information['contact_information']['email'] ?? ''; ?></label>
    <label>Tel No.: <?php echo $resident_information['contact_information']['tel_no'] ?? ''; ?></label>
</div>
                               
                        </div>
               
                  <div class="edit d-flex justify-content-end mt-3">
                <button class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#editInfo">EDIT</button>
            </div>
                    </div>
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


    <!-- Edit Modal -->
    <div class="modal fade" id="editInfo">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Information</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="../../controllers/updateResidentController.php" method="POST" enctype="multipart/form-data">
                        <div class="info-section mt-3">
                            <div class="box bg-white shadow-sm border rounded-3 p-3">
                                <div class="box-body row">
                                    <div class="personal-info col-md-12 col-lg-4 d-flex flex-column" style="gap: 5px;">
                                        <div class="box-header">
                                            <h4>Personal Information</h4>
                                        </div>
                                                                   <label>First Name:</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $resident_information['resident_information']['first_name'] ?? ''; ?>">
                                        <label>Middle Name:</label>
                                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $resident_information['resident_information']['middle_name'] ?? ''; ?>">
                                        <label>Last Name:</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $resident_information['resident_information']['last_name'] ?? ''; ?>">
                                        <label>Suffix:</label>
                                        <input type="text" class="form-control" id="suffix" name="suffix" value="<?php echo $resident_information['resident_information']['suffix'] ?? ''; ?>">
                                        <label>Age:</label>
                                        <input type="number" class="form-control" id="age" name="age" value="<?php echo $resident_information['resident_information']['age'] ?? ''; ?>">
                                        <label>Date Of Birth:</label>
                                        <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $resident_information['resident_information']['birthday'] ?? ''; ?>">
                                        <label>Civil Status:</label>
                                        <input type="text" class="form-control" id="civil_status" name="civil_status" value="<?php echo $resident_information['resident_information']['civil_status'] ?? ''; ?>">
                                        <label>Purok:</label>
                                        <input type="text" class="form-control" id="purok" name="purok" value="<?php echo $resident_information['resident_information']['purok'] ?? ''; ?>">
                                        <label>House Number:</label>
                                        <input type="text" class="form-control" id="house_number" name="house_number" value="<?php echo $resident_information['resident_information']['house_number'] ?? ''; ?>">
                                        <label>Street:</label>
                                        <input type="text" class="form-control" id="street" name="street" value="<?php echo $resident_information['resident_information']['street'] ?? ''; ?>">
                                        <label>Birth Place:</label>
                                        <input type="text" class="form-control" id="birthplace" name="birthplace" value="<?php echo $resident_information['personal_information']['birth_place'] ?? ''; ?>">
                                        <label>Height:</label>
                                        <input type="text" class="form-control" id="height" name="height" value="<?php echo $resident_information['personal_information']['height'] ?? ''; ?>">
                                        <label>Weight:</label>
                                        <input type="text" class="form-control" id="weight" name="weight" value="<?php echo $resident_information['personal_information']['weight'] ?? ''; ?>">
                                        <label>Blood Type:</label>
                                        <input type="text" class="form-control" id="blood_type" name="blood_type" value="<?php echo $resident_information['personal_information']['blood_type'] ?? ''; ?>">
                                        <label>Religion:</label>
                                        <input type="text" class="form-control" id="religion" name="religion" value="<?php echo $resident_information['personal_information']['religion'] ?? ''; ?>">
                                        <label>Nationality:</label>
                                        <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $resident_information['personal_information']['nationality'] ?? ''; ?>">
                                        <select class="form-select" id="registered_voter" name="registered_voter">
                                            <option value="YES" <?php echo $resident_information['personal_information']['registered_voter'] == "Yes" ? "selected": ""?>>YES</option>
                                            <option value="NO" <?php echo $resident_information['personal_information']['registered_voter'] == "No" ? "selected": ""?>>NO</option>
                                        </select>
                                        <label>Organization Member:</label>
                                        <input type="text" class="form-control" id="organization_member" name="organization_member" value="<?php echo $resident_information['personal_information']['organization_member'] ?? ''; ?>">
                                        </div>
                                        <div class="other-info col-md-12 col-lg-4 d-flex flex-column" style="gap: 5px;">
                                            <div class="contact-header">
                                                <h4>Additional Information</h4>
                                            </div>
                                            <label>Employment Status:</label>
                                            <input type="text" class="form-control" id="employment_status" name="employment_status" value="<?php echo $resident_information['additional_information']['employment_status'] ?? ''; ?>">
                                            <label>Employment Field:</label>
                                            <input type="text" class="form-control" id="employment_field" name="employment_field" value="<?php echo $resident_information['additional_information']['employment_field'] ?? ''; ?>">
                                            <label>Occupation:</label>
                                            <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo $resident_information['additional_information']['occupation'] ?? ''; ?>">
                                            <label>Monthly Income:</label>
                                            <input type="text" class="form-control" id="monthly_income" name="monthly_income" value="<?php echo $resident_information['additional_information']['monthly_income'] ?? ''; ?>">
                                            <label>Higher Education Attainment:</label>
                                            <input type="text" class="form-control" id="highest_education" name="highest_education" value="<?php echo $resident_information['additional_information']['highest_educational_attainment'] ?? ''; ?>">
                                            <label>Type Of School:</label>
                                            <input type="text" class="form-control" id="type_of_school" name="type_of_school" value="<?php echo $resident_information['additional_information']['type_of_school'] ?? ''; ?>">
                                            <h4 class="mt-2">Contact Information</h4>
                                            <label>Phone Number:</label>
                                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="<?php echo $resident_information['contact_information']['phone_number'] ?? ''; ?>">
                                            <label>Email:</label>
                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $resident_information['contact_information']['email'] ?? ''; ?>">
                                            <label>Tel No.:</label>
                                            <input type="text" class="form-control" id="tel_no" name="tel_no" value="<?php echo $resident_information['contact_information']['tel_no'] ?? ''; ?>">
                                        </div>
                    <div class="other-info-2 col-md-12 col-lg-4 d-flex flex-column" style="gap: 5px;">
                        <div class="contact-header">
                            <h4>Images</h4>
                        </div>
                        <label>Resident Picture:</label>
                        <input type="file" class="form-control" id="picture" name="picture">
                        <label>Valid ID:</label>
                        <input type="file" class="form-control" id="valid_id" name="valid_id">
                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
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
function populateModal(){
    
}
populateModal()
    </script>
</body>
</html>