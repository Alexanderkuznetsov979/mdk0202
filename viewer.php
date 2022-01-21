<?php
	require_once "include/session.php";
	require_once "include/mysqli.php";
	
	if(!empty($_GET["product"])) {
		$product = $_GET["product"];
		
		db_connect();
		$result = get_product($product)[0]; 
		
		db_close();
	}
?>
<!DOCTYPE html>
<html>

<head>
	<?php require_once "blocks/head.php"; ?>
	<link rel="stylesheet" href="css/but.css">
	<link rel="stylesheet" href="css/viewer.css">
</head>

<body>

	<?php 
		require_once "blocks/header.php"; 
		require_once "blocks/nav.php";
	?>
	
	<main>
		<article>
			<header><h1><?=$result["name"]?><h1></header>
			<div class="price"><?=$result["price"]?></div>
			<?php switch($status):
			 case "user": ?>
			
			<?php
			$izvi=<<<_OUT
			  <button type="button" onclick="productInTrash($product)">В корзину</button>
_OUT;
			echo $izvi;
			?>
			
			<?php endswitch; ?>
			<blockquote><?=$result["description"]?></blockquote>
			
			<figure>
				<img src="<?=$result["img"] == "" ? "img/NoPhoto.png" : $result["img"]?>">
			</figure>
			
					
			<?php
				$property = json_decode($result["property"], TRUE);
				$len = count($property["name"]);
				
				for($i=0; $i<$len; ++$i) {
					echo "<p>" . $property["name"][$i] . " - " . $property["value"][$i] . "</p>";
				}
			?>
			<a href="#" onclick="history.back(-1)" class="butt">Назад</a>


		</article>
	</main>
	
<?php require_once "blocks/footer.php"; ?>
</body>
</html>