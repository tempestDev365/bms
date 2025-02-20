<?php
$id = $_GET['resident_id'] ?? null;
$other_id = $_GET['id'] ?? null;
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
    if($result['employment_status'] != "Student" && $result['employment_status'] != "Senior" && $result['employment_status'] != "pwd"){
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
    if($result['employment_status'] != "Student" && $result['employment_status'] != "Senior" && $result['employment_status'] != "pwd"){
        insertIntoRevenue();
    }
    $purpose = $conn->query("SELECT purpose FROM documents_requested_for_others WHERE resident_id = $id")->fetch();
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
        'purpose'=>$others['purpose']
        

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
    <title>A4 Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .a4-page {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            padding: 10mm;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        @media print {
            .a4-page {
                width: 100%;
                height: 100%;
                padding: 10mm;
                box-sizing: border-box;
                page-break-before: always;
            }
        }
    </style>
</head>
<body>
        <div class="a4-page bg-light" >
            <div class="a4-header d-flex justify-content-center align-items-start" style="gap: 5px;">
                <img src="../../assets/img/sinbanali.png" class="img-fluid" style="width: 80px;">
                    <div class="a4-title d-flex justify-content-center align-items-center flex-column text-secondary">
                        <label style="font-size: 1rem;">REPUBLIC OF THE PHILIPPINES</label>
                        <label style="font-size: 0,9rem;">CITY OF BACOOR</label>
                        <label style="font-size: 1.1rem;">BARANGAY</label>
                        <label style="font-size: 1.1rem;">SINBANALI</label>
                        <label style="font-size: 0.7rem;">(046) 431-2569</label>
                        <label style="font-size: 0.7rem;">barangaysinbanali2023@gmail.com</label>

                    </div>
                <img src="../../assets/img/logo-125.png" class="img-fluid" style="width: 80px;">
            </div>

            <div class="a4-main d-flex mt-4" style="gap: 10px;">
            <div class="a4-aside-content py-3 d-flex flex-column justify-content-evenly align-items-center" style="min-width: 200px; width: 400px; height: 800px; border: 2px solid rgb(13, 13, 159); border-radius: 20px;">
                    <label style="font-size: 0.8rem; font-weight: bold;" class="text-secondary">CARIDAD J. SANCHEZ</label>
                    <label style="font-size: 0.8rem; font-weight: bold;" class="text-warning">PUNONG BARANGAY</label>
                    
                    <label style="font-size: 0.8rem; font-weight: bold;" class="text-warning mt-4">PUNONG BARANGAY</label>
                    
                    <label style="font-size: 0.8rem; font-weight: bold;" class="mt-2 text-secondary">Nieves M. Dela Cruz</label>                   
                    <label style="font-size: 0.8rem; font-weight: bold;" class="mt-2 text-secondary">Ronald F. Marquez</label>
                    <label style="font-size: 0.8rem; font-weight: bold;" class="mt-2 text-secondary">Angeline Rose D. Sanchez</label>
                    <label style="font-size: 0.8rem; font-weight: bold;" class="mt-2 text-secondary">Ervin G. Ignacio</label>
                    <label style="font-size: 0.8rem; font-weight: bold;" class="mt-2 text-secondary">Cesar R. Concepcion</label>
                    <label style="font-size: 0.8rem; font-weight: bold;" class="mt-2 text-secondary">Lolita E. Marquez</label>
                    <label style="font-size: 0.8rem; font-weight: bold;" class="mt-2 text-secondary">Leo J. Ignacio</label>

                    <label style="font-size: 0.8rem; font-weight: bold; text-transform: uppercase;" class="text-secondary mt-4">Arthur B. Castor</label>
                    <label style="font-size: 0.8rem; font-weight: bold;" class="text-warning">Treasurer</label>

                    <label style="font-size: 0.8rem; font-weight: bold; text-transform: uppercase;" class="text-secondary mt-4">Juanise Rainel I. Ignacio</label>
                    <label style="font-size: 0.8rem; font-weight: bold;" class="text-warning">SK Chairperson</label>

                    <label style="font-size: 0.8rem; font-weight: bold; text-transform: uppercase;" class="text-secondary mt-4">John Paul T. Grande</label>
                    <label style="font-size: 0.8rem; font-weight: bold;" class="text-warning">Secretary</label>


                    <img src="../../assets/img/service.png" class="img-fluid mt-3" style="width: 150px;" alt="">
                
                    



                </div>

                <div class="a4-main-content text-secondary text-center py-3"style="flex-grow: 1;">
                    <label style="font-size: 1.8rem;">OFFICE OF PUNONG BARANGAY</label>
                    <label style="font-size: 1.8rem;"> CERTIFICATE OF BUSINESS PERMIT

                    </label>

                    <!--ADD THE ELEMENT TO AUTOMATE-->
                    <div class="a4-body mt-3 d-flex px-2 fw-bold" style="gap: 5px;">
                        <img src="data:image/gif;base64, <?php echo $resident_information['resident_picture']  ?>" class="img-fluid" style="width: 140px;" alt="">
                        <div class="a4-body-content d-flex flex-column justify-content-center align-items-start">
                            <label>Name: <?php echo $resident_information['resident_fullname']  ?></label>
                            <label>Birthday: <?php echo $resident_information['resident_birthdate']  ?></label>
                            <label>Gender:  <?php echo $resident_information['resident_sex']  ?></label>
                            <label>Civil Status: <?php echo $resident_information['resident_civil_status']  ?></label>
                          
                        </div>
                    </div>

                    <div class="px-2 fw-bold mt-2">
                        <label style="text-align: left;">Address:  <?php echo $resident_information['resident_full_address']  ?></label>
                    </div>
                    <hr>
                    
                    <label style="text-align: left;" class="mx-2">
                        This is to certify that the business located at the specified address has been duly registered and authorized to operate within this Barangay. The business is in compliance with all the necessary regulations, ordinances, and requirements set forth by the local government.
                        
                        This Barangay Certificate is issued upon request for <?php echo $resident_information['purpose'] ?><span style="text-decoration: underline; font-weight: bold;"></span>.
                    </label>
                    
                    
                    <label style="text-align: left; font-weight: bold;" class="mx-2">Given this day, <!--ADD THE ELEMENT TO AUTOMATE--> <span><?php echo date('m/d/Y') ?></span></label>

                    <div class="sign mt-3 d-flex">
                        <div class="left-sign d-flex flex-column justify-content-end align-items-center" style="flex: 1;">

                            <label>____________________</label>
                            <label>RESIDENT SIGNATURE</label>
                            <span style="font-size: 0.5rem;" class="border px-3 py-5">
                                RIGHT THUMB
                            </span>
                        </div>
                        <div class="right-sign" style="flex: 1;">
                            <img src="../../assets/img/sign-caridad.png" class="img-fluid" style="width: 200px;" alt="">
                            <img src="../../assets/img/sign-danica.png" class="img-fluid mt-3" style="width: 200px;" alt="">

                        </div>
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
