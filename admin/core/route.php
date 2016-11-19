<?php
/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/
class Route{
	static function start()
	{
		$db = new DB();
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
			
		// /portfolio
		$routes = explode('?', $_SERVER['REQUEST_URI']);
		$routes = explode('/', $routes[0]);

		// получаем имя контроллера
		if ( !empty($routes[2]) ){	
			$controller_name = $routes[2];
		}
		
		// получаем имя экшена
		if ( !empty($routes[3]) ){
			$action_name = $routes[3];
		}
		elseif(!isset($_SESSION['admin'])){
			$action_name = 'admin';
		}

		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;
		
		// echo "Model: $model_name <br>";
		// echo "Controller: $controller_name <br>";
		// echo "Action: $action_name <br>";

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		$model_path = "admin/models/".$model_file;
		
		if(file_exists($model_path)){
			include "admin/models/".$model_file;
		
		}
		$right = "SELECT `goods`, `users`, `menegers`, `pages` FROM `role_meneger` WHERE `id_meneger`= '".$_SESSION['meneger_id']."'";
		$right = $db->makeQuery($right);
		
		$right_controller = explode('_', $controller_name)[1];

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "admin/controllers/".$controller_file;

		//if (array_key_exists($right_controller,$right[0])&&$right[0][$right_controller] == 1) {
			//echo $right[0][$right_controller];
			if(file_exists($controller_path)){
				include "admin/controllers/".$controller_file;
			}
		//}
		
		else{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			Route::ErrorPage404();		
		}
		
		// создаем контроллер
		$controller = new $controller_name($db);
		$action = $action_name;
		
		if(method_exists($controller, $action)){
			// вызываем действие контроллера
			$controller->$action();	
		}
		else{
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	
	}

	public static function ErrorPage404()
	{
		phpinfo();
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'administrator/404');
		die();
    }
    
}
