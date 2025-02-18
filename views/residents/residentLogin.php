<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Login</title>
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
                    <h2>Resident Login</h2>
                    <label>"Barangay Sinbanali, City of Bacoor"</label>
                </div>

            </div>
            <div class="card-body">
                <form action="../../controllers/residentLoginController.php" method="post">

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" placeholder="Enter username" name = "username" class="form-control" required>
                    </div>

                    <!--
                    <div class="form-group mt-3">
                        <label>Password:</label>
                        <input type="password" placeholder="Enter password" name = "password" class="form-control" required>
                    </div>
                    -->
                    <div class="form-group mt-3">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#forgot">Forgot your password?</a>
                    </div>

                    <div class="form-group mt-3">
                        <input type="submit" value="Login" class="btn btn-primary w-100">
                    </div>

                    <div class="form-group mt-3 text-center">
                        <label>Not registered yet? <a href="./registrationInfo.php">Register Here</a></label>
                    </div>

                </form>
            </div>
        </div>
    </div>

    
    <!-- Modal -->
     <div class="modal fade" id="forgot">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Forgot Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                <form action="../../controllers/forgotPasswordController.php" method="post">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
                </div>
            </div>
        </div>
     </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./components/sidebar.js" defer></script>
<script>
    // types of error
    const params = new URLSearchParams(window.location.search); 
    if(params.get('success') == 1){
        alert('Password reset link sent to your email.');
        setInterval(() => {
           params.delete('success');
           history.replaceState(history.state,'', window.location.pathname);
        }, 1000);
    }
   
    if(params.get('error') == 2){
        alert('Your account is still pending.');
        setInterval(() => {
           params.delete('error');
           history.replaceState(history.state,'', window.location.pathname);
        }, 1000);
    }
    if(params.get('error') == 3){
        alert('Your account is rejected. Please contact the admin.');
        setInterval(() => {
           params.delete('error');
           history.replaceState(history.state,'', window.location.pathname);
        }, 1000);
    }
    if(params.get('error') == 4){
        alert('Account does not exist.');
        setInterval(() => {
           params.delete('error');
           history.replaceState(history.state,'', window.location.pathname);
        }, 1000);
    }
    
</script>
</body>
</html>