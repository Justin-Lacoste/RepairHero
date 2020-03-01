<?php

    $db = new mysqli('localhost', 'root', '', 'repair') or die('Unable to connect');
    
    $action = mysqli_real_escape_string($db, $_REQUEST['action']);

    if ($action == "insertRepair") {

        /*
    	if (empty($_REQUEST["user_id"]) || empty(file_get_contents('php://input')) || empty($_REQUEST['username']) || empty($_REQUEST['category'])) {
            $return['status'] = '400';
            $return['message'] = 'Missing required information';
            echo json_encode($return);
            return;
        }
        */
        $user_id = mysqli_real_escape_string($db, $_REQUEST['user_id']);
        $text = $entityBody = file_get_contents('php://input');
        $username = mysqli_real_escape_string($db, $_REQUEST['username']);
        $item = mysqli_real_escape_string($db, $_REQUEST['item']);
        $price = mysqli_real_escape_string($db, $_REQUEST['price']);


        //Au lieu de categoriser les posts dans les folder en fonction du id du post ou du user_id, categoriser en fonction de la journee!!!


            $sql = ("INSERT INTO items SET user_id=?, text=?, username=?, item=?, price=?");
            $statement = $db->prepare($sql);
            if (!$statement) {
                throw new Exception($statement->error);
            }
            $statement->bind_param('issii', $user_id, $text, $username, $item, $price);
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

    if ($action == "insertPic") {

        $picture = '';

        $user_id = mysqli_real_escape_string($db, $_REQUEST['user_id']);
        $id = stripslashes(mysqli_real_escape_string($db, $_REQUEST['id']));
        

        if (isset($_FILES['file']) && $_FILES['file']['size'] > 1) {
                $folder = '/xampp/htdocs/repair/posts/' .$user_id;
                if (!file_exists($folder)) {
                    mkdir($folder, 0777);
                    $return["folder_message"] = "In theory, created directory";
                }
            
                else {
                    $return["folder_message"] = "Could not create a directory";
                }
               
                $path = $folder. '/' . basename($_FILES['file']['name']);
                if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
                    $picture = 'http://localhost/repair/posts/' . $user_id . '/' . $_FILES['file']['name'];
                    $return['picture'] = $picture;
                } else {
                    $return['file_message'] = 'Could not upload the picture';
                }
            }
            
            else {
                $return["folder_message"] = "if statement not executed";
            }

            $sql = ("UPDATE items SET picture=? WHERE id=? AND user_id=?");
            $statement = $db->prepare($sql);
            if (!$statement) {
                throw new Exception($statement->error);
            }
            $statement->bind_param('sii', $picture, $id, $user_id);
            $result = $statement->execute();
            if ($result) {
                $return["status"] = "200";
                $return["message"] = "Pic is upload successfully";

            }   else {
                $return["status"] = "400";
                $return["message"] = "Could not upload pic";
            }

        echo json_encode($return);
        return;

    }


    mysqli_close($db);
?>