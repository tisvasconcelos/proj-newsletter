<?php

class Mailing extends Controller {

	function Mailing()
	{
		parent::Controller();
		$this->load->model('Mailing_model', 'Mailing');
		$this->load->model('Subscriber_model', 'Subscriber');
	}
	
	function index()
	{		
		$mailings = $this->Mailing->getAll();
		$data['mailings'] = $mailings->result();
		$this->load->view('mailing/list',$data);
	}
	
	function edit()
	{
		$this->load->view('mailing/edit');
	}
	
	function insert()
	{
		$mailing = $this->Mailing->insert($_POST);
		if($mailing){
			$mailings = $this->Mailing->getAll();
			$data['mailings'] = $mailings->result();
			$this->load->view('mailing/list',$data);
		}else{
			$this->load->view('error');
		}
	}
	
	function listing(){
		$mld_id = $this->uri->segment($this->uri->total_segments());
		$subscribers = $this->Mailing->getSubscribers($mld_id);
		$data['subscribers'] = $subscribers->result();
		$this->load->view('mailing/subscribers',$data);
	}
	
	function export(){
		$mld_id = $this->uri->segment($this->uri->total_segments());
		$mailing = $this->Mailing->get($mld_id);
		$data['mailing'] = $mailing;
		$subscribers = $this->Mailing->getSubscribers($mld_id);
		$data['subscribers'] = $subscribers->result();
		$this->load->view('mailing/export',$data);
	}
	
	function delete(){
		set_time_limit(1000);
		
		$mld_id = $this->uri->segment($this->uri->total_segments());
		$mailing = $this->Mailing->get($mld_id);
		$this->Mailing->deleteFile($mailing->mld_excel);
		$this->Mailing->delete($mailing->so_id,$mld_id);
		
		$subscribers = $this->Mailing->getSubscribers($mld_id);
		foreach($subscribers->result() as $s){
			$this->Subscriber->delete($s->so_id,$s->scd_id);
		}
		
		$mailings = $this->Mailing->getAll();
		$data['mailings'] = $mailings->result();
		$this->load->view('mailing/list',$data);
	}
}

/* End of file mailing.php */
/* Location: ./system/application/controllers/mailing.php */