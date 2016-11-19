<?
	class Model_User extends Model {
		protected $login;
		protected $passwd;
		protected $email;
		protected $second_name_user;
		protected $middle_name;
		protected $phone;
		protected $query;
		protected $valid;
		protected $auth;
		protected $save;
		protected $user;
		
		public function __construct($db){
		parent::__construct($db);
		//var_dump($db);
		}

		public function regUser(){
			// Validation
			$this->name_user = clearRequest($_POST['name_user']);
			$this->second_name_user=clearRequest($_POST['second_name_user']);
			$this->middle_name=clearRequest($_POST['middle_name']);
			$this->phone=clearRequest($_POST['phone']);
			$this->email = clearRequest($_POST['email']);
			$this->login = clearRequest($_POST['login']);
			$this->passwd = clearRequest($_POST['passwd']);
			
			

			$this->valid = Validation::checkAllFields(["login"=>$this->login, 'passwd'=>$this->passwd, "email"=>$this->email, 'name_user'=>$this->name_user, 'phone'=>$this->phone, 'second_name_user'=>$this->second_name_user, 'middle_name'=>$this->middle_name]);

			if (!$this->valid) {
				
				die();
			}
			$this->name_user = mysqli_real_escape_string($this->db->dbc, $this->name_user);
			$this->second_name_user = mysqli_real_escape_string($this->db->dbc, $this->second_name_user);
			$this->middle_name = mysqli_real_escape_string($this->db->dbc, $this->middle_name);
			$this->phone = mysqli_real_escape_string($this->db->dbc, $this->phone);
			$this->login = mysqli_real_escape_string($this->db->dbc, $this->login);
			$this->passwd = mysqli_real_escape_string($this->db->dbc, $this->passwd);
			$this->email = mysqli_real_escape_string($this->db->dbc, $this->email);
			$this->passwd = password_hash($this->passwd, PASSWORD_DEFAULT);	

			$this->query = "INSERT INTO `user`(`name_user`, `second_name_user`, `middle_name`, `phone`, `login`, `email`, `passwd`) VALUES ('$this->name_user', '$this->second_name_user', '$this->middle_name', '$this->phone','$this->login',  '$this->email', '$this->passwd')";
			//var_dump($this->query);
			// var_dump($this);
			$this->db->makeQuery($this->query);
			//var_dump($this->db);
		}

		public function loginUser(){

			$this->login = clearRequest($_POST['login']);
			$this->passwd = clearRequest($_POST['passwd']);

			$this->valid = Validation::checkAllFields(["login"=>$this->login, 'passwd'=>$this->passwd]);
			if (!$this->valid) {
				die();
			}
			
			$this->query = "SELECT `id`, `login`,  `passwd` FROM `user` WHERE `login`='$this->login'";

			$this->users = $this->db->makeQuery($this->query);
			
			if ($this->users) {
				if (password_verify($this->passwd, $this->users[0]['passwd'])) {
					$_SESSION["auth"] = true;
					$_SESSION["user_id"] = $this->users[0]['id'];
				}
			}
		}

		public function loginSaveUser(){
				
				$_SESSION["hash"]=password_hash($this->login, PASSWORD_DEFAULT);
				setcookie("session",$_SESSION["auth"], time()+15552000);
		
		}

		public function privateUser(){

			$this->query = "SELECT  `id`, `name_user`, `second_name_user`, `middle_name`, `phone`, `login`, `email` FROM `user` WHERE id=".$_SESSION["user_id"]."";
			$this->user = $this->db->makeQuery($this->query);
			//var_dump($this->user) ;
			return $this->user;
		}

		public function privateSaveUser(){

			$this->name_user = clearRequest($_POST['name_user']);
			$this->second_name_user=clearRequest($_POST['second_name_user']);
			$this->middle_name=clearRequest($_POST['middle_name']);
			$this->phone=clearRequest($_POST['phone']);
			$this->email = clearRequest($_POST['email']);
			$this->login = clearRequest($_POST['login']);
			
			$this->valid = Validation::checkAllFields(["login"=>$this->login, "email"=>$this->email, 'name_user'=>$this->name_user, 'phone'=>$this->phone, 'second_name_user'=>$this->second_name_user, 'middle_name'=>$this->middle_name]);

			if (!$this->valid) {
				
				die();
			}
			//var_dump($this->login);
			$this->name_user = mysqli_real_escape_string($this->db->dbc, $this->name_user);
			$this->second_name_user = mysqli_real_escape_string($this->db->dbc, $this->second_name_user);
			$this->middle_name = mysqli_real_escape_string($this->db->dbc, $this->middle_name);
			$this->phone = mysqli_real_escape_string($this->db->dbc, $this->phone);
			$this->login = mysqli_real_escape_string($this->db->dbc, $this->login);
			$this->email = mysqli_real_escape_string($this->db->dbc, $this->email);
			
			$this->query = "UPDATE `user` SET `name_user`='$this->name_user',`second_name_user`='$this->second_name_user',`middle_name`='$this->middle_name',`phone`='$this->phone',`login`='$this->login',`email`='$this->email' WHERE id=".$_SESSION["user_id"]."";
			$this->db->makeQuery($this->query);
			//var_dump($this->query);

			if (!empty($this->passwd)) {
				$this->passwd = clearRequest($_POST['passwd']);
				$this->valid = Validation::checkAllFields(['passwd'=>$this->passwd]);
				if (!$this->valid) {
					die();
				}
				$this->passwd = mysqli_real_escape_string($this->db->dbc, $this->passwd);
				$this->passwd = password_hash($this->passwd, PASSWORD_DEFAULT);	

				$this->query = "UPDATE `user` SET `passwd`='$this->passwd' WHERE id=".$_SESSION["user_id"]."";
				$this->db->makeQuery($this->query);
			}
		}

		public function privateExitUser(){
			unset($_SESSION["auth"]);
			unset($_SESSION["user_id"]);
		}
	}
?>