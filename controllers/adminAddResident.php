<?php

ini_set("display_errors", "1");
error_reporting(E_ALL);

include_once '../database/databaseConnection.php';
session_start();

// Resize Image Function
function resizeImage($file, $max_width, $max_height) {
    list($width, $height) = getimagesize($file);
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

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validate and sanitize input
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $middleName = htmlspecialchars($_POST['middle_name']);
    $suffix = $_POST['suffix'] ?? "";
    $sex = $_POST['sex'];
    $birthDate = $_POST['birthdate'];
    $age = isset($_POST['age']) ? (int)$_POST['age'] : 0;  // Explicit integer conversion
    $civil_status = $_POST['civil_status'];
    $purok = $_POST['purok'];
    $house_number = $_POST['house_number'];
    $street = $_POST['street'];
    $birthplace = $_POST['birthplace'];
    $height = $_POST['height'] ?? "";
    $weight = $_POST['weight'] ?? "";
    $blood_type = $_POST['blood_type'] ?? "";
    $religion = $_POST['religion'] ?? "";
    $nationality = $_POST['national'] ?? "";
    $registered_voter = $_POST['registered_voter'] ?? "";
    $organization_member = $_POST['organization_member'] ?? [];
    $org_member = "";

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
    $monthly_income = $_POST['monthly_income'] ?? "";
    $highest_educational_attainment = $_POST['highest_educational_attainment'] ?? "";
    $type_of_school = $_POST['type_of_school'] ?? "";
    $occupation = $_POST['occupation'] ?? "";
    $phone_number = $_POST['phone_number'] ?? "";
    $tel_no = $_POST['tel_no'] ?? "";

    // Handle file uploads safely
    $picture = "";
    if (isset($_FILES['picture']['tmp_name']) && file_exists($_FILES['picture']['tmp_name'])) {
        $picture = base64_encode(resizeImage($_FILES['picture']['tmp_name'], 250, 250));
    }

    $valid_id = "";
    if (isset($_FILES['valid_id']['tmp_name']) && file_exists($_FILES['valid_id']['tmp_name'])) {
        $valid_id = base64_encode(resizeImage($_FILES['valid_id']['tmp_name'], 250, 250));
    }

    try {
        // Start transaction
        $conn->beginTransaction();

        // Insert into `residents_information`
        $qry = "INSERT INTO residents_information (first_name, middle_name, last_name,suffix, sex, age, birthday, civil_status, purok, house_number, street,  time_Created) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,  NOW())";
        $stmt = $conn->prepare($qry);
        $stmt->execute([
            $firstName, $middleName, $lastName, $suffix, $sex, $age, $birthDate,
            $civil_status, $purok, $house_number, $street
        ]);
        $id = $conn->lastInsertId();

        // Insert into `residents_personal_information`
        $insert_into_personal = "INSERT INTO residents_personal_information 
            (resident_id, birth_place, resident_picture, valid_id, height, weight, blood_type, religion, nationality, registered_voter, organization_member, time_Created) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($insert_into_personal);
        $stmt->execute([$id, $birthplace, $picture, $valid_id, $height, $weight, $blood_type, $religion, $nationality, $registered_voter, $org_member]);

        // Insert into `residents_contact_information`
        $insert_into_contact = "INSERT INTO residents_contact_information (resident_id, phone_number, tel_no, time_Created) 
            VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($insert_into_contact);
        $stmt->execute([$id, $phone_number, $tel_no]);

        // Insert into `residents_additional_information`
        $insert_into_additional = "INSERT INTO residents_additional_information (resident_id, employment_status, employment_field, monthly_income, highest_educational_attainment, type_of_school, occupation, time_Created) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($insert_into_additional);
        $stmt->execute([$id, $employment_status, $employment_field, $monthly_income, $highest_educational_attainment, $type_of_school, $occupation]);

        // Commit transaction
        $conn->commit();

        // Unset session and redirect
        unset($_SESSION['email']);
        header("Location: ../views/admin/addResident.php?status=success");
        exit();

    } catch (PDOException $e) {
        // Rollback if an error occurs
        $conn->rollBack();
        die("Database Error: " . $e->getMessage());
    }
}
?>