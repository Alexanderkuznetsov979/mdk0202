<?php
	require_once "include/session.php";
	require_once "include/mysqli.php";
	$status = $_SESSION["status"];
	if(strcasecmp($status,"")==0){
	header("Location: /");}
	if(strcasecmp($status,"user")==0){
	header("Location: /");}

	db_connect();

	if(!empty($_GET["product"]) && isset($_GET["product"])) {
		$id = $_GET["product"];
		if(isset($_POST["product-edit"])) {
			
			$id = htmlentities(mysqli_real_escape_string($conn,$_POST["id"]));
			$category = htmlentities(mysqli_real_escape_string($conn,$_POST["category"]));
			$name = htmlentities(mysqli_real_escape_string($conn,$_POST["name"]));
			$description = htmlentities(mysqli_real_escape_string($conn,$_POST["description"]));
			$price = htmlentities(mysqli_real_escape_string($conn,$_POST["price"]));


			$property_name = $_POST["property-name"]; 
			$property_value = $_POST["property-value"];

			$property= array( 
				"name" => array(), 
				"value" => array() 
			);
			
			
			for($len = count($property_name), $i = 0; $i < $len; ++$i) {
				$property["name"][] = htmlentities(mysqli_real_escape_string($conn,$property_name[$i]));
				$property["value"][] = htmlentities(mysqli_real_escape_string($conn,$property_value[$i]));
			}
			
			
			$property = json_encode($property, JSON_UNESCAPED_UNICODE); 
			if( $_FILES["img"]["error"] == UPLOAD_ERR_OK )
				if ( is_uploaded_file($_FILES["img"]["tmp_name"])) {
						$tmpPath = $_FILES["img"]["tmp_name"];
						$toBuffer = file_get_contents($tmpPath); 
						$type = mime_content_type($tmpPath); 
						$img = "data:$type;base64," . base64_encode($toBuffer); 
						
					} 
		if (isset($img)) {
			db_update_productimg($id, $category, $img);
		}
		
			db_update_product($id, $category, $name, $description, $property, $price);
			
		}
		
		$id = $_GET["product"];
		
		$result = get_product($id)[0];
		$property = json_decode($result["property"], TRUE);
	}
	
	db_close();
?>
<!DOCTYPE html>
<html>

<head>
	<?php require_once "blocks/head.php"; ?>
	
	<link rel="stylesheet" href="css/add.css">
	<script src="js/add.js"></script>
</head>

<body>

	<?php 
		require_once "blocks/header.php"; 
		require_once "blocks/nav.php"; 
	?>
	
	<main>
		
		<h2>Редактирование</h2>
				
		<form id="product" class="add" method="post" enctype="multipart/form-data">
			<div class="box">
				<label>ID продукта<div style="font-size:13px;">(менять нежелательно!)</div></label>
				<input type="text" placeholder="Id" name="id" maxlength="5"  value="<?=$result["id"]?>" >
				
				<label>Категория продукта</label>
				<select name="category" required><?=$result["category"]?>
					<option value="Смартфоны">Смартфоны</option>
					<option value="Модемы">Модемы</option>
					<option value="Роутеры">Роутеры</option>
					<option value="Акссесуары">Аксессуары</option>
				</select>
				
				<label>Название</label>
				<input type="text" placeholder="Название" name="name" maxlength="50" required value="<?=$result["name"]?>">
				
				<label>Выберите изображение</label>
				<input type="file" name="img" accept="image/jpeg,image/png">
				
				<label>Текущие изображение</label>
				<div><img style="max-width:200px; height:auto" src="<?=$result["img"] == "" ? "img/NoPhoto.png" : $result["img"]?>"></div>
				
				<label>Описание</label>
				<textarea placeholder="Краткое описание выдаваемое при поиске" name="description" required rows="4" style="resize: none;" maxlength="255"><?=$result["description"]?></textarea>
				
				<label>Цена</label>
				<input type="number" placeholder="Цена за единицу товара" name="price" step="0.1" value="<?=$result["price"]?>" required>
				
				<label>Характеристики</label>
				<div id="listProperty">
					
						<?php 
						
						$name = $property["name"];
						$value = $property["value"];
						
						foreach($name as $key => $val) {
							echo <<<_TXT
								<div class="items">
									<input maxlength="50" placeholder="Название свойства" name="property-name[]" required="" type="text" value="$val">
									<input maxlength="50" placeholder="Значение свойства" name="property-value[]" required="" type="text" value="{$value[$key]}">
								</div>
_TXT;
						}
						
						?>
					
				</div>
				
				<button onclick="addProperty()" type="button">Добавить</button>
				<button onclick="deleteProperty()" type="button">Удалить</button>
				
			</div>
			
			<input type="submit" name="product-edit" value="Перезапись">
		</form>
	</main>
</body>
<?php require_once "blocks/footer.php"; ?>
</html>