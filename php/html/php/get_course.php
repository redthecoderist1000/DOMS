<?php
include '../database/database_conn.php';

$sql = "SELECT * FROM course_db";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
          <li><a class="dropdown-item" href="#" data-course-id="<?php echo $row['course_id']; ?>"
          data-department-id="<?php echo $row['department_id']; ?>"><?php echo $row['course_acronym']; ?></a></li>
         <?php
        }
    }else{
        
    }

    
    ?>

    