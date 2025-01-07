<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
                    <div class="card shadow-sm" style="flex: 1 1 300px; min-height: 300px">Profile</div>
                    <div class="card shadow-sm" style="flex: 1 1 300px; min-height: 300px">Signature</div>
                    <div class="card shadow-sm" style="flex: 1 1 300px; min-height: 300px">Valid ID</div>
                </div>
            </div>

            <div class="info-section p-3">
                <div class="box bg-white shadow-sm border rounded-3 p-3">
                   
                    <div class="box-body row">
                        <div class="personal-info col-md-12 col-lg-4 d-flex flex-column" style="gap: 5px;">
                            <div class="box-header">
                                <h4>Personal Information</h4>
                            </div>
                                <label>Full Name:</label>
                                <label>Sex:</label>
                                <label>Birthdate:</label>
                                <label>Birthplace:</label>
                                <label>Civil Status:</label>
                                <label>Height:</label>
                                <label>Weight:</label>
                                <label>Blood Type:</label>
                                <label>Religion:</label>
                                <label>Ethnic Origin:</label>
                                <label>Nationality:</label>
                                <label>Precinct Number:</label>
                                <label>Registered Voter:</label>
                                <label>Organization Member:</label>
                        </div>
                        <div class="other-info col-md-12 col-lg-4 d-flex flex-column" style="gap: 5px;">
                            <div class="contact-header">
                                <h4>Contact Information</h4>
                            </div>
                                <label>Email:</label>
                                <label>Mobile Number:</label>
                                <label>Tel No:</label>
                            <div class="contact-header">
                                <h4>Incase of Emergency</h4>
                            </div>
                                <label>Fullname</label>
                                <label>Contact Number:</label>
                                <label>Address:</label>
                            <div class="contact-header">
                                <h4>Family Information</h4>
                            </div>
                                <label>Mother:</label>
                                <label>Father:</label>
                                <label>Spouse:</label>
                            <div class="contact-header">
                                <h4>Educational Information:</h4>
                            </div>
                                <label>Highest Education Attainment:</label>
                                <label>Type of School:</label>
                           
                        </div>

                        <div class="other-info-2 col-md-12 col-lg-4 d-flex flex-column" style="gap: 5px;">
                            <div class="contact-header">
                                <h4>Address Information</h4>
                            </div>
                                <label>House Number:</label>
                                <label>Purok:</label>
                                <label>Full Address:</label>
                                <label>Street:</label>
                                <label>Hoa:</label>
                            <div class="contact-header">
                                <h4>Employment Information:</h4>
                            </div>
                                <label>Employment Status:</label>
                                <label>Employment Field:</label>
                                <label>Occupation:</label>
                                <label>Monthly Income:</label>
                        </div>
                    </div>
                </div>
            </div>
       

        </main>
    </div>


    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../components/residentSidebar.js?v=<?php echo time(); ?>" defer></script>
</body>
</html>