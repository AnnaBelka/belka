<?

function clearRequest($req){
	return trim(strip_tags(htmlspecialchars($req)));		
}
// Выполняет: проверку checkbox
function checkbox_verify($chkname, $value){
	if (!empty($_POST[$chkname])) {
			foreach ($_POST[$chkname] as $chkval) {
				if ($chkval==$value) {
					return true;
				}
			}
		}
		return false;
}

function resize($file_input, $file_output, $w_o, $h_o, $percent = false) {
	list($w_i, $h_i, $type) = getimagesize($file_input);
	if (!$w_i || !$h_i) {
		//echo 'Невозможно получить длину и ширину изображения';
		return;
        }
        $types = array('','gif','jpeg','png', 'jpg');
        $ext = $types[$type];
        if ($ext) {
    	        $func = 'imagecreatefrom'.$ext;
    	        $img = $func($file_input);
        } else {
    	        //echo 'Некорректный формат файла';
		return;
        }
	if ($percent) {
		$w_o *= $w_i / 100;
		$h_o *= $h_i / 100;
	}
	if (!$h_o) $h_o = $w_o/($w_i/$h_i);
	if (!$w_o) $w_o = $h_o/($h_i/$w_i);

	$img_o = imagecreatetruecolor($w_o, $h_o);
	imagecopyresampled($img_o, $img, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);
	if ($type == 2) {
		return imagejpeg($img_o,$file_output,100);
	} else {
		$func = 'image'.$ext;
		return $func($img_o,$file_output);
	}
}

function img_type($file_path){
	$basename=basename($file_path);
	if (strrpos($basename, ".")) { // проверка на наличии в имени файла символа точки
		$file_extension=substr($basename, strrpos($basename, "."));
	}
	else{
		$file_extension="false";
	}
	return $file_extension;
}

function save_img($avatar, $avatar_2, $directoriya){
	$new_name=date('YmdHis') . rand(1000,100000)  . img_type($avatar);
	$new_directoriya="$directoriya$new_name";
		if ((img_type($avatar)=='.jpeg')||(img_type($avatar)=='.jpg')||(img_type($avatar)=='.bmp')||(img_type($avatar)=='.png')||(img_type($avatar)=='.gif')) {
			move_uploaded_file($avatar_2, $new_directoriya);
		}
	return $new_name;
}

function mysqli_fetch_all_my($data){
	$arr = [];
	while($row = mysqli_fetch_assoc($data)){
		$arr[] = $row;
	}
	return $arr;

}

function translit($s) {
  $s = (string) $s; // преобразуем в строковое значение
  $s = strip_tags($s); // убираем HTML-теги
  $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
  $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
  $s = trim($s); // убираем пробелы в начале и конце строки
  $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
  $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'i','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
  $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
  $s = str_replace(" ", "_", $s); // заменяем пробелы знаком минус
  return $s; // возвращаем результат
}

?>