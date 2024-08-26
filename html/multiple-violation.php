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
                                    <a href="#" style="border-bottom: solid 3px rgb(98, 130, 172)">
                                        <li>MULTIPLE VIOLATION</li>
                                    </a>
                                    <a href="multiple-students.php">
                                        <li>MULTIPLE STUDENTS</li>
                                    </a>
                                </ul>
                            </div>
                        </div>

                        <hr>

                        <div class="violation-header info-header">
                            <div class="violation_slip">
                                <h1>Violation Slip No: 000000</h1>
                            </div>
                            <div class="date" id="currentDate"></div>
                        </div>

                        <div class="violation-container1">

                            <div class="violation-left info-left1">
                                <div class="multi-left">
                                    <div class="input-wrap">
                                        <label for="id">Student ID:</label>
                                        <input name="id" id="studentIDField" placeholder=""></input>
                                    </div>

                                    <div class="input-wrap">
                                        <label for="name">Name:</label>
                                        <input name="name" id="nameField"></input>
                                    </div>

                                    <div class="input-wrap">
                                        <label for="course">Course & Section:</label>
                                        <input name="course" id="courseField"></input>
                                    </div>

                                    <div class="input-wrap">
                                        <label for="offense_type">Offense Type:</label>
                                        <select id="offense_type" name="offense_type">
                                            <option value="" style="display: none;">Select Offense Type</option>
                                            <option value="Major">Major offense</option>
                                            <option value="Minor">Minor offense</option>
                                        </select>
                                    </div>

                                    <div class="violation-header2">
                                        <div class="violation_slip">
                                            <h1>Violation</h1>
                                        </div>
                                        <span id="add_btn"><i class="fa-solid fa-plus"></i></span>
                                    </div>

                                    <div id="violation_box" class="input-wrap">
                                        <div class="blank-label"></div>
                                        <select id="violation_type" name="violation_type">
                                            <option value="" style="display: none;">Select Violation Type</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="right">
                                <button id="printBtn">PRINT</button>
                            </div>
                        </div>

                        <script>
                            document.getElementById('add_btn').addEventListener('click', function() {
                                var originalDiv = document.getElementById('violation_box');
                                var newDiv = originalDiv.cloneNode(true);

                                newDiv.querySelector('select').selectedIndex = 0;

                                // Find the last occurrence of the input-wrap class
                                var lastInputWrap = document.querySelector('.input-wrap:last-child');

                                // Insert the newDiv after the last input-wrap
                                lastInputWrap.parentNode.insertBefore(newDiv, lastInputWrap.nextSibling);
                            });
                        </script>




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
        var studentIDInput = document.getElementById('studentIDField');
        var violationTableBody = document.getElementById('violationTableBody');


        studentIDInput.addEventListener('input', function() {
            var studentID = studentIDInput.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'php/fetch_student_data.php?student_id=' + studentID, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var responseData = JSON.parse(xhr.responseText);
                    console.log(responseData);

                    document.getElementById('nameField').value = responseData.name;
                    document.getElementById('courseField').value = responseData.course + " - " + responseData.section;

                    // modal content
                    document.getElementById('stundet_name').textContent = responseData.name;
                    document.getElementById('student_id').textContent = responseData.studentID;
                    document.getElementById('stundet_course').textContent = responseData.course;
                    document.getElementById('stundet_dept').textContent = responseData.department;
                    document.getElementById('stundet_email').textContent = responseData.email;


                }
            };
            xhr.send();

            document.getElementById('printBtn').addEventListener('click', function() {
                var violationType = document.getElementById('violation_type').value;
                var studentID = document.getElementById('studentID').value;

                var printWindow = window.open('printable/print.php?violation_type=' + encodeURIComponent(violationType) + '&studentID=' + encodeURIComponent(studentID), '_blank');

                printWindow.addEventListener('load', function() {
                    printWindow.print();
                    printWindow.close();
                }, {
                    once: true
                });
            });
        });


        document.getElementById('printBtn').addEventListener('click', function() {
            var violationType = document.getElementById('violation_type').value;
            var studentID = document.getElementById('studentID').value;

            var printWindow = window.open('printable/print.php?violation_type=' + encodeURIComponent(violationType) + '&studentID=' + encodeURIComponent(studentID), '_blank');

            printWindow.addEventListener('load', function() {
                printWindow.print();
                printWindow.close();
            }, {
                once: true
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

<script>
    const form = document.getElementById('form');
    const formData = new FormData(form);

    var offense_type = document.getElementById('offense_type')
    var violation_type = document.getElementById('violation_type')


    formData.append('violation_type', violation_type);



    fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                if (response.redirected) {
                    window.location.href = response.url;
                } else {
                    return response.text();
                }
            }
            throw new Error('Network response was not ok.');
        })
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
</script>

</html>