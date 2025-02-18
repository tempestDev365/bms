<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <main style="background-color: #2D3187;" class="vh-100 d-flex justify-content-center align-items-center p-2">
        <div class="card p-3" style="max-width: 500px; max-height: 500px; width: 500px; height: 500px;">
            <div class="card-title">
                <h2>Sign Up</h2>
            </div>
            <div class="card-body mt-5 mb-5">
                <form id="emailForm" action="../../controllers/sendEmailVerification.php" method="POST">
                    <div class="form-group">
                        <label for="email">Please Enter Your Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="button mt-5">
                        <button type="submit" class="btn btn-primary w-100 p-3" style="border-radius: 20px;">VERIFY EMAIL</button>
                    </div>  
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script>
        document.getElementById('emailForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            Swal.fire({
                title: 'Sending Email...',
                text: 'Please wait while we send your verification email.',
                icon: 'info',
                showConfirmButton: false,
                allowOutsideClick: false
            });
            
            // Simulate form submission delay
            setTimeout(() => {
                this.submit();
            }, 2000);
        });
    
        const params = new URLSearchParams(window.location.search);
        const error = params.get('error');
        if (error == 1) {
            Swal.fire({
                title: 'Check your email!',
                text: 'Verify your email through the link we ve send you. Please check your spam folder to ensure the message was not filtered.',
                icon: 'success',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                const url = new URL(window.location);
                url.searchParams.delete('error');
                window.history.replaceState({}, document.title, url);
            });
        }
    </script>
</body>
</html>
