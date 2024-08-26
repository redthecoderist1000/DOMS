<?php
session_start();
$_SESSION['currentpage'] = "violation";
$username = $_SESSION['username'];
include("../database/database_conn.php");

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
    <title>Violation Control</title>
    <link rel="stylesheet" href="../css/violation.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/general.css">
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
                <h1>Manage Student Account</h1>
                <hr>
            </div>

            <div class="filter-group">
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search...">
                </div>
            </div>

            <div class="table-nav">
                <div class="nav-list">
                    <ul>
                        <a href="violation.php">
                            <li>MINOR VIOLATION <span><?php echo $minor_count ?></span></li>
                        </a>
                        <a href="#" style="border-bottom: solid 3px rgb(98, 130, 172)">
                            <li>MAJOR VIOLATION <span><?php echo $major_count ?></span></li>
                        </a>
                    </ul>
                </div>
                <div class="add-btn">
                    <span><i class="fa-solid fa-plus"></i> ADD</span>
                </div>
            </div>

            <div class="body-table">
                <table>
                    <thead>
                        <th>VIOLATION TYPE</th>
                        <th>DESCRIPTION</th>
                        <th>ACTION</th>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM violation_db WHERE offense_type = 'MAJOR'";
                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $violation_id = $row['violation_id'];
                                urlencode($violation_id);
                                $offense_type = $row['offense_type'];
                                $violation_type = $row['violation_type'];
                                $description = $row['description'];

                                echo '
                                <tr>
                                    <td>' . $violation_type . '</td>
                                    <td>' . $description . '</td>
                                    <td>
                                        <i class="fa-regular fa-pen-to-square editViolationBtn" style="color:#1B4284; cursor:pointer; margin-right: 5px;"></i>
                                        <i class="fa-solid fa-trash-can deleteViolationBtn" style="color: #D40000; cursor: pointer;" data-id="' . $violation_id . '"></i>
                                    </td>
                                </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal ADD -->
            <div id="addModal" class="modal-add">
                <div class="modal-content-add">

                    <span class="close-add">&times;</span>

                    <div class="add-header">
                        <h1>Add Violation</h1>
                    </div>

                    <form action="php/insert_violation_data.php" method="POST">
                        <div class="modal-body-add">

                            <div class="offense">
                                <label for="offense_type">Offense Type:</label>
                                <select id="offense" name="offense_type">
                                    <option value="offense" style="display: none;">Select Offense</option>
                                    <option value="MINOR">Minor Offense</option>
                                    <option value="MAJOR">Major Offense</option>
                                </select>
                            </div>

                            <div class="text">

                                <label for="violation_type">Violation Type:</label>
                                <input type="text" name="violation_type">

                                <label for="description">Description:</label>
                                <textarea name="description" id="description"></textarea>
                            </div>


                            <div class="add-button">
                                <button>ADD</button>
                            </div>

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


        <!-- Delete Modal -->
        <div id="deleteViolationModal" class="modaldel">
            <div class="modal-content-del">

                <div class="modal-header">
                    <h1>Are you sure?</h1>
                </div>

                <div class="modal-body">
                    <p>Do you want to delete this violation?</p>
                </div>
                <div class="modal-btn">
                    <button id="deleteCancelBtn">Cancel</button>
                    <a id="deleteYesBtn">Yes</a>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const deleteButtons = document.querySelectorAll('.deleteViolationBtn');
                        const deleteViolationModal = document.getElementById('deleteViolationModal');
                        const deleteYesBtn = document.getElementById('deleteYesBtn');
                        const deleteCancelBtn = document.getElementById('deleteCancelBtn');

                        deleteButtons.forEach(button => {
                            button.addEventListener('click', function() {
                                const violationId = this.getAttribute('data-id');
                                deleteViolationModal.style.display = 'block';

                                deleteYesBtn.addEventListener('click', function() {
                                    window.location.href = 'php/delete_violation_data.php?violation_id=' + encodeURIComponent(violationId);
                                });

                                deleteCancelBtn.addEventListener('click', function() {
                                    deleteViolationModal.style.display = 'none';
                                });
                            });
                        });
                    });
                </script>



            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editViolationModal" class="modaledit">
            <div class="modal-content-edit">

                <div class="edit-header">
                    <h1>Edit Violation</h1>
                </div>

                <form id="editViolationForm" action="php/edit_violation_data.php" method="post">

                    <input type="hidden" name="violation_id" id="editViolationId">
                    <label for="violationDetails">Violation Details:</label>
                    <input type="text" name="violationDetails" id="violationDetails">

                    <label for="description">Description:</label>
                    <textarea name="description" id="description"></textarea>

                    <div class="edit-button">
                        <button type="button" id="editCancelBtn">Cancel</button>
                        <button type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {


                var editViolationBtns = document.querySelectorAll('.editViolationBtn');
                var editViolationModal = document.getElementById('editViolationModal');
                var editCancelBtn = document.getElementById('editCancelBtn');
                var editViolationForm = document.getElementById('editViolationForm');
                var editViolationId = document.getElementById('editViolationId');
                var violationDetails = document.getElementById('violationDetails');


                editViolationBtns.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        // Here you should fetch the current violation data and set it to the form inputs
                        // For example:
                        var violationId = this.dataset.violationId;
                        var currentDetails = this.dataset.violationDetails;

                        editViolationId.value = violationId;
                        violationDetails.value = currentDetails;

                        editViolationModal.style.display = 'block';
                    });
                });

                editCancelBtn.addEventListener('click', function() {
                    editViolationModal.style.display = 'none';
                });
            });
        </script>

        </div>

    </section>
</body>

</html>