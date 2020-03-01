<?php

header('Content-Type: application/json;charset=utf-8;');
$entityBody = file_get_contents('php://input');

if ($entityBody != "authorized") {
    echo "Access restricted";
}

else {

    
    $db = new mysqli('localhost', 'root', '', 'repair') or die('Unable to connect');
    
    $email = mysqli_real_escape_string($db, $_REQUEST['email']);
    $password = mysqli_real_escape_string($db, $_REQUEST['password']);


    $appuser = $db->query("SELECT * FROM users WHERE email='".$email."'");
    
    $row = mysqli_fetch_array($appuser);
        
    if (!empty($row)){

        $encryptedPassword = $row["password"];
        $salt = $row["salt"];

        
        if ($encryptedPassword == sha1($password . $salt)) {
            
            $return["status"] = "200";
            $return["message"] = "Logged in successfully";
            $return["email"] = $row["email"];
            $return["username"] = $row["username"];
            $return["id"] = $row["id"];
            echo json_encode($return);
            return;

        }   else {
            
            $return["status"] = "201";
            $return["message"] = "Passwords do not match";
            echo json_encode($return);
        }
    
    }  else {
        
        $return["status"] = "401";
        $return["message"] = "User is not found";
        echo json_encode($return);
    }

    mysqli_close($db);
}
?>