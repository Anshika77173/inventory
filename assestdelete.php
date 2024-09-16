<?php
include 'asset.php';

if (isset($_GET['deleteid'])) {
    $asset_id = $_GET['deleteid'];

    // Prepare the statement to avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM assets WHERE asset_id = ? ");
    $stmt->bind_param("s", $asset_id);

    if ($stmt->execute()) {
        header('Location: assetdisplay.php'); // Redirect to assetdisplay.php after deletion
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// $conn->close(); // Close the connection here
?>