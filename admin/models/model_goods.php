<?
class Model_Goods extends Model{
	protected $name;
	protected $url;
	protected $meta_title;
	protected $meta_description;
	protected $meta_keywords;
	protected $sticker;
	protected $price;
	protected $oldPrice;
	protected $ending;
	protected $raiting;
	protected $description;
	protected $mediaLinkVideo;
	protected $mediaLinkDemo;
	protected $mainImg;
	protected $name_img;
	protected $alt;
	protected $title;
	protected $color;
	protected $features = array();
	public $dbc;
	

	public function __construct($db){
		parent::__construct($db);
		//var_dump($db);
		}

	public function getGoods(){
		$this->query = "SELECT `id`, `name`, `sticker`, `price`, `oldPrice`, `mainImg` FROM `goods`";
		$this->goods = $this->db->makeQuery($this->query);
			//var_dump($this->goods) ;
			return $this->goods;
	}

	public function getGood($id_good){
		$this->query = "SELECT `id`, `name`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `sticker`, `price`, `oldPrice`, `ending`, `raiting`, `description`, `mediaLinkVideo`, `mediaLinkDemo`, `mainImg` FROM `goods` WHERE `id` = $id_good";
		$this->good = $this->db->makeQuery($this->query);
		$this->query = "SELECT `id`, `id_good`, `name_img`, `alt`, `title` FROM `imgGood` WHERE `id_good` = $id_good";
		$this->good['images'] = $this->db->makeQuery($this->query);
		$this->query = "SELECT `id`, `id_good`, `features`, `color` FROM `features` WHERE `id_good` = $id_good";
		$this->good['features'] = $this->db->makeQuery($this->query);
			//var_dump($this->good) ;
			return $this->good;
	}

	public function addGood(){

		$this->name = trim($_POST['name']);
		$this->meta_title=trim($_POST['meta_title']);
		$this->meta_description=trim($_POST['meta_description']);
		$this->meta_keywords=trim($_POST['meta_keywords']);
		
		if (isset($_POST['sticker'])) {
			foreach ($_POST['sticker'] as $key => $s) {
				$this->sticker = clearRequest($s);
				if (checkbox_verify('sticker','topSales')) {
					$this->sticker = "Топ продаж";
				}
				if (checkbox_verify('sticker','promo')) {
					$this->sticker = "Акция";
				}
			}
		}

		$this->price = clearRequest($_POST['price']);
		$this->oldPrice = clearRequest($_POST['oldPrice']);
		
		$this->ending=clearRequest($_POST['ending']);
		if ($this->ending) {
			$this->ending=true;
		}else{
			$this->ending=false;
		}
		
		$this->raiting = clearRequest($_POST['raiting']);

		$this->description=trim($_POST['description']);
		$this->mediaLinkVideo=trim($_POST['mediaLinkVideo']);
		$this->mediaLinkDemo=trim($_POST['mediaLinkDemo']);


		$imgGood_1=($_FILES["name_img"]['name']);
		//print_r($imgGood_1);

		$imgGood_2=$_FILES["name_img"]['tmp_name'];

		$directoriya="../files/imgGood/";
		

		$this->name_img = save_img($imgGood_1, $imgGood_2, $directoriya);
		//print_r($this->name_img);
		$this->alt = clearRequest($_POST['alt']);
		$this->title = clearRequest($_POST['title']);


		// if (isset($_POST['color'])) {
		// 	foreach ($_POST['color'] as $k => $c) {
		// 		$color[]=clearRequest($c);
		// 	}
		// }

		// $features_1=(array)$_FILES["features"]['name'];
		// $features_2=(array)$_FILES["features"]['tmp_name'];
		// $directori_features="../files/features/";
		// $this->features=array();
		// foreach ($features_1 as $k){
		// 	$this->features=save_img($features_1[$k], $features_2[$k], $directori_features);
		// 	$this->img_features[]=$this->features;
		// }

		$this->query = "INSERT INTO `goods`(`name`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `sticker`, `price`, `oldPrice`, `ending`, `raiting`, `description`, `mediaLinkVideo`, `mediaLinkDemo`, `mainImg`) VALUES ('$this->name', '$this->url', '$this->meta_title', '$this->meta_description', '$this->meta_keywords','$this->sticker',  '$this->price', '$this->oldPrice', '$this->ending', '$this->raiting', '$this->description', '$this->mediaLinkVideo', '$this->mediaLinkDemo', '$this->name_img')";

			//var_dump($this->query);
			// var_dump($this);
		$good = $this->db->makeQuery($this->query);
			//var_dump($good);
		if ($good) {
			$id_good = mysqli_insert_id($this->db->dbc);
			$this->query = "INSERT INTO `imgGood`(`id_good`, `name_img`, `alt`, `title`) VALUES ('$id_good','$this->name_img','$this->alt','$this->title')";

			$this->db->makeQuery($this->query);
		}


	}

