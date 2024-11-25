<!-- 
TODO
-->

<!--File Name: login.php-->
<!--Code written by: Stephanie Prystupa-Maule-->
<!--Edited by: Daraja Williams -->
<!--Description: Login page for diary site-->

<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    require_once('database.php');
    $db = db_connect();
    $message=''; //initaize error message
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Stephanie Prystupa-Maule">
    <meta name="description" content="Login Page for diary site">
    <link rel="stylesheet" type="text/css" href="assets/style_working.css">
    <title>Diary Login Page</title>
</head>

<?php
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        switch ($status) {
            case 'out':
                $message = "You have been logged out";
                break;
            case 'reg':
                $message = "You have been registered successfully";
                break;
            default:
                $message = "";
                break;
        }
    }

    if (isset($_POST['username']) && isset($_POST['pass'])) {
        $valid = false;
        $username = $_POST['username']; //access username
        $password = $_POST['pass']; //access password

        $users_sql = "SELECT * FROM users"; //query to select all users
        $users_row = mysqli_query($db, $users_sql); //run query in datbase
        
        //fetch each row of the query results as a row and compare the username and password values
        while ($user = mysqli_fetch_array($users_row)) {
            if ($user['username'] == $username && $user['password'] == $password) {
                $_SESSION['valid_user'] = $username;
                $_SESSION['valid_pass'] = $password;
                $_SESSION['user_id'] = $user['user_id'];
                $valid = true;
                header('Location: index.php');
                break;
            }
        }

        if (!$valid) {
            $message = "Invalid username or password";
        }
}
?>

<body>

    <div id="login_banner_container" class="banner_container"> 
        <?php include("header.php");?>

        <div id="register_container" class="account_nav_container">
            <nav id="register_nav" class="account_nav">
                <a href="reg_page.php">Register</a>
            </nav>
        </div>
    </div>

    <div id="login_container" class="page_container">

        <!-- Form to Login -->
        <form name="form" action="login.php" method="POST" id="login_form" class="page_form">
<!-- TODO test if form name is necessary, login and reg page-->
            
            <!-- Subheading specific to this page -->
            <h2 class="page_heading">Login</h2> 

            <!-- Display a status message if one is set -->
            <?php echo "<p class=\"warning\">$message</p>"; ?>

            <!-- Main Entry Fields (user input) -->
            <div class="textfield">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username">
            </div>

            <div class="textfield">
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" placeholder="Password">
            </div>
                
            <div class="button_wrapper">
                <button type="submit">Login</button>
                <button type="reset">Reset</button>
            </div>

        </form>

    </div>

    <!-- Insert Footer -->
    <?php include("footer.php"); ?>

</body>
</html>