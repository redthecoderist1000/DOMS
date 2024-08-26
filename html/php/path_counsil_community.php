<?php
$counseling = $_POST['counseling'] ?? NULL;
$community = $_POST['community'] ?? NULL;

$category_type = $_POST['category_type'];
$studentID = $_POST['studentID'];
$violation_type = $_POST['violation_type'];
$offense_type = $_POST['offense_type'];
$description = $_POST['description'];

if ($counseling == 'COUNSELING') {
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

} elseif ($community == 'COMMUNITY SERVICE') {
?>
    <form id="redirectForm" action="../category2-community.php" method="POST">
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
}// if may bug mag lagay ng error handler dito sa line na to mismo
