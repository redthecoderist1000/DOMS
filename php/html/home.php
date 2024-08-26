<?php
session_start();
if (!isset($_SESSION['admin_username']) && !isset($_SESSION['admin_role'])) {
    header("Location: login-page.php");
} else {
$_SESSION['currentpage'] = "home";
include("../database/database_conn.php");
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
    <link rel="stylesheet" href="../css/viob.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/screen_timeout.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" 
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

<button type="button" class="all-announcement-button">ANNOUNCEMENT</button>

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
                <?php
                include('php/home-school.php');
                ?>
            </div>

            <hr>

            <div class="department-info">
                <?php include('php/home-content-populate.php'); ?>
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
                $(document).ready(function(){
                    $('.school-button').on('click', function(event){
                        $('.school-button').attr('style', '');
                        $(this).attr('style', 'background-color: var(--div-primary-color); color: white;');
                        let id = $(this).attr('data-id');
                        $.ajax({
                            type: "POST",
                            url: "php/home-content.php",
                            data: {id: id},
                            success:function(response){
                                $('.department-info').empty();
                                let JsonData = JSON.parse(response);
                                console.log(JsonData);
                                if(id != 0){
                                $.each(JsonData, function(index,value){
                                    $('.department-info').append(`<div class="dept dept1">
                        <div class="color color1"></div>
                        <div class="dept-info dept-info1">
                        <p>${value.department_name} Dept.</p>
                        </div>
                        <p>?%</p>
                    </div>`);
                                })
                            }else{
                                $.each(JsonData, function(index,value){
                                    $('.department-info').append(`<div class="dept dept1">
                        <div class="color color1"></div>

                        <div class="dept-info dept-info1">
                        <p>(${value.school_acronym}) ${value.school_name}</p>
                        </div>
                        <p>?%</p>
                    </div>`)
                                })
                            }
                            }
                        })
                    })
                    
                })
            </script>

        </div>
    </section>

</body>

</html>
<?php
}



?>