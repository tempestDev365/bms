<?php
session_start();
include_once "../../database/databaseConnection.php";
if(!isset($_SESSION['admin'])) {
    header('Location: adminLogin.php');
}
function getAllAnnouncement(){
    $conn = $GLOBALS['conn'];
    $qry = "SELECT * FROM announcement_tbl ORDER BY id ASC";
    $result = $conn->prepare($qry);
    $result->execute();
    $announcement = $result->fetchAll(PDO::FETCH_ASSOC);
    return $announcement;
}

$announcements = getAllAnnouncement();

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

        <div class="admin-content flex-grow-1 p-4 bg-light" style="max-height: 100vh; overflow-y: scroll;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">BMS</li>
                  <li class="breadcrumb-item"><a href="./announcement.html" class="text-dark">Announcement</a></li>
                </ol>
            </nav>

            <div class="container-fluid border shadow-sm py-3 px-3 bg-white rounded-3">

                <div class="h2">Announcement</div>
                
                <form action="../../controllers/postAnnouncementController.php" method = "POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="titleAnnouncement" class="h5">Title:</label>
                        <textarea name="titleAnnouncement" id="titleAnnouncement" class="form-control" placeholder="Enter title..." required ></textarea>
                    </div>

                    <div class="form-group mt-3">
                        <label for="upload-img">Upload Image</label>
                        <input type="file" class="form-control" name="upload-img" accept=".jpg, .jpeg, .png" onchange="previewImage(event)">
                        <img id="img-preview" src="#" alt="Image Preview" style="display: none; max-width: 100%; margin-top: 10px;">
                    </div>

                    <div class="form-group mt-3">
                        <label for="contentAnnouncement" class="h5">Content:</label>
                        <textarea class="form-control" id="announcement" placeholder="Enter announcement..." style="min-height: 300px;" name = "content" required></textarea>
                    </div>

                    <button class="btn btn-primary btn mt-3">Post</button>
                </form>
            </div>

            <div class="container-fluid mt-3 shadow-sm py-3 px-3 bg-white rounded-3 border">
                <div class="h2">Preview</div>
                <div class="announcements-container">
                    <?php foreach(array_reverse($announcements) as $announcement): // Reverse the array to display the latest first ?>
                        <div class="card mt-2">
                            <div class="card-header h5">
                                <?php echo $announcement['title']; ?>
                            </div>
                            <div class="card-body">
                                <div class="card-content d-flex flex-column">
                                    <?php echo $announcement['content']; ?>
                                    <?php if (!empty($announcement['image'])): ?>
                                        <img src="data:image/jpeg;base64, <?php echo $announcement['image']; ?>" alt="">
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Comments Section -->
                              
                            </div>
                            
                            <div class="card-footer">
                                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editBtn" id="edit" name="<?php echo $announcement['id']; ?>">Edit</button>
                                <button class="btn btn-danger btn-sm" id="delete" name="<?php echo $announcement['id']; ?>">Delete</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!--editBtn modal-->

    <div class="modal" id="editBtn">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Announcement</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST" id = "editForm">
                <div class="modal-body">
                    <div class="announcement-title">
                        <label for="title">New Title:</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                        <div class="announcement-content">
                            <label for="content">New Content:</label>
                            <textarea class="form-control" id="content" name="content" required></textarea>
                        </div>
                        
                        <div class="announcement-save mt-3 d-flex justify-content-end">
                           <button class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   

    <script src="../components/sidebar.js?v=<?php echo time(); ?>" defer></script>
    <script>
        const deleteBtn = document.querySelectorAll('#delete'); 
        
        //delete function for announcements
        deleteBtn.forEach(btn =>{
            btn.addEventListener('click', async (e) => {
            try {
                const id = e.target.name
                const resposne = await fetch(`../../controllers/editDeleteAnnouncementController.php?id=${id}&action=delete`)
                location.reload()
            }catch(error){
                console.log(error)
            }
            })
        })
        const edit =document.querySelectorAll('#edit')
        edit.forEach(btn => {
                btn.addEventListener('click', async (e) => {
                const id = e.target.name
            const form =  document.querySelector('#editForm').action = `../../controllers/editDeleteAnnouncementController.php?id=${id}&action=edit`
            form.submit()  
                })
        })

        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('img-preview');
            const file = input.files[0];
            const validImageTypes = ['image/jpeg', 'image/png'];

            if (file && validImageTypes.includes(file.type)) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
                alert('Please upload a valid image file (JPG or PNG).');
            }
        }
    </script>
</body>
</html>