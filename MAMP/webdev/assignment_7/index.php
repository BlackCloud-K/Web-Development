<!DOCTYPE html>
<html>
    <head>
        <title>Assignment 07</title>
        <style>
            .error {
                background-color: red;
                color: white;
                padding: 10px;
                width: 100%;
                height: 30px;
            }

            body {
                margin-top: 20px;
                margin-left: 50px;
            }

            .question {
                border: solid 1px black;
                margin-top: 10px;
                padding: 10px;
                width: 350px;
                height: 280px;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .result {
                border: solid 1px black;
                display: flex;
                width: 370px;
                height: 400px;
                align-items: center;
                justify-content: center;
            }

            img {
                max-width: 100%;
                height: auto;
            }

            .hidden {
                display: none;
            }

        </style>
    </head>
    <body>
        <h1>Assignment 07</h1>

        <?php
            error_reporting(0);

            $character = $_GET['character'];
            $filename = "";
            $reset = $_GET["reset"];
            $stored = $_COOKIE["filename"];

            if ((!$character) && ($stored)) {
                $character = $stored;
            }

            $error = $_GET['error'];
            if ($error) {

        ?>

        <div class="error">Fill out the form!</div>

        <?php
            }

            if ($character == 'bart') {
                $filename = 'Bart.png';
            }
            else if ($character == 'lisa') {
                $filename = 'Lisa.png';
            }
            else if ($character == 'homer') {
                $filename = 'Homer.png';
            }
            else if ($character == 'marge') {
                $filename = 'Marge.png';
            }

            if ($reset){
                $character = "";
                setcookie("filename", "");
            }
        ?>

        <div class="result <?php 
        
            if ($character){
                print "";
            }else{
                print "hidden";
            }
        
        ?>">
            <?php
                if ($filename) {
                    setcookie("filename", $character);
                    print "<h4> You are " . $character . "!</h4>";
                    print "<img src=images/$filename>";
                }
            ?>
        </div>

        

        <form method="get" action="" style="margin-top:10px" class="
        
        <?php
            if ($character){
                print "";
            } else{
                print "hidden";
            }

        ?>
        
        ">
            <input type="submit" name="reset" value="Reset">
        </form>

        <form action="process.php" method="GET" class="question
        
        <?php
            if ($character){
                print "hidden";
            } else{
                print "";
            }

        ?>

        ">
        <div>Please answer the questions:</div>
        <div>
            Favorite food:</br>
            <select id="food" name="food">
                <option value="empty">Select an option</option>
                <option value="bart">Pizza</option>
                <option value="homer">Cake</option>
                <option value="lisa">Apples</option>
                <option value="marge">Pancakes</option>
            </select>
        </div>
        <div>
            Favorite activity:</br>
            <select id="activity" name="activity">
                <option value="empty">Select an option</option>
                <option value="bart">Skateboard</option>
                <option value="homer">Sleep</option>
                <option value="lisa">Study</option>
                <option value="marge">Cleaning the house</option>
            </select>
        </div>
        <div>
            Favorite hobby:</br>
            <select id="hobby" name="hobby">
                <option value="empty">Select an option</option>
                <option value="bart">Skateboarding</option>
                <option value="homer">Eating donuts</option>
                <option value="lisa">Playing saxophone</option>
                <option value="marge">Painting</option>
            </select>
        </div>
        <div>
            Biggest fear:</br>
            <select id="fear" name="fear">
                <option value="empty">Select an option</option>
                <option value="bart">Getting caught by Principal Skinner</option>
                <option value="homer">Running out of beer</option>
                <option value="lisa">Climate change</option>
                <option value="marge">Family falling apart</option>
            </select>
        </div>


            <input type="submit" value="Who am I" style="margin-top: 10px">
        </form>
        
    </body>

    <footer>
        <hr style="border: none; border-top: 1px solid #ccc; margin-top: 40px;">
        <a href="results.php" style="margin-top: 10px;">See the result</a>
    </footer>
</html>
