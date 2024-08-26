<?php
include('../../database/database_conn.php');

$major_id = $_POST['major_id'];

$query = "UPDATE major_db SET status = 'Completed' WHERE major_id = '$major_id'";

$result = mysqli_query($conn, $query);

if ($result) {
    header('Location: ../manage.php');
    exit();
} else {
    echo "Error updating user information: " . mysqli_error($conn);
}
