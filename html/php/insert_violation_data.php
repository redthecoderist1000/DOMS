<?php
include('../../database/database_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $offense_type = $_POST['offense_type'];
    $violation_type = $_POST['violation_type'];
    $category = $_POST['category'] ?? null;
    $description = $_POST['description'];


    $stmt = $conn->prepare("INSERT INTO violation_db (category, offense_type, violation_type, description) VALUES (?, ?, ?, ?)");

    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("ssss", $category, $offense_type, $violation_type, $description);

    if ($stmt->execute()) {
        header("Location: ../violation.php");
        exit();
    } else {
        die("Error executing the statement: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../violation.php");
    exit();
}
