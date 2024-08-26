<?php
session_start();
$_SESSION['currentpage'] = "madmin";
$username = $_SESSION['username'];
include("../database/database_conn.php");
include('php/fetch_student_data.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/DOMS_logo.png" type="image/x-icon">
    <title>Manage Admin Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/manage.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/viob.css">
    <script src="js/screen_timeout.js"></script>


</head>

<body>

    <div class="sidenav">
        <?php include('sidenav/sidenav.php'); ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headerBtn = document.querySelector('.header-btn');
            const sidenav = document.querySelector('.sidenav');

            headerBtn.addEventListener('click', () => {
                sidenav.classList.toggle('active');
            });
        });
    </script>

    <div class="header-btn">
        <i class="fas fa-bars"></i>
    </div>

    <section class="main-do">


        <div class="body-content">
            <div class="title-page">
                <h1>Manage Admin Account</h1>
                <hr>
            </div>

            <?php

$buttonText = "Add";
$buttonLink = "wala pa (example: announcement.php)"; 
echo '<button type="button" class="add-admin-button" onclick="window.location.href=\'' . $buttonLink . '\'">' . $buttonText . '</button>';

?>



<?php

$buttonText = "Remove";
$buttonLink = "wala pa (example: announcement.php)"; 
echo '<button type="button" class="remove-admin-button" onclick="window.location.href=\'' . $buttonLink . '\'">' . $buttonText . '</button>';

?>

<div class="body-table">
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            