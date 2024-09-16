<?php
$servername = "localhost";
$port = 3308; // Update with your port number if different
$username = "root";
$password = "";
$dbname = "inventory";
$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$Device ="";
$Serial_no = "";
$purchase_vendor ="";
$purchase_date = "";
$recieving_date = "";
$asset_id = "";
$po = "";
$approved = "";
$asset = "";
$year = "";
$price ="";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['updateid'])) {
    $asset_id = $_GET['updateid'];

  
    $sql = "SELECT * FROM purchaseregister WHERE asset_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $asset_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $Device = $row['Device'];
    $Serial_no = $row['Serial_no'];
    $purchase_vendor = $row['purchase_vendor'];
    $purchase_date = $row['purchase_date'];
    $recieving_date = $row['recieving_date'];
    $po = $row['po'];
    $approved = $row['approved'];
    $asset = $row['asset'];
    $year = $row['year'];
    $price = $row['price'];
    } else {
        echo "No record found for the given asset ID.";
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Device = $_POST['Device'];
    $Serial_no = $_POST['Serial_no'];
    $purchase_vendor = $_POST['purchase_vendor'];
    $purchase_date = $_POST['purchase_date'];
    $recieving_date = $_POST['recieving_date'];
    $asset_id = $_POST['asset_id'];
    $po = $_POST['po'];
    $approved = $_POST['approved'];
    $asset = $_POST['asset'];
    $year = $_POST['year'];
    $price = $_POST['price'];

    $sql = "UPDATE purchaseregister SET Device=?,Serial_no=?, purchase_vendor=?, purchase_date=?, recieving_date=?, po=?, approved=?, asset=?, year=?, price=? WHERE asset_id=?";
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssssssss", $Device, $Serial_no, $purchase_vendor, $purchase_date, $recieving_date, $asset_id, $po, $approved, $asset, $year, $price);
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// $conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="das.css">
    <link rel="stylesheet" type="text/css" href="location.css">
    <title>Purchase Register</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            width: 100vw;
            height: 100vh;
            font-size: 0.88rem;
            user-select: none;
            overflow-x: hidden;
            background: var(--clr-color-background);
        }

        h1 {
            font-weight: 800;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        h2 {
            font-size: 1.4rem;
            text-align: center;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1.6rem;
        }

        label {
            display: block;
            margin-bottom: 0.4rem;
            font-size: 1rem;
            color: var(--clr-dark);
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1.2rem;
            font-size: 1rem;
            border: 1px solid var(--clr-info-dark);
            border-radius: var(--border-radius-1);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--clr-primary);
            box-shadow: 0 0 0 2px var(--clr-primary);
        }

        button[type="submit"] {
            width: 100%;
            padding: 0.8rem 1.2rem;
            font-size: 1rem;
            background-color: var(--clr-primary);
            color: var(--clr-white);
            border: none;
            border-radius: var(--border-radius-1);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: var(--clr-primary-variant);
        }

        iframe {
            border: none;
            width: 100%;
            height: 400px;
            margin-top: 2rem;
        }

        .dark-theme-variables label {
            color: black;
        }

        .dark-theme-variables h1 {
            color: var(--clr-white);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form id="purchase-form" action="purchaseregister.php" method="POST">
            <h1>Purchase Register</h1>
            <div class="form-group">
                <label for="device">Device</label>
                <select id="asset-type" name="Device" class="form-control" >
                <option value=""></option>
                </select>
            </div>
            <div class="form-group">
                <label for="serial_no">Serial No.</label>
                <input type="text" id="serial_no" class="form-control" name="Serial_no" placeholder="Enter a Serial No."value="<?php echo $Serial_no; ?>"required>
            </div>
            <div class="form-group">
                <label for="purchase_vendor">Purchase Vendor</label>
                <select id="vendor_name" name="purchase_vendor" class="form-control"value="<?php echo $purchase_vendor; ?>"required>
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group">
                <label for="purchase_date">Purchase Date</label>
                <input type="datetime-local" id="purchase_date" class="form-control" name="purchase_date" placeholder="Enter a Purchase Date"value="<?php echo $purchase_date; ?>"required>
            </div>
            <div class="form-group">
                <label for="receiving">Receiving Date</label>
                <input type="datetime-local" id="receiving" class="form-control" name="recieving_date" placeholder="Enter date"value="<?php echo $recieving_date; ?>"required>
            </div>
            <div class="form-group">
                <label for="asset_id">Asset ID</label>
                <input type="text" id="asset_id" class="form-control" name="asset_id" placeholder="Enter Asset ID" value="<?php echo $asset_id; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="po">PO no.</label>
                <input type="text" id="po" class="form-control" name="po" placeholder="Enter PO no."value="<?php echo $po; ?>"required>
            </div>
            <div class="form-group">
                <label for="approved">Approved BY</label>
                <input type="text" id="approved" class="form-control" name="approved" placeholder="Enter Approved BY"value="<?php echo $approved; ?>"required>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <select name="asset" id="location" class="form-control">
                    <option value="">Select a location</option>
                </select>
            </div>
            <div class="form-group">
                <label for="year">Warranty</label>
                <select id="year" name="year" class="form-control"value="<?php echo $year; ?>"required>
                    <option value="">Select a Warranty</option>
                    <option value="1">1 Year</option>
                    <option value="2">2 Year</option>
                    <option value="3">3 Year</option>
                    <option value="4">4 Year</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Original Price</label>
                <input type="text" id="price" class="form-control" name="original_price" placeholder="Enter the original price" oninput="calculateTotalAmount()"value="<?php echo $price; ?>"required>
            </div>
            <div class="form-group">
                <label for="gst_rate">GST Rate (%)</label>
                <input type="text" id="gst_rate" class="form-control" name="gst_rate" placeholder="Enter GST Rate" oninput="calculateTotalAmount()">
            </div>
            <div class="form-group">
                <span id="total-amount">Total Amount: ₹ 0.00</span>
            </div>
            <input type="hidden" id="total_price" name="price"value="<?php echo $price; ?>"required>
            <button type="submit">Submit</button>
        </form>
    </div>
    <script>
        // Fetch location data from location.php
        fetch('location.php')
    .then(response => response.json())
    .then(data => {
        const selectElement = document.getElementById('location');
        data.forEach(location => {
            const optionElement = document.createElement('option');
            optionElement.value = location;
            optionElement.text = location;
            selectElement.appendChild(optionElement);
        });
    })
    .catch(error => console.error('Error fetching locations:', error));

    </script>
   
    <script>
        function applyTheme(theme) {
            if (theme === 'dark') {
                document.body.classList.add('dark-theme-variables');
                document.querySelectorAll('.form-control').forEach(input => input.classList.add('dark-theme-variables'));
                document.querySelector('form').classList.add('dark-theme-variables');
                document.querySelector('button').classList.add('dark-theme-variables');
            } else {
                document.body.classList.remove('dark-theme-variables');
                document.querySelectorAll('.form-control').forEach(input => input.classList.remove('dark-theme-variables'));
                document.querySelector('form').classList.remove('dark-theme-variables');
                document.querySelector('button').classList.remove('dark-theme-variables');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const theme = localStorage.getItem('theme');
            applyTheme(theme);
        });

        window.addEventListener('storage', () => {
            const theme = localStorage.getItem('theme');
            applyTheme(theme);
        });

        fetch('asset.php?type=asset_type', {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            const assetTypeSelect = document.getElementById('asset-type');
            data.forEach(assetType => {
                const option = document.createElement('option');
                option.value = assetType;
                option.text = assetType;
                assetTypeSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));

        fetch('vendor.php', {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            const vendorNameSelect = document.getElementById('vendor_name');
            data.forEach(vendorName => {
                const option = document.createElement('option');
                option.value = vendorName;
                option.text = vendorName;
                vendorNameSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));

        function calculateTotalAmount() {
            var originalPrice = parseFloat(document.getElementById("price").value) || 0;
            var gstRate = parseFloat(document.getElementById("gst_rate").value) || 0;
            var gstAmount = originalPrice * (gstRate / 100);
            var totalAmount = originalPrice + gstAmount;
            document.getElementById("total-amount").innerHTML = "Total Amount: ₹ " + totalAmount.toFixed(2);
            document.getElementById("total_price").value = totalAmount.toFixed(2); // Store the total amount in a hidden input field
        }

        document.addEventListener("DOMContentLoaded", function() {
            calculateTotalAmount();
        });

        document.getElementById("price").addEventListener("input", function() {
            calculateTotalAmount();
        });

        document.getElementById("gst_rate").addEventListener("input", function() {
            calculateTotalAmount();
        });

        document.getElementById("purchase-form").addEventListener("submit", function(event) {
            calculateTotalAmount(); // Ensure the calculation is up-to-date before submission
        });
    </script>

    <script src="script.js"></script>
    <h2 class="existing" style="text-align: center;">Existing Purchase Register</h2>
    <iframe src="purchaseregisterdisplay.php" style="width:100%; height:400px; border:none;"></iframe>
</body>
</html>
