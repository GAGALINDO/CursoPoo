<?php 
class Router {
	public $route;

	public function __construct($route) {
		//http://php.net/manual/es/function.session-start.php
		//http://php.net/manual/es/session.configuration.php
		//buscar opciones en el PHPcffffdsklllllllñ..INI
		$session_options = array(
			'use_only_cookies' => 1,
			'auto_start' => 1,
			'read_and_close' => true
		);

		if( !isset($_SESSION) )  session_start();

		if( !isset($_SESSION['ok']) )  $_SESSION['ok'] = false;

//ruta de navegación
		if($_SESSION['ok']) {
			//Aquí va toda la programación de nuestra webapp

			$this->route = isset($_GET['r']) ? $_GET['r'] : 'home';
			
			$controller = new ViewController(); //se inicializo el controlador de vista para solo llamarlo con la variable

			switch ($this->route) {
				case 'home':
					$controller->load_view('home');
					break;
//controladores de vista
					//cuando la ruta sea movie series
					//se generan  3 vistas mas usando las variable de TIPO POST (PREGUNTAR E INVERSTIGAR MAS SOBRE ESTO)
					//para cada caso edit, eliminar etc...
					//despies de load view se le agregaron la logica de vista(BUSCAR DIAGRAMA)
				case 'movieseries':
					if( !isset( $_POST['r'] ) )  $controller->load_view('movieseries');
					else if( $_POST['r'] == 'movieserie-add' )  $controller->load_view('movieserie-add');
					else if( $_POST['r'] == 'movieserie-edit' )  $controller->load_view('movieserie-edit');
					else if( $_POST['r'] == 'movieserie-delete' )  $controller->load_view('movieserie-delete');
					//para mostrar mas información, para gemerar informacion 
					else if( $_POST['r'] == 'movieserie-show' )  $controller->load_view('movieserie-show');
					break;

					//cuando sea usuarios 
				case 'usuarios':
				//se anidad if para saber a que parte de las operaciones CRUD entrar
					if( !isset( $_POST['r'] ) )  $controller->load_view('users');
					else if( $_POST['r'] == 'user-add' )  $controller->load_view('user-add');
					else if( $_POST['r'] == 'user-edit' )  $controller->load_view('user-edit');
					else if( $_POST['r'] == 'user-delete' )  $controller->load_view('user-delete');
					break;

					//los siguientes casos son los mismos solo darle sentido 
				case 'status':
					if( !isset( $_POST['r'] ) )  $controller->load_view('status');
					else if( $_POST['r'] == 'status-add' )  $controller->load_view('status-add');
					else if( $_POST['r'] == 'status-edit' )  $controller->load_view('status-edit');
					else if( $_POST['r'] == 'status-delete' )  $controller->load_view('status-delete');
					break;
					//si tuviera mas rutas lo unico que hay que hacer es incrementar el numero de casos que existen
					//salir mandar a llamar logout emdiante la vriable user_sesion que ejecuta logout
				case 'salir':
					$user_session = new SessionController();
					$user_session->logout();
					break;
				//geenrando la pagina de error por si el usuario hace algo mal o raro 
				default:
					$controller->load_view('error404');
					break;
			}
		} else {
			if( !isset($_POST['user']) && !isset($_POST['pass']) ) {
				//mostrar un formulario de autenticación
				$login_form = new ViewController();
				$login_form->load_view('login');
			}
			else {
				$user_session = new SessionController();
				$session = $user_session->login($_POST['user'], $_POST['pass']);

				if( empty($session) ) {
					//echo 'El usuario y el password son incorrectos';
					$login_form = new ViewController();
					$login_form->load_view('login');
					header('Location: ./?error=El usuario ' . $_POST['user'] . ' y el password proporcionado no coinciden');
				} else {
					//echo 'El usuario y el password son correctos';
					//var_dump($session);
					
					//Variables de sesión seran importantes 
					$_SESSION['ok'] = true;

					foreach ($session as $row) {
						$_SESSION['user'] = $row['user'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['name'] = $row['name'];
						$_SESSION['birthday'] = $row['birthday'];
						$_SESSION['pass'] = $row['pass'];
						$_SESSION['role'] = $row['role'];
					}

					header('Location: ./');
				}
			}
		}
	}

	public function __destruct() {
		unset($this->model);
	}
}