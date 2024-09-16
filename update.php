<?php
$servername = "localhost";
$port = 3308;
$username = "root";
$password = "";
$dbname = "inventory";
$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$locationname = "";
$state = "";
$district = "";
$pincode = "";
$contact = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['updateid'])) {
    $locationname = $_GET['updateid'];

    // Fetch the existing data to display in the form
    $sql = "SELECT * FROM location WHERE locationname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $locationname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $state = $row['state'];
        $district = $row['district'];
        $pincode = $row['pincode'];
        $contact = $row['contact'];
    } else {
        echo "No record found for the given location name.";
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $locationname = $_POST['locationname'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $pincode = $_POST['pincode'];
    $contact = $_POST['contact'];

    $sql = "UPDATE location SET state = ?, district = ?, pincode = ?, contact = ? WHERE locationname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $state, $district, $pincode, $contact, $locationname);

    if ($stmt->execute()) {
        echo "Update successful";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Location</title>
    <link rel="stylesheet" type="text/css" href="update.css">
</head>
<body>

<h1>Update Location</h1>
<form action="update.php" method="POST">
    <div class="form-group">
        <label>Location Name</label>
        <input type="text" class="form-control" name="locationname" value="<?php echo $locationname; ?>" readonly>
    </div>
    <div class="form-group">
        <label>State</label>
        <input type="text" class="form-control" name="state" value="<?php echo $state; ?>" required>
    </div>
    <div class="form-group">
        <label>District</label>
        <input type="text" class="form-control" name="district" value="<?php echo $district; ?>" required>
    </div>
    <div class="form-group">
        <label>Pin Code</label>
        <input type="text" class="form-control" name="pincode" value="<?php echo $pincode; ?>" required>
    </div>
    <div class="form-group">
        <label>Contact</label>
        <input type="tel" class="form-control" name="contact" value="<?php echo $contact; ?>" maxlength="10" required>
    </div>
    <div class="form-group">
        <button type="submit" name="submit">Update</button>
    </div>
</form>
</body>
</html>
