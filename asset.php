<?php
include_once("config.php");

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = $_POST['asset'];
    $asset_type = $_POST['asset_type'];
    $asset_id = $_POST['asset_id'];
    $Model_no = $_POST['Model_no'];
    $configuration = $_POST['configuration'];
    $brand = $_POST['brand'];
    $IMEI=$_POST['IMEI'];
    $Serial_no=$_POST['Serial_no'];
    $processor = $_POST['processor'];
    $ram = $_POST['ram'];
    $storage = $_POST['storage'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $ip = $_POST['ip'];
    $accessory = $_POST['accessory'];
    // $employee_id = $_POST['employee_id'];
    // $destination = $_POST['destination'];
    // $department = $_POST['department'];
    $date_of_joining = $_POST['date'];
    $asset_purchase = $_POST['asset_purchase'];
    $assetissue_date = $_POST['assetissue_date'];
    // $asset_issue = $_POST['asset_issue'];
    

    $stmt = $conn->prepare("INSERT INTO assets (location, asset_type, asset_id, Model_no, configuration, brand,IMEI, Serial_no, processor, ram, storage, username, password, ip, accessory,  date_of_joining, asset_purchase, assetissue_date) VALUES ( ?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssssssssssssssss", $location, $asset_type, $asset_id, $Model_no, $configuration, $brand,$IMEI,$Serial_no, $processor, $ram, $storage, $username, $password, $ip, $accessory, $date_of_joining, $asset_purchase, $assetissue_date);

    if ($stmt->execute()) {
        echo "Asset added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} 
else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['type']) && $_GET['type'] == 'asset_type') {
    $result = $conn->query("SELECT DISTINCT asset_type FROM assets");

    if ($result === false) {
        die("Query failed: ". $conn->error);
    }

    $assetTypes = array();
    while ($row = $result->fetch_assoc()) {
        $assetTypes[] = $row['asset_type'];
    }

    header('Content-Type: application/json');
    echo json_encode($assetTypes);
}
else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['type']) && $_GET['type'] == 'asset_id') {
    $result = $conn->query("SELECT asset_id FROM assets");  // Ensure the correct table name

    if ($result === false) {
        die("Query failed: " . $conn->error);
    }

    $asset_ids = array();
    while ($row = $result->fetch_assoc()) {
        $asset_ids[] = $row['asset_id'];
    }

    // Return the asset IDs as JSON
    header('Content-Type: application/json');
    echo json_encode($asset_ids);
}

// $conn->close();
?>