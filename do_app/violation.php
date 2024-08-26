<?php
session_start();
include('../database/database_conn.php');
$student_id = $_SESSION['student_id'];
include('php/fetch_student_data.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Violation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="css/violation.css">
</head>

<body>
    <div class="top">
        <header>
            <a href="home.php"><i class="fa-solid fa-left-long"></i></a>
            <h1>Violation</h1>
        </header>
    </div>
    <section>
        <div class="violation-nav">
            <a href="" style="color: #FCD116; border-bottom: solid 3px #FCD116;">Minor</a>
            <a href="violation-major.php">Major</a>
        </div>
        <table>
            <thead>
                <th>Offence Type</th>
                <th>Violation Type</th>
                <th>Date</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM minor_db WHERE student_id = '$student_id'";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $minor_id = $row['minor_id'];
                        $offense_type = $row['offense_type'];
                        $violation_type = $row['violation_type'];
                        $date_created = $row['date_created'];

                        echo '
                    <tr>
                        <td>' . $offense_type . '</td>
                        <td>' . $violation_type . '</td>
                        <td>' . $date_created . '</td>
                        <td><a href="violation-slip.php?minor_id=' . urlencode($minor_id) . '"><i class="fa-solid fa-angle-right"></i></a></td>
                    </tr>
                        ';
                    }
                } else {
                    echo "
                        <tr><td colspan='5'>You have no violation.</td></tr>
                    ";
                }
                ?>

            </tbody>
        </table>
    </section>
</body>

</html>