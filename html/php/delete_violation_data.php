<?php
session_start();
include("../../database/database_conn.php");

if (isset($_GET['violation_id'])) {
    $violation_id = $_GET['violation_id'];

    $violation_id = mysqli_real_escape_string($conn, $violation_id);

    $query = "DELETE FROM violation_db WHERE violation_id = '$violation_id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: ../violation.php');
        exit();
    } else {
        echo "Error deleting violation: " . mysqli_error($conn);
        header('Location: ../violation.php');
        exit();
    }
} else {
    echo "Violation ID not specified.";
}
