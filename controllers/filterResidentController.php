<?php
$filter = $_GET['filter'];
function filterResident($filter){
    include_once "../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    if($filter == 'female'){
        $qry = "SELECT 
            r.id, r.first_name, r.middle_name, r.last_name, 
            ri.sex, ri.age,ri.resident_id, 
            a.*
        FROM 
            approved_tbl a
        LEFT JOIN 
            residents_tbl r ON a.resident_id = r.id
        LEFT JOIN 
            resident_information ri ON r.id = ri.resident_id
        WHERE 
            ri.sex = 'female'
        ";
    } else if($filter == 'male'){
        $qry = "SELECT 
            r.id, r.first_name, r.middle_name, r.last_name, 
            ri.sex, ri.age,ri.resident_id, 
            a.*
        FROM 
            approved_tbl a
        LEFT JOIN 
            residents_tbl r ON a.resident_id = r.id
        LEFT JOIN 
            resident_information ri ON r.id = ri.resident_id
        WHERE 
            ri.sex = 'male'
        ";
    } else if($filter == 'voter'){
        $qry = "SELECT 
            r.id, r.first_name, r.middle_name, r.last_name, 
            ri.sex, ri.age,ri.resident_id, 
            a.*
        FROM 
            approved_tbl a
        LEFT JOIN 
            residents_tbl r ON a.resident_id = r.id
        LEFT JOIN 
            resident_information ri ON r.id = ri.resident_id
        WHERE 
            ri.registered_voter = 1
        ";
    }else if($filter == 'all'){
         $qry = "SELECT 
            r.id, r.first_name, r.middle_name, r.last_name, 
            ri.sex, ri.age,ri.resident_id, 
            a.*
        FROM 
            approved_tbl a
        LEFT JOIN 
            residents_tbl r ON a.resident_id = r.id
        LEFT JOIN 
            resident_information ri ON r.id = ri.resident_id";
    }
    $result = $conn->prepare($qry);
    $result->execute();
    $residents = $result->fetchAll(PDO::FETCH_ASSOC);
    return $residents;
}

if($filter){
    header('Content-Type: application/json');
    echo json_encode(filterResident($filter));
}
?>