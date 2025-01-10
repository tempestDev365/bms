<?php
session_start();
include '../../controllers/getAllResidentInformationController.php';
include '../../database/databaseConnection.php';
if(!isset($_SESSION['resident_id'])) {
    header('Location: ./residentLogin.php');
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

                <button class="navbar-toggler navbar-light bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="id-section mt-3">
                <div class="container-id p-3 d-flex justify-content-center" style="gap: 1rem; flex-wrap: wrap;">
                   <div class='card shadow-sm' style='flex: 1 1 300px; min-height: 300px'>
                     <img src="data:image/gif;base64,<?php echo $picture; ?>" alt="Resident Picture">
                     <img src="data:image/gif;base64,<?php echo $signature; ?>" alt="Resident Picture">
                    <img src="data:image/gif;base64,<?php echo $valid_id; ?>" alt="Resident Picture">

                   </div>
                </div>
            </div>

            <div class="info-section p-3">
                <div class="box bg-white shadow-sm border rounded-3 p-3">
                   <?php
                   echo"
                   <div class='box-body row'>
                        <div class='personal-info col-md-12 col-lg-4 d-flex flex-column' style='gap: 5px;'>
                            <div class='box-header'>
                                <h4>Personal Information</h4>
                            </div>
                                <label>Full Name:{$resident_information['resident_fullname']}</label>
                                <label>Sex:{$resident_information['resident_sex']}</label>
                                <label>Birthdate:{$resident_information['resident_birthdate']}</label>
                                <label>Birthplace:{$resident_information['resident_birthplace']}</label>
                                <label>Civil Status:{$resident_information['resident_civil_status']}</label>
                                <label>Height:{$resident_information['resident_height']}</label>
                                <label>Weight:{$resident_information['resident_weight']}</label>
                                <label>Blood Type:{$resident_information['resident_blood_type']}</label>
                                <label>Religion:{$resident_information['resident_religion']}</label>
                                <label>Ethnic Origin:{$resident_information['resident_ethnic_origin']}</label>
                                <label>Nationality:{$resident_information['resident_nationality']}</label>
                                <label>Precinct Number:{$resident_information['resident_precint_number']}</label>
                                <label>Registered Voter:{$resident_information['resident_is_voter']}</label>
                                <label>Organization Member:{$resident_information['resident_org_member']}</label>
                        </div>
                        <div class='other-info col-md-12 col-lg-4 d-flex flex-column' style='gap: 5px;'>
                            <div class='contact-header'>
                                <h4>Contact Information</h4>
                            </div>
                                <label>Email:{$resident_information['resident_email']}</label>
                                <label>Mobile Number:{$resident_information['resident_mobile_number']}</label>
                                <label>Tel No:{$resident_information['resident_tel_number']}</label>
                            <div class='contact-header'>
                                <h4>Incase of Emergency</h4>
                            </div>
                                <label>Fullname:{$resident_information['resident_ICOE_name']}</label>
                                <label>Contact Number:{$resident_information['resident_ICOE_contact_number']}</label>
                                <label>Address:{$resident_information['resident_ICOE_address']}</label>
                            <div class='contact-header'>
                                <h4>Family Information</h4>
                            </div>
                                <label>Mother:{$resident_information['resident_mother_name']}</label>
                                <label>Father:{$resident_information['resident_father_name']}</label>
                                <label>Spouse:{$resident_information['resident_spouse_name']}</label>
                            <div class='contact-header'>
                                <h4>Educational Information:</h4>
                            </div>
                                <label>Highest Education Attainment:{$resident_information['resident_highest_educational_attainment']}</label>
                                <label>Type of School:{$resident_information['resident_type_of_school']}</label>
                           
                        </div>

                        <div class='other-info-2 col-md-12 col-lg-4 d-flex flex-column' style='gap: 5px;'>
                            <div class='contact-header'>
                                <h4>Address Information</h4>
                            </div>
                                <label>House Number:{$resident_information['resident_house_number']}</label>
                                <label>Purok:{$resident_information['resident_purok']}</label>
                                <label>Full Address:{$resident_information['resident_full_address']}</label>
                                <label>Street:{$resident_information['resident_street']}</label>
                                <label>Hoa:{$resident_information['resident_hoa']}</label>
                            <div class='contact-header'>
                                <h4>Employment Information:</h4>
                            </div>
                                <label>Employment Status:{$resident_information['resident_employment_status']}</label>
                                <label>Employment Field:{$resident_information['resident_employment_field']}</label>
                                <label>Occupation:{$resident_information['resident_occupation']}</label>
                                <label>Monthly Income:{$resident_information['resident_monthly_income']}</label>
                        </div>
                   "
                   
                   
                   ?>
                
                    </div>
                </div>
            </div>
       

        </main>
    </div>


    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../components/residentSidebar.js?v=<?php echo time(); ?>" defer></script>
</body>
</html>