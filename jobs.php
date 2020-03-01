<?php

	if (!isset($_REQUEST['id'])) {
		$return["status"] = "400";
		$return["message"] = "Missing required information";
		echo json_encode($return);
		return;
	}

	$db = new mysqli('localhost', 'root', '', 'repair') or die('Unable to connect');

	$id = mysqli_real_escape_string($db, $_REQUEST['id']);

	$posts = array();


	if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "loadJobs") {


		$return = array();

		$sql = ("SELECT jobs.id, jobs.item_id, jobs.user_id, items.text, items.user_id AS recipient_id, items.username, items.item, items.price, items.picture, items.date_created FROM jobs LEFT JOIN items on items.id = jobs.item_id WHERE items.text IS NOT NULL AND jobs.user_id = $id ORDER BY items.date_created");

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
	}

	if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "straightToChat") {

		$user_id = mysqli_real_escape_string($db, $_REQUEST['user_id']);

        $sql = "SELECT jobs.item_id, jobs.user_id, items.id, items.user_id AS recipient_id from jobs LEFT JOIN items on items.id = jobs.item_id WHERE jobs.id = $id AND jobs.user_id = $user_id";
        
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


	echo json_encode($return);
	mysqli_close($db);
?>