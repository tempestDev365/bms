<?php

$id = $_GET['id'];
function getAllResidentInformation($id){
    include '../database/databaseConnection.php';
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
if($_GET['action'] == "view"){
    header('Content-Type: application/json');
    echo json_encode(getAllResidentInformation($id));
}
?>