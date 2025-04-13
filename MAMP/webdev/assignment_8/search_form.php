<?php 
    include("config.php");
?>

<!doctype html>
<html>
    <head>
        <title>Assignment 8</title>
        <style>

        </style>
    </head>
    <body>
        <?php 
            $db = new SQlite3($path);
        
            if ($_SERVER["REQUEST_METHOD"] == 'GET'){

                $title = $_GET["title"];
                $year = $_GET["year"];
                $result;

                if ($title && $year){
                    $sql = "SELECT title, year FROM movies WHERE title LIKE :title AND year=:year";
                    $statement = $db -> prepare($sql);
                    $statement->bindValue(':title', "%$title%", SQLITE3_TEXT);
                    $statement->bindValue(':year', $year, SQLITE3_INTEGER);
                    $result = $statement -> execute();
                } elseif ($year) {
                    $sql = "SELECT title, year FROM movies WHERE year = :year";
                    $statement = $db->prepare($sql);
                    $statement->bindValue(':year', $year, SQLITE3_INTEGER);
                    $result = $statement -> execute();
                }
                elseif ($title) {
                    $sql = "SELECT title, year FROM movies WHERE title LIKE :title";
                    $statement = $db->prepare($sql);
                    $statement->bindValue(':title', "%$title%", SQLITE3_TEXT);
                    $result = $statement -> execute();
                }
                
            }
        
        ?>
        <form method="get" action="search_form.php">
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

            <input type="submit" value="Search">
        </form> 
        
        <div style="margin-top: 10px;">
            <div>Result:</div>
            <?php 
            
                while($row = $result -> fetchArray()){
                    $res_title = $row[0];
                    $res_year = $row[1];
                    print "<div>· $res_title ($res_year)</div>";
                }

            ?>
        
        </div>

    </body>
</html>