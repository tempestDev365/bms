<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement</title>
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
                        <li class="breadcrumb-item"><a href="./userResident.php">Announcement</a></li>
                    </ol>
                </nav>

                <button class="navbar-toggler navbar-light bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="container-fluid p-3">
                <h2>Announcements</h2>

                <!--ANNOUNCEMENT DISPLAYED-->
                
                <div class="card mt-3">
                    <div class="card-header">
                        <p>Announcement Title</p>
                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit sed rem laborum asperiores fuga aut corrupti adipisci id dolorem quia aspernatur recusandae, temporibus voluptate, numquam veritatis a nostrum, ad illo? Lorem ipsum dolor sit amet consectetur adipisicing elit. Error a aliquam, consequuntur cumque fugit quis ab, sunt non, facere eligendi optio veritatis accusamus autem! Ex velit corrupti sapiente sequi ipsam?
                    </div>
                    <div class="card-footer" style="overflow-y: scroll; max-height: 300px;">

                        <!--COMMENT DISPLAYED-->
                        <div class="card-group-comment bg-white mt-3 p-3 rounded-3">
                            <div class="card-comments">
                                <label class="text-primary fw-bold">testUser:</label>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit, ad ut? Odio vel numquam nobis? Itaque et, rerum voluptate voluptates quisquam ea labore sed alias. Quia temporibus culpa pariatur natus.</p>
                                
                            </div>
                        </div>

                        <div class="card-group-comment bg-white mt-3 p-3 rounded-3">
                            <div class="card-comments">
                                <label class="text-primary fw-bold">testUser2:</label>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit, ad ut? Odio vel numquam nobis? Itaque et, rerum voluptate voluptates quisquam ea labore sed alias. Quia temporibus culpa pariatur natus.</p>
                                <div class="comment-actions d-flex justify-content-end align-items-center" style="flex-wrap: wrap; gap: 5px;">
                                    <button class="btn-primary btn-sm">Edit</button>
                                    <button class="btn-danger btn-sm">Delete</button>
                                </div>
                            </div>
                        </div>

                        <!--COMMENT INPUT-->

                        <form action="">
                            <div class="card-input-comments mt-3">
                                <textarea name="comment" id="comment" placeholder="Comment as testUser" class="form-control"></textarea>
                            </div>
                            <div class="comment-input-action mt-2 d-flex justify-content-end">
                                <input type="submit" value="Comment" class="btn btn-secondary btn-sm">
                            </div>
                        </form>

                    </div>
                </div>


            </div>

       

        </main>
    </div>


    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../components/residentSidebar.js?v=<?php echo time(); ?>" defer></script>
</body>
</html>