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
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $middleName = $_POST['middle_name'] ?? "";
    $suffix = $_POST['suffix'] ?? "";
    $sex = $_POST['sex'];
    $birthDate = $_POST['birthday'];
    $age = isset($_POST['age']) ? (int)$_POST['age'] : 0;  // Explicit integer conversion
    $registered_voter = "No";  // Default to "No" if not provided


    // Ensure required fields are set
    $middle_name = isset($_POST['middle_name']) ? htmlspecialchars($_POST['middle_name']) : '';
    $civil_status = isset($_POST['civil_status']) ? htmlspecialchars($_POST['civil_status']) : '';
    $purok = isset($_POST['purok']) ? htmlspecialchars($_POST['purok']) : '';
    $house_number = isset($_POST['house_number']) ? htmlspecialchars($_POST['house_number']) : '';
    $street = isset($_POST['street']) ? htmlspecialchars($_POST['street']) : '';
    $house_owner = isset($_POST['house_owner']) ? htmlspecialchars($_POST['house_owner']) : '';
    $employment_status = isset($_POST['employment_status']) ? htmlspecialchars($_POST['employment_status']) : '';

    // Handle file uploads safely
    $front_id = isset($_FILES['frontID']['tmp_name']) && file_exists($_FILES['backID']['tmp_name']) ? base64_encode(resizeImage($_FILES['backID']['tmp_name'], 250, 250)) : null;
    

    $back_id = isset($_FILES['backID']['tmp_name']) && file_exists($_FILES['backID']['tmp_name']) ? base64_encode(resizeImage($_FILES['backID']['tmp_name'], 250, 250)) : null;
    

    try {
        // Start transaction
        $conn->beginTransaction();

        // Insert into `residents_information`
        $qry = "INSERT INTO residents_information (first_name, middle_name, last_name, email, suffix, sex, age, birthday, civil_status, purok, house_number, street, house_owner, id_front, id_back, time_Created) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($qry);
        $stmt->execute([
            $firstName, $middleName, $lastName, $email, $suffix, $sex, $age, $birthDate,
            $civil_status, $purok, $house_number, $street, $house_owner, $front_id, $back_id
        ]);
        $id = $conn->lastInsertId();

        // Insert into `residents_personal_information`
        $insert_into_personal = "INSERT INTO residents_personal_information 
            (resident_id, birth_place, resident_picture, valid_id, height, weight, blood_type, religion, nationality, registered_voter, organization_member, time_Created) 
            VALUES (?, '', '', '', ?, ?, '', '', '', ?, '', NOW())";
        $stmt = $conn->prepare($insert_into_personal);
        $height = 0;  // Default to 0 if not provided
        $weight = 0;  // Default to 0 if not provided
        $stmt->execute([$id, $height, $weight, $registered_voter]);

        // Insert into `residents_contact_information`
        $insert_into_contact = "INSERT INTO residents_contact_information (resident_id, phone_number,tel_no, time_Created) 
            VALUES (?, '',  '', NOW())";
        $stmt = $conn->prepare($insert_into_contact);
        $stmt->execute([$id,]);

        // Insert into `residents_additional_information`
        $insert_into_additional = "INSERT INTO residents_additional_information (resident_id, employment_status, employment_field, monthly_income, highest_educational_attainment, type_of_school, occupation, time_Created) 
            VALUES (?, ?, '', '', '', '', '', NOW())";
        $stmt = $conn->prepare($insert_into_additional);
        $stmt->execute([$id, $employment_status]);

        // Commit transaction
        $conn->commit();

        // Unset session and redirect
        unset($_SESSION['email']);
        header("Location: ../views/residents/residentLogin.php?success=1");
        exit();

    } catch (PDOException $e) {
        // Rollback if an error occurs
        $conn->rollBack();
        die("Database Error: " . $e->getMessage());
    }
}
?>
