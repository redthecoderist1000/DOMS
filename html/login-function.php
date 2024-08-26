<?php
session_start();
include ('../database/database_conn.php');

$username = $_POST['username'];
$password = $_POST['password'];


if(empty($username) || empty($password)){
    print('empty');

} else{
    $sql = 'select * from admin_db';
    $result = $conn->query($sql);

    if($result->num_rows > 0 && $result !== FALSE){
        $row = mysqli_fetch_assoc($result);
        if($row['admin_username'] === $username){
        if($row['admin_password'] == $password){
            $_SESSION['admin_username'] = $row['admin_username'];
            print('success');
            exit();
    
        }
        else{
            print('Invalid');
            exit();
        }
        }
        else{
            print('Invalid');
            exit();
        }
        
    }
    else{
        print('Invalid');
        exit();
    }
}


?>