<?php

$entityBody = file_get_contents('php://input');

if ($entityBody != "authorized") {
    echo "Access restricted";
}

else {


	if (empty($_REQUEST['email']) || empty($_REQUEST['password']) || empty($_REQUEST['username'])) {
        $return['status'] = "400";
        $return['message'] = "Missing required information";
        echo json_encode($return);
        return;
    }

    
    $user = 'root';
    $pass = '';
    $db = 'repair';
    
    $db = new mysqli('localhost', $user, $pass, $db) or die('Unable to connect');

  	$email = mysqli_real_escape_string($db, $_REQUEST['email']);
  	$password = mysqli_real_escape_string($db, $_REQUEST['password']);
  	$username = mysqli_real_escape_string($db, $_REQUEST['username']);

    $salt = openssl_random_pseudo_bytes(20);
    $encryptedPassword = sha1($password . $salt);

    
    $sql = "INSERT INTO users (email, password, username, salt) VALUES ('".$email."', '".$encryptedPassword."','".$username."', '".$salt."')";
           
    #**********
    #Course video 41 -> not being able to register the same email twice
    #**********
                                                                                               
    if(mysqli_query($db, $sql)){
    	$last_id = mysqli_insert_id($db);
        $return["status"] = "200";
        $return["message"] = "Successfully registered";
       	$return["id"] = $last_id;
        $return["email"] = $email;
        $return["username"] = $username;

        echo json_encode($return);
        
    }   else {
        $return["status"] = "401";
        $return["message"] = "Unable to register";
        echo json_encode($return);
    }
                                                                                               
    mysqli_close($db);
}    

?>