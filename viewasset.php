<!DOCTYPE html>
<html>
<head>
    <title>Display Assets</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

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

        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            font-family: "Poppins", sans-serif;
            display: flex;
            flex-direction: column;
            background: var(--clr-color-background);
        }

        .main-container {
            display: flex;
            flex: 1;
            margin-top: 2rem;
        }

        .main-content {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
        }

        .left, .right {
            position: fixed;
            width: 14rem;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            padding: var(--card-padding);
            border-radius: var(--card-border-radius);
        }

        .left {
            left: 0;
        }

        .right {
            right: 0;
        }

        .date-filter {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .table-responsive {
            max-height: calc(100vh - 15rem); /* Adjust based on header/footer height and heading */
            overflow-y: auto;
        }

        .main-content h1 {
            text-align: center;
            margin-bottom: 2rem;
            white-space: nowrap;
            font-size: 2rem; /* Adjust font size as needed */
        }

        .table {
            font-size: 1.1rem; /* Increase font size of table text */
        }

        .table-lg {
            font-size: 1.1rem; /* Slightly larger font size for the table */
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

        .table-actions {
            display: flex;
            gap: 0.5rem; /* Spacing between buttons */
            justify-content: center; /* Center align buttons */
        }

        @media (max-width: 768px) {
            .main-content {
                margin: 0; /* Adjust margin on smaller screens */
                padding: 0; /* Adjust padding on smaller screens */
            }
        }

        @media (max-width: 576px) {
            .table thead th {
                font-size: 0.8rem; /* Adjust font size for smaller screens */
            }

            .table tbody td {
                font-size: 0.7rem; /* Adjust font size for smaller screens */
            }

            .date-filter {
                gap: 0.5rem; /* Reduce gap for smaller screens */
            }

            .btn-group {
                flex-direction: column; /* Stack buttons vertically on smaller screens */
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="left">
            <!-- Content for left aside section -->
        </div>

        <div class="main-content">
            <h1>View Detail</h1>
            
            <!-- <form method="GET" action="assetdisplay.php" class="date-filter"> -->
                <!-- <div>
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control">
                </div>
                <div>
                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control">
                </div>
                <div>
                    <label for="date_filter">Date Filter:</label>
                    <select id="date_filter" name="date_filter" class="form-control">
                        <option value="">Select a filter</option>
                        <option value="date_of_joining">Date of Joining</option>
                        <option value="asset_purchase">Asset Purchase Date</option>
                        <option value="assetissue_date">Asset Issue Date</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form> -->

            <div class="table-responsive" >
                <table class="table table-lg" id="data_Table">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Asset ID</th>
                            <th>Model No</th>
                            <th>Configuration</th>
                            <th>Brand</th>
                            <th>Processor</th>
                            <th>RAM</th>
                            <th>Storage</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>IP</th>
                            <th>Accessory</th>
                            <!-- <th>Employee ID</th>
                            <th>Destination</th>
                            <th>Department</th> -->
                            <th>Date of Joining</th>
                            <th>Asset Purchase</th>
                            <th>Issuing Date</th>
                            <th>Asset Issue</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'database.php';
                        
                        $asset_type = isset($_GET['type']) ? $_GET['type'] : '';
                        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
                        $date_filter = isset($_GET['date_filter']) ? $_GET['date_filter'] : '';

                        $sql = "SELECT * FROM assets WHERE 1";

                        if (!empty($asset_type)) {
                            if ($asset_type == 'Other') {
                                $sql .= " AND asset_type NOT IN ('Desktop', 'Laptop')";
                            } else {
                                $sql .= " AND asset_type='$asset_type'";
                            }
                        }

                        // if (!empty($start_date) && !empty($end_date)) {
                        //     if (!empty($date_filter)) {
                        //         $sql .= " AND $date_filter BETWEEN '$start_date' AND '$end_date'";
                        //     } else {
                        //         $sql .= " AND (date_of_joining BETWEEN '$start_date' AND '$end_date'
                        //                    OR asset_purchase BETWEEN '$start_date' AND '$end_date'
                        //                    OR assetissue_date BETWEEN '$start_date' AND '$end_date')";
                        //     }
                        // }

                        $result = mysqli_query($conn, $sql);
                        $serial_number = 1; // Initialize serial number

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>'. $serial_number++. '</td>';
                                echo '<td>'. $row['location']. '</td>';
                                echo '<td>'. $row['asset_type']. '</td>';
                                echo '<td>'. $row['asset_id']. '</td>';
                                echo '<td>'. $row['Model_no']. '</td>';
                                echo '<td>'. $row['configuration']. '</td>';
                                echo '<td>'. $row['brand']. '</td>';
                                echo '<td>'. $row['processor']. '</td>';
                                echo '<td>'. $row['ram']. '</td>';
                                echo '<td>'. $row['storage']. '</td>';
                                echo '<td>'. $row['username']. '</td>';
                                echo '<td>'. $row['password']. '</td>';
                                echo '<td>'. $row['ip']. '</td>';
                                echo '<td>'. $row['accessory']. '</td>';
                                // echo '<td>'. $row['employee_id']. '</td>';
                                // echo '<td>'. $row['destination']. '</td>';
                                // echo '<td>'. $row['department']. '</td>';
                                echo '<td>'. $row['date_of_joining']. '</td>';
                                echo '<td>'. $row['asset_purchase']. '</td>';
                                echo '<td>'. $row['assetissue_date']. '</td>';
                                echo '<td>'. $row['asset_issue']. '</td>';
                                echo '<td class="table-actions">
                                        <button class="btn btn-primary"><a href="assetupdate.php?updateid='. $row['asset_id']. '" class="text-light">Edit</a></button>
                                        <button class="btn btn-danger"><a href="assestdelete.php?deleteid='. $row['asset_id']. '" class="text-light">Delete</a></button>
                                      </td>';
                                echo '</tr>';
                            }
                        } else {
                            echo "<tr><td colspan='22'>No records found.</td></tr>";
                        }

                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="right">
            <!-- Content for right aside section -->
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#data_Table').DataTable();
        });
    </script>
</body>
</html>
