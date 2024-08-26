<?php
$currentpage = isset($_SESSION['currentpage']) ? $_SESSION['currentpage'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="top-sidenav">
        <div class="sidenav-btn">
            <i class="fas fa-bars"></i>
        </div>
        <div class="nu">
            <img src="../images/DOMS_logo1.png" alt="img">
            <h3>DISCIPLINE OFFICE</h3>
            <hr>
            <p>Management System.</p>
        </div>

    </div>

    <div class="menu">
        <a <?php if ($currentpage != 'home') {
                echo 'href="home.php"';
            } else {
                echo 'class="active"';
            } ?>>Home</a>
        <a <?php if ($currentpage != 'manage') {
                echo 'href="manage.php"';
            } else {
                echo 'class="active"';
            } ?>>Manage Student Account</a>
        <a <?php if ($currentpage != 'lost') {
                echo 'href="claimed.php"';
            } else {
                echo 'class="active"';
            } ?>>Lost & Found</a>
        <a <?php if ($currentpage != 'violation') {
                echo 'href="violation.php"';
            } else {
                echo 'class="active"';
            } ?>>Violation Control</a>
       <a <?php if ($currentpage != 'madmin') {
                echo 'href="madmin.php"';
            } else {
                echo 'class="active"';
            } ?>>Manage Admin Account</a>
            <a <?php if ($currentpage != 'issued') {
                echo 'href="issued.php"';
            } else {
                echo 'class="active"';
            } ?>>Issue Documentation</a>
        
    </div>
    <div class="logout">
        <a href="php/logout.php">LOG OUT</a>
    </div>
</body>

</html>