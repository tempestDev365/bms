<?php
session_start();
if(!isset($_SESSION['resident_id'])) {
    header('Location: ./residentLogin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Request</title>
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
                        <li class="breadcrumb-item"><a href="./userResident.php">Document Request</a></li>
                    </ol>
                </nav>

                <button class="navbar-toggler navbar-light bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="container-fluid">
                <h2>Document Request</h2>

                <div class="container-fluid p-3 rounded-3 bg-white shadow-sm border">
                    <form action="">
                        <div class="form-group">
                            <label>SELECT TYPE OF DOCUMENT</label>
                            <select name="selectDocument" id="selectDocument" class="form-control">
                                <option value="value">Barangay Certificate</option>
                                <option value="value">Barangay Indigency</option>
                                <option value="value">Barangay Clearance</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label>PURPOSE OF REQUEST</label>
                            <textarea name="purpose" id="purpose" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="form-group d-flex justify-content-end">
                            <input type="submit" value="Submit Request" class="btn btn-primary btn-sm mt-3">
                        </div>
                    </form>
                </div>

                <div class="container-fluid p-3 rounded-3 bg-white mt-3 shadow-sm border">
                    <label>REQUEST TRACKER</label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tracking Number(TRN)</th>
                                <th>Document Type</th>
                                <th>Date Of Request</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    0231
                                </td>
                                <td>
                                    Barangay Certificate
                                </td>
                                <td>
                                    07/01/2021
                                </td>
                                <td>
                                    <span class="badge bg-success">Approved</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    2321
                                </td>
                                <td>
                                    Barangay Indigency
                                </td>
                                <td>
                                    07/01/2021
                                </td>
                                <td>
                                    <span class="badge bg-danger">Rejected</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

       

        </main>
    </div>


    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../components/residentSidebar.js?v=<?php echo time(); ?>" defer></script>
</body>
</html>