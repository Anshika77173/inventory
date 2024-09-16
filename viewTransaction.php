<?php
$conn = mysqli_connect("localhost:3308", "root", "", "inventory");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
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
            width: 100%;
            margin: 0 auto;
            padding-top: 2rem;
        }

        .main-content {
            max-width: 96%; /* Ensure full width */
            margin: 0 auto;
            padding: 0 1rem; /* Adjust padding if needed */
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
        
        .table {
            width: 100%; /* Ensure the table takes the full width of the container */
            border-collapse: collapse; /* Ensure borders collapse if applicable */
            overflow-x: auto; /* Allow horizontal scroll if needed */
        }
        
        .table thead th {
            background-color: var(--clr-primary);
            color: var(--clr-white);
            text-align: left; /* Align text to the left in headers */
        }
        
        .table tbody tr:hover {
            background-color: var(--clr-light);
        }
        
        .table td, .table th {
            padding: 1rem; /* Adjust padding as needed */
            border: 1px solid var(--clr-info-light); /* Optional: add borders to table cells */
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

        @media (max-width: 768px) {
            .table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .container{
                display: flex;
                width: 88%;
            }
        }
    </style>
</head>
<body>
<h1 class="text-center">VIEW DETAIL</h1>
    <div class="container" style="display: flex;width: 70%;">
        <main class="main-content">
         
            <table class="table" id="locationTable">
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Employee ID</th>
                        <th scope="col">Employee Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Asset ID</th>
                        <th scope="col">Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM transaction";
                    $result = mysqli_query($conn, $sql);
                    $serial_number = 1; // Initialize serial number

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $employees_id = $row['employees_id'];
                            $employees_name = $row['employees_name'];
                            $date = $row['date'];
                            $asset_id = $row['asset_id'];
                            $location = $row['location'];
                            echo '<tr>
                                    <th scope="row">'. $serial_number. '</th>
                                    <td>'. $employees_id. '</td>
                                    <td>'. $employees_name. '</td>
                                    <td>'. $date. '</td>
                                    <td>'. $asset_id. '</td>
                                    <td>'. $location. '</td>
                                  </tr>';
                            $serial_number++; // Increment serial number
                        }
                    } else {
                        echo "<tr><td colspan='6'>No records found.</td></tr>";
                    }
                    mysqli_close($conn); // Close the connection here
                    ?>
                </tbody>
            </table>
        </main>
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
