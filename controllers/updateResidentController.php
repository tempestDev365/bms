<?php
session_start();
function resizeImage($file, $max_width, $max_height) {
    list($width, $height) = getimagesize($file) ?? "";
    $ratio = $width / $height;

    if ($max_width / $max_height > $ratio) {
        $max_width = $max_height * $ratio;
    } else {
        $max_height = $max_width / $ratio;
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
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include "../database/databaseConnection.php";
    $id = $_SESSION['user_id'];
    $qry = "SELECT resident_picture,valid_id FROM  residents_personal_information WHERE resident_id = $id";
    $images = $conn->prepare($qry);
    $images->execute();
    $images = $images->fetch(PDO::FETCH_ASSOC);
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $suffix = $_POST['suffix'];
    $age = $_POST['age'];
    $birthdate = $_POST['birthdate'];
    $civil_status = $_POST['civil_status'];
    $purok = $_POST['purok'];
    $house_number = $_POST['house_number'];
    $street = $_POST['street'];
    $birthplace = $_POST['birthplace'] ?? "";
    $height = $_POST['height'] ?? "";
    $weight = $_POST['weight'] ?? "";
    $blood_type = $_POST['blood_type'] ?? "";
    $religion = $_POST['religion'] ?? "";
    $nationality = $_POST['nationality'] ?? "";
    $registered_voter = $_POST['registered_voter'] ?? "";
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
    $employment_status = $_POST['employment_status'] ?? "";
    $employment_field = $_POST['employment_field'] ?? "";
    $occupation = $_POST['occupation'] ?? "";
    $monthly_income = $_POST['monthly_income'] ?? "";
    $highest_education = $_POST['highest_education'] ?? "";
    $type_of_school = $_POST['type_of_school'] ?? "";
    $mobile_no = $_POST['mobile_no'] ?? "";
    $email = $_POST['email'] ?? "";
    $tel_no = $_POST['tel_no'] ?? "";
    $picture = isset($_FILES['picture']) && $_FILES['picture']['tmp_name']  ? base64_encode(resizeImage($_FILES['picture']['tmp_name'],250,250)) : $images['resident_picture'] ?? "";
    $valid_id = isset($_FILES['valid_id'])  && $_FILES['valid_id']['tmp_name']  ? base64_encode(resizeImage($_FILES['valid_id']['tmp_name'],250,250)) : $images['valid_id'] ?? "";
    $resident_id = $id; 

    $sql = "UPDATE residents_information SET 
                first_name = '$first_name',
                middle_name = '$middle_name',
                last_name = '$last_name',
                email = '$email',
                suffix = '$suffix',
                age = '$age',
                birthday = '$birthdate',
                civil_status = '$civil_status',
                purok = '$purok',
                house_number = '$house_number',
                street = '$street'
            WHERE id = $id";
    $result = $conn->query($sql);

    $sql1 = "UPDATE residents_personal_information SET 
                resident_id = '$resident_id',
                birth_place = '$birthplace',
                resident_picture = '$picture',
                valid_id = '$valid_id',
                height = '$height',
                weight = '$weight',
                blood_type = '$blood_type',
                religion = '$religion',
                nationality = '$nationality',
                registered_voter = '$registered_voter',
                organization_member = '$org_member'
            WHERE resident_id = $id"; 
    $result1 = $conn->query($sql1);

    $sql2 = "UPDATE residents_additional_information SET 
                resident_id = '$resident_id',
                employment_status = '$employment_status',
                employment_field = '$employment_field',
                monthly_income = '$monthly_income',
                highest_educational_attainment = '$highest_education',
                type_of_school = '$type_of_school',
                occupation = '$occupation'
            WHERE resident_id = $id";
    $result2 = $conn->query($sql2);

    $sql3 = "UPDATE residents_contact_information SET 
                resident_id = '$resident_id',
                phone_number = '$mobile_no',
                email = '$email',
                tel_no = '$tel_no'
            WHERE resident_id = $id";
    $result3 = $conn->query($sql3);
     
}
?>