<?php

require_once("database.php");
include ("header.php");
$db = db_connect();

// Handle form values sent by newEntry.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //make sure we submit the data
    $title = $_POST['title']; // access the form data
    $date = $_POST['date'];
    $entry = $_POST['entry'];

  //prepare your query string
  $sql = "INSERT INTO entries (user_id, date, title,  entry_text, entry_mood) VALUES ('1','$date','$title','$entry','1')";
  mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false

}
