<?php
    //File Name: header.php
    //Code written by: Stephanie Prystupa-Maule
    //Edited by: Daraja Williams
    //Description: Registration page for diary site.

    $message=''; //initaize error message

    //check for a status in the URL
    if (isset($_GET["status"])) {
        $status = $_GET["status"];
        
        //make a switch for the status
        switch ($status) {
            case 'user_error':
                $message = "This username already exists!";
                break;
            case 'email_error':
                $message = "This email is already in use!";
                break;
            default:
                $message = "";
                break;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Stephanie Prystupa-Maule">
    <meta name="description" content="Registration Page for diary site">
    <link rel="stylesheet" type="text/css" href="../script/stylesheet.css">
    <script src="../script/reg_script.js" defer></script>
    <title>Diary Registration</title>
</head>

<body>
    <div id="reg_banner_container" class="banner_container"> 
        <?php include("header.php");?>

        <div id="login_nav_container" class="account_nav_container">
            <nav id="login_nav" class="account_nav">
                <a href="login.php">Login</a>
            </nav>
        </div>
    </div>

    <div id="reg_container" class="page_container">

        <form name="form" action="register.php" method="POST" id="reg_form" class="page_form" onsubmit="return validate();">

            <!-- Subheading specific to this page -->
            <h2 class="page_heading">Register</h2>
            <?php echo "<p class=\"warning\">$message</p>"; ?>

            <!-- Main Entry Fields (user input) -->
            <div class="textfield">
                <label for="email">Email Address</label>
                <input type="text" name="email" id="email" placeholder="xyz@xyz.com">
            </div>

            <div class="textfield">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username">
            </div>

            <div class="textfield">
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" placeholder="Password">
            </div>
        
            <div class="textfield">
                <label for="pass2">Re-type Password</label>
                <input type="password" id="pass2" placeholder="Password">
            </div>

            <div class="checkbox">
                <input type="checkbox" name="terms" id="terms">
                <label for="terms">I agree to the terms and conditions</label>
            </div>

            <div class="button_wrapper">
                <button type="submit" class="btn" id="submit-btn">Sign-Up</button>
                <button type="reset" class="btn" id="reset-btn">Reset</button>
            </div>

        </form>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>