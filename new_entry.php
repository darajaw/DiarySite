<?php
    //call file to start session
    require_once('session.php');
    confirm_login();
?>

<!DOCTYPE html>
<html lang="en">
<!--File Name: new_entry.php-->
<!--Code written by: Daraja Williams-->
<!--Description: This page is used for users to create new entries.-->

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Daraja Williams">
    <link rel="stylesheet" type="text/css" href="assets/style_working.css">
    <script src="assets/entry_script.js" defer></script>
    <title>Entry Page</title>
</head>

<body class="main-container">
    <!-- insert the header and navigation bar code -->
    <?php include("header.php");?>
    <?php include("nav_bar.php");?>

    <div id="entry_container" class="main-container">
        <?php
            //check if user was redirected from the entry creation page
            if (isset($_GET['id']) && $_GET['id'] == "done") { 
                //submission confirmation message
                echo "<h2>Your entry has been logged!</h2>";
            }
            else if (isset($_GET["id"]) && $_GET["id"] == "error") {
                //submission error message
                echo "<h2>There has been an error with your entry.</h2>";
            }
        ?>

        <h2 class="page_heading">New Journal Entry</h2>
            
        <form action="create.php" method="POST" class="entry_form" onsubmit="return validate();">
        
            <div class="entry_info">
                <div class="textfield">
                <label for="entry_title">Title:</label>
                <input type="text" id="entry_title" name="entry_title">
                </div>

                <div class="textfield">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date">             
                </div>

                <div class="textfield">
                <label for="entry">Entry:</label>
                <textarea id="entry" name="entry" rows="10" cols="50"></textarea>
                </div>
            </div>
            
            <div class="mood_div">
                <!--<p>How are you feeling today?</p>-->

                <div class="radiowrapper" id="amazing_div">
                    <input type="radio" id="amazing" name="mood" value="amazing">
                    <label for="amazing"><img src="images/mood_1.png" alt="amazing emoji" id="amazing_img" class="mood_img"></label>
                    <p class="mood_title">Amazing</p>
                </div>

                <div class="radiowrapper" id="good_div">
                    <input type="radio" id="good" name="mood" value="good">
                    <label for="good"><img src="images/mood_2.png" alt="good emoji" id="good_img" class="mood_img"></label>
                    <p class="mood_title">Good</p>
                </div>

                <div class="radiowrapper" id="neutral_div">
                    <input type="radio" id="neutral" name="mood" value="neutral">
                    <label for="neutral"><img src="images/mood_3.png" alt="neutral emoji" id="neutral_img" class="mood_img"></label>
                    <p class="mood_title">Neutral</p>
                </div>

                <div class="radiowrapper" id="bad_div">
                    <input type="radio" id="bad" name="mood" value="bad">
                    <label for="bad"><img src="images/mood_4.png" alt="bad emoji" id="bad_img" class="mood_img"></label>
                    <p class="mood_title">Bad</p>
                </div>

                <div class="radiowrapper" id="terrible_div">
                    <input type="radio" id="terrible" name="mood" value="terrible">
                    <label for="terrible"><img src="images/mood_5.png" alt="terrible emoji" id="terrible_img" class="mood_img"></label>
                    <p class="mood_title">Terrible</p>
                </div>
            </div>
            
            <button type="submit">Submit</button>
            
        </form>
        
    </div>

    <!-- add the footer here -->
    <?php include("footer.php"); ?>
    
</body>
</html>