<?php

class Controller_Main extends Controller{
	function __construct($db){
		parent::__construct($db);
		$this->model = new Model_Main($db);
	}


	function action_index(){	
		$this->view->generate('main_view.php', 'template_view.php');
		if (isset($_POST["exit"])&&$_POST["exit"]) {
			$this->model->ExitAdmin();
			header("location: /");
		}
	}
	function action_admin(){
		if (isset($_POST["auth"])&&$_POST["auth"]){
			$this->model->LoginAdmin();
			$this->view->generate('main_view.php', 'template_view.php');
			print_r($_SESSION['meneger_id']);
			print_r($_SESSION['login']);
		}

		$this->view->generate("administration_view.php", "template_view.php");
	}
}