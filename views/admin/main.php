<?php
session_start();
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

    <div class="main-container d-flex" style="min-height: 100vh; max-width: 100vw;">
        <div class="admin-sidebar">
           
        </div>

        <div class="admin-content flex-grow-1 p-4 bg-light">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">BMS</li>
                  <li class="breadcrumb-item"><a href="./main.html" class="text-dark">Dashboard</a></li>
                </ol>
            </nav>

            <div class="container-fluid d-flex justify-content-center align-items-center p-3" style="flex-wrap: wrap; gap: 30px">

                <!--Resident Card-->
                <div class="card" style="max-width: 350px; width: 350px;">
                    <div class="card-body d-flex justify-content-between align-items-center flex-column">
                        <div class="card-content">
                            <img src="../../assets/img/dashboard/residents.png" class="img-fluid" style="width: 80px" alt="residents">
                        </div>
                        <div class="card-title d-flex justify-content-between align-items-center" style="gap: 10px">
                            <h5>Total Residents:</h5>
                            <h3>0</h5>
                        </div>
                    </div>
                </div>

                 <!--Female Card-->
                 <div class="card" style="max-width: 350px; width: 350px;">
                    <div class="card-body d-flex justify-content-between align-items-center flex-column">
                        <div class="card-content">
                            <img src="../../assets/img/dashboard/female.png" class="img-fluid" style="width: 80px" alt="female">
                        </div>
                        <div class="card-title d-flex justify-content-between align-items-center" style="gap: 10px">
                            <h5>Total Female:</h5>
                            <h3>0</h5>
                        </div>
                    </div>
                </div>

                 <!--Male Card-->
                 <div class="card" style="max-width: 350px; width: 350px;">
                    <div class="card-body d-flex justify-content-between align-items-center flex-column">
                        <div class="card-content">
                            <img src="../../assets/img/dashboard/male.png" class="img-fluid" style="width: 80px" alt="male">
                        </div>
                        <div class="card-title d-flex justify-content-between align-items-center" style="gap: 10px">
                            <h5>Total Male:</h5>
                            <h3>0</h5>
                        </div>
                    </div>
                </div>

                 <!--Voters Card-->
                 <div class="card" style="max-width: 350px; width: 350px;">
                    <div class="card-body d-flex justify-content-between align-items-center flex-column">
                        <div class="card-content">
                            <img src="../../assets/img/dashboard/voters.png" class="img-fluid" style="width: 80px" alt="residents">
                        </div>
                        <div class="card-title d-flex justify-content-between align-items-center" style="gap: 10px">
                            <h5>Total Voters:</h5>
                            <h3>0</h5>
                        </div>
                    </div>
                </div>

                 <!--Household Card-->
                 <div class="card p-3" style="max-width: 350px; width: 350px;">
                    <div class="card-body d-flex justify-content-between align-items-center flex-column">
                        <div class="card-content">
                            <img src="../../assets/img/dashboard/home.png" class="img-fluid" style="width: 80px" alt="household">
                        </div>
                        <div class="card-title d-flex justify-content-between align-items-center" style="gap: 10px">
                            <h5>Total Household:</h5>
                            <h3>0</h5>
                        </div>
                    </div>
                </div>

              
            </div>

            <div class="container-fluid">
                  <!-- Age Distribution Chart -->
                  <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Age Distribution Of Barangay Residents</h5>
                        <canvas id="ageDistributionChart" class="img-fluid"  style="width: 100%; max-height: 500px;"></canvas>
                    </div>
                </div>

            </div>

          
              
        </div>
        
    </div>
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   
    <script src="../components/sidebar.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('ageDistributionChart').getContext('2d');
            var ageDistributionChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['0-10', '11-20', '21-30', '31-40', '41-50', '51-60', '61-70', '71-80', '81+'],
                    datasets: [{
                        label: 'Age Distribution',
                        data: [12, 19, 3, 5, 2, 3, 7, 8, 4], // Example data
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    

   
</body>
</html>