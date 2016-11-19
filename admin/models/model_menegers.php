<?
	class Model_Menegers extends Model{

		public function __construct($db){
		parent::__construct($db);
		//var_dump($db);
		}
		public function getMenegers(){
			$this->query = "SELECT `id`, `login` FROM `menegers` WHERE 1";
			$this->menegers = $this->db->makeQuery($this->query);
			//var_dump($this->menegers) ;
			return $this->menegers;
		}

		public function editMeneger(){

		}

		public function getMeneger($id_meneger){
			$this->query = "SELECT `id`, `login` FROM `menegers` WHERE `id`=$id_meneger";
			$this->meneger = $this->db->makeQuery($this->query);

			$this->query = "SELECT `goods`, `users`, `menegers`, `pages` FROM `role_meneger` WHERE `id_meneger`=$id_meneger";
			$this->meneger['right'] = $this->db->makeQuery($this->query);
			//var_dump($this->meneger) ;
			return $this->meneger;
		}
	}
?>