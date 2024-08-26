<?php
include('../../database/database_conn.php');
require '../../vendor/autoload.php';

$send_email = $_POST['send_email'] ?? null;
$print = $_POST['print'] ?? null;

$category_type = $_POST['category_type'];
$studentID = $_POST['studentID'];
$violation_type = $_POST['violation_type'];
$offense_type = $_POST['offense_type'];
$description = $_POST['description'];
$notice = $_POST['notice'];
$intervention_type = $_POST['intervention_type'];
$date_compliance = $_POST['date_compliance'];
$formatted_date = date('F j, Y', strtotime($date_compliance));
$department = $_POST['department'] ?? null;



try {
    if (isset($send_email)) {
        if (!empty($studentID)) {
            $stmt = $conn->prepare("SELECT * FROM student_db WHERE student_id = ?");
            $stmt->bind_param("s", $studentID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                $f_name = $user['f_name'];
                $l_name = $user['l_name'];
                $email = $user['email'];

                // Call the email sending function
                sendemail_verify($f_name, $l_name, $email, $notice, $formatted_date);
                //for major category 1 execution
                if ($category_type == 'category1') {
?>
                    <form id="redirectForm" action="../category1.php" method="POST">
                        <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">
                        <input type="hidden" name="category_type" value="<?php echo $category_type; ?>">
                        <input type="hidden" name="violation_type" value="<?php echo $violation_type; ?>">
                        <input type="hidden" name="offense_type" value="<?php echo $offense_type; ?>">
                        <input type="hidden" name="description" value="<?php echo $description; ?>">
                        <input type="hidden" name="notice" value="<?php echo $notice; ?>">
                        <input type="hidden" name="date_compliance" value="<?php echo $date_compliance; ?>">
                        <input type="hidden" name="intervention_type" value="<?php echo $intervention_type; ?>">
                    </form>
                    <script>
                        document.getElementById('redirectForm').submit();
                    </script>
                    <?php

                    //for major category 2 execution this is my problem now
                } elseif ($category_type == 'category2') {

                    if ($intervention_type == "Counseling") {
                    ?>
                        <form id="redirectForm" action="../category2-counsil.php" method="POST">
                            <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">
                            <input type="hidden" name="category_type" value="<?php echo $category_type; ?>">
                            <input type="hidden" name="violation_type" value="<?php echo $violation_type; ?>">
                            <input type="hidden" name="offense_type" value="<?php echo $offense_type; ?>">
                            <input type="hidden" name="description" value="<?php echo $description; ?>">
                            <input type="hidden" name="notice" value="<?php echo $notice; ?>">
                            <input type="hidden" name="date_compliance" value="<?php echo $date_compliance; ?>">
                            <input type="hidden" name="intervention_type" value="<?php echo $intervention_type; ?>">

                        </form>
                        <script>
                            document.getElementById('redirectForm').submit();
                        </script>
                    <?php
                    } elseif ($intervention_type == 'Community') {
                    ?>
                        <form id="redirectForm" action="../category2-community.php" method="POST">
                            <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">
                            <input type="hidden" name="category_type" value="<?php echo $category_type; ?>">
                            <input type="hidden" name="violation_type" value="<?php echo $violation_type; ?>">
                            <input type="hidden" name="offense_type" value="<?php echo $offense_type; ?>">
                            <input type="hidden" name="description" value="<?php echo $description; ?>">
                            <input type="hidden" name="department" value="<?php echo $department; ?>">
                            <input type="hidden" name="notice" value="<?php echo $notice; ?>">
                            <input type="hidden" name="date_compliance" value="<?php echo $date_compliance; ?>">
                            <input type="hidden" name="intervention_type" value="<?php echo $intervention_type; ?>">


                        </form>
                        <script>
                            document.getElementById('redirectForm').submit();
                        </script>
        <?php
                    }
                }
            } else {
                throw new Exception("Student ID not found in database.");
            }
        } else {
            throw new Exception("Student ID is empty.");
        }
    } elseif (isset($print)) {
        ?>
        <form id="redirectForm" action="insert_violation.php" method="POST">
            <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">
            <input type="hidden" name="violation_type" value="<?php echo $violation_type; ?>">
            <input type="hidden" name="offense_type" value="<?php echo $offense_type; ?>">
            <input type="hidden" name="description" value="<?php echo $description; ?>">
            <input type="hidden" name="notice" value="<?php echo $notice; ?>">
            <input type="hidden" name="date_compliance" value="<?php echo $date_compliance; ?>">
            <input type="hidden" name="intervention_type" value="<?php echo $intervention_type; ?>">
            <input type="hidden" name="specify_department" value="<?php echo $department; ?>">


        </form>
        <script>
            document.getElementById('redirectForm').submit();
        </script>
<?php
    } else {
        echo "No action specified.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Function to send email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



function sendemail_verify($f_name, $l_name, $email, $notice, $formatted_date)
{
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'disciplinaryoffice000@gmail.com';
        $mail->Password = 'glup yqrn efrd qkrh';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // or PHPMailer::ENCRYPTION_SMTPS
        $mail->Port = 587; // or 465

        $mail->setFrom('disciplinaryoffice000@gmail.com', $f_name . ' ' . $l_name);
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Email Verification from AirSol';

        $email_template = "
            <div class='container'>
                <h2>This is to remind you with</h2>
                <h5>$notice</h5>
                <p>Date of Compliance: $formatted_date </p>
                <br><br>
            </div>
        ";

        $mail->Body = $email_template;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return $e->getMessage(); // Return the error message
    }
}
