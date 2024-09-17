<?php
include_once("config.php");

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employees_id = $_POST['employees_id'];
    $employees_name = $_POST['employees_name'];
    $date = $_POST['date'];

    $stmt = $conn->prepare("INSERT INTO employees (employees_id, employees_name, designation,department,contact,location,date) VALUES (?, ?,?,?,?,?, ?)");
    $stmt->bind_param("sssssss", $employees_id, $employees_name, $date,$designation,$department,$contact,$location);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = $conn->query("SELECT employees_name FROM employees");


    $asset_ids = array();
    while ($row = $result->fetch_assoc()) {
        $asset_ids[] = $row['employees_name'];
    }

    header('Content-Type: application/json');
    echo json_encode($asset_ids);
}

else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = $conn->query("SELECT employees_id FROM employees");

    $employee_ids = array();
    while ($row = $result->fetch_assoc()) {
        $employee_ids[] = $row['employees_id'];
    }

    header('Content-Type: application/json');
    echo json_encode($employee_ids);
}


$conn->close();
?>
