<?php
session_start();

function getAllResidentInformation($id){
    include '../../database/databaseConnection.php';
    $conn = $GLOBALS['conn'];

    $resident_tbl_qry = "SELECT * FROM residents_tbl WHERE id = ?";
    $stmt = $conn->prepare($resident_tbl_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $resident_tbl_result = $stmt->fetch();

    $resident_address_qry = "SELECT * FROM residents_address WHERE resident_id = ?";
    $stmt = $conn->prepare($resident_address_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $resident_address_result = $stmt->fetch();

    $resident_contact_qry = "SELECT * FROM residents_contacts WHERE residents_id = ?";
    $stmt = $conn->prepare($resident_contact_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $resident_contact_result = $stmt->fetch();

    $resident_family_qry = "SELECT * FROM residents_family WHERE resident_id = ?";
    $stmt = $conn->prepare($resident_family_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $resident_family_result = $stmt->fetch();

    $resident_information_qry = "SELECT * FROM resident_information WHERE resident_id = ?";
    $stmt = $conn->prepare($resident_information_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $resident_information_result = $stmt->fetch();

    $resident_employment_qry = "SELECT * FROM residents_employment WHERE resident_id = ?";
    $stmt = $conn->prepare($resident_employment_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $resident_employment_result = $stmt->fetch();
   return [
        'resident_picture'=>$resident_tbl_result['picture'] ?? " ",
        'resident_signature'=>$resident_tbl_result['signature'],
        'resident_valid_id'=>$resident_tbl_result['valid_id'],
        'resident_fullname'=>$resident_tbl_result['first_name'].' '.$resident_tbl_result['middle_name'].' '.$resident_tbl_result['last_name'],
        'resident_sex'=>$resident_information_result['sex'],
        'resident_birthdate'=>$resident_information_result['birthdate'],
        'resident_birthplace'=>$resident_information_result['birthplace'],
        'resident_civil_status'=>$resident_information_result['civil_status'],
        'resident_height'=>$resident_information_result['height'],
        'resident_weight'=>$resident_information_result['weight'],
        'resident_blood_type'=>$resident_information_result['blood_type'],
        'resident_religion'=>$resident_information_result['religion'],
        'resident_nationality'=>$resident_information_result['nationality'],
        'resident_ethnic_origin'=>$resident_information_result['ethnic_origin'],
        'resident_precint_number'=>$resident_information_result['precint_number'],
        'resident_is_voter' => $resident_information_result['registered_voter'] ? 'Yes' : 'No',
        'resident_org_member' => $resident_information_result['organization_member'],
        'resident_email'=>$resident_contact_result['email'],
        'resident_mobile_number'=>$resident_contact_result['mobile_no'],
        'resident_tel_number'=>$resident_contact_result['tel_no'],
        'resident_ICOE_name'=>$resident_contact_result['ICOE_fullname'],
        'resident_ICOE_contact_number'=>$resident_contact_result['ICOE_contact'],
        'resident_ICOE_address'=>$resident_contact_result['ICOE_address'],
        'resident_father_name'=>$resident_family_result['father_fullname'],
        'resident_mother_name'=>$resident_family_result['mother_fullname'],
        'resident_spouse_name'=>$resident_family_result['spouse_fullname'],
        'resident_highest_educational_attainment'=>$resident_employment_result['highest_education'],
        'resident_type_of_school'=>$resident_employment_result['type_of_school'],
        'resident_house_number'=>$resident_address_result['house_number'],
        'resident_street'=>$resident_address_result['street'],
        'resident_purok'=>$resident_address_result['purok'],
        'resident_full_address' => $resident_address_result['house_number'].' '.$resident_address_result['street'],
        'resident_hoa'=>$resident_address_result['HOA'],
        'resident_employment_status'=>$resident_employment_result['employment_status'],
        'resident_employment_field'=>$resident_employment_result['employment_field'],
        'resident_occupation'=>$resident_employment_result['occupation'],
        'resident_monthly_income'=>$resident_employment_result['monthly_income'],
   ];
}
$resident_information = getAllResidentInformation($_SESSION['resident_id']);
$picture = $resident_information['resident_picture'];
$signature = $resident_information['resident_signature'];
$valid_id = $resident_information['resident_valid_id'];
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
                     <img src="data:image/gif;base64,<?php echo $picture; ?>" class="img-fluid" style="width:300px; height:200px" alt="Resident Picture">
                    <img src="data:image/gif;base64,<?php echo $valid_id; ?>" class="img-fluid" style="width:300px; height:200px" alt="Resident Picture">

                </div>
            </div>

            <div class="info-section mt-3">
                <div class="box bg-white shadow-sm border rounded-3 p-3">
                   <?php
                   echo"
                   <div class='box-body row'>
                        <div class='personal-info col-md-12 col-lg-4 d-flex flex-column' style='gap: 5px;'>
                            <div class='box-header'>
                                <h4>Personal Information</h4>
                            </div>
                            <label>First Name:</label>
                            <label>Middle Name:</label>
                            <label>Last Name:</label>
                            <label>Suffix:</label>
                            <label>Age:</label>
                            <label>Date Of Birth:</label>
                            <label>Civil Status:</label>
                            <label>Purok:</label>
                            <label>House Number:</label>
                            <label>Street:</label>
                            <label>Birth Place:</label>
                            <label>Height:</label>
                            <label>Weight:</label>
                            <label>Blood Type:</label>
                            <label>Religion:</label>
                            <label>Nationality:</label>
                            <label>Registered Voters:</label>
                            <label>Organization Member:</label>                                
                        </div>
                        
                               
                            <div class='contact-header  col-md-12 col-lg-4 d-flex flex-column ' style='gap: 5px;'>
                                <h4>Additional  Information:</h4>
                                <label>Employment Status:</label>
                                <label>Employment Field</label>
                                <label>Occupation</label>
                                <label>Monthly Income</label>
                                <label>Higher Education Attainment</label>
                                <label>Type Of School</label>

                                <h4 class='mt-2'>Contact  Information:</h4>
                                <label>Phone Number:</label>
                                <label>Email:</label>
                                <label>Tel No.</label>
                            </div>
                               
                        </div>
                   "
                   
                   
                   ?>
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
                    <form action="../../controllers/updateResidentInfoController.php" method="POST" enctype="multipart/form-data">
                        <div class="info-section mt-3">
                            <div class="box bg-white shadow-sm border rounded-3 p-3">
                                <div class="box-body row">
                                    <div class="personal-info col-md-12 col-lg-4 d-flex flex-column" style="gap: 5px;">
                                        <div class="box-header">
                                            <h4>Personal Information</h4>
                                        </div>
                                        <label>First Name:</label>
                                        <input type="text" class="form-control" name="first_name" value="<?php echo $resident_information['resident_fullname']; ?>">
                                        <label>Middle Name:</label>
                                        <input type="text" class="form-control" name="middle_name" value="<?php echo $resident_information['resident_middle_name']; ?>">
                                        <label>Last Name:</label>
                                        <input type="text" class="form-control" name="last_name" value="<?php echo $resident_information['resident_last_name']; ?>">
                                        <label>Suffix:</label>
                                        <input type="text" class="form-control" name="suffix" value="<?php echo $resident_information['resident_suffix']; ?>">
                                        <label>Age:</label>
                                        <input type="number" class="form-control" name="age" value="<?php echo $resident_information['resident_age']; ?>">
                                        <label>Date Of Birth:</label>
                                        <input type="date" class="form-control" name="birthdate" value="<?php echo $resident_information['resident_birthdate']; ?>">
                                        <label>Civil Status:</label>
                                        <input type="text" class="form-control" name="civil_status" value="<?php echo $resident_information['resident_civil_status']; ?>">
                                        <label>Purok:</label>
                                        <input type="text" class="form-control" name="purok" value="<?php echo $resident_information['resident_purok']; ?>">
                                        <label>House Number:</label>
                                        <input type="text" class="form-control" name="house_number" value="<?php echo $resident_information['resident_house_number']; ?>">
                                        <label>Street:</label>
                                        <input type="text" class="form-control" name="street" value="<?php echo $resident_information['resident_street']; ?>">
                                        <label>Birth Place:</label>
                                        <input type="text" class="form-control" name="birthplace" value="<?php echo $resident_information['resident_birthplace']; ?>">
                                        <label>Height:</label>
                                        <input type="text" class="form-control" name="height" value="<?php echo $resident_information['resident_height']; ?>">
                                        <label>Weight:</label>
                                        <input type="text" class="form-control" name="weight" value="<?php echo $resident_information['resident_weight']; ?>">
                                        <label>Blood Type:</label>
                                        <input type="text" class="form-control" name="blood_type" value="<?php echo $resident_information['resident_blood_type']; ?>">
                                        <label>Religion:</label>
                                        <input type="text" class="form-control" name="religion" value="<?php echo $resident_information['resident_religion']; ?>">
                                        <label>Nationality:</label>
                                        <input type="text" class="form-control" name="nationality" value="<?php echo $resident_information['resident_nationality']; ?>">
                                        <label>Registered Voters:</label>
                                        <input type="text" class="form-control" name="registered_voter" value="<?php echo $resident_information['resident_is_voter']; ?>">
                                        <label>Organization Member:</label>
                                        <input type="text" class="form-control" name="organization_member" value="<?php echo $resident_information['resident_org_member']; ?>">
                                    </div>
                                    <div class="other-info col-md-12 col-lg-4 d-flex flex-column" style="gap: 5px;">
                                        <div class="contact-header">
                                            <h4>Additional Information</h4>
                                        </div>
                                        <label>Employment Status:</label>
                                        <input type="text" class="form-control" name="employment_status" value="<?php echo $resident_information['resident_employment_status']; ?>">
                                        <label>Employment Field:</label>
                                        <input type="text" class="form-control" name="employment_field" value="<?php echo $resident_information['resident_employment_field']; ?>">
                                        <label>Occupation:</label>
                                        <input type="text" class="form-control" name="occupation" value="<?php echo $resident_information['resident_occupation']; ?>">
                                        <label>Monthly Income:</label>
                                        <input type="text" class="form-control" name="monthly_income" value="<?php echo $resident_information['resident_monthly_income']; ?>">
                                        <label>Higher Education Attainment:</label>
                                        <input type="text" class="form-control" name="highest_education" value="<?php echo $resident_information['resident_highest_educational_attainment']; ?>">
                                        <label>Type Of School:</label>
                                        <input type="text" class="form-control" name="type_of_school" value="<?php echo $resident_information['resident_type_of_school']; ?>">
                                        <h4 class="mt-2">Contact Information</h4>
                                        <label>Phone Number:</label>
                                        <input type="text" class="form-control" name="mobile_no" value="<?php echo $resident_information['resident_mobile_number']; ?>">
                                        <label>Email:</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $resident_information['resident_email']; ?>">
                                        <label>Tel No.:</label>
                                        <input type="text" class="form-control" name="tel_no" value="<?php echo $resident_information['resident_tel_number']; ?>">
                                    </div>
                                    <div class="other-info-2 col-md-12 col-lg-4 d-flex flex-column" style="gap: 5px;">
                                        <div class="contact-header">
                                            <h4>Images</h4>
                                        </div>
                                        <label>Resident Picture:</label>
                                        <input type="file" class="form-control" name="picture">
                                        <label>Valid ID:</label>
                                        <input type="file" class="form-control" name="valid_id">
               
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
    </script>
</body>
</html>