<?php
include_once "../../database/databaseConnection.php";
    $conn = $GLOBALS['conn'];
    $qry = "SELECT house_number, purok, street, COUNT(*) as total_household
        FROM residents_information 
       
        GROUP BY house_number, purok, street";
    $result = $conn->prepare($qry);
    $result->execute();
    $household = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brgy. Sinbanali</title>
    <link rel="shortcut icon" href="../../assets/img/logo-125.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">
    <style>
        table th, table td {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="main-container d-flex" style="min-height: 100vh; min-width: 100%">
        <div class="admin-sidebar">
           
        </div>

        <div class="admin-content flex-grow-1 p-4 bg-light" style="max-height: 100vh; overflow-y: scroll">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">BMS</li>
                  <li class="breadcrumb-item"><a href="./issuedClearance.html" class="text-dark">Household</a></li>
                </ol>
              </nav>
              

            <div class="container-fluid p-3 shadow-sm border rounded bg-white">
                <h1 class="mb-3 text-center">Household</h1>
                    <table class="table table-bordered nowrap table-hover mt-3" id="example">
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
               
            </div>

        </div>
    <div class="modal fade" id="householdModal" tabindex="-1" aria-labelledby="householdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="householdModalLabel">Household Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
        
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script src="../components/sidebar.js?v=<?php echo time(); ?>" defer></script>
    <script>  
    
        $('#genderFilter').on('change', function() {
            var filterValue = $(this).val();
            var table = $('#example').DataTable();
            table.column(2).search(filterValue === 'all' ? '' : filterValue, true, false).draw();
        });
    const deleteOfficial = (id) => {
        if(confirm('Are you sure you want to delete this official?')){
            window.location.href = `./officialsOptionsController.php?action=delete&id=${id}`;
        }
    }
    const editOfficial = (id) => {
      const form = document.querySelector('form');
        form.action = `../../controllers/officialsOptionsController.php?action=edit&id=${id}`;
        
    }

    async function viewMembers(house_number) {
        const api = await fetch(`../../controllers/viewHouseholdMembers.php?house_number=${house_number ?? " "}&action=view`);
        const response = await api.json();
        populateModal(response);
    }

    function populateModal(data) {
        let modalContent = '';
        data.forEach(member => {
            modalContent += `
                <div>
                    <p>Name: ${member.first_name} ${member.middle_name} ${member.last_name}</p>
                    <p>Age: ${member.age}</p>
                    <p>Sex: ${member.sex}</p>
                </div>
            `;
        });
        document.getElementById('modalContent').innerHTML = modalContent;
    }
    </script>

    
</body>
</html>

