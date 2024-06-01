<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sales_inventory";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
