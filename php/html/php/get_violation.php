<?php
include '../../database/database_conn.php';

$student_id = $_POST['student_id'];


$sql = "SELECT a.student_id, a.date_committed, b.offense_type, b.category, c.offense_name
FROM violation_record_db a
LEFT JOIN violation_db b ON a.violation_id = b.violation_id
LEFT JOIN offense_list_db c ON b.offense_list_id = c.offense_list_id WHERE a.student_id = '$student_id'";

$result = $conn->query($sql);

if($result->num_rows > 0){
    $data = array();
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
    echo json_encode($data);
}
else{
    echo json_encode('No data');
}