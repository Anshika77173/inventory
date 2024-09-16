
<?php

// session_start();
// if (!isset($_SESSION["user"])) {
//     header("Location: login.php");
//     exit();
// }

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// Connect to the database
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "inventory";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$devices_query = "SELECT name FROM devices";
$devices_result = $conn->query($devices_query);

$devices = [];
if ($devices_result->num_rows > 0) {
    while ($row = $devices_result->fetch_assoc()) {
        $devices[] = $row['name'];
    }
}

function getAssetCount($conn, $asset_type) {
    $query = "SELECT COUNT(*) as count FROM assets WHERE asset_type=? AND asset_issue<>'issued'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $asset_type);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['count'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="das.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
</head>
<body>
    <div class="container">
        <!-- aside section start -->
        <aside>
            <div class="top">
                <div class="logo">
                    <h2>KBPL</h2>
                </div>
                <div class="close" id="close_btn">
                    <span class="material-symbols-outlined">close</span>
                </div>
            </div>
            <!-- end top section -->
            <div class="sidebar">
                <a href="das.php" class="active">
                    <span class="material-symbols-outlined">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#" onclick="loadContent('addlocation.html'); return false;">
                    <span class="material-symbols-outlined">add_location</span>
                    <h3>Add Location</h3>
                </a>
                <a href="#" onclick="loadContent('asset.html'); return false;">
                    <span class="material-symbols-outlined">add_box</span>
                    <h3>Add Asset</h3>
                </a>
                <a href="#" onclick="loadContent('deviceddd.html'); return false;">
                    <span class="material-symbols-outlined">devices</span>
                    <h3>Devices</h3>
                </a>
                <a href="#" onclick="loadContent('purchaseregister.html'); return false;">
                    <span class="material-symbols-outlined">person_add</span>
                    <h3>Purchase Register</h3>
                </a>
                <a href="#" onclick="loadContent('returnasset.html'); return false;">
                    <span class="material-symbols-outlined">person_add</span>
                    <h3>Return Asset</h3>
                </a>
                <a href="#" onclick="loadContent('vendors.html'); return false;">
                    <span class="material-symbols-outlined">person_add</span>
                    <h3>Vendors</h3>
                </a>
                <a href="#" onclick="loadContent('employees.html'); return false;">
                    <span class="material-symbols-outlined">person</span>
                    <h3>Employees</h3>
                </a>
                <a href="#" onclick="loadContent('transaction.html'); return false;">
                    <span class="material-symbols-outlined">person</span>
                    <h3>Transaction Issue</h3>
                </a>
                <a href="#" onclick="loadContent('about.php'); return false;">
                    <span class="material-symbols-outlined">person</span>
                    <h3>About</h3>
                </a>
                <a href="#" onclick="loadContent('service.html'); return false;">
                    <span class="material-symbols-outlined">person</span>
                    <h3>Services</h3>
                </a>
                <a href="#" onclick="loadContent('Contact.html'); return false;">
                    <span class="material-symbols-outlined">person</span>
                    <h3>Contact</h3>
                </a>
                <a href="logout.php">
                    <span class="material-symbols-outlined">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!-- aside section end -->
        <!-- main section start -->
        <main>
            <div id="content" class="content">
                <!-- Initial content goes here -->
                <h1>DASHBOARD</h1>
                <div class="date">
                    <input type="date" id="datePicker">
                </div>
                <div class="insights">
                    <div class="location">
                        <span class="material-symbols-outlined">add_location</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Total Locations</h3>
                                <?php
                                $dash_category_query = "SELECT locationname FROM location";
                                $dash_category_query_run = mysqli_query($conn, $dash_category_query);
                                if ($category_total = mysqli_num_rows($dash_category_query_run)) {
                                    echo '<h2>' . $category_total . '</h2>';
                                } else {
                                    echo '<h4>No data</h4>';
                                }
                                ?>
                            </div>
                            <div class ="progress">
                                <a class="small text-white stretched-link" href="#" onclick="loadContent('viewlocation.php'); return false;">view details</a>
                            </div>
                        </div>
                    </div>
                    <!-- end location -->
                    <!-- start transaction -->
                    <div class="datacard">
                        <span class="material-symbols-outlined">person_add</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Transaction Issue</h3>
                                <?php
                                $dash_category_query = "SELECT * FROM transaction";
                                $dash_category_query_run = mysqli_query($conn, $dash_category_query);
                                if ($category_total = mysqli_num_rows($dash_category_query_run)) {
                                    echo '<h2>' . $category_total . '</h2>';
                                } else {
                                    echo '<h4>No data</h4>';
                                }
                                ?> 
                            </div>
                            <div class="progress">
                                <a class="small text-white stretched-link" href="#" onclick="loadContent('viewTransaction.php?type=Other'); return false;">view details</a>
                            </div>
                        </div>
                    </div>
                    <!-- end Transaction -->
                    <!-- start dynamic content -->
                    <?php foreach ($devices as $device) { ?>
                        <div class="device">
                            <span class="material-symbols-outlined">devices</span>
                            <div class="middle">
                                <div class="left">
                                    <h3>Total <?= htmlspecialchars($device) ?></h3>
                                    <h2><?= getAssetCount($conn, $device) ?></h2>
                                </div>
                                <div class="progress">
                                    <a class="small text-white stretched-link" href="#" onclick="loadContent('viewasset.php?type=<?= urlencode($device) ?>'); return false;">view details</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?> 
                    <!-- end dynamic content -->
                </div>
            </div>
        </main>
        <!-- main section end -->
        <!-- right section start -->
        <div class="right">
            <div class="top">
                <button id="menu_bar">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-symbols-outlined active">light_mode</span>
                    <span class="material-symbols-outlined">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p><b>HEY</b></p>
                        <p>Admin</p>
                    </div>
                    <small class="text-muted"></small>
                    <div class="profile_photo">
                        <span class="material-symbols-outlined">person</span>
                    </div>
                </div>
            </div>
            <!-- top end -->
            <!-- start recent update -->
            <div class="recent_update">
                <h2>Recent Update</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile_photo">
                            <span class="material-symbols-outlined">person</span>
                        </div>
                        <div class="message">
                            <p><b>Admin</b> Received his asset</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end recent update -->
        </div>
        <!-- right section end -->
    </div>
   

    <script>
        function loadContent(page) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', page, true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var contentDiv = document.getElementById('content');
                        contentDiv.innerHTML = xhr.responseText;

                        // Execute the JavaScript code in the loaded page
                        var scriptTags = contentDiv.getElementsByTagName('script');
                        for (var i = 0; i < scriptTags.length; i++) {
                            eval(scriptTags[i].text);
                        }

                        // Call the loadDevices function if deviceddd.html is loaded
                        if (page === 'deviceddd.html') {
                            loadDevices();
                        }
                    } else {
                        console.error('Failed to load page: ' + xhr.status);
                    }
                }
            };

            xhr.onerror = function() {
                console.error('Request failed');
            };

            xhr.send();
        }

        document.getElementById('datePicker').addEventListener('change', function() {
            var selectedDate = this.value;
            loadContent('someEndpoint.php?date=' + selectedDate);
        });

        // Set the date picker to the current date
        var datePicker = document.getElementById('datePicker');
        var currentDate = new Date();
        datePicker.value = currentDate.toISOString().split('T')[0];
    </script>
    <script src="script.js"></script>
    <script src="returnasset.js"></script>
    <script src="deviceddd.js"></script>
</body>
</html>
