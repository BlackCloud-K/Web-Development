<?php
    $filename = 'todo_data.json';
    if (file_exists($filename)) {
        echo file_get_contents($filename);
    } else {
        echo json_encode([]);
    }
?>
