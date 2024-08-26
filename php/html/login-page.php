<?php
session_start();
if (isset($_SESSION['admin_username']) && isset($_SESSION['admin_role']))  {
    header("Location: home.php");
} else {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign in to your account</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="icon" href="../images/DOMS_logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/log_in.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" 
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>

    <div class="logo">
        <img src="../images/DOMS_logo1.png" alt="">
        <h1>DISCIPLINE OFFICE</h1>
        <hr>    
        <p>Management System.</p>
    </div>

    <form id="form">
        <h3>LOG IN</h3>

        <label for="username">Username:</label>
        <input name="username" type="text">

        <label for="password">Password:</label>
        <input name="password" type="password">

        <button id="submit" name="submit">Log In</button>
    </form>
    <!-- Modal -->
<div class="modal fade " id="ErrorModal" tabindex="-1" aria-labelledby="Error" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="content">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>

<script>

$(document).ready(function(){

    $('#submit').on('click',function(event){
        event.preventDefault();
        $.ajax({
        type: 'POST',
        url: 'login-function.php',
        data: $('#form').serialize(),
        success: function(response){
            console.log(response);
            if(response == 'empty'){
                $('#content').text('Please fill in all required fields.');
                $('#ErrorModal').modal('show');
            }else if(response == 'Invalid'){
                $('#content').text('The username or password you entered is invalid.');
                $('#ErrorModal').modal('show');
            }
            else if(response == 'success'){
                window.location.href = './home.php';
            }
        }, error: function(response){

        }
    })
    })

})

</script>

</html>

<?php
}
?>