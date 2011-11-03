<?php

class Template extends Controller {

	function Template()
	{
		parent::Controller();
		$this->load->model('Template_model', 'Template');
	}
	
	function index()
	{		
		$templates = $this->Template->getAll();
		$data['templates'] = $templates->result();
		$this->load->view('template/list',$data);
	}
	
	function edit()
	{
		if($this->uri->total_segments()==3){
			$so_id = $this->uri->segment($this->uri->total_segments());
			$template = $this->Template->get($so_id);
			$data['template'] = $template;
			$this->load->view('template/edit',$data);
		}else{
			$data['template'] = false;
			$this->load->view('template/edit',$data);
		}
	}
	
	function insert()
	{
		$template = $this->Template->insert($_POST);
		if($template){
			$templates = $this->Template->getAll();
			$data['templates'] = $templates->result();
			$this->load->view('template/list',$data);
		}else{
			$this->load->view('error');
		}
	}
	
	function update(){
		$template = $this->Template->update($_POST);
		if($template){
			$templates = $this->Template->getAll();
			$data['templates'] = $templates->result();
			$this->load->view('template/list',$data);
		}else{
			$this->load->view('error');
		}
	}
	
	function delete(){
		$so_id = $this->uri->segment($this->uri->total_segments());
		$this->Template->delete($so_id);
		$templates = $this->Template->getAll();
		$data['templates'] = $templates->result();
		$this->load->view('template/list',$data);
	}
}

/* End of file template.php */
/* Location: ./system/application/controllers/template.php */