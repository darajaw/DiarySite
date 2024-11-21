<!DOCTYPE html>
<html lang="en">
<head>
    <script src="assets/reg_script.js" defer></script>
    <title>Diary Registration</title>
</head>
<body>
    <?php include("header.php");?>

    <div class="formcontainer">
        <h2>My Diary Registration</h2>
        <hr>
        <form name="form" action="register.php" method="POST" onsubmit="return validate();">

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

            <button type="submit" class="btn" id="submit-btn">Sign-Up</button>
            <button type="reset" class="btn" id="reset-btn">Reset</button>

        </form>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>