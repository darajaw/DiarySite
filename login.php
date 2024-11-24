<?php
    //File Name:update.php 
    //Code written by: Stephanie Prystupa-Maul
    //Description: This page allows users to login.

    session_start();
    require_once('database.php');
    $db = db_connect();
?>

<?php
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
            echo "<h2>Invalid username or password</h2>";
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Diary Login</title>
</head>
<body>
    <div class="form-container">
        <h2>My Diary Login</h2>
        <hr>
        <form name="form" action="login.php" method="POST">

            <?php
                if (isset($_GET['id']) && $_GET['id'] == "out") { //check if user was redirected from the logout page
                    echo "<h2>You have been logged out</h2>";
                }
            ?>

            <div class="textfield">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username">
            </div>

            <div class="textfield">
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" placeholder="Password">
            </div>

            <button type="submit" class="btn" id="submit-btn">Login</button>
            <button type="reset" class="btn" id="reset-btn">Reset</button>

        </form>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>