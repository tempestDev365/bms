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
            <li class="page-item"><a class="page-link" href="#" id="page3">3</a></li>
            <li class="page-item"><a class="page-link" href="#" id="page4">4</a></li>
            <li class="page-item"><a class="page-link" href="#" id="page5">5</a></li>
            <li class="page-item"><a class="page-link" href="#" id="page6">6</a></li>
            <li class="page-item"><a class="page-link" href="#" id="page7">7</a></li>
        </ul>

        <!-- Form 1 -->
        <div class="card p-3" id="form1" style="max-width: 500px; max-height: 500px; width: 500px; height: 500px;">
            <div class="card-title">
                <h2>Register!</h2>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="form-group">
                        <input type="email" placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <input type="text" placeholder="First Name" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <input type="text" placeholder="Middle Name" class="form-control">
                    </div>
                    <div class="form-group mt-2 d-flex justify-content-end">
                        <input type="checkbox"> &nbsp;
                        <label for="">I have no middle name</label>
                    </div>
                    <div class="form-group mt-2 d-flex">
                        <input type="text" placeholder="Last Name" class="form-control me-2">
                        <select name="suffix" id="suffix">
                            <option value="Suffix" disabled selected>Suffix</option>
                            <option value="">JR</option>
                            <option value="">SR</option>
                            <option value="">I</option>
                            <option value="">II</option>
                            <option value="">III</option>
                            <option value="">IV</option>
                            <option value="">V</option>
                        </select>
                    </div>
                    <div class="form-group mt-2 d-flex justify-content-between" style="gap: 5px">
                        <select name="suffix" id="suffix" class="form-control">
                            <option value="Suffix" disabled selected>Sex</option>
                            <option value="">Male</option>
                            <option value="">Female</option>
                        </select>
                        <input type="number" placeholder="Age" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <input type="date" class="form-control">
                    </div>
                    <div class="button mt-4">
                        <button class="btn btn-primary w-100 p-3" style="border-radius: 20px;">CONTINUE</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form 2 -->
        <div class="card p-3" id="form2" style="max-width: 500px; max-height: 500px; width: 500px; height: 500px;">
            <div class="card-title">
                <h2>Register!</h2>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="form-group mt-2 d-flex justify-content-between" style="gap: 5px">
                        <select name="suffix" id="suffix" class="form-select">
                            <option value="Suffix" disabled selected>Civil Status</option>
                            <option value="">SINGLE</option>
                            <option value="">MARRIED</option>
                            <option value="">DIVORCED</option>
                            <option value="">WIDOWED</option>
                        </select>
                        <select name="suffix" id="suffix" class="form-select">
                            <option value="Suffix" disabled selected>Purok</option>
                            <option value="">ALMA</option>
                            <option value="">BANALO</option>
                            <option value="">SINEGUELASAN</option>
                        </select>
                    </div>
                    <div class="form-group mt-2 d-flex justify-content-between" style="gap: 5px">
                        <input type="text" placeholder="House Number" class="form-control">
                        <input type="text" placeholder="Street" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <input type="text" placeholder="Name of the house Owner (Optional)" class="form-control">
                    </div>
                    <div class="button mt-4">
                        <button class="btn btn-primary w-100 p-3" style="border-radius: 20px;">CONTINUE</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form 3 -->
        <div class="card p-3" id="form3" style="min-width: 500px; min-height: 500px; width: 500px;">
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
                        <form action="" class="d-flex justify-content-center align-items-center" style="gap: 5px;">
                            <div class="form-group" style="flex-grow: 1;">
                                <input type="file" name="frontID" hidden id="frontID">
                                <label class="d-flex justify-content-center align-items-center" for="frontID" style="width: 100%; border: 1px dotted black; height: 200px; cursor: pointer;">Upload Front</label>
                            </div>
                            <div class="form-group" style="flex-grow: 1;">
                                <input type="file" name="backID" hidden id="backID">
                                <label class="d-flex justify-content-center align-items-center" for="backID" style="width: 100%; border: 1px dotted black; height: 200px; cursor: pointer;">Upload Back</label>
                            </div>
                        </form>
                        <button class="btn btn-primary w-100 mt-3 p-3" style="border-radius: 20px;">NEXT</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form 4 -->
        <div class="card p-3" id="form4" style="min-width: 500px; min-height: 500px; width: 500px;">
            <div class="card-title">
                <h2>IDENTITY VERIFICATION!</h2>
            </div>
            <div class="card-body">
                <div class="upper-card">
                    <label for="">Please upload proof of living.</label>
                </div>
                <div class="middle-cards mt-3">
                    <form action="" class="d-flex justify-content-center align-items-center" style="gap: 5px;">
                        <div class="form-group" style="flex-grow: 1;">
                            <input type="file" name="proofOfLiving" hidden id="proofOfLiving">
                            <label class="d-flex justify-content-center align-items-center" for="proofOfLiving" style="width: 100%; border: 1px dotted black; height: 200px; cursor: pointer;"></label>
                        </div>
                    </form>
                    <div class="note mt-2">
                        <label for="">Take Note: This is optional if your ID is not addressed in this barangay. Please provide proof of living if possible.</label>
                    </div>
                    <button class="btn btn-primary w-100 mt-5 p-3" style="border-radius: 20px;">NEXT</button>
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
                <p>First Name::</p>
                <p>Middle Name:</p>
                <p>Last Name:</p>
                <p>Suffix</p>
                <p>Sex:</p>
                <p>Age:</p>
                <p>Date of birth:</p>
                <p>Civil Status:</p>
                <p>Purok:</p>
                <p>House no./Bldg./Street name:</p>
                <p>Name of the house owner:</p>
            </div>
            <div class="card-edit d-flex justify-content-end">
                <a href="#">Edit Details</a>
            </div>
            <div class="card-btn mt-3">
                <button class="btn btn-primary w-100 p-3" style="border-radius: 20px;">CONFIRM</button>
            </div>
        </div>

        <!-- Form 6 -->
        <div class="card p-3" id="form6" style="max-width: 600px; min-height: 600px; width: 600px;">
            <div class="card-title">
                <h2>Create your own MPIN</h2>
                <label for="">Enter a 6 digit MPIN below</label>
            </div>
            <div class="card-pin mt-5 d-flex flex-column justify-content-center align-items-center" style="flex-grow: 1;">
                <label for="">Set your MPIN</label>
                <div class="pin-group d-flex justify-content-between align-items-center" style="gap: 5px;">
                    <input type="number" style="max-width: 50px; max-height: 60px; height: 60px;" name="" id="">
                    <input type="number" style="max-width: 50px; max-height: 60px; height: 60px;" name="" id="">
                    <input type="number" style="max-width: 50px; max-height: 60px; height: 60px;" name="" id="">
                    <input type="number" style="max-width: 50px; max-height: 60px; height: 60px;" name="" id="">
                    <input type="number" style="max-width: 50px; max-height: 60px; height: 60px;" name="" id="">
                    <input type="number" style="max-width: 50px; max-height: 60px; height: 60px;" name="" id="">
                </div>
            </div>
            <div class="card-btn mt-3">
                <button class="btn btn-primary w-100 p-3" style="border-radius: 20px;">CONFIRM</button>
            </div>
        </div>

        <!-- Form 7 -->
        <div class="card p-3" id="form7" style="max-width: 600px; min-height: 600px; width: 600px;">
            <div class="card-title">
                <h2>Re-Enter your own MPIN</h2>
                <label for="">Enter a 6 digit MPIN below</label>
            </div>
            <div class="card-pin mt-5 d-flex flex-column justify-content-center align-items-center" style="flex-grow: 1;">
                <label for="">Set your MPIN</label>
                <div class="pin-group d-flex justify-content-between align-items-center" style="gap: 5px;">
                    <input type="number" style="max-width: 50px; max-height: 60px; height: 60px;" name="" id="">
                    <input type="number" style="max-width: 50px; max-height: 60px; height: 60px;" name="" id="">
                    <input type="number" style="max-width: 50px; max-height: 60px; height: 60px;" name="" id="">
                    <input type="number" style="max-width: 50px; max-height: 60px; height: 60px;" name="" id="">
                    <input type="number" style="max-width: 50px; max-height: 60px; height: 60px;" name="" id="">
                    <input type="number" style="max-width: 50px; max-height: 60px; height: 60px;" name="" id="">
                </div>
            </div>
            <div class="card-btn mt-3">
                <button class="btn btn-primary w-100 p-3" style="border-radius: 20px;">NEXT</button>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        // JavaScript to handle pagination
        document.getElementById('page1').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'block';
            document.getElementById('form2').style.display = 'none';
            document.getElementById('form3').style.display = 'none';
            document.getElementById('form4').style.display = 'none';
            document.getElementById('form5').style.display = 'none';
            document.getElementById('form6').style.display = 'none';
            document.getElementById('form7').style.display = 'none';
        });

        document.getElementById('page2').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'none';
            document.getElementById('form2').style.display = 'block';
            document.getElementById('form3').style.display = 'none';
            document.getElementById('form4').style.display = 'none';
            document.getElementById('form5').style.display = 'none';
            document.getElementById('form6').style.display = 'none';
            document.getElementById('form7').style.display = 'none';
        });

        document.getElementById('page3').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'none';
            document.getElementById('form2').style.display = 'none';
            document.getElementById('form3').style.display = 'block';
            document.getElementById('form4').style.display = 'none';
            document.getElementById('form5').style.display = 'none';
            document.getElementById('form6').style.display = 'none';
            document.getElementById('form7').style.display = 'none';
        });

        document.getElementById('page4').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'none';
            document.getElementById('form2').style.display = 'none';
            document.getElementById('form3').style.display = 'none';
            document.getElementById('form4').style.display = 'block';
            document.getElementById('form5').style.display = 'none';
            document.getElementById('form6').style.display = 'none';
            document.getElementById('form7').style.display = 'none';
        });

        document.getElementById('page5').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'none';
            document.getElementById('form2').style.display = 'none';
            document.getElementById('form3').style.display = 'none';
            document.getElementById('form4').style.display = 'none';
            document.getElementById('form5').style.display = 'block';
            document.getElementById('form6').style.display = 'none';
            document.getElementById('form7').style.display = 'none';
        });

        document.getElementById('page6').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'none';
            document.getElementById('form2').style.display = 'none';
            document.getElementById('form3').style.display = 'none';
            document.getElementById('form4').style.display = 'none';
            document.getElementById('form5').style.display = 'none';
            document.getElementById('form6').style.display = 'block';
            document.getElementById('form7').style.display = 'none';
        });

        // Add event listener for page 7
        document.getElementById('page7').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form1').style.display = 'none';
            document.getElementById('form2').style.display = 'none';
            document.getElementById('form3').style.display = 'none';
            document.getElementById('form4').style.display = 'none';
            document.getElementById('form5').style.display = 'none';
            document.getElementById('form6').style.display = 'none';
            document.getElementById('form7').style.display = 'block';
        });
    </script>
</body>
</html>