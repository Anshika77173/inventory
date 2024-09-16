<!DOCTYPE html>
<html>
<head>
    <title>Display Assets</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <style>
        .container {
            padding-top: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 8px;
            border: 1px solid #dddddd;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table tr:hover {
            background-color: #e9ecef;
        }
        .table-actions {
            display: flex;
            gap: 5px;
        }
        .table-actions a {
            text-decoration: none;
            color: white;
        }
        .date-filter {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .date-filter label {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <!-- <form method="GET" action="assetdisplay.php" class="date-filter">
            <div>
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
        </form>
        -->

        <div class="table-responsive">
            <table id="assetTable" class="table display">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Asset ID</th>
                        <th>Model No</th>
                        <th>Configuration/SIM NO.</th>
                        <th>Brand</th>
                        <th>IMEI</th>
                        <th>Serial_no.</th>
                        <th>Processor</th>
                        <th>RAM</th>
                        <th>Storage</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>IP</th>
                        <th>Accessory</th>
                        <!-- <th>Employee ID</th>
                        <th>Designation</th>
                        <th>Department</th> -->
                        <th>Date of Joining</th>
                        <th>Asset Purchase</th>
                        <th>Issuing Date</th>
                        <th>Asset Issue</th>
                        <th>Actions</th>
                    </tr>
                    <tr>
                        <th><input type="text" placeholder="Search Location" /></th>
                        <th><input type="text" placeholder="Search Type" /></th>
                        <th><input type="text" placeholder="Search Asset ID" /></th>
                        <th><input type="text" placeholder="Search Model No" /></th>
                        <th><input type="text" placeholder="Search Configuration/SIM NO." /></th>
                        <th><input type="text" placeholder="Search Brand" /></th>
                        <th><input type="text" placeholder="Search IMEI" /></th>
                        <th><input type="text" placeholder="Search Serial_no." /></th>
                        <th><input type="text" placeholder="Search Processor" /></th>
                        <th><input type="text" placeholder="Search RAM" /></th>
                        <th><input type="text" placeholder="Search Storage" /></th>
                        <th><input type="text" placeholder="Search Username" /></th>
                        <th><input type="text" placeholder="Search Password" /></th>
                        <th><input type="text" placeholder="Search IP" /></th>
                        <th><input type="text" placeholder="Search Accessory" /></th>
                        <!-- <th><input type="text" placeholder="Search Employee ID" /></th>
                        <th><input type="text" placeholder="Search Designation" /></th>
                        <th><input type="text" placeholder="Search Department" /></th> -->
                        <th><input type="text" placeholder="Search Date of Joining" /></th>
                        <th><input type="text" placeholder="Search Asset Purchase" /></th>
                        <th><input type="text" placeholder="Search Issuing Date" /></th>
                        <th><input type="text" placeholder="Search Asset Issue" /></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'database.php';

                    $asset_type = isset($_GET['type']) ? $_GET['type'] : '';
                    // $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                    // $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
                    // $date_filter = isset($_GET['date_filter']) ? $_GET['date_filter'] : '';

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

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>'. $row['location']. '</td>';
                            echo '<td>'. $row['asset_type']. '</td>';
                            echo '<td>'. $row['asset_id']. '</td>';
                            echo '<td>'. $row['Model_no']. '</td>';
                            echo '<td>'. $row['configuration']. '</td>';
                            echo '<td>'. $row['brand']. '</td>';
                            echo '<td>'. $row['IMEI']. '</td>';
                            echo '<td>'. $row['Serial_no']. '</td>';
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
                        echo "<tr><td colspan='21'>No records found.</td></tr>";
                    }

                    mysqli_close($conn);
                   ?>
                </tbody>
            </table>
        </div>
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
  var table = $('#assetTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 
      {
        extend: 'csv',
        title: 'Asset Management',
        exportOptions: {
          columns: ':visible',
          format: {
            header: function (data, columnIdx) {
              return $('th:eq(' + columnIdx + ')', table.table().header()).text().trim();
            }
          }
        }
      }, 
      {
        extend: 'excel',
        title: 'Asset Management',
        exportOptions: {
          columns: ':visible',
          format: {
            header: function (data, columnIdx) {
              return $('th:eq(' + columnIdx + ')', table.table().header()).text().trim();
            }
          }
        }
      }, 
      {
        extend: 'pdf',
        title: 'Asset Management',
        exportOptions: {
          columns: ':visible',
          format: {
            header: function (data, columnIdx) {
              return $('th:eq(' + columnIdx + ')', table.table().header()).text().trim();
            }
          }
        }
      }, 
      {
        extend: 'print',
        title: 'Asset Management',
        autoPrint: true,
        customize: function (win) {
          $(win.document.body)
            .css('font-size', '10pt')
            .prepend(
              '<h3>Asset Management</h3>'
            );

          $(win.document.body).find('table')
            .addClass('compact')
            .css('font-size', 'inherit');

          // Add table headers
          var tableHeaders = $(win.document.body).find('table thead tr').clone();
          $(win.document.body).find('table').prepend(tableHeaders);
        },
        exportOptions: {
          columns: ':visible',
          format: {
            header: function (data, columnIdx) {
              return $('th:eq(' + columnIdx + ')', table.table().header()).text().trim();
            }
          }
        }
      }
    ]
  });

  // Apply the search
  table.columns().every(function () {
    var that = this;

    $('input', this.header()).on('keyup change clear', function () {
      if (that.search() !== this.value) {
        that.search(this.value).draw();
      }
    });
  });
});
    </script>
    
</body>
</html>
