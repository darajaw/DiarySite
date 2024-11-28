<!--File Name: new_entry.php-->
<!--Code written by: Daraja Williams-->
<!--Edited by: Stephanie Prystupa-Maule -->
<!--Description: This page is used for users to create new entries.-->

<!DOCTYPE html>
<html lang="en">

<?php
    //call file to start session
    require_once('../database/session.php');

    $message = ''; //initialize status message

    if (isset($_GET['status'])){
        
        switch($_GET['status']){ 
            case 'success':
                $message = "Your entry has been logged!";
                break;
            case 'error':
                $message = "There has been an error with your entry. Please try again.";
                break;
            case 'dupli':
                $message = "There is already an entry on this date.";
                break;
            default:
                $message = "";
                break;
        }
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Daraja Williams">
    <meta name="description" content="Allows users to add new entries to their diary">
    <script src="../script/entry_script.js" defer></script>
    <link rel="stylesheet" type="text/css" href="../script/stylesheet.css">
    <title>Diary New Entry</title>
</head>

<body>

    <div class="banner_container"> 
        <!-- insert the header -->
        <?php include("header.php");?>

        <div id="logout_nav_container" class="account_nav_container">
            <nav id="logout_nav" class="account_nav">
                <a href="../database/session.php?id=logout">Logout</a>
            </nav>
        </div>

        <!-- include navigation bar -->
        <?php include("nav_bar.php");?>

    </div>

    <div class="page_container">

        <!-- Form to create new diary entry -->
        <form action="../database/create.php" method="POST" id="entry_form" class="page_form" onsubmit="return validate();">

            <!-- Subheading specific to this page -->
            <h2 class="page_heading">New Entry</h2> 
            <?php echo "<p class=\"warning\">$message</p>"; ?>

            <!-- Main Entry Fields (user input) -->
            <div id="entry_fields">

                <div class="textfield">
                    <label for="entry_title">Title:</label>
                    <input type="text" id="entry_title" name="entry_title">
                </div>

                <div class="textfield">
                    <label for="date">Date:</label>
                    <input type="date" id="entry_date" name="date">             
                </div>

                <div class="textfield">
                    <label for="entry">Entry:</label>
                    <textarea id="entry" name="entry" rows="10" cols="50"></textarea>
                </div>
            </div>
            
            <!-- Mood Selection (user input) -->
            <div id="mood_bar"> 
                <div class="radio_wrapper"> 
                    <input type="radio" id="amazing" name="mood" value="amazing">
                    <label for="amazing"><img src="../images/mood_1.png" alt="amazing emoji" id="amazing_img" class="mood_img"></label>
                    <p class="mood_title">Amazing</p>
                </div>

                <div class="radio_wrapper">
                    <input type="radio" id="good" name="mood" value="good">
                    <label for="good"><img src="../images/mood_2.png" alt="good emoji" id="good_img" class="mood_img"></label>
                    <p class="mood_title">Good</p>
                </div>

                <div class="radio_wrapper">
                    <input type="radio" id="neutral" name="mood" value="neutral">
                    <label for="neutral"><img src="../images/mood_3.png" alt="neutral emoji" id="neutral_img" class="mood_img"></label>
                    <p class="mood_title">Neutral</p>
                </div>

                <div class="radio_wrapper">
                    <input type="radio" id="bad" name="mood" value="bad">
                    <label for="bad"><img src="../images/mood_4.png" alt="bad emoji" id="bad_img" class="mood_img"></label>
                    <p class="mood_title">Bad</p>
                </div>

                <div class="radio_wrapper">
                    <input type="radio" id="terrible" name="mood" value="terrible">
                    <label for="terrible"><img src="../images/mood_5.png" alt="terrible emoji" id="terrible_img" class="mood_img"></label>
                    <p class="mood_title">Terrible</p>
                </div>
            </div>
            
            <div class="button_wrapper">
                <button type="submit">Save Entry</button>
            </div>

        </form>

    </div>
    
    <!-- Insert Footer -->
    <?php include("footer.php"); ?>

</body>

</html>