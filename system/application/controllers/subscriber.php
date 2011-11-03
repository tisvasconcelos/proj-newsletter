<?php

class Subscriber extends Controller {

	function Subscriber()
	{
		parent::Controller();
		$this->load->model('Subscriber_model','Subscriber');
	}
	
	function index()
	{		

	}
	
	function edit($encrypted = false){
		if($encrypted && ($subscriber = $this->Subscriber->getByEncrypted($encrypted))){
			$data['subscriber'] = $subscriber;
			$this->load->view('subscriber/edit',$data);
		}else{
			$this->load->view('subscriber/edit');
		}
	}
	
	function update(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');

		if ($this->form_validation->run() == FALSE){
			$data['message'] = "Por favor digite todos os campos corretamente!";
		}else{
			if($subscriber = $this->Subscriber->getByEncrypted($_POST['encrypted'])){
				$this->Subscriber->updateByEncrypted($_POST,$subscriber);
				$data['subscriber'] = $subscriber;
			}
			$data['message'] = $subscriber->scd_name . " obrigado por atualizar seus dados!";
		}
		$this->load->view('subscriber/edit',$data);
	}
	
	function insert(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
		
		if ($this->form_validation->run() == FALSE){
			$data['message'] = "Por favor digite todos os campos corretamente!";
		}else{
			$subscriber = $this->Subscriber->insert($_POST);
			$data['message'] = $subscriber->scd_name . " obrigado por se cadastrar!";
		}
		$this->load->view('subscriber/edit',$data);
	}
	
	function remove($encrypted = false){
		if($encrypted){
			$this->Subscriber->changeStatus($encrypted);
			$this->load->view('subscriber/remove');
		}
	}
}

/* End of file subscriber.php */
/* Location: ./system/application/controllers/subscriber.php */