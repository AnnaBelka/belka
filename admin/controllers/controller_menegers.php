<?
class Controller_menegers extends Controller{
	function __construct($db){
		parent::__construct($db);
		$this->model = new Model_Menegers($db);
		// var_dump($db);
	}

	function action_index(){	
		$menegers = $this->model->getMenegers();		
		$this->view->generate('menegers_view.php', 'template_view.php', $menegers);
	}
	function action_add(){
		if (isset($_POST['save'])&&$_POST['save']) {
			
			$meneger = $this->model->addMeneger();
			$this->view->generate('meneger_view.php', 'template_view.php', $meneger);
		}
		$this->view->generate('menegers_add_view.php', 'template_view.php');
	}
	function action_edit(){
		$id = clearRequest($_GET['id']);
		$id_meneger = $id;
		//print_r($id_meneger);
		if (isset($_POST['save'])&&$_POST['save']) {
			$meneger = $this->model->editMeneger($id_meneger);
		}
		$meneger = $this->model->getMeneger($id_meneger);
		$this->view->generate('meneger_view.php', 'template_view.php', $meneger);
		
		
	}
	function action_delite(){
		$id = clearRequest($_GET['id']);
		$id_meneger = $id;
		$this->model->deliteMeneger($id_meneger);
		$menegers = $this->model->getMenegers();
		$this->view->generate('menegers_view.php', 'template_view.php', $goods);
	}
}