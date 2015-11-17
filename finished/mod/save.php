<?php
if (!empty($_GET['id']) && isset($_POST)) {
	
	$id = $_GET['id'];
	
	$items = array();
	
	if (!empty($_POST['items'])) {
	
		foreach($_POST['items'] as $key => $row) {
			$identity = explode('-', $row['name']);
			if (count($identity) > 1 && $identity[0] == 'item') {
				$items[] = $_POST['items'][$key]['value'];
			}
		}
	
	}
	
	$objDb = new PDO('mysql:host=localhost;dbname=products', 'root', 'password', array(
		PDO::ATTR_PERSISTENT => true
	));
	
	$values = array();
	
	$sql = "START TRANSACTION;";
	
	if (!empty($items)) {
		
		$sql .= "DELETE FROM `products_categories`
				WHERE `product` = ?
				AND `category` NOT IN (";
		$sql .= implode(', ', $items);
		$sql .= ");";
		
		$values[] = $id;
		
		foreach($items as $key => $value) {
		
			$sql .= "INSERT INTO `products_categories`
					(`product`, `category`) VALUES (?, ?)
					ON DUPLICATE KEY UPDATE `product` = `product`;";
					
			$values[] = $id;
			$values[] = $value;
		
		}
				
		
	} else {
		
		$sql .= "DELETE FROM `products_categories`
				WHERE `product` = ?;";
		$values[] = $id;
		
	}
	
	$sql .= "COMMIT;";
	
	$statement = $objDb->prepare($sql);
	
	if ($statement !== false) {
		
		$statement->execute($values);
		
		$sql = "SELECT GROUP_CONCAT(`name` ORDER BY `name` ASC SEPARATOR ', ') AS `items`
				FROM `categories`
				WHERE `id` IN (
					SELECT `category`
					FROM `products_categories`
					WHERE `product` = ?
				)";
		
		$statement = $objDb->prepare($sql);
	
		if ($statement !== false) {
			
			$statement->execute(array($id));
			
			$items = $statement->fetch(PDO::FETCH_ASSOC);
			
			if (!empty($items)) {
				
				echo json_encode(array('error' => false, 'text' => $items['items']));
				
			} else {
				echo json_encode(array('error' => true, 'case' => 4));
			}
			
		} else {
			echo json_encode(array('error' => true, 'case' => 3));
		}
		
	} else {
		echo json_encode(array('error' => true, 'case' => 2));
	}
	
} else {
	echo json_encode(array('error' => true, 'case' => 1));
}












