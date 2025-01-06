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

    <div class="main-container d-flex" style="min-height: 100vh; min-width: 100%;">
        <div class="admin-sidebar">
           
        </div>

        <div class="admin-content flex-grow-1 p-4 bg-light">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">BMS</li>
                  <li class="breadcrumb-item"><a href="./issuedClearance.html" class="text-dark">Pending Accounts</a></li>
                </ol>
              </nav>
              

            <div class="container-fluid p-3 shadow-sm border rounded bg-white">
                <h1 class="mb-3 text-center">Pending Accounts</h1>

                <table class="table table-bordered nowrap table-hover mt-3" id="example">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>01</td>
                            <td>Caridad J. Sanchez</td>
                            <td>Male</td>
                            <td>12</td>
                            <td>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#viewProfile">View</button>
                                <button class="btn btn-sm btn-primary">Approve</button>
                                <button class="btn btn-sm btn-danger">Decline</button>

                            </td>
                        </tr>
                        <tr>
                            <td>02</td>
                            <td>Nieves M, Dela Cruz</td>
                            <td>Female</td>
                            <td>12</td>
                            <td>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#viewProfile">View</button>
                                <button class="btn btn-sm btn-primary">Approve</button>
                                <button class="btn btn-sm btn-danger">Decline</button>

                            </td>
                        </tr>
                        <tr>
                            <td>03</td>
                            <td>Ronald F. Marquez</td>
                            <td>Female</td>
                            <td>12</td>
                            <td>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#viewProfile">View</button>
                                <button class="btn btn-sm btn-primary">Approve</button>
                                <button class="btn btn-sm btn-danger">Decline</button>

                            </td>
                        </tr>
                        <tr>
                            <td>04</td>
                            <td>Cesar R. Concepcion</td>
                            <td>Female</td>
                            <td>12</td>
                            <td>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#viewProfile">View</button>
                                <button class="btn btn-sm btn-primary">Approve</button>
                                <button class="btn btn-sm btn-danger">Decline</button>

                            </td>
                        </tr>

                        
                    </tbody>
                </table>
            </div>

        </div>
        
    </div>
    

    <!--MODAL FOR VIEW-->
    <div class="modal" id="viewProfile">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Profile Information</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid d-flex justify-content-evenly align-items-center" style="gap: 1rem;">
                        <div class="img-group d-flex flex-column align-items-center">
                            <img src="../../assets/img/sampleProfile/profile.png" class="img-fluid" alt="profile" style="width: 200px">
                            <label>Picture</label>
                        </div>
                        <div class="img-group d-flex flex-column align-items-center">
                            <img src="../../assets/img/sampleProfile/signature.png" class="img-fluid" alt="signature" style="width: 200px">
                            <label>Signature</label>
                        </div>
                        <div class="img-group d-flex flex-column align-items-center">
                            <img src="../../assets/img/sampleProfile/card.png" class="img-fluid" alt="id" style="width: 200px">
                            <label>Valid ID</label>
                        </div>

                    </div>
                    <div class="container-fluid mt-3">
                            <p>Name:</p>
                            <p>Age:</p>
                            <p>Birth Date:</p>
                            <p>Mobile:</p>
                            <p>Status</p>
                            <p>Organization:</p>

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
    <script src="../components/sidebar.js" defer></script>
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