<?php
session_start();
if(isset($_SESSION['admin'])) {
    header('Location: main.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="shortcut icon" href="../../assets/img/logo-125.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="login-page d-flex justify-content-center align-items-center p-3" style="min-height: 100vh; min-width: 100%; background-color: #2D3187;">
        <div class="card p-4" style="width: 40rem;">
            <div class="card-title d-flex justify-content-center align-items-center" style="gap: 5px;">
                    <img src="../../assets/img/logo-125.png" class="img-fluid" style="width: 100px;" alt="">
                <div class="card-logo">
                    <h2>Login</h2>
                    <label>"Barangay Sinbanali, City of Bacoor"</label>
                </div>

            </div>
            <div class="card-body">
                <form action="../../controllers/adminLoginController.php" method = "POST">

                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" placeholder="Enter username" class="form-control" name = "username" required>
                    </div>

                    <div class="form-group mt-3">
                        <label>Password:</label>
                        <input type="text" placeholder="Enter password" class="form-control" name = "password" required>
                    </div>
                    
                    <div class="form-group mt-3">
                        <a href="#">Forgot your password?</a>
                    </div>

                    <div class="form-group mt-3">
                        <input type="submit" value="Login" class="btn btn-primary w-100">
                    </div>

                </form>
            </div>
        </div>
    </div>

    
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./components/sidebar.js" defer></script>
  <script>
    if(window.location.search.includes('error=1')) {
        alert('Invalid username or password');
    }
  </script>
</body>
</html>