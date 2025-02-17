<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lets Get Started</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <main style="background-color: #2D3187;" class="vh-100 d-flex justify-content-center align-items-center p-2">
        <div class="card p-3" style="max-width: 500px; max-height: 500px; width: 500px; height: 500px;">
            <div class="card-title">
                <h2>Let's  Get Started!</h2>
            </div>
            <div class="card-body">
                <form action="">
                    
                    <div class="form-group">
                        <input type="email" placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <input type="text" placeholder="First Name" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <input type="text" placeholder="Middle Name" class="form-control">
                    </div>
                    <div class="form-group mt-2 d-flex justify-content-end">
                        <input type="checkbox"> &nbsp;
                        <label for="">I have no middle name</label>
                    </div>
                    <div class="form-group mt-2 d-flex ">
                        <input type="text" placeholder="Last Name" class="form-control me-2">
                        
                        <select name="suffix" id="suffix">  
                            <option value="Suffix" disabled selected>Suffix</option>
                            <option value="">JR</option>
                            <option value="">SR</option>
                            <option value="">I</option>
                            <option value="">II</option>
                            <option value="">III</option>
                            <option value="">IV</option>
                            <option value="">V</option>
                          </select>
                    </div>

                    <div class="form-group mt-2 d-flex justify-content-between" style="gap: 5px">
                        <select name="suffix" id="suffix" class="form-control">  
                            <option value="Suffix" disabled selected>Sex</option>
                            <option value="">Male</option>
                            <option value="">Female</option>
                          </select>
                        
                          <input type="number" placeholder="Age" class="form-control">

                    </div>
                    <div class="form-group mt-2">
                        <input type="date" class="form-control">
                    </div>

                    <div class="button mt-4">
                        <button class="btn btn-primary w-100 p-3" style="border-radius: 20px;">CONTINUE</button>
                    </div>  
                </form>
            </div>
            
        </div>
    </main>

    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>