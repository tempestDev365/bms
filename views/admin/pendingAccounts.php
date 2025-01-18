<?php
include_once "../../database/databaseConnection.php";
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: ./adminLogin.php');
}
$get_all_pending_accounts = "SELECT * FROM pending_accounts_tbl";
$stmt = $conn->prepare($get_all_pending_accounts);
$stmt->execute();
$pending_accounts = $stmt->fetchAll();
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                       foreach($pending_accounts as $accounts){
                        $status = $accounts['status'] == "rejected" ? 'none': '';
                            echo "<tr style='display: $status'>";
                            echo "<td>".$accounts['id']."</td>";
                            echo "<td>".$accounts['Name']."</td>";
                            echo  "<td>
                            <button class='btn btn-sm btn-primary' name = {$accounts['id']} id = 'approve'>Approve</button>
                            <button class='btn btn-sm btn-danger'  name = {$accounts['id']} id = 'reject'>Decline</button>
                             <button class='btn btn-sm btn-primary'  name = {$accounts['resident_id']} id = 'view' data-bs-toggle='modal' data-bs-target='#viewProfile'>view</button>
                            </td>
                            ";
                            echo "</tr>";
                       }
                       ?>

            
                        
                    </tbody>
                </table>
            </div>

        </div>
        
    </div>
    

     <!-- modal for resident details-->
     <div class="modal" id="viewProfile">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Resident Details</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                
                        <div class="container-id p-3 d-flex justify-content-center" style="gap: 1rem; flex-wrap: wrap;">
                        <div class="card shadow-sm" style="flex: 1 1 300px; min-height: 300px"><img src="" alt="" class="picture"></div>
                        <div class="card shadow-sm" style="flex: 1 1 300px; min-height: 300px"><img src="" alt="" class = "signature"></div>
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
                            <label id="birthplace">Birthplace:</label>
                            <label id="civilStatus">Civil Status:</label>
                            <label id="height">Height:</label>
                            <label id="weight">Weight:</label>
                            <label id="bloodType">Blood Type:</label>
                            <label id="religion">Religion:</label>
                            <label id="ethnicOrigin">Ethnic Origin:</label>
                            <label id="nationality">Nationality:</label>
                            <label id="precinctNumber">Precinct Number:</label>
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
                                <h4>Incase of Emergency</h4>
                            </div>
                            <label id="emergencyFullName">Fullname</label>
                            <label id="emergencyContactNumber">Contact Number:</label>
                            <label id="emergencyAddress">Address:</label>
                            <div class="contact-header">
                                <h4>Family Information</h4>
                            </div>
                            <label id="mother">Mother:</label>
                            <label id="father">Father:</label>
                            <label id="spouse">Spouse:</label>
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
                            <label id="fullAddress">Full Address:</label>
                            <label id="street">Street:</label>
                            <label id="hoa">Hoa:</label>
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

    </script>
    <script>  
        $('#genderFilter').on('change', function() {
            var filterValue = $(this).val();
            var table = $('#example').DataTable();
            table.column(2).search(filterValue === 'all' ? '' : filterValue, true, false).draw();
        });
        const approveBtn = document.querySelectorAll('#approve');
        approveBtn.forEach(btn =>{
            btn.addEventListener('click',async (e) => {
                const id = e.target.name;
                const api = await fetch(`../../controllers/pendingStatusUpdateController.php?action=approve&id=${id}`)
                const response =await api.json();
                if(response === "success"){
                    alert("Account Approved");
                    location.reload();
                }else if(response === "approved"){
                    alert("Account Already Approved");
                }

            })
        })
        const rejectBtn  = document.querySelectorAll('#reject');
        rejectBtn.forEach(btn => {
            btn.addEventListener('click', async (e) => {
                const id = e.target.name;
                const api = await fetch(`../../controllers/pendingStatusUpdateController.php?action=reject&id=${id}`)
                const response = await api.json();
                if(response === "success"){
                    alert("Account Rejected");
                    location.reload();
                }
            })
        })
        const viewBtn =document.querySelectorAll('#view');
        viewBtn.forEach(btn => {
            btn.addEventListener('click', async (e) => {
                const id = e.target.name;
                const api = await fetch(`../../controllers/getAllResidentInformationController.php?action=view&id=${id}`)
                const response = await api.json();
               populateModal(response.resident_picture,response.resident_signature,response.resident_valid_id,response.resident_fullname,response.resident_sex,response.resident_birthdate,
               response.resident_birthplace,response.resident_civil_status,response.resident_height,response.resident_weight,response.resident_blood_type,response.resident_religion,response.resident_ethnic_origin,response.resident_nationality,response.resident_precint_number,response.resident_is_voter,response.resident_org_member,
                response.resident_email,response.resident_mobile_number,response.resident_tel_no,response.resident_ICOE_fullname,response.resident_ICOE_contact_number,response.resident_ICOE_address,response.resident_mother_name,response.resident_father_name,response.resident_spouse_name,response.resident_highest_educational_attainment,response.resident_type_of_school,
                response.resident_house_number,response.resident_purok,response.resident_full_address,response.resident_street,response.resident_hoa,response.resident_employment_status,response.resident_employment_field,response.resident_occupation,response.resident_monthly_income)

            })
        })
                function populateModal(picture, signature, valid_id, fullName, sex, birthdate, birthplace, civilStatus, height, weight, bloodType, religion, ethnicOrigin, nationality, precinctNumber, registeredVoter, organizationMember, email, mobileNumber, telNo, emergencyFullName, emergencyContactNumber, emergencyAddress, mother, father, spouse, highestEducation, typeOfSchool, houseNumber, purok, fullAddress, street, hoa, employmentStatus, employmentField, occupation, monthlyIncome) {
            document.querySelector('.picture').src = "data:image/gif;base64," + picture;
            document.querySelector('.signature').src = "data:image/gif;base64," + signature;
            document.querySelector('.valid_id').src = "data:image/gif;base64," + valid_id;
            document.getElementById('fullName').textContent = `Full Name: ${fullName}`;
            document.getElementById('sex').textContent = `Sex: ${sex}`;
            document.getElementById('birthdate').textContent = `Birthdate: ${birthdate}`;
            document.getElementById('birthplace').textContent = `Birthplace: ${birthplace}`;
            document.getElementById('civilStatus').textContent = `Civil Status: ${civilStatus}`;
            document.getElementById('height').textContent = `Height: ${height}`;
            document.getElementById('weight').textContent = `Weight: ${weight}`;
            document.getElementById('bloodType').textContent = `Blood Type: ${bloodType}`;
            document.getElementById('religion').textContent = `Religion: ${religion}`;
            document.getElementById('ethnicOrigin').textContent = `Ethnic Origin: ${ethnicOrigin}`;
            document.getElementById('nationality').textContent = `Nationality: ${nationality}`;
            document.getElementById('precinctNumber').textContent = `Precinct Number: ${precinctNumber}`;
            document.getElementById('registeredVoter').textContent = `Registered Voter: ${registeredVoter}`;
            document.getElementById('organizationMember').textContent = `Organization Member: ${organizationMember}`;
            document.getElementById('email').textContent = `Email: ${email}`;
            document.getElementById('mobileNumber').textContent = `Mobile Number: ${mobileNumber}`;
            document.getElementById('telNo').textContent = `Tel No: ${telNo}`;
            document.getElementById('emergencyFullName').textContent = `Fullname: ${emergencyFullName}`;
            document.getElementById('emergencyContactNumber').textContent = `Contact Number: ${emergencyContactNumber}`;
            document.getElementById('emergencyAddress').textContent = `Address: ${emergencyAddress}`;
            document.getElementById('mother').textContent = `Mother: ${mother}`;
            document.getElementById('father').textContent = `Father: ${father}`;
            document.getElementById('spouse').textContent = `Spouse: ${spouse}`;
            document.getElementById('highestEducation').textContent = `Highest Education Attainment: ${highestEducation}`;
            document.getElementById('typeOfSchool').textContent = `Type of School: ${typeOfSchool}`;
            document.getElementById('houseNumber').textContent = `House Number: ${houseNumber}`;
            document.getElementById('purok').textContent = `Purok: ${purok}`;
            document.getElementById('fullAddress').textContent = `Full Address: ${fullAddress}`;
            document.getElementById('street').textContent = `Street: ${street}`;
            document.getElementById('hoa').textContent = `Hoa: ${hoa}`;
            document.getElementById('employmentStatus').textContent = `Employment Status: ${employmentStatus}`;
            document.getElementById('employmentField').textContent = `Employment Field: ${employmentField}`;
            document.getElementById('occupation').textContent = `Occupation: ${occupation}`;
            document.getElementById('monthlyIncome').textContent = `Monthly Income: ${monthlyIncome}`;
        }
    </script>
</body>
</html>