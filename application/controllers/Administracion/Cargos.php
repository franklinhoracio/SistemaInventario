<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Cargos extends CI_Controller
	{
		public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("AdminSis/Areas_Model");
	}
	
		
		public function index($estado)
		{
			$data =  array('cargos' => $this->Areas_Model->listar($estado), 
						   'estado' =>$estado,);
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Cargos/listar",$data);
			$this->load->view("layouts/footer");
		}

		public function agregar()
		{
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Cargos/agregar");
			$this->load->view("layouts/footer");
		}

		public function store()
		{
			$cargo = $this->input->post("cargo");
			$this->form_validation->set_rules("cargo", "cargo","required|is_unique[cargos.cargo]");
			$this->form_validation->set_message('is_unique','el cargo ya existe');

			if ($this->form_validation->run()) {
				$data = array(
					'cargo' => $cargo,
					'estadoRol' => 1 
			);
				if ($this->Areas_Model->save($data)) {
				$this->session->set_flashdata("success", "Se agrego el cargo");
				redirect(base_url()."Administracion/Cargos/agregar");
			}
			else{
				$this->session->set_flashdata("Error", "No se agrego el cargo");
				redirect(base_url()."Administracion/Cargos/agregar");
			}

		} 
		else {
			$this->agregar();
		}
		}

		public function editar($id)
		{
			$data = array('cargo' => $this->Areas_Model->getCargo($id));
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Cargos/editar",$data);
			$this->load->view("layouts/footer");
		}

		public function actualizar()
		{
			$codigo = $this->input->post("codigo");
			$cargo = $this->input->post("cargo");
			$this->form_validation->set_rules("cargo", "cargo","required|is_unique[cargos.cargo]");
			$this->form_validation->set_message('is_unique','el cargo ya existe');

			if ($this->form_validation->run()) {
				$data = array(
					'cargo' => $cargo,
			);
				if ($this->Areas_Model->actualizar($codigo,$data)) {
				$this->session->set_flashdata("success", "Se actualizo el cargo");
				redirect(base_url()."Administracion/Cargos/index/1");
			}
			else{
				$this->session->set_flashdata("Error", "No se actualizo el cargo");
				redirect(base_url()."Administracion/Cargos/editar",$codigo);
			}

		} 
		else {
			$this->editar($codigo);
		}
		}

		public function deshabilitar(){
		$id = $this->input->post('id');
		$estado = $this->input->post('estado');
		if ($estado == 1) {
			$data = array(
				'estadoRol' => "0",
			);
			$this->Areas_Model->deshabilitar($id, $data);
			redirect(base_url()."Administracion/Cargos/index/1");
		}else{
			$data = array(
				'estadoRol' => "1",
			);

			$this->Areas_Model->deshabilitar($id, $data);
			redirect(base_url()."Administracion/Cargos/index/0");
		}
		
	}
	}
?>