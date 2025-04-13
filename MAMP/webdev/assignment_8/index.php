<?php 
    include "config.php";
?>

<!doctype html>
<html>
    <head>
        <title>Assignment 8</title>
        <style>
            table {
                width: 100%;
            }

            .success {
                color: blue;
            }
        </style>
    </head>
    <body>
        
        <!-- <a href="config.php">test</a> -->

        <table border="1" width="100%">
            <tr>
                <td>Movie</td>
                <td>Title</td>
                <td>Options</td>
            </tr>


            <?php

                $del_id = $_GET["delete"];
                
                // connect to our database!
                $db = new SQlite3($path);

                if ($del_id) {
                    $sql_del = "DELETE FROM movies WHERE id = :id";
                    $statement_del = $db -> prepare($sql_del);
                    $statement_del->bindValue(':id', $del_id, SQLITE3_INTEGER);
                    $statement_del -> execute();

                    print "<div class='success'> Movie deleted successfully! </div>";
                }

                // use a SQL query to grab all movie records
                $sql = "SELECT id, title, year FROM movies ORDER BY title, year";
                $statement = $db->prepare($sql);
                $result = $statement->execute();

                
                // render movie records into the table
                while ($row = $result->fetchArray()) {

                    $id = $row[0];
                    $title = $row[1];
                    $year = $row[2];
                    $del_link = "index.php?delete=" . "$id";

                    print "<tr>";
                    print "    <td>$title</td>";
                    print "    <td>$year</td>";
                    echo "    <td><a href='$del_link'>DELETE</a></td>";
                    print "</tr>";
                }

                $db->close();
                unset($db);

            ?>

        </table>
    

    </body>
</html>
