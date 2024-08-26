<?php
session_start();
include('../../database/database_conn.php');
$category_type = $_POST['category_type'];
$studentID = $_POST['studentID'];
$violation_type = $_POST['violation_type'];
$offense_type = $_POST['offense_type'];
$description = $_POST['description'];

$stmt = $conn->prepare("SELECT * FROM student_db WHERE student_id = ?");
$stmt->bind_param("s", $studentID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {

    //for major category 1 execution
    if ($category_type == 'category1') {
?>
        <form id="redirectForm" action="../category1.php" method="POST">
            <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">
            <input type="hidden" name="category_type" value="<?php echo $category_type; ?>">
            <input type="hidden" name="violation_type" value="<?php echo $violation_type; ?>">
            <input type="hidden" name="offense_type" value="<?php echo $offense_type; ?>">
            <input type="hidden" name="description" value="<?php echo $description; ?>">
        </form>
        <script>
            document.getElementById('redirectForm').submit();
        </script>
    <?php

        //for major category 2 execution
    } elseif ($category_type == 'category2') {
    ?>
        <form id="redirectForm" action="../category2-counsil.php" method="POST">
            <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">
            <input type="hidden" name="category_type" value="<?php echo $category_type; ?>">
            <input type="hidden" name="violation_type" value="<?php echo $violation_type; ?>">
            <input type="hidden" name="offense_type" value="<?php echo $offense_type; ?>">
            <input type="hidden" name="description" value="<?php echo $description; ?>">
        </form>
        <script>
            document.getElementById('redirectForm').submit();
        </script>
    <?php

        //for minor execution
    } else {
    ?>
        <form id="redirectForm" action="insert_violation.php" method="POST">
            <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">
            <input type="hidden" name="violation_type" value="<?php echo $violation_type; ?>">
            <input type="hidden" name="offense_type" value="<?php echo $offense_type; ?>">
            <input type="hidden" name="description" value="<?php echo $description; ?>">
        </form>
        <script>
            document.getElementById('redirectForm').submit();
        </script>
<?php
    }
} else {
    $_SESSION['error_message'] = "No student ID found";
    header('Location: ../student.php');
    exit();
}
?>