<?php
include(__DIR__ . '/../../database/database_conn.php');

if (isset($_GET['violation_type'])) {
    $violation_type = mysqli_real_escape_string($conn, $_GET['violation_type']);

    $query = "SELECT description FROM violation_db WHERE violation_type = '$violation_type'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = array();
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $response = array(
                'description' => $row['description']
            );
        } else {
            $response = array(
                'description' => 'No description available'
            );
        }
        echo json_encode($response);
    } else {
        echo json_encode(array('error' => 'Error executing query: ' . mysqli_error($conn)));
    }

    mysqli_close($conn);
} else {
    echo json_encode(array('error' => 'Violation type not provided'));
}
?>
