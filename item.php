<?php

$entityBody = file_get_contents('php://input');
/*
if ($entityBody != "authorized") {
    echo "Access restricted";
}

else {
    
    if (empty($_REQUEST['item_id'])) {
        $return['status'] = "400";
        $return['message'] = "Missing required information";
        echo json_encode($return);
        return;
    }
*/
    $db = new mysqli('localhost', 'root', '', 'repair') or die('Unable to connect');
    
    $id = mysqli_real_escape_string($db, $_REQUEST['item_id']);

    $post = array();


    if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "loadItem") {

        $sql = "SELECT items.text, items.user_id, items.username, items.picture, items.item, items.price, items.date_created from items WHERE items.id = $id";
        

        $statement = $db->prepare($sql);
        if (!$statement) {
            throw new Exception($statement->error);
        }

        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
                $post[] = $row;
            }
            
        if ($post) {
            $return["post"] = $post;
        }
        else {
            $return["message"] = "Cound not find posts";
            }
    }

    if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "removeItem") {

        $sql = 'DELETE FROM items WHERE id=?';
            $statement = $db->prepare($sql);
            if (!$statement) {
                throw new Exception($statement->error);
            }
            $statement->bind_param('i', $id);
            $result = $statement->execute();
            if($result) {
                $return["status"] = "200";
                $return["message"] = "Like has been removed successfully";
            }   else {
                $return["status"] = "400";
                $return["message"] = "Could not remove like";
            }
    }
    if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "solveItem") {

        $user_id = mysqli_real_escape_string($db, $_REQUEST['user_id']);

        $sql = ("INSERT INTO job_done SET user_id=?, item=?");
            $statement = $db->prepare($sql);
            if (!$statement) {
                throw new Exception($statement->error);
            }
            $statement->bind_param('ii', $user_id, $id);
            $result = $statement->execute();
            if ($result) {
                $last_id = mysqli_insert_id($db);
                $return["id"] = $last_id;
                $return["status"] = "200";
                $return["message"] = "Post is upload successfully";

            }   else {
                $return["status"] = "400";
                $return["message"] = "Could not upload post";
            }

        echo json_encode($return);
        return;
    }


    if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "addJob") {
        
        $user_id = mysqli_real_escape_string($db, $_REQUEST['user_id']);
        $item_id = mysqli_real_escape_string($db, $_REQUEST['item_id']);


            $sql = ("INSERT INTO jobs SET user_id=?, item_id=?");
            $statement = $db->prepare($sql);
            if (!$statement) {
                throw new Exception($statement->error);
            }
            $statement->bind_param('ii', $user_id, $item_id);
            $result = $statement->execute();
            if ($result) {
                $last_id = mysqli_insert_id($db);
                $return["id"] = $last_id;
                $return["status"] = "200";
                $return["message"] = "Post is upload successfully";

            }   else {
                $return["status"] = "400";
                $return["message"] = "Could not upload post";
            }

        echo json_encode($return);
        return;
    }

    if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "loadOffers") {

        $sql = "SELECT jobs.user_id, users.username from jobs LEFT JOIN users on users.id = jobs.user_id WHERE jobs.item_id = $id";
        

        $statement = $db->prepare($sql);
        if (!$statement) {
            throw new Exception($statement->error);
        }

        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
                $post[] = $row;
            }
            
        if ($post) {
            $return["post"] = $post;
        }
        else {
            $return["message"] = "Cound not find posts";
            }
    }

    else {
        $return["message"] = "There is no action";
    }
    
    echo json_encode($return);
    return;
    mysqli_close($db);

//}


?>