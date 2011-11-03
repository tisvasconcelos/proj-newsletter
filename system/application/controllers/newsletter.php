<?php

class Newsletter extends Controller {

	function Newsletter()
	{
		parent::Controller();
		$this->load->model('Newsletter_model', 'Newsletter');
		$this->load->model('Template_model', 'Template');
		$this->load->model('Mailing_model', 'Mailing');
		$this->load->model('Subscriber_model','Subscriber');
	}
	
	function index()
	{		
		$newsletters = $this->Newsletter->getAll();
		$data['newsletters'] = $newsletters->result();
		$this->load->view('newsletter/list',$data);
	}
	
	function edit()
	{
		$mailings = $this->Mailing->getAll();
		$data['mailings'] = $mailings->result();
		$templates = $this->Template->getAll();
		$data['templates'] = $templates->result();
		if($this->uri->total_segments()==3){
			$so_id = $this->uri->segment($this->uri->total_segments());
			$newsletter = $this->Newsletter->get($so_id);
			$data['newsletter'] = $newsletter;
			$this->load->view('newsletter/edit',$data);
		}else{
			$data['newsletter'] = false;
			$this->load->view('newsletter/edit',$data);
		}
	}
	
	function insert()
	{
		$newsletters = $this->Newsletter->getAll();
		$totalNewsletters = $newsletters->num_rows()+1;
		if($totalNewsletters == 0){
			$total = "0001";
		}elseif($totalNewsletters <= 9){
			$total = "000".$totalNewsletters;
		}elseif($totalNewsletters <= 99){
			$total = "00".$totalNewsletters;
		}elseif($totalNewsletters <= 999){
			$total = "0".$totalNewsletters;
		}else{
			$total = $totalNewsletters;
		}
		$code = $total . $_POST['code'] . date('y');
		$_POST['code'] = $code;
		
		$newsletter = $this->Newsletter->insert($_POST);
		if($newsletter){
			$newsletters = $this->Newsletter->getAll();
			$data['newsletters'] = $newsletters->result();
			$this->load->view('newsletter/list',$data);
		}else{
			$this->load->view('error');
		}
	}
	
	function update(){
		if(!empty($_POST['code'])){
			$newsletters = $this->Newsletter->getAll();
			$totalNewsletters = $newsletters->num_rows()+1;
			if($totalNewsletters == 0){
				$total = "0001";
			}elseif($totalNewsletters <= 9){
				$total = "000".$totalNewsletters;
			}elseif($totalNewsletters <= 99){
				$total = "00".$totalNewsletters;
			}elseif($totalNewsletters <= 999){
				$total = "0".$totalNewsletters;
			}else{
				$total = $totalNewsletters;
			}
			$code = $total . $_POST['code'] . date('y');
			$_POST['code'] = $code;
		}
		
		$newsletter = $this->Newsletter->update($_POST);
		if($newsletter){
			$newsletters = $this->Newsletter->getAll();
			$data['newsletters'] = $newsletters->result();
			$this->load->view('newsletter/list',$data);
		}else{
			$this->load->view('error');
		}
	}
	
	function delete(){
		$so_id = $this->uri->segment($this->uri->total_segments());
		$this->Newsletter->delete($so_id);
		$newsletters = $this->Newsletter->getAll();
		$data['newsletters'] = $newsletters->result();
		$this->load->view('newsletter/list',$data);
	}
	
	function imprint(){
		$so_id = $this->uri->segment($this->uri->total_segments());
		$newsletter = $this->Newsletter->get($so_id);
		$data['template'] = $this->Template->get($newsletter->tpd_id);
		$data['newsletter'] = $newsletter;
		$this->load->view('newsletter/print',$data);
	}
	
	function send(){
		$so_id = $this->uri->segment(3);
		$start = $this->uri->segment(4);
		$newsletter = $this->Newsletter->get($so_id);
		$template = $this->Template->get($newsletter->tpd_id);
		$mailing = $this->Mailing->getBySoId($newsletter->mld_id);
		$subscribers = $this->Mailing->getSubscribers($mailing->mld_id);
		$data['total'] = $this->Newsletter->send($start,$newsletter,$template,$mailing,$subscribers);
		$data['start'] = $start;
		$this->load->view('newsletter/send',$data);
	}
	
	function view(){
		$so_id = $this->uri->segment($this->uri->total_segments()-1);
		$user_so_id = $this->uri->segment($this->uri->total_segments());
		$newsletter = $this->Newsletter->get($so_id);
		$subscriber = $this->Subscriber->get($user_so_id);
		$data['template'] = $this->Template->get($newsletter->tpd_id);
		$data['newsletter'] = $newsletter;
		$data['subscriber'] = $subscriber;
		$this->load->view('newsletter/view',$data);
	}
}

/* End of file newsletter.php */
/* Location: ./system/application/controllers/newsletter.php */