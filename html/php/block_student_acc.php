<?php
include('../../database/database_conn.php');

$student_id_acc = $_POST['student_id_acc'];
$block = $_POST['block'] ?? null;
$unblock = $_POST['unblock'] ?? null;


if (!empty($block)) {
    $query = "UPDATE student_db SET account_status = 'banned' WHERE student_id = '$student_id_acc'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: ../manage.php');
        exit();
    } else {
        echo "Error updating user information: " . mysqli_error($conn);
    }
} elseif (!empty($unblock)) {
    $query = "UPDATE student_db SET account_status = 'active' WHERE student_id = '$student_id_acc'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: ../manage.php');
        exit();
    } else {
        echo "Error updating user information: " . mysqli_error($conn);
    }
}
