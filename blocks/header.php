<?php
	$status = $_SESSION["status"];
	$lenTrash = count($_SESSION["trash"]);
	$trash = $lenTrash != 0 ? "Корзина - $lenTrash товар" : "Корзина";
?>
<header >
    <a href="/"><img src="img/logo_1.png" width="95" height="85"></a>
	<h1><a href="/">Мебельный Магазин «HomOFF»</a></h1>
	<link rel = "stylesheet" type="text/css" href="main.css">
	<ul class="ctrl-panel">
	
		<?php switch($status): 
				 case "admin": ?>
				 <div class="ctrl-panel1">
				<li><a href="create.php">Новый пользователь</a></li>
			<!--<li><a href="delete.html">Удаление</a></li>-->
				<li><a href="add.php">Добавление</a></li>
			<!--<li><a href="edit.html">Редактирование</a></li>-->
				<li><a href="include/logout.php">Выход</a></li>
				</div>
			<?php break; ?>		
			<?php case "user": ?>
				<p>8(800)555-35-35<br>(круглосуточно)</p>
				<li><a href="trash.php" id="trash-menu-txt"><img src="img/korzina.png" width="35" height="29"><?=$trash?></a></li>
				<li><a href="include/logout.php">Выход</a></li>
			<?php break; ?>
			
			<?php default: ?>
			   <li>
				<a href="reg.php">Регистрация</a><br>
				<a href="index.php">Вход</a>
				</li>
		<?php endswitch; ?>
	</ul>
</header>