<?php
    require_once('session.php');
?>

<!DOCTYPE html>

<!--Student Names: Daraja Williams & Stephanie Prystupa-Maule-->
<!--File Name:entry.html-->
<!--Date Created: November 13, 2024-->
<!--Description: This page is used for users to create new entries.-->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Daraja Williams & Stephanie Prystupa-Maule">        
    <meta name="description" content="This page is used for users to create new entries.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entry Page</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/entryScript.js" defer></script>
</head>

<body>
    <!-- insert the header code -->
    <?php include("header.php");?>

    <div id="entry_div">
        <form action="create.php" method="POST" id="entry_form" onsubmit="return validate();">

            <?php
                //check if we were directed from the entry creation page
                if (isset($_GET['id']) && $_GET['id'] == "done") { 
                    echo "<h2>Your entry has been logged!</h2>";
                }
                else if (isset($_GET["id"]) && $_GET["id"] == "error") {
                    echo "<h2>There has been an error with your entry.</h2>";
                }
            ?>

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

            <p>How are you feeling today?</p>
            <div id="mood_div">

                <div class="radiowrapper" id="amazing_div">
                    <input type="radio" id="amazing" name="mood" value="amazing">
                    <label for="amazing"><img src="assets/mood_1.png" alt="amazing emoji" id="amazing_img" class="mood_img"></label>
                    <p class="mood_title">Amazing</p>
                </div>

                <div class="radiowrapper" id="good_div">
                    <input type="radio" id="good" name="mood" value="good">
                    <label for="good"><img src="assets/mood_2.png" alt="good emoji" id="good_img" class="mood_img"></label>
                    <p class="mood_title">Good</p>
                </div>

                <div class="radiowrapper" id="neutral_div">
                    <input type="radio" id="neutral" name="mood" value="neutral">
                    <label for="neutral"><img src="assets/mood_3.png" alt="neutral emoji" id="neutral_img" class="mood_img"></label>
                    <p class="mood_title">Neutral</p>
                </div>

                <div class="radiowrapper" id="bad_div">
                    <input type="radio" id="bad" name="mood" value="bad">
                    <label for="bad"><img src="assets/mood_4.png" alt="bad emoji" id="bad_img" class="mood_img"></label>
                    <p class="mood_title">Bad</p>
                </div>

                <div class="radiowrapper" id="terrible_div">
                    <input type="radio" id="terrible" name="mood" value="terrible">
                    <label for="terrible"><img src="assets/mood_5.png" alt="terrible emoji" id="terrible_img" class="mood_img"></label>
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