<?php
session_start();
$_SESSION['currentpage'] = "home";
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
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="../css/general.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/screen_timeout.js"></script>



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

            <div class="title-page">
                <h1>Dashboard</h1>
                <hr>
            </div>

            <div class="body-header">
                <h3>DEPARTMENT</h3>
                <span><i class="fa-solid fa-filter"></i> Date filter</span>
            </div>

            <!-- Modal DATE -->
            <div id="dateModal" class="modal-date">
                <div class="modal-content-date">
                    <span class="close-date">&times;</span>
                    <div class="date-header">
                        <h2>FILTER DATE</h2>
                    </div>
                    <div class="modal-date-details">
                        <div class="input-date">
                            <label for="from">From</label>
                            <input type="date" name="from">
                        </div>
                        <div class="input-date">
                            <label for="to">To</label>
                            <input type="date" name="to">
                        </div>
                        <button>APPLY FILTER</button>
                    </div>
                </div>
            </div>

            <script>
                var modaldate = document.getElementById("dateModal");
                var btndate = document.querySelector(".body-header span");
                var spandate = document.getElementsByClassName("close-date")[0];

                btndate.onclick = function() {
                    modaldate.style.display = "block";
                }

                spandate.onclick = function() {
                    modaldate.style.display = "none";
                }

                window.onclick = function(event) {
                    if (event.target == modaldate) {
                        modaldate.style.display = "none";
                    }
                }
            </script>

            <div class="body-nav">
                <a href="home.php"><span>ALL</span></a>
                <a href="#" style="background-color: var(--div-primary-color); color: white;"><span>SASE</span></a>
                <a href="home-SBMA.php"><span>SBMA</span></a>
                <a href="home-SECA.php"><span>SECA</span></a>
            </div>

            <hr>

            <div class="department-display">

                <div class="department-info">
                    <div class="dept dept1">
                        <div class="color color1"></div>

                        <div class="dept-info dept-info1">
                            <p>Psychology Dept.</p>
                        </div>

                        <p>40%</p>
                    </div>

                    <div class="dept dept2">
                        <div class="color color2"></div>

                        <div class="dept-info dept-info2">
                            <p>AB Communication Dept.</p>
                        </div>

                        <p>32%</p>
                    </div>

                    <div class="dept dept3">
                        <div class="color color3"></div>

                        <div class="dept-info dept-info3">
                            <p>Physical Education Dept.</p>
                        </div>

                        <p>28%</p>
                    </div>
                </div>

                <hr>

                <div class="department-info2">

                <div class="department-charts">
                    <div class="chart-column doughnut-chart">
                        <h3>Minor Offense</h3>
                        <canvas id="doughnut-chart1"></canvas>
                    </div>

                    <div class="chart-column doughnut-chart">
                        <h3>Major Offense</h3>
                        <canvas id="doughnut-chart2"></canvas>
                    </div>
                </div>

                <div class="department-announce">
                    <div class="announce-header">
                        <h2>Announcement</h2>
                    </div>

                    <div class="announce-body">
                        <form id="announcement_form" action="php/insert_announcement.php" method="POST">
                            <?php
                            $query = "SELECT * FROM announcement_db";
                            $result = mysqli_query($conn, $query);

                            $announcement = "";
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $announcement = $row['announcement'];
                                }
                            }
                            ?>
                            <textarea name="announcement_content" id="announcement_content" readonly><?php echo htmlspecialchars($announcement); ?></textarea>
                            <div class="announce-button">
                                <button style="background-color: yellow; color:black;" type="button" onclick="enableEdit()">Edit</button>
                                <button type="submit" name="action" value="post">Post</button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    function enableEdit() {
                        var textarea = document.getElementById('announcement_content');
                        textarea.removeAttribute('readonly');
                    }
                </script>

            </div>

            </div>

            <script>
                // Doughnut Chart1
                var doughnutChartCanvas = document.getElementById('doughnut-chart1');
                var doughnutChart = new Chart(doughnutChartCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: ['No ID', 'Improper Uniform', 'Cheating'],
                        datasets: [{
                            label: 'Doughnut Chart',
                            data: [30, 30, 40],
                            backgroundColor: ['#e86c6c', '#18c0d3', '#e8d56c'],
                            borderWidth: 1
                        }]
                    }
                });

                // Doughnut Chart2
                var doughnutChartCanvas = document.getElementById('doughnut-chart2');
                var doughnutChart = new Chart(doughnutChartCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: ['No ID', 'Improper Uniform', 'Cheating'],
                        datasets: [{
                            label: 'Doughnut Chart',
                            data: [30, 30, 40],
                            backgroundColor: ['#e86c6c', '#18c0d3', '#e8d56c'],
                            borderWidth: 1
                        }]
                    }
                });
            </script>

        </div>
    </section>

    <script src="../javascript/home.js"></script>
</body>

</html>