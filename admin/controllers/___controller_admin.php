<?
class Controller_admin extends Controller{
	function __construct($db){
		parent::__construct($db);
		$this->model = new Model_Admin($db);
	}

	function action_index() {

	}

	function action_administration(){
		if ($_SESSION["log"]) {
			header("Location: /admin/view/main_view.php");
		}
		var_damp($_POST["log"]);
		if ($_POST["log"]){
			echo "string";
			$this->model->AdministrationAdmin();
			header("Location: /admin/view/main_view.php");
			
		}
		$this->view->generate("administration_view.php", "template_view.php");
	}
}
?>