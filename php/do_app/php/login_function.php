<?php
session_start();
include('../../database/database_conn.php');
$student_id = $_POST['student_id'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM student_db WHERE student_id = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    if ($password == $user['password']) {
        if ($user['account_status'] == 'banned') {
            $_SESSION['error_message'] = "You have been banned.<br>Please go to the Discipline Office";
            header("Location: ../index.php");
        } else {
            $_SESSION['student_id'] = $user['student_id'];
            header("Location: ../home.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Wrong Password";
        header("Location: ../index.php");
    }
} else {
    $_SESSION['error_message'] = "No Student Found";
    header("Location: ../index.php");
}
