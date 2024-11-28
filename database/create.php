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
    
    check_duplicate($db, $user_id, $date);

    $mood_sql = "SELECT mood_id FROM moods WHERE mood = \"$mood\""; //query to get the mood ID that matches the submitted mood
    $mood_row = mysqli_query($db, $mood_sql); //run query on database
    $mood_fetch = mysqli_fetch_assoc($mood_row); //fetch the resulting row
    $mood_id = (int)$mood_fetch['mood_id']; //retrieve the mood ID from the resulting row

    //query to insert the form info into the database
    //$sql = "INSERT INTO entries (user_id, date, title, entry_text, entry_mood) VALUES ('9','2024-11-28','browser test 4','dg','3')";
    $sql = "INSERT INTO entries (user_id, date, title, entry_text, entry_mood) VALUES ('$user_id','$date','$title','$entry','$mood_id')";
    
    
    //echo "<script> alert( \' $sql \') ;</script> ";
    
    mysqli_query($db, $sql); //run query on the database

    //redirect to new entry page with confirmation ID
    header("Location: ../pages/new_entry.php?status=done");
} 
else {
    //redirect to new entry page with erro ID
  header("Location:  ../pages/new_entry.php?status=error");
}

function check_duplicate($db, $user_id, $date){
  /*  
  $entry_sql = "SELECT * FROM entries"; //query to retrieve list of all users
  */
  $entry_sql = "SELECT * FROM entries WHERE user_id = $user_id"; //query to retrieve all of the user's entries
  $entry_row = mysqli_query( $db, $entry_sql ); //run query on database
 
  //compare new entry to each existing entry to check for date duplicates from the same user
  while ($entry = mysqli_fetch_array($entry_row)){
    if ( $entry['date'] == $date ) {
        //date error if date is duplicate
        header("Location: ../pages/new_entry.php?status=dupli");
        exit();
    }
  }
}