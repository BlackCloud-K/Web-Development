<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    

    if (!isset($_GET['command'])) {
        print "error";
        exit();
    }

    // connect to our database
    // $path = '/home/databases';
    $path = getcwd().'/databases';
    $user_db = new SQLite3(($path.'/user.db'));
    $dice_db = new SQLite3(($path.'/dice.db'));
    $db = new SQLite3($path.'/chat.db');

    // API call to save a message to the 'messages' table
    // requirements:
    //                  command = "savemessage"
    //                  $_POST['username'] (string)
    //                  $_POST['message'] (string)
    if ($_GET['command'] == 'savemessage' && isset($_POST['username']) && isset($_POST['message'])) {

        // construct a SQL statement to save this message to our database
        $sql = "INSERT INTO messages (username, message) VALUES (:username, :message)";
        $statement = $db->prepare($sql);
        $statement->bindValue(':username', $_POST['username']);
        $statement->bindValue(':message', $_POST['message']);
        $result = $statement->execute();
        $id = $db->lastInsertRowID();

        // make sure the record was saved successfully and report back to the client
        if ($id) {
            print "success";
        }
        else {
            print "error";
        }
    }

    // API call to retrieve all messages from the 'messages' table after a given id
    // requirements:
    //                  command = "getmessages"
    //                  $_POST['id'] (integer)
    else if ($_GET['command'] == 'getmessages' && isset($_POST['id'])) {

        // construct a SQL statement to retrieve all messages greater than the supplied id
        $sql = "SELECT id, username, message, date FROM messages WHERE id > :id ORDER BY id";
        $statement = $db->prepare($sql);
        $statement->bindValue(':id', $_POST['id']);
        $result = $statement->execute();

        // construct an object to send back to the client
        // this object will have two properties:
        // - messages: an array of messages, ordered by id
        // - id: an integer representing the last id included in the messages array
        $send_back = [];
        $send_back['messages'] = [];
        $send_back['id'] = $_POST['id'];

        // iterate over the result set
        while ($row = $result->fetchArray()) {
            
            // store the result in an object
            $record = [];
            $record['id'] = $row[0];
            $record['username'] = $row[1];
            $record['message'] = $row[2];
            $record['date'] = $row[3];

            // push the object onto the 'messages' array
            array_push($send_back['messages'], $record);

            // update the 'id' variable to keep track of the largest id
            $send_back['id'] = $record['id'];
        }

        // encode the object as a JSON string and send it to the client
        print json_encode($send_back);
    }

    else if ($_GET['command'] == 'check_user' && isset($_POST['username'] ) && isset($_POST['password'])) {
        $sql = 'SELECT password FROM user WHERE username = :username';
        $statement = $user_db->prepare($sql);
        $statement->bindValue(':username', $_POST['username']);
        $result = $statement->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);
        if ($row) {
            if ($row['password'] == $_POST['password']) {
                print("validated");
            } else{
                print("wrong password");
            }

        } else{
            $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
            $statement = $user_db->prepare($sql);
            $statement->bindValue(':username', $_POST['username']);
            $statement->bindValue(':password', $_POST['password']);
            $result = $statement->execute();
            $id = $user_db->lastInsertRowID();
            if ($id){
                print('new user created');
            }
            else{
                print('new user sign up fialed');
            }
            
        }
    }
    else if($_GET['command'] == 'roll' && isset($_POST['username'])){
        $rand_num = rand(1, 100);
        $sql = "INSERT INTO dice_rolls (username, roll_result) VALUES (:username, :roll_result)";
        $statement = $dice_db->prepare($sql);
        $statement->bindValue(":username", $_POST["username"]);
        $statement->bindValue(":roll_result", $rand_num);
        $result = $statement->execute();
        if ($result){
            print(''. $rand_num);
        } else{
            print("roll failed");
        }
    }
    else if($_GET["command"] == "rollhistory" && isset($_POST['count'])){
        $count = isset($_POST['count']) && is_numeric($_POST['count']) ? intval($_POST['count']) : 10;
        $count = max(1, min($count, 100));
        $sql = "SELECT username, roll_result, timestamp FROM dice_rolls ORDER BY timestamp DESC LIMIT $count";
        $statement = $dice_db->prepare($sql);
        $result = $statement->execute();

        header('Content-Type: application/json');
        $send_back = [];
        $send_back['rolls'] = [];

        while ($row = $result->fetchArray(SQLITE3_NUM)) {
            $record = [];
            $record['username'] = $row[0];
            $record['roll_result'] = $row[1];
            $record['timestamp'] = $row[2];
            
            array_push($send_back['rolls'], $record);
        }

        print json_encode($send_back);
    }

    // invalid command
    else {
        print "error";
    }

    // close the database and release it for the next request
    $db->close();
    unset($db);

?>
