<?php
session_start();
if(!isset($_SESSION['admin'])) {
    header('Location: adminLogin.php');
}
function getAllBlotter(){
include_once "../../database/databaseConnection.php";
   $conn = $GLOBALS['conn'];
   $qry = "SELECT * FROM blotter_tbl";
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
                <h2>Blotter Record</h2>
                <table class="table table-bordered mt-3" id="example">
                    <thead>
                        <tr>
                            <th>TRN</th>
                            <th>Complainant</th>
                            <th>Witness1</th>
                            <th>Witness2</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          foreach($blotter as $row){
                            echo"<tr>";
                            echo"<td>".$row['id']."</td>";
                            echo"<td>".$row['narrator_complaint']."</td>";
                            echo"<td>".$row['first_witness']."</td>";
                            echo"<td>".$row['second_witness']."</td>";
                            echo"<td><button class='btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#viewDetail' id = 'viewBtn' onclick='viewDetail(".$row['id'].")'>View</button>
                                     <button class='btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#editDetail' onClick = 'editBlotter(".$row['id'].")'>Edit</button>
                                    <button class='btn btn-sm btn-danger' data-bs-toggle='modal' onClick= 'deleteBlotter(".$row['id'].")'>Delete</button>
                                </td>";
                            echo"</tr>";

                          }
                        ?>
                    </tbody>
                    
                </table>

                <div class="add-btn d-flex justify-content-end">
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createReport">Create Report</button>
                </div>
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
                          <p>Barangay: Sinbanali</p>
    <p>Purok: <input type="text" name="purok" id="purok" value="1" class="form-control" required></p>
    <p>Place of the Incident: <input type="text" name="incidentPlace" id="incidentPlace" class="form-control" required></p>
    <p>Date & Time: <input type="datetime-local" name="date" id="date" class="form-control" required></p>
    <p>Complainant: <input type="text" name="complainant" id="complainant" class="form-control" required></p>
    <p>Witness 1: <input type="text" name="first_witness" id="first_witness" class="form-control"></p>
    <p>Witness 2: <input type="text" name="second_witness" id="second_witness" class="form-control"></p>
    <p>Narrative: <textarea name="narrative" id="narrative" class="form-control" required></textarea></p>
    <div class="d-flex justify-content-end">
        <button class="btn btn-success btn-sm" type="submit">Save</button>
    </div>
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
                                <label>BARANGAY</label>
                                <input type="text" disabled class="form-control" value="Sinbanali" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>INCIDENT</label>
                                <input type="text" name = "incident" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>PLACE OF THE INCIDENT</label>
                                <input type="text" name = "place" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>DATE & TIME</label>
                                <input type="datetime-local" name = "date" id = "date_selected" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>NARRATOR / COMPLAINANT</label>
                                <input type="text" name = "complainant" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>WITNESS 1</label>
                                <input type="text" name = "first_witness" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>WITNESS 2</label>
                                <input type="text" name = "second_witness" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>NARRATIVE</label>
                                <textarea name="narrative" id="narrative" class="form-control"></textarea>
                            </div>

                            <div class="form-group mt-2 d-flex justify-content-end">
                                <button class="btn btn-sm btn-success">CREATE</button>
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

    const date = document.querySelector('#date_selected');
    date.addEventListener('input', (e) => {
        const currentDate = new Date();
        const selectedDate = new Date(e.target.value);
        if (selectedDate > currentDate) {
            alert('Invalid Date');
            e.target.value = '';
        }
    });

    const viewDetail = async (id) => {
        const api = await fetch(`../../controllers/blotterOptionsController.php?id=${id}&action=view`);
        const data = await api.json();
        document.querySelector("#incidentPlace").textContent = data.place;
        document.querySelector("#complainant").textContent = data.complainant;
        document.querySelector("#first_witness").textContent = data.first_witness;
        document.querySelector("#second_witness").textContent = data.second_witness;
        document.querySelector("#date").textContent = data.date;
        document.querySelector("#narrative").textContent = data.narrative;
    }

    const deleteBlotter = async (id) => {
        const api = await fetch(`../../controllers/blotterOptionsController.php?id=${id}&action=delete`);
        location.reload();
    }

    const editBlotter = async (id) => {
        const form = document.querySelector('#editBlotter');
        form.action = `../../controllers/blotterOptionsController.php?id=${id}&action=edit`;
    }
    </script>

</body>
</html>