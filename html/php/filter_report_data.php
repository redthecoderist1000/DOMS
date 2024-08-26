<?php
include("../../database/database_conn.php");

$fromDate = date('F j, Y', strtotime($_POST['fromDate']));
$toDate = date('F j, Y', strtotime($_POST['toDate']));

$query = "
    (SELECT s.student_id, s.f_name, s.l_name, s.course, m.date_created, m.violation_type, m.offense_type
    FROM student_db s
    INNER JOIN major_db m ON s.student_id = m.student_id
    WHERE m.date_created BETWEEN '$fromDate' AND '$toDate')
    UNION
    (SELECT s.student_id, s.f_name, s.l_name, s.course, n.date_created, n.violation_type, n.offense_type
    FROM student_db s
    INNER JOIN minor_db n ON s.student_id = n.student_id
    WHERE n.date_created BETWEEN '$fromDate' AND '$toDate')
    ORDER BY date_created DESC
";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['student_id']}</td>";
        echo "<td>{$row['f_name']} {$row['l_name']}</td>";
        echo "<td>{$row['course']}</td>";
        echo "<td>{$row['offense_type']}</td>";
        echo "<td>{$row['violation_type']}</td>";
        echo "<td>{$row['date_created']}</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No results found.</td></tr>";
}
