<?php
$objDb = new PDO('mysql:host=localhost;dbname=products', 'root', 'password', array(
	PDO::ATTR_PERSISTENT => true
));

$sql = "SELECT `p`.*,
		(
			SELECT GROUP_CONCAT(`name` ORDER BY `name` SEPARATOR ', ') 
			FROM `categories`
			WHERE `id` IN (
				SELECT `category`
				FROM `products_categories`
				WHERE `product` = `p`.`id`
			)
		) AS `categories`
		FROM `products` `p`
		ORDER BY `p`.`name` ASC";
		
$statement = $objDb->query($sql);

if ($statement !== false) {
	$list = $statement->fetchAll(PDO::FETCH_ASSOC);
} else {
	$list = null;
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>MySQL Group Concat</title>
<meta name="description" content="MySQL Group Concat">
<link rel="stylesheet" href="/css/core.css" media="all" type="text/css">
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>

<div id="wrapper">

	<h1>List of instruments</h1>
	
	<?php if (!empty($list)) { ?>
	
		<ul id="instruments">
		
			<?php foreach($list as $row) { ?>
			
				<li>
					<span class="edit flr" data-id="<?php echo $row['id']; ?>">Edit</span>
					<strong><?php echo $row['name']; ?></strong><br />
					<span class="smallText"><?php echo $row['categories']; ?></span>
					<span class="categories"></span>
				</li>
			
			<?php } ?>
		
		</ul>
	
	<?php } else { ?>
	
		<p>There are currently no records available.</p>
	
	<?php } ?>

</div>

<script src="/js/jquery-1.7.2.min.js"></script>
<script src="/js/core.js"></script>
</body>
</html>





