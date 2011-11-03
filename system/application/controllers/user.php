<?php

class User extends Controller {

	function User()
	{
		parent::Controller();
		$this->load->model('User_model', 'User');
	}
	
	function index()
	{
		$users = $this->User->getAll();
		$data['users'] = $users->result();
		$this->load->view('user/list',$data);
	}
	
	function edit()
	{
		if($this->uri->total_segments()==3){
			$so_id = $this->uri->segment($this->uri->total_segments());
			$user = $this->User->get($so_id);
			$data['user'] = $user;
			$this->load->view('user/edit',$data);
		}else{
			$data['user'] = false;
			$this->load->view('user/edit',$data);
		}
	}
	
	function insert()
	{
		$user = $this->User->insert($_POST);
		if($user){
			$users = $this->User->getAll();
			$data['users'] = $users->result();
			$this->load->view('user/list',$data);
		}else{
			$this->load->view('error');
		}
	}
	
	function update(){
		$user = $this->User->update($_POST);
		if($user){
			$users = $this->User->getAll();
			$data['users'] = $users->result();
			$this->load->view('user/list',$data);
		}else{
			$this->load->view('error');
		}
	}
	
	function delete(){
		$so_id = $this->uri->segment($this->uri->total_segments());
		$this->User->delete($so_id);
		$users = $this->User->getAll();
		$data['users'] = $users->result();
		$this->load->view('user/list',$data);
	}
	
	function myprofile()
	{
		$data['user'] = $this->User->get($_SESSION['user_so_id']);
		$this->load->view('user/myprofile',$data);
	}

	function myprofileUpdate(){
		$this->User->myprofileUpdate($_POST);
		$data['user'] = $this->User->get($_SESSION['user_so_id']);
		$this->load->view('user/myprofile',$data);
	}
}

/* End of file user.php */
/* Location: ./system/application/controllers/user.php */