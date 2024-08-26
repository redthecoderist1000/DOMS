<?php

$query = "SELECT * FROM student_db WHERE student_id = $student_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $f_name = $row['f_name'];
    $m_name = $row['m_name'];
    $l_name = $row['l_name'];
    $department = $row['department'];
    $section = $row['section'];
    $course = $row['course'];
    $email = $row['email'];
    $gender = $row['gender'];
}
