<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lets Get Started</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <main style="background-color: #2D3187; min-height: 100vh;" class="d-flex justify-content-center align-items-center p-2">
        <div class="card p-3" style="min-width: 600px; min-height: 600px; width: 600px;">
            <div class="card-title">
                <h2>IDENTITY VERIFICATION!</h2>
            </div>
            <div class="card-body">
                <div class="upper-card">
                    <label for="">Please upload proof of living.</label>
                </div>

                    <div class="middle-cards  mt-3">
                        <form action="" class="d-flex justify-content-center align-items-center" style="gap: 5px;">
                            <div class="form-group" style="flex-grow: 1;">
                                <input type="file" name="frontID" hidden id="frontID">
                                <label class="d-flex justify-content-center align-items-center" for="frontID" style="width: 100%; border: 1px dotted black; height: 200px; cursor: pointer;"></label>
                            </div>
                        </form>

                        <div class="note mt-2">
                            <label for="">Take Note: This is optional if your ID is not addressed  in this barangay. Please provide proof of living if possible.</label>
                        </div>

                        <button class="btn btn-primary w-100 mt-5 p-3" style="border-radius: 20px;">NEXT</button>
                     
                    </div>




                </div>
            </div>
            
        </div>
    </main>

    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>