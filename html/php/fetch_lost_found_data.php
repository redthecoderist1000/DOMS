<?php
include(__DIR__ . '/../../database/database_conn.php');

if (isset($_GET['lost_found_id'])) {

    $lost_found_id = mysqli_real_escape_string($conn, $_GET['lost_found_id']);

    $query = "SELECT a.*, b.student_id AS studentID, b.f_name, b.m_name, b.l_name, b.course, b.section, b.email, b.department 
              FROM lost_found_db a 
              JOIN student_db b ON a.student_id_surrender = b.student_id 
              WHERE a.lost_found_id = '$lost_found_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $student_data = mysqli_fetch_assoc($result);

            $response = array(
                'studentID' => $student_data['studentID'],
                'name' => $student_data['f_name'] . ' ' . $student_data['m_name'] . ' ' . $student_data['l_name'],
                'course' => $student_data['course'],
                'section' => $student_data['section'],
                'email' => $student_data['email'],
                'department' => $student_data['department'],
                
                // item information
                'item_type' => $student_data['item_type'],
                'description' => $student_data['description'],
                'item_img' => $student_data['item_img']

            );
            echo json_encode($response);
        } else {
            echo json_encode(array('error' => 'Student not found'));
        }
    } else {
        echo json_encode(array('error' => 'Error executing query'));
    }

    mysqli_close($conn);
} else {
    echo json_encode(array('error' => 'No lost_found_id provided'));
}
?>
