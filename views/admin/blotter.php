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
                        <tr>
                            <td>0001</td>  
                            <td>John Doe</td>
                            <td>Test 1</td>
                            <td>Test 2</td>
                            
                            <td>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#viewDetail">View</button> 
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                    
                </table>

                <div class="add-btn d-flex justify-content-end">
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createReport">Create Report</button>
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
                        <p>Place of the Incident: <span id="incidentPlace">Kanto</span></p>
                        <p>Date & Time: <span>1/10/2025 & 8:00 AM</span></p>
                        <p>Complainant: <span>John Doe</span></p>
                        <p>Witness 1: <span>Test 1</span></p>
                        <p>Witness 2: <span>Test 2</span></p>
                        <p>Narrative: Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab quae ducimus odit quasi quia esse? Saepe suscipit, nesciunt at doloremque possimus quis praesentium rerum? Ipsum aliquam accusamus delectus eaque deserunt!</p>

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
                        <form action="">
                            <div class="form-group">
                                <label>BARANGAY</label>
                                <input type="text" disabled class="form-control" value="Sinbanali" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>INCIDENT</label>
                                <input type="text" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>PLACE OF THE INCIDENT</label>
                                <input type="text" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>DATE & TIME</label>
                                <input type="datetime-local" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>NARRATOR / COMPLAINANT</label>
                                <input type="text" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>WITNESS 1</label>
                                <input type="text" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label>WITNESS 2</label>
                                <input type="text" class="form-control" required>
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
        new DataTable('#example', {
            responsive: true,
            dom: 'Bfrtip', // Added 'f' for search functionality
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
                    },
                    customize: function (doc) {
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        doc.styles.tableHeader.alignment = 'center';
                        doc.styles.tableBodyEven.alignment = 'center';
                        doc.styles.tableBodyOdd.alignment = 'center';
                    }
                },
                // Removed search button
            ]
        });

        $('#genderFilter').on('change', function() {
            var filterValue = $(this).val();
            var table = $('#example').DataTable();
            table.column(2).search(filterValue === 'all' ? '' : filterValue, true, false).draw();
        });
    </script>

</body>
</html>