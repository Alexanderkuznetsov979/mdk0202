<?php
	require_once "include/session.php";
		if($_SESSION["login"] != "") {
		header("Location: /sign.php");
	}	
	require_once "include/mysqli.php";

	if(!empty($_POST))
		if( !db_connect() ) {
			
			$usr= htmlentities(mysqli_real_escape_string($conn,$_POST["login"]));
			$passwd = htmlentities(mysqli_real_escape_string($conn,$_POST["password"]));
			
			if (!empty($usr))
				if (!db_login($usr, $passwd)) {
						$ok = "";
						
						$_SESSION["login"] = $usr; 
						$_SESSION["status"] = get_user_status($usr);
						header("Refresh: 1; url=sign.php");
						
				} else {
					$error = "Не правильный логин или пароль";
				}
			else 
				$error = "Логин не может быть пустым";
			
			db_close();			
		} else 
			$error = "Ошибка подключения";
	
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once "blocks/head.php"; ?>
	<link rel="stylesheet" href="css/sign-up.css">
	<script src="js/sign-up.js"></script>
</head>
<body>
	<?php 
		require_once "blocks/header.php";
		require_once "blocks/nav1.php";
	?>
	<main><br>
		<h2>Авторизация</h2>
		
		<form id="sign-up" method="POST">
			<input type="email" name="login" placeholder="e-mail" required>
			<input type="password" name="password" placeholder="Пароль" required>
			<?php
		if(isset($error))
			echo <<<_OUT
				<div id="msg-error" class="msg msg-error">
					<div>$error</div>
	
				</div>
_OUT;
		else if(isset($ok))
			echo <<<_OUT
				<div id="msg-ok" class="msg msg-ok">
					<div>$ok</div>
					<div class="closed" onclick="msgClose('msg-ok')">С возвращением!</div>
				</div>
_OUT;
		?>
			<input type="submit" name="sign-up-submit" value="Войти">
		</form>
	</main>
</body>
<?php require_once "blocks/footer.php"; ?>
</html>