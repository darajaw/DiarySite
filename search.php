<?php
require_once('session.php');
require_once('database.php');
$db = db_connect();

// Handle form values sent by searchEntry.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //make sure we submit the data
    $user_id = $_SESSION['user_id']; // get the user id from the session
    $start = $_POST['startDate']; // access the form data
    $end = $_POST['endDate'];
    $mood = $_POST['mood'];

    //search with no dates
    $entry_search = "SELECT entry_id,date,title FROM entries WHERE user_id = '$user_id'";

    //search with a start date only
    if (!empty($start) && empty($end)){
        $entry_search .= " AND date >= '$start'";
    }

    //search with a start and end date
    elseif (!empty($start) && !empty($end)){
        $entry_search .= " AND date BETWEEN '$start' AND '$end'";
    }

    //check if a mood was set to filter by
    if (!($mood == "none")) {

        $mood_sql = "SELECT mood_id FROM moods WHERE mood = \"$mood\""; //query to get the mood id
        $mood_row = mysqli_query($db, $mood_sql); //execute the query
        $mood_fetch = mysqli_fetch_assoc($mood_row); //fetch the resulting row
        $mood_id = (int)$mood_fetch['mood_id']; //get the mood id value

        $entry_search .= " AND entry_mood = '$mood_id'"; //add the mood id to the search query
    }

    $results = mysqli_query($db, $entry_search); //execute the search query
    $result_fetch = mysqli_fetch_all($results); //fetch all the results
} 
?>

<!DOCTYPE html>

<!--Student Names: Daraja Williams & Stephanie Prystupa-Maule-->
<!--File Name:entry.html-->
<!--Date Created: November 13, 2024-->
<!--Description: This page is used for users to create new entries.-->

<html lang="en">
<body>
    <!-- insert the header code -->
    <?php include("header.php");?>

    <div id="search_div">
    <form action="search.php" method="POST" id="search_form">
            
            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate"> 
            
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate"> 
            
            <label for="mood">Filter By Mood:</label>
            <select  name="mood" id="mood">
                <option value="none">None</option>
                <option value="amazing">Amazing</option>
                <option value="good">Good</option>
                <option value="neutral">Neutral</option>
                <option value="bad">Bad</option>
                <option value="terrible">Terrible</option>
            </select>

            <button type="submit">Search</button>
        </form>

        <!-- Display the search results -->
        <?php if (isset($start)){ ?>
            <h2><?php 
                //results with no set dates
                if (empty($start) && empty($end)){  
                    echo "All Entries";
                }

                //results with a start date only
                elseif (!empty($start) && empty($end)){  
                    echo "Entries since: $start";
                }

                //results with a start and end date
                elseif (!empty($start) && empty($end)){
                    echo "Entries between: $start and $end";
                }
                if (!($mood == "none")) {
                    echo " with mood: ", ucfirst($mood);
                }
                ?></h2>

            <fieldset id="results_div"> 
                <?php  
                    foreach ($result_fetch as $row) {
                        $id = $row[0];
                        $date = $row[1];
                        $title = $row[2];
                        
                        echo "<p><a href=\"editEntry.php?id=$id\">$date - $title</a></p>";
                    } ?>
            </fieldset>
            
        <!-- End of if statement -->
        <?php } ?>
    </div>

    <!-- add the footer here -->
    <?php include("footer.php"); ?>
    
</body>
</html>