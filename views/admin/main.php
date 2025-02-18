<?php
session_start();
if(!isset($_SESSION['admin'])) {
    header('Location: adminLogin.php');
}
function getAllDemographic(){
    include '../../database/databaseConnection.php';
    $resident_count_qry = "SELECT COUNT(*) as resident_count FROM residents_information";
    $stmt = $conn->prepare($qry);
    $stmt->execute();
    $resident_count = $stmt->fetch();
    $female_count_qry = "SELECT COUNT('sex') as female_count FROM residents_information WHERE sex = `Female`";
    $stmt = $conn->prepare($qry);
    $stmt->execute();
    $female_count = $stmt->fetch();
    $male_count_qry = "SELECT COUNT('sex') as male_count FROM residents_information WHERE sex = `Male`";



}
$demographic = getAllDemographic();
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

        <div class="admin-content flex-grow-1 p-4 bg-light" style="max-height: 100vh; overflow-y: scroll">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">BMS</li>
                  <li class="breadcrumb-item"><a href="./main.html" class="text-dark">Dashboard</a></li>
                </ol>
            </nav>

            <div class="container-fluid d-flex justify-content-center align-items-center p-3" style="flex-wrap: wrap; gap: 30px">

                <!--Resident Card-->
                <a href="./residents.php">
                    <div class="card" style="max-width: 350px; width: 350px;">
                        <div class="card-body d-flex justify-content-between align-items-center flex-column">
                            <div class="card-content">
                                <img src="../../assets/img/dashboard/residents.png" class="img-fluid" style="width: 80px" alt="residents">
                            </div>
                            <div class="card-title d-flex justify-content-between align-items-center" style="gap: 10px">
                                <h5>Total Residents:</h5>
                                <h3><?php echo $demographic['resident_count'] ?></h3>
                            </div>
                        </div>
                    </div>
                </a>

                 <!--Female Card-->
                 <a href="./residents.php?filter=female">
                    <div class="card" style="max-width: 350px; width: 350px;">
                    <div class="card-body d-flex justify-content-between align-items-center flex-column">
                        <div class="card-content">
                            <img src="../../assets/img/dashboard/female.png" class="img-fluid" style="width: 80px" alt="female">
                        </div>
                        <div class="card-title d-flex justify-content-between align-items-center" style="gap: 10px">
                            <h5>Total Female:</h5>
                            <h3><?php echo $demographic['female_count'] ?></h5>
                        </div>
                    </div>
                </div>

                 </a>
                 <!--Male Card-->
                 <a href="./residents.php?filter=male">
                    <div class="card" style="max-width: 350px; width: 350px;">
                    <div class="card-body d-flex justify-content-between align-items-center flex-column">
                        <div class="card-content">
                            <img src="../../assets/img/dashboard/male.png" class="img-fluid" style="width: 80px" alt="male">
                        </div>
                        <div class="card-title d-flex justify-content-between align-items-center" style="gap: 10px">
                            <h5>Total Male:</h5>
                            <h3><?php echo $demographic['male_count'] ?></h5>
                        </div>
                    </div>
                </div>
                 </a>

                 <!--Voters Card-->
               
                 </a>

                 

                 <!--Household Card-->
                 <a href="./household.php">
                    <div class="card" style="max-width: 350px; width: 350px;">
                    <div class="card-body d-flex justify-content-between align-items-center flex-column">
                        <div class="card-content">
                            <img src="../../assets/img/dashboard/voters.png" class="img-fluid" style="width: 80px" alt="residents">
                        </div>
                        <div class="card-title d-flex justify-content-between align-items-center" style="gap: 10px">
                            <h5>Total household:</h5>
                            <h3><?php echo $demographic['household_count'] ?></h5>
                        </div>
                    </div>
                </div>
                 </a>

               <!--Resident Card-->
               <a href="./residents.php">
                    <div class="card" style="max-width: 350px; width: 350px;">
                        <div class="card-body d-flex justify-content-between align-items-center flex-column">
                            <div class="card-content">
                                <img src="../../assets/img/salary.png" class="img-fluid" style="width: 80px" alt="residents">
                            </div>
                            <div class="card-title d-flex justify-content-between align-items-center" style="gap: 10px">
                                <h5>Total Revenue:</h5>
                                <h3><?php echo $demographic['resident_count'] ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
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
   
    <script src="../components/sidebar.js?v=<?php echo time(); ?>" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('ageDistributionChart').getContext('2d');
            var ageDistributionChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['0-10', '11-20', '21-30', '31-40', '41-50', '51-60', '61-70', '71-80', '81+'],
                    datasets: [{
                        label: 'Age Distribution',
                        data: [<?=$demographic['age_count']?>], // Example data
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
        let session = <?= json_encode($_SESSION['admin']) ?>;
        console.log(session);
    </script>
    

   
</body>
</html>