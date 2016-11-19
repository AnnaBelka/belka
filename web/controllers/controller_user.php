<?
class Controller_user extends Controller{
	function __construct($db){
		parent::__construct($db);
		$this->model = new Model_User($db);
		// var_dump($db);
	}

	function action_index()
	{	

	}

	function action_login()
	{	
		if (isset($_POST["auth"])&&$_POST["auth"]) {
			$this->model->loginUser();
			
			if ($_POST["save"]) {
				$this->model->loginSaveUser();
			}
			header("location: /");
		}
		
		$this->view->generate('login_view.php', 'template_view.php');
	}

	function action_registration()
	{	
		if (isset($_POST["reg"])&&$_POST["reg"]) {
			$this->model->regUser();
			$_SESSION["auth"] = true;
			header("location: /");
		}
		
		$this->view->generate('registration_view.php', 'template_view.php');	
	}

	function action_private()
	{	
		if (isset($_POST["exit"])&&$_POST["exit"]) {
			$this->model->privateExitUser();
			header("location: /");
		}
		if (isset($_POST["save"])&&$_POST["save"]) {
			$this->model->privateSaveUser();
		}
		if (isset($_SESSION["auth"])&&$_SESSION["auth"]) {
			$user = $this->model->privateUser();
			$this->view->generate('private_view.php', 'template_view.php', $user);
		}
			
		$this->view->generate('private_view.php', 'template_view.php');
			
	}
}

?>