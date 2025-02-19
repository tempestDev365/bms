<?php
session_start();
if(!isset($_SESSION['admin'])) {
    header('Location: adminLogin.php');
    exit();
}

function getAllBlotter(){
    include_once "../../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    $qry = "SELECT *, (NOW() > DATE_ADD(time, INTERVAL 24 HOUR)) AS is_past_24_hours FROM blotter_tbl";
    $stmt = $conn->prepare($qry);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}
$blotter = getAllBlotter();
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
</head>
<style>
[contenteditable="true"] {
    border-bottom: 1px solid #ccc;
    padding: 2px;
    min-width: 100px;
    display: inline-block;
}

[contenteditable="true"]:focus {
    outline: 1px solid #007bff;
    background: #f8f9fa;
}
</style>
<body>

    <div class="main-container d-flex" style="min-height: 100vh; min-width: 100%;">
        <div class="admin-sidebar">
           
        </div>

        <div class="admin-content flex-grow-1 p-4 bg-light" style="max-height: 100vh; overflow-y: scroll">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">BMS</li>
                  <li class="breadcrumb-item"><a href="./issuedClearance.html" class="text-dark">Blotter Record</a></li>
                </ol>
            </nav>

            <div class="container-fluid bg-white border p-3 shadow-sm rounded-3">
                <h2>Blotter Schedule</h2>
                <table class="table table-bordered mt-3" id="example">
                    <thead>
                        <tr>
                            <th>Time Of Accident</th>
                            <th>Place Of Accident</th>
                            <th>Date Schedule</th>
                            <th>Meeting Time</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          foreach($blotter as $row){
                            echo"<tr style = 'display: ".($row['is_past_24_hours'] ? 'hidden' : '')."'>";
                            echo"<td>".$row['time_of_accident']."</td>";
                            echo"<td>".$row['place_of_accident']."</td>";
                            echo"<td>".$row['date_schedule']."</td>";
                            echo"<td>".$row['meeting_time']."</td>";
                            echo"<td>".$row['description']."</td>";
                            echo"<td>";
                            echo"<button class='btn btn-success btn-sm'>Approve</button>";
                            echo"<button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#rescheduleModal' data-id='".$row['id']."'>Reschedule</button>";
                            echo"</td>";
                            echo"</tr>";
                          }
                        ?>
                    </tbody>
                    
                </table>

               
            </div>
              
        </div>
        
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="editDetail">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid border p-3">
                        <form action="" method = "POST" id = "editBlotter">
                         
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- View Detail Modal -->
    <div class="modal" id="viewDetail">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid border p-3">
                        <p>Barangay: Sinbanali</p>
                        <p>Purok: <span id="purok">1</span></p>
                        <p>Place of the Incident: <span id="incidentPlace"></span></p>
                        <p>Date & Time: <span id="date"></span></p>
                        <p>Complainant: <span id="complainant"></span></p>
                        <p>Witness 1: <span  id="first_witness"></span></p>
                        <p>Witness 2: <span id="second_witness"></span></p>
                        <p>Narrative: <span id="narrative"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Create Report -->
     <div class="modal" id="createReport">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid p-3">
                        <h3>New Cases</h3>
                        <form action="../../controllers/addBlotterController.php" method="POST">
                            <div class="form-group">
                                <label>Time Of Accident</label>
                                <input type="time" class="form-control" name = "time_of_accident"  required>
                            </div>

                            <div class="form-group mt-2">
                                <label>Place Of Incident</label>
                                <input type="text" name = "place_of_accident" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>Select Date Schedule</label>
                                <input type="date" name = "date_schedule" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>Meeting Time</label>
                                <input type="time" name = "meeting_time" id = "date_selected" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>Description</label>
                                <textarea name="description" class="form-control"  required></textarea>    
                            </div>

                           
                            <div class="form-group mt-2 d-flex justify-content-end">
                                <button class="btn btn-sm btn-success">Report</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
     </div>

    <!-- Reschedule Modal -->
    <div class="modal" id="rescheduleModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reschedule Meeting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid p-3">
                        <form action="../../controllers/rescheduleBlotterController.php" method="POST">
                            <input type="hidden" name="blotter_id" id="blotter_id">
                            <div class="form-group">
                                <label>Select New Date</label>
                                <input type="date" name="new_date" class="form-control" required>
                            </div>
                            <div class="form-group mt-2">
                                <label>Select New Time</label>
                                <input type="time" name="new_time" class="form-control" required>
                            </div>
                            <div class="form-group mt-2 d-flex justify-content-end">
                                <button class="btn btn-sm btn-warning">Reschedule</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
        $('#example').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                }
            ]
        });
    });

    $('#genderFilter').on('change', function() {
        var filterValue = $(this).val();
        var table = $('#example').DataTable();
        table.column(2).search(filterValue === 'all' ? '' : filterValue, true, false).draw();
    });

    $('#rescheduleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var blotterId = button.data('id');
        var modal = $(this);
        modal.find('#blotter_id').val(blotterId);
    });

    </script>

</body>
</html>