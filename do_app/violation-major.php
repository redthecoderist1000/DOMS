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
    <title>Violation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="css/violation.css">
</head>

<body>
    <div class="top">
        <header>
            <a href="home.php"><i class="fa-solid fa-left-long"></i></a>
            <h1>Violation</h1>
        </header>
    </div>
    <section>
        <div class="violation-nav">
            <a href="violation.php">Minor</a>
            <a href="#" style="color: #FCD116; border-bottom: solid 3px #FCD116;">Major</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Offense</th>
                    <th>Violation</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Intervention</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM major_db a
                            JOIN intervention_db b ON a.major_id = b.major_id
                             WHERE student_id = '$student_id'";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $major_id = $row['major_id'];
                        $offense_type = $row['offense_type'];
                        $violation_type = $row['violation_type'];
                        $date_created = $row['date_created'];
                        $status = $row['status'];

                        $intervention_type = $row['intervention_type'];
                        $due_date = $row['due_date'];
                        $formatted_date = date('F j, Y', strtotime($due_date));
                        $specify_department = $row['specify_department'] ?? '';

                        echo '
                    <tr>
                        <td class="major-row" data-major-id="' . $major_id . '" data-due-date="' . $formatted_date . '" data-department="' . htmlspecialchars($specify_department, ENT_QUOTES, 'UTF-8') . '" data-status="' . $status . '">' . $offense_type . '</td>
                        <td class="major-row" data-major-id="' . $major_id . '" data-due-date="' . $formatted_date . '" data-department="' . htmlspecialchars($specify_department, ENT_QUOTES, 'UTF-8') . '" data-status="' . $status . '">' . $violation_type . '</td>
                        <td class="major-row" data-major-id="' . $major_id . '" data-due-date="' . $formatted_date . '" data-department="' . htmlspecialchars($specify_department, ENT_QUOTES, 'UTF-8') . '" data-status="' . $status . '">' . $date_created . '</td>
                        <td class="major-row" data-major-id="' . $major_id . '" data-due-date="' . $formatted_date . '" data-department="' . htmlspecialchars($specify_department, ENT_QUOTES, 'UTF-8') . '" data-status="' . $status . '">' . $status . '</td>
                        <td class="major-row" data-major-id="' . $major_id . '" data-due-date="' . $formatted_date . '" data-department="' . htmlspecialchars($specify_department, ENT_QUOTES, 'UTF-8') . '" data-status="' . $status . '">' . $intervention_type . '</td>
                        <td><a href="violation-slip.php?major_id=' . urlencode($major_id) . '"><i class="fa-solid fa-angle-right"></i></a></td>
                    </tr>
                        ';
                    }
                } else {
                    echo " 
                        <tr><td colspan='5'>You have no violation.</td></tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- Modal Violation -->
    <div id="violationModal" class="modal-violation">
        <div class="modal-content-violation">
            <span class="close-violation">&times;</span>
            <form action="" method="POST">
                <div class="modal-violation-details">
                    <label for="date">Due date of compliance:</label>
                    <input type="text" name="date" id="date" value="" readonly>
                    <label id="txt_dept" for="department">Department:</label>
                    <input type="text" name="department" id="department" value="" readonly>
                    <label for="status">Status:</label>
                    <input type="text" name="status" id="status" value="" readonly>
                </div>
            </form>
        </div>
    </div>

    <script>
        var modalviolation = document.getElementById("violationModal");
        var btnviolation = document.querySelectorAll('.major-row');
        var spanviolation = document.getElementsByClassName("close-violation")[0];

        btnviolation.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var dueDate = btn.getAttribute('data-due-date');
                var department = btn.getAttribute('data-department');
                var status = btn.getAttribute('data-status');

                document.getElementById('date').value = dueDate;
                var specify_dept = document.getElementById('department');
                var txt_dept = document.getElementById('txt_dept');

                if (department === '') {
                    specify_dept.style.display = 'none';
                    txt_dept.style.display = 'none';

                } else {
                    specify_dept.style.display = 'block';
                    txt_dept.style.display = 'block';

                    specify_dept.value = department;
                }

                document.getElementById('status').value = status;

                modalviolation.style.display = "block";
            });
        });

        spanviolation.onclick = function() {
            modalviolation.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modalviolation) {
                modalviolation.style.display = "none";
            }
        }
    </script>
</body>

</html>