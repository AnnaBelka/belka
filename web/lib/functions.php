<?

function clearRequest($req){
	return trim(strip_tags(htmlspecialchars($req)));		
}

function mysqli_fetch_all_my($data){
	$arr = [];
	while($row = mysqli_fetch_assoc($data)){
		$arr[] = $row;
	}
	return $arr;

}

?>