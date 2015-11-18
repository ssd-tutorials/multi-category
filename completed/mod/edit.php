<?php
if (!empty($_GET['id'])) {
	
	$id = $_GET['id'];
	
	$objDb = new PDO('mysql:host=localhost;dbname=products', 'root', 'password', array(
		PDO::ATTR_PERSISTENT => true
	));

	$sql = "SELECT `c`.*,
			IF (
				`c`.`id` IN (
					SELECT `category`
					FROM `products_categories`
					WHERE `product` = ?
				),
				1,
				0
			) AS `selected`
			FROM `categories` `c`
			ORDER BY `c`.`name` ASC";
			
	$statement = $objDb->prepare($sql);
	
	if ($statement !== false) {
	
		$statement->execute(array($id));
		$items = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		if (!empty($items)) {
			
			$out = array();
			
			foreach($items as $row) {
				
				$list  = '<label for="item-'.$row['id'];
				$list .= '" class="categoryCheck">';
				$list .= '<input type="checkbox" name="item-';
				$list .= $row['id'].'" id="item-'.$row['id'];
				$list .= '" ';
				if ($row['selected'] == 1) {
					$list .= 'checked="checked" ';
				}
				$list .= 'value="'.$row['id'].'" />';
				$list .= $row['name'];
				$list .= '</label>';
				
				$out[] = $list;
				
			}
			
			$categories = '<form>'.implode('', $out).'</form>';
			
			echo json_encode(array('error' => false, 'categories' => $categories));
			
		} else {
			echo json_encode(array('error' => true, 'case' => 3));
		}
		
	} else {
		echo json_encode(array('error' => true, 'case' => 2));
	}
	
} else {
	echo json_encode(array('error' => true, 'case' => 1));
}








