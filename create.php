<?php
//File Name: create.php
//Code written by: Daraja Williams
//Description: This file enters new journal entries into the database.

require_once('session.php');
require_once('database.php');
$db = db_connect();

// Handle form values sent by new_entry.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //make sure data was posted
    $user_id = $_SESSION['user_id']; // get the user id from the session

    // access the form data
    $title = $_POST['entry_title']; 
    $date = $_POST['date'];
    $entry = $_POST['entry'];
    $mood = $_POST['mood'];
    
    check_duplicate($db, $date);

    $mood_sql = "SELECT mood_id FROM moods WHERE mood = \"$mood\""; //query to get the mood ID that matches the submitted mood
    $mood_row = mysqli_query($db, $mood_sql); //run query on database
    $mood_fetch = mysqli_fetch_assoc($mood_row); //fetch the resulting row
    $mood_id = (int)$mood_fetch['mood_id']; //retrieve the mood ID from the resulting row

    //query to insert the form info into the database
    $sql = "INSERT INTO entries (user_id, date, title, entry_text, entry_mood) VALUES ('$user_id','$date','$title','$entry','$mood_id')";
    mysqli_query($db, $sql); //run query on the database

    //redirect to new entry page with confirmation ID
    header("Location: new_entry.php?status=done");
} 
else {
    //redirect to new entry page with erro ID
  header("Location:  new_entry.php?status=error");
}

function check_duplicate($db, $date){
    
  $entry_sql = "SELECT * FROM entries"; //query to retrieve list of all users
  $entry_row = mysqli_query( $db, $entry_sql ); //run query on database
 
  //compare new user to each existing user to check for duplicates
  while ($entry = mysqli_fetch_array($entry_row)){
    if ( $entry['date'] == $date ) {
        //date error if date is duplicate
        header("Location: new_entry.php?status=dupli");
        exit();
    }
  }
}