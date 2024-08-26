<?php
session_start();
$_SESSION['currentpage'] = "student";
$username = $_SESSION['username'];
include("../database/database_conn.php");
include('php/fetch_student_data.php');
$category_type = $_POST['category_type'];
$studentID = $_POST['studentID'];
$violation_type = $_POST['violation_type'];
$offense_type = $_POST['offense_type'];
$description = $_POST['description'];

$date_compliance = $_POST['date_compliance'] ?? null;
$notice = $_POST['notice'] ?? null;





$query = "SELECT * FROM student_db WHERE student_id ='$studentID'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $f_name = $row['f_name'];
        $m_name = $row['m_name'];
        $l_name = $row['l_name'];
        $email = $row['email'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/DOMS_logo.png" type="image/x-icon">
    <title>Student Violation</title>
    <link rel="stylesheet" href="../css/student.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="js/screen_timeout.js"></script>



    <script>
        <?php if ($_SESSION['redirect_url']) : ?>
            console.log("Opening new tab");
            var newTab = window.open('<?php echo $_SESSION['redirect_url']; ?>', '_blank');
        <?php endif; ?>
    </script>

</head>

<body>

    <div class="sidenav">
        <?php
        include('sidenav/sidenav.php');
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headerBtn = document.querySelector('.header-btn');
            const sidenavBtn = document.querySelector('.sidenav-btn');
            const sidenav = document.querySelector('.sidenav');

            headerBtn.addEventListener('click', () => {
                sidenav.classList.toggle('active');
            });

            sidenavBtn.addEventListener('click', () => {
                sidenav.classList.toggle('active');
            });
        });
    </script>

    <div class="header-btn">
        <i class="fas fa-bars"></i>
    </div>

    <section class="main-do">


        <div class="body-content">

            <form action="php/insert_violation_major.php" method="POST">
                <div class="form-container">

                    <div class="student-violation">
                        <div class="student-header info-header">
                            <h1>Student Violation</h1>
                            <hr>
                        </div>

                        <div class="table-nav">
                            <div class="nav-list">
                                <h4>CATEGORY 1: Recommendation for Counselling</h4>
                            </div>
                        </div>

                        <hr>

                        <div class="violation-container1">
                            <div class="multi-left">
                                <div class="input-wrap">
                                    <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">
                                    <input type="hidden" name="category_type" value="<?php echo $category_type; ?>">
                                    <input type="hidden" name="violation_type" value="<?php echo $violation_type; ?>">
                                    <input type="hidden" name="offense_type" value="<?php echo $offense_type; ?>">
                                    <input type="hidden" name="description" value="<?php echo $description; ?>">
                                    <input type="hidden" name="intervention_type" value="Counseling">




                                    <label for="name">Student Name:</label>
                                    <input name="name" id="nameField" value="<?php echo $f_name . ' ' . $m_name . ' ' . $l_name ?>"></input>
                                </div>

                                <div class="input-wrap">
                                    <label for="email">Student Email:</label>
                                    <input name="email" id="emailField" value="<?php echo $email ?>"></input>
                                </div>

                                <div class="input-wrap">
                                    <label for="date" style="min-width: 250px;">Due date of compliance:</label>
                                    <input name="date_compliance" id="dateField" type="date" value="<?php echo $date_compliance ?>"></input>
                                </div>
                            </div>
                        </div>
                        <div class="explanation">
                            <label for="notice">Notice to Explain:</label>
                            <textarea name="notice" id=""><?php echo $notice ?></textarea>
                        </div>
                        <div class="buttons">
                            <input type="submit" name="send_email" value="SEND EMAIL">
                            <input type="submit" name="print" id="printBtn" value="PRINT">
                        </div>


                    </div>
            </form>

        </div>

    </section>

    <script src="../javascript/profile.js"></script>
</body>

</html>