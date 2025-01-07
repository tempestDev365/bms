<?php
include_once "../database/databaseConnection.php";

function getAllResidentInformation($id){
    $conn = $GLOBALS['conn'];
    $resident_tbl_qry = "SELECT * FROM residents_tbl WHERE id = $id";
    $result = $conn->prepare($resident_tbl_qry);
    $result->execute();
    $resident_tbl = $result->fetchAll(PDO::FETCH_ASSOC);
    $resident_fullname = $resident_tbl['first_name'] . " " . $resident_tbl['middle_name'] . " " . $resident_tbl['last_name'];
    $resident_information_qry = "SELECT * FROM resident_information WHERE resident_id = $id";
    $result = $conn->prepare($resident_information_qry);
    $result->execute();
    $resident_information = $result->fetchAll(PDO::FETCH_ASSOC);
    $resident_contact_qry = "SELECT * FROM resident_contact WHERE resident_id = $id";
    $result = $conn->prepare($resident_contact_qry);
    $result->execute();
    $resident_contact = $result->fetchAll(PDO::FETCH_ASSOC);
    $resident_family_qry = "SELECT * FROM resident_family WHERE resident_id = $id";
    $result = $conn->prepare($resident_family_qry);
    $result->execute();
    $resident_family = $result->fetchAll(PDO::FETCH_ASSOC);
    $resident_address_qry = "SELECT * FROM resident_address WHERE resident_id = $id";
    $result = $conn->prepare($resident_address_qry);
    $result->execute();
    $resident_address = $result->fetchAll(PDO::FETCH_ASSOC);
    $resident_full_address = $resident_address['house_number'] . " " . $resident_address['purok'] . " " . $resident_address['street'];
    $resident_employment_qry = "SELECT * FROM resident_employment WHERE resident_id = $id";
    $result = $conn->prepare($resident_employment_qry);
    $result->execute();
    $resident_employment = $result->fetchAll(PDO::FETCH_ASSOC);
    $db_arr = [
     'resident_id' => $resident_tbl['id'],
     'resident_picture' => $resident_tbl['picture'],
     'resident_valid_id' => $resident_tbl['valid_id'],
     'residentt_signature' => $resident_tbl['signature'],
     'resident_fullname' => $resident_fullname,
     'resident_sex' => $resident_information['sex'],
     'resident_birthdate' => $resident_information['birthdate'],
     'resident_birthplace' => $resident_information['birthplace'],
     'resident_civil_status' => $resident_information['civil_status'],
     'resident_height' => $resident_information['height'],
     'resident_weight' => $resident_information['weight'],
     'resident_blood_type' => $resident_information['blood_type'],
     'resident_religion' => $resident_information['religion'],
     'resident_etnic_origin' => $resident_information['etnic_origin'],
     'resident_nationality' => $resident_information['nationality'],
     'resident_precinct_number' => $resident_information['precinct_number'],
     'resident_registered_voter' => $resident_information['registered_voter'],
     'resident_organization_member' => $resident_information['organization_member'],
     'resident_email' => $resident_contact['email'],
     'resident_mobile_no' => $resident_contact['mobile_no'],
     'resident_tel_no'=> $resident_contact['tel_no'],
     'resident_ICOE_fullname'=>$resident_contact['ICOE_fullname'],
     'resident_ICOE_contact' => $resident_contact['ICOE_contact'],
     'resident_ICOE_address'=>$resident_contact['ICOE_address'],
     'resident_mother_fullname'=>$resident_family['mother_fullname'],
     'resident_father_fullname'=>$resident_family['father_fullname'],
     'resident_spouse_fullname'=>$resident_family['spouse_fullname'],
     'resident_highest_education'=>$resident_family['highest_education'],
     'resident_type_of_school'=>$resident_family['type_of_school'],
     'resident_house_number' => $resident_address['house_number'],
     'resident_purok'=>$resident_address['purok'],
     'resident_street'=>$resident_address['street'],
     'resident_full_address' => $resident_full_address,
     'resident_hoa'=>$resident_address['hoa'],
     'resident_employment_status'=>$resident_employment['employment_status'],
     'resident_employment_field'=>$resident_employment['employment_field'],
     'resident_occupation'=>$resident_employment['occupation'],
     'resident_monthly_income'=>$resident_employment['monthly_income'],
    ];
    return $db_arr;
}

?>