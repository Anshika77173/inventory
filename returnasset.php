<?php
include_once("config.php");

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $issue_date=$_POST['issue_date'];
    $left_date=$_POST['left_date'];
    $asset_id=$_POST['asset_id'];
    $employees_name=$_POST['employees_name'];
    $location=$_POST['location'];

    $stmt = $conn->prepare("INSERT INTO returnasset (issue_date,left_date,asset_id,employee_name,location) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss", $issue_date,$left_date,$asset_id,$employees_name,$location);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} 

//  $conn->close();
?>
