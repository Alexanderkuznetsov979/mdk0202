<?php
	require_once "include/session.php";
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
	?>

	<main>
  <div id="slid" class='slide' >
    <input type="radio" name="slider2" id="slider2_1" checked="checked">
    <label for="slider2_1"></label>
    <div><img src="img/foto1.jpg"></div>
    <label for="slider2_2"></label>

    <input type="radio" name="slider2" id="slider2_2">
    <label for="slider2_2"></label>
    <div><img src="img/foto2.jpg"></div>
    <label for="slider2_3"></label>

    <input type="radio" name="slider2" id="slider2_3">
    <label for="slider2_3"></label>
    <div><img src="img/foto3.jpg"></div>
    <label for="slider2_4"></label>
	
	<input type="radio" name="slider2" id="slider2_4">
    <label for="slider2_4"></label>
    <div><img src="img/foto4.jpg"></div>
    <label for="slider2_5"></label>
   </div>
<br>
   
</main>
	

</body>
<?php require_once "blocks/footer.php"; ?>
</html>