<?php

class Login extends Controller {

	function login()
	{
		parent::Controller();
		$this->load->model('Login_model', 'Login');
	}
	
	function index()
	{
		session_destroy();
		$this->load->view('login/login');
	}
	
	function connect()
	{
		if($_POST['username']!="" && $_POST['password']!=""){
			$login = $this->Login->connect($_POST);
			if($login){
				redirect('/', 'refresh');
			}else{
				$data['message'] = "Login e senha incorreto.";
				$this->load->view('login/login',$data);
			}
		}else{
			$data['message'] = "Digite seu login e senha.";
			$this->load->view('login/login',$data);
		}
	}
}

/* End of file login.php */
/* Location: ./system/application/controllers/login.php */