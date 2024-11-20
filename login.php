<?php
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
                $valid = true;
                echo "<h2>Logged In</h2>";
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
    <?php include("header.php");?>

    <div class="formcontainer">
        <h2>My Diary Login</h2>
        <hr>
        <form name="form" action="login.php" method="POST">

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