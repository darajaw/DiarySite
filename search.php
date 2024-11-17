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
        <form action="entry.php" method="post" id="entry_form">
            
            <label for="date">Start Date:</label>
            <input type="date" id="date" name="date" required> 
            
            <label for="date">End Date:</label>
            <input type="date" id="date" name="date" required> 
            
            <label for="title">Filter By Mood:</label>
            <input type="text" id="title" name="title" required>

            <button type="submit">Search</button>
        </form>

        <div id="chosen_entry">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <textarea id="search" name="search" rows="10" cols="50" required></textarea>
        </div>

    </div>

    <!-- add the footer here -->
    <?php include("footer.php"); ?>
    
</body>
</html>