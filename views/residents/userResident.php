<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header('Location: ./residentLogin.php');
}

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
    $personal_information['registered_voter'] = $personal_information['registered_voter'] == '0' ? 'No' : 'Yes';
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
                    <img src="data:image/gif;base64,<?php echo $resident_information['resident_information']['id_front']; ?>" class="img-fluid" style="width:300px; height:200px" alt="Resident Picture">
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
                                <label>Sex: <?php echo $resident_information['resident_information']['sex'] ?? ''; ?></label>
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
                                    <label>Highest Education Attainment: <?php echo $resident_information['additional_information']['highest_educational_attainment'] ?? ''; ?></label>
                                    <label>Type Of School: <?php echo $resident_information['additional_information']['type_of_school'] ?? ''; ?></label>
                                    
                                    <h4 class='mt-2'>Contact Information:</h4>
                                    <label>Phone Number: <?php echo $resident_information['contact_information']['phone_number'] ?? ''; ?></label>
                                    <label>Email: <?php echo $resident_information['resident_information']['email'] ?? ''; ?></label>
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
                                    <div class="personal-info col-md-12 col-lg-6 d-flex flex-column" style="gap: 5px;">
                                        <div class="box-header">
                                            <h4>Personal Information</h4>
                                        </div>
                                        <label>First Name:</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $resident_information['resident_information']['first_name'] ?? ''; ?>">
                                        <div class="">
                                            <label>Middle Name:</label>
                                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $resident_information['resident_information']['middle_name'] ?? ''; ?>">
                                            <div class="d-flex">
                                                <input type="checkbox" class="form-check-input" id="no_middle_name" name="no_middle_name" value="N/A" onchange="toggleMiddleName()">
                                                <label for="no_middle_name">No Middle Name</label>
                                            </div>
                                        </div>
                                        <label>Last Name:</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $resident_information['resident_information']['last_name'] ?? ''; ?>">
                                        <label>Sex:</label>
                                        <select class="form-control" id="sex" name="sex">
                                            <option value="Male" <?php echo (isset($resident_information['resident_information']['sex']) && $resident_information['resident_information']['sex'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                            <option value="Female" <?php echo (isset($resident_information['resident_information']['sex']) && $resident_information['resident_information']['sex'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                        </select>
                                        <label>Suffix:</label>
                                        <select class="form-control" id="suffix" name="suffix">
                                            <option value="Jr" <?php echo (isset($resident_information['resident_information']['suffix']) && $resident_information['resident_information']['suffix'] == 'Jr') ? 'selected' : ''; ?>>Jr</option>
                                            <option value="Senior" <?php echo (isset($resident_information['resident_information']['suffix']) && $resident_information['resident_information']['suffix'] == 'Senior') ? 'selected' : ''; ?>>Senior</option>
                                            <option value="II" <?php echo (isset($resident_information['resident_information']['suffix']) && $resident_information['resident_information']['suffix'] == 'II') ? 'selected' : ''; ?>>II</option>
                                            <option value="III" <?php echo (isset($resident_information['resident_information']['suffix']) && $resident_information['resident_information']['suffix'] == 'III') ? 'selected' : ''; ?>>III</option>
                                            <option value="IV" <?php echo (isset($resident_information['resident_information']['suffix']) && $resident_information['resident_information']['suffix'] == 'IV') ? 'selected' : ''; ?>>IV</option>
                                            <option value="V" <?php echo (isset($resident_information['resident_information']['suffix']) && $resident_information['resident_information']['suffix'] == 'V') ? 'selected' : ''; ?>>V</option>
                                            <option value="N/A" <?php echo (isset($resident_information['resident_information']['suffix']) && $resident_information['resident_information']['suffix'] == 'N/A') ? 'selected' : ''; ?>>N/A</option>
                                        </select>
                                        <label>Sex:</label>
                                        <select class="form-control" id="sex" name="sex">
                                            <option value="Male" <?php echo (isset($resident_information['resident_information']['sex']) && $resident_information['resident_information']['sex'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                            <option value="Female" <?php echo (isset($resident_information['resident_information']['sex']) && $resident_information['resident_information']['sex'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                        </select>
                                        <label>Age:</label>
                                        <input type="number" class="form-control" id="age" name="age" value="<?php echo $resident_information['resident_information']['age'] ?? ''; ?>">
                                        <label>Date Of Birth:</label>
                                        <input type="date" class="form-control" max="<?php echo date('Y-m-d'); ?>" id="birthdate" name="birthdate" value="<?php echo $resident_information['resident_information']['birthday'] ?? ''; ?>">
                                        <label>Civil Status:</label>
                                        <select class="form-control" id="civil_status" name="civil_status">
                                            <option value="Single" <?php echo (isset($resident_information['resident_information']['civil_status']) && $resident_information['resident_information']['civil_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                                            <option value="Married" <?php echo (isset($resident_information['resident_information']['civil_status']) && $resident_information['resident_information']['civil_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                                            <option value="Divorced" <?php echo (isset($resident_information['resident_information']['civil_status']) && $resident_information['resident_information']['civil_status'] == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                                            <option value="Widowed" <?php echo (isset($resident_information['resident_information']['civil_status']) && $resident_information['resident_information']['civil_status'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                                        </select>
                                        <label>Purok:</label>
                                        <select class="form-control" id="purok" name="purok">
                                            <option value="Alima" <?php echo (isset($resident_information['resident_information']['purok']) && $resident_information['resident_information']['purok'] == 'Alima') ? 'selected' : ''; ?>>Alima</option>
                                            <option value="Banalo" <?php echo (isset($resident_information['resident_information']['purok']) && $resident_information['resident_information']['purok'] == 'Banalo') ? 'selected' : ''; ?>>Banalo</option>
                                            <option value="Sineguelasan" <?php echo (isset($resident_information['resident_information']['purok']) && $resident_information['resident_information']['purok'] == 'Sineguelasan') ? 'selected' : ''; ?>>Sineguelasan</option>
                                        </select>
                                        <label>House Number:</label>
                                        <input type="text" class="form-control" id="house_number" name="house_number" value="<?php echo $resident_information['resident_information']['house_number'] ?? ''; ?>">
                                        <label>Street:</label>
                                        <input type="text" class="form-control" id="street" name="street" value="<?php echo $resident_information['resident_information']['street'] ?? ''; ?>">
                                        <label>Birth Place:</label>
                                        <input type="text" class="form-control" id="birthplace" name="birthplace" value="<?php echo $resident_information['personal_information']['birth_place'] ?? ''; ?>">
                                        <label>Height(CM):</label>
                                        <input type="number" class="form-control" id="height" name="height" value="<?php echo $resident_information['personal_information']['height'] ?? ''; ?>">
                                        <label>Weight(KG):</label>
                                        <input type="number" class="form-control" id="weight" name="weight" value="<?php echo $resident_information['personal_information']['weight'] ?? ''; ?>">
                                        <label>Blood Type:</label>
                                        <select class="form-control" id="blood_type" name="blood_type">
                                            <option value="A+" <?php echo (isset($resident_information['personal_information']['blood_type']) && $resident_information['personal_information']['blood_type'] == 'A+') ? 'selected' : ''; ?>>A+</option>
                                            <option value="A-" <?php echo (isset($resident_information['personal_information']['blood_type']) && $resident_information['personal_information']['blood_type'] == 'A-') ? 'selected' : ''; ?>>A-</option>
                                            <option value="B+" <?php echo (isset($resident_information['personal_information']['blood_type']) && $resident_information['personal_information']['blood_type'] == 'B+') ? 'selected' : ''; ?>>B+</option>
                                            <option value="B-" <?php echo (isset($resident_information['personal_information']['blood_type']) && $resident_information['personal_information']['blood_type'] == 'B-') ? 'selected' : ''; ?>>B-</option>
                                            <option value="AB+" <?php echo (isset($resident_information['personal_information']['blood_type']) && $resident_information['personal_information']['blood_type'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                                            <option value="AB-" <?php echo (isset($resident_information['personal_information']['blood_type']) && $resident_information['personal_information']['blood_type'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                                            <option value="O+" <?php echo (isset($resident_information['personal_information']['blood_type']) && $resident_information['personal_information']['blood_type'] == 'O+') ? 'selected' : ''; ?>>O+</option>
                                            <option value="O-" <?php echo (isset($resident_information['personal_information']['blood_type']) && $resident_information['personal_information']['blood_type'] == 'O-') ? 'selected' : ''; ?>>O-</option>
                                            <option value="N/A" <?php echo (isset($resident_information['personal_information']['blood_type']) && $resident_information['personal_information']['blood_type'] == 'N/A') ? 'selected' : ''; ?>>N/A</option>
                                        </select>
                                        <label>Religion:</label>
                                        <select class="form-control" id="religion" name="religion">
                                            <option value="Catholic" <?php echo (isset($resident_information['personal_information']['religion']) && $resident_information['personal_information']['religion'] == 'Catholic') ? 'selected' : ''; ?>>Catholic</option>
                                            <option value="Iglesia ni Cristo" <?php echo (isset($resident_information['personal_information']['religion']) && $resident_information['personal_information']['religion'] == 'Iglesia ni Cristo') ? 'selected' : ''; ?>>Iglesia ni Cristo</option>
                                            <option value="Aglipayan" <?php echo (isset($resident_information['personal_information']['religion']) && $resident_information['personal_information']['religion'] == 'Aglipayan') ? 'selected' : ''; ?>>Aglipayan</option>
                                            <option value="Seventh-Day Adventist" <?php echo (isset($resident_information['personal_information']['religion']) && $resident_information['personal_information']['religion'] == 'Seventh-Day Adventist') ? 'selected' : ''; ?>>Seventh-Day Adventist</option>
                                            <option value="Christian" <?php echo (isset($resident_information['personal_information']['religion']) && $resident_information['personal_information']['religion'] == 'Christian') ? 'selected' : ''; ?>>Christian</option>
                                            <option value="Islam" <?php echo (isset($resident_information['personal_information']['religion']) && $resident_information['personal_information']['religion'] == 'Islam') ? 'selected' : ''; ?>>Islam</option>
                                            <option value="N/A" <?php echo (isset($resident_information['personal_information']['religion']) && $resident_information['personal_information']['religion'] == 'N/A') ? 'selected' : ''; ?>>N/A</option>
                                        </select>
                                        <label>Nationality:</label>
                                        <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $resident_information['personal_information']['nationality'] ?? ''; ?>">
                                        <label>Registered Voters:</label>
                                        <select class="form-control" id="registered_voter" name="registered_voter">
                                            <option value="Yes" <?php echo (isset($resident_information['personal_information']['registered_voter']) && $resident_information['personal_information']['registered_voter'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                                            <option value="No" <?php echo (isset($resident_information['personal_information']['registered_voter']) && $resident_information['personal_information']['registered_voter'] == 'No') ? 'selected' : ''; ?>>No</option>
                                        </select>
                                       <?php
$organization_members = explode(', ', $resident_information['personal_information']['organization_member'] ?? '');
?>

<label>Organization Member:</label>
<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="organization_member[]" value="4PS" id="4ps" <?php echo in_array('4PS', $organization_members) ? 'checked' : ''; ?>>
        <label class="form-check-label" for="4ps">4PS</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="organization_member[]" value="SENIOR CITIZEN" id="senior_citizen" <?php echo in_array('SENIOR CITIZEN', $organization_members) ? 'checked' : ''; ?>>
        <label class="form-check-label" for="senior_citizen">SENIOR CITIZEN</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="organization_member[]" value="PWD" id="pwd" <?php echo in_array('PWD', $organization_members) ? 'checked' : ''; ?>>
        <label class="form-check-label" for="pwd">PWD</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="organization_member[]" value="SOLO PARENT" id="solo_parent" <?php echo in_array('SOLO PARENT', $organization_members) ? 'checked' : ''; ?>>
        <label class="form-check-label" for="solo_parent">SOLO PARENT</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="organization_member[]" value="HOA" id="hoa" <?php echo in_array('HOA', $organization_members) ? 'checked' : ''; ?>>
        <label class="form-check-label" for="hoa">HOA</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="organization_member[]" value="CSO" id="cso" <?php echo in_array('CSO', $organization_members) ? 'checked' : ''; ?>>
        <label class="form-check-label" for="cso">CSO</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="organization_member[]" value="NGO" id="ngo" <?php echo in_array('NGO', $organization_members) ? 'checked' : ''; ?>>
        <label class="form-check-label" for="ngo">NGO</label>
    </div>
</div>
                                    </div>
                                    <div class="other-info col-md-12 col-lg-6 d-flex flex-column" style="gap: 5px;">
                                        <div class="contact-header">
                                            <h4>Additional Information</h4>
                                        </div>
                                        <label>Employment Status:</label>
                                        <select class="form-control" id="employment_status" name="employment_status">
                                            <option value="Employed" <?php echo (isset($resident_information['additional_information']['employment_status']) && $resident_information['additional_information']['employment_status'] == 'Employed') ? 'selected' : ''; ?>>Employed</option>
                                            <option value="Unemployed" <?php echo (isset($resident_information['additional_information']['employment_status']) && $resident_information['additional_information']['employment_status'] == 'Unemployed') ? 'selected' : ''; ?>>Unemployed</option>
                                            <option value="Self-Employed" <?php echo (isset($resident_information['additional_information']['employment_status']) && $resident_information['additional_information']['employment_status'] == 'Self-Employed') ? 'selected' : ''; ?>>Self-Employed</option>
                                            <option value="Student" <?php echo (isset($resident_information['additional_information']['employment_status']) && $resident_information['additional_information']['employment_status'] == 'Student') ? 'selected' : ''; ?>>Student</option>
                                            <option value="Retired" <?php echo (isset($resident_information['additional_information']['employment_status']) && $resident_information['additional_information']['employment_status'] == 'Retired') ? 'selected' : ''; ?>>Retired</option>
                                            <option value="N/A" <?php echo (isset($resident_information['additional_information']['employment_status']) && $resident_information['additional_information']['employment_status'] == 'N/A') ? 'selected' : ''; ?>>N/A</option>
                                        </select>
                                        <label>Employment Field:</label>
                                        <input type="text" class="form-control" id="employment_field" name="employment_field" value="<?php echo $resident_information['additional_information']['employment_field'] ?? ''; ?>">
                                        <label>Occupation:</label>
                                        <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo $resident_information['additional_information']['occupation'] ?? ''; ?>">
                                        <label>Monthly Income:</label>
                                        <input type="text" class="form-control" id="monthly_income" name="monthly_income" value="<?php echo $resident_information['additional_information']['monthly_income'] ?? ''; ?>">
                                        <label>Highest Education Attainment :</label>
                                        <input type="text" class="form-control" id="highest_education" name="highest_education" value="<?php echo $resident_information['additional_information']['highest_educational_attainment'] ?? ''; ?>">
                                        <label>Type Of School:</label>
                                        <select class="form-control" id="type_of_school" name="type_of_school">
                                            <option value="Public School" <?php echo (isset($resident_information['additional_information']['type_of_school']) && $resident_information['additional_information']['type_of_school'] == 'Public School') ? 'selected' : ''; ?>>Public School</option>
                                            <option value="Private" <?php echo (isset($resident_information['additional_information']['type_of_school']) && $resident_information['additional_information']['type_of_school'] == 'Private') ? 'selected' : ''; ?>>Private</option>
                                            <option value="Alternative" <?php echo (isset($resident_information['additional_information']['type_of_school']) && $resident_information['additional_information']['type_of_school'] == 'Alternative') ? 'selected' : ''; ?>>Alternative</option>
                                            <option value="N/A" <?php echo (isset($resident_information['additional_information']['type_of_school']) && $resident_information['additional_information']['type_of_school'] == 'N/A') ? 'selected' : ''; ?>>N/A</option>
                                        </select>
                                        <h4 class="mt-2">Contact Information</h4>
                                        <label>Phone Number:</label>
                                        <input type="number" maxlength="11" class="form-control" id="mobile_no" name="mobile_no" value="<?php echo $resident_information['contact_information']['phone_number'] ?? ''; ?>">
                                        <label>Email:</label>
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $resident_information['resident_information']['email'] ?? ''; ?>">
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
    <script>
    function toggleMiddleName() {
        const middleNameInput = document.getElementById('middle_name');
        const noMiddleNameCheckbox = document.getElementById('no_middle_name');
        if (noMiddleNameCheckbox.checked) {
            middleNameInput.disabled = true;
            middleNameInput.value = 'N/A';
        } else {
            middleNameInput.disabled = false;
            middleNameInput.value = '';
        }
    }
</script>
</body>
</html>