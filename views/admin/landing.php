<?php
include '../../database/databaseConnection.php';
function getAllAnnouncement(){
    $conn = $GLOBALS['conn'];
    $qry = "SELECT * FROM announcement_tbl";
    $result = $conn->prepare($qry);
    $result->execute();
    $announcement = $result->fetchAll(PDO::FETCH_ASSOC);
    return $announcement;
}


$announcements = getAllAnnouncement();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>BMS</title>
</head>
<style>
    @media (max-width: 842px) {
    .about-body {
        flex-direction: column !important;
    }

    #about-content-2 {
        order: 2;
    }
}
    
</style>
<body>
    <nav class="navbar navbar-expand-lg fixed-top py-4 navbar-dark" style="background-color: #2D3187;">
        <div class="container-fluid">
            <div class="navbar-brand">
                <a class="navbar-brand" href="./landing.html">Barangay Sinbanali</a>
            </div>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="#home">HOME</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#about">ABOUT</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#map">MAP</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="#services">SERVICES</a>
              </li> 
                
              
              <li class="nav-item">
                <a class="nav-link" href="../residents/residentLogin.php">LOGIN</a>
              </li>    
            </ul>
          </div>
        </div>
    </nav>

    <main class="p-4 text-light d-flex justify-content-center align-items-center" style="background-color: #2D3187; min-height: 80vh;" id="home">
        <div class="container mt-5 text-center">
            <h1>
                Welcome to Barangay Sinbanali, City of Bacoor.
            </h1>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore officia ab quibusdam voluptates alias praesentium. Eligendi vel architecto quasi culpa suscipit expedita rerum, deserunt et amet qui. Culpa, sed earum.
            </p>
            <div>
                <img src="../../assets/img/logo-125.png" class="img-fluid" width="80px" alt="">
                <img src="../../assets/img/sk-logo.png" class="img-fluid" width="80px" alt="">
            </div>
        </div>
    </main>

 

    <section class="p-4 bg-light" id="about">
        <div class="about-title h2 text-center">
            About Us
        </div>

        <div class="about-body d-flex justify-content-center align-items-center mt-3" id="about-body" style="gap: 1rem;">

            <img src="../../assets/img/barangaysinbanali.jpg" class="img-fluid shadow rounded-3" style=" width: 500px" alt="">
            
            <div class="about-content" style="width: 500px; max-width: 300px;">
                <h2>
                    Barangay Sinbanali
                </h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem cupiditate vel autem quis asperiores molestiae pariatur? Esse molestias sapiente ipsum sequi aperiam quidem nemo aspernatur ex, velit alias ea perferendis?</p>
                <button class="btn btn-outline-primary btn-sm">Visit</button>
            </div>

        </div>

        <div class="about-body d-flex justify-content-center align-items-center mt-3" style="gap: 1rem;">
            <div class="about-content" id="about-content-2" style="width: 500px; max-width: 300px;">
                <h2>
                    SK Sinbanali
                </h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem cupiditate vel autem quis asperiores molestiae pariatur? Esse molestias sapiente ipsum sequi aperiam quidem nemo aspernatur ex, velit alias ea perferendis?</p>
                <button class="btn btn-outline-primary btn-sm">Visit</button>
            </div>
            <img src="../../assets/img/sk.jpg" class="img-fluid shadow rounded-3" style=" width: 500px" alt="">

        </div>
    </section>

    <section" id="map" id="announcement">
        <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.938947234338!2d120.9442763153633!3d14.45449998989664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397cfb9b6c7d4e5%3A0x5e0a0b8b8b8b8b8b!2sFW5J%2BQRF%2C%20Bacoor%2C%20Cavite!5e0!3m2!1sen!2sph!4v1634567890123!5m2!1sen!2sph"
        width="100%" height="100%" style="border:0; min-height: 500px;" allowfullscreen="" loading="lazy"></iframe>
    </section>
    
    <section class="p-2" id="services" style="background-color: #e1dfee;">
        <div class="services-title text-center">
            <h2>
                Services Offered
            </h2>
        </div>

        <div class="service-body d-flex justify-content-center align-items-center" style="gap: 1rem; flex-wrap: wrap;">
            <div class="p-3 d-flex justify-content-center align-items-center flex-column bg-light rounded-3 shadow-sm border" style="min-height: 500px; max-width: 400px; width: 400px;">
                <img src="../../assets/img/request-documents.png" class="img-fluid" style="width: 100px;" alt="">
                <h3>Document Request</h3>
                <p>Login first to acquire this services.</p>
                <a href="../residents/residentLogin.php" class="btn btn-primary btn-sm">Proceed</a>
            </div>
            <div class="p-3 d-flex justify-content-center align-items-center flex-column bg-light rounded-3 shadow-sm border" style="min-height: 500px; max-width: 400px; width: 400px;">
                <img src="../../assets/img/resident-account.png" class="img-fluid" style="width: 100px;" alt="">
                <h3>Resident Account</h3>
                <p>Login first to acquire this services.</p>
                <a href="../residents/residentLogin.php" class="btn btn-primary btn-sm">Proceed</a>
            </div>
            <div class="p-3 d-flex justify-content-center align-items-center flex-column bg-light rounded-3 shadow-sm border" style="min-height: 500px; max-width: 400px; width: 400px;">
                <img src="../../assets/img/announcement.png" class="img-fluid" style="width: 100px;" alt="">
                <h3>Announcements</h3>
                <p>Login first to acquire this services.</p>
                <a href="../residents/residentLogin.php" class="btn btn-primary btn-sm">Proceed</a>
            </div>
        </div>
    </section>

   

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>