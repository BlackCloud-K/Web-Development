<?php 
    include("config.php");

    $db = new SQlite3($path);
?>

<!doctype html>
<html>
    <head>
        <title>Assignment 8</title>
        <style>
            .warning {
                color: red;
            }

            .success {
                color: blue;
            }
        </style>
    </head>

    <?php 

        if ($_SERVER["REQUEST_METHOD"] == 'POST'){

            $title = $_POST["title"];
            $year = $_POST["year"];
    
            if (!$title or !$year){
                print "<div class='warning'> Please complete the form and then submit! </div>";
            } else{
                $sql = "INSERT INTO movies (title, year) VALUES (:title, :year);";
                $statement = $db -> prepare($sql);
                $statement->bindValue(':title', $title, SQLITE3_TEXT);
                $statement->bindValue(':year', $year, SQLITE3_INTEGER);
                $statement -> execute();

                print "<div class='success'> Movie added successfully! </div>";
            }
        }


    ?>

    <body>
        <form method="post" action="add_form.php">
            <label for="title">
                Title: 
            </label>
            <input name="title" id="title">
            </br>

            <label for="year">
                Year: 
            </label>
            <input name="year" id="year" type="number">
            </br>

            <input type="submit" value="Save">
        </form> 

    </body>
</html>