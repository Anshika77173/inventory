<?php
$servername = "127.0.0.1:3308";
$username = "root";
$password = "";
$dbname = "inventory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['asset_id']) && isset($_POST['left_date'])) {
        // Handle asset return
        $asset_id = $_POST['asset_id'];
        $left_date = $_POST['left_date'];

        $update_asset_query = "UPDATE assets SET asset_issue = 'Returned' WHERE asset_id = ?";
        $stmt = $conn->prepare($update_asset_query);
        $stmt->bind_param("s", $asset_id);

        if ($stmt->execute()) {
            echo json_encode(array("message" => "Asset returned successfully"));
        } else {
            echo json_encode(array("error" => "Error updating asset status: " . $stmt->error));
        }

        $stmt->close();
    } elseif (isset($_POST['employees_id']) && isset($_POST['employees_name']) && isset($_POST['date']) && isset($_POST['asset_id']) && isset($_POST['location'])) {
        // Handle new transaction
        $employees_id = $_POST['employees_id'];
        $employees_name = $_POST['employees_name'];
        $date = $_POST['date'];
        $asset_id = $_POST['asset_id'];
        $location = $_POST['location'];

        $stmt = $conn->prepare("SELECT employees_id FROM transaction WHERE employees_id =?");
        $stmt->bind_param("s", $employees_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo json_encode(array("error" => "Error: Employee ID already has an active transaction"));
        } else {
            $stmt = $conn->prepare("INSERT INTO transaction (employees_id, employees_name, date, asset_id, location) VALUES (?,?,?,?,?)");
            $stmt->bind_param("sssss", $employees_id, $employees_name, $date, $asset_id, $location);

            if ($stmt->execute()) {
                // Update asset status
                $update_asset_query = "UPDATE assets SET asset_issue = 'Issued' WHERE asset_id = ?";
                $stmt = $conn->prepare($update_asset_query);
                $stmt->bind_param("s", $asset_id);

                if ($stmt->execute()) {
                    echo json_encode(array("message" => "New record created successfully"));
                } else {
                    echo json_encode(array("error" => "Error updating asset status: " . $stmt->error));
                }
            } else {
                echo json_encode(array("error" => "Error inserting new record: " . $stmt->error));
            }

            $stmt->close();
        }
    } else {
        echo json_encode(array("error" => "Error: Invalid request"));
    }
} elseif (isset($_GET['asset_id'])) {
    // Handle fetching transaction details
    $asset_id = $_GET['asset_id'];

    $stmt = $conn->prepare("SELECT employees_name, location, date FROM transaction WHERE asset_id = ? LIMIT 1");
    $stmt->bind_param("s", $asset_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(array("error" => "Asset ID not found"));
    }

    $stmt->close();
} else {
    echo json_encode(array("error" => "Invalid request"));
}

// Close connection
// $conn->close();
?>
