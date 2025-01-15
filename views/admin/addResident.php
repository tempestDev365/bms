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
              <form action="../../controllers/residentRegisterController.php" method = "POST" enctype="multipart/form-data">

                <h5 class="text-center">Personal Information</h5>
                <hr>

                    <!--Uploading Ids-->
                    <div class="form-upload d-flex justify-content-evenly align-items-center" style="flex-wrap: wrap; gap: 1rem">
                        <div class="form-group d-flex flex-column align-items-center justify-content-center img-fluid" style="gap: 1rem;">
                            <div class="box border rounded-3 w-100 d-flex justify-content-center align-items-center" style="min-height: 200px; min-width: 200px;">
                                Picture
                            </div>
                            <input type="file" name="picture" id="picture" class="form-control" accept="image/.jpg">
                        </div>

                        <div class="form-group d-flex flex-column align-items-center justify-content-center img-fluid" style="gap: 1rem;">
                            <div class="box border rounded-3 w-100 d-flex justify-content-center align-items-center" style="min-height: 200px; min-width: 200px;">
                                Signature
                            </div>
                            <input type="file" name="signature" id="signature" class="form-control" accept="image/.jpg">
                        </div>

                        <div class="form-group d-flex flex-column align-items-center justify-content-center img-fluid" style="gap: 1rem;">
                            <div class="box border rounded-3 w-100 d-flex justify-content-center align-items-center" style="min-height: 200px; min-width: 200px;">
                                Valid ID
                            </div>
                            <input type="file" name="validId" id="validId" class="form-control" accept="image/.jpg">
                        </div>
                    </div>
                    <!--Login Information-->
                <h5 class="text-center">Login Information</h5>
                 <div class="form-personal-info row mt-3">
                    <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="Username">Username</label>
                            <input type="text" name="Username" id="Username" class="form-control">
                        </div>
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="Password">Password</label>
                            <input type="password" name="Password" id="Password" class="form-control">
                        </div>
                 </div>
                <hr>
                    <!--Personal Information-->
                    <div class="form-personal-info row mt-3">
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="firsName">First Name</label>
                            <input type="text" name="firstName" id="firstName" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="middleName">Middle Name</label>
                            <input type="text" name="middleName" id="middleName" class="form-control">
                        </div>
                        
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lastName" id="lastName" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="suffix">Suffix</label>
                            <input type="text" name="suffix" id="suffix" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="alias">Alias</label>
                            <input type="text" name="alias" id="alias" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="salutation">Salutation</label>
                            <input type="text" name="salutation" id="salutation" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="sex">Sex</label>
                            <input type="text" name="sex" id="sex" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="birthdate">Birthdate</label>
                            <input type="text" name="birthdate" id="birthdate" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="birthplace">Birthplace</label>
                            <input type="text" name="birthplace" id="birthplace" class="form-control">
                        </div>
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="age">Age</label>
                            <input type="text" name="age" id="age" class="form-control">
                        </div>
                         <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="gender">Gender</label>
                            <input type="text" name="gender" id="gender" class="form-control">
                        </div>
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="civil">Civil Status</label>
                            <input type="text" name="civil" id="civil" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="height">Height</label>
                            <input type="text" name="height" id="height" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="weight">Weight</label>
                            <input type="text" name="weight" id="weight" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="bloodType">Blood Type</label>
                            <input type="text" name="bloodType" id="bloodType" class="form-control">
                        </div>
                        
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="religion">Religion</label>
                            <input type="text" name="religion" id="religion" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="ethnic">Ethnic Origin</label>
                            <input type="text" name="ethnic" id="ethnic" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="nationality">Nationality</label>
                            <input type="text" name="nationality" id="nationality" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="precint">Precinct Number</label>
                            <input type="text" name="precint" id="precint" class="form-control">
                        </div>
                        

                        <div class="form-group mt-2 d-flex justify-content-start align-items-center col-sm-12 col-md-4" style="gap:5px;">
                            <label for="voter">Registered Voter</label>
                            <input type="checkbox" name="voter"  id="voter">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-2">
                            <label for="organizationMember">Organization Members:</label>
                        </div>


                        <div class="form-group mt-2 col-md-12 col-lg-1 d-flex justfy-content-center align-items-center" style="gap: 5px;">
                            <input type="checkbox" name="orgMember[]" value = "4p" id="4p">
                            <label for="4p">4P's</label>
                        </div>

                        <div class="form-group mt-2 col-md-12 col-lg-1 d-flex justfy-content-center align-items-center" style="gap: 5px;">
                            <input type="checkbox" name="orgMember[]" value="pwd" id="pwd">
                            <label for="pwd">PWD</label>
                        </div>

                        <div class="form-group mt-2 col-md-12 col-lg-1 d-flex justfy-content-center align-items-center" style="gap: 5px;">
                            <input type="checkbox" name="orgMember[]" value="senior" id="senior">
                            <label for="senior">Senior</label>
                        </div>

                        <div class="form-group mt-2 col-md-12 col-lg-2 d-flex justfy-content-center align-items-center" style="gap: 5px;">
                            <input type="checkbox" name="orgMember[]" value="solo_parent" id="soloParent">
                            <label for="soloParent">Solo Parent</label>
                        </div>

                        <div class="form-group mt-2 col-md-12 col-lg-1 d-flex justfy-content-center align-items-center" style="gap: 5px;">
                            <input type="checkbox" name="orgMember[]" value="parent" id="hoa">
                            <label for="hoa">HOA</label>
                        </div>

                        <div class="form-group mt-2 col-md-12 col-lg-1 d-flex justfy-content-center align-items-center" style="gap: 5px;">
                            <input type="checkbox" name="orgMember[]" value="cso" id="cso">
                            <label for="cso">CSO</label>
                        </div>

                        <div class="form-group mt-2 col-md-12 col-lg-1 d-flex justfy-content-center align-items-center" style="gap: 5px;">
                            <input type="checkbox" name="orgMember[]" value="ngo" id="ngo">
                            <label for="ngo">NGO</label>
                        </div>
                        
                    </div>

                    <h5 class="text-center mt-5">Contact Information</h5>
                    <hr>

                    <!--Contact Information-->
                    <div class="form-contact-info row">
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="mobile">Mobile Number</label>
                            <input type="number" name="mobile" id="mobile" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="tel">Tel No.</label>
                            <input type="number" name="tel" id="tel" class="form-control">
                        </div>
                    </div>


                    <h5 class="text-center mt-5">Incase of Emergency</h5>
                    <hr>

                    <!--Contact Information-->
                    <div class="form-contact-info row">
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="incaseFullname">Fullname</label>
                            <input type="text" name="incaseFullname" id="incaseFullname" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="incaseContact">Contact Number</label>
                            <input type="number" name="incaseContact" id="incaseContact" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="incaseAddress">Address</label>
                            <input type="text" name="incaseAddress" id="incaseAddress" class="form-control">
                        </div>
                    </div>
                    

                    <h5 class="text-center mt-5">Family Information</h5>
                    <hr>

                    <!--Family Information-->
                    <div class="form-contact-info row">
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="mother">Mother</label>
                            <input type="text" name="mother" id="mother" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="father">Father</label>
                            <input type="text" name="father" id="father" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="spouse">Spouse</label>
                            <input type="text" name="spouse" id="spouse" class="form-control">
                        </div>
                    </div>

                    <!--Address Information-->
                    <h5 class="text-center mt-5">Address Information</h5>
                    <hr>

                    <div class="form-contact-info row">
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="houseNo">House Number</label>
                            <input type="number" name="houseNo" id="houseNo" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="purok">Purok</label>
                            <input type="text" name="purok" id="purok" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="fullAddress">Full Address</label>
                            <input type="text" name="fullAddress" id="fullAddress" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="street">Street</label>
                            <input type="text" name="street" id="street" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="familyHoa">HOA</label>
                            <input type="text" name="familyHoa" id="familyHoa" class="form-control">
                        </div>


                    </div>

                    
                    <h5 class="text-center mt-5">Employment Information</h5>
                    <hr>

                    <!--Employment Information-->
                    <div class="form-contact-info row">
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="eStatus">Employment Status</label>
                            <input type="text" name="eStatus" id="eStatus" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="eField">Employment Field</label>
                            <input type="text" name="eField" id="eField" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="occupation">Occupation</label>
                            <input type="text" name="occupation" id="occupation" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="mIncome">Monthly Income</label>
                            <input type="number" name="mIncome" id="mIncome" class="form-control">
                        </div>



                    </div>

                    <h5 class="text-center mt-5">Education Information</h5>
                    <hr>

                    <!--Education Information-->
                    <div class="form-contact-info row">
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="higherEducAttain">Higher Education Attainment</label>
                            <input type="text" name="higherEducAttain" id="higherEducAttain" class="form-control">
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="tSchool">Type of School</label>
                            <select name="tSchool" id="tSchool" class="form-control">
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                            </select>
                        </div>
                    </div>



                    <!--Submit Button-->
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Save</button>
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
            previewImage(event, 'picture');
        });

        document.getElementById('signature').addEventListener('change', function(event) {
            previewImage(event, 'signature');
        });

        document.getElementById('validId').addEventListener('change', function(event) {
            previewImage(event, 'validId');
        });

        function previewImage(event, elementId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const box = document.querySelector(`input[name="${elementId}"]`).previousElementSibling;
                    box.style.backgroundImage = `url(${e.target.result})`;
                    box.style.backgroundSize = 'cover';
                    box.style.backgroundPosition = 'center';
                    box.textContent = '';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>
</html>