<?php
include('../../database/database_conn.php');
require '../../vendor/autoload.php';
// Function to send email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$major_id = $_POST['major_id'];


$stmt = $conn->prepare("SELECT * FROM major_db a JOIN student_db b ON a.student_id = b.student_id JOIN intervention_db c ON a.major_id = c.major_id WHERE a.major_id = ?");
$stmt->bind_param("i", $major_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    $f_name = $user['f_name'];
    $l_name = $user['l_name'];
    $email = $user['email'];
    $notice = $user['notice_explain'];
    $due_date = $user['due_date'];
    $formatted_due_date = date("F j, Y", strtotime($due_date));

    sendemail_verify($f_name, $l_name, $email, $notice, $formatted_due_date);
    header('Location: ../violation-report-major.php');
}

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
