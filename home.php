<?php

	if (!isset($_REQUEST['id']) && !isset($_REQUEST['limit']) && !isset($_REQUEST['offset'])) {
		$return["status"] = "400";
		$return["message"] = "Missing required information";
		echo json_encode($return);
		return;
	}

	$db = new mysqli('localhost', 'root', '', 'repair') or die('Unable to connect');

	$id = mysqli_real_escape_string($db, $_REQUEST['id']);

	$posts = array();


	if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "all") {


		$return = array();
		$sql = ("SELECT can_repair.id, can_repair.item, items.id, items.user_id, items.username, items.item, items.picture, items.price, items.date_created FROM can_repair LEFT JOIN items on items.item = can_repair.item WHERE items.user_id IS NOT NULL AND can_repair.user_id=$id ORDER BY items.date_created");

		$statement = $db->prepare($sql);

		if (!$statement) {
			throw new Exception($statement->error);
		}
		$statement->execute();


		$result = $statement->get_result();

		while ($row = $result->fetch_assoc()) {
			$posts[] = $row;
		}
	}

	if ($posts) {
		$return[] = $posts;

	} else {
		$return["message"] = "Cound not find posts";
	}

	echo json_encode($return);
	mysqli_close($db);
?>


