<?php
$servername = "127.0.0.1";
$port = 3308; // Specify the port number separately

$username = "root";
$password = "";
$dbname = "inventory";

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $locationname = $_POST['locationname'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $pincode = $_POST['pincode'];
    $contact = $_POST['contact'];

    $stmt = $conn->prepare("INSERT INTO location (locationname, state, district, pincode, contact) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $locationname, $state, $district, $pincode, $contact);

    if ($stmt->execute()) {
        echo "New record created successfully";
        // header('location:addlocation.html');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// $conn->close();
?>
