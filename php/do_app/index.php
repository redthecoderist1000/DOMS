<?php
session_start();
$error = $_SESSION['error_message'] ?? null;
unset($_SESSION['error_message']);


?>

<!DOCTYPE html>`
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign in to your account</title>
  <link rel="stylesheet" href="css/log-in.css" />
</head>

<body>
  <img src="images/DOMS_logo1.png" alt="" />
  <form action="php/login_function.php" method="POST">
    <div class="info">
      <label for="user">Student No.</label>
      <input type="text" name="student_id" id="" />

      <label for="password">Password</label>
      <input type="password" name="password" id="" />
    </div>

    <div class="error">
      <p><?php echo $error ?></p>
    </div>

    <div class="buttons">
      <button>LOGIN</button>
      <a href="#">Forgot your password?</a>
    </div>
  </form>
</body>

</html>