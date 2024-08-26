<?php

$sql = 'SELECT * FROM do_db.school_db;';

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)){

        ?>
         <div class="dept dept1">
                        <div class="color color1"></div>

                        <div class="dept-info dept-info1">
                        <p>(<?php echo $row['school_acronym']; ?>) <?php echo $row['school_name']; ?></p>
                        </div>

                        <p>?%</p>
                    </div>

<?php
    }
} else{
    echo 'No Data Found.';
}
?>