<?php

    // grab the incoming data
    $food = $_GET['food'];
    $activity = $_GET['activity'];
    $hobby = $_GET['hobby'];
    $fear = $_GET['fear'];

    // make sure the user filled everything out
    if ($food == 'empty' || $activity == 'empty' || $hobby == 'empty' || $fear == 'empty') {
        // if not, generate an error message
        header("Location: index.php?error=missingstuff");
        exit();
    }


    // if everything is OK, diagnose the character!
    $bart = 0;
    $homer = 0;
    $lisa = 0;
    $marge = 0;

    if ($food == 'bart') {
        $bart++;
    }
    else if ($food == 'homer') {
        $homer++;
    }
    else if ($food == 'lisa') {
        $lisa++;
    }
    else if ($food == 'marge') {
        $marge++;
    }
    else {
        header("Location: index.php?error=invalidcharacter");
        exit();
    }


    if ($activity == 'bart') {
        $bart++;
    }
    else if ($activity == 'homer') {
        $homer++;
    }
    else if ($activity == 'lisa') {
        $lisa++;
    }
    else if ($activity == 'marge') {
        $marge++;
    }
    else {
        header("Location: index.php?error=invalidcharacter");
        exit();
    }

    if ($hobby == 'bart') {
        $bart++;
    }
    else if ($hobby == 'homer') {
        $homer++;
    }
    else if ($hobby == 'lisa') {
        $lisa++;
    }
    else if ($hobby == 'marge') {
        $marge++;
    }
    else {
        header("Location: index.php?error=invalidcharacter");
        exit();
    }

    if ($fear == 'bart') {
        $bart++;
    }
    else if ($fear == 'homer') {
        $homer++;
    }
    else if ($fear == 'lisa') {
        $lisa++;
    }
    else if ($fear == 'marge') {
        $marge++;
    }
    else {
        header("Location: index.php?error=invalidcharacter");
        exit();
    }

    // absolute file path to our results file
    $filename = getcwd() . '/data/results.txt';


    if ($bart >= $homer && $bart >= $lisa && $bart >= $marge) {
        file_put_contents($filename, "bart\n", FILE_APPEND);
        header("Location: index.php?character=bart");
        exit();
    }
    else if ($homer >= $bart && $homer >= $lisa && $homer >= $marge) {
        file_put_contents($filename, "homer\n", FILE_APPEND);
        header("Location: index.php?character=homer");
        exit();
    }
    else if ($lisa >= $bart && $lisa >= $homer && $lisa >= $marge) {
        file_put_contents($filename, "lisa\n", FILE_APPEND);
        header("Location: index.php?character=lisa");
        exit();
    }
    else {
        file_put_contents($filename, "marge\n", FILE_APPEND);
        header("Location: index.php?character=marge");
        exit();
    }


?>
