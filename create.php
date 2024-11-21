<?php
require_once('session.php');
require_once('database.php');
include ("header.php");
$db = db_connect();

// Handle form values sent by newEntry.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //make sure we submit the data
    $user_id = $_SESSION['user_id']; // get the user id from the session
    $title = $_POST['entry_title']; // access the form data
    $date = $_POST['date'];
    $entry = $_POST['entry'];
    $mood = $_POST['mood'];
    
    $mood_sql = "SELECT mood_id FROM moods WHERE mood = \"$mood\"";
    $mood_row = mysqli_query($db, $mood_sql);
    $mood_fetch = mysqli_fetch_assoc($mood_row);
    $mood_id = (int)$mood_fetch['mood_id'];

    //prepare your query string
    $sql = "INSERT INTO entries (user_id, date, title, entry_text, entry_mood) VALUES ('$user_id','$date','$title','$entry','$mood_id')";
    error_log($sql);
    mysqli_query($db, $sql);

    //redirect to search page (test)
    header("Location: search.php");
} 
else {
    //redirect to newEntry page (test)
  header("Location:  newEntry.php");
}

