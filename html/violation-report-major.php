<?php
session_start();
$_SESSION['currentpage'] = "report";
$username = $_SESSION['username'];
include("../database/database_conn.php");

//count all data
$query_count_all = "SELECT COUNT(*) AS count FROM violation_db WHERE offense_type IN ('MAJOR', 'MINOR')";
$result_count_all = mysqli_query($conn, $query_count_all);
$row_count_all = mysqli_fetch_assoc($result_count_all);
$all_count = $row_count_all['count'];

//count minor data
$query_count_minor = "SELECT COUNT(*) AS count FROM violation_db WHERE offense_type = 'MINOR'";
$result_count_minor = mysqli_query($conn, $query_count_minor);
$row_count_minor = mysqli_fetch_assoc($result_count_minor);
$minor_count = $row_count_minor['count'];

//count major data
$query_count_major = "SELECT COUNT(*) AS count FROM violation_db WHERE offense_type = 'MAJOR'";
$result_count_major = mysqli_query($conn, $query_count_major);
$row_count_major = mysqli_fetch_assoc($result_count_major);
$major_count = $row_count_major['count'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/DOMS_logo.png" type="image/x-icon">
    <title>Lost & Found</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/violation-report.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="../css/general.css">
    <script src="js/screen_timeout.js"></script>



    <style>
        td img {
            object-fit: cover;
            height: 30px;
            width: 30px;
        }
    </style>
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
                <h1>Violation Report</h1>
                <hr>
            </div>

            <div class="filter-group">
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search...">
                </div>
                <div class="dropdowns">

                    <select name="status_filter" id="status_filter" onchange="filterTable()">
                        <option value="" style="display: none;" selected>Filter Status</option>
                        <option value="Not Cleared">Not Cleared</option>
                        <option value="Completed">Completed</option>
                    </select>


                    <select name="" id="">
                        <option value="" style="display: none;" selected>Filter Course</option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>

                    <span><i class="fa-solid fa-filter"></i> Date filter</span>

                </div>
            </div>

            <div class="table-nav">
                <div class="nav-list">
                    <ul>
                        <a href="violation-report.php">
                            <li>ALL VIOLATION <span><?php echo $all_count ?></span></li>
                        </a>
                        <a href="violation-report-minor.php">
                            <li>MINOR VIOLATION <span><?php echo $minor_count ?></span></li>
                        </a>
                        <a href="#" style="border-bottom: solid 3px rgb(98, 130, 172)">
                            <li>MAJOR VIOLATION <span><?php echo $major_count ?></span></li>
                        </a>
                    </ul>
                </div>
                <div class="generate-btn">
                    <span id="generateReportBtn"><i class="fas fa-chart-bar"></i> Generate Report</span>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const generateReportBtn = document.getElementById('generateReportBtn');

                        generateReportBtn.addEventListener('click', function() {
                            const form = document.createElement('form');
                            form.setAttribute('method', 'post');
                            form.setAttribute('action', 'php/generate_report_excel.php');
                            form.style.display = 'none';

                            const fromDateInput = document.createElement('input');
                            fromDateInput.setAttribute('type', 'hidden');
                            fromDateInput.setAttribute('name', 'fromDate');
                            fromDateInput.value = document.querySelector('input[name="from"]').value;

                            const toDateInput = document.createElement('input');
                            toDateInput.setAttribute('type', 'hidden');
                            toDateInput.setAttribute('name', 'toDate');
                            toDateInput.value = document.querySelector('input[name="to"]').value;

                            form.appendChild(fromDateInput);
                            form.appendChild(toDateInput);

                            document.body.appendChild(form);

                            form.submit();
                        });
                    });
                </script>
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

                        <button id="applyFilterBtn">APPLY FILTER</button>
                    </div>

                </div>
            </div>


            <script>
                var modaldate = document.getElementById("dateModal");

                var btndate = document.querySelector(".dropdowns span");

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


            <div class="body-table">
                <form action="php/remind_major_email.php" method="POST">

                    <table id="your_table_id">
                        <thead>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Offense</th>
                            <th>Violation</th>
                            <th>Status</th>
                            <th>Date created</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                            $query = "SELECT * FROM major_db a JOIN student_db b ON a.student_id = b.student_id";

                            if (isset($_GET['status_filter']) && $_GET['status_filter'] != '') {
                                $statusFilter = $_GET['status_filter'];
                                $query .= " WHERE a.status = '$statusFilter'";
                            }

                            $result = mysqli_query($conn, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $major_id = $row['major_id'];
                                    $date_created = $row['date_created'];
                                    $violation_type = $row['violation_type'];
                                    $offense_type = $row['offense_type'];
                                    $student_id = $row['student_id'];
                                    $f_name = $row['f_name'];
                                    $l_name = $row['l_name'];
                                    $course = $row['course'];
                                    $status = $row['status'];

                                    echo "
                                    <tr>
                                        <td>$student_id</td>
                                        <td>$f_name $l_name</td>
                                        <td>$course</td>
                                        <td>$offense_type</td>
                                        <td>$violation_type</td>
                                        <td>$status</td>
                                        <td>$date_created</td>
                                        <td class='action'><button type='submit' name='major_id' value='$major_id'>Send Email</button></td>
                                    </tr>
                                    ";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No results found.</td></tr>";
                            }

                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const applyFilterBtn = document.getElementById('applyFilterBtn');

                        applyFilterBtn.addEventListener('click', function() {
                            const fromDate = document.querySelector('input[name="from"]').value;
                            const toDate = document.querySelector('input[name="to"]').value;

                            const xhr = new XMLHttpRequest();
                            xhr.open('POST', 'php/filter_report_data.php');
                            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    document.getElementById('tableBody').innerHTML = xhr.responseText;
                                }
                            };
                            xhr.send(`fromDate=${fromDate}&toDate=${toDate}`);
                        });
                    });
                </script>

            </div>




            <!-- SEND EMAIL Modal -->
            <div id="emailModal" class="modalemail">
                <div class="modal-content-email">

                    <div class="modal-header">
                        <h1>Are you sure?</h1>
                    </div>

                    <div class="modal-body">
                        <p>Do you want to send email?</p>
                    </div>
                    <div class="modal-btn">
                        <button class="close-email" id="emailCancelBtn">Cancel</button>
                        <a id="emailYesBtn">Yes</a>
                    </div>

                    <script>
                        var modal3 = document.getElementById("emailModal");

                        var btn3 = document.querySelectorAll(".action i");

                        var span3 = document.getElementsByClassName("close-email")[0];

                        btn3.onclick = function() {
                            modal3.style.display = "block";
                        }

                        span3.onclick = function() {
                            modal3.style.display = "none";
                        }

                        window.onclick = function(event) {
                            if (event.target == modal3) {
                                modal3.style.display = "none";
                            }
                        }
                    </script>

                    <!-- Modal ITEM -->
                    <div id="itemModal" class="modal-item">
                        <div class="modal-content-item">
                            <div class="modal-body">
                                <div class="modal-img">
                                    <img src="../images/logo.webp" alt="">
                                </div>

                                <hr>

                                <div class="modal-details">
                                    <div class="details-header">
                                        <h3>Founder Information</h3>
                                    </div>
                                    <div class="details-body">
                                        <div class="input-wrap">
                                            <label>Student Name:</label>
                                            <p id="">Avril Belisario</p>
                                        </div>
                                        <div class="input-wrap">
                                            <label>Student ID:</label>
                                            <p id="">2021 190723</p>
                                        </div>
                                        <div class="input-wrap">
                                            <label>Email Address:</label>
                                            <p id="student_email">beliserio@students.nu-dasma.edu.ph</p>
                                        </div>
                                        <div class="input-wrap">
                                            <label>Contact:</label>
                                            <p id="">09195367363</p>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="modal-details">
                                    <div class="details-header">
                                        <h3>Item Information</h3>
                                    </div>
                                    <div class="details-body">
                                        <div class="input-wrap">
                                            <label>Item Brand:</label>
                                            <p id="">Fibrella</p>
                                        </div>
                                        <div class="input-wrap">
                                            <label>Item Color:</label>
                                            <p id="">Black</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-buttons">
                                    <span class="close" id="close">Cancel</span>
                                    <span>Claimed</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal ADD -->
                    <div id="addModal" class="modal-add">
                        <div class="modal-content-add">

                            <span class="close-add">&times;</span>

                            <div class="add-header">
                                <h1>Add Item</h1>
                            </div>

                            <form action="">
                                <div class="modal-body-add">
                                    <div class="modal-body1">

                                        <div class="input-wrap2">
                                            <label for="student-id">Student ID:</label>
                                            <input type="text" name="student-id">
                                        </div>

                                        <div class="input-wrap2">
                                            <label for="item-type">Item Type:</label>
                                            <input type="text" name="item-type">
                                        </div>

                                        <div class="input-wrap2">
                                            <label for="item-found">Item Found:</label>
                                            <input type="text" name="item-found">
                                        </div>

                                        <div class="modal-desc">
                                            <label for="description">Description:</label>
                                            <textarea name="description" id=""></textarea>
                                        </div>

                                    </div>

                                    <div class="modal-body2">
                                        <div class="image-container" id="images"></div>
                                        <div class="upload-button">
                                            <input type="file" id="file-input" accept="image/png, image/jpeg" style="display: none;">
                                            <label for="file-input"><i class="fas fa-upload"></i> Upload</label>
                                        </div>
                                    </div>


                                    <script>
                                        document.getElementById('file-input').addEventListener('change', function(event) {
                                            const imageContainer = document.getElementById('images');
                                            const files = event.target.files;

                                            for (let i = 0; i < files.length; i++) {
                                                const file = files[i];
                                                const reader = new FileReader();

                                                reader.onload = function(e) {
                                                    const imgElement = document.createElement('img');
                                                    imgElement.src = e.target.result;
                                                    imageContainer.appendChild(imgElement);
                                                };

                                                reader.readAsDataURL(file);
                                            }
                                        });
                                    </script>

                                </div>
                                <div class="modal-form-btn">
                                    <button>SUBMIT</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <script>
                    var modal2 = document.getElementById("addModal");

                    var btn2 = document.querySelector(".add-btn span");

                    var span2 = document.getElementsByClassName("close-add")[0];

                    btn2.onclick = function() {
                        modal2.style.display = "block";
                    }

                    span2.onclick = function() {
                        modal2.style.display = "none";
                    }

                    window.onclick = function(event) {
                        if (event.target == modal2) {
                            modal2.style.display = "none";
                        }
                    }
                </script>


            </div>


        </div>

    </section>

    <script src="../javascript/profile.js"></script>
</body>

<script>
    function filterTable() {
        var selectElement = document.getElementById("status_filter");
        var selectedStatus = selectElement.value;
        var table = document.getElementById("your_table_id");
        var rows = table.getElementsByTagName("tr");

        for (var i = 1; i < rows.length; i++) {
            var statusCell = rows[i].getElementsByTagName("td")[5]; // Assuming status is the 6th column
            if (statusCell) {
                var status = statusCell.textContent || statusCell.innerText;
                if (selectedStatus === "" || status === selectedStatus) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    }
</script>


</html>