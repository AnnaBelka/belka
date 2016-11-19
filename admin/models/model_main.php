<?
	class Model_Main extends Model{

		public function __construct($db){
		parent::__construct($db);
		//var_dump($db);
		}
		public function LoginManeger(){
			$this->query = "SELECT `goods`, `users`, `menegers`, `pages` FROM `role_meneger` WHERE `id_meneger`=$id_meneger";
			$this->right = $this->db->makeQuery($this->query);
			return $this->right;
		}
		public function LoginAdmin(){

			$this->login = clearRequest($_POST['login']);
			$this->passwd = clearRequest($_POST['passwd']);
			//var_dump($this->login);
			$this->valid = Validation::checkAllFields(["login"=>$this->login, 'passwd'=>$this->passwd]);
			if (!$this->valid) {
				die();
			}
			
			$this->query = "SELECT `id`, `login`,  `passwd` FROM `menegers` WHERE `login`='$this->login'";

			$this->menegers = $this->db->makeQuery($this->query);
			if ($this->menegers) {
				if (password_verify($this->passwd, $this->menegers[0]['passwd'])) {
					$_SESSION["admin"] = $this->menegers[0]['login'];
					$_SESSION["meneger_id"] = $this->menegers[0]['id'];
				}
			}

		}

		public function ExitAdmin(){
			unset($_SESSION["admin"]);
			unset($_SESSION["meneger_id"]);
		}
	}