<?php
session_start();
if(!isset($_SESSION['admin'])) {
    header('Location: adminLogin.php');
}
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

    <div class="main-container d-flex" style="min-height: 100vh; min-width: 100%;">
        <div class="admin-sidebar">
           
        </div>

        <div class="admin-content flex-grow-1 p-4 bg-light">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">BMS</li>
                  <li class="breadcrumb-item"><a href="./announcement.html" class="text-dark">Announcement</a></li>
                </ol>
            </nav>

            <div class="container-fluid border shadow-sm py-3 px-3 bg-white rounded-3">

                <div class="h2">Announcement</div>
                
                <form action="../../controllers/postAnnouncementController.php" method = "POST">
                    <div class="form-group">
                        <label for="titleAnnouncement" class="h5">Title:</label>
                        <textarea name="titleAnnouncement" id="titleAnnouncement" class="form-control" placeholder="Enter title..." required ></textarea>
                    </div>

                    <div class="form-group mt-3">
                        <label for="contentAnnouncement" class="h5">Content:</label>
                        <textarea class="form-control" id="announcement" placeholder="Enter announcement..." style="min-height: 300px;" name = "content" required></textarea>
                    </div>

                    <button class="btn btn-primary btn mt-3">Post</button>
                </form>
            </div>

            <div class="container-fluid border mt-3 d-flex flex-column shadow-sm py-3 px-3 bg-white rounded-3" style="gap: 5px;">
                <div class="h2">Preview</div>

                <!--comments container-->
                <div class="card mt-2">
                    <div class="card-header h5">
                        test
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis maiores nesciunt soluta, ipsam ullam obcaecati dolores impedit voluptates! Culpa iure unde distinctio dolor tempore quasi aut repudiandae eius libero quia!
                        </div>

                        <div class="card-comments mt-3">
                            <label class="fw-bold">Comments:</label>
                            
                            <div class="comments mt-2" style="font-size: 0.8rem;">
                                <div class="username">
                                    - John Doe
                                </div>
                                <div class="user-messages">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum qui, corporis assumenda facilis nemo tenetur dolorum dolores, magni autem odit similique incidunt. Fugit recusandae expedita voluptatum voluptas earum! Doloribus, reiciendis?
                                </div>
                            </div>

                            <div class="comments mt-2" style="font-size: 0.8rem;">
                                <div class="username">
                                    - Eren Yeager
                                </div>
                                <div class="user-messages">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum qui, corporis assumenda facilis nemo tenetur dolorum dolores, magni autem odit similique incidunt. Fugit recusandae expedita voluptatum voluptas earum! Doloribus, reiciendis?
                                </div>
                            </div>
                          
                           
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-secondary btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header h5">
                        test 2
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis maiores nesciunt soluta, ipsam ullam obcaecati dolores impedit voluptates! Culpa iure unde distinctio dolor tempore quasi aut repudiandae eius libero quia!
                        </div>

                        <div class="card-comments mt-3">
                            <label class="fw-bold">Comments:</label>
                            
                            <div class="comments mt-2" style="font-size: 0.8rem;">
                                <div class="username">
                                    - John Doe
                                </div>
                                <div class="user-messages">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum qui, corporis assumenda facilis nemo tenetur dolorum dolores, magni autem odit similique incidunt. Fugit recusandae expedita voluptatum voluptas earum! Doloribus, reiciendis?
                                </div>
                            </div>

                            <div class="comments mt-2" style="font-size: 0.8rem;">
                                <div class="username">
                                    - Eren Yeager
                                </div>
                                <div class="user-messages">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum qui, corporis assumenda facilis nemo tenetur dolorum dolores, magni autem odit similique incidunt. Fugit recusandae expedita voluptatum voluptas earum! Doloribus, reiciendis?
                                </div>
                            </div>
                          
                           
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-secondary btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </div>
                </div>

                <!--/comments container-->

            </div>
              
        </div>
        
    </div>
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../components/sidebar.js" defer></script>

</body>
</html>