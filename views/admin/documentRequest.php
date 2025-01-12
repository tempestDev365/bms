<?php
session_start();
include "../../database/databaseConnection.php";
if(!isset($_SESSION['admin'])) {
    header('Location: adminLogin.php');
}
function getAllDocumentRequest(){
    $conn = $GLOBALS['conn'];
    $qry = "SELECT d.*, ri.first_name,ri.middle_name,ri.last_name
           
     FROM document_requested d
     LEFT JOIN residents_tbl ri
        ON d.resident_id = ri.id
     ";
    $result = $conn->prepare($qry);
    $result->execute();
    $document_request = $result->fetchAll(PDO::FETCH_ASSOC);
    return $document_request;
}
$document_request = getAllDocumentRequest();
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

    <div class="main-container d-flex" style="min-height: 100vh; min-width: 100%;">
        <div class="admin-sidebar">
           
        </div>

        <div class="admin-content flex-grow-1 p-4 bg-light" style="max-height: 100vh; overflow-y: scroll">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">BMS</li>
                  <li class="breadcrumb-item"><a href="./issuedClearance.html" class="text-dark">Document Request</a></li>
                </ol>
              </nav>
              

            <div class="container-fluid p-3 shadow-sm border rounded bg-white">
                <h1 class="mb-3 text-center">Document Request</h1>

                <div class="mb-3">
                    <label for="statusFilter" class="form-label">Filter by Status:</label>
                    <select id="statusFilter" class="form-select">
                        <option value="all">All</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>

                <table class="table table-bordered nowrap table-hover mt-3" id="example">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Request</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($document_request as $request){
                            echo "
                            <tr>
                              <td>{$request['id']}</td>
                                <td>{$request['first_name']} {$request['middle_name']} {$request['last_name']}</td>
                                <td>{$request['document']}</td>
                                <td>{$request['status']}</td>
                                <td>{$request['time_Created']}</td>
                                <td>
                                    <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#viewProfile' name = '{$request['resident_id']}' data-document = {$request['document']} id = 'viewBtn'>View</button>
                                    <button class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#selectDocument' name = '{$request['resident_id']}' id = 'printBtn'>Print</button>
                                </td>
                            </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
        
    </div>
    

    <!--MODAL FOR VIEW-->
    <div class="modal" id="viewProfile">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Profile Information</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                      <div class="profile-header d-flex justify-content-start align-items-center" style="gap: 20px">
                        <img src="" class="img-fluid" style="width: 150px" alt="" id = "picture">
                        <div class="profile-detail">
                            <p id = "name">Name:</p>
                            <p id = "age">Age:</p>
                            <p id = "birthDate">Birth Date:</p>
                            <p id = "contactNo">Contact No:</p>
                        </div>
                      </div>
                      <div class="profile-body border p-3">
                        <label id = "document">Document Request:</label>
                        <p class="mt-3" id = "purpose">Purpose:</p>
                      </div>
                      <div class="profile-btn mt-3 d-flex justify-content-end" style="gap: 10px">
                        <button class="btn btn-success" name = "" id = "approve" data-document="">Approve</button>
                        <button class="btn btn-danger" name = "" id = "reject" data-document = "">Reject</button>
                      </div>
                      
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    
    <!--modal for resident certificate-->
    <div class="modal" id="selectDocument">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Document</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label for="selectDocument">Select type of documents</label>
                    <select name="selectDocument" id="selectDocument" class="form-control">
                        <option value="CLEARANCE">BARANGAY CLEARANCE</option>
                        <option value="CERTIFICATE">BARANGAY CERTIFICATE</option>
                        <option value="INDIGENCY">BARANGAY INDIGENCY</option>
                        <option value="D.CERTIFICATE">BARANGAY DEATH CERTIFICATE</option>
                        <option value="RESIDENT">CERTIFICATE FOR RESIDENT</option>
                        <option value="NON-RESIDENT">CERTIFICATE FOR NON RESIDENT</option>
                        <option value="B.PERMIT">CERTIFICATE FOR BUSINESS PERMIT</option>
                        <option value="GUARDIANSHIP">CERTIFICATE FOR GUARDIANSHIP </option>
                        <option value="DISASTER">CERTIFICATE FOR DISASTER</option>
                        <option value="RELATIONSHIP">CERTIFICATE FOR RELATIONSHIP</option>
                        <option value="J.SEEKER">CERTIFICATE FOR FIRST TIME JOB SEEKER</option>
                        <option value="N.INCOME">CERTIFICATE FOR NO SOURCE OF INCOME</option>
                        <option value="S,P.CERTIFICATE">SINGLE PARENT CERTIFICATE</option>
                    </select>

                    <div class="actions d-flex p-3 justify-content-end" style="gap: 5px;">
                        <button class="btn btn-success btn-sm" id = "modalPrintbtn">PRINT</button>
                        <button class="btn btn-danger btn-sm">CANCEL</button>
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
        const documentSelected = document.getElementById('selectDocument');
        const print = document.querySelectorAll('#printBtn');
        const modalPrintbtn = document.getElementById('modalPrintbtn');
        $('#statusFilter').on('change', function() {
            var filterValue = $(this).val();
            var table = $('#example').DataTable();
            table.column(3).search(filterValue === 'all' ? '' : filterValue, true, false).draw();
        });
        const approve = document.getElementById('approve');
        approve.addEventListener('click', async function(e) {
            const resident_id = e.target.getAttribute('name');
            const document_request = e.target.getAttribute('data-document');
            const api = await fetch(`../../controllers/updateDocumentRequest.php?resident_id=${resident_id}&document=${document_request}&action=approve`);
            const response = await api.json();
            if(response == 'success'){
                alert('Document has been approved');
              window.location.reload();
            }
           alert(response.error);

        });
        const viewBtn = document.querySelectorAll('#viewBtn');
        viewBtn.forEach(btn => {
            btn.addEventListener('click', async function(e) {
                const resident_id = e.target.getAttribute('name');
                const document_request = e.target.getAttribute('data-document');
                const api = await fetch(`../../controllers/getDocumentRequestInformation.php?resident_id=${resident_id}&document=${document_request}&action=view`);
                const response = await api.json();
               document.querySelector('#picture').src = `data:image/gif;base64,${response.resident_picture}`;
               document.querySelector('#name').textContent = `Name: ${response.resident_name}`;
               document.querySelector('#age').textContent = `Age: ${response.resident_age}`;
               document.querySelector('#birthDate').textContent = `Birth Date: ${response.resident_birthdate}`;
               document.querySelector('#contactNo').textContent = `Contact No: ${response.mobile_no}`;
               document.querySelector('#document').textContent = `Document Request: ${response.document_request}`;
               document.querySelector('#purpose').textContent = `Purpose: ${response.document_purpose}`;
               document.querySelector('#approve').setAttribute('data-document', response.document_request);
               document.querySelector('#approve').setAttribute('name', resident_id  );
                
            });
        });
        print.forEach(btn => {
            btn.addEventListener('click',  function(e) {
            
                const resident_id = e.target.getAttribute('name');
                const currentURL  = new URL(window.location.href);
                currentURL.searchParams.delete('resident_id');
                currentURL.searchParams.set('resident_id', resident_id);
                window.history.pushState({}, '', currentURL);

            });
        })
     modalPrintbtn.addEventListener('click', function(e) {
        const documentSelected = document.getElementById('selectDocument').value;
        const params = new URLSearchParams(window.location.search);
        const resident_id = params.get('resident_id');
        console.log(resident_id);
     });
    </script>
</body>
</html>