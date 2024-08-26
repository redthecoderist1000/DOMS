<?php
session_start();
include("../../database/database_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_POST['studentID'];
    $violation_type = $_POST['violation_type'];
    $offense_type = $_POST['offense_type'];
    $description = $_POST['description'];
    $formattedDate = date('F j, Y');

    $notice = $_POST['notice'] ?? null;
    $date_compliance = $_POST['date_compliance'] ?? null;
    $intervention_type = $_POST['intervention_type'] ?? null;
    $specify_department = $_POST['specify_department'] ?? null;


    $redirect = false;
    $id = null;

    if ($offense_type == "Major") {
        $stmt = $conn->prepare("INSERT INTO major_db (student_id, date_created, offense_type, violation_type, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $studentID, $formattedDate, $offense_type, $violation_type, $description);

        if ($stmt->execute()) {
            $major_id = $stmt->insert_id;
            $_SESSION['violation_id'] = $major_id;
            $_SESSION['violation_type'] = 'Major';
            $redirect = true;

            $stmt->close();

            $stmt = $conn->prepare("INSERT INTO intervention_db (major_id, due_date, intervention_type, specify_department, notice_explain) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $major_id, $date_compliance, $intervention_type, $specify_department, $notice);

            if ($stmt->execute()) {
                echo "Intervention record successfully inserted.";
            } else {
                echo "Error inserting into intervention_db: " . $stmt->error;
            }

            $stmt->close();
        }
    } elseif ($offense_type == "Minor") {
        $stmt = $conn->prepare("INSERT INTO minor_db (student_id, date_created, offense_type, violation_type, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $studentID, $formattedDate, $offense_type, $violation_type, $description);

        if ($stmt->execute()) {
            $minor_id = $stmt->insert_id;
            $_SESSION['violation_id'] = $minor_id;
            $_SESSION['violation_type'] = 'Minor';
            $redirect = true;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
    $conn->close();

    if ($redirect) {
        $_SESSION['redirect_url'] = 'printable/print.php';
        header('Location: ../student.php');
        exit();
    }
}
