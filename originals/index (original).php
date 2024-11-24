<?php
require_once("session.php");
confirm_login();
?>

<!DOCTYPE html>
<html>
<!--File Name: index.php-->
<!--Code written by: Stephanie Prystupa-Maule-->
<!--Description: This is the home page for the website.-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Stephanie Prystupa-Maule">
    <link rel="stylesheet" type="text/css" href="assets/stylesheet (original).css">
    <title>Smart Diary Home</title>
</head>

<body id="index-body" class="index-container">

    <header id="index-header">
        <div id="title-container">
            <h1 id="index-title">Smart Diary</h1>
        </div>
        <div id="logout-container">
            <nav id="logout-nav">
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>

    <div class="index-container">
            <!-- <div id="greeting-div"> -->
                <h2 class="page-heading"><?php echo '<p>Welcome ' . $_SESSION['valid_user'] . '!</p>'; ?></h2>
                <h3 class="page-heading">What would you like to do?</h3>
            <!-- </div> -->

        <nav id="site-nav" class="index-container">
            <div class="site-nav-section">
                <a href="new_entry.php">New Entry</a>  
            </div>  
            <div class="site-nav-section">
                <a href="search.php">Search</a>
            </div>
            <div class="site-nav-section">
                <a href="view.php">View Entries</a>   
            </div> 
        </nav>

        <!--
        <nav id="logout-nav">
            <a href="logout.php">Logout</a>
        </nav>
        -->

    </div>

    <?php include("footer.php"); ?>
</body>

</html>