<?php
	require_once "include/session.php";
	require_once "include/mysqli.php";
	$status = $_SESSION["status"];
	if(strcasecmp($status,"")==0){
	header("Location: /");}
	if(strcasecmp($status,"admin")==0){
	header("Location: /");}
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once "blocks/head.php"; ?>
	<link rel="stylesheet" href="css/trash.css">
</head>
<body>
	<?php
		require_once "blocks/header.php";
		require_once "blocks/nav.php";
	?>

	<main>
		<h2>Корзина пользователя <?=$user?></h2>
		<?php
		
			if(isset($_SESSION["trash"])) {
			
				$total_price = 0;
			
				foreach($_SESSION["trash"] as $key => $val){
					$id = $val["id"];
					$name = $val["name"];
					$price = $val["price"];
					$decsription = $val["description"];
					$img = $val["img"] == "" ? "img/NoPhoto.png" : $val["img"];
					
					$total_price += $price;
					
					$article = <<<_OUT
						<article id="$id">
							<a href="viewer.php?product=$id" class="name">$name</a>
							<div class="wrap">
								<figure>
									<img src="$img">
								</figure>
							
							<p class="description">$decsription</p>
							</div>
							<footer class="price">$price</footer>
						</article>
_OUT;

					echo $article;
					
				}
					echo <<<_OUT
						<div class="total">
							Итого: $total_price рублей
						</div>
_OUT;
					$_SESSION["total_price"] = $total_price;
				
			?>
			
			<?php } else {?>
				<p>Ваша корзина пуста</p>
			<?php }?>
	</main>
</body>
<?php require_once "blocks/footer.php"; ?>
</html>