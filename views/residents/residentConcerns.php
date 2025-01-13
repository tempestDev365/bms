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
    <title>Concerns</title>
    <link rel="shortcut icon" href="../../assets/img/logo-125.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
      @media (min-width: 701px) {
        .navbar-toggler {
            display: none !important;   
        }
    }

    @media (max-width: 700px) {

    .resident-sidebar {
        display: none !important;
    }

    .navbar-toggler {
        display: block !important;
        }
    }
</style>
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
                        <li class="breadcrumb-item"><a href="./residentConcerns.php">Concerns</a></li>
                    </ol>
                </nav>

                <button class="navbar-toggler navbar-light bg-light"
                        type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#mobile-sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="container-fluid p-3">
                <h2>Concerns</h2>

                <div class="concerns-container p-3 border bg-white rounded-3 shadow-sm" style="gap: 5px;">
                    <form action="">
                        <div class="form-group">
                            <label for="concern">Concern Title</label>
                            <input type="text" name="concern" placeholder="Enter your title..." id="concern" class="form-control"  required></input>
                        </div>
                        <div class="form-group mt-3">
                            <label>Message</label>
                            <textarea name="message" id="message" class="form-control" placeholder="Enter your message..." required></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </form>
                </div>

                <div class="concerns-display mt-3 p-3 border bg-white rounded-3 shadow-sm">
                    <div class="concern-reply border p-2">
                        <h5>Concern Title</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium delectus quibusdam recusandae. Nihil soluta, deleniti aliquam aperiam cumque adipisci, ea reprehenderit quaerat, necessitatibus error temporibus! Ex culpa dolorem eligendi quas.</p>

                        <div class="reply">
                            <h6>Reply</h6>
                            <p>Reply Message</p>
                        </div>
                    </div>
                </div>

            </div>

       

        </main>
    </div>

    <!--Offcanvas sidebar-->
    <div class="offcanvas offcanvas-end" id="mobile-sidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Brgy.Sinbanali</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="./userResident.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./userAnnouncement.php">Announcement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./userDocument.php">Document Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./userNotification.php">Notification</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./userResidentLogout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        
    </div>

    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../components/residentSidebar.js?v=<?php echo time(); ?>" defer></script>
</body>
</html>