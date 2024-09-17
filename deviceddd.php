<?php
session_start();

// Database connection
include_once("config.php");
try {
    

    $conn = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['error' => "Connection failed: " . $e->getMessage()]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data['action'] == 'add') {
        $name = $data['name'];

        // Check if the device exists, including soft-deleted ones
        $stmt = $conn->prepare("SELECT * FROM devices WHERE name = :name LIMIT 1");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $deviceExists = $stmt->fetch();

        if ($deviceExists) {
            if ($deviceExists['deleted_at'] !== null) {
                // If the device was soft deleted, restore it
                $stmt = $conn->prepare("UPDATE devices SET deleted_at = NULL WHERE id = :id");
                $stmt->bindParam(':id', $deviceExists['id']);
                $stmt->execute();

                echo json_encode(['id' => $deviceExists['id'], 'name' => $name, 'message' => "Device '$name' restored successfully"]);
            } else {
                echo json_encode(['error' => "Device '$name' already exists"]);
            }
        } else {
            // Insert the new device if it does not exist
            $stmt = $conn->prepare("INSERT INTO devices (name) VALUES (:name)");
            $stmt->bindParam(':name', $name);
            $stmt->execute();

            echo json_encode(['id' => $conn->lastInsertId(), 'name' => $name, 'message' => "Device '$name' added successfully"]);
        }
    } elseif ($data['action'] == 'delete') {
        $id = $data['id'];

        // Perform soft delete
        $stmt = $conn->prepare("UPDATE devices SET deleted_at = NOW() WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo json_encode(['deletedID' => $id, 'message' => 'Device deleted successfully']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $stmt = $conn->prepare("SELECT * FROM devices WHERE deleted_at IS NULL");
    $stmt->execute();
    $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['devices' => $devices]);
}
?>
