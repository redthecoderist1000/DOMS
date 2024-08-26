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
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <div class="top">
        <header>
            <h1>Home</h1>
        </header>
    </div>



    <section>
        <div class="announcement">
            <div class="announce-header">
                <h3>Announcement</h3>
            </div>
            <div class="announce-info">
                <p>asdasdadas</p>
            </div>
        </div>

        <div class="image">
            <img src="images/DOMS_logo.png" alt="">
        </div>

        <div class="navigations">

            <a href="violation.php">
                <div class="nav1 nav">
                    <div class="icon">
                        <!-- <h5>1</h5> -->
                        <i class="fa-solid fa-exclamation"></i>
                    </div>
                    <p>Violation</p>
                </div>
            </a>

            <a href="entry-pass.php">
                <div class="nav4 nav">
                    <div class="icon">
                        <!-- <h5>1</h5> -->
                        <i class="fa-solid fa-door-open"></i>
                    </div>
                    <p>Entry Pass</p>
                </div>
            </a>

            <a href="admission.php">
                <div class="nav5 nav">
                    <div class="icon">
                        <!-- <h5>1</h5> -->
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                    <p>Admission</p>
                </div>
            </a>

            <a href="profile.php">
                <div class="nav2 nav">
                    <i class="fa-solid fa-user"></i>
                    <p>Profile</p>
                </div>
            </a>

            <a href="">
                <div class="nav3 nav">
                    <i class="fa-solid fa-book-open"></i>
                    <p>Handbook</p>
                </div>
            </a>

            <a href="">
                <div class="nav6 nav">
                    <i class="fa-solid fa-scroll"></i>
                    <p>Good Moral</p>
                </div>
            </a>

        </div>
    </section>
    <footer class="bottom">
        <img src="images/DOMS_logo1.png" alt="">
        <div class="name">
            <h3>DISCIPLINE OFFICE</h3>
            <p>Management System</p>
        </div>
    </footer>
</body>

</html>