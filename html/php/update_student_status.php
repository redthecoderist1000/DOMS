<?php
include '../../database/database_conn.php';

$student_id = $_POST['student_id'];
$status = $_POST['status'];

$query = "UPDATE student_db SET account_status = '$status' WHERE student_id = '$student_id'";
$result = mysqli_query($conn, $query);

echo "success";