<!DOCTYPE html>
<html>
<head>
    <style>
        .result_container{
            border: 1px solid black;
            width: 400px;
            height: 370px;
        }

        .bar {
            height: 30px;
            background-color: blue;
            border: 1px solid black;
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
        <p>Bart: <?php print round(($bart / $total) * 100);?>%</p>
        <div class="bar" style="width: <?php print (($bart / $total) * 400) . "px";?>;"></div>

        <p>Homer <?php print round(($homer / $total) * 100);?>%</p>
        <div class="bar" style="width: <?php print (($homer / $total) * 400) . "px";?>;"></div>

        <p>Lisa <?php print round(($lisa / $total) * 100);?>%</p>
        <div class="bar" style="width: <?php print (($lisa / $total) * 400) . "px";?>;"></div>

        <p>Marge <?php print round(($marge / $total) * 100);?>%</p>
        <div class="bar" style="width: <?php print (($marge / $total) * 400) . "px";?>;"></div>
    </div>

    <a href="index.php">Back to the voting page</a>
</body>
</html>
