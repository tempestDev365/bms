<?php
include_once '../database/databaseConnection.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $current_date = date("Y-m-d H:i:s");

   
    $picture = isset($_FILES['picture']['tmp_name']) ? base64_encode("data:image/jpg;base64,". $_FILES['picture']['tmp_name']) : null;
    $signature = isset($_FILES['signature']['tmp_name']) ? base64_encode("data:image/jpg;base64, ". $_FILES['signature']['tmp_name']) : null;
    $valid_id = isset($_FILES['validId']['tmp_name']) ? base64_encode("data:image/png;base64,". $_FILES['validId']['tmp_name']) : null;
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $first_name = $_POST['firstName'];
    $middle_name = $_POST['middleName'];
    $last_name = $_POST['lastName'];
    $suffix = $_POST['suffix'] ?? "";
    $alias = $_POST['alias'];

    $insert_into_resident_tbl = "INSERT INTO residents_tbl (username, password,picture,signature,valid_id,first_name,middle_name,last_name,suffix,alias,time_Created) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $result = $conn->prepare($insert_into_resident_tbl);
    $result->bindParam(1, $username, PDO::PARAM_STR);
    $result->bindParam(2, $password, PDO::PARAM_STR);
    $result->bindParam(3, $picture, PDO::PARAM_STR);
    $result->bindParam(4, $signature, PDO::PARAM_STR);
    $result->bindParam(5, $valid_id, PDO::PARAM_STR);
    $result->bindParam(6, $first_name, PDO::PARAM_STR);
    $result->bindParam(7, $middle_name, PDO::PARAM_STR);
    $result->bindParam(8, $last_name, PDO::PARAM_STR);
    $result->bindParam(9, $suffix, PDO::PARAM_STR);
    $result->bindParam(10, $alias, PDO::PARAM_STR);
    $result->bindParam(11, $current_date, PDO::PARAM_STR);
    $result->execute();
    $resident_id = $conn->lastInsertId();    
    insertIntoResidentInformationTable($resident_id);
    insertIntoResidentFamiltyTable($resident_id);
    insertIntoResidentCredsTable($resident_id);
    insertIntoResidentContactsTable($resident_id);
    insertIntoResidentAddressTable($resident_id);
    insertIntoResidentEmploymentTable($resident_id);
}
function insertIntoResidentInformationTable($id){
    $current_date = date("Y-m-d H:i:s");
    $conn = $GLOBALS['conn'];
    $salutation = $_POST['salutation'];
    $sex = $_POST['sex'];
    $birthdate = $_POST['birthdate'];
    $birthplace = $_POST['birthplace'];
    $civil_status = $_POST['civil'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $blood_type = $_POST['bloodType'];
    $religion = $_POST['religion'];
    $ethnic_origin = $_POST['ethnic'];
    $nationality = $_POST['nationality'];
    $precint_number = $_POST['precint'];
    $resident_id = $id; 
    $registered_voter = isset($_POST['registeredVoter']) ? 1 : 0;
    $organization_member = isset($_POST['orgMember']) ? $_POST['orgMember'] : [];
    $org_member = implode(", ", $organization_member);
    $qry = "INSERT INTO `resident_information`(`resident_id`, `salutation`, `sex`, `birthdate`, `birthplace`, `civil_status`, `height`, `weight`, `blood_type`, `religion`, `ethnic_origin`, `nationality`, `precint_number`, `registered_voter`, `organization_member`, `time_Created`) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $result = $conn->prepare($qry);
    $result->bindParam(2, $resident_id, PDO::PARAM_INT);
    $result->bindParam(3, $salutation, PDO::PARAM_STR);
    $result->bindParam(4, $sex, PDO::PARAM_STR);
    $result->bindParam(5, $birthdate, PDO::PARAM_STR);
    $result->bindParam(6, $birthplace, PDO::PARAM_STR);
    $result->bindParam(7, $civil_status, PDO::PARAM_STR);
    $result->bindParam(8, $height, PDO::PARAM_STR);
    $result->bindParam(9, $weight, PDO::PARAM_STR);
    $result->bindParam(10, $blood_type, PDO::PARAM_STR);
    $result->bindParam(11, $religion, PDO::PARAM_STR);
    $result->bindParam(12, $ethnic_origin, PDO::PARAM_STR);
    $result->bindParam(13, $nationality, PDO::PARAM_STR);
    $result->bindParam(14, $precint_number, PDO::PARAM_STR);
    $result->bindParam(15, $registered_voter, PDO::PARAM_INT);
    $result->bindParam(16, $org_member, PDO::PARAM_STR);
    $result->bindParam(17, $current_date, PDO::PARAM_STR);
    $result->execute();
}
function insertIntoResidentFamiltyTable($id){
   $conn = $GLOBALS['conn'];
   $resident_id = $id;
   $mother = $_POST['mother'];
   $father = $_POST['father'];
   $spouse = $_POST['spouse'] ?? "";
   $current_date = date("Y-m-d H:i:s");
   $qry = "INSERT INTO `resident_family`( `resident_id`, `mother_fullname`, `father_fullname`, `spouse_fullname`, time_Created) VALUES (?,?,?,?,?)";
    $result = $conn->prepare($qry);
    $result->bindParam(1, $resident_id, PDO::PARAM_INT);
    $result->bindParam(2, $mother, PDO::PARAM_STR);
    $result->bindParam(3, $father, PDO::PARAM_STR);
    $result->bindParam(4, $spouse, PDO::PARAM_STR);
    $result->bindParam(5, $current_date, PDO::PARAM_STR);
    $result->execute();

}
function insertIntoResidentCredsTable($id){
    $conn = $GLOBALS['conn'];
    $resident_id = $id;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $current_date = date("Y-m-d H:i:s");
    $qry = "INSERT INTO `resident_creds`(`resident_id`, `username`, `password`, `time_Created`) VALUES (?,?,?,?)";
    $result = $conn->prepare($qry);
    $result->bindParam(1, $resident_id, PDO::PARAM_INT);
    $result->bindParam(2, $username, PDO::PARAM_STR);
    $result->bindParam(3, $password, PDO::PARAM_STR);
    $result->bindParam(4, $current_date, PDO::PARAM_STR);
    $result->execute();
}

function insertIntoResidentContactsTable($id){
   $conn = $GLOBALS['conn'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile'];
    $tel_no = $_POST['tel'];
    $ICOE_fullname = $_POST['incaseFullname'];
    $ICOE_contact_number = $_POST['incaseContact'];
    $ICOE_address = $_POST['incaseAddress'];
    $resident_id = $id;
    $current_date = date("Y-m-d H:i:s");
    $qry = "INSERT INTO `resident_address`(`resident_id`, `email`, `mobile_number`, `tel_no`, `ICOE_fullname`, `ICOE_contact_number`, `ICOE_address`, `time_Created`) 
    VALUES (?,?,?,?,?,?,?,?)";
    $result = $conn->prepare($qry);
    $result->bindParam(1, $resident_id, PDO::PARAM_INT);
    $result->bindParam(2, $email, PDO::PARAM_STR);
    $result->bindParam(3, $mobile_number, PDO::PARAM_STR);
    $result->bindParam(4, $tel_no, PDO::PARAM_STR);
    $result->bindParam(5, $ICOE_fullname, PDO::PARAM_STR);
    $result->bindParam(6, $ICOE_contact_number, PDO::PARAM_STR);
    $result->bindParam(7, $ICOE_address, PDO::PARAM_STR);
    $result->bindParam(8, $current_date, PDO::PARAM_STR);
    $result->execute();
}
function insertIntoResidentAddressTable($id){
    $conn = $GLOBALS['conn'];
    $house_number = $_POST['houseNo'];  
    $street = $_POST['street'];
    $purok = $_POST['purok'];
    $full_address = $_POST['fullAddress'];
    $hoa = $_POST['familyHoa'];
    $resident_id = $id;
    $current_date = date("Y-m-d H:i:s");
    $qry = "INSERT INTO `resident_address`(`resident_id`, `house_number`, `street`, `purok`, `full_address`, `hoa`, `time_Created`) VALUES (?,?,?,?,?,?,?)";
    $result = $conn->prepare($qry);
    $result->bindParam(1, $resident_id, PDO::PARAM_INT);
    $result->bindParam(2, $house_number, PDO::PARAM_STR);
    $result->bindParam(3, $street, PDO::PARAM_STR);
    $result->bindParam(4, $purok, PDO::PARAM_STR);
    $result->bindParam(5, $full_address, PDO::PARAM_STR);
    $result->bindParam(6, $hoa, PDO::PARAM_STR);
    $result->bindParam(7, $current_date, PDO::PARAM_STR);
    $result->execute();
    

}
function insertIntoResidentEmploymentTable($id){
    $conn = $GLOBALS['conn'];
  $employment_status = $_POST['eStatus'];
    $employment_field = $_POST['eField'];
    $occupation = $_POST['occupation'];
    $monthly_income  = $_POST['mIncome'];
    $highest_educational_attainment = $_POST['higherEducAttain'];
    $type_of_school = $_POST['tSchool'];
    $resident_id = $id;
    $current_date = date("Y-m-d H:i:s");
    $qry = "INSERT INTO `resident_employment`(`resident_id`, `employment_status`, `employment_field`, `occupation`, `monthly_income`, `highest_educational_attainment`, `type_of_school`, `time_Created`) 
    VALUES (?,?,?,?,?,?,?,?)";
    $result = $conn->prepare($qry);
    $result->bindParam(1, $resident_id, PDO::PARAM_INT);
    $result->bindParam(2, $employment_status, PDO::PARAM_STR);
    $result->bindParam(3, $employment_field,PDO::PARAM_STR);
    $result->bindParam(4, $occupation,PDO::PARAM_STR);
    $result->bindParam(5, $monthly_income, );
    $result->bindParam(6, $highest_educational_attainment,PDO::PARAM_STR);
    $result->bindParam(7, $type_of_school,PDO::PARAM_STR);
    $result->bindParam(8, $current_date,PDO::PARAM_STR);
    $result->execute();


}
?>