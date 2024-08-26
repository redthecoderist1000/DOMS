<?php
include(__DIR__ . '/../../database/database_conn.php');

if (isset($_GET['offense_type'])) {
    $offense_type = mysqli_real_escape_string($conn, $_GET['offense_type']);

    $query = "SELECT violation_type FROM violation_db WHERE offense_type = '$offense_type'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = array(
                'violation_type' => $row['violation_type']
                
            );
        }
        echo json_encode($response);
    } else {
        echo json_encode(array('error' => 'Error executing query: ' . mysqli_error($conn)));
    }

    mysqli_close($conn);
} else {
    echo json_encode(array('error' => 'Offense type not provided'));
}
?>
