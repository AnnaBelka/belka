<?
$meneger = $data;
$right = $meneger['right'][0];
//print_r($meneger);
?>
<form>
<span>LOGIN</span>
<input type="text" name="login" value="<?=$meneger[0]['login']?>">
<span>PASSWORD</span>
<input type="password" name="passwd" value="">
<br>
<br>
<br>
<br>
<table>
	<tr>
		<td>Товары</td>
		<td>Клиенты</td>
		<td>Менеджеры</td>
		<td>Страницы</td>
	</tr>
	<tr>
<?foreach($right as $key=>$val){?>
	<td><input type="checkbox" name="<?=$key?>" <?if($val==1){?> checked="1" <?}?>></td>
<?}?>
	</tr>
</table>
<input type="submit" name="save" value="Сохранить">
</form>