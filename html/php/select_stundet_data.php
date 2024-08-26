<?php
    $query = "SELECT * FROM student_db WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);

    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $first_name = $row['f_name'];
        $middle_name = $row['m_name'];
        $last_name = $row['l_name'];
        $gender = $row['gender'];
        $birth_date = $row['birth_date'];
        $email = $row['email'];
        $contact = $row['contact'];
        $telephone = $row['tel_number'];
        $profile_pic = $row['profile_img'];

    } else {
        $username = "";
        $first_name = "";
        $middle_name = "";
        $last_name = "";
        $gender = "";
        $birth_date = "";
        $email = "";
        $contact = "";
        $telephone = "";
        $profile_pic = "";
    }

?>
