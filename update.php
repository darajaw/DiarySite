<?php
//File Name:update.php
//Code written by: Daraja Williams
//Description: This file updates new journal entries into the database.

require_once("database.php");
$db = db_connect();

// Handle form values sent by edit_entry.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //make sure data was posted

    //access form data
    $id = $_POST['entry_id'];
    $title = $_POST['entry_title'];
    $date = $_POST['date'];
    $entry = $_POST['entry'];
    $mood = $_POST['mood'];
  
    $mood_sql = "SELECT mood_id FROM moods WHERE mood = \"$mood\""; //query to get the mood ID that matches the submitted mood
    $mood_row = mysqli_query($db, $mood_sql); //run query on database
    $mood_fetch = mysqli_fetch_assoc($mood_row); //fetch the resulting row
    $mood_id = (int)$mood_fetch['mood_id']; //retrieve the mood ID from the resulting row

    //query to update the selected database record
    $sql = "UPDATE entries SET date = '$date', title = '$title', entry_text = '$entry', entry_mood = '$mood_id' WHERE entry_id = '$id'";
    mysqli_query($db, $sql); //run query on the database

    //redirect to search page with confirmation ID
    header("Location: search.php");
} 
else {
    //redirect to 
  header("Location:  newEntry.php");
}

