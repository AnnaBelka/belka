<?
$good = $data;
//var_dump($good);
//var_dump($good['images']);
?>
<form action="/administrator/goods/edit?id=<?=$good[0]['id']?>" enctype="multipart/form-data" method="POST">
	<div id="good">
		<div class="stickers">
			<div class="sticker">		
				<input id="hit" type="radio" name="sticker[]" value="topSales" checked="<?if ($good[0]['sticker']=='Топ продаж') {?>
							1<?}else{?>0<?}?>">
				<label for="hit">Топ продаж</label>
			</div>
			<div class="sticker">
				<input id="sale" type="radio" name="sticker[]" value="promo" checked="<?if ($good[0]['sticker']=='Акция') {?>
							1<?}else{?>0<?}?>">
				<label for="sale">Акция</label>
			</div>
		</div>

		<div>
			<input class="name" type="text" name="name" placeholder="Название товара" value="<?=$good[0]['name'];?>">
		</div>

		<h4>Мета-теги</h4>
		<div class="meta_date">
			<ul>
				<li class="key">URL</li>
				<li class="value"><input type="text" name="url" placeholder="URL" value="<?=$good[0]['url'];?>"></li>
			</ul>
			<ul>
				<li class="key">Meta-title</li>
				<li class="value"><input type="text" name="meta_title" value="<?=$good[0]['meta_title'];?>"></li>
			</ul>
			<ul>
				<li class="key">Meta-description</li>
				<li class="value"><input type="text" name="meta_description" value="<?=$good[0]['meta_description'];?>"></li>
			</ul>
			<ul>
				<li class="key">Meta-keywords</li>
				<li class="value"><input type="text" name="meta_keywords" value="<?=$good[0]['meta_keywords'];?>"></li>
			</ul>
		</div>

		<h4>Изображение товара</h4>	
		<div class="images">				
			<div>
				<img src="/../files/imgGood/<?=$good['images'][0]['name_img']?>">
				<label for="alt">Alt</label>
				<input id="alt" type="text" name="alt" value="<?=$good['images'][0]['alt']?>">
				<label for="title">Title</label>
				<input id="title" type="text" name="title" value="<?=$good['images'][0]['title']?>">
	 		</div>
	            <input type="file" name="name_img" accept ="image/*" accept="image/jpeg,image/png,image/gif">


			
		</div>
		
		<div class="price">
			<table>
				<tr>
					<td>Цена</td>
					<td>Старая цена</td>
					<td>В наличии</td>
					<td>Рейтинг</td>
				</tr>
				<tr>
					<td class="cell"> 
						<input type="text" name="price" value="<?=$good[0]['price']?>">
					</td>				
					<td class="cell">
						<input type="text" name="oldPrice" value="<?=$good[0]['oldPrice']?>">
					</td>
					<td class="cell">
						<input type="checkbox" name="ending" checked="<?if ($good['ending']==1) {?>
							1<?}else{?>0<?}?>">
					</td>
				    <td class="cell">
				    	<input type="text" name="raiting" value="<?=$good[0]['raiting']?>">
				    </td>
			    </tr>
		    </table>
		</div>
	
		<!--  -->

		<h4>Описание</h4>	
		<div>
	        <textarea name="description" id="description" rows="10" cols="50">
	        	<?=$good[0]['description']?>
	        </textarea>
	        <script>
	            CKEDITOR.replace( 'description' ,{
	            	customConfig: '/ckeditor/ckeditor_config.js'
	            });
	        </script>
	    </div>
	   <div class="block_dop">
	   
			<div class="variants">
				<!-- <span>Цвет</span>
				
				
					
					<div class="color">
						<input id="red" type="checkbox" name="color[]" value="red" >
						<label for="red">red</label>
					</div>
					<div class="color">
						<input id="black" type="checkbox" name="color[]" value="black">
						<label for="black">black</label>
					</div>
					<div class="color">
						<input id="white" type="checkbox" name="color[]" value="white" >
						<label for="white">white</label>
					</div>
					<div class="color">
						<input id="skyblue" type="checkbox" name="color[]" value="skyblue" >
						<label for="skyblue">skyblue</label>
					</div>
					<div class="color">
						<input id="silver" type="checkbox" name="color[]" value="silver" >
						<label for="silver">silver</label>
					</div>
					<div class="color">
						<input id="yellow" type="checkbox" name="color[]" value="yellow" >
						<label for="yellow">yellow</label>
					</div> -->
				
			</div>

			<div class="features">
				<!-- <div>
					<span>Изображения свойств</span>
					<input type="file" name="features" multiple accept ="image/*">
				</div> -->
				<div>
					<span>Видеообзор</span>
					<input type="text" name="mediaLinkVideo" value="<?=$good[0]['mediaLinkVideo']?>">
				</div>
				<div>
					<span>Демовидео</span>
					<input type="text" name="mediaLinkDemo" value="<?=$good[0]['mediaLinkDemo']?>">
				</div>
			</div>
		</div>
	    
	    	
	    <div>
	    	<input type="submit" name="save" value="Сохранить">
	    </div>
	</div>
</form>