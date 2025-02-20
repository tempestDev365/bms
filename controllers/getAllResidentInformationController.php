<?php
$id = $_GET['id'] ?? null;
function getAllResidentInformation($id){
    include '../database/databaseConnection.php';   
    $conn = $GLOBALS['conn'];
    $sql = "SELECT r.*, r.id as 'user_id', ri.*, rc.*
    FROM residents_information r
    LEFT JOIN residents_personal_information ri ON r.id = ri.resident_id
    LEFT JOIN residents_contact_information rc ON r.id = rc.resident_id
    WHERE r.id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();
    return [
        'user_id'=>$result['user_id'],
        'resident_id'=>$result['id'],
        'resident_valid_id'=>$result['valid_id'] ?? "",
        'resident_picture'=>$result['resident_picture'] ?? "",
        'resident_fullname'=>$result['first_name'].' '.$result['middle_name'].' '.$result['last_name'],
        'resident_first_name'=>$result['first_name'] ?? "",
        'resident_middle_name'=>$result['middle_name'] ?? "",
        'resident_last_name'=>$result['last_name'] ?? "",
        'resident_suffix'=>$result['suffix'] ?? "",
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
        

    ];

   
}
$action = $_GET['action'] ?? null;
if($action == "view"){
    header('Content-Type: application/json');
    echo json_encode(getAllResidentInformation($id));
}
?>