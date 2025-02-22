<?php
$id = $_GET['resident_id'] ?? null;
$other_id = $_GET['id'] ?? null;
function checkIfForFree($id){
    include '../../database/databaseConnection.php';
    $conn = $GLOBALS['conn'];
    $get_org_member = $conn->query("SELECT * FROM residents_personal_information WHERE id = $id")->fetch();
    $checkIfStudent = $conn->query("SELECT employment_status FROM residents_additional_information WHERE resident_id = $id")->fetch();

        if($get_org_member == "SENIOR CITIZEN" || $checkIfStudent == "Student" || $get_org_member == "PWD"){
            return true;
        }
   


}
function insertIntoRevenue(){
    include '../../database/databaseConnection.php';
    $conn = $GLOBALS['conn'];
    $sql = "INSERT INTO revenue_tbl (amount, time_Created) VALUES (20,NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
function getAllResidentInformation($id){
    include '../../database/databaseConnection.php';
    $conn = $GLOBALS['conn'];
    $sql = "SELECT r.*,ri.*,rc.*,ra.*
            FROM residents_information r
            LEFT JOIN residents_personal_information ri ON r.id = ri.id
            LEFT JOIN residents_contact_information rc ON r.id = rc.resident_id
            LEFT JOIN residents_additional_information ra ON r.id = ra.id
            WHERE r.id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();
    $purpose = $conn->query("SELECT purpose FROM documents_requested_for_others WHERE resident_id = $id")->fetch();
     if(checkIfForFree($id)){
        insertIntoRevenue();
    }
    return [
        'resident_id'=>$result['id'],
        'resident_picture'=>$result['resident_picture'],
        'resident_fullname'=>$result['first_name'].' '.$result['middle_name'].' '.$result['last_name'],
        'resident_age'=>$result['age'] ?? "",
        'resident_sex'=>$result['sex'] ?? "",
        'resident_birthdate'=>$result['birthday'] ?? "",
        'resident_civil_status'=>$result['civil_status'] ?? "",
        'resident_height'=>$result['height'] ?? "",
        'resident_weight'=>$result['weight'] ?? "",
        'resident_blood_type'=>$result['blood_type'] ?? "",
        'resident_religion'=>$result['religion'] ?? "",
        'resident_is_voter'=>$result['registered_voter'] ?? "",
        'resident_org_membership'=>$result['organization_member'] ?? "",
        'mobile_no'=>$result['phone_number'] ?? "",
        'email'=>$result['email']?? "",
        'resident_tel_no'=>$result['tel_no'] ?? "",
        'resident_highest_educational_attainment'=>$result['highest_educational_attainment'] ?? "",
        'resident_type_of_school'=>$result['type_of_school'] ?? "",
        'resident_house_number'=>$result['house_number'] ?? "",
        'resident_purok'=>$result['purok'] ?? "",
        'resident_street'=>$result['street'] ?? "",
        'resident_employment_status'=>$result['employment_status'] ?? "",
        'resident_employment_field'=>$result['employment_field'] ?? "",
         'resident_monthly_income'=>$result['monthly_income'] ?? "",
        'resident_occupation'=>$result['occupation'] ?? "",
        'resident_full_address'=>$result['house_number'].' '.$result['purok'].' '.$result['street'],
        'purpose'=>$purpose['purpose'] ?? ""
        

    ];

   
}
function getOthersInfo($id){
    include '../../database/databaseConnection.php';
    $conn = $GLOBALS['conn'];
    $sql = "SELECT name, purpose FROM documents_requested_for_others WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $others = $stmt->fetch();
    $conn = $GLOBALS['conn'];
    $sql = "SELECT r.*,ri.*,rc.*,ra.*
            FROM residents_information r
            LEFT JOIN residents_personal_information ri ON r.id = ri.id
            LEFT JOIN residents_additional_information ra ON r.id = ra.id
            LEFT JOIN residents_contact_information rc ON r.id = rc.resident_id
            WHERE CONCAT(first_name, ' ', last_name) = :full_name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':full_name', $others['name'], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    
    
    $purpose = $conn->query("SELECT purpose FROM documents_requested_for_others WHERE id = $id")->fetch();
     if(checkIfForFree($id)){
        insertIntoRevenue();
    }
    return [
        'resident_id'=>$result['id'],
        'resident_picture'=>$result['resident_picture'],
        'resident_fullname'=>$result['first_name'].' '.$result['middle_name'].' '.$result['last_name'],
        'resident_age'=>$result['age'] ?? "",
        'resident_sex'=>$result['sex'] ?? "",
        'resident_birthdate'=>$result['birthday'] ?? "",
        'resident_civil_status'=>$result['civil_status'] ?? "",
        'resident_height'=>$result['height'] ?? "",
        'resident_weight'=>$result['weight'] ?? "",
        'resident_blood_type'=>$result['blood_type'] ?? "",
        'resident_religion'=>$result['religion'] ?? "",
        'resident_is_voter'=>$result['registered_voter'] ?? "",
        'resident_org_membership'=>$result['organization_member'] ?? "",
        'mobile_no'=>$result['phone_number'] ?? "",
        'email'=>$result['email']?? "",
        'resident_tel_no'=>$result['tel_no'] ?? "",
        'resident_highest_educational_attainment'=>$result['highest_educational_attainment'] ?? "",
        'resident_type_of_school'=>$result['type_of_school'] ?? "",
        'resident_house_number'=>$result['house_number'] ?? "",
        'resident_purok'=>$result['purok'] ?? "",
        'resident_street'=>$result['street'] ?? "",
        'resident_employment_status'=>$result['employment_status'] ?? "",
        'resident_employment_field'=>$result['employment_field'] ?? "",
         'resident_monthly_income'=>$result['monthly_income'] ?? "",
        'resident_occupation'=>$result['occupation'] ?? "",
        'resident_full_address'=>$result['house_number'].' '.$result['purok'].' '.$result['street'],
        'purpose'=>$purpose['purpose']
        

    ];
   

}

$action = $_GET['action'] ?? null;
if(isset($id)){
    $resident_information = getAllResidentInformation($id);
}
if(isset($other_id)){
    $resident_information = getOthersInfo($other_id);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay ID</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, Helvetica, sans-serif;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
          h1, .title-class { display: none !important; }


        .card-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .card {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        @media print {
            body {
                padding: 0;
                background: none;
            }
            
            .card-container {
                margin: 0;
            }

            .bg-primary {
                background-color: #0d6efd !important;
                color: white !important;
            }

            .shadow-sm {
                box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
            }

            img {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
             title, header, footer {
        display: none !important;
    }

    /* Hide specific elements if needed */
    .top-right-text, .bottom-text {
        display: none !important;
    }
        }
    </style>
</head>
<body>
    <div class="card-container">
        <div class="card shadow-sm border" style="width: 500px; height: 350px;">
            <div class="card-top bg-primary text-light  fw-bold p-2 d-flex justify-content-center align-items-center">
                <img src="../../assets/img/sinbanali.png" class="img-fluid" style="width: 50px;" alt="">
                <div class="d-flex flex-column align-items-center" style="font-size: .7rem;">
                    <label>REPUBLIC OF THE PHILIPPINES</label>
                    <label>CITY OF BACOOR</label>
                    <label>BARANGAY</label>
                    <label>SINBANALI</label>    
                </div>
                <img src="data:image/jpeg;base64, <?php echo $resident_information['resident_picture'] ?>" class="img-fluid" style="width: 50px;" alt="">
            </div>
            <div class="card-mid p-3 d-flex justify-content-start align-items-center" style="flex-grow: 1; gap: 5px;">
                <img src="https://placehold.co/300x200" class="img-fluid" style="width:200px; height: 150px;" alt="Sample Image">
                <div class="card-info d-flex flex-column" style="font-size: .7rem;">
                <label>Name: <?php echo $resident_information['resident_fullname']  ?></label>
                            <label>Birthday: <?php echo $resident_information['resident_birthdate']  ?></label>
                            <label>Gender:  <?php echo $resident_information['resident_sex']  ?></label>
                            <label>Civil Status: <?php echo $resident_information['resident_civil_status']  ?></label>
                    
                </div>
            </div>
            <div class="card-bot px-2 d-flex justify-content-center align-items-center">
                <img src="../../assets/img/service.png" class="img-fluid" style="width: 100px;" alt="">
                <img src="../../assets/img/strike.jpg" class="img-fluid" style="width: 70px;" alt="">
            </div>
        </div>
        <div class="card shadow-sm border p-3" style="width: 500px; height: 350px;">
            <div class="back-top  d-flex" style="flex: 1;">
                <div class=" d-flex  rounded-3 fw-bold justify-content-center align-items-center flex-column text-center" style="flex: 1; font-size: .7rem; border: 1px solid black;">
                    <label>INCASE OF EMERGENCE:</label>
                    <labe>WILLENL. TARONG</labe>
                    <label>374 LABRADOR COMPD. PUROK</label>
                    <label>SINEGUESLASAN, SINBANALI, BACOOR CITY,</label>
                    <label>CAVITE</label>
                    <p>09399194665</p>
                </div>
                <div class="text-center d-flex justify-content-center align-items-center flex-column" style="flex: 1; font-size: .7rem;">
                    <img src="../../assets/img/strike.jpg" class="img-fluid " style="width: 100px;" alt="">
                    <label>Holder is a bonafide constituent of this barangay and is entitled to all privilege and services holder may require.

                        If found please return to the Barangay Secretariat Barangay Hall Bacoor City.</label>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        
        window.onload = function() {
            window.print();
        };

        window.onafterprint = function() {
            window.history.back();
        };

        document.querySelector('.btn-close').addEventListener('click', function() {
            window.history.back();
        });
        
    </script>
</body>
</html>
