<h1>Регистрация</h1>
<form action="registration.<?=$config['prefix']?>" enctype="multipart/form-data" method="POST">
	<input type="text" name="name_user" placeholder="Введите ваше имя"><br><br>
	<input type="text" name="second_name_user" placeholder="Введите вашу фамилию"><br><br>
	<input type="text" name="middle_name" placeholder="Введите ваше отчество"><br><br>
	<input type="text" id="phone" name="phone" placeholder="Введите ваш телефон"><br><br>
	<input type="text" name="email" placeholder="Введите ваш email"><br><br>
	<input type="text" name="login" placeholder="Введите ваш логин"><br><br>
	<input type="password" name="passwd" placeholder="Введите ваш пароль"><br><br>
	<input type="submit" name="reg" value="Регистрация">
</form>
<script type="text/javascript">
jQuery(function($){
		   $("#phone").mask("8 (099) 999-99-99");
		});
</script>