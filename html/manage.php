<?php
session_start();
$_SESSION['currentpage'] = "manage";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/DOMS_logo.png" type="image/x-icon">
    <title>Manage Student Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/viob.css">
    <link rel="stylesheet" href="../css/manage.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="../css/general.css">
    <script src="js/screen_timeout.js"></script>


</head>

<body>

    <div class="sidenav">
        <?php include('sidenav/sidenav.php'); ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const headerBtn = document.querySelector('.header-btn');
            const sidenav = document.querySelector('.sidenav');

            headerBtn.addEventListener('click', () => {
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
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-status active btn-success mt-1 ">Active</button>
                    <button type="button" class="btn btn-status btn-danger mt-1">Blocked</button>
                </div>
            </div>

            <div class="filter-group">
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search..." id="searchInput">
                </div>
                <div class="dropdown-lang">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="section"
                        data-bs-toggle="dropdown" aria-expanded="false" data-box="section">Section</button>
                    <ul class="dropdown-menu" id="detect-section" aria-labelledby="section">
                        <input type="text" class="form-control input-lang" placeholder="Search sections..."
                            onkeydown="return /[a-zA-Z1-9]/i.test(event.key)">
                        <?php include('php/get_section.php'); ?>
                    </ul>
                </div>

                <div class="dropdown-lang">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="section"
                        data-bs-toggle="dropdown" aria-expanded="false" data-box="course">Course</button>
                    <ul class="dropdown-menu" id="detect-Course" aria-labelledby="section">
                        <input type="text" class="form-control input-lang" placeholder="Search courses..."
                            onkeydown="return /[a-zA-Z]/i.test(event.key)">
                        <?php include('php/get_course.php'); ?>
                    </ul>
                </div>

                <div class="dropdown-lang">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="section"
                        data-bs-toggle="dropdown" aria-expanded="false" data-box="department">Department</button>
                    <ul class="dropdown-menu" id="detect-department" aria-labelledby="section">
                        <input type="text" class="form-control input-lang" placeholder="Search departments..."
                            onkeydown="return /[a-zA-Z]/i.test(event.key)">
                        <?php include('php/get_department.php'); ?>
                    </ul>
                </div>
            </div>
        </div>
        <div>
            <div class="body-table">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Student ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Course</th>
                            <th scope="col">Section</th>
                            <th scope="col">Department</th>
                        </tr>
                    </thead>
                    <tbody id="body">

                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                </ul>
            </nav>
        </div>

    </section>

                    <!-- Modal Structure -->
                    <div id="studentProfileModal" class="modal fade"  >
                    <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <span class="close" id="close" data-bs-dismiss="modal">&times;</span>
                    <div class="modal-name">
                        <h1 id="student_name">NONE</h1>
                        <p id="student_id">NONE</p>
                    </div>
                    <div class="modal-body">
                        <div class="modal-container">
                            <div class="modal-details">
                                <div class="input-wrap">
                                    <label>Course:</label>
                                    <p id="student_course"></p>
                                </div>
                                <div class="input-wrap">
                                    <label>Department:</label>
                                    <p id="student_dept"></p>
                                </div>
                                <div class="input-wrap">
                                    <label>School Email:</label>
                                    <p id="student_email"></p>
                                </div>
                            </div>
                            <div class="block_btn">
                                <input type="submit" name="block" id="account_block" class="student_status" value="BLOCK" style="display: none;">
                                <input type="submit" name="unblock" id="account_unblock" class="student_status" value="UNBLOCK" style="display: none;">
                            </div>
                        </div>
                        <hr>
                        <div class="modal-record">
                            <div class="record-header">
                                <h1>Student Record</h1>
                            </div>
                            <div class="modal-nav-list">
                                <ul>
                                    <li id="violation_btn" class="selected-btn record-list" style="cursor: pointer;">Violation History</li>
                                    <li id="goodmoral_btn" class="record-list" style="cursor: pointer;">Good Moral</li>
                                    <li id="admission_btn" class="record-list" style="cursor: pointer;">Admission Pass</li>
                                    <li id="entry_btn" class="record-list" style="cursor: pointer;">Entry Pass</li>
                                </ul>
                            </div>

                            <!-- Violation History -->
                            <div class="modal-table violation-table" id="violation_tb">

                                <div class="violation-nav">
                                    <span class="selected-violation" id="minor_btn" style="color: #D40000;">MINOR</span>
                                    <span id="major_btn">MAJOR</span>
                                </div>

                                <div id="minor_table" class="table-container minor-table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Offense Type</th>
                                                <th>Violation Type</th>
                                                <th>Commited Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="minor_violation_tbody">
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div id="major_table" class="table-container major-table" style="display: none;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Offense Type</th>
                                                <th>Violation Type</th>
                                                <th>Date Created</th>
                                                <th>Status</th>
                                                <th>Intervention</th>
                                            </tr>
                                        </thead>
                                        <tbody id="major_violation_tbody">
                                            <tr id="major-row" class="major-row">

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <script>
                                    var minor_btn = document.getElementById('minor_btn');
                                    var major_btn = document.getElementById('major_btn');
                                    var minor_table = document.getElementById('minor_table');
                                    var major_table = document.getElementById('major_table');

                                    minor_btn.addEventListener('click', function() {
                                        minor_btn.style.color = '#D40000';
                                        major_btn.style.color = 'rgb(52, 71, 94)';
                                        major_table.style.display = 'none';
                                        minor_table.style.display = 'block';
                                    });

                                    major_btn.addEventListener('click', function() {
                                        major_btn.style.color = '#D40000';
                                        minor_btn.style.color = 'rgb(52, 71, 94)';
                                        minor_table.style.display = 'none';
                                        major_table.style.display = 'block';
                                    });
                                </script>


                            </div>
                            <!-- Good Moral -->
                            <div class="modal-table moral-table" id="goodmoral_tb" style="display: none;">
                                <div class="table-container">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Request Date</th>
                                                <th>Purpose</th>
                                                <th>Status</th>
                                                <th>Date Release</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="goodmoral_tbody">

                                        </tbody>
                                    </table>
                                </div>

                                <div class="goodmoral-btn">
                                    <span><i class="fa-solid fa-plus"></i> ADD</span>
                                </div>
                            </div>



                            <!-- Admission Pass -->
                            <div class="modal-table admission-table" id="admission_tb" style="display: none;">
                                <div class="table-container">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Request Date</th>
                                                <th>Purpose</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="admission_tbody">

                                        </tbody>
                                    </table>
                                </div>

                                <div class="admission-btn">
                                    <span><i class="fa-solid fa-plus"></i> ADD</span>
                                </div>

                            </div>
                            <!-- Entry Pass -->
                            <div class="modal-table entry-table" id="entry_tb" style="display: none;">
                                <div class="table-container">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Request Date</th>
                                                <th>Purpose</th>
                                                <th>Valid Until</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="entry_tbody">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="entry-btn">
                                    <span><i class="fa-solid fa-plus"></i> ADD</span>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

            <!-- end here start below -->


            <!-- Modal goodmoral -->
            <div id="goodmoralModal" class="modal-purpose">
                <div class="modal-content-purpose">

                    <span class="close-goodmoral">&times;</span>
                    <form action="php/insert_goodmoral_data.php" method="POST">

                        <div class="modal-purpose-details">

                            <label for="purpose">Purpose</label>
                            <textarea name="purpose" id="" required></textarea>

                            <input type="text" name="student_id" id="goodmoral_student_id" style="display: none;">

                            <button>SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal admission -->
            <div id="admissionModal" class="modal-purpose">
                <div class="modal-content-purpose">

                    <span class="close-admission">&times;</span>

                    <form action="php/insert_admission_data.php" method="POST">

                        <div class="modal-purpose-details">

                            <label for="purpose">Purpose</label>
                            <textarea name="purpose" id=""></textarea>

                            <input type="text" name="student_id" id="admission_student_id" style="display: none;">


                            <button>SUBMIT</button>
                        </div>

                    </form>

                </div>
            </div>


        

            <!-- Modal entry pass -->
            <div id="entryModal" class="modal-purpose">
                <div class="modal-content-purpose">

                    <span class="close-entry">&times;</span>

                        <div class="modal-purpose-details">

                            <label for="purpose">Purpose</label>
                            <textarea name="purpose" id=""></textarea>

                            <label for="validity"> Valid Until</label>
                            <input type="date" name="validity_date">
                            <input type="text" name="student_id" id="entry_student_id" style="display: none;">

                            <button>SUBMIT</button>
                        </div>

                </div>
            </div>
        </div>
        </div>

    <!-- DELETE MODAL -->
    <div id="deleteViolationModal" class="modaldel">
        <div class="modal-content-del">

            <div class="modal-header">
                <h1>Are you sure?</h1>
            </div>

            <div class="modal-body">
                <p>Do you want to delete this record?</p>
            </div>
            <div class="modal-btn">
                <button id="deleteCancelBtn">Cancel</button>
                <a href="" id="">Yes</a>
            </div>

        </div>
    </div>



    <!-- CLAIM MODAL -->
    <div id="claimViolationModal" class="modalclaim">
        <div class="modal-content-claim">

            <div class="modal-header">
                <h1>Are you sure?</h1>
            </div>

            <div class="modal-body">
                <p>Do you want to claim this record?</p>
            </div>
            <div class="modal-btn">
                <button id="deleteCancelBtn1">Cancel</button>
                <a href="" id="" style="background-color: #5cb85c;">Yes</a>
            </div>

        </div>
    </div>



    <!-- UPDATE MODAL -->
    <div id="updateViolationModal" class="modalupdate">
        <div class="modal-content-update">

            <div class="modal-header">
                <h1>Are you sure?</h1>
            </div>

            <div class="modal-body">
                <p>Do you want to update this record?</p>
            </div>
            <div class="modal-btn">
                <button id="deleteCancelBtn2">Cancel</button>
                <a href="" id="" style="background-color: #5cb85c;">Yes</a>
            </div>

        </div>
    </div>

    <script>
    </script>
    <!-- Modal Violation -->
    <div id="violationModal" class="modal-violation">
        <div class="modal-content-violation">
            <span id="close-violation" class="close-violation">&times;</span>
            <form id="form" action="php/update_major_violation_data.php" method="POST">
                <div class="modal-violation-details">
                    <input type="hidden" name="major_id" id="major_id" value="">

                    <label for="date">Due date of compliance:</label>
                    <input type="text" name="date" id="due_compliance">
                    <div id="specify_department_container">
                        <label for="department">Department:</label>
                        <input type="text" name="department" id="specify_department">
                    </div>
                    <label for="status">Status:</label>
                    <input type="text" name="status" id="status">
                </div>
                <div class="modal-violation-action">
                    <span>REMIND EMAIL</span>
                    <button>CLEARED</button>
                </div>
            </form>
        </div>
    </div>
</body>


<script>
    //Outer Part
    var currentPage = 1;
    var itemsPerPage = 10;
    var search = "";
    var status = "active";
    var section = "";
    var course = "";
    var department = "";
    $(document).ready(function () {

        $('.close-goodmoral').on('click', function () {
            $('#goodmoralModal').hide();
        });

        $('.goodmoral-btn').on('click', function () {
            $('#goodmoralModal').show();
        });
        
        $('.btn-status').on('click', function () {
            currentPage = 1;
            status = $(this).text().toLowerCase();
            $('.btn-status').removeClass('active');
            $(this).addClass('active');
        });

        $('.student_status').on('click', function () {
            const student_id = $('#student_id').text();
            if($(this).attr('name').toLocaleLowerCase() === 'block'){
                student_status = 'blocked';
            }
            else{
                student_status = 'active';
            }
            $.ajax({
                type: 'POST',
                data: {
                    student_id: student_id,
                    status: student_status
                },
                url: 'php/update_student_status.php',
                success: function (response) {
                    console.log(response);
                    if(response === 'success'){
                        $('#studentProfileModal').modal('hide');
                    }
                }
            })
        });

        $('#studentProfileModal').on('show.bs.modal', function (event) {
            let table = $(event.relatedTarget)
            let student = table.find('.student-id');
            let student_f_name = table.find('.student-f-name').text();
            let student_l_name = table.find('.student-l-name').text();
            let course = table.find('.student-course');
            let department = table.find('.student-dept');
            let student_id = student.text();
            let student_status = student.data('status').toLowerCase();
            let student_course = course.text();
            let student_course_complete = course.data('course');
            let student_department = department.text();
            let student_department_full = department.data('dept');
            let student_email = table.find('.student-id').data('email');
            let modal = $(this);
            modal.find('#student_id').text(student_id);
            modal.find('#student_name').text(student_f_name + ' ' + student_l_name);
            modal.find('#student_course').text(student_course_complete + " (" + student_course + ")");
            modal.find('#student_dept').text(student_department_full + " (" + student_department + ")");
            modal.find('#student_email').text(student_email);
            console.log(student_status);
            if(student_status === 'active'){
                $('#account_block').show();
                $('#account_unblock').hide();
            }
            else if(student_status === 'blocked'){
                $('#account_block').hide();
                $('#account_unblock').show();
            }
            load_Violation();
        })

        $('.record-list').on('click', function(){
            $('.record-list').removeClass('selected-btn');
            $(this).addClass('selected-btn');
            $('#goodmoral_tb').hide();
                $('#admission_tb').hide();
                $('#entry_tb').hide();
                $('#violation_tb').hide();
            if($(this).text() === 'Violation History'){
                load_Violation();
                $('#violation_tb').show();
            }else if($(this).text() === 'Good Moral'){
                load_record();
                $('#goodmoral_tb').show();
            }else if($(this).text() === 'Admission Pass'){
                load_record();
                $('#admission_tb').show();
            }else if($(this).text() === 'Entry Pass'){
                load_record();
                $('#entry_tb').show();
            }
        })
        $('.modal').on('shown.bs.modal', function() {
  //Make sure the modal and backdrop are siblings (changes the DOM)
  $(this).before($('.modal-backdrop'));
  //Make sure the z-index is higher than the backdrop
  $(this).css("z-index", parseInt($('.modal-backdrop').css('z-index')) + 1);
});


        $('#searchInput').on('input', function () {
            search = $(this).val();
            currentPage = 1;
        });
        setInterval(() => {
            $.ajax({
                type: 'POST',
                data: {
                    page: currentPage,
                    limit: itemsPerPage,
                    search: search,
                    status: status,
                    section: section,
                    course: course,
                    department: department,
                },
                url: 'php/get_student_list.php',
                success: function (response) {
                    const data = JSON.parse(response);
                    const students = data.students;
                    const totalPages = data.totalPages;
                    const tbody = $('#body')[0];
                    tbody.innerHTML = '';
                    if (students.length === 0) {
                        tbody.innerHTML = `<tr><td colspan="6">No student was found.</td></tr>`;
                    }
                    students.forEach(student => {
                        const row = document.createElement('tr');
                        row.setAttribute('style', 'cursor: pointer;');
                        row.setAttribute('class', 'student-info');
                        row.setAttribute('data-bs-toggle', 'modal');
                        row.setAttribute('data-bs-target', '#studentProfileModal');
                        row.innerHTML = `
                                        <td class="student-id" data-email="${student.email}" data-status="${student.account_status}">${student.student_id}</td>
                                        <td class="student-f-name">${student.f_name}</td>
                                        <td class="student-l-name">${student.l_name}</td>
                                        <td class="student-course" data-course="${student.course_complete}">${student.course}</td>
                                        <td>${student.section}</td>
                                        <td class="student-dept" data-dept="${student.school_full}">${student.school_acronym}</td>
                                    `;
                        tbody.append(row);
                    });
                    generatePagination(totalPages);
                }
            })
        }, 500);

        function generatePagination(totalPages) {
            $('.pagination').empty();
            $('.pagination').append(`
        <li class="page-item" id="Previous">
        <a class="page-link" href="#" aria-label="Previous" data-total-page="${totalPages}">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
      `);
            for (let i = 1; i <= totalPages; i++) {
                $('.pagination').append(
                    `<li class="page-item"><button class="page-link pagination-number" 
                data-page="${i}" data-total-page="${totalPages}">${i} </button></li>`
                );
            }
            $('.pagination').append(`<li class="page-item" id="Next">
      <a class="page-link" href="#" aria-label="Next" data-total-page="${totalPages}">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>`);

            $(`.pagination-number[data-page= '${currentPage}']`).addClass('active');
            if (currentPage === 1) {
                $('#Previous').addClass('disabled');
            } else {
                $('#Previous').removeClass('disabled');
            }
            if (currentPage === totalPages) {
                $('#Next').addClass('disabled');
            } else {
                $('#Next').removeClass('disabled');
            }
            if(totalPages === 0){
                $('#Previous').addClass('disabled');
                $('#Next').addClass('disabled');
            }
        }

        $('.pagination').on('click', '.page-link', function () {
            console.log($(this).data('total-page'));
            if ($(this).attr('aria-label') === 'Previous' && currentPage > 1) {
                currentPage--;
            } else if ($(this).attr('aria-label') === 'Next' && currentPage < $(this).data('total-page')) {
                currentPage++;
            } else {
                currentPage = $(this).data('page');
            }

        });

        $('.dropdown-item').on('click', function () {
            const tabPane = $(this).closest('.dropdown-lang');
            const button = tabPane.find('button.dropdown-toggle');
            if ($(this).text() === button.text() && button.attr('data-box') === 'section') {
                button.text('Section');
            } else if ($(this).text() === button.text() && button.attr('data-box') === 'course') {
                button.text('Course');
            } else if ($(this).text() === button.text() && button.attr('data-box') === 'department') {
                button.text('Department');
            } else {
                if (button.attr('data-box') === 'section') {
                    section = $(this).text();
                } else if (button.attr('data-box') === 'course') {
                    course = $(this).text();
                } else if (button.attr('data-box') === 'department') {
                    department = $(this).text();
                }
                const text = $(this).text();
                button.text(text);
                $(this).attr('style', 'background-color: rgb(0,2550);');
            }
        })
    
        $('.input-lang').on('input', function () {
            const inputText = $(this).val().toLowerCase();
            const length = $(this).text().length;
            const dropDown = $(this).closest('.dropdown-lang');
            const items = dropDown.find('.dropdown-item');

            items.each(function () {
                let itemText = $(this).text().toLowerCase();
                if (itemText.includes(inputText)) {
                    $(this).attr('style', 'display: block');
                } else {
                    $(this).attr('style', 'display: none');
                }
            });

        })

    });
    function load_Violation(){
        $.ajax({
            type: "POST",
            url: "php/get_violation.php",
            data: {
                student_id: $('#student_id').text()
            },
            success: function (response) {
                $('#minor_violation_tbody').empty();
                $('#major_violation_tbody').empty();
                if(response === '"No data"'){
                    $('#minor_violation_tbody').append('<tr><td colspan="3">No minor offense found</td></tr>');
                    $('#major_violation_tbody').append('<tr><td colspan="5">No major offense found</td></tr>');
                } else{
                const data = JSON.parse(response);
                data.forEach(violation => {
                    if(violation.offense_type === 'minor'){
                        const tbody = $('#minor_violation_tbody')[0];
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td>${violation.offense_type}</td>
                        <td>${violation.offense_name}</td>
                        <td>${violation.date_committed}</td>
                        `;
                        tbody.append(row);
                    }
                    else if(violation.offense_type === 'major'){
                        const tbody = $('#major_violation_tbody')[0];
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td>${violation.offense_type}</td>
                        <td>${violation.offense_name}</td>
                        <td>${violation.date_committed}</td>
                        <td>${violation.status}</td>
                        <td>${violation.intervention}</td>
                        `;
                        tbody.append(row);
                    }
                });
            }
            }
        })
    }
    function load_record(){
        $('#goodmoral_tbody').empty();
        $('#admission_tbody').empty();
        $('#entry_tbody').empty();
        $.ajax({
            type: "POST",
            url: "php/get_record.php",
            data: {
                student_id: $('#student_id').text()
            },
            success: function(response){
                console.log(response);
                data =JSON.parse(response);
                goodmoral = data.goodmoral;
                admissionpass = data.admissionpass;
                entrypass = data.entrypass;
                if(goodmoral === 'No data'){
                    $('#goodmoral_tbody').append('<tr><td colspan="5">No good moral record found</td></tr>');
                }else{
                    goodmoral.forEach(record => {
                        const tbody = $('#goodmoral_tbody')[0];
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td>${record.request_date}</td>
                        <td>${record.purpose}</td>
                        <td>${record.status}</td>
                        <td>${record.Date_released}</td>
                        <td><button class="btn btn-primary">View</button></td>
                        `;
                        tbody.append(row);
                    });
                }
                if(admissionpass === 'No data'){
                    $('#admission_tbody').append('<tr><td colspan="3">No admission pass record found</td></tr>');
                }else{
                    admissionpass.forEach(record => {
                        const tbody = $('#admission_tbody')[0];
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td>${record.request_date}</td>
                        <td>${record.purpose}</td>
                        <td><button class="btn btn-primary">View</button></td>
                        `;
                        tbody.append(row);
                    });
                }
                if(entrypass === 'No data'){
                    $('#entry_tbody').append('<tr><td colspan="5">No entry pass record found</td></tr>');
                }else{
                    entrypass.forEach(record => {
                        const tbody = $('#entry_tbody')[0];
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td>${record.request_date}</td>
                        <td>${record.purpose}</td>
                        <td>${record.valid_until}</td>
                        <td>${record.status}</td>
                        <td><button class="btn btn-primary">View</button></td>
                        `;
                        tbody.append(row);
                    });
                }

            }
        })
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>


</html>