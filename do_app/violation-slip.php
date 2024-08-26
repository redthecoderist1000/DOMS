<?php
session_start();
include('../database/database_conn.php');
$student_id = $_SESSION['student_id'];
include('php/fetch_student_data.php');

$major_id = isset($_GET['major_id']) ? urlencode($_GET['major_id']) : null;
$minor_id = isset($_GET['minor_id']) ? urlencode($_GET['minor_id']) : null;

if (!empty($major_id)) {
    $back_major = "violation-major.php";
    $stmt = $conn->prepare("SELECT * FROM major_db a WHERE student_id = ? AND major_id = ?");
    $stmt->bind_param("ss", $student_id, $major_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $date_created = $row['date_created'];
            $violation_type = $row['violation_type'];
            $offense_type = $row['offense_type'];
            $description = $row['description'];
        }
    }
} elseif (!empty($minor_id)) {
    $back_minor = "violation.php";
    $stmt = $conn->prepare("SELECT * FROM minor_db a WHERE student_id = ? AND minor_id = ?");
    $stmt->bind_param("ss", $student_id, $minor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $date_created = $row['date_created'];
            $violation_type = $row['violation_type'];
            $offense_type = $row['offense_type'];
            $description = $row['description'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Violation Slip</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="css/violation-slip.css">
</head>

<body>

    <header>
        <a href="<?php if (!empty($major_id)) {
                        echo $back_major;
                    } elseif (!empty($minor_id)) {
                        echo $back_minor;
                    }

                    ?>"><i class="fa-solid fa-left-long"></i></a>
        <h2>VIOLATION DETAILS</h2>
    </header>

    <div class="container">
        <img src="images/DOMS_logo.png" alt="">

        <div class="info">
            <div class="upper">
                <h4>Violation Slip No:&nbsp&nbsp <span><?php echo htmlspecialchars($major_id ?? $minor_id); ?></span></h4>
                <h6 id="currentDate"><?php echo htmlspecialchars($date_created); ?></h6>
            </div>
            <div class="mid">
                <div class="input-wrap">
                    <label for="student-id">Student ID:</label>
                    <input type="text" name="student-id" value="<?php echo htmlspecialchars($student_id); ?>">
                </div>
                <div class="input-wrap">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($f_name . ' ' . $m_name . ' ' . $l_name); ?>">
                </div>
                <div class="input-wrap">
                    <label for="course">Course:</label>
                    <input type="text" name="course" value="<?php echo htmlspecialchars($course); ?>">
                </div>
                <div class="input-wrap">
                    <label for="section">Section:</label>
                    <input type="text" name="section" value="<?php echo htmlspecialchars($section); ?>">
                </div>
                <div class="input-wrap">
                    <label for="violation">Violation Type:</label>
                    <input type="text" name="violation" value="<?php echo htmlspecialchars($violation_type); ?>">
                </div>
                <div class="input-wrap">
                    <label for="offense">Offense Type:</label>
                    <input type="text" name="offense" value="<?php echo htmlspecialchars($offense_type); ?>">
                </div>
                <label for="description">Description:</label>
                <textarea name="description" id=""><?php echo htmlspecialchars($description); ?></textarea>
            </div>
        </div>
    </div>
</body>

</html>