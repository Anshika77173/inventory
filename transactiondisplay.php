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
</head>
<body>
    <div class="container">
        <table id="transactionTable" class="table">
            <thead>
                <tr>
                    <th scope="col">Serial Number</th>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Asset ID</th>
                    <th scope="col">Location</th>
                </tr>
                <tr>
                    <th></th>
                    <th><input type="text" placeholder="Search Employee ID"></th>
                    <th><input type="text" placeholder="Search Employee Name"></th>
                    <th><input type="text" placeholder="Search Date"></th>
                    <th><input type="text" placeholder="Search Asset ID"></th>
                    <th><input type="text" placeholder="Search Location"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM transaction";
                $result = mysqli_query($conn, $sql);
                $serial_number = 1;

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $employees_id = $row['employees_id'];
                        $employees_name = $row['employees_name'];
                        $date = $row['date'];
                        $asset_id = $row['asset_id'];
                        $location = $row['location'];
                        echo '<tr>
                                <th scope="row">' . $serial_number++ . '</th>
                                <td>' . $employees_id . '</td>
                                <td>' . $employees_name . '</td>
                                <td>' . $date . '</td>
                                <td>' . $asset_id . '</td>
                                <td>' . $location . '</td>
                              </tr>';
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found.</td></tr>";
                }
                mysqli_close($conn);
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#transactionTable thead tr:eq(1) th').each(function(i) {
                var title = $('#transactionTable thead tr:eq(0) th').eq(i).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function() {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            });

            var table = $('#transactionTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                orderCellsTop: true,
                fixedHeader: true
            });
        });
    </script>
</body>
</html>
