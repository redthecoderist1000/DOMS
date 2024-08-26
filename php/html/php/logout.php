<?php
session_start();
session_unset();
session_destroy();
header("Location: ../../index.php"); // Redirect to a login page or home page
exit();
