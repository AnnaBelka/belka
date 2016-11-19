<?
$menegers = $data;
//print_r($manegers);
?>
<a href="/administrator/meneger/add">Добавить менеджера</a></br></br></br>
<?foreach ($menegers as $key => $meneger) {?>

	<a href="/administrator/menegers/edit?id=<?=$meneger['id']?>"><?=$meneger['login']?></a>
<?}?>



