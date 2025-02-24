<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONFIRM OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<style>


    .otp-box {
        text-align: center;
    }
    @media (max-width: 465px) {

        .pin-group {
            padding: 1rem;
        }

        .otp-box {
          width: 40px;
          height: 40px;
    }
    }
</style>
<body>

    <main style="background-color: #2D3187; min-height: 100vh;" class="d-flex justify-content-center align-items-center p-3">
        <div class="card p-3 otp-card" style="max-width: 600px; min-height: 600px; width: 600px;">
            <div class="card-title">
                <h2>Enter One-Time Password</h2>
                <label for="">Please check your inbox message</label>
            </div>

            <div class="card-pin d-flex flex-column justify-content-center align-items-center" style="flex-grow: 1;">
                <div class="">
                    <h5>Enter OTP</h5>
                    <div class="pin-group d-flex justify-content-between align-items-center" style="gap: 5px;">
                        <form action="../../controllers/verifyOtp.php" method="post">
                            <input class="otp-box fw-bold" type="text" maxlength="1" style="max-width: 60px; max-height: 60px; height: 60px;" name="first" id="">
                            <input class="otp-box fw-bold" type="text" maxlength="1" style="max-width: 60px; max-height: 60px; height: 60px;" name="second" id="">
                            <input class="otp-box fw-bold" type="text" maxlength="1" style="max-width: 60px; max-height: 60px; height: 60px;" name="third" id="">
                            <input class="otp-box fw-bold" type="text" maxlength="1" style="max-width: 60px; max-height: 60px; height: 60px;" name="fourth" id="">
                            <input class="otp-box fw-bold" type="text" maxlength="1" style="max-width: 60px; max-height: 60px; height: 60px;" name="fifth" id="">
                            <input class="otp-box fw-bold" type="text" maxlength="1" style="max-width: 60px; max-height: 60px; height: 60px;" name="sixth" id="">
                    </div>
                      <div class="card-btn mt-3">
                <button id="clear" class="btn btn-primary w-100 p-3" style="border-radius: 20px;">CONFIRM</button>
            </div>
                </form>
                    <div class="resend-code d-flex justify-content-between align-items-center mt-1">
                        <label for="">Didn't get a code ? <a href="../../controllers/resendOtp.php?action=resend">Resend</a></label>
                        <button id="clearBtn" class="btn">Clear</button>
                    </div>
                </div>
            </div>
            
          

            
        </div>
    </main>

    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        let clearBtn = document.getElementById('clearBtn');

        clearBtn.addEventListener('click', () => {
            let inputs = document.querySelectorAll('.pin-group input');
            inputs.forEach(input => {
                input.value = '';
            });
        });
        const params = new URLSearchParams(window.location.search);
        const error = params.get('error');
        if(error){
            alert("OTP is incorrect");
        }
    </script>
</body>
</html>