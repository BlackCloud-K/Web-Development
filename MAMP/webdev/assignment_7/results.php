<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin-top: 20px;
            margin-left: 50px;
        }
        .result_container{
            border: 1px solid black;
            width: 400px;
            height: 330px;
        }

        .bar {
            height: 30px;
            background-color: white;
            border: 1px solid black;
            display: flex; 
            align-items: center;
        }
    </style>
</head>

<body>
    <h1>Results</h1>

    <?php
        $filename = getcwd() . '/data/results.txt';

        // access the text file 
        $data = file_get_contents($filename);


        // isolate each character 
        $line = explode("\n", trim($data));

        $bart = 0;
        $homer = 0;
        $lisa = 0;
        $total = 0;
        $marge = 0;

        // generate bar char
        for ($i = 0; $i < count($line); $i++) {
            $content = trim($line[$i]);
            if ($content == "bart"){
                $bart ++;
            }
            if ($content == "homer"){
                $homer ++;
            }
            if ($content == "lisa"){
                $lisa ++;
            }
            if ($content == "marge"){
                $marge ++;
            }
            // print $line[$i] ."\n";
            $total ++;
        }

        echo "Bart: $bart<br>";
        echo "Homer: $homer<br>";
        echo "Lisa: $lisa<br>";
        echo "Marge: $marge<br>";
        echo "Total: $total<br>";        

    ?>

    <h3>Total Submission: <?php print $total; ?></h3>
    <div class="result_container">
        
        <div class="bar" style="width: <?php print (($bart / $total) * 400) . "px";?>; margin-top: 40px; background-color: red;">
            <p style="margin-left: 5px">Bart: <?php print round(($bart / $total) * 100);?>%</p>
        </div>

        <div class="bar" style="width: <?php print (($homer / $total) * 400) . "px";?>; margin-top: 40px; background-color: yellow;">
            <p style="margin-left: 5px">Homer <?php print round(($homer / $total) * 100);?>%</p>
        </div>
   
        <div class="bar" style="width: <?php print (($lisa / $total) * 400) . "px";?>; margin-top: 40px; background-color: lightgreen;"">
            <p style="margin-left: 5px">Lisa <?php print round(($lisa / $total) * 100);?>%</p>
        </div>

        <div class="bar" style="width: <?php print (($marge / $total) * 400) . "px";?>; margin-top: 40px; background-color: lightblue;"">
            <p style="margin-left: 5px">Marge <?php print round(($marge / $total) * 100);?>%</p>
        </div>
    </div>

    </body>
    
    <footer>
        <hr style="border: none; border-top: 1px solid #ccc; margin-top: 40px;">
        <a href="index.php">Back to the voting page</a>
    </footer>
</html>
