<?php
include ('../../database/database_conn.php');


$type = $_POST['type'];
$search = $_POST['search'];

$sql = "SELECT a.violation_id ,a.category, a.offense_type, b.offense_name, c.violation_type
FROM violation_db a
LEFT JOIN offense_list_db b ON a.offense_list_id = b.offense_list_id
LEFT JOIN violation_type_db c ON a.violation_type_id = c.violation_type_id where a.offense_type = '$type' AND b.offense_name LIKE '%$search%'";
$result = $conn->query($sql);
if($result->num_rows > 0){
    $violation_data = array();
    while($row = $result->fetch_assoc()){
        $violation_data[] = $row;
    }
}
else{
    echo json_encode('No data');
}

$sql = "SELECT COUNT(*) FROM violation_db where offense_type = 'minor'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    $minor = $row['COUNT(*)'];

$sql = "SELECT COUNT(*) FROM violation_db where offense_type = 'major'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    $major = $row['COUNT(*)'];



$data = [
    'violation_data' => $violation_data,
    'minor' => $minor,
    'major' => $major
];
echo json_encode($data);