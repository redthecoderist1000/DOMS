<?php
$sql = "SELECT * FROM do_db.school_db";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    ?>
    <a class="school-button" href="#" style="background-color: var(--div-primary-color); color: white;" data-id="0"><span>ALL</span></a> 
    <?php
    while ($row = mysqli_fetch_assoc($result)){
        ?>
    <a class="school-button" data-id="<?php echo $row['school_id']; ?>"><span><?php echo $row['school_acronym'];?></span></a>
<?php
    }
} else{
    echo 'No Data Found';
}
?>