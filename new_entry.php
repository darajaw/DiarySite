<!-- 
 TODO:
(same as edit_entry.php TODOs)
 -change mood's "radiowrapper" class to "radio_wrapper", for consistency
    -can't find whatever styling was being applied to "radiowrapper", it changes when i change the name

 -add more in-line comments? idk prof likes comments

-->

<!--File Name: new_entry.php-->
<!--Code written by: Daraja Williams-->
<!--Edited by: Stephanie Prystupa-Maule -->
<!--Description: This page is used for users to create new entries.-->

<!DOCTYPE html>
<html lang="en">

<?php
    //call file to start session
    require_once('session.php');
    confirm_login();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Daraja Williams">
    <meta name="description" content="Allows users to add new entries to their diary">
    <link rel="stylesheet" type="text/css" href="assets/style_working.css">
    <script src="assets/entry_script.js" defer></script>
    <title>Diary New Entry</title>
</head>

<body>

    <div class="banner_container"> 
            <!-- insert the header and navigation bar -->
            <?php include("header.php");?>
            <?php include("nav_bar.php");?>
    </div>

    <div class="page_container">

        <!-- Check if user has been redirected from new_entry page, display confirm or error message -->
        <?php
            if (isset($_GET['id']) && $_GET['id'] == "done") { 
                //submission confirmation message
                echo "<h4>Your entry has been logged!</h4>";
            }
            else if (isset($_GET["id"]) && $_GET["id"] == "error") {
                //submission error message
                echo "<h4>There has been an error with your entry.</h4>";
            }
        ?>

        <!-- Form to create new diary entry -->
        <form action="create.php" method="POST" id="entry_form" class="page_form" onsubmit="return validate();">

            <!-- Subheading specific to this page -->
            <h2 class="page_heading">New Entry</h2> 

            <!-- Main Entry Fields (user input) -->
            <div id="entry_fields">
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
            
            <!-- Mood Selection (user input) -->
            <div id="mood_bar"> 
<!-- TODO should be "radio_wrapper" for consistency -->
                <div id="amazing_wrapper" class="radio_wrapper"> 
                    <input type="radio" id="amazing" name="mood" value="amazing">
                    <label for="amazing"><img src="images/mood_1.png" alt="amazing emoji" id="amazing_img" class="mood_img"></label>
                    <p class="mood_title">Amazing</p>
                </div>

                <div id="good_wrapper" class="radio_wrapper">
                    <input type="radio" id="good" name="mood" value="good">
                    <label for="good"><img src="images/mood_2.png" alt="good emoji" id="good_img" class="mood_img"></label>
                    <p class="mood_title">Good</p>
                </div>

                <div id="neutral_wrapper" class="radio_wrapper">
                    <input type="radio" id="neutral" name="mood" value="neutral">
                    <label for="neutral"><img src="images/mood_3.png" alt="neutral emoji" id="neutral_img" class="mood_img"></label>
                    <p class="mood_title">Neutral</p>
                </div>

                <div id="bad_wrapper" class="radio_wrapper">
                    <input type="radio" id="bad" name="mood" value="bad">
                    <label for="bad"><img src="images/mood_4.png" alt="bad emoji" id="bad_img" class="mood_img"></label>
                    <p class="mood_title">Bad</p>
                </div>

                <div id="terrible_wrapper" class="radio_wrapper">
                    <input type="radio" id="terrible" name="mood" value="terrible">
                    <label for="terrible"><img src="images/mood_5.png" alt="terrible emoji" id="terrible_img" class="mood_img"></label>
                    <p class="mood_title">Terrible</p>
                </div>
            </div>
            
            <div class="button_wrapper">
                <button type="submit">Submit</button>
            </div>

        </form>

    </div>
    
    <!-- Insert Footer -->
    <?php include("footer.php"); ?>

</body>

</html>