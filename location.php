<?php

$conn = mysqli_connect("localhost:3308", "root", "", "inventory");
// Check connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

// Retrieve location data
$sql = "SELECT locationname FROM location";
$result = mysqli_query($conn, $sql);

// Output location data in JSON format
$location = array();
while ($row = mysqli_fetch_assoc($result)) {
    $location[] = $row['locationname'];
}
echo json_encode($location);

// Close the database connection
mysqli_close($conn);
?>