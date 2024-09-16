<?php
include 'purchaseregister.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.1/css/buttons.dataTables.min.css">
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
   
    <table class="table" id="assetTable">
        <thead>
            <tr>
                <th scope="col">Serial no.</th>
                <th scope="col">Device</th>
                <th scope="col">Serial No.</th>
                <th scope="col">Purchase Vendor</th>
                <th scope="col">Purchase Date</th>
                <th scope="col">Receiving Date</th>
                <th scope="col">Asset ID</th>
                <th scope="col">PO</th>
                <th scope="col">Approved</th>
                <th scope="col">Location</th>
                <th scope="col">Warranty</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
            <tr>
                <th><input type="text" placeholder="Search Serial no." /></th>
                <th><input type="text" placeholder="Search Device" /></th>
                <th><input type="text" placeholder="Search Serial No." /></th>
                <th><input type="text" placeholder="Search Purchase Vendor" /></th>
                <th><input type="text" placeholder="Search Purchase Date" /></th>
                <th><input type="text" placeholder="Search Receiving Date" /></th>
                <th><input type="text" placeholder="Search Asset ID" /></th>
                <th><input type="text" placeholder="Search PO" /></th>
                <th><input type="text" placeholder=" Approved BY" /></th>
                <th><input type="text" placeholder="Search Location" /></th>
                <th><input type="text" placeholder="Search Warranty" /></th>
                <th><input type="text" placeholder="Search Price" /></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'purchaseregister.php';

            if (isset($_GET['start_date']) && isset($_GET['end_date']) && isset($_GET['date_filter'])) {
                $start_date = $_GET['start_date'];
                $end_date = $_GET['end_date'];
                $date_filter = $_GET['date_filter'];

                $sql = "SELECT * FROM purchaseregister WHERE 1 ";

                if ($date_filter == 'purchase_date') {
                    $sql .= " AND purchase_date BETWEEN '$start_date' AND '$end_date'";
                } elseif ($date_filter == 'recieving_date') {
                    $sql .= " AND recieving_date BETWEEN '$start_date' AND '$end_date'";
                }

                $result = mysqli_query($conn, $sql);
                $serial_number = 1; // Initialize serial number

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $Device = $row['Device'];
                        $Serial_no = $row['Serial_no'];
                        $purchase_vendor = $row['purchase_vendor'];
                        $purchase_date = $row['purchase_date'];
                        $recieving_date = $row['recieving_date'];
                        $asset_id = $row['asset_id'];
                        $po = $row['po'];
                        $approved = $row['approved'];
                        $asset = $row['asset'];
                        $year = $row['year'];
                        $price = $row['price'];
                        echo '<tr>
                                <th scope="row">' . $serial_number++ . '</th>
                                <td>' . $Device . '</td>
                                <td>' . $Serial_no . '</td>
                                <td>' . $purchase_vendor . '</td>
                                <td>' . $purchase_date . '</td>
                                <td>' . $recieving_date . '</td>
                                 <td>' . $asset_id . '</td>
                                  <td>' . $po . '</td>
                                   <td>' . $approved . '</td>
                                    <td>' . $asset . '</td>
                                <td>' . $year . '</td>
                                <td>' . $price . '</td>
                              </tr>';
                    }
                } else {
                    echo "<tr><td colspan='8'>No records found.</td></tr>";
                }
            } else {
                // Display all records if no filter is applied
                $sql = "SELECT * FROM purchaseregister";
                $result = mysqli_query($conn, $sql);
                $serial_number = 1; // Initialize serial number

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $Device = $row['Device'];
                        $Serial_no = $row['Serial_no'];
                        $purchase_vendor = $row['purchase_vendor'];
                        $purchase_date = $row['purchase_date'];
                        $recieving_date = $row['recieving_date'];
                        $asset_id = $row['asset_id'];
                        $po = $row['po'];
                        $approved = $row['approved'];
                        $asset = $row['asset'];
                        $year = $row['year'];
                        $price = $row['price'];
                        echo '<tr>
                                <th scope="row">' . $serial_number++ . '</th>
                                <td>' . $Device . '</td>
                                <td>' . $Serial_no . '</td>
                                <td>' . $purchase_vendor . '</td>
                                <td>' . $purchase_date . '</td>
                                <td>' . $recieving_date . '</td>
                                 <td>' . $asset_id . '</td>
                                  <td>' . $po . '</td>
                                   <td>' . $approved . '</td>
                                    <td>' . $asset . '</td>
                                <td>' . $year . '</td>
                                <td>' . $price . '</td>';
                                                            echo '<td class="table-actions">
                                    <button class="btn btn-primary"><a href="purchaseregisterupdate.php?updateid='. $row['asset_id']. '" class="text-light">Edit</a></button>
                                    <button class="btn btn-danger"><a href="purchaseregisterdelete.php?deleteid='. $row['asset_id']. '" class="text-light">Delete</a></button>
          
                                    </td>';
                              '</tr>';
                    }
                } else {
                    echo "<tr><td colspan='8'>No records found.</td></tr>";
                }
            }
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<script>
   $(document).ready(function() {
    var table = $('#assetTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    format: {
                        header: function (data, columnIdx) {
                            return $('#assetTable thead tr:first th:eq(' + columnIdx + ')').text().trim();
                        }
                    }
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    format: {
                        header: function (data, columnIdx) {
                            return $('#assetTable thead tr:first th:eq(' + columnIdx + ')').text().trim();
                        }
                    }
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    format: {
                        header: function (data, columnIdx) {
                            return $('#assetTable thead tr:first th:eq(' + columnIdx + ')').text().trim();
                        }
                    }
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    format: {
                        header: function (data, columnIdx) {
                            return $('#assetTable thead tr:first th:eq(' + columnIdx + ')').text().trim();
                        }
                    }
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    format: {
                        header: function (data, columnIdx) {
                            return $('#assetTable thead tr:first th:eq(' + columnIdx + ')').text().trim();
                        }
                    }
                }
            }
        ]
    });

    // Apply the search
    table.columns().every(function() {
        var that = this;

        $('input', this.header()).on('keyup change', function() {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });
});
</script>
</body>
</html>
