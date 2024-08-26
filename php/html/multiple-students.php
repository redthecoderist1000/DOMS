<?php
session_start();
$_SESSION['currentpage'] = "student";
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
    <title>Student Violation</title>
    <link rel="stylesheet" href="../css/student.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="js/screen_timeout.js"></script>

    <style>
        .add.added {
            cursor: not-allowed;
        }

        .add.added .plus i {
            color: grey;
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

            <form action="php/insert_violation.php" method="POST">
                <div class="form-container">

                    <div class="student-violation">
                        <div class="student-header info-header">
                            <h1>Student Violation</h1>
                            <hr>
                        </div>

                        <div class="table-nav">
                            <div class="nav-list">
                                <ul>
                                    <a href="student.php">
                                        <li>SINGLE VIOLATION</li>
                                    </a>
                                    <a href="multiple-violation.php">
                                        <li>MULTIPLE VIOLATION</li>
                                    </a>
                                    <a href="#" style="border-bottom: solid 3px rgb(98, 130, 172)">
                                        <li>MULTIPLE STUDENTS</li>
                                    </a>
                                </ul>
                            </div>
                        </div>


                        <div class="filter-group">
                            <div class="search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="text" placeholder="Search...">
                            </div>
                            <div class="dropdowns">

                                <select name="" id="">
                                    <option value="" style="display: none;" selected>Filter Course</option>
                                    <option value=""></option>
                                    <option value=""></option>
                                </select>

                                <select name="" id="">
                                    <option value="" style="display: none;" selected>Filter Section</option>
                                    <option value=""></option>
                                    <option value=""></option>
                                </select>

                            </div>
                        </div>


                        <div class="student-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Section</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $query = "SELECT * FROM student_db";
                                $result = mysqli_query($conn, $query);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $student_id = $row['student_id'];
                                        $f_name = $row['f_name'];
                                        $m_name = $row['m_name'];
                                        $l_name = $row['l_name'];
                                        $department = $row['department'];
                                        $section = $row['section'];
                                        $course = $row['course'];
                                        $email = $row['email'];
                                        $gender = $row['gender'];

                                        echo ' 
                                        <tbody>
                                            <tr>
                                                <td>' . $student_id . '</td>
                                                <td>' . $f_name . ' ' . $m_name . ' ' . $l_name . '</td>
                                                <td>' . $course . '</td>
                                                <td>' . $section . '</td>
                                                <td class="add" data-id="' . $student_id . '" data-name="' . $f_name . ' ' . $m_name . ' ' . $l_name . '" data-course="' . $course . '" data-section="' . $section . '">
                                                    <span class="plus"><i class="fa-solid fa-plus"></i></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    ';
                                    }
                                }
                                ?>

                            </table>
                        </div>

                    </div>

                    <div class="violation-header info-header">
                        <div class="violation_slip">
                            <h1>Violation Student List</h1>
                        </div>
                        <div class="date" id="currentDate"></div>
                    </div>

                    <div class="violation-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Section</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- violated student data here -->
                            </tbody>
                        </table>
                    </div>

                    <div class="violation-container1">

                        <div class="violation-left info-left">
                            <div class="multi-left">
                                <div class="input-wrap">
                                    <label for="offense_type">Offense Type:</label>
                                    <select id="offense_type" name="offense_type">
                                        <option value="" style="display: none;">Select Offense Type</option>
                                        <option value="Major">Major offense</option>
                                        <option value="Minor">Minor offense</option>
                                    </select>
                                </div>

                                <div class="input-wrap">
                                    <label for="violation_type">Violation Type:</label>
                                    <select id="violation_type" name="violation_type">
                                        <option value="" style="display: none;">Select Violation Type</option>
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="input-wrap">
                                    <label for="description">Description:</label>
                                    <textarea id="desicriptionField" name="description"></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="right">
                            <button id="printBtn">PRINT</button>
                        </div>

                    </div>

                    <hr>


                </div>
            </form>

        </div>

        <!-- Modal Structure -->
        <div id="studentProfileModal" class="modal">
            <div class="modal-content">

                <span class="close">&times;</span>

                <div class="modal-name">
                    <h1 id="stundet_name"></h1>
                    <p id="student_id"></p>
                </div>

                <div class="modal-body">

                    <div class="modal-details">

                        <div class="input-wrap">
                            <label>Course & Section:</label>
                            <p id="stundet_course"></p>
                        </div>

                        <div class="input-wrap">
                            <label>Department:</label>
                            <p id="stundet_dept"></p>
                        </div>

                        <div class="input-wrap">
                            <label>School Email:</label>
                            <p id="stundet_email"></p>
                        </div>

                    </div>

                    <hr>

                    <div class="modal-record">
                        <div class="record-header">
                            <h1>Student Record</h1>
                            <div class="record-offense">
                                <div class="minor-major">
                                    <h4>Major Offense: <span>1</span></h4>
                                </div>
                                <div class="minor-major">
                                    <h4>Minor Offense: <span>1</span></h4>
                                </div>
                            </div>
                        </div>

                        <div class="modal-table">
                            <table>
                                <thead>
                                    <th>Offense Type</th>
                                    <th>Violation Type</th>
                                    <th>Date</th>
                                </thead>
                                <tbody id="violationTableBody">


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <script src="../javascript/profile.js"></script>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle sidebar code here

        const addButtons = document.querySelectorAll('.add');
        const violationTableBody = document.querySelector('.violation-table tbody');

        addButtons.forEach(button => {
            button.addEventListener('click', function() {
                const studentId = button.getAttribute('data-id');
                const studentName = button.getAttribute('data-name');
                const studentCourse = button.getAttribute('data-course');
                const studentSection = button.getAttribute('data-section');

                // Check if the student is already added
                const existingRow = violationTableBody.querySelector(`tr[data-id="${studentId}"]`);
                if (existingRow) {
                    alert("Student is already added.");
                    return;
                }

                // Add student information to the violation table
                const newRow = document.createElement('tr');
                newRow.setAttribute('data-id', studentId);
                newRow.innerHTML = `
                <td>${studentId}</td>
                <td>${studentName}</td>
                <td>${studentCourse}</td>
                <td>${studentSection}</td>
                <td id="delete"><span><i class="fa-solid fa-trash-can deleteViolationBtn" style="color: #D40000; cursor: pointer;"></i></span></td>
            `;
                violationTableBody.appendChild(newRow);

                // Change the appearance of the add button
                button.classList.add('added');
                button.querySelector('.plus').innerHTML = '<i class="fa-solid fa-check" style="color: grey;"></i>';

                // Add delete functionality
                newRow.querySelector('.deleteViolationBtn').addEventListener('click', function() {
                    violationTableBody.removeChild(newRow);
                    button.classList.remove('added');
                    button.querySelector('.plus').innerHTML = '<i class="fa-solid fa-plus"></i>';
                });
            });
        });
    });
