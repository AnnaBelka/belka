<?
	Class Model_Admin extends Model{
		protected $login;
		protected $passwd;
		protected $menegers;

		public function __construct($db){
		parent::__construct($db);
		
		}

		public function AdministrationAdmin(){

			$this->login = clearRequest($_POST['login']);
			$this->passwd = clearRequest($_POST['passwd']);
			var_dump($this->login);
			$this->valid = Validation::checkAllFields(["login"=>$this->login, 'passwd'=>$this->passwd]);
			if (!$this->valid) {
				die();
			}
			
			$this->query = "SELECT `id`, `login`,  `passwd` FROM `menegers` WHERE `login`='$this->login'";

			$this->menegers = $this->db->makeQuery($this->query);
			var_dump($this->menegers);
			if ($this->menegers) {
				if (password_verify($this->passwd, $this->menegers[0]['passwd'])) {
					$_SESSION["log"] = true;
					$_SESSION["meneger_id"] = $this->menegers[0]['id'];
				}
			}

		}
	}
?>