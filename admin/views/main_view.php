<form  action="/administrator" enctype="multipart/form-data" method="POST">
<h1>Привет 
	<span style="color:red;">
	<?if (isset($_SESSION['admin'])){
		echo $_SESSION['admin'];
	}?>
	</span>
</h1>
<input type="submit" name="exit" value="Выйти">
</form>