<?php
    //File Name: edit_entry.php
    //Code written by: Daraja Williams
    //Edited by: Stephanie Prystupa-Maule
    //Description: This file allows users to view and edit past journal entries.

    require_once('session.php');
    require_once("database.php");
    $db = db_connect();
    $message = ""; //initialize message variable


    // Retrieve Values from Record to be Displayed
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

     //check if a status is received in the URL
     if (isset($_GET["status"])) {
        $status = $_GET["status"];
    
        //check if it's a success or error status
        if ($status == 'done') { 
            //Confirmation message if entry was updated
            $message = "Entry Updated Successfully!"; 
        } else if ($status == 'error') { 
            //Error message if entry was not updated
            $message = "Error Updating Entry!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en"></html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Daraja Williams">        
    <meta name="description" content="Allows users to view and edit entries in their diary">
    <link rel="stylesheet" type="text/css" href="assets/style_working.css">
    <script src="assets/entry_script.js" defer></script>
    <title>Diary View/Edit Entry</title>
</head>

<body>

    <div class="banner_container"> 
        <!-- insert the header -->
        <?php include("header.php");?>

        <div id="logout_nav_container" class="account_nav_container">
            <nav id="logout_nav" class="account_nav">
                <a href="session.php?id=logout">Logout</a>
            </nav>
        </div>

        <!-- include navigation bar -->
        <?php include("nav_bar.php");?>

    </div>
    
    <div class="page_container">

        <!-- Form to veiw or edit an entry -->
        <form action="update.php" method="POST" id="entry_form" class="page_form" onsubmit="return validate();">

            <input type="hidden" name="entry_id" value="<?php echo $id; ?>">

            <!-- Subheading specific to this page -->
            <h2 class="page_heading">View/Edit Entry</h2> 
            <p class='form_heading'><?php echo $message; ?></p>

            <!-- Main Entry Fields (retrieved from DB)-->
            <div class="entry_fields">
                <div class="textfield">
                    <label for="entry_title">Title:</label>
                    <input type="text" id="entry_title" name="entry_title" value = "<?php echo $result['title']; ?>"></input>
                </div>

                <div class="textfield">
                    <label for="date">Date:</label>
                    <input type="date" id="entry_date" name="date" value = "<?php echo $result['date']; ?>">             
                </div>

                <div class="textfield">
                    <label for="entry">Entry:</label>
                    <textarea id="entry" name="entry" rows="10" cols="50"><?php echo $result['entry_text']; ?></textarea>
                </div>
            </div>

            <!-- Mood Selection (retrieved from DB) -->
            <div id="mood_bar">            
                <div class="radio_wrapper"> 
                    <!-- if this mood matches DB record, mark it as checked -->
                    <input type="radio" id="amazing" name="mood" value="amazing"
                        <?php 
                        echo ($selected_mood == 1) ? 'checked' : ''; 
                        ?>> 
                    <label for="amazing"><img src="images/mood_1.png" alt="amazing emoji" id="amazing_img" class="mood_img"></label>
                    <p class="mood_title">Amazing</p>
                </div>

                <div class="radio_wrapper">
                    <input type="radio" id="good" name="mood" value="good"
                        <?php echo ($selected_mood == 2) ? 'checked' : ''; 
                        ?>>
                    <label for="good"><img src="images/mood_2.png" alt="good emoji" id="good_img" class="mood_img"></label>
                    <p class="mood_title">Good</p>
                </div>

                <div class="radio_wrapper">
                    <input type="radio" id="neutral" name="mood" value="neutral"
                        <?php echo ($selected_mood == 3) ? 'checked' : ''; 
                        ?>>
                    <label for="neutral"><img src="images/mood_3.png" alt="neutral emoji" id="neutral_img" class="mood_img"></label>
                    <p class="mood_title">Neutral</p>
                </div>

                <div class="radio_wrapper">
                    <input type="radio" id="bad" name="mood" value="bad"
                        <?php echo ($selected_mood == 4) ? 'checked' : ''; 
                        ?>>
                    <label for="bad"><img src="images/mood_4.png" alt="bad emoji" id="bad_img" class="mood_img"></label>
                    <p class="mood_title">Bad</p>
                </div>

                <div class="radio_wrapper">
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