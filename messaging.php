<?php

    $db = new mysqli('localhost', 'root', '', 'repair') or die('Unable to connect');
    
    $action = mysqli_real_escape_string($db, $_REQUEST['action']);

    if ($action == "sendMessage") {

        $user_id = mysqli_real_escape_string($db, $_REQUEST['user_id']);
        $message = mysqli_real_escape_string($db, $_REQUEST['message']);
        $recipient_id = mysqli_real_escape_string($db, $_REQUEST['recipient_id']);

            $sql = ("INSERT INTO messages SET user_id=?, recipient_id=?, message=?");
            $statement = $db->prepare($sql);
            if (!$statement) {
                throw new Exception($statement->error);
            }
            $statement->bind_param('iis', $user_id, $recipient_id, $message);
            $result = $statement->execute();
            if ($result) {
                $last_id = mysqli_insert_id($db);
                $return["id"] = $last_id;
                $return["status"] = "200";
                $return["message"] = "Message is upload successfully";

            }   else {
                $return["status"] = "400";
                $return["message"] = "Message not upload post";
            }

        echo json_encode($return);
        return;
    }

    if ($action == "getMessages") {

        $user_id = mysqli_real_escape_string($db, $_REQUEST['user_id']);
        $recipient_id = mysqli_real_escape_string($db, $_REQUEST['recipient_id']);

            $sql = ("SELECT * FROM `messages` WHERE (user_id = $user_id OR recipient_id = $user_id) AND (user_id = $recipient_id OR recipient_id = $recipient_id) ORDER BY messages.id");
            $statement = $db->prepare($sql);
           $return = array();
        

        $statement = $db->prepare($sql);

        if (!$statement) {
            throw new Exception($statement->error);
        }
        $statement->execute();


        $result = $statement->get_result();

        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }

    if ($posts) {
        $return[] = $posts;

    } else {
        $return["message"] = "Cound not find posts";
    }

        echo json_encode($return);
        return;
    }


    mysqli_close($db);
?>