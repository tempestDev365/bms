<?php
session_start();
$email = $_GET['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let's Get Started</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Hide the second form initially */
        #form2, #form3, #form4, #form5, #form6, #form7 {
            display: none;
        }
        /* Arrow design for pagination */
        .pagination .page-link::after {
            content: '';
        }
        .pagination .page-item.active .page-link::after {
            content: ' ➔';
        }
    </style>
</head>
<body>

    <main style="background-color: #2D3187; min-height: 100vh" class="d-flex justify-content-center align-items-center p-2 flex-column">

        <!-- Pagination -->
        <ul class="pagination">
            <li class="page-item active"><a class="page-link" href="#" id="page1">1</a></li>
            <li class="page-item disabled"><a class="page-link" href="#" id="page2">2</a></li>
            <li class="page-item disabled"><a class="page-link" href="#" id="page4">3</a></li>
            <li class="page-item disabled"><a class="page-link" href="#" id="page5">4</a></li>
        </ul>

        <!-- Form 1 -->
        <div class="card p-3" id="form1" style="max-width: 500px; max-height: 500px; width: 500px; height: 500px;">
            <div class="card-title">
                <h2>Register!</h2>
            </div>
            <div class="card-body">
              <form action="../../controllers/residentRegisterController.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                        <input type="email" placeholder="Email" class="form-control" value = <?php echo $email; ?> name="email" required>   
                    </div>
                    <div class="form-group mt-2">
                        <input type="text" placeholder="First Name" class="form-control" name="first_name" required>
                    </div>
                    <div class="form-group mt-2">
                        <input type="text" placeholder="Middle Name" class="form-control" name="middle_name" id="middle_name">
                    </div>
                    <div class="form-group mt-2 d-flex justify-content-end">
                        <input type="checkbox" id="no_middle_name_checkbox"> &nbsp;
                        <label for="no_middle_name_checkbox">I have no middle name</label>
                    </div>
                    <div class="form-group mt-2 d-flex">
                        <input type="text" placeholder="Last Name" class="form-control me-2" name = "last_name" required>
                        <select name="suffix" id="suffix">
                            <option value="Suffix" disabled selected>Suffix</option>
                            <option value="Jr">JR</option>
                            <option value="Sr">SR</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                        </select>
                    </div>
                    <div class="form-group mt-2 d-flex justify-content-between" style="gap: 5px">
                        <select name="sex" id="suffix" class="form-control" required>
                            <option value="Suffix" disabled selected>Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <input type="number" placeholder="Age" class="form-control" name="age" id="age" readonly required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="birthday">Date of Birth</label>
                        <input type="date" class="form-control" name="birthday" id="birthday" required 
                               onchange="calculateAge()" max="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group mt-2 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="next1" disabled>Next</button>
                    </div>
                    
              
            </div>
        </div>

        <!-- Form 2 -->
        <div class="card p-3" id="form2" style="max-width: 500px; max-height: 500px; width: 500px; height: 500px;">
            <div class="card-title">
                <h2>Register!</h2>
            </div>
            <div class="card-body">
                
                    <div class="form-group mt-2 d-flex justify-content-between" style="gap: 5px">
                        <select name="civil_status" id="civil_status" class="form-select" required>
                            <option value="civil_status" disabled selected>Civil Status</option>
                            <option value="Single">SINGLE</option>
                            <option value="Married">MARRIED</option>
                            <option value="Divorced">DIVORCED</option>
                            <option value="Widowed">WIDOWED</option>
                        </select>
                          <select name="employment_status" id="employment_status" class="form-select" required>
                            <option value="employment_status" disabled selected>Employment Status</option>
                            <option value="Employed">Employed</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Self-Employed">Self-Employed</option>
                            <option value="Student">Student</option>
                            <option value="Retired">Retired</option>

                        </select>
                        <select name="purok" id="purok" class="form-select" required>
                            <option value="purok" disabled selected required>Purok</option>
                            <option value="Alma">ALMA</option>
                            <option value="Banalo">BANALO</option>
                            <option value="Sineguelasan">SINEGUELASAN</option>
                        </select>
                    </div>
                    <div class="form-group mt-2 d-flex justify-content-between" style="gap: 5px">
                        <input type="text" placeholder="House Number" class="form-control" name = "house_number" required>
                        <input type="text" placeholder="Street" class="form-control" name = "street" required>
                    </div>
                    <div class="form-group mt-2">
                        <input type="text" placeholder="Name of the house Owner (Optional)" class="form-control" name = "house_owner">
                    </div>
                    <div class="form-group mt-2 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="next2" disabled>Next</button>
                    </div>
                    
              
            </div>
        </div>

     
        <!-- Form 4 -->
        <div class="card p-3" id="form4" style="min-width: 600px; min-height: 600px; width: 600px;">
            <div class="card-title">
                <h2>IDENTITY VERIFICATION!</h2>
            </div>
            <div class="card-body">
                <div class="upper-card">
                    <label for="">Please upload barangay ID / valid ID</label>
                    <div class="upper-card-img">
                        <div class="img-group d-flex justify-content-center align-items-center">
                            <div class="card-img">
                                <img src="../../assets/img/good-id.png" alt="good" class="img-fluid">
                            </div>
                            <div class="card-img">
                                <img src="../../assets/img/bad-img1.png" alt="bad-img1.png" class="img-fluid">
                            </div>
                            <div class="card-img">
                                <img src="../../assets/img/bad-img2.png" alt="bad-img2.png" class="img-fluid">
                            </div>
                        </div>
                        <div class="img-label d-flex justify-content-around align-items-center">
                            <label for="">Good</label>
                            <label for="">Bad</label>
                            <label for="">Bad</label>
                        </div>
                    </div>
                    <div class="middle-card mt-3 d-flex flex-column">
                        <p>Make sure your ID is</p>
                        <label>Valid</label>
                        <label>Readable</label>
                        <label>Original full-sized. Unedited Document</label>
                        <label>No black and white images</label>
                    </div>
                    <div class="bottom-card mt-3 border d-flex">
                        <div class="form-group" style="flex-grow: 1;">
                            <input type="file" name="frontID" hidden id="frontID" onchange="previewImage(this, 'frontPreview'); validateImageUploads();">
                            <label class="d-flex justify-content-center align-items-center" for="frontID" style="width: 100%; border: 1px dotted black; height: 200px; cursor: pointer;">
                                <img id="frontPreview" src="#" alt="Front ID Preview" style="display: none; max-width: 100%; max-height: 100%; object-fit: contain;">
                                <span id="frontUploadText">Upload Front</span>
                            </label>
                        </div>
                        <div class="form-group" style="flex-grow: 1;">
                            <input type="file" name="backID" hidden id="backID" onchange="previewImage(this, 'backPreview'); validateImageUploads();">
                            <label class="d-flex justify-content-center align-items-center" for="backID" style="width: 100%; border: 1px dotted black; height: 200px; cursor: pointer;">
                                <img id="backPreview" src="#" alt="Back ID Preview" style="display: none; max-width: 100%; max-height: 100%; object-fit: contain;">
                                <span id="backUploadText">Upload Back</span>
                            </label>
                        </div>
                    </div>
                    <div class="bottom-camera mt-3" style="gap: 5px">
                        <button type="button" class="btn btn-primary w-100 mb-2" onclick="openCamera('front')">CAMERA FOR FRONT</button>
                        <button type = "button" class="btn btn-primary w-100" onclick="openCamera('back')">CAMERA FOR BACK</button>
                        <video id="camera" style="display: none; width: 100%; margin-top: 10px;" autoplay></video>
                        <canvas id="canvas" style="display: none;"></canvas>
                        <button id="captureBtn" class="btn btn-success w-100 mt-2" style="display: none;" onclick="captureImage()">Capture</button>
                    </div> 
                </div>
                <div class="form-group mt-2 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" id="next4" disabled>Next</button>
                </div>
            </div>
        </div>

        <!-- Form 5 -->
        <div class="card p-3" id="form5" style="max-width: 600px; min-height: 600px; width: 600px;">
        <div class="card-title">
                <h2>CONFORMATION INFORMATION!</h2>
                <label for="">Please make sure that all the details are correct</label>
            </div>
            <div class="card-body">
                <p class = "first_name">First Name: </p>
                <p class = "middle_name">Middle Name:</p>
                <p class = "last_name">Last Name:</p>
                <p class = "suffix">Suffix</p>
                <p class = "sex">Sex:</p>
                <p class = "age">Age:</p>
                <p class = "birthday">Date of birth:</p>
                <p class = "civil_status">Civil Status:</p>
                <p class = "purok">Purok:</p>
                <p class = "address">House no./Bldg./Street name:</p>
                <p class = "home_owner">Name of the house owner:</p>
            </div>
          
            <div class="card-btn mt-3">
                <button class="btn btn-primary w-100 p-3" style="border-radius: 20px;">CONFIRM</button>
            </div>
        </div>
    </form>

       

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function calculateAge() {
            const birthdayInput = document.getElementById('birthday');
            const ageInput = document.getElementById('age');
            
            const birthday = new Date(birthdayInput.value);
            const today = new Date();
            
            // Check if selected date is in the future
            if (birthday > today) {
                alert("Birthday cannot be in the future!");
                birthdayInput.value = ''; // Clear the input
                ageInput.value = ''; // Clear the age
                return;
            }
            
            let age = today.getFullYear() - birthday.getFullYear();
            const monthDiff = today.getMonth() - birthday.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthday.getDate())) {
                age--;
            }
            
            ageInput.value = age;
            inputs['age'] = age;
            document.querySelector('.age').textContent = `Age: ${age}`;
        }
        
        // JavaScript to handle pagination
        document.getElementById('page1').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'block';
            document.getElementById('form2').style.display = 'none';
            document.getElementById('form4').style.display = 'none';
            document.getElementById('form5').style.display = 'none';
            updatePaginationActiveState('page1');
        });

        document.getElementById('page2').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'none';
            document.getElementById('form2').style.display = 'block';
            document.getElementById('form4').style.display = 'none';
            document.getElementById('form5').style.display = 'none';
            updatePaginationActiveState('page2');
        });

       

        document.getElementById('page4').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'none';
            document.getElementById('form2').style.display = 'none';
            document.getElementById('form4').style.display = 'block';
            document.getElementById('form5').style.display = 'none';
            updatePaginationActiveState('page4');
        });

        document.getElementById('page5').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'none';
            document.getElementById('form2').style.display = 'none';
            document.getElementById('form4').style.display = 'none';
            document.getElementById('form5').style.display = 'block';
            updatePaginationActiveState('page5');
        });

        // Function to enable the next page
        function enableNextPage(currentPage, nextPage) {
            document.getElementById(currentPage).classList.remove('disabled');
            document.getElementById(nextPage).classList.remove('disabled');
        }

        // Function to validate form fields
        function validateForm(formId, nextButtonId) {
            const form = document.getElementById(formId);
            const nextButton = document.getElementById(nextButtonId);
            const inputs = form.querySelectorAll('input[required], select[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value) {
                    isValid = false;
                }
            });

            nextButton.disabled = !isValid;
        }

        // Function to update pagination active state
        function updatePaginationActiveState(activePageId) {
            document.querySelectorAll('.pagination .page-item').forEach(item => {
                item.classList.remove('active');
            });
            document.getElementById(activePageId).parentElement.classList.add('active');
        }

        // Function to validate image uploads for Form 4
        function validateImageUploads() {
            const frontID = document.getElementById('frontID').files.length > 0;
            const backID = document.getElementById('backID').files.length > 0;
            document.getElementById('next4').disabled = !(frontID && backID);
        }

        // Event listeners for form validation
        document.querySelectorAll('#form1 input[required], #form1 select[required]').forEach(input => {
            input.addEventListener('input', () => validateForm('form1', 'next1'));
        });

        document.querySelectorAll('#form2 input[required], #form2 select[required]').forEach(input => {
            input.addEventListener('input', () => validateForm('form2', 'next2'));
        });

        document.querySelectorAll('#form4 input[required], #form4 select[required]').forEach(input => {
            input.addEventListener('input', () => validateForm('form4', 'next4'));
        });

        // Event listeners for image uploads in Form 4
        document.getElementById('frontID').addEventListener('change', validateImageUploads);
        document.getElementById('backID').addEventListener('change', validateImageUploads);

        // Event listeners for "Next" buttons
        document.getElementById('next1').addEventListener('click', function() {
            enableNextPage('page1', 'page2');
            document.getElementById('page2').click();
            updatePaginationActiveState('page2');
        });

        document.getElementById('next2').addEventListener('click', function() {
            enableNextPage('page2', 'page4');
            document.getElementById('page4').click();
            updatePaginationActiveState('page4');
        });

        document.getElementById('next4').addEventListener('click', function() {
            enableNextPage('page4', 'page5');
            document.getElementById('page5').click();
            updatePaginationActiveState('page5');
        });

        const inputs = {}
    const input = document.querySelectorAll('input');
   input.forEach(input => {
       input.addEventListener('input', function(e) {
           inputs[e.target.name] = e.target.value
           document.querySelector('.first_name').textContent = `First name: ${inputs.first_name || 'N/A'}`;
document.querySelector('.middle_name').textContent = `Middle name: ${inputs.middle_name || 'N/A'}`;
document.querySelector('.last_name').textContent = `Last name: ${inputs.last_name || 'N/A'}`;
document.querySelector('.suffix').textContent = `Suffix: ${inputs.suffix || 'N/A'}`;
document.querySelector('.sex').textContent = `Sex: ${inputs.sex || 'N/A'}`;
document.querySelector('.age').textContent = `Age: ${inputs.age || 'N/A'}`;
document.querySelector('.birthday').textContent = `Date of birth: ${inputs.birthday || 'N/A'}`;
document.querySelector('.civil_status').textContent = `Civil Status: ${inputs.civil_status || 'N/A'}`;
document.querySelector('.purok').textContent = `Purok: ${inputs.purok || 'N/A'}`;
document.querySelector('.address').textContent = `House no./Bldg./Street name: ${inputs.house_number || 'N/A'} ${inputs.street || 'N/A'}`;
document.querySelector('.home_owner').textContent = `Name of the house owner: ${inputs.house_owner || 'N/A'}`;
       })
    })
    const select = document.querySelectorAll('select');
    select.forEach(select => {
        select.addEventListener('change', function(e) {
            inputs[e.target.name] = e.target.value
            document.querySelector('.suffix').textContent = `Suffix: ${inputs.suffix}`
            document.querySelector('.sex').textContent = `Sex: ${inputs.sex}`
            document.querySelector('.civil_status').textContent = `Civil Status: ${inputs.civil_status}`
            document.querySelector('.purok').textContent = `Purok: ${inputs.purok}`
            console.log(inputs)
        })
    })  

    let currentMode = '';
    let stream = null;

    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        const uploadText = document.getElementById(previewId === 'frontPreview' ? 'frontUploadText' : 'backUploadText');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                uploadText.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    async function openCamera(mode) {
        currentMode = mode;
        const video = document.getElementById('camera');
        const captureBtn = document.getElementById('captureBtn');
        
        try {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
            
            stream = await navigator.mediaDevices.getUserMedia({ video: true });
            video.srcObject = stream;
            video.style.display = 'block';
            captureBtn.style.display = 'block';
        } catch (err) {
            console.error('Error accessing camera:', err);
            alert('Error accessing camera');
        }
    }

    function captureImage() {
        const video = document.getElementById('camera');
        const canvas = document.getElementById('canvas');
        const preview = document.getElementById(currentMode === 'front' ? 'frontPreview' : 'backPreview');
        const uploadText = document.getElementById(currentMode === 'front' ? 'frontUploadText' : 'backUploadText');
        
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);
        
        // Convert canvas to blob and create a File object
        canvas.toBlob((blob) => {
            const file = new File([blob], `${currentMode}ID.jpg`, { type: 'image/jpeg' });
            const input = document.getElementById(currentMode === 'front' ? 'frontID' : 'backID');
            
            // Create a FileList object
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            input.files = dataTransfer.files;
            
            // Show preview
            preview.src = canvas.toDataURL('image/jpeg');
            preview.style.display = 'block';
            uploadText.style.display = 'none';
            
            // Hide camera elements
            video.style.display = 'none';
            document.getElementById('captureBtn').style.display = 'none';
            
            // Stop camera stream
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }

            // Validate image uploads
            validateImageUploads();
        }, 'image/jpeg');
    }

    document.getElementById('no_middle_name_checkbox').addEventListener('change', function() {
        const middleNameInput = document.getElementById('middle_name');
        if (this.checked) {
            middleNameInput.value = '';
            middleNameInput.disabled = true;
        } else {
            middleNameInput.disabled = false;
        }
    });
    </script>
</body>
</html>