<?php
include('../../database/database_conn.php');

$student_id = $_POST['student_id'];
$lost_found_id = $_POST['lost_found_id'];
$current_date = date('F j, Y', strtotime('now'));


$student_id = mysqli_real_escape_string($conn, $student_id);
$lost_found_id = mysqli_real_escape_string($conn, $lost_found_id);

$query = "UPDATE lost_found_db SET student_id_owner = '$student_id', status = 'claimed', date_claim = '$current_date' WHERE lost_found_id = '$lost_found_id'";

$result = mysqli_query($conn, $query);

if ($result) {
    header('Location: ../lost.php');
    exit();
} else {
    echo "Error updating user information: " . mysqli_error($conn);
}