	public function editGood($id_good){
		//var_dump($id_good);
		$this->name = trim($_POST['name']);
		$this->meta_title=trim($_POST['meta_title']);
		$this->meta_description=trim($_POST['meta_description']);
		$this->meta_keywords=trim($_POST['meta_keywords']);
		
		if (isset($_POST['sticker'])) {
			foreach ($_POST['sticker'] as $key => $s) {
				$this->sticker = clearRequest($s);
				if (checkbox_verify('sticker','topSales')) {
					$this->sticker = "Топ продаж";
				}
				if (checkbox_verify('sticker','promo')) {
					$this->sticker = "Акция";
				}
			}
		}

		$this->price = clearRequest($_POST['price']);
		$this->oldPrice = clearRequest($_POST['oldPrice']);
		
		$this->ending=clearRequest($_POST['ending']);
		if ($this->ending) {
			$this->ending=true;
		}else{
			$this->ending=false;
		}
		
		$this->raiting = clearRequest($_POST['raiting']);

		$this->description=trim($_POST['description']);
		$this->mediaLinkVideo=trim($_POST['mediaLinkVideo']);
		$this->mediaLinkDemo=trim($_POST['mediaLinkDemo']);


		$imgGood_1=$_FILES["name_img"]['name'];
		print_r($imgGood_1);

		$imgGood_2=$_FILES["name_img"]['tmp_name'];
		print_r($imgGood_1);

		$directoriya="files/imgGood/";
		
		/*	$res = preg_match_all('/\b\.[a-z]{3,4}\b$/i', $imgGood_1);
		if ($res=='.jpeg'||$res=='.jpg'||$res=='.bmp'||$res=='.png'||$res=='.gif') {*/

			$this->name_img = save_img($imgGood_1, $imgGood_2, $directoriya);
			//print_r($this->name_img);
			$this->alt = clearRequest($_POST['alt']);
			$this->title = clearRequest($_POST['title']);


		if (isset($_POST['color'])) {
			foreach ($_POST['color'] as $k => $c) {
				$color[]=clearRequest($c);
			}
		}

		$this->url = translit($_POST['url']);
		$real_url = "category/good?id=".$id_good;
		

		$this->query = "INSERT INTO `routes`(`alias_url`, `real_route`) VALUES ('$this->url','$real_url')";
		$this->db->makeQuery($this->query);

		// $features_1=(array)$_FILES["features"]['name'];
		// $features_2=(array)$_FILES["features"]['tmp_name'];
		// $directori_features="../files/features/";
		// $this->features=array();
		// foreach ($features_1 as $k){
		// 	$this->features=save_img($features_1[$k], $features_2[$k], $directori_features);
		// 	$this->img_features[]=$this->features;
		// }
		$this->query = "UPDATE `goods` SET `name`='$this->name', `url`='$this->url',`meta_title`='$this->meta_title',`meta_description`='$this->meta_description',`meta_keywords`='$this->meta_keywords',`sticker`='$this->sticker',`price`='$this->price',`oldPrice`='$this->oldPrice',`ending`='$this->ending',`raiting`='$this->raiting',`description`='$this->description',`mediaLinkVideo`='$this->mediaLinkVideo',`mediaLinkDemo`='$this->mediaLinkDemo', `mainImg`='$this->name_img' WHERE `id`=$id_good";

	
		$this->db->makeQuery($this->query);

		
		$this->query = "SELECT `id`, `id_good`, `name_img`, `alt`, `title` FROM `imgGood` WHERE `id_good` = $id_good";
		$this->images = $this->db->makeQuery($this->query);
		if ($this->images[0]['id_good']) {
			$this->query = "UPDATE `imgGood` SET `name_img`='$this->name_img',`alt`='$this->alt',`title`='$this->title' WHERE `id_good`=$id_good";
			$this->db->makeQuery($this->query);
		}
		else{
			$this->query = "INSERT INTO `imgGood`(`id_good`, `name_img`, `alt`, `title`) VALUES ('$id_good','$this->name_img','$this->alt','$this->title')";
			$this->db->makeQuery($this->query);
		}
		

	}

	public function deliteGood($id_good){
		$this->query = "SELECT `id`, `name`, `meta_title`, `meta_description`, `meta_keywords`, `sticker`, `price`, `oldPrice`, `ending`, `raiting`, `description`, `mediaLinkVideo`, `mediaLinkDemo`, `mainImg` FROM `goods` WHERE `id` = $id_good";
		$good = $this->db->makeQuery($this->query);
		
		$this->query = "SELECT `id_good`, `name_img`, `alt`, `title` FROM `imgGood` WHERE `id_good` = $id_good";
		$image = $this->db->makeQuery($this->query);
		//var_dump($good);
		//var_dump($image);
		$this->query = "INSERT INTO `delite`(`id_good`, `name`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `sticker`, `price`, `oldPrice`, `ending`, `raiting`, `description`, `mediaLinkVideo`, `mediaLinkDemo`, `mainImg`, `alt`, `title`) VALUES ('$id_good','".$good[0]['name']."', '".$good[0]['url']."','".$good[0]['meta_title']."','".$good[0]['meta_description']."','".$good[0]['meta_keywords']."','".$good[0]['sticker']."','".$good[0]['price']."','".$good[0]['oldPrice']."','".$good[0]['ending']."','".$good[0]['raiting']."','".$good[0]['description']."','".$good[0]['mediaLinkVideo']."','".$good[0]['mediaLinkDemo']."','".$good[0]['mainImg']."','".$image[0]['alt']."','".$image[0]['title']."')";
		$this->db->makeQuery($this->query);
		$this->query = "DELETE FROM `goods` WHERE `id` = $id_good";
		$this->db->makeQuery($this->query);
		$this->query = "DELETE FROM `imgGood` WHERE `id_good` = $id_good";
		$this->db->makeQuery($this->query);
	}
}
?>