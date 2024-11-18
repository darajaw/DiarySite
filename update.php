<?php

require_once("database.php");
include ("header.php");
$db = db_connect();

// Handle form values sent by newEntry.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //make sure we submit the data
    $id = $_POST['entry_id'];
    $title = $_POST['entry_title']; // access the form data
    $date = $_POST['date'];
    $entry = $_POST['entry'];
    $mood = $_POST['mood'];
    
    $mood_sql = "SELECT mood_id FROM moods WHERE mood = \"$mood\"";
    $mood_row = mysqli_query($db, $mood_sql);
    $mood_fetch = mysqli_fetch_assoc($mood_row);
    $mood_id = (int)$mood_fetch['mood_id'];

    //prepare your query string
    $sql = "UPDATE entries SET date = '$date', title = '$title', entry_text = '$entry', entry_mood = '$mood_id' WHERE entry_id = '$id'";
    error_log($sql);
    mysqli_query($db, $sql);

    //redirect to search page (test)
    header("Location: search.php");
} 
else {
    //redirect to newEntry page (test)
  header("Location:  newEntry.php");
}

