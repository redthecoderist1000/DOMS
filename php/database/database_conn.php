<?php
$db_server = "db";
$db_user = "do_user";
$db_pass = "password";
$db_name = "do_db";

// Establishing the mysqli connection
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
