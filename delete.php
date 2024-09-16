<?php
include 'database.php';

if (isset($_GET['deleteid'])) {
    $locationname = $_GET['deleteid'];
    
    // Prepare the statement to avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM location WHERE locationname = ?");
    $stmt->bind_param("s", $locationname);
    
    if ($stmt->execute()) {
        // echo "Deleted successfully";
		header('location:display.php');
    } else {
        echo "Error: " . $stmt->error;
	}    
    $stmt->close();
}

$conn->close();
?>
