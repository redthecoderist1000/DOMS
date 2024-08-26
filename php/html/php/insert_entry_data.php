<?php
include('../../database/database_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $purpose = $_POST['purpose'];
    $student_id = $_POST['student_id'];
    $date_validity = date('F j, Y', strtotime($_POST['validity_date'])); // Format the date here

    $current_date = date('F j, Y', strtotime('now'));




    $stmt = $conn->prepare("INSERT INTO entry_db (purpose, student_id, request_date, date_validity) VALUES (?,?,?,?)");

    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("ssss", $purpose, $student_id, $current_date, $date_validity);

    if ($stmt->execute()) {
        header("Location: ../manage.php");
        exit();
    } else {
        die("Error executing the statement: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../manage.php");
    exit();
}
