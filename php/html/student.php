<?php
session_start();
$_SESSION['currentpage'] = "violation";
$username = $_SESSION['username'];
include("../database/database_conn.php");
include('php/fetch_student_data.php');

$error_message = $_SESSION['error_message'] ?? null;
unset($_SESSION['error_message']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/DOMS_logo.png" type="image/x-icon">
    <title>Student Violation</title>
    <link rel="stylesheet" href="../css/viob.css">
    <link rel="stylesheet" href="../css/student.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <script src="js/screen_timeout.js"></script>



    <script>
        <?php if ($_SESSION['redirect_url']) : ?>
            console.log("Opening new tab");
            var newTab = window.open('<?php echo $_SESSION['redirect_url']; ?>', '_blank');
        <?php endif; ?>
    </script>

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

            <form action="php/redirect_category_path.php" method="POST">
                <div class="form-container">

                    <div class="student-violation">
                        <div class="student-header info-header">
                            <h1>Student Violation</h1>
                            <hr>
                        </div>

                        <?php
  echo '<button class="back-button-studvio" onclick="history.back()">> Back</button>';
?>


                        <div class="table-nav">
                            <div class="nav-list">
                                <ul>
                                    <a href="#" style="border-bottom: solid 3px rgb(98, 130, 172)">
                                        <li>SINGLE VIOLATION</li>
                                    </a>
                                    <a href="multiple-violation.php">
                                        <li>MULTIPLE VIOLATION</li>
                                    </a>
                                    <a href="multiple-students.php">
                                        <li>MULTIPLE STUDENTS</li>
                                    </a>
                                </ul>
                            </div>
                        </div>

                        <hr>

                        <div class="student-content">

                            <div class="student-left info-left">
                                <div class="student-info info">
                                    <div class="left">
                                        <label>Student No:</label>
                                        <label>Minor Offense:</label>
                                        <label>Major Offense:</label>
                                    </div>
                                    <div class="middle">
                                        <input type="text" name="studentID" id="studentID" required>
                                        <input id="minor_count" type="text" readonly>
                                        <input id="major_count" type="text" readonly>
                                    </div>
                                </div>
                                <div class="guide">
                                    <div>
                                        <span class="green"></span>
                                        <span class="blue"></span>
                                        <span class="red"></span>
                                    </div>
                                    <div>
                                        <label>First</label>
                                        <label>Second</label>
                                        <label>Third</label>
                                    </div>
                                </div>

                                <div class="guide2">
                                    <div class="guide2-con">
                                        <span class="green"></span>
                                        <label>1st</label>
                                    </div>
                                    <div class="guide2-con">
                                        <span class="blue"></span>
                                        <label>2nd</label>
                                    </div>
                                    <div class="guide2-con">
                                        <span class="red"></span>
                                        <label>3rd</label>
                                    </div>
                                </div>
                            </div>

                            <div class="right">
                                <button type="button" id="viewProfileBtn">View Student Profile</button>
                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="violation-header info-header">
                        <div class="violation_slip">
                            <h1>Violation Slip</h1>
                        </div>
                        <div class="date" id="currentDate"></div>
                    </div>

                    <div class="violation-container">

                        <div class="violation-left info-left">
                            <div class="info">
                                <div class="left">
                                    <label>Student ID:</label>
                                    <label>Name:</label>
                                    <label>Course & Section:</label>
                                    <label>Offense Type:</label>
                                    <label>Violation Type:</label>
                                    <label>Description:</label>
                                    <label id="category_txt" style="display: none;">Category:</label>

                                </div>
                                <div class="middle">
                                    <input id="studentIDField" name="student_id_pass" placeholder="" readonly></input>
                                    <input id="nameField" readonly></input>
                                    <input id="courseField" readonly></input>
                                    <select id="offense_type" name="offense_type" required>
                                        <option value="" style="display: none;">Select Offense Type</option>
                                        <option value="Major">Major offense</option>
                                        <option value="Minor">Minor offense</option>
                                    </select>

                                    <select id="violation_type" name="violation_type" required>
                                        <option value="" style="display: none;">Select Violation Type</option>
                                    </select>

                                    <textarea id="desicriptionField" name="description" readonly></textarea>

                                    <select id="category_type" name="category_type" style="display: none;">
                                        <option value="" style="display: none;">Select Category</option>
                                        <option value="category1">Category 1</option>
                                        <option value="category2">Category 2</option>
                                    </select>

                                </div>
                            </div>

                        </div>


                        <div class="right">
                            <button id="next_btn" style="display: none;"></button>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var offenseTypeElement = document.getElementById('offense_type');
                                var descriptionField = document.getElementById('descriptionField');
                                var categoryType = document.getElementById('category_type');
                                var categoryTxt = document.getElementById('category_txt');
                                var next_btn = document.getElementById('next_btn');



                                offenseTypeElement.addEventListener('change', function() {
                                    var offenseType = offenseTypeElement.value;

                                    if (offenseType === 'Major') {
                                        next_btn.style.display = 'block';
                                        next_btn.innerHTML = "Next";
                                        categoryType.style.display = 'block';
                                        categoryTxt.style.display = 'block';
                                    } else {
                                        next_btn.style.display = 'block';
                                        next_btn.innerHTML = "Print";
                                        categoryType.style.display = 'none';
                                        categoryTxt.style.display = 'none';
                                    }
                                });
                            });
                        </script>


                    </div>

                    <hr>
                    <p style="margin-left: 20px; color:red; font-weight: bold;"><?php echo $error_message ?></p>

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
                                    <th>Status</th>
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
        var studentIDInput = document.getElementById('studentID');
        var violationTableBody = document.getElementById('violationTableBody');

        studentIDInput.addEventListener('input', function() {
            var studentID = studentIDInput.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'php/fetch_student_data.php?student_id=' + studentID, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var responseData = JSON.parse(xhr.responseText);
                    console.log(responseData);

                    document.getElementById('studentIDField').value = responseData.studentID;
                    document.getElementById('nameField').value = responseData.name;
                    document.getElementById('courseField').value = responseData.course + " - " + responseData.section;

                    // modal content
                    document.getElementById('stundet_name').textContent = responseData.name;
                    document.getElementById('student_id').textContent = responseData.studentID;
                    document.getElementById('stundet_course').textContent = responseData.course;
                    document.getElementById('stundet_dept').textContent = responseData.department;
                    document.getElementById('stundet_email').textContent = responseData.email;

                    // Clear the existing rows
                    while (violationTableBody.firstChild) {
                        violationTableBody.removeChild(violationTableBody.firstChild);
                    }

                    // Initialize counters
                    var majorCount = 0;
                    var minorCount = 0;

                    // Check if there are violations
                    if (responseData.violations && responseData.violations.length > 0) {
                        responseData.violations.forEach(function(violation) {
                            var newRow = document.createElement('tr');

                            var offenseTypeCell = document.createElement('td');
                            offenseTypeCell.textContent = violation.offense_type;
                            newRow.appendChild(offenseTypeCell);

                            var violationTypeCell = document.createElement('td');
                            violationTypeCell.textContent = violation.violation_type;
                            newRow.appendChild(violationTypeCell);

                            var dateCreatedCell = document.createElement('td');
                            dateCreatedCell.textContent = violation.date_created;
                            newRow.appendChild(dateCreatedCell);

                            violationTableBody.appendChild(newRow);

                            // Increment the counters based on offense type
                            if (violation.offense_type === 'Major') {
                                majorCount++;
                            } else if (violation.offense_type === 'Minor') {
                                minorCount++;
                            }
                        });
                    } else {
                        var noViolationRow = document.createElement('tr');
                        var noViolationCell = document.createElement('td');
                        noViolationCell.setAttribute('colspan', '3');
                        noViolationCell.textContent = 'No Violation was made';
                        noViolationRow.appendChild(noViolationCell);
                        violationTableBody.appendChild(noViolationRow);
                    }

                    console.log(majorCount);
                    console.log(minorCount);

                    var minor_count = document.getElementById('minor_count');
                    var major_count = document.getElementById('major_count');


                    switch (minorCount) {
                        case 1:
                            minor_count.style.backgroundColor = 'green';
                            break;
                        case 2:
                            minor_count.style.backgroundColor = 'blue';
                            break;
                        case 3:
                            minor_count.style.backgroundColor = 'red';
                            break;
                        default:
                            minor_count.style.backgroundColor = '';
                            break;
                    }

                    switch (majorCount) {
                        case 1:
                            major_count.style.backgroundColor = 'green';
                            break;
                        case 2:
                            major_count.style.backgroundColor = 'blue';
                            break;
                        case 3:
                            major_count.style.backgroundColor = 'red';
                            break;
                        default:
                            major_count.style.backgroundColor = '';
                            break;
                    }


                }
            };
            xhr.send();
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


<script>
    const form = document.getElementById('form');
    const formData = new FormData(form);

    var offense_type = document.getElementById('offense_type')
    var violation_type = document.getElementById('violation_type')
    var description = document.getElementById('desicriptionField')


    formData.append('violation_type', violation_type);
    formData.append('description', description);



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