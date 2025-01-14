<?php
session_start();
include_once "../../database/databaseConnection.php";
if(!isset($_SESSION['admin'])) {
    header('Location: adminLogin.php');
}
function getAllAnnouncement(){
    $conn = $GLOBALS['conn'];
    $qry = "SELECT * FROM announcement_tbl";
    $result = $conn->prepare($qry);
    $result->execute();
    $announcement = $result->fetchAll(PDO::FETCH_ASSOC);
    return $announcement;
}
function getComments( $announcement_id){
    $conn = $GLOBALS['conn'];
    $qry = "SELECT * FROM comments_tbl WHERE announcement_id = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(1, $announcement_id);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $comments;
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

        <div class="admin-content flex-grow-1 p-4 bg-light" style="max-height: 100vh; overflow-y: scroll">
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
                <?php
                foreach($announcements as $announcement){
                    echo '<div class="card mt-2">
                    <div class="card-header h5">
                        '.$announcement['title'].'
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                           '.$announcement['content'].'
                        </div>
                        <div class="card-footer">
                            <div class="h6">Comments</div>';
                            $comments = getComments($announcement['id']);
                            foreach($comments as $comment){
                                if($comment['announcement_id'] == $announcement['id']){
                                    echo '<div class="card-comment">
                                    '.$comment['comment'].'
                                </div>';
                                }
                            }
                        echo '</div>
                        
                          
                           
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editBtn" id = "edit" name ="'.$announcement['id'].'">Edit</button>
                        <button class="btn btn-danger btn-sm" id = "delete" name ="'.$announcement['id'].'" >Delete</button>
                    </div>
                </div>';
                }
                ?>

           

                <!--/comments container-->

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
  </script>
</body>
</html>