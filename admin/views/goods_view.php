<a class="add_good" href="/administrator/goods/add">Добавить товар</a>
<table>
<?
foreach ($data as $key => $good) {?>
	<tr>
		<td><img src="/../files/imgGood/<?=$good['mainImg']?>" style="max-width:80px; max-height:80px;"></td>
		<td>
			<a href="/administrator/goods/edit?id=<?=$good['id']?>"><?=$good['name']?></a>
		</td>
		<td><?=$good['price']?></td>
		<td><?=$good['oldPrice']?></td>
		<td><?=$good['sticker']?></td>
		<td class="delite"><a href="/administrator/goods/delite?id=<?=$good['id']?>"> &#10761;</a> </td>
	</tr>
<?}?>
</table>