</script>


<!-- Script for Violation Type -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var offenseTypeSelect = document.getElementById('offense_type');

        offenseTypeSelect.addEventListener('change', function() {
            var offenseType = offenseTypeSelect.value;

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'php/fetch_violation_data.php?offense_type=' + offenseType, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var responseData = JSON.parse(xhr.responseText);

                    var violationTypeSelect = document.getElementById('violation_type');

                    violationTypeSelect.innerHTML = '';

                    var defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = 'Select Violation Type';
                    defaultOption.style.display = 'none';
                    violationTypeSelect.appendChild(defaultOption);

                    responseData.forEach(function(violation) {
                        var option = document.createElement('option');
                        option.value = violation.violation_type;
                        option.textContent = violation.violation_type;
                        violationTypeSelect.appendChild(option);
                    });
                }
            };
            xhr.send();
        });
    });
</script>


<!-- Script for description -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var violationTypeSelect = document.getElementById('violation_type');

        violationTypeSelect.addEventListener('change', function() {
            var violationType = violationTypeSelect.value;

            if (!violationType) {
                document.getElementById('desicriptionField').textContent = '';
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'php/fetch_description_data.php?violation_type=' + encodeURIComponent(violationType), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var responseData = JSON.parse(xhr.responseText);
                        if (responseData && responseData.description) {
                            document.getElementById('desicriptionField').textContent = responseData.description;
                        } else {
                            document.getElementById('desicriptionField').textContent = '';
                        }
                    } else {
                        console.error('Failed to fetch description data. HTTP status:', xhr.status);
                    }
                }
            };
            xhr.send();
        });
    });
</script>



</html>