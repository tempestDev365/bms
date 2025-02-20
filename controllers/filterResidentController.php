<?php
$filter = $_GET['filter'];
function filterResident($filter){
    include_once "../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    if($filter == 'female'){
        $qry = "SELECT * FROM residents_information WHERE sex = 'Female'";
    } else if($filter == 'male'){
        $qry = "SELECT * FROM residents_information WHERE sex = 'Male'";

    } else if($filter == 'voter'){
        $qry = "SELECT ri.* FROM residents_information 
        LEFT JOIN residents_personal_information ra ON ri.id = ra.resident_id
        WHERE ra.registered_voter = 1";
        
        

    }else if($filter == 'all'){
         $qry = "SELECT 
            r.id, r.first_name, r.middle_name, r.last_name, 
            ri.sex, ri.age,ri.resident_id, 
            a.*
        FROM 
            residents_information ri
             LEFT JOIN residents_personal_information ra ON ri.id = ra.resident_id";

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