<?php
include '../database/database_conn.php';

$sql = "SELECT * FROM section_db";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
           <li><a class="dropdown-item" href="#" data-section-id="<?php echo $row['section_id']; ?>" 
           data-course-id="<?php echo $row['course_id']; ?>"><?php echo $row['section_name']; ?></a></li>
         <?php
        }
    }else{
        
    }

    ?>