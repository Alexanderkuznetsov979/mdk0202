<?php
	require_once "include/session.php";
	if($_SESSION["login"] != "") {
		header("Location: /");
	}
	
	require_once "include/mysqli.php";
	
	if(!empty($_POST)) {
		if( !db_connect() ) {
			
			$user = htmlentities(mysqli_real_escape_string($conn, $_POST["login"]));
			$password = htmlentities(mysqli_real_escape_string($conn, $_POST["password"]));
			$repeatpassword = htmlentities(mysqli_real_escape_string($conn, $_POST["repeatpassword"]));
			
			if (!empty($user))
				if (!db_check_usr($user))
					if (strcmp($password, $repeatpassword) === 0)
						if(!empty($password) || !empty($repeatpassword)){
							
							add_usr($user, $password);
							
							header("Refresh: 2; url=index.php");
							
						} else
							$error = "Пароль не может быть пустым";
					else
						$error = "Пароли не совпадают";
				else 
					$error = "Пользователь с таким именем уже существует";
			else
				$error = "Логин не может быть пустым";
			
			db_close();
			$ok = "Вы зарегистрировались";
		} else 
			$error = "Ошибка подключения";
	}

?>
<!DOCTYPE html>
<html>

<head>
	<?php require_once "blocks/head.php"; ?>
	
	<link rel="stylesheet" href="css/reg.css">
	<script src="js/reg.js"></script>
</head>

<body>

	<?php 
		require_once "blocks/header.php";
		require_once "blocks/nav.php"; 
	?>
	
	<main>
	<?php

		if(isset($error))
			echo <<<_OUT
				<div id="msg-error" class="msg msg-error">
					<div>$error</div>
					<div class="closed" onclick="msgClose('msg-error')">Ошибка</div>
				</div>
_OUT;
		else if(isset($ok))
			echo <<<_OUT
				<div id="msg-ok" class="msg msg-ok">
					<div>$ok</div>
					<div class="closed" onclick="msgClose('msg-ok')"></div>
				</div>
_OUT;
	?>
		
		<form id="reg" method="post">
		<br>
			<h3>Регистрация</h3>
				
			<input type="email" name="login" placeholder="Введите Ваш e-mail" required><br>
			<input type="password" name="password" placeholder="Пароль" required><br>
			<input type="password" name="repeatpassword" placeholder="Повторите пароль" required><br>
			<input type="submit" value="Зарегистрироваться">
		</form>
		<br><br><br>
	</main>
	

</body>
<?php require_once "blocks/footer.php"; ?>
</html>