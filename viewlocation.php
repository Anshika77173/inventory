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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --clr-primary: #7380ec;
            --clr-danger: #ff7782;
            --clr-success: #41f1b6;
            --clr-white: #fff;
            --clr-info-dark: #7d8da1;
            --clr-info-light: #dce1eb;
            --clr-dark: #363949;
            --clr-warning: #ff4edc;
            --clr-light: rgba(132, 139, 200, 0.18);
            --clr-primary-variant: #111e88;
            --clr-dark-variant: #677483;
            --clr-color-background: #f6f6f9;
            --card-border-radius: 2rem;
            --border-radius-1: 0.4rem;
            --border-radius-2: 0.8rem;
            --border-radius-3: 1.2rem;
            --card-padding: 1.8rem;
            --padding-1: 1.2rem;
            --box-shadow: 0 2rem 3rem var(--clr-light);
        }
        
        .dark-theme-variables {
            --clr-color-background: #181a1e;
            --clr-white: #202528;
            --clr-light: rgba(0, 0, 0, 0.4);
            --clr-dark: #edeffd;
            --clr-dark-variant: #677483;
            --box-shadow: 0 2rem 3rem var(--clr-light);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: "Poppins", sans-serif;
            width: 100vw;
            height: 100vh;
            font-size: 0.88rem;
            user-select: none;
            overflow-x: hidden;
            background: var(--clr-color-background);
        }
        
        .container {
            display: grid;
            width: 96%;
            gap: 1.8rem;
            grid-template-columns: 14rem auto 14rem;
            margin: 0 auto;
            padding-top: 2rem;
        }

        .main-content {
            justify-content: center;
            align-items: center;
            max-width: 960px;
            margin: 0 15rem;
        }

        .main-content h1 {
            text-align: center;
            margin-bottom: 2rem;
            white-space: nowrap;
        }

        a {
            color: var(--clr-dark);
        }
        
        h1 {
            font-weight: 800;
            font-size: 1.8rem;
            text-align: center;
        }
        
        h2 {
            font-size: 1.4rem;
        }
        
        h3 {
            font-size: 0.87rem;
        }
        
        h4 {
            font-size: 0.8rem;
        }
        
        h5 {
            font-size: 0.77rem;
        }
        
        small {
            font-size: 0.75rem;
        }
        
        .profile-photo {
            width: 2.8rem;
            height: 2.8rem;
            border-radius: 50%;
            overflow: hidden;
        }
        
        .text-muted {
            color: var(--clr-info-dark);
        }
        
        p {
            color: var(--clr-dark-variant);
        }
        
        b {
            color: var(--clr-dark);
        }
        
        .primary {
            color: var(--clr-primary);
        }
        
        .success {
            color: var(--clr-success);
        }
        
        .danger {
            color: var(--clr-danger);
        }
        
        .warning {
            color: var(--clr-warning);
        }
        
        .table thead th {
            background-color: var(--clr-primary);
            color: var(--clr-white);
        }
        
        .table tbody tr:hover {
            background-color: var(--clr-light);
        }
        
        .btn-primary {
            background-color: var(--clr-primary);
            border-color: var(--clr-primary);
        }
        
        .btn-danger {
            background-color: var(--clr-danger);
            border-color: var(--clr-danger);
        }
        
        .btn a {
            color: var(--clr-white);
            text-decoration: none;
        }

        .btn-group {
            display: flex;
            gap: 0.5rem;
        }

        .left, .right {
            position: fixed;
            width: 14rem;
            height: calc(100vh - 1.4rem);
            overflow-y: auto;
            padding: var(--card-padding); 
            border-radius: var(--card-border-radius);
        }

        .left {
            left: 1.8rem;
        }

        .right {
            right: 1.8rem;
            
        }
    </style>
</head>
<body>
   
<div class="left">
    <!-- Left fixed content goes here -->
</div>
<div class="container">
    <div class="main-content">
    <h1>VIEW DETAILS</h1>
        <table class="table" id="locationTable">
            <thead>
                <tr>
                    <th scope="col">Serial no.</th>
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
                $counter = 1; // Initialize the counter

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $locationname = $row['locationname'];
                        $state = $row['state'];
                        $district = $row['district'];
                        $pincode = $row['pincode'];
                        $contact = $row['contact'];
                        echo '<tr>
                                <th scope="row">' . $counter++ . '</th> <!-- Increment the counter -->
                                <td>' . $locationname . '</td>
                                <td>' . $state . '</td>
                                <td>' . $district . '</td>
                                <td>' . $pincode . '</td>
                                <td>' . $contact . '</td>
                                <td class="btn-group">
                                    <button class="btn btn-primary"><a href="update.php?updateid='.$locationname.'" class="text-light">Edit</a></button>
                                    <button class="btn btn-danger"><a href="delete.php?deleteid='.$locationname.'" class="text-light">Delete</a></button>
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
</div>
<div class="right">
    <!-- Right fixed content goes here -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

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
