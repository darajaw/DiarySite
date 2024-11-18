<?php

require_once("database.php");
$db = db_connect();

// Handle form values sent by searchEntry.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //make sure we submit the data
    $start = $_POST['startDate']; // access the form data
    $end = $_POST['endDate'];
    $mood = $_POST['mood'];

    if ($mood == "none") {
        $entry_search = "SELECT entry_id,date,title FROM entries WHERE date BETWEEN '$start' AND '$end'";
        
        $results = mysqli_query($db, $entry_search);
    } 
    
    else {
        $mood_sql = "SELECT mood_id FROM moods WHERE mood = \"$mood\"";
        $mood_row = mysqli_query($db, $mood_sql);
        $mood_fetch = mysqli_fetch_assoc($mood_row);
        $mood_id = (int)$mood_fetch['mood_id'];

        $entry_filter = "SELECT entry_id,date,title FROM entries WHERE date BETWEEN '$start' AND '$end' AND entry_mood = '$mood_id'";

        $results = mysqli_query($db, $entry_filter);
    }
    
    $result_fetch = mysqli_fetch_all($results);

} 
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
    <meta name="description" content="This page is used to search and filter through entries.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entry Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- insert the header code -->
    <?php include("header.php");?>

    <div id="search_div">
    <form action="searchEntry.php" method="POST" id="search_form">
            
            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate"> 
            
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate"> 
            
            <label for="mood">Filter By Mood:</label>
            <select  name="mood" id="mood">
                <option value="none">None</option>
                <option value="amazing">Amazing</option>
                <option value="good">Good</option>
                <option value="neutral">Neutral</option>
                <option value="bad">Bad</option>
                <option value="terrible">Terrible</option>
            </select>

            <button type="submit">Search</button>
        </form>

        <!-- Display the search results -->
        <?php if (isset($start)) { ?>
            <h2><?php 
                if ($mood == "none") {
                echo "Results between: $start and $end";
                } 
                else {
                    echo "Results between: $start and $end with mood: ", ucfirst($mood);
                }?></h2>
            <fieldset id="results_div"> 
                <?php  
                    foreach ($result_fetch as $row) {
                        $id = $row[0];
                        $date = $row[1];
                        $title = $row[2];
                        
                        echo "<p><a href=\"editEntry.php?id=$id\">$date - $title</a></p>";
                    } ?>
            </fieldset>
            
        <!-- End of if statement -->
        <?php } ?>
    </div>

    <!-- add the footer here -->
    <?php include("footer.php"); ?>
    
</body>
</html>