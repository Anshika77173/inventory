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

$location = "";
$asset_type = "";
$asset_id = "";
$Model_no="";
$configuration="";
$brand ="";
$IMEI="";
$Serial_no="";
$processor = "";
$ram = "";
$storage ="";
$username_db = ""; 
$password_db = "";
$ip = "";
$accessory =""; 
// $employee_id = "";
// $destination ="";
// $department = "";
$date_of_joining =""; 
$asset_purchase = "";
$assetissue_date="";
$asset_issue = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['updateid'])) {
    $asset_id = $_GET['updateid'];

  
    $sql = "SELECT * FROM assets WHERE asset_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $asset_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $location = $row['location'];
        $asset_type = $row['asset_type'];
        $Model_no=$row['Model_no'];
        $configuration=$row['configuration'];
        $brand = $row['brand'];
        $IMEI=$row['IMEI'];
        $Serial_no=$row['Serial_no'];
        $processor = $row['processor'];
        $ram = $row['ram'];
        $storage = $row['storage'];
        $username_db = $row['username']; 
        $password_db = $row['password'];
        $ip = $row['ip'];
        $accessory = $row['accessory'];
        // $employee_id = $row['employee_id'];
        // $destination = $row['destination'];
        // $department = $row['department'];
        $date_of_joining = $row['date_of_joining'];
        $asset_purchase = $row['asset_purchase'];
        $assetissue_date=$row['assetissue_date'];
        $asset_issue = $row['asset_issue'];
    } else {
        echo "No record found for the given asset ID.";
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = $_POST['asset'];
    $asset_type = $_POST['asset_type'];
    $asset_id = $_POST['asset_id'];
    $Model_no=$_POST['Model_no'];
    $configuration=$_POST['configuration'];
    $brand = $_POST['brand'];
    $IMEI=$_POST['IMEI'];
    $Serial_no=$_POST['Serial_no'];
    $processor = $_POST['processor'];
    $ram = $_POST['ram'];
    $storage = $_POST['storage'];
    $username_db = $_POST['username']; 
    $password_db = $_POST['password'];
    $ip = $_POST['ip'];
    $accessory = $_POST['accessory'];
    // $employee_id = $_POST['employee_id'];
    // $destination = $_POST['destination'];
    // $department = $_POST['department'];
    $date_of_joining = $_POST['date'];
    $asset_purchase = $_POST['asset_purchase'];
    $assetissue_date=$_POST['assetissue_date'];
    $asset_issue = $_POST['asset_issue'];

    $sql = "UPDATE assets SET location=?, asset_type=?,Model_no=?,configuration=?, brand=?,IMEI=?,Serial_no=?, processor=?, ram=?, storage=?, username=?, password=?, ip=?, accessory=?,  date_of_joining=?, asset_purchase=?, assetissue_date=?,asset_issue=? WHERE asset_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssssss", $location, $asset_type,$Model_no,$configuration, $brand,$IMEI,$Serial_no, $processor, $ram, $storage, $username_db, $password_db, $ip, $accessory,  $date_of_joining, $asset_purchase, $assetissue_date,$asset_issue, $asset_id);

    if ($stmt->execute()) {
        // Update successful, redirect or refresh the page
        header("Location: assetupdate.php?updateid=" . $asset_id);
        exit(); // Ensure no further output
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Asset</title>
    <link rel="stylesheet" type="text/css" href="update.css">
</head>
<body>

<h1>Update Asset</h1>
<form action="assetupdate.php" method="POST">
    <div class="form-group">
        <label for="asset">Location:</label>
        <select name="asset" id="asset">
            <option value="<?php echo $location; ?>"><?php echo $location; ?></option>
            <!-- Populate other options as needed -->
        </select>
    </div>
    <div class="form-group">
        <label>Asset Type</label>
        <select name="asset_type" id="asset_type">
        <option value="<?php echo $asset_type; ?>"><?php echo $asset_type; ?></option>
        </select>
    </div>
    <div class="form-group">
        <label>Asset ID</label>
        <input type="text" class="form-control" name="asset_id" placeholder="Enter Asset ID" value="<?php echo $asset_id; ?>" readonly>
    </div>
    <div class="form-group">
        <label>Model no</label>
        <input type="text" class="form-control" name="Model_no" placeholder ="enter Model no." value="<?php echo $Model_no; ?>"required>
    </div>
    <div class="form-group">
        <label>Configuration</label>
        <input type="text" class="form-control" name="configuration" placeholder ="enter configuration of your asset" value="<?php echo $configuration;?>"required>
    <div class="form-group">
        <label>Brand</label>
        <input type="text" class="form-control" name="brand" placeholder="Enter Brand name" value="<?php echo $brand; ?>" required>
</div>
<div class="form-group">
            <label>IMEI</label>
            <input type="text" class="form-control" name="IMEI" placeholder="Enter IMEI">
        </div>
        <div class="form-group">
            <label>Serial No.</label>
            <input type="text" class="form-control" name="Serial_no" placeholder="Enter Serial no.">
        </div>
	 <div class="form-group">
            <label>Processor</label>
            <input type="text" class="form-control" name="processor" placeholder="Enter Processor name" value="<?php echo $processor;?>" required>
        </div>
        <div class="form-group">
            <label>RAM</label>
            <input type="text" class="form-control" name="ram" placeholder="Enter RAM value" value="<?php echo $ram;?>" required>
        </div>
        <div class="form-group">
            <label>Storage</label>
            <input type="text" class="form-control" name="storage" placeholder="Enter Storage value" value="<?php echo $storage;?>" required>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" placeholder="Enter Username"value="<?php echo $username;?>" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" name="password" placeholder="Enter Password" value="<?php echo $password;?>" required>
        </div>
        <div class="form-group">
            <label>IP</label>
            <input type="text" class="form-control" name="ip" placeholder="Enter IP value" value="<?php echo $ip;?>" required>
        </div>
        <div class="form-group">
            <label>Accessory</label>
            <input type="text" class="form-control" name="accessory" placeholder="Enter Accessory name" value ="<?php echo $accessory;?>" required>
        </div>
        <!-- <div class="form-group">
            <label>Employee ID</label>
            <input type="text" class="form-control" name="employee_id" placeholder="Enter Employee ID"value="<?php echo $employee_id;?>" required>
        </div>
        <div class="form-group">
            <label>Destination</label>
            <input type="text" class="form-control" name="destination" placeholder="Enter Destination" value="<?php echo $destination;?>" required>
        </div>
        <div class="form-group">
            <label>Department</label>
            <input type="text" class="form-control" name="department" placeholder="Enter Department" value="<?php echo $department;?>" required>
        </div> -->
        <div class="form-group">
            <label>Date of Joining</label>
            <input type="datetime-local" class="form-control" name="date" placeholder="Enter Date"value="<?php echo $date_of_joining;?>" required>
        </div>
        <div class="form-group">
            <label>Asset Purchase</label>
            <input type="datetime-local" class="form-control" name="asset_purchase" placeholder="Date of Asset Purchasing" value="<?php echo $asset_purchase;?>" required>
        </div>
        <div class="form-group">
            <label>Issuing Date</label>
            <input type="datetime-local" class="form-control" name="assetissue_date" placeholder="Date of issuing asset" value="<?php echo $assetissue_date;?>" required>
        </div>
        <!-- <div class="form-group">
            <label>Asset Issue</label>
            <input type="text" class="form-control" name="asset_issue" placeholder="Regarding issue of any asset" value="<?php echo $asset_issue;?>" required>
        </div> -->
    <!-- Add other form fields similarly -->

    <div class="form-group">
        <button type="submit" name="submit">UPDATE</button>
    </div>
</form>

<script>
    // Fetch location data from location.php
    fetch('location.php')
        .then(response => response.json())
        .then(data => {
            const selectElement = document.getElementById('asset');
            data.forEach(location => {
                const optionElement = document.createElement('option');
                optionElement.value = location;
                optionElement.text = location;
                selectElement.appendChild(optionElement);
            });
        })
        .catch(error => console.error('Error:', error));
</script>
<script>
    // Fetch asset types (devices) from deviceddd.php
    fetch('deviceddd.php')
        .then(response => response.json())
        .then(data => {
            const selectElement = document.getElementById('asset_type');
            data.devices.forEach(device => {
                const optionElement = document.createElement('option');
                optionElement.value = device.name;
                optionElement.text = device.name;
                selectElement.appendChild(optionElement);
            });
        })
        .catch(error => console.error('Error:', error));
</script>

</body>
</html>
