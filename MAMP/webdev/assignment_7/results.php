<!DOCTYPE html>
<html>
<head>
</head>

<body>
    <h1>Results</h1>

    <?php
        $filename = getcwd() . '/data/results.txt';

        // access the text file 
        $data = file_get_contents($filename);


        // isolate each character 
        $line = explode("\n", $data);

        // generate bar char
        for ($i = 0; $i < count($line); $i++) {
            print $line[$i] ."\n";
        }

    ?>
</body>
</html>
