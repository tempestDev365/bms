<?php
session_start();
if(!isset($_SESSION['admin'])) {
    header('Location: adminLogin.php');
}
function getAllConcerns(){
    include_once "../../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    $sql = "SELECT c.*, r.first_name, r.last_name, r.middle_name 
    FROM concerns_tbl c
    JOIN residents_tbl r ON c.resident_id = r.id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
$allConcerns = getAllConcerns();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brgy. Sinbanali</title>
    <link rel="shortcut icon" href="../../assets/img/logo-125.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">
    <style>
        table th, table td {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="main-container d-flex" style="min-height: 100vh; min-width: 100%">
        <div class="admin-sidebar">
           
        </div>

        <div class="admin-content flex-grow-1 p-4 bg-light" style="max-height: 100vh; overflow-y: scroll">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">BMS</li>
                  <li class="breadcrumb-item"><a href="./concerns.php" class="text-dark">Concerns</a></li>
                </ol>
              </nav>
              

            <div class="container-fluid p-3 shadow-sm border rounded bg-white">
                <h1 class="mb-3 text-center">Resident Concerns</h1>

                <table class="table table-striped table-bordered mt-3" id="example">
                    <thead>
                        <tr>
                            <th>Concern ID</th>
                            <th>Resident Name</th>
                            <th>Concern</th>
                             <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php foreach($allConcerns as $concern): ?>
                        <tr>
                            <td><?= $concern['id'] ?></td>
                            <td><?= $concern['first_name'] . ' ' . $concern['middle_name'] . ' ' . $concern['last_name'] ?></td>
                            <td><?= $concern['concern_message'] ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewConcern" onclick="viewConcern(<?= $concern['id'] ?>)" id ="viewBtn ">View</button>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

        </div>
        
    </div>


    <!--concern modal-->
    <div class="modal" id="viewConcern">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Resident Concern</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h5 class="title">THIS IS A TITLE</h5>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ratione iusto officia aliquid, amet, eligendi delectus voluptates doloribus distinctio facilis esse reprehenderit vitae adipisci vel id molestias maiores earum architecto quos!</p>
                    
                    <form action="../../controllers/addReplyToConcernController.php" method = "POST" id ="reply-form">
                        <input type="hidden" name = "concern_id" id = "concern_id">
                        <textarea name="reply" placeholder="Reply..." class="form-control" id=""></textarea>
                        <button class="btn btn-primary btn-sm mt-2">Send</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    




<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
<script src="../components/sidebar.js?v=<?php echo time(); ?>" defer></script>
<script>
    $(document).ready(function() {
        $('#genderFilter').on('change', function() {
            var filterValue = $(this).val();
            var table = $('#example').DataTable();
            table.column(2).search(filterValue === 'all' ? '' : filterValue, true, false).draw();
        });
    });

    async function viewConcern(id) {
        const response = await fetch(`../../controllers/concernOptionsController.php?action=view&id=${id}`);
        const data = await response.json();
        document.querySelector('.title').textContent = data.concern_title;
        document.querySelector('.modal-body p').textContent = data.concern_message;
        document.querySelector('#concern_id').value = data.concern_id;
    }
</script>
</body>
</html>