<?php

class Dashboard extends Controller {

	function Dashboard()
	{
		parent::Controller();	
	}
	
	function index()
	{		
		$this->load->view('dashboard');
	}
}

/* End of file dashboard.php */
/* Location: ./system/application/controllers/dashboard.php */