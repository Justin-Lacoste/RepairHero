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


	if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "adRepairKnowledge") {

		$item = mysqli_real_escape_string($db, $_REQUEST['item']);


		$sql = ("INSERT INTO can_repair SET user_id=?, item=?");
            $statement = $db->prepare($sql);
            if (!$statement) {
                throw new Exception($statement->error);
            }
            $statement->bind_param('ii', $id, $item);
            $result = $statement->execute();
            if ($result) {

                $return["status"] = "200";
                $return["message"] = "Post is upload successfully";

            }   else {
                $return["status"] = "400";
                $return["message"] = "Could not upload post";
            }

        echo json_encode($return);
        return;
		
	}

	if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "myItems") {

		$return = array();
		$sql = ("SELECT items.id, items.user_id, items.price, items.text, items.username, items.item, items.picture, items.date_created from items WHERE items.user_id = $id");

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


	if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "carbonCounter") {

		$return = array();
		$sql = ("SELECT job_done.item from job_done WHERE job_done.user_id = $id");

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


	echo json_encode($return);
	mysqli_close($db);
?>