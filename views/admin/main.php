<?php
session_start();
if(!isset($_SESSION['admin'])) {
    header('Location: adminLogin.php');
}
function getAllDemographic(){
    include '../../database/databaseConnection.php';
    $resident_count_qry = "SELECT COUNT(*) as resident_count FROM residents_information";
    $stmt = $conn->prepare($resident_count_qry);
    $stmt->execute();
    $resident_count = $stmt->fetch();
    $female_count_qry = "SELECT COUNT('sex') as female_count FROM residents_information WHERE sex = 'Female'";
    $stmt = $conn->prepare($female_count_qry);
    $stmt->execute();
    $female_count = $stmt->fetch();
    $male_count_qry = "SELECT COUNT('sex') as male_count FROM residents_information WHERE sex = 'Male'";
    $stmt = $conn->prepare($male_count_qry);
    $stmt->execute();
    $male_count = $stmt->fetch();
    $voter_count_qry = "SELECT COUNT('voter_status') as voter_count FROM residents_personal_information WHERE registered_voter = 'Yes'";
    $stmt = $conn->prepare($voter_count_qry);
    $stmt->execute();
    $voter_count = $stmt->fetch();
    $household_count_qry = "SELECT COUNT(DISTINCT 'house_number') as household_count FROM residents_information";
    $stmt = $conn->prepare($household_count_qry);
    $stmt->execute();
    $household_count = $stmt->fetch();
    $age_count_qry = "
        SELECT 
            CASE 
                WHEN age BETWEEN 0 AND 10 THEN '0-10'
                WHEN age BETWEEN 11 AND 20 THEN '11-20'
                WHEN age BETWEEN 21 AND 30 THEN '21-30'
                WHEN age BETWEEN 31 AND 40 THEN '31-40'
                WHEN age BETWEEN 41 AND 50 THEN '41-50'
                WHEN age BETWEEN 51 AND 60 THEN '51-60'
                WHEN age BETWEEN 61 AND 70 THEN '61-70'
                WHEN age BETWEEN 71 AND 80 THEN '71-80'
                ELSE '81+' 
            END as age_range, 
            COUNT(*) as count 
        FROM residents_information 
        GROUP BY age_range
        ORDER BY age_range
    ";
    $stmt = $conn->prepare($age_count_qry);
    $stmt->execute();
    $age_counts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $revenue_count_qry = "SELECT SUM(amount) as revenue_count FROM revenue_tbl";
    $stmt = $conn->prepare($revenue_count_qry);
    $stmt->execute();
    $revenue_count = $stmt->fetch();

    return [
        'resident_count' => $resident_count['resident_count'],
        'female_count' => $female_count['female_count'],
        'male_count' => $male_count['male_count'],
        'voter_count' => $voter_count['voter_count'],
        'household_count' => $household_count['household_count'],
        'age_counts' => $age_counts,
        'revenue_count' => $revenue_count['revenue_count'],
    ];


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
                            <h5>Total male:</h5>
                            <h3><?php echo $demographic['male_count'] ?></h5>
                        </div>
                    </div>
                </div>
                 </a>

                 <!--Voters Card-->
               <a href="./residents.php?filter=voter">
                    <div class="card" style="max-width: 350px; width: 350px;">
                    <div class="card-body d-flex justify-content-between align-items-center flex-column">
                        <div class="card-content">
                            <img src="../../assets/img/dashboard/voters.png" class="img-fluid" style="width: 80px" alt="male">
                        </div>
                        <div class="card-title d-flex justify-content-between align-items-center" style="gap: 10px">
                            <h5>Total Voter:</h5>
                            <h3><?php echo $demographic['voter_count'] ?></h5>
                        </div>
                    </div>
                </div>
                 </a>
                 </a>

                 

                 <!--Household Card-->
               
                 <a href="./household.php">
                    <div class="card" style="max-width: 350px; width: 350px;">
                    <div class="card-body d-flex justify-content-between align-items-center flex-column">
                        <div class="card-content">
                            <img src="../../assets/img/dashboard/home.png" class="img-fluid" style="width: 80px" alt="residents">
                        </div>
                        <div class="card-title d-flex justify-content-between align-items-center" style="gap: 10px">
                            <h5>Total household:</h5>
                            <h3><?php echo $demographic['household_count'] ?></h5>
                        </div>
                    </div>
                </div>
                </a>
                 

               <!--Resident Card-->
                    <div class="card" style="max-width: 350px; width: 350px;">
                        <div class="card-body d-flex justify-content-between align-items-center flex-column">
                            <div class="card-content">
                                <img src="../../assets/img/salary.png" class="img-fluid" style="width: 80px" alt="residents">
                            </div>
                            <div class="card-title d-flex justify-content-between align-items-center" style="gap: 10px">
                                <h5>Total Revenue:</h5>
                                <h3><?php echo $demographic['revenue_count'] ?></h3>
                            </div>
                        </div>
                    </div>
                </a>

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
        var ageCounts = <?php echo json_encode($demographic['age_counts']); ?>;
        var labels = ageCounts.map(function(item) { return item.age_range; });
        var data = ageCounts.map(function(item) { return item.count; });
        console.log(labels)

        var ageDistributionChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Age Distribution',
                    data: data,
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