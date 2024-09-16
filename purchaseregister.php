<?php
$servername = "127.0.0.1:3308";
$username = "root";
$password = "";
$dbname = "inventory";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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

    $stmt = $conn->prepare("INSERT INTO purchaseregister (Device, Serial_no, purchase_vendor, purchase_date, recieving_date, asset_id,po, approved, asset, year, price) VALUES (?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?)");

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
