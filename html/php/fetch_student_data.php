 <?php
    include(__DIR__ . '/../../database/database_conn.php');

    // Start the session

    if (isset($_GET['student_id'])) {
        $student_id = mysqli_real_escape_string($conn, $_GET['student_id']);


        $query = "SELECT * FROM student_db WHERE student_id = '$student_id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $student_data = mysqli_fetch_assoc($result);


                $response = array(
                    'studentID' => $student_data['student_id'],
                    'name' => $student_data['f_name'] . ' ' . $student_data['m_name'] . ' ' . $student_data['l_name'],
                    'course' => $student_data['course'],
                    'section' => $student_data['section'],
                    'email' => $student_data['email'],
                    'department' => $student_data['department'],
                    'account_status' => $student_data['account_status'],

                    'minor_violations' => array(),
                    'major_violations' => array(),
                    'violations' => array(),
                    'goodmoral' => array(),
                    'admission' => array(),
                    'entry' => array()
                );

                $query_minor = "SELECT violation_type, offense_type, date_created FROM minor_db WHERE student_id = '$student_id'";
                $result_minor = mysqli_query($conn, $query_minor);
                if ($result_minor) {
                    while ($minor = mysqli_fetch_assoc($result_minor)) {
                        $response['minor_violations'][] = $minor;
                        $response['violations'][] = $minor;
                    }
                }

                $query_major = "SELECT * FROM major_db a 
                            JOIN intervention_db b ON a.major_id = b.major_id
                            WHERE a.student_id = '$student_id'";
                $result_major = mysqli_query($conn, $query_major);
                if ($result_major) {
                    while ($major = mysqli_fetch_assoc($result_major)) {
                        $response['major_violations'][] = $major;
                        $response['violations'][] = $major;
                    }
                }

                $query_goodmoral = "SELECT * FROM goodmoral_db WHERE student_id = '$student_id'";
                $result_goodmoral = mysqli_query($conn, $query_goodmoral);
                if ($result_goodmoral) {
                    while ($goodmoral = mysqli_fetch_assoc($result_goodmoral)) {
                        $response['goodmoral'][] = $goodmoral;
                    }
                }

                $query_admission = "SELECT * FROM admission_db WHERE student_id = '$student_id'";
                $result_admission = mysqli_query($conn, $query_admission);
                if ($result_admission) {
                    while ($admission = mysqli_fetch_assoc($result_admission)) {
                        $response['admission'][] = $admission;
                    }
                }

                $query_entry = "SELECT * FROM entry_db WHERE student_id = '$student_id'";
                $result_entry = mysqli_query($conn, $query_entry);
                if ($result_entry) {
                    while ($entry = mysqli_fetch_assoc($result_entry)) {
                        $response['entry'][] = $entry;
                    }
                }


                echo json_encode($response);
            } else {
                echo json_encode(array('error' => 'Student not found'));
            }
        } else {
            echo json_encode(array('error' => 'Error executing query'));
        }

        mysqli_close($conn);
    } else {
    }
