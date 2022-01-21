
<main>
<form id="reg" method="post">
<br id="id">
<legend id="name">Удаление товара</legend>

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
<input type="text" name="login" placeholder="Введите Id товара" required id="id" style="width:250px; height:30px;"><br>
<input type="submit" value="Удалить товар" id="id">
<br>
<br>
<br>
<br>
<br><br>
</form>
</main>
<?php require_once "blocks/footer.php"; ?>
