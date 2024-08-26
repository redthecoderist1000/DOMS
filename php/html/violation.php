<?php
session_start();
$_SESSION['currentpage'] = "violation";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/DOMS_logo.png" type="image/x-icon">
    <title>Violation Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/viob.css">
    <link rel="stylesheet" href="../css/violation.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/general.css">
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
                <h1>Manage Student Account</h1>
                <hr>
            </div>

            <?php
  $buttonText = "Student Violation";
  $buttonLink = "student.php"; 

  echo '<button type="button" class="student-violation-button" onclick="window.location.href=\'' . $buttonLink . '\'">' . $buttonText . '</button>'; 
 
?>

<?php
  $buttonText = "Violation Report";
  $buttonLink = "violation-report.php";

  echo '<button type="button" class="violation-report-button" onclick="window.location.href=\'' . $buttonLink . '\'">' . $buttonText . '</button>'; 
?>


            <div class="filter-group">
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input id="searchInput" type="text" placeholder="Search...">
                </div>
            </div>

            <div class="table-nav">
                <div class="nav-list">
                    <ul>
                    <a class="nav-offense" style="cursor: pointer;border-bottom: solid 3px rgb(98, 130, 172)">
                            <li>MINOR VIOLATION <span id="minor_number">23</span></li>
                        </a>
                        <a class="nav-offense" style="cursor: pointer;">
                            <li>MAJOR VIOLATION <span id="major_number">12</span></li>
                        </a>
                    </ul>
                </div>
                <div class="add-btn">
                    <span><i class="fa-solid fa-plus"></i> ADD</span>
                </div>
            </div>

            <div class="body-table">
                <table class="table table-striped">
                    <thead>
                        <th>VIOLATION TYPE</th>
                        <th>DESCRIPTION</th>
                        <th>ACTION</th>
                    </thead>
                    <tbody id="table_body">
                        
                    </tbody>
                </table>
            </div>

            <!-- Modal ADD -->

            <div id="addModal" class="modal fade modal-lg" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center">Add Violation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="offense">
                                    <label for="offense_type">Offense Type:</label>
                                    <select id="offense" name="offense_type">
                                        <option value="offense" style="display: none;">Select Offense</option>
                                        <option value="minor">Minor Offense</option>
                                        <option value="major">Major Offense</option>
                                    </select>
                                    <p style="color:DodgerBlue;">Please select offense above.</p>

                                    <label for="violation_type">Violation Type:</label>
                                    <select id="violation_type" name="violation_type" disabled>
                                    <option value="" style="display: none;">Select Violation</option>
                                    </select>
                                </div>

                                <div class="text">

                                    <label for="description">Description:</label>
                                    <textarea name="description" id="description"></textarea>
                                </div>
      </div>
      <div class="modal-footer">
        <button id="add_violation" type="button" class="btn btn-success">ADD</button>
      </div>
    </div>
  </div>
</div>


    
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
            var selected = 'minor';
            var search = '';
            $(document).ready(function(){
            $('.add-btn').click(function(){
                $('#addModal').modal('show');
            });

            $('#searchInput').on('input', function () {
            search = $(this).val();
        });
                $('.nav-offense').click(function(){
                    selected = $(this).find('li').text().split(' ')[0].toLowerCase();
                    $('.nav-offense').css('border-bottom', 'none');
                    $(this).css('border-bottom', 'solid 3px rgb(98, 130, 172)');

                });

            $('#offense').on('change', function(){
                var selected = $(this).val().toLowerCase();
                if(selected === 'minor'){
                    $('#violation_type').attr('disabled', true);
                    $('#violation_type').prop('selectedIndex', 0);
                } else if(selected === 'major'){
                    $('#violation_type').attr('disabled', false);
                }        

            });
                setInterval(function(){
                    $.ajax({
                    url: 'php/get_violation_data.php',
                    method: 'POST',
                    data: {type: selected, search: search},
                    success: function(response){
                        data = JSON.parse(response);
                        if(data != 'No data'){
                            $('#table_body').html('');
                            data.violation_data.forEach(element => {
                                $('#table_body').append(`
                                    <tr>
                                        <td>${element.offense_type}</td>
                                        <td>${element.offense_name}</td>
                                        <td>
                                            <i class="fa-regular fa-pen-to-square editViolationBtn" style="color:#1B4284; cursor:pointer; margin-right: 5px;"></i>
                                            <i class="fa-solid fa-trash-can deleteViolationBtn" style="color: #D40000; cursor: pointer;" data-id=""></i>
                                        </td>
                                    </tr>
                                `);
                            });
                        }
                        else{
                            $('#table_body').html('<tr><td colspan="3">No data</td></tr>');
                        }
                        $('#minor_number').html(data.minor);
                        $('#major_number').html(data.major);
                    }
                });
                }, 500);
                $.ajax({
                    type: 'GET',
                    url: 'php/violation_type_list.php',
                    success:function(response){
                        data = JSON.parse(response);
                        data.forEach(element => {
                            $('#violation_type').append(`
                                <option value="${element.violation_type_id}">${element.violation_type}</option>
                            `);
                        });
                    }
                })
            })
            
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
        

        </div>

    </section>
</body>

</html>