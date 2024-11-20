<?php
session_start();

unset($_SESSION['valid_user']); //delete session variable
session_unset();

session_destroy(); //kill the session
?>
<!DOCTYPE html>
<html>

<head>
    <title>Log Out</title>
</head>

<body>
    <h1>Log Out</h1>
    
    <p><a href="login.php">Back to Home Page</a></p>
</body>

</html>