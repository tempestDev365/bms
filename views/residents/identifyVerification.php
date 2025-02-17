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

                    <label for="">Please upload barangay ID / valid ID</label>

                    <div class="upper-card-img  ">
                       <div class="img-group d-flex justify-content-center align-items-center">
                            <div class="card-img">
                                <img src="../../assets/img/good-id.png" alt="good" class="img-fluid">       
                            </div>

                            <div class="card-img">
                                <img src="../../assets/img/bad-img1.png" alt="bad-img1.png" class="img-fluid">       
                            </div>

                            <div class="card-img">
                                <img src="../../assets/img/bad-img2.png" alt="bad-img2.png" class="img-fluid">       
                            </div>
                            
                            
                       </div>
                       <div class="img-label d-flex justify-content-around align-items-center">
                            <label for="">Good</label>
                            <label for="">Bad</label>
                            <label for="">Bad</label>
                       </div>
                    </div>

                    <div class="middle-card  mt-3 d-flex flex-column">
                        <p>Make sure your ID is</p>
                        <label>Valid</label>
                        <label>Readable</label>
                        <label>Original full-sized. Unedited Document</label>
                        <label>No black and white images</label>
                    </div>

                    <div class="bottom-card  mt-3">
                        <form action="" class="d-flex justify-content-center align-items-center" style="gap: 5px;">
                            <div class="form-group" style="flex-grow: 1;">
                                <input type="file" name="frontID" hidden id="frontID">
                                <label class="d-flex justify-content-center align-items-center" for="frontID" style="width: 100%; border: 1px dotted black; height: 200px; cursor: pointer;">Upload Front</label>
                            </div>

                            <div class="form-group" style="flex-grow: 1;">
                                <input type="file" name="backID" hidden id="frontID">
                                <label class="d-flex justify-content-center align-items-center" for="backID" style="width: 100%; border: 1px dotted black; height: 200px; cursor: pointer;">Upload Back</label>
                            </div>

                        </form>

                        <button class="btn btn-primary w-100 mt-3 p-3" style="border-radius: 20px;">NEXT</button>
                     
                    </div>




                </div>
            </div>
            
        </div>
    </main>

    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>