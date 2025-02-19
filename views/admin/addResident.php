<?php
session_start();
include_once "../../database/databaseConnection.php";
if(!isset($_SESSION['admin'])) {
    header('Location: adminLogin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brgy. Sinbanali</title>
    <link rel="shortcut icon" href="../../assets/img/logo-125.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="main-container d-flex" style="min-height: 100vh; min-width: 100vw;">
        <div class="admin-sidebar">
           
        </div>

        <div class="admin-content flex-grow-1 p-4 bg-light" style="max-height: 100vh; overflow-y: scroll">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">BMS</li>
                  <li class="breadcrumb-item"><a href="./issuedClearance.html" class="text-dark">Add Resident</a></li>
                </ol>
              </nav>

            <div class="container-fluid p-4 border shadow-sm rounded-3  bg-white">
                    <div class="register-header d-flex align-items-center">
                        <h1>Add New Resident</h1>
                    </div>  
                    <div class="register-body">
            
                    <form action="../../controllers/residentRegisterController.php" method="POST" enctype="multipart/form-data">
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
                                        <label>Registered Voters:</label>
                                        <input type="text" class="form-control" id="registered_voter" name="registered_voter" value="<?php echo $resident_information['personal_information']['registered_voter'] ?? ''; ?>">
                                        <label>Organization Member:</label>
                                        <div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="organization_member[]" value="4PS" id="4ps">
        <label class="form-check-label" for="4ps">4PS</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="organization_member[]" value="SENIOR CITIZEN" id="senior_citizen">
        <label class="form-check-label" for="senior_citizen">SENIOR CITIZEN</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="organization_member[]" value="PWD" id="pwd">
        <label class="form-check-label" for="pwd">PWD</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="organization_member[]" value="SOLO PARENT" id="solo_parent">
        <label class="form-check-label" for="solo_parent">SOLO PARENT</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="organization_member[]" value="HOA" id="hoa">
        <label class="form-check-label" for="hoa">HOA</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="organization_member[]" value="CSO" id="cso">
        <label class="form-check-label" for="cso">CSO</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="organization_member[]" value="NGO" id="ngo">
        <label class="form-check-label" for="ngo">NGO</label>
    </div>
</div>
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
                        <input type="file" class="form-control" id="picture" name="picture" onchange="previewImage(event, 'picturePreview')">
                        <img id="picturePreview" src="#" alt="Resident Picture Preview" style="display:none; max-width: 100px; max-height: 100px;">
                        <label>Valid ID:</label>
                        <input type="file" class="form-control" id="valid_id" name="valid_id" onchange="previewImage(event, 'validIdPreview')">
                        <img id="validIdPreview" src="#" alt="Valid ID Preview" style="display:none; max-width: 100px; max-height: 100px;">
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
    <script src="../components/sidebar.js?v=<?php echo time(); ?>" defer></script>
    <script>
      document.getElementById('picture').addEventListener('change', function(event) {
            previewImage(event, 'picturePreview');
        });

        document.getElementById('valid_id').addEventListener('change', function(event) {
            previewImage(event, 'validIdPreview');
        });

        function previewImage(event, elementId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById(elementId);
                    img.src = e.target.result;
                    img.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
        // Prevent number input for specific text fields
        const textFields = ['firstName', 'middleName', 'lastName', 'suffix', 'alias', 'salutation'];
        textFields.forEach(id => {
            document.getElementById(id).addEventListener('input', function(event) {
                this.value = this.value.replace(/[0-9]/g, '');
            });
        });

        // Automatically compute age based on birthdate and validate date
        document.getElementById('birthdate').addEventListener('change', function() {
            const birthdate = new Date(this.value);
            const today = new Date();
            if (birthdate > today) {
                alert('Birthdate cannot be in the future.');
                this.value = '';
                document.getElementById('age').value = '';
                return;
            }
            let age = today.getFullYear() - birthdate.getFullYear();
            const monthDiff = today.getMonth() - birthdate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
                age--;
            }
            document.getElementById('age').value = age;
        });
    </script>

    

</body>
</html>