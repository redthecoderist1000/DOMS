<?php
include("../../database/database_conn.php");

$query = "
    SELECT s.student_id, s.f_name, s.l_name, s.course, m.date_created, m.violation_type, m.offense_type
    FROM student_db s
    INNER JOIN major_db m ON s.student_id = m.student_id
    UNION
    SELECT s.student_id, s.f_name, s.l_name, s.course, n.date_created, n.violation_type, n.offense_type
    FROM student_db s
    INNER JOIN minor_db n ON s.student_id = n.student_id
    ORDER BY date_created DESC;
";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$filename = "Violation_Report_" . date('Ymd') . ".xls";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");

echo "<table>";
echo "<tr><th>Student ID</th><th>Name</th><th>Course</th><th>Offense</th><th>Violation</th><th>Date created</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['student_id'] . "</td>";
    echo "<td>" . $row['f_name'] . " " . $row['l_name'] . "</td>";
    echo "<td>" . $row['course'] . "</td>";
    echo "<td>" . $row['offense_type'] . "</td>";
    echo "<td>" . $row['violation_type'] . "</td>";
    echo "<td>" . $row['date_created'] . "</td>";
    echo "</tr>";
}

echo "</table>";

mysqli_close($conn);
