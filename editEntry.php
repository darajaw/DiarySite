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
    <title>Edit Entry Page</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/entryScript.js" defer></script>
</head>

<body>
    
    <?php 
       
        require_once("database.php");
        include ("header.php");
        $db = db_connect();

        if (!isset($_GET['id'])) { //check if we get the id
        header("Location:  newEntry.php");
        }
        $id = $_GET['id'];

        $sql = "SELECT * FROM entries WHERE entry_id= '$id'";

        $result_set = mysqli_query($db, $sql);

        $result = mysqli_fetch_assoc($result_set);

        $selected_mood = $result['entry_mood'];

  ?>
    <div id="entry_div">
        <form action="update.php" method="POST" id="entry_form" onsubmit="return validate();">
            <input type="hidden" name="entry_id" value="<?php echo $id; ?>">

            <div class="textfield">
            <label for="entry_title">Title:</label>
            <input type="text" id="entry_title" name="entry_title" value = "<?php echo $result['title']; ?>"></input>
            </di>

            <div class="textfield">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value = "<?php echo $result['date']; ?>">             
            </div>

            <div class="textfield">
            <label for="entry">Entry:</label>
            <textarea id="entry" name="entry" rows="10" cols="50"><?php echo $result['entry_text']; ?></textarea>
            </div>

            <p>How are you feeling today?</p>
            <div id="mood_div">

                <div class="radiowrapper" id="amazing_div">
                    <input type="radio" id="amazing" name="mood" value="amazing"
                    <?php echo ($selected_mood == 1) ? 'checked' : ''; ?>>
                    <label for="amazing"><img src="assets/mood_1.png" alt="amazing emoji" id="amazing_img" class="mood_img"></label>
                    <p class="mood_title">Amazing</p>
                </div>

                <div class="radiowrapper" id="good_div">
                    <input type="radio" id="good" name="mood" value="good"
                    <?php echo ($selected_mood == 2) ? 'checked' : ''; ?>>
                    <label for="good"><img src="assets/mood_2.png" alt="good emoji" id="good_img" class="mood_img"></label>
                    <p class="mood_title">Good</p>
                </div>

                <div class="radiowrapper" id="neutral_div">
                    <input type="radio" id="neutral" name="mood" value="neutral"
                    <?php echo ($selected_mood == 3) ? 'checked' : ''; ?>> <!-- check if the mood is selected, check if it is -->
                    <label for="neutral"><img src="assets/mood_3.png" alt="neutral emoji" id="neutral_img" class="mood_img"></label>
                    <p class="mood_title">Neutral</p>
                </div>

                <div class="radiowrapper" id="bad_div">
                    <input type="radio" id="bad" name="mood" value="bad"
                    <?php echo ($selected_mood == 4) ? 'checked' : ''; ?>>
                    <label for="bad"><img src="assets/mood_4.png" alt="bad emoji" id="bad_img" class="mood_img"></label>
                    <p class="mood_title">Bad</p>
                </div>

                <div class="radiowrapper" id="terrible_div">
                    <input type="radio" id="terrible" name="mood" value="terrible"
                    <?php echo ($selected_mood == 5) ? 'checked' : ''; ?>>
                    <label for="terrible"><img src="assets/mood_5.png" alt="terrible emoji" id="terrible_img" class="mood_img"></label>
                    <p class="mood_title">Terrible</p>
                </div>
            </div>

            <button type="submit">Save Entry</button>
        </form>
    </div>

    <!-- add the footer here -->
    <?php include("footer.php"); ?>
    
</body>
</html>