<?php
include '../../database/database_conn.php';
// Get page number and limit from the POST request
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 10;
$status = $_POST['status'];
$search = isset($_POST['search']) ? $_POST['search'] : '';
$offset = ($page - 1) * $limit;

$section = isset($_POST['section']) ? $_POST['section'] : '';
$course = isset($_POST['course']) ? $_POST['course'] : '';
$department = isset($_POST['department']) ? $_POST['department'] : '';

if($section === ''){
    $section = $search;
}
if($course === ''){
    $course = $search;
}
if($department === ''){
    $department = $search;
}

$query = "SELECT 
    a.student_id, 
    a.f_name, 
    a.m_name, 
    a.l_name, 
    a.section, 
    a.course,
    b.course_name as course_complete, 
    d.school_name as school_full,
    d.school_acronym, 
    a.email, 
    a.gender, 
    a.account_status, 
    (SELECT COUNT(DISTINCT a2.student_id) 
     FROM student_db a2
     LEFT JOIN course_db b2 ON a2.course = b2.course_acronym
     LEFT JOIN department_db c2 ON b2.department_id = c2.department_id
     LEFT JOIN school_db d2 ON c2.school_id = d2.school_id
     WHERE(a.student_id LIKE '%$search%'OR 
     a2.f_name LIKE '%$search%' OR 
     a2.l_name LIKE '%$search%' OR 
     a2.section LIKE '%$section%' OR 
     a2.course LIKE '%$course%' OR 
     d2.school_acronym LIKE '%$department%') 
     AND a2.account_status = '$status'
    ) AS total
FROM 
    student_db a
LEFT JOIN 
    course_db b ON a.course = b.course_acronym
LEFT JOIN 
    department_db c ON b.department_id = c.department_id
LEFT JOIN 
    school_db d ON c.school_id = d.school_id
WHERE
  (a.student_id LIKE '%$search%'OR 
  a.f_name LIKE '%$search%' OR 
  a.l_name LIKE '%$search%' OR 
  a.section LIKE '%$search%' OR 
  a.course LIKE '%$search%' OR 
  d.school_acronym LIKE '%$search%') 
  AND a.account_status = '$status' 
LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$totalResult = $conn->query($query);
$totalRow = $totalResult->fetch_assoc();
if($totalRow === null){
    $totalRecords = 0;
}else{
$totalRecords = $totalRow['total'];
}   
$totalPages = ceil($totalRecords / $limit);


$students = [];
while($row = $result->fetch_assoc()) {
    if($row === FALSE){
        break;
    }
    $students[] = $row;
}


$response = [
    'students' => $students,
    'totalPages' => $totalPages
];

echo json_encode($response);
?>