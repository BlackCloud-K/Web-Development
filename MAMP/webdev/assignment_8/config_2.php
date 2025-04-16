<?php
    error_reporting(0);
    $path = "/home/yn2179/databases/movies.db";
    // print $path;
?>

<!doctype html>
<html>
    <head>
        <title>Assignment 8</title>
        <style>
            table {
                width: 100%;
            }

            .buttom {
                padding: 7px;
                margin-right: 10px;
                border: 1px solid black;
                margin-bottom: 10px;
                text-decoration: none;
            }

        </style>
    </head>
    <body>
        <h1>Movie Database</h1>
        <div style="padding-bottom: 20px; padding-top: 10px">
            <a class="buttom" href="index.php">View All</a>
            <a class="buttom" href="add_form.php">Add Movie</a>
            <a class="buttom" href="search_form.php">Search Movies</a>
        </div>
        
    </body>
</html>
