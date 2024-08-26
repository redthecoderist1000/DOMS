<?php
include('../../database/database_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $announcement_content = $_POST['announcement_content'];

    $check_sql = "SELECT * FROM announcement_db LIMIT 1";
    $check_result = $conn->query($check_sql);

    $update_sql = "UPDATE announcement_db SET announcement = ? LIMIT 1";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("s", $announcement_content);


    if ($stmt->execute()) {
        header("Location: ../home.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
