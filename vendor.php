<?php
$servername = "127.0.0.1:3308";

$username = "root";
$password = "";
$dbname = "inventory";

$conn = new mysqli($servername,$username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vendor_id=$_POST['vendor_id'];
    $vendor_name=$_POST['vendor_name'];
    $date=$_POST['date'];

    $stmt = $conn->prepare("INSERT INTO vendors (vendor_id,vendor_name,date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $vendor_id, $vendor_name, $date);

    if ($stmt->execute()) {
        echo "New record created successfully";
       
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = $conn->query("SELECT vendor_name FROM vendors");

    if ($result === false) {
        die("Query failed: " . $conn->error);
    }

    $asset_ids = array();
    while ($row = $result->fetch_assoc()) {
        $asset_ids[] = $row['vendor_name'];
    }

    header('Content-Type: application/json');
    echo json_encode($asset_ids);
}


$conn->close();
?>
