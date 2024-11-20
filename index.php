<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Smart Diary Home</title>
</head>

<body>
<?php include("header.php");?>
    <?php
    // check session variable
    if (isset($_SESSION['valid_user'])) {
        echo '<p>Welcome ' . $_SESSION['valid_user'] . '</p>';

    } else {
        // echo '<p>You are not logged in.</p>';
        // echo '<p>Only logged in members may see this page.</p>';
        header("Location: login.php");
    }
    ?>
    <p><a href="login.php">Login Page</a></p>
    <?php include("footer.php"); ?>
</body>

</html>