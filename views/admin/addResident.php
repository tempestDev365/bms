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
                        <form action="../../controllers/adminAddResident.php" method="POST" enctype="multipart/form-data">
                            <div class="info-section mt-3">
                                <div class="box bg-white shadow-sm border rounded-3 p-3">
                                    <div class="box-body row">
                                        <div class="personal-info col-md-12 col-lg-6 d-flex flex-column" style="gap: 5px;">
                                            <div class="box-header">
                                                <h4>Personal Information</h4>
                                            </div>
                                            <label>First Name:</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name">
                                            <label>Middle Name:</label>
                                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                                            <div class="d-flex">
                                                <input type="checkbox" class="form-check-input" id="no_middle_name" name="no_middle_name" value="N/A" onchange="toggleMiddleName()">
                                                <label for="no_middle_name">No Middle Name</label>
                                            </div>
                                            <label>Last Name:</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name">
                                            <label>Suffix:</label>
                                            <select class="form-control" id="suffix" name="suffix">
                                                <option value="Jr">Jr</option>
                                                <option value="Senior">Senior</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                                <option value="N/A">N/A</option>
                                            </select>
                                            <label>Sex:</label>
                                            <select class="form-control" id="sex" name="sex">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <label>Age:</label>
                                            <input type="number" class="form-control" id="age" name="age">
                                            <label>Date Of Birth:</label>
                                            <input type="date" class="form-control" id="birthdate" name="birthdate">
                                            <label>Civil Status:</label>
                                            <select class="form-control" id="civil_status" name="civil_status">
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Widowed">Widowed</option>
                                            </select>
                                            <label>Purok:</label>
                                            <select class="form-control" id="purok" name="purok">
                                                <option value="Alima">Alima</option>
                                                <option value="Banalo">Banalo</option>
                                                <option value="Sineguelasan">Sineguelasan</option>
                                            </select>
                                            <label>House Number:</label>
                                            <input type="text" class="form-control" id="house_number" name="house_number">
                                            <label>Street:</label>
                                            <input type="text" class="form-control" id="street" name="street">
                                            <label>Birth Place:</label>
                                            <input type="text" class="form-control" id="birthplace" name="birthplace">
                                            <label>Height(CM):</label>
                                            <input type="number" class="form-control" id="height" name="height">
                                            <label>Weight(KG):</label>
                                            <input type="number" class="form-control" id="weight" name="weight">
                                            <label>Blood Type:</label>
                                            <select class="form-control" id="blood_type" name="blood_type">
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="AB+">AB+</option>
                                                <option value="AB-">AB-</option>
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                                <option value="N/A">N/A</option>
                                            </select>
                                            <label>Religion:</label>
                                            <select class="form-control" id="religion" name="religion">
                                                <option value="Catholic">Catholic</option>
                                                <option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
                                                <option value="Aglipayan">Aglipayan</option>
                                                <option value="Seventh-Day Adventist">Seventh-Day Adventist</option>
                                                <option value="Christian">Christian</option>
                                                <option value="Islam">Islam</option>
                                                <option value="N/A">N/A</option>
                                            </select>
                                            <label>Nationality:</label>
                                            <input type="text" class="form-control" id="nationality" name="nationality">
                                            <label>Registered Voters:</label>
                                            <select class="form-control" id="registered_voter" name="registered_voter">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
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
                                        <div class="other-info col-md-12 col-lg-6 d-flex flex-column" style="gap: 5px;">
                                            <div class="contact-header">
                                                <h4>Additional Information</h4>
                                            </div>
                                            <label>Employment Status:</label>
                                            <select class="form-control" id="employment_status" name="employment_status">
                                                <option value="Employed">Employed</option>
                                                <option value="Unemployed">Unemployed</option>
                                                <option value="Self-Employed">Self-Employed</option>
                                                <option value="Student">Student</option>
                                                <option value="Retired">Retired</option>
                                                <option value="N/A">N/A</option>
                                            </select>
                                            <label>Employment Field:</label>
                                            <input type="text" class="form-control" id="employment_field" name="employment_field">
                                            <label>Occupation:</label>
                                            <input type="text" class="form-control" id="occupation" name="occupation">
                                            <label>Monthly Income:</label>
                                            <input type="text" class="form-control" id="monthly_income" name="monthly_income">
                                            <label>Highest Education Attainment :</label>
                                            <input type="text" class="form-control" id="highest_education" name="highest_education">
                                            <label>Type Of School:</label>
                                            <select class="form-control" id="type_of_school" name="type_of_school">
                                                <option value="Public School">Public School</option>
                                                <option value="Private">Private</option>
                                                <option value="Alternative">Alternative</option>
                                                <option value="N/A">N/A</option>
                                            </select>
                                            <h4 class="mt-2">Contact Information</h4>
                                            <label>Phone Number:</label>
                                            <input type="number" maxlength="11" class="form-control" id="mobile_no" name="mobile_no">
                                            <label>Tel No.:</label>
                                            <input type="number" maxlength="11" class="form-control" id="tel_no" name="tel_no">
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
    </div>

    <script src="../components/sidebar.js?v=<?php echo time(); ?>" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const birthdateInput = document.getElementById('birthdate');
            const ageInput = document.getElementById('age');

            birthdateInput.addEventListener('change', function() {
                const birthdate = new Date(this.value);
                const today = new Date();

                if (birthdate > today) {
                    alert('Birthdate cannot be in the future.');
                    this.value = '';
                    ageInput.value = '';
                    return;
                }

                let age = today.getFullYear() - birthdate.getFullYear();
                const monthDiff = today.getMonth() - birthdate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
                    age--;
                }

                ageInput.value = age;
            });

            // Set max date for birthdate to today
            birthdateInput.setAttribute('max', new Date().toISOString().split('T')[0]);
        });

        function toggleMiddleName() {
            const middleNameInput = document.getElementById('middle_name');
            const noMiddleNameCheckbox = document.getElementById('no_middle_name');
            if (noMiddleNameCheckbox.checked) {
                middleNameInput.value = 'N/A';
                middleNameInput.disabled = true;
            } else {
                middleNameInput.value = '';
                middleNameInput.disabled = false;
            }
        }

        // Initialize the middle name input state on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleMiddleName();
        });
    </script>
</body>
</html>