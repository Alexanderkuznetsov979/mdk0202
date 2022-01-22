<?php
	require_once "include/session.php";
	require_once "include/mysqli.php";
		$status = $_SESSION["status"];
	if(strcasecmp($status,"")==0){
	header("Location: /");}
	if(strcasecmp($status,"user")==0){
	header("Location: /");}

	db_connect();
	
	$id = $_GET["product"];
	db_delete_product($id);
 ?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once "blocks/head.php"; ?>
</head>

<body>
	<?php
		require_once "blocks/header.php";
		require_once "blocks/nav.php";
		require_once "blocks/delete.php";
	?>
</body>
<?php require_once "blocks/footer.php"; ?>
</html>