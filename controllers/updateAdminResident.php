<?php
 

function resizeImage($file, $max_width, $max_height) {
    list($width, $height) = getimagesize($file) ?? "";
    $ratio = $width / $height;

    if ($max_width / $max_height > $ratio) {
        $max_width = (int)($max_height * $ratio);
    } else {
        $max_height = (int)($max_width / $ratio);
    }

    $src = imagecreatefromstring(file_get_contents($file));
    $dst = imagecreatetruecolor($max_width, $max_height);

    imagecopyresampled($dst, $src, 0, 0, 0, 0, $max_width, $max_height, $width, $height);

    ob_start();
    imagejpeg($dst);
    $data = ob_get_contents();
    ob_end_clean();

    imagedestroy($src);
    imagedestroy($dst);

    return $data;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../database/databaseConnection.php';
    $conn = $GLOBALS['conn'];
    $id = $_POST['id'];
    $first_name = $_POST['first_name'] ?? "";
    $middle_name = $_POST['middle_name'] ?? "";
    $last_name = $_POST['last_name'] ?? "";
    $suffix = $_POST['suffix'] ?? "";
    $age = $_POST['age'] ?? "";
    $suffix = $_POST['suffix'] ?? "";
    $sex = $_POST['sex'] ?? "";
    $birthday = $_POST['birthdate'] ?? "";
    $birthplace  = $_POST['birthplace'] ?? "";
    $civil_status = $_POST['civil_status'] ?? "";
    $nationality = $_POST['nationality'] ?? "";
    $height = $_POST['height'] ?? "";
    $weight = $_POST['weight'] ?? "";
    $blood_type = $_POST['blood_type'] ?? "";
    $religion = $_POST['religion'] ?? "";
    $registered_voter = $_POST['registered_voter'];
    $org_member = "";
    $qry = "SELECT resident_picture, valid_id FROM residents_personal_information WHERE resident_id = $id";
    $images = $conn->prepare($qry);
    $images->execute();
    $images = $images->fetch(PDO::FETCH_ASSOC);

    $picture = isset($_FILES['picture']) && $_FILES['picture']['tmp_name'] ? base64_encode(resizeImage($_FILES['picture']['tmp_name'], 250, 250)) : $images['resident_picture'];
    $valid_id = isset($_FILES['valid_id']) && $_FILES['valid_id']['tmp_name'] ? base64_encode(resizeImage($_FILES['valid_id']['tmp_name'], 250, 250)) : $images['valid_id'] ;
    $organization_member = $_POST['organization_member'] ?? [];

    if (is_array($organization_member)) {
        foreach ($organization_member as $org) {
            $org_member .= $org . ", ";
        }
        // Remove the trailing comma and space
        $org_member = rtrim($org_member, ", ");
    }
    
    // If no organization members, set to an empty string
    if (empty($org_member)) {
        $org_member = "";
    }
    $phone_number = $_POST['mobile_no'] ?? "";
    $email = $_POST['email'] ?? "";
    $tel_no = $_POST['tel_no'] ?? "";
    $highest_educational_attainment = $_POST['highest_education'] ?? "";
    $type_of_school = $_POST['type_of_school'] ?? "";
    $house_number = $_POST['house_number'] ?? "";
    $purok = $_POST['purok'] ?? "";
    $street = $_POST['street'] ?? "";
    $employment_status = $_POST['employment_status'] ?? "";
    $employment_field = $_POST['employment_field'] ?? "";
    $monthly_income = $_POST['monthly_income'] ?? "";
    $occupation = $_POST['occupation'] ?? "";
    

       
$sql = "UPDATE residents_information SET 
    first_name = :first_name,
    middle_name = :middle_name,
    last_name = :last_name,
    suffix = :suffix,
    age = :age,
    sex = :sex,
    email = :email,
    birthday = :birthday,
    civil_status = :civil_status,
    id_front = :valid_id,
    purok = :purok,
    house_number = :house_number,
    street = :street
    WHERE id = :id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
$stmt->bindParam(':middle_name', $middle_name, PDO::PARAM_STR);
$stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
$stmt->bindParam(':suffix', $suffix, PDO::PARAM_STR);
$stmt->bindParam(':age', $age, PDO::PARAM_INT);
$stmt->bindParam(':sex', $sex, PDO::PARAM_STR);
$stmt->bindParam(':birthday', $birthday, PDO::PARAM_STR);
$stmt->bindParam(':civil_status', $civil_status, PDO::PARAM_STR);
$stmt->bindParam(':valid_id', $valid_id, PDO::PARAM_STR);
$stmt->bindParam(':purok', $purok, PDO::PARAM_STR);
$stmt->bindParam(':house_number', $house_number, PDO::PARAM_STR);
$stmt->bindParam(':street', $street, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();

    $sql1 = "UPDATE residents_personal_information SET 
        height = :height,
        weight = :weight,
        blood_type = :blood_type,
        religion = :religion,
        birth_place = :birthplace,
        nationality = :nationality,
        resident_picture = :picture,
        valid_id = :valid_id,
        registered_voter = :registered_voter,
        organization_member = :organization_member,
        time_Created = :time_Created
        WHERE resident_id = :id";

    $stmt1 = $conn->prepare($sql1);
    $stmt1->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt1->bindParam(':height', $height, PDO::PARAM_STR);
    $stmt1->bindParam(':weight', $weight, PDO::PARAM_STR);
    $stmt1->bindParam(':blood_type', $blood_type, PDO::PARAM_STR);
    $stmt1->bindParam(':religion', $religion, PDO::PARAM_STR);
    $stmt1->bindParam(':nationality', $nationality, PDO::PARAM_STR);
    $stmt1->bindParam(':picture', $picture, PDO::PARAM_STR);
    $stmt1->bindParam(':valid_id', $valid_id, PDO::PARAM_STR);
     $stmt1->bindParam(':birthplace', $birthplace, PDO::PARAM_STR);
    $stmt1->bindParam(':registered_voter', $registered_voter, PDO::PARAM_STR);
    $stmt1->bindParam(':organization_member', $org_member, PDO::PARAM_STR);
    $stmt1->bindParam(':time_Created', $time_Created, PDO::PARAM_STR);
    $stmt1->execute();

    $sql2 = "UPDATE residents_contact_information SET 
    phone_number = :phone_number,
    tel_no = :tel_no,
    time_Created = :time_Created
    WHERE resident_id = :id";

$stmt2 = $conn->prepare($sql2);
$stmt2->bindParam(':id', $id, PDO::PARAM_INT);
$stmt2->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
$stmt2->bindParam(':tel_no', $tel_no, PDO::PARAM_STR);
$stmt2->bindParam(':time_Created', $time_Created, PDO::PARAM_STR);
$stmt2->execute();
$sql3 = "UPDATE residents_additional_information SET 
    employment_status = :employment_status,
    employment_field = :employment_field,
    monthly_income = :monthly_income,
    highest_educational_attainment = :highest_educational_attainment,
    type_of_school = :type_of_school,
    occupation = :occupation,
    time_Created = :time_Created
    WHERE resident_id = :id";

$stmt3 = $conn->prepare($sql3);
$stmt3->bindParam(':id', $id, PDO::PARAM_INT);
$stmt3->bindParam(':employment_status', $employment_status, PDO::PARAM_STR);
$stmt3->bindParam(':employment_field', $employment_field, PDO::PARAM_STR);
$stmt3->bindParam(':monthly_income', $monthly_income, PDO::PARAM_STR);
$stmt3->bindParam(':highest_educational_attainment', $highest_educational_attainment, PDO::PARAM_STR);
$stmt3->bindParam(':type_of_school', $type_of_school, PDO::PARAM_STR);
$stmt3->bindParam(':occupation', $occupation, PDO::PARAM_STR);
$stmt3->bindParam(':time_Created', $time_Created, PDO::PARAM_STR);
$stmt3->execute();
echo "<script>alert('Resident Updated Successfully!');window.location.href='../views/admin/residents.php';</script>";
}

   

?>