<?php
class SessionController {
	private $session;

	public function __construct() {
		$this->session = new UsersModel();
	}

	public function login($user, $pass) {
		return $this->session->validate_user($user, $pass);
	}

	public function logout() {
		session_start();
		session_destroy();
		//rederigimos el flujo d enuestra acplicación al home
		//pero la sesion esta destruida nos d LA VISTA DEL FORMULARIO DE LOGIN
		header('Location: ./');
	}

	public function __destruct() {
		unset($this->model);
	}
}