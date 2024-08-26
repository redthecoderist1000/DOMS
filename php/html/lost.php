<?php
session_start();
$_SESSION['currentpage'] = "lost";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
include("../database/database_conn.php");
include('php/fetch_student_data.php');

// Count surrender data
$query_count_surrender = "SELECT COUNT(*) AS count FROM lost_found_db WHERE status = 'surrender'";
$result_count_surrender = mysqli_query($conn, $query_count_surrender);
$surrender_count = 0;
if ($result_count_surrender) {
    $row_count_surrender = mysqli_fetch_assoc($result_count_surrender);
    $surrender_count = $row_count_surrender['count'];
}

// Count claim data
$query_count_claim = "SELECT COUNT(*) AS count FROM lost_found_db WHERE status = 'claimed'";
$result_count_claim = mysqli_query($conn, $query_count_claim);
$claim_count = 0;
if ($result_count_claim) {
    $row_count_claim = mysqli_fetch_assoc($result_count_claim);
    $claim_count = $row_count_claim['count'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/DOMS_logo.png" type="image/x-icon">
    <title>Lost & Found</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/lost.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="../css/general.css">
    <script src="js/screen_timeout.js"></script>


</head>

<body>
    <div class="sidenav">
        <?php include('sidenav/sidenav.php'); ?>
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
                <h1>Lost & Found</h1>
                <hr>
            </div>

            <div class="filter-group">
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search...">
                </div>
                <div class="dropdowns">
                    <select name="" id="">
                        <option value="" style="display: none;" selected>Item</option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                    <span><i class="fa-solid fa-filter"></i> Date filter</span>
                </div>
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

            <div class="table-nav">
                <div class="nav-list">
                    <ul>
                        <a href="claimed.php">
                            <li>CLAIMED ITEM <span><?php echo $claim_count; ?></span></li>
                        </a>
                        <a href="#" style="border-bottom: solid 3px rgb(98, 130, 172)">
                            <li>SURRENDERED ITEM <span><?php echo $surrender_count; ?></span></li>
                        </a>
                        <a href="summary.php">
                            <li>SUMMARY REPORT</li>
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
                        <tr>
                            <th>ITEM</th>
                            <th>DATE LOST</th>
                            <th>Location Found</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM lost_found_db WHERE status = 'surrender'";
                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '
                            <tr class="item-row" data-lost-found-id="' . $row['lost_found_id'] . '">
                                <td>' . htmlspecialchars($row['item_type']) . '</td>
                                <td>' . htmlspecialchars($row['date_surrender']) . '</td>
                                <td>' . htmlspecialchars($row['loc_found']) . '</td>
                                <td>' . htmlspecialchars($row['description']) . '</td>
                            </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal ITEM -->
            <div id="itemModal" class="modal-item">
                <div class="modal-content-item">
                    <div class="modal-body">
                        <div class="modal-img">
                            <img id="item_img" src="../images/logo.webp" alt="">
                        </div>
                        <hr>
                        <div class="modal-details">
                            <div class="details-header">
                                <h3>Founder Information</h3>
                            </div>
                            <div class="details-body">
                                <div class="input-wrap">
                                    <label>Student Name:</label>
                                    <p id="student_name">Avril Belisario</p>
                                </div>
                                <div class="input-wrap">
                                    <label>Student ID:</label>
                                    <p id="student_id">2021 190723</p>
                                </div>
                                <div class="input-wrap">
                                    <label>Email Address:</label>
                                    <p id="student_email">beliserio@students.nu-dasma.edu.ph</p>
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
                                    <label>Item Type:</label>
                                    <p id="item_type">item type</p>
                                </div>
                                <div class="input-wrap">
                                    <label for="date_lost">Date Lost:</label>
                                    <p id="date_surrender">June 5, 2024</p>
                                </div>
                                <div class="input-wrap">
                                    <label>Location Found:</label>
                                    <p id="location_found">Location</p>
                                </div>
                                <div class="input-wrap">
                                    <label>Description:</label>
                                    <p id="description">description</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="modal-buttons">
                            <span class="close" id="close">Cancel</span>
                            <span class="claim" id="claim">Claim</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Claim Modal -->
            <div id="claimModal" class="modal-claim">
                <div class="modal-content-claim">
                    <form action="php/update_lost_found_data.php" method="POST">
                        <div class="details-header-claim">
                            <h3>Student Owner ID</h3>
                        </div>
                        <div class="modal-body-claim">
                            <div class="input-wrap">
                                <label>Student ID:</label>
                                <input type="text" name="student_id" required>
                            </div>
                            <input type="hidden" name="lost_found_id" id="lost_found_id">
                        </div>
                        <div class="modal-footer-claim">
                            <div class="modal-buttons-claim">
                                <span class="close-claim" id="close-claim">Cancel</span>
                                <button type="submit">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = document.getElementById("itemModal");
                    var btns = document.querySelectorAll('.item-row');
                    var span = document.getElementById("close");

                    var claimModal = document.getElementById("claimModal");
                    var claimBtn = document.getElementById("claim");
                    var closeClaimBtn = document.getElementById("close-claim");
                    var lostFoundIdInput = document.getElementById("lost_found_id");

                    btns.forEach(function(btn) {
                        btn.onclick = function() {
                            var lost_found_id = btn.dataset.lostFoundId;
                            console.log(lost_found_id);

                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", "php/fetch_lost_found_data.php?lost_found_id=" + lost_found_id, true);
                            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    var responseData = JSON.parse(xhr.responseText);

                                    document.getElementById('student_name').textContent = responseData.name;
                                    document.getElementById('student_id').textContent = responseData.studentID;
                                    document.getElementById('student_email').textContent = responseData.email;

                                    document.getElementById('item_type').textContent = responseData.item_type;
                                    document.getElementById('description').textContent = responseData.description;
                                    document.getElementById('item_img').src = "php/" + responseData.item_img;

                                    lostFoundIdInput.value = lost_found_id;
                                }
                            };
                            xhr.send();

                            modal.style.display = "block";
                        };
                    });

                    span.onclick = function() {
                        modal.style.display = "none";
                    };

                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    };

                    claimBtn.onclick = function() {
                        claimModal.style.display = "block";
                    };

                    closeClaimBtn.onclick = function() {
                        claimModal.style.display = "none";
                    };

                    window.onclick = function(event) {
                        if (event.target == claimModal) {
                            claimModal.style.display = "none";
                        }
                    };
                });
            </script>

            <!-- Modal ADD -->
            <div id="addModal" class="modal-add">
                <div class="modal-content-add">
                    <span class="close-add">&times;</span>
                    <div class="add-header">
                        <h1>Add Item</h1>
                    </div>
                    <form action="php/insert_item_data.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body-add">
                            <div class="modal-body1">
                                <div class="input-wrap2">
                                    <label for="student-id">Student ID:</label>
                                    <input type="text" name="student-id" required>
                                </div>
                                <div class="input-wrap2">
                                    <label for="item-type">Item Type:</label>
                                    <input type="text" name="item-type" required>
                                </div>
                                <div class="input-wrap2">
                                    <label for="item-found">Item Found:</label>
                                    <input type="text" name="item-found" required>
                                </div>
                                <div class="modal-desc">
                                    <label for="description">Description:</label>
                                    <textarea name="description" required></textarea>
                                </div>
                            </div>
                            <div class="modal-body2">
                                <div class="image-container" id="images"></div>
                                <div class="upload-button">
                                    <input type="file" id="file-input" name="item_img" accept="image/png, image/jpeg" style="display: none;" required>
                                    <label for="file-input"><i class="fas fa-upload"></i> Upload</label>
                                </div>
                            </div>
                            <script>
                                document.getElementById('file-input').addEventListener('change', function(event) {
                                    const imageContainer = document.getElementById('images');
                                    const files = event.target.files;
                                    imageContainer.innerHTML = ""; // Clear existing images

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
                            <button type="submit">SUBMIT</button>
                        </div>
                    </form>
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
    </section>
    <script src="../javascript/profile.js"></script>
</body>

</html>