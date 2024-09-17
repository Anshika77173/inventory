<?php 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$domain = $_SERVER['SERVER_NAME'];

// Check if the domain is localhost or a development domain
if ($domain == 'localhost') {
    // Local development database configuration
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db_name = 'inventory';
} else {
    // Production database configuration
    $host = 'localhost';   // Replace with your production host
    $user = 'u135002908_inventory';      // Replace with your production user
    $pass = 'Vinesh@Dabwali1';  // Replace with your production password
    $db_name = 'u135002908_inventory'; // Replace with your production database name
}
