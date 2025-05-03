<?php
    $data = $_POST['todoList'];
    file_put_contents('todo_data.json', $data);
    echo 'success';
?>
