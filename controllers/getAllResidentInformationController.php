<?php
include_once "../database/databaseConnection.php";

function getAllResidentInformation($id){
    $conn = $GLOBALS['conn'];
    $resident_tbl_qry = "SELECT * FROM residents_tbl WHERE id = $id UNION SELECT * FROM residents_information WHERE id = $id UNION SELECT FROM * residents_contact WHERE id = $id UNION SELECT * FROM residents_family
     WHERE id = $id UNION SELECT * FROM residents_address WHERE id = $id UNION SELECT * FROM residents_employment WHERE id = $id";
    $result = $conn->prepare($resident_tbl_qry);
    $result->execute();
    $resident_tbl = $result->fetchAll(PDO::FETCH_ASSOC);
    $resident_fullname = $resident_tbl['first_name'] . " " . $resident_tbl['middle_name'] . " " . $resident_tbl['last_name'];
    $resident_full_address = $resident_tbl['house_number'] . " " . $resident_tbl['purok'] . " " . $resident_tbl['street'] . " " . $resident_tbl['hoa'];
    $db_arr = [
     'resident_id' => $resident_tbl['id'],
     'resident_picture' => $resident_tbl['picture'],
     'resident_valid_id' => $resident_tbl['valid_id'],
     'residentt_signature' => $resident_tbl['signature'],
     'resident_fullname' => $resident_fullname,
     'resident_sex' => $resident_tbl['sex'],
     'resident_birthdate' => $resident_tbl['birthdate'],
     'resident_birthplace' => $resident_tbl['birthplace'],
     'resident_civil_status' => $resident_tbl['civil_status'],
     'resident_height' => $resident_tbl['height'],
     'resident_weight' => $resident_tbl['weight'],
     'resident_blood_type' => $resident_tbl['blood_type'],
     'resident_religion' => $resident_tbl['religion'],
     'resident_etnic_origin' => $resident_tbl['etnic_origin'],
     'resident_nationality' => $resident_tbl['nationality'],
     'resident_precinct_number' => $resident_tbl['precinct_number'],
     'resident_registered_voter' => $resident_tbl['registered_voter'],
     'resident_organization_member' => $resident_tbl['organization_member'],
     'resident_email' => $resident_tbl['email'],
     'resident_mobile_no' => $resident_tbl['mobile_no'],
     'resident_tel_no'=> $resident_tbl['tel_no'],
     'resident_ICOE_fullname'=>$resident_tbl['ICOE_fullname'],
     'resident_ICOE_contact' => $resident_tbl['ICOE_contact'],
     'resident_ICOE_address'=>$resident_tbl['ICOE_address'],
     'resident_mother_fullname'=>$resident_tbl['mother_fullname'],
     'resident_father_fullname'=>$resident_tbl['father_fullname'],
     'resident_spouse_fullname'=>$resident_tbl['spouse_fullname'],
     'resident_highest_education'=>$resident_tbl['highest_education'],
     'resident_type_of_school'=>$resident_tbl['type_of_school'],
     'resident_house_number' => $resident_tbl['house_number'],
     'resident_purok'=>$resident_tbl['purok'],
     'resident_street'=>$resident_tbl['street'],
     'resident_full_address' => $resident_full_address,
     'resident_hoa'=>$resident_tbl['hoa'],
     'resident_employment_status'=>$resident_tbl['employment_status'],
     'resident_employment_field'=>$resident_tbl['employment_field'],
     'resident_occupation'=>$resident_tbl['occupation'],
     'resident_monthly_income'=>$resident_tbl['monthly_income'],
    ];
    return $db_arr;
}

?>