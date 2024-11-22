<?php
require_once("session.php");
confirm_login();
?>

<!DOCTYPE html>

<!--Student Names: Daraja Williams & Stephanie Prystupa-Maule-->
<!--File Name: index.php-->
<!--Date Created: November 17th, 2024-->
<!--Description: Landing page of Diary Website.-->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Daraja Williams & Stephanie Prystupa-Maule">        
    <meta name="description" content="Landing page of Diary Website.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diary Home</title>
    <link rel="stylesheet" href="style_experiment.css">
</head>

<head>
    <title>Smart Diary Home</title>
</head>

<body id="index-body" class="index-container">

    <header>
        <h1 id="title">Smart Diary</h1>
        <nav id="logout-nav">
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="index-container">
            <!-- <div id="greeting-div"> -->
                <h2><?php echo '<p>Welcome ' . $_SESSION['valid_user'] . '!</p>'; ?></h2>
                <h3>What would you like to do?</h3>
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