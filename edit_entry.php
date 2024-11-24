<!-- 
 TODO:
(same as edit_entry.php TODOs)
 -change mood's "radiowrapper" class to "radio_wrapper", for consistency
    -can't find whatever styling was being applied to "radiowrapper", it changes when i change the name

 -add more in-line comments? idk prof likes comments

-->

<!--File Name: edit_entry.php-->
<!--Code written by: Daraja Williams-->
<!--Edited by: Stephanie Prystupa-Maule -->
<!--Description: This page allows users to view and edit past entries-->

<!DOCTYPE html>
<html lang="en">

<?php
    require_once('session.php');
    require_once("database.php");
    $db = db_connect();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Daraja Williams">        
    <meta name="description" content="Allows users to view and edit entries in their diary">
    <link rel="stylesheet" type="text/css" href="assets/style_working.css">
    <script src="js/entryScript.js" defer></script>
    <title>View/Edit Entry Page</title>
</head>

<!-- Retrieve Values from Record to be Displayed -->
<?php 
    if (!isset($_GET['id'])) { //check if we get the ID
        //redirect to new entry page if no ID was received
        header("Location:  new_entry.php");
    }
    
    $id = $_GET['id']; //retrive entry ID in URL
    $sql = "SELECT * FROM entries WHERE entry_id= '$id'"; // query to select the entry 
    $result_set = mysqli_query($db, $sql); // run entry on database
    $result = mysqli_fetch_assoc($result_set); //fetch resulting row

    //redirect to home page if entry user ID does not match session user ID
    if($result['user_id'] != $_SESSION['user_id']) {
        header("Location: index.php");
    }

    //retrieve mood ID from entry 
    $selected_mood = $result['entry_mood'];
?>

<body>

    <div class="banner_container"> 
            <!-- insert the header and navigation bar -->
            <?php include("header.php");?>
            <?php include("nav_bar.php");?>
    </div>
    
    <div class="page_container">

        <!-- Form to veiw or edit an entry -->
        <form action="update.php" method="POST" id="view/edit_form" class="page_form" onsubmit="return validate();">

            <input type="hidden" name="entry_id" value="<?php echo $id; ?>">

            <!-- Subheading specific to this page -->
            <h2 class="page_heading">View/Edit Entry</h2> 

            <!-- Main Entry Fields (retrieved from DB)-->
            <div class="entry_fields">
                <div class="textfield">
                <label for="entry_title">Title:</label>
                <input type="text" id="entry_title" name="entry_title" value = "<?php echo $result['title']; ?>"></input>
                </div>

                    <div class="textfield">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" value = "<?php echo $result['date']; ?>">             
                    </div>

                    <div class="textfield">
                    <label for="entry">Entry:</label>
                    <textarea id="entry" name="entry" rows="10" cols="50"><?php echo $result['entry_text']; ?></textarea>
                    </div>
                </div>

            <!-- Mood Selection (retrieved from DB) -->
            <div id="mood_bar">
<!-- TODO should be "radio_wrapper" for consistency -->                 
                <div id="amazing_wrapper" class="radiowrapper"> 
                    <!-- if this mood matches DB record, mark it as checked -->
                    <input type="radio" id="amazing" name="mood" value="amazing"
                        <?php 
                        echo ($selected_mood == 1) ? 'checked' : ''; 
                        ?>> 
                    <label for="amazing"><img src="images/mood_1.png" alt="amazing emoji" id="amazing_img" class="mood_img"></label>
                    <p class="mood_title">Amazing</p>
                </div>

                <div id="good_wrapper" class="radiowrapper">
                    <input type="radio" id="good" name="mood" value="good"
                        <?php echo ($selected_mood == 2) ? 'checked' : ''; 
                        ?>>
                    <label for="good"><img src="images/mood_2.png" alt="good emoji" id="good_img" class="mood_img"></label>
                    <p class="mood_title">Good</p>
                </div>

                <div id="neutral_wrapper" class="radiowrapper">
                    <input type="radio" id="neutral" name="mood" value="neutral"
                        <?php echo ($selected_mood == 3) ? 'checked' : ''; 
                        ?>>
                    <label for="neutral"><img src="images/mood_3.png" alt="neutral emoji" id="neutral_img" class="mood_img"></label>
                    <p class="mood_title">Neutral</p>
                </div>

                <div id="bad_wrapper" class="radiowrapper">
                    <input type="radio" id="bad" name="mood" value="bad"
                        <?php echo ($selected_mood == 4) ? 'checked' : ''; 
                        ?>>
                    <label for="bad"><img src="images/mood_4.png" alt="bad emoji" id="bad_img" class="mood_img"></label>
                    <p class="mood_title">Bad</p>
                </div>

                <div id="terrible_wrapper" class="radiowrapper">
                    <input type="radio" id="terrible" name="mood" value="terrible"
                        <?php echo ($selected_mood == 5) ? 'checked' : ''; 
                        ?>>
                    <label for="terrible"><img src="images/mood_5.png" alt="terrible emoji" id="terrible_img" class="mood_img"></label>
                    <p class="mood_title">Terrible</p>
                </div>
            </div>

            <div class="button_wrapper">
                <button type="submit">Save Changes</button>
            </div>

        </form>

    </div>

    <!-- Insert Footer -->
    <?php include("footer.php"); ?>

</body>
</html>