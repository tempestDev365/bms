
<?php
include_once "../../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    $qry = "SELECT ra.house_number, ra.purok, ra.street, COUNT(*) as total_household
        FROM approved_tbl a
        LEFT JOIN residents_address ra ON a.resident_id = ra.resident_id
        GROUP BY ra.house_number, ra.purok, ra.street";
    $result = $conn->prepare($qry);
    $result->execute();
    $household = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Household</title>
</head>
<body>
    <table>
        <thead>
            <th>House Number</th>
            <th>Household member</th>
            <th>Purok</th>
            <th>Street</th>
        </thead>
        <tbody>
            <?php foreach($household as $house): ?>
                <tr onclick="viewMembers(<?php echo $house['house_number']; ?>)">
                    <td><?php echo $house['house_number']; ?></td>
                    <td><?php echo $house['total_household']; ?></td>
                    <td><?php echo $house['purok']; ?></td>
                    <td><?php echo $house['street']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
<script>
    //gawan mo nalang modal tapos gawin mo yung populateModal function
    async function viewMembers(house_number){
      const api = await fetch(`../../controllers/viewHouseholdMembers.php?house_number=${house_number ?? " "}&action=view`);
      const response = await api.json();
      //ganto structure nunung marreereceive na data
      /*
      first_name
      middle_name
      last_name
      age
      sex

      */
      populateModal()
      
    }
    //lagay mo lahat yung mga parameters
    function populateModal(){
        // lagay mo nalang lahat dyan 
        //tapos document.getElementById('modal').innerHTML = ``
    }
    
</script>