<?php
include 'database.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.1/css/buttons.dataTables.min.css">
    <style>
        .btn-group {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    
    <table id="locationTable" class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Location Name</th>
                <th scope="col">State</th>
                <th scope="col">District</th>
                <th scope="col">Pin Code</th>
                <th scope="col">Contact</th>
                <th scope="col">Operation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM location";
            $result = mysqli_query($conn, $sql);
            $counter = 1;

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $locationname = $row['locationname'];
                    $state = $row['state'];
                    $district = $row['district'];
                    $pincode = $row['pincode'];
                    $contact = $row['contact'];
                    echo '<tr>
                            <th scope="row">' . $counter++ . '</th>
                            <td>' . $locationname . '</td>
                            <td>' . $state . '</td>
                            <td>' . $district . '</td>
                            <td>' . $pincode . '</td>
                            <td>' . $contact . '</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-primary"><a href="update.php?updateid='.$locationname.'" class="text-light">Edit</a></button>
                                    <button class="btn btn-danger"><a href="delete.php?deleteid='.$locationname.'" class="text-light">Delete</a></button>
                                </div>
                            </td>
                          </tr>';
                }
            } else {
                echo "<tr><td colspan='7'>No records found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.1/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        $('#locationTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
</body>
</html>
