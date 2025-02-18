<?php
session_start();
$email = $_SESSION['email'];
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
    </style>
</head>
<body>

    <main style="background-color: #2D3187;" class="vh-100 d-flex justify-content-center align-items-center p-2 flex-column">

        <!-- Pagination -->
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#" id="page1">1</a></li>
            <li class="page-item"><a class="page-link" href="#" id="page2">2</a></li>
            <li class="page-item"><a class="page-link" href="#" id="page4">3</a></li>
            <li class="page-item"><a class="page-link" href="#" id="page5">4</a></li>
            
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
                        <input type="text" placeholder="Middle Name" class="form-control" name = "middle_name">
                    </div>
                    <div class="form-group mt-2 d-flex justify-content-end">
                        <input type="checkbox"> &nbsp;
                        <label for="">I have no middle name</label>
                    </div>
                    <div class="form-group mt-2 d-flex">
                        <input type="text" placeholder="Last Name" class="form-control me-2" name = "last_name">
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
                        <select name="sex" id="suffix" class="form-control">
                            <option value="Suffix" disabled selected>Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <input type="number" placeholder="Age" class="form-control" name = "age" required>
                    </div>
                    <div class="form-group mt-2">
                        <input type="date" class="form-control" name = "birthday" required>
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
                            <option value="student">Student</option>
                            <option value="pwd">PWD</option>
                            <option value="senior">Senior</option>
                        </select>
                        <select name="purok" id="purok" class="form-select">
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
                    <div class="bottom-card mt-3">
                            <div class="form-group" style="flex-grow: 1;">
                                <input type="file" name="frontID" hidden id="frontID">
                                <label class="d-flex justify-content-center align-items-center" for="frontID" style="width: 100%; border: 1px dotted black; height: 200px; cursor: pointer;">Upload Front</label>
                            </div>
                            <div class="form-group" style="flex-grow: 1;">
                                <input type="file" name="backID" hidden id="backID">
                                <label class="d-flex justify-content-center align-items-center" for="backID" style="width: 100%; border: 1px dotted black; height: 200px; cursor: pointer;">Upload Back</label>
                            </div>
                    </div>
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
            <div class="card-edit d-flex justify-content-end">
                <a href="#">Edit Details</a>
            </div>
            <div class="card-btn mt-3">
                <button class="btn btn-primary w-100 p-3" style="border-radius: 20px;">CONFIRM</button>
            </div>
        </div>
    </form>

       

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        // JavaScript to handle pagination
        document.getElementById('page1').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'block';
            document.getElementById('form2').style.display = 'none';
            document.getElementById('form4').style.display = 'none';
            document.getElementById('form5').style.display = 'none';
        });

        document.getElementById('page2').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'none';
            document.getElementById('form2').style.display = 'block';
            document.getElementById('form4').style.display = 'none';
            document.getElementById('form5').style.display = 'none';
        });

       

        document.getElementById('page4').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'none';
            document.getElementById('form2').style.display = 'none';
            document.getElementById('form4').style.display = 'block';
            document.getElementById('form5').style.display = 'none';
        });

        document.getElementById('page5').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'none';
            document.getElementById('form2').style.display = 'none';
            document.getElementById('form4').style.display = 'none';
            document.getElementById('form5').style.display = 'block';
        });
        const inputs = {}
    const input = document.querySelectorAll('input');
   input.forEach(input => {
       input.addEventListener('input', function(e) {
           inputs[e.target.name] = e.target.value
           document.querySelector('.first_name').textContent = `First name: ${inputs.first_name}`
           document.querySelector('.middle_name').textContent = `Middle name: ${inputs.middle_name}`
           document.querySelector('.last_name').textContent = `Last name: ${inputs.last_name}`
           document.querySelector('.suffix').textContent = `Suffix: ${inputs.suffix}`
           document.querySelector('.sex').textContent = `Sex: ${inputs.sex}`
           document.querySelector('.age').textContent = `Age: ${inputs.age}` 
            document.querySelector('.birthday').textContent = `Date of birth: ${inputs.birthday}`
            document.querySelector('.civil_status').textContent = `Civil Status: ${inputs.civil_status}`
            document.querySelector('.purok').textContent = `Purok: ${inputs.purok}`
            document.querySelector('.address').textContent = `House no./Bldg./Street name: ${inputs.house_number} ${inputs.street}`
            document.querySelector('.home_owner').textContent = `Name of the house owner: ${inputs.house_owner}` 
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
    </script>
</body>
</html>