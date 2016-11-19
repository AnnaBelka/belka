<?if(isset($_SESSION["auth"])&&$_SESSION["auth"]){?>
	<form action="private.<?=$config["prefix"]?>" enctype="multipart/form-data" method="POST">

		<div>Имя:</div> <input type="text" name="name_user" value="<?=$data[0]["name_user"]?>">
		<div>Фамилия:</div> <input type="text" name="second_name_user" value="<?=$data[0]["second_name_user"]?>">
		<div>Отчество:</div> <input type="text" name="middle_name" value="<?=$data[0]["middle_name"]?>">
		<div>Email:</div> <input type="text" name="email" value="<?=$data[0]["email"]?>">
		<div>Телефон:</div> <input type="text" id="phone" name="phone" value="<?=$data[0]["phone"]?>">
		<div>Логин:</div> <input type="text" name="login" value="<?=$data[0]["login"]?>">
		<div>Пароль:</div> <input type="password" name="passwd" value="">
		<input type="submit" name="save" value="Сохранить изменения">
		<input type="submit" name="exit" value="Выход">
	</form>
<?}
else{?>
	<div>
		<a href="/registration.<?=$config["prefix"]?>">Регистрация</a>
	</div>
	<div>
		<a href="/login.<?=$config["prefix"]?>">Вход</a>
	</div>
<?}
?>
<script type="text/javascript">
jQuery(function($){
		   $("#phone").mask("8 (099) 999-99-99");
		});
</script>