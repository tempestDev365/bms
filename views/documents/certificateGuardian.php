<?php
include '../../database/databaseConnection.php';
$id = $_GET['resident_id'] ?? null;
function getAllResidentInformation($id){
    $conn = $GLOBALS['conn'];

    $resident_tbl_qry = "SELECT * FROM residents_tbl WHERE id = ?";
    $stmt = $conn->prepare($resident_tbl_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $resident_tbl_result = $stmt->fetch();

    $resident_address_qry = "SELECT * FROM residents_address WHERE resident_id = ?";
    $stmt = $conn->prepare($resident_address_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $resident_address_result = $stmt->fetch();

    $resident_contact_qry = "SELECT * FROM residents_contacts WHERE residents_id = ?";
    $stmt = $conn->prepare($resident_contact_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $resident_contact_result = $stmt->fetch();

    $resident_family_qry = "SELECT * FROM residents_family WHERE resident_id = ?";
    $stmt = $conn->prepare($resident_family_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $resident_family_result = $stmt->fetch();

    $resident_information_qry = "SELECT * FROM resident_information WHERE resident_id = ?";
    $stmt = $conn->prepare($resident_information_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $resident_information_result = $stmt->fetch();

    $resident_employment_qry = "SELECT * FROM residents_employment WHERE resident_id = ?";
    $stmt = $conn->prepare($resident_employment_qry);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $resident_employment_result = $stmt->fetch();
   return [
        'resident_picture'=>$resident_tbl_result['picture'],
        'resident_signature'=>$resident_tbl_result['signature'],
        'resident_valid_id'=>$resident_tbl_result['valid_id'],
        'resident_fullname'=>$resident_tbl_result['first_name'].' '.$resident_tbl_result['middle_name'].' '.$resident_tbl_result['last_name'],
        'resident_sex'=>$resident_information_result['sex'],
        'resident_birthdate'=>$resident_information_result['birthdate'],
        'resident_birthplace'=>$resident_information_result['birthplace'],
        'resident_civil_status'=>$resident_information_result['civil_status'],
        'resident_height'=>$resident_information_result['height'],
        'resident_weight'=>$resident_information_result['weight'],
        'resident_blood_type'=>$resident_information_result['blood_type'],
        'resident_religion'=>$resident_information_result['religion'],
        'resident_nationality'=>$resident_information_result['nationality'],
        'resident_ethnic_origin'=>$resident_information_result['ethnic_origin'],
        'resident_precint_number'=>$resident_information_result['precint_number'],
        'resident_is_voter' => $resident_information_result['registered_voter'] ? 'Yes' : 'No',
        'resident_org_member' => $resident_information_result['organization_member'],
        'resident_email'=>$resident_contact_result['email'],
        'resident_mobile_number'=>$resident_contact_result['mobile_no'],
        'resident_tel_number'=>$resident_contact_result['tel_no'],
        'resident_ICOE_name'=>$resident_contact_result['ICOE_fullname'],
        'resident_ICOE_contact_number'=>$resident_contact_result['ICOE_contact'],
        'resident_ICOE_address'=>$resident_contact_result['ICOE_address'],
        'resident_father_name'=>$resident_family_result['father_fullname'],
        'resident_mother_name'=>$resident_family_result['mother_fullname'],
        'resident_spouse_name'=>$resident_family_result['spouse_fullname'],
        'resident_highest_educational_attainment'=>$resident_employment_result['highest_education'],
        'resident_type_of_school'=>$resident_employment_result['type_of_school'],
        'resident_house_number'=>$resident_address_result['house_number'],
        'resident_street'=>$resident_address_result['street'],
        'resident_purok'=>$resident_address_result['purok'],
        'resident_full_address' => $resident_address_result['house_number'].' '.$resident_address_result['street'],
        'resident_hoa'=>$resident_address_result['HOA'],
        'resident_employment_status'=>$resident_employment_result['employment_status'],
        'resident_employment_field'=>$resident_employment_result['employment_field'],
        'resident_occupation'=>$resident_employment_result['occupation'],
        'resident_monthly_income'=>$resident_employment_result['monthly_income'],
   ];
}
$resident_information = getAllResidentInformation($id);
$get_purpose_qry = "SELECT purpose FROM document_requested WHERE resident_id = $id";
$stmt = $conn->prepare($get_purpose_qry);
$stmt->execute();
$purpose = $stmt->fetch(PDO::FETCH_ASSOC);
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
                    <label style="font-size: 1.8rem;"> CERTIFICATE OF GUARDIANSHIP

                    </label>

                    <!--ADD THE ELEMENT TO AUTOMATE-->
                    <div class="a4-body mt-3 d-flex px-2 fw-bold" style="gap: 5px;">
                        <img src="data:image/gif;base64, <?php echo $resident_information['resident_picture']  ?>" class="img-fluid" style="width: 140px;" alt="">
                        <div class="a4-body-content d-flex flex-column justify-content-center align-items-start">
                            <label>Name: <?php echo $resident_information['resident_fullname']  ?></label>
                            <label>Birthday: <?php echo $resident_information['resident_birthdate']  ?></label>
                            <label>Gender:  <?php echo $resident_information['resident_sex']  ?></label>
                            <label>Civil Status: <?php echo $resident_information['resident_civil_status']  ?></label>
                            <label>Nationality:  <?php echo $resident_information['resident_nationality']  ?></label>
                            <label>Precinct:  <?php echo $resident_information['resident_precint_number']  ?></label>
                        </div>
                    </div>


                    <div class="px-2 fw-bold mt-2">
                        <label style="text-align: left;">Address:  <?php echo $resident_information['resident_full_address']  ?></label>
                    </div>
                    <hr>
                    
                    <label style="text-align: left;" class="mx-2">
                        This is to certify that the individual named as the guardian is of legal age, residing at the specified address, and is the lawful guardian of the minor born on the stated date. This certification is based on records and information available in this office, as well as upon verification of the relationship and the need for guardianship.

                    </label>
                    
                    <label class="m-2">
                        This Barangay Certificate is issued upon request for <?php echo $purpose['purpose'] ?><span style="text-decoration: underline; font-weight: bold;"></span>.
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
