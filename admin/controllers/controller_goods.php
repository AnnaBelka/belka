<?
class Controller_goods extends Controller{
	function __construct($db){
		parent::__construct($db);
		$this->model = new Model_Goods($db);
		// var_dump($db);
	}

	function action_index(){	
		$goods = $this->model->getGoods();		
		$this->view->generate('goods_view.php', 'template_view.php', $goods);
	}
	function action_add(){
		if (isset($_POST['save'])&&$_POST['save']) {
			
			$good = $this->model->addGood();
			$this->view->generate('good_view.php', 'template_view.php', $good);
		}
		$this->view->generate('good_add_view.php', 'template_view.php');
	}
	function action_edit(){
		$id = clearRequest($_GET['id']);
		$id_good = $id;
		//print_r($id_good);
		if (isset($_POST['save'])&&$_POST['save']) {
			$good = $this->model->editGood($id_good);
		}
		$good = $this->model->getGood($id_good);
		$this->view->generate('good_view.php', 'template_view.php', $good);
		
		
	}
	function action_delite(){
		$id = clearRequest($_GET['id']);
		$id_good = $id;
		$this->model->deliteGood($id_good);
		$goods = $this->model->getGoods();
		$this->view->generate('goods_view.php', 'template_view.php', $goods);
	}
}