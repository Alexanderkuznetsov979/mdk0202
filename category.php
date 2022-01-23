<?php
	require_once "include/session.php";
	require_once "include/mysqli.php";
	
	define("MAX_PRODUCTS_ON_PAGE", 4);
	
	if(!empty($_GET["category"])) {
		$category = $_GET["category"];
	
		db_connect();
		
		$result = db_select("product", "category='$category'");
		
		db_close();
	} else
		header("Location: /");
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once "blocks/head.php"; ?>
	<link rel="stylesheet" href="css/category.css">
	<script src="js/delet.js"></script>
</head>
<body>
<?php 
		require_once "blocks/header.php"; 
		require_once "blocks/nav.php";
	?>
		<main>
		<?php
			$count_article = 0;
			
			foreach($result as $key => $val) {
				$id = $val["id"];
				$name = $val["name"];
				$price = $val["price"];
				$decsription = $val["description"];
				$img = $val["img"] == "" ? "img/NoPhoto.png" : $val["img"];
				
				$count_article++;
				
				switch($_SESSION["status"]) {
					case "user":
						$article = <<<_OUT
						<article id="$id">
							<a href="viewer.php?product=$id" class="name">$name</a>
							<div class="wrap">
								<figure>
									<img src="$img">
								</figure>
							
							<p class="description">$decsription</p>
							</div>
							<footer class="priceinf">
							<button type="button" onclick="productInTrash($id)">В корзину</button>
							<a class="price">$price</a>
							</footer>
						</article>
_OUT;
						break;
						
					case "admin":
						$article = <<<_OUT
						<article id="$id">
							<a href="viewer.php?product=$id" class="name">$name</a><a>id $id</a>
							<div class="wrap">
								<figure>
									<img src="$img">
								</figure>
							
							<p class="description">$decsription</p>
							</div>
							<footer class="priceinf">
							<a class="tools" href="edit.php?product=$id"><img src="img/edit.png"></a>
							<a class="tools" href="deletes.php?product=$id" onclick="return confirmDelete();"><img src="img/delete.png"></a>
							<a class="price">$price</a>
							</footer>
						</article>
_OUT;
						break;
					
					default:
						$article = <<<_OUT
						<article id="$id">
							<a href="viewer.php?product=$id" class="name">$name</a>
							<div class="wrap">
								<figure>
									<img src="$img">
								</figure>
							
							<p class="description">$decsription</p>
							</div>
							<footer >
							<div class="priceinf">
							<a class="price">$price</a>
							</div>
							</footer>
						</article>
_OUT;
					break;
				}
				echo $article;
			}
			
		?>
		
		
	</main>
<?php require_once "blocks/footer.php"; ?>
</html>