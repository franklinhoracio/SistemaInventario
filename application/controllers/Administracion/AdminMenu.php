<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class AdminMenu extends CI_Controller
	{
		public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		if ($this->session->userdata("rol") != "Administrador" and $this->session->userdata("rol") != "Gerente") {
			redirect(base_url());
		}
	}
		public function index()
		{
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/menuAdmin");
			$this->load->view("layouts/footer");
		}
	}
?>