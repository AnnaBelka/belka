<h1>Вход</h1>
<form action="login.<?=$config['prefix']?>" enctype="multipart/form-data" method="POST">
	<div>Login:</div> <input type="text" name="login">
	<div>Пароль:</div> <input type="password" name="passwd">
	<div><input id="time" type="checkbox" name="save">
	<label for="time">Запомнить меня</label></div>
	</br>
	<input type="submit" name="auth" value="Вход">
</form>