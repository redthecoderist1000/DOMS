<?php
session_start();
include('../../database/database_conn.php');

$id = $_SESSION['violation_id'] ?? null;
$type = $_SESSION['violation_type'] ?? null;

$student_id = $f_name = $m_name = $l_name = $course = $section = $violation_type = $offense_type = $description = '';

if ($type == 'Major' && !empty($id)) {
    $query = "SELECT * FROM major_db a
              JOIN student_db b ON a.student_id = b.student_id
              WHERE major_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $student_id = $row['student_id'];
        $f_name = $row['f_name'];
        $m_name = $row['m_name'];
        $l_name = $row['l_name'];
        $course = $row['course'];
        $section = $row['section'];
        $violation_type = $row['violation_type'];
        $offense_type = $row['offense_type'];
        $description = $row['description'];

        unset($_SESSION['violation_id']);
        unset($_SESSION['violation_type']);
        unset($_SESSION['redirect_url']);
    }
} elseif ($type == 'Minor' && !empty($id)) {
    $query = "SELECT * FROM minor_db a
              JOIN student_db b ON a.student_id = b.student_id
              WHERE minor_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $student_id = $row['student_id'];
        $f_name = $row['f_name'];
        $m_name = $row['m_name'];
        $l_name = $row['l_name'];
        $course = $row['course'];
        $section = $row['section'];
        $violation_type = $row['violation_type'];
        $offense_type = $row['offense_type'];
        $description = $row['description'];

        unset($_SESSION['violation_id']);
        unset($_SESSION['violation_type']);
        unset($_SESSION['redirect_url']);
    }
} else {
    echo "No valid ID or type found in URL. This is the id $id $type";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/DOMS_logo.png" type="image/x-icon">
    <title>Violation Slip</title>
    <link rel="stylesheet" href="print.css">
    <script>
        function formatDate(date) {
            const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            let dayName = days[date.getDay()];
            let monthName = months[date.getMonth()];
            let day = date.getDate();
            let year = date.getFullYear();

            return `${dayName} ${monthName} ${day}, ${year}`;
        }
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("currentDate").innerText = formatDate(new Date());
        });
    </script>
</head>

<body>
    <div class="container">
        <h1>DISCIPLINE OFFICE</h1>
        <img src="../../images/DOMS_logo.png" alt="DOMS Logo">

        <div class="info">
            <div class="upper">
                <h2>Violation Slip No. &nbsp;&nbsp;:&nbsp;&nbsp; <span><?php echo htmlspecialchars($id); ?></span></h2>
                <h3 id="currentDate"></h3>
            </div>
            <div class="mid">
                <div class="input-wrap">
                    <label for="student-id">Student ID:</label>
                    <input type="text" name="student-id" value="<?php echo htmlspecialchars($student_id); ?>">
                </div>
                <div class="input-wrap">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars("$f_name $m_name $l_name"); ?>">
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
            <div class="lower">
                <div class="lower-info">
                    <hr>
                    <h4>Discipline Office Personnel</h4>
                </div>
                <div class="lower-info">
                    <hr>
                    <h4>Student's Signature</h4>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
</script>

</html>