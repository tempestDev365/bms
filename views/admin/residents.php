<?php
include '../../database/databaseConnection.php';
include '../../controllers/getAllResidentInformationController.php';
session_start();
if(!isset($_SESSION['admin'])) {
    header('Location: adminLogin.php');
}
$conn = $GLOBALS['conn'];
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

if ($filter === 'male') {
    $resident_qry = "SELECT * FROM residents_information WHERE sex = 'Male'";
} elseif ($filter === 'female') {
    $resident_qry = "SELECT * FROM residents_information WHERE sex = 'Female'";
} elseif ($filter === 'voter') {
    $resident_qry = "SELECT ri.* FROM residents_information ri
        LEFT JOIN residents_personal_information ra ON ri.id = ra.resident_id
        WHERE ra.registered_voter = 'Yes'";
} else {
    $resident_qry = "SELECT * FROM residents_information";
}

$stmt = $conn->prepare($resident_qry);
$stmt->execute();
$resident_result = $stmt->fetchAll();
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
        @media print {
            .action-column {
                display: none;
            }
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
                  <li class="breadcrumb-item"><a href="./issuedClearance.html" class="text-dark">Residents</a></li>
                </ol>
              </nav>
              

            <div class="container-fluid p-3 shadow-sm border rounded bg-white">
                <h1 class="mb-3 text-center">Registered Residents</h1>

                <div class="container-fluid d-flex justify-content-end align-items-center mb-3" style="gap: 1rem; flex-wrap: wrap;">
                    <div class="filter">
                        <label>Select Filter</label>
                        <select id="genderFilter" class="form-select">
                            <option value="all">All</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="voter">Voters</option>
                        </select>
                    </div>
                   
                </div>
                <table class="table table-bordered nowrap table-hover mt-3" id="example">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th class="action-column">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tBody">
                        <?php foreach($resident_result as $key => $value): ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['first_name'].' '.$value['middle_name'].' '.$value['last_name']; ?></td>
                            <td><?php echo $value['sex']; ?></td>
                            <td><?php echo $value['age']; ?></td>
                            <td class="action-column">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewDetail" id="viewBtn" name="<?php echo $value['id']; ?>" onclick="viewDetail(<?php echo $value['id']; ?>)">View</button>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#selectDocument" name="<?php echo $value['id']; ?>" id="issueBtn" onclick="setUrlId(<?php echo $value['id']; ?>)">Issue Certificate</button>
                                <button class="btn btn-danger btn-sm" id="deleteBtn" onclick="deleteResident(<?php echo $value['id']; ?>)">Delete</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
        
    </div>
    

    <!-- modal for resident details-->
    <div class="modal" id="viewDetail">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Resident Details</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                
                    <div class="container-id p-3 d-flex justify-content-center" style="gap: 1rem; flex-wrap: wrap;">
                         <div class="card shadow-sm" style="flex: 1 1 300px; min-height: 300px"><img src="" alt="" class= "picture"></div>
                        <div class="card shadow-sm" style="flex: 1 1 300px; min-height: 300px"><img src="" alt="" class = "valid_id"></div>
                    </div>
                   <div class="box-body row">
                        <div class="personal-info col-md-12 col-lg-4 d-flex flex-column" style="gap: 5px;">
                            <div class="box-header">
                                <h4>Personal Information</h4>
                            </div>
                            <label id="fullName">Full Name:</label>
                            <label id="sex">Sex:</label>
                            <label id="birthdate">Birthdate:</label>
                            <label id="civilStatus">Civil Status:</label>
                            <label id="height">Height:</label>
                            <label id="weight">Weight:</label>
                            <label id="bloodType">Blood Type:</label>
                            <label id="religion">Religion:</label>
                            <label id="registeredVoter">Registered Voter:</label>
                            <label id="organizationMember">Organization Member:</label>
                        </div>
                        <div class="other-info col-md-12 col-lg-4 d-flex flex-column" style="gap: 5px;">
                            <div class="contact-header">
                                <h4>Contact Information</h4>
                            </div>
                            <label id="email">Email:</label>
                            <label id="mobileNumber">Mobile Number:</label>
                            <label id="telNo">Tel No:</label>

                            <div class="contact-header">
                                <h4>Educational Information:</h4>
                            </div>
                            <label id="highestEducation">Highest Education Attainment:</label>
                            <label id="typeOfSchool">Type of School:</label>
                        </div>
                        <div class="other-info-2 col-md-12 col-lg-4 d-flex flex-column" style="gap: 5px;">
                            <div class="contact-header">
                                <h4>Address Information</h4>
                            </div>
                            <label id="houseNumber">House Number:</label>
                            <label id="purok">Purok:</label>
                            <label id="street">Street:</label>
                            <div class="contact-header">
                                <h4>Employment Information:</h4>
                            </div>
                            <label id="employmentStatus">Employment Status:</label>
                            <label id="employmentField">Employment Field:</label>
                            <label id="occupation">Occupation:</label>
                            <label id="monthlyIncome">Monthly Income:</label>
                        </div>
                    </div>

                    <div class="modal-actions d-flex justify-content-end p-3" style="gap: 5px;">
                        
                    </div>
                </div>
        </div>
    </div>
    </div>


    <!--modal for resident certificate-->
    <div class="modal fade" id="selectDocument" tabindex="-1" aria-labelledby="selectDocumentLabel" aria-hidden="true">
        <div class="modal-dialog modal-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Document</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label for="document">Select type of documents</label>
                    <select name="documentOption" id="documentOption" class="form-control">
                        <option value="BARANGAYID">BARANGAY ID</option>
                        <option value="BARANGAYCLEARANCE">BARANGAY CLEARANCE</option>
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
                        <button class="btn btn-success btn-sm" id = "printBtn" onclick="printDocu()">PRINT</button>
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
        const issueCertificate = document.querySelectorAll('#issueBtn');
        const print = document.querySelector('#printBtn');
        // view the resident details
        async function viewDetail(id){
            const api = await fetch(`../../controllers/getAllResidentInformationController.php?id=${id}&action=view`);
            const response = await api.json();
            document.querySelector('.picture').src = `../../assets/img/${response.resident_picture}`;
            document.querySelector('.valid_id').src = `../../assets/img/${response.valid_id}`;
            document.querySelector('#fullName').textContent = `Full Name: ${response.resident_fullname}`;
            document.querySelector('#sex').textContent = `Sex: ${response.resident_sex}`
            document.querySelector('#birthdate').textContent = `Birthdate: ${response.resident_birthdate}`;
            document.querySelector('#civilStatus').textContent = `Civil Status: ${response.resident_civil_status}`;
            document.querySelector('#height').textContent = `Height: ${response.resident_height}`;
            document.querySelector('#weight').textContent = `Weight: ${response.resident_weight}`;
            document.querySelector('#bloodType').textContent = `Blood Type: ${response.resident_blood_type}`;
            document.querySelector('#religion').textContent = `Religion: ${response.resident_religion}`;
            document.querySelector('#registeredVoter').textContent = `Registered Voter: ${response.resident_is_voter}`;
            document.querySelector('#organizationMember').textContent = `Organization Member: ${response.resident_org_membership}`;
            document.querySelector('#email').textContent = `Email: ${response.email}`;
            document.querySelector('#mobileNumber').textContent = `Mobile Number: ${response.mobile_no}`;
            document.querySelector('#telNo').textContent = `Tel No: ${response.resident_tel_no}`;
            document.querySelector('#highestEducation').textContent = `Highest Education Attainment: ${response.resident_highest_educational_attainment}`;
            document.querySelector('#typeOfSchool').textContent = `Type of School: ${response.resident_type_of_school}`;
            document.querySelector('#houseNumber').textContent = `House Number: ${response.resident_house_number}`;
            document.querySelector('#purok').textContent = `Purok: ${response.resident_purok}`;
            document.querySelector('#street').textContent = `Street: ${response.resident_street}`;
            document.querySelector('#employmentStatus').textContent = `Employment Status: ${response.resident_employment_status}`;
            document.querySelector('#employmentField').textContent = `Employment Field: ${response.resident_employment_field}`;
            document.querySelector('#occupation').textContent = `Occupation: ${response.resident_occupation}`;
            document.querySelector('#monthlyIncome').textContent = `Monthly Income: ${response.resident_monthly_income}`;


          
 
        }

        function setUrlId(id){
            const currentURL  = new URL(window.location.href);
            currentURL.searchParams.delete('resident_id');
            currentURL.searchParams.set('resident_id', id);
            window.history.pushState({}, '', currentURL);
        }
       
        const printDocu = () => {
            const documentSelected = document.getElementById('documentOption').value;
            console.log(documentSelected);
            const params = new URLSearchParams(window.location.search);
            const resident_id = params.get('resident_id');
            const baseURL = "../documents/";
            switch(documentSelected){
                case 'BARANGAYCLEARANCE':
                    window.location.href = `${baseURL}barangayClearance.php?resident_id=${resident_id}`;
                    break;
                case 'CERTIFICATE':
                    window.location.href = `${baseURL}barangayCertificate.php?resident_id=${resident_id}`;
                    break;
                case 'INDIGENCY':
                    window.location.href = `${baseURL}barangayIndigency.php?resident_id=${resident_id}`;
                    break;
                case 'D.CERTIFICATE':
                    window.location.href = `${baseURL}certificateDeath.php?resident_id=${resident_id}`;
                    break;
                case 'RESIDENT':
                    window.location.href = `${baseURL}certificateResident.php?resident_id=${resident_id}`;
                    break;
                case 'NON-RESIDENT':
                    window.location.href = `${baseURL}certificateNonResident.php?resident_id=${resident_id}`;
                    break;
                case 'B.PERMIT':
                    window.location.href = `${baseURL}businessPermit.php?resident_id=${resident_id}`;
                    break;
                case 'GUARDIANSHIP':
                    window.location.href = `${baseURL}certificateGuardian.php?resident_id=${resident_id}`;
                    break;
                case 'DISASTER':
                    window.location.href = `${baseURL}certificateDisaster.php?resident_id=${resident_id}`;
                    break;
                case 'RELATIONSHIP':
                    window.location.href = `${baseURL}certificateRelationship.php?resident_id=${resident_id}`;
                    break;
                case 'J.SEEKER':
                    window.location.href = `${baseURL}firstTimeJob.php?resident_id=${resident_id}`;
                    break;
                case 'N.INCOME':
                    window.location.href = `${baseURL}noSourceIncome.php?resident_id=${resident_id}`;
                    break;
                case 'S,P.CERTIFICATE':
                    window.location.href = `${baseURL}singleParent.php?resident_id=${resident_id}`;
                    break;
                case "BARANGAYID":
                    window.location.href = `${baseURL}barangayID.php?resident_id=${resident_id}`;
                    break;
            }
        }
        // deletes the resident from the database
        const deleteResident = (id) => {
            const confirmDelete = confirm('Are you sure you want to delete this resident?');
            if(confirmDelete){
                const api = fetch(`../../controllers/deleteResidentController.php?id=${id}&action=delete`);
                window.location.reload();
            }
        }
        // renders the filtered resident
        const params = new URLSearchParams(window.location.search);
        const filter = params.get('filter');
        const tableBody = document.querySelector('.tBody');
        if (filter) {
            filterResident(filter).then(filtered => {
                tableBody.innerHTML = '';
                filtered.forEach((resident) => {
                    tableBody.innerHTML += `
                        <tr>
                            <td>${resident.id}</td>
                            <td>${resident.first_name} ${resident.middle_name} ${resident.last_name}</td>
                            <td>${resident.sex}</td>
                            <td>${resident.age}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewDetail" id="viewBtn" name="${resident.resident_id}" onclick = "viewDetail(${resident.resident_id})">View</button>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#selectDocument" name="${resident.resident_id}" id="issueBtn" onclick = "setUrlId(${resident.resident_id})">Issue Certificate</button>
                                <button class="btn btn-danger btn-sm" id="deleteBtn" onclick="deleteResident(${resident.resident_id})">Delete</button>
                            </td>
                        </tr>
                    `;
                });
            }).catch(error => console.error('Error:', error));
        }

        //function to get the filter 
        async function filterResident(filter) {     
            const api = await fetch(`../../controllers/filterResidentController.php?filter=${filter}`);
            const response = await api.json();
            return response;
        }
        // set the filter
        document.getElementById('genderFilter').value = filter || 'all';
        document.getElementById('genderFilter').addEventListener('change', (e) => {
            const filter = e.target.value;
            const currentURL = new URL(window.location.href);
            currentURL.searchParams.set('filter', filter);
            window.location.href = currentURL;
        });
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(.action-column)'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(.action-column)'
                        }
                    }
                ]
            });
        });
    </script>
</body>
</html>
