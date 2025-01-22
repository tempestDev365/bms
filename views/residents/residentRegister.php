<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>
    <link rel="shortcut icon" href="../../assets/img/logo-125.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body> 
    <div class="register-page p-4 d-flex justify-content-center align-items-center" style="min-height: 100vh; min-width: 100%; background-color: #2D3187;">
        <div class="container p-4 border shadow-sm rounded-3  bg-white">
            <div class="register-header d-flex align-items-center">
                <img src="../../assets/img/logo-125.png" alt="logo" class="img-fluid" style="width: 80px;">
                <h1>Register Account</h1>
            </div>  
            <div class="register-body">
                <form id="registerForm" action="../../controllers/residentRegisterController.php" method = "POST" enctype="multipart/form-data">

                <h5 class="text-center">Personal Information</h5>
                <hr>

                    <!--Uploading Ids-->
                    <div class="form-upload d-flex justify-content-evenly align-items-center" style="flex-wrap: wrap; gap: 1rem">
                        <div class="form-group d-flex flex-column align-items-center justify-content-center img-fluid" style="gap: 1rem;">
                            <div class="box border rounded-3 w-100 d-flex justify-content-center align-items-center" style="min-height: 200px; min-width: 200px;">
                                Picture
                            </div>
                            <input type="file" name="picture" id="picture" class="form-control" accept="image/.jpg" required>
                        </div>

                        <div class="form-group d-flex flex-column align-items-center justify-content-center img-fluid" style="gap: 1rem;">
                            <div class="box border rounded-3 w-100 d-flex justify-content-center align-items-center" style="min-height: 200px; min-width: 200px;">
                                Signature
                            </div>
                            <input type="file" name="signature" id="signature" class="form-control" accept="image/.jpg" required>
                        </div>

                        <div class="form-group d-flex flex-column align-items-center justify-content-center img-fluid" style="gap: 1rem;">
                            <div class="box border rounded-3 w-100 d-flex justify-content-center align-items-center" style="min-height: 200px; min-width: 200px;">
                                Valid ID
                            </div>
                            <input type="file" name="validId" id="validId" class="form-control" accept="image/.jpg" required>
                        </div>
                    </div>
                    <!--Login Information-->
                <h5 class="text-center">Login Information</h5>
                 <div class="form-personal-info row mt-3">
                    <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="Username">Username</label>
                            <input type="text" name="Username" id="Username" class="form-control" required>
                        </div>
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="Password">Password</label>
                            <input type="password" name="Password" id="Password" class="form-control" required>
                        </div>
                 </div>
                <hr>
                    <!--Personal Information-->
                    <div class="form-personal-info row mt-3">
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="firsName">First Name</label>
                            <input type="text" name="firstName" id="firstName" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="middleName">Middle Name</label>
                            <input type="text" name="middleName" id="middleName" class="form-control" required>
                        </div>
                        
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lastName" id="lastName" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="suffix">Suffix</label>
                            <input type="text" name="suffix" id="suffix" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="alias">Alias</label>
                            <input type="text" name="alias" id="alias" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="salutation">Salutation</label>
                            <input type="text" name="salutation" id="salutation" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="male">Male</label>
                            <input type="radio" name="sex" id="male" value="male" required>
                            <label for="female">Female</label>
                            <input type="radio" name="sex" id="female" value="female"  required>

                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="birthdate">Birthdate</label>
                            <input type="date" name="birthdate" id="birthdate" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="birthplace">Birthplace</label>
                            <input type="text" name="birthplace" id="birthplace" class="form-control" required>
                        </div>
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="age">Age</label>
                            <input type="text" name="age" id="age" class="form-control" required>
                        </div>
                        
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="civil">Civil Status</label>
                            <select name="civil" id="civil" class="form-control" required>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="widowed">Widowed</option>
                                <option value="divorced">Divorced</option>
                                <option value="separated">Separated</option>
                            </select>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="height">Height</label>
                            <input type="number" name="height" id="height" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="weight">Weight</label>
                            <input type="number" name="weight" id="weight" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="bloodType">Blood Type</label>
                            <select name="bloodType" id="bloodType" class="form-control" required>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="religion">Religion</label>
                            <input type="text" name="religion" id="religion" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="ethnic">Ethnic Origin</label>
                            <input type="text" name="ethnic" id="ethnic" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="nationality">Nationality</label>
                            <input type="text" name="nationality" id="nationality" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="precint">Precinct Number</label>
                            <input type="text" name="precint" id="precint" class="form-control" required>
                        </div>
                        

                        <div class="form-group mt-2 d-flex justify-content-start align-items-center col-sm-12 col-md-4" style="gap:5px;">
                            <label for="voter">Registered Voter</label>
                            <input type="checkbox" name="voter"  id="voter" >
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
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="mobile">Mobile Number</label>
                            <input type="number" name="mobile" id="mobile" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="tel">Tel No.</label>
                            <input type="number" name="tel" id="tel" class="form-control" required>
                        </div>
                    </div>


                    <h5 class="text-center mt-5">Incase of Emergency</h5>
                    <hr>

                    <!--Contact Information-->
                    <div class="form-contact-info row">
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="incaseFullname">Fullname</label>
                            <input type="text" name="incaseFullname" id="incaseFullname" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="incaseContact">Contact Number</label>
                            <input type="number" name="incaseContact" id="incaseContact" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="incaseAddress">Address</label>
                            <input type="text" name="incaseAddress" id="incaseAddress" class="form-control" required>
                        </div>
                    </div>
                    

                    <h5 class="text-center mt-5">Family Information</h5>
                    <hr>

                    <!--Family Information-->
                    <div class="form-contact-info row">
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="mother">Mother</label>
                            <input type="text" name="mother" id="mother" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="father">Father</label>
                            <input type="text" name="father" id="father" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="spouse">Spouse</label>
                            <input type="text" name="spouse" id="spouse" class="form-control" required>
                        </div>
                    </div>

                    <!--Address Information-->
                    <h5 class="text-center mt-5">Address Information</h5>
                    <hr>

                    <div class="form-contact-info row">
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="houseNo">House Number</label>
                            <input type="number" name="houseNo" id="houseNo" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="purok">Purok</label>
                            <input type="text" name="purok" id="purok" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="fullAddress">Full Address</label>
                            <input type="text" name="fullAddress" id="fullAddress" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="street">Street</label>
                            <input type="text" name="street" id="street" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="familyHoa">HOA</label>
                            <input type="text" name="familyHoa" id="familyHoa" class="form-control" required>
                        </div>


                    </div>

                    
                    <h5 class="text-center mt-5">Employment Information</h5>
                    <hr>

                    <!--Employment Information-->
                    <div class="form-contact-info row">
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="eStatus">Employment Status</label>
                            <select name="eStatus" id="eStatus" class="form-control" required>
                                <option value="employed">Employed</option>
                                <option value="unemployed">Unemployed</option>
                                <option value="self-employed">Self-Employed</option>
                                <option value="student">Student</option>
                                <option value="retired">Retired</option>
                            </select>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="eField">Employment Field</label>
                            <input type="text" name="eField" id="eField" class="form-control " required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="occupation">Occupation</label>
                            <input type="text" name="occupation" id="occupation" class="form-control" required>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="mIncome">Monthly Income</label>
                            <input type="number" name="mIncome" id="mIncome" class="form-control" required>
                        </div>



                    </div>

                    <h5 class="text-center mt-5">Education Information</h5>
                    <hr>

                    <!--Education Information-->
                    <div class="form-contact-info row">
                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="higherEducAttain">Higher Education Attainment</label>
                            <select name="higherEducAttain" id="higherEducAttain" class="form-control" required>
                                <option value="none">None</option>
                                <option value="high_school">High School</option>
                                <option value="associate">Associate Degree</option>
                                <option value="bachelor">Bachelor's Degree</option>
                                <option value="master">Master's Degree</option>
                                <option value="doctorate">Doctorate</option>
                            </select>
                        </div>

                        <div class="form-group mt-2 col-sm-12 col-md-4">
                            <label for="tSchool">Type of School</label>
                            <select name="tSchool" id="tSchool" class="form-control" required>
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                            </select>
                        </div>
                    </div>

                    <!--Submit Button-->
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <a href="./residentLogin.php" class="btn btn-danger">Cancel</a>
                    </div>



                </form>
            </div>
        </div>
    </div>

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
   const params = new URLSearchParams(window.location.search);
         if(params.get('error') == 1){
        alert('Your account is disabled.');
        setInterval(() => {
           params.delete('error');
           history.replaceState(history.state,'', window.location.pathname);
        }, 1000);
    }
        // Prevent number input for specific text fields
        const textFields = ['firstName', 'middleName', 'lastName', 'suffix', 'alias', 'salutation'];
        textFields.forEach(id => {
            document.getElementById(id).addEventListener('input', function(event) {
                this.value = this.value.replace(/[0-9]/g, '');
            });
        });

        // Automatically compute age based on birthdate
        document.getElementById('birthdate').addEventListener('change', function() {
            const birthdate = new Date(this.value);
            const today = new Date();
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