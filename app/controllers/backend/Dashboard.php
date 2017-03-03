<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    protected $data = array();
	function __construct(){

		parent::__construct();
		$this->data['uri'] = $this->uri->segment_array();
	}

	public function index()
	{

		$this->data['titulo_pagina']="Dashboard";
		$this->data['subtitulo_pagina']="Dashboard";
		$this->data['content'] = 'backend/dashboard/dashboard';
		$this->load->view('backend/layout/layout', $this->data);
	}

}

/* End of file dashboard.php */
/* Location: .//C/xampp/htdocs/hardsoft/app/controllers/backend/dashboard.php */