<?php
require_once("session.php");

unset($_SESSION['valid_user']); //delete session variable
session_unset();

session_destroy(); //kill the session

header('Location: login.php?id=out'); //redirect to login page
?>