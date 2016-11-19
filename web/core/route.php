<?php

/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/
class Route
{

	static function start()
	{
		global $config;
		$db = new Db();
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		// portfolio
		$routes = explode('?', $_SERVER['REQUEST_URI'])[0];
		$routes = explode('/', $routes);
		$url = explode(".", $routes[1]);

		if (isset($url[1])) {
			if ($config["prefix"] === $url[1]) {
			$real_route = $db->makeQuery("SELECT real_route FROM routes WHERE alias_url = '".$url[0]."';")[0]["real_route"];

			}
		}
		elseif(!empty($routes[2])){
			$url = explode(".", $routes[2]);
			if ($config["prefix"] === $url[1]) {
				$real_route = $db->makeQuery("SELECT real_route FROM routes WHERE alias_url = '".$url[0]."';")[0]["real_route"];
			}
		}

		if (!empty($real_route)) {
			
			$routes = explode('?', $real_route)[0];
			if (strpos($real_route, '?')) {
				$id_good = explode('?', $real_route)[1];
			}
			if (strpos($real_route, '=')) {
				$id_good = explode('=', $id_good)[1];
			}
			$routes = explode('/', $routes);

		}	
		// получаем имя контроллера
		if ( !empty($routes[0]) ){	
			$controller_name = $routes[0];
		}
		
		// получаем имя экшена
		if ( !empty($routes[1]) ){
			$action_name = $routes[1];
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
		$model_path = "web/models/".$model_file;
		if(file_exists($model_path)){
			include "web/models/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "web/controllers/".$controller_file;
		if(file_exists($controller_path)){
			include "web/controllers/".$controller_file;
		}
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
			if (isset($id_good)) {
				$controller->$action($id_good);
			}else{
				$controller->$action();
			}
			
		}
		else{
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	
	}

	public static function ErrorPage404(){
		
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
    
}
