<?php
session_start();
if(!isset($_SESSION['resident_id'])) {
    header('Location: ./residentLogin.php');
}
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
        'resident_picture'=>$resident_tbl_result['picture'],
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
                <div class="container-id border bg-white p-3 d-flex justify-content-center" style="gap: 1rem; flex-wrap: wrap;">
                     <img src="data:image/gif;base64,<?php echo $picture; ?>" class="img-fluid" style="width:300px; height:200px" alt="Resident Picture">
                     <img src="data:image/gif;base64,<?php echo $signature; ?>" class="img-fluid" style="width:300px; height:200px" alt="Resident Picture">
                    <img src="data:image/gif;base64,<?php echo $valid_id; ?>" class="img-fluid" style="width:300px; height:200px" alt="Resident Picture">

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