<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Roles extends CI_Controller
	{
		public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("AdminSis/Categorias_Model");
	}
		
		public function index($estado)
		{
			$data =  array('roles' => $this->Categorias_Model->listar($estado), 
						   'estado' =>$estado,);
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Roles/listar",$data);
			$this->load->view("layouts/footer");
		}

		public function agregar()
		{
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Roles/agregar");
			$this->load->view("layouts/footer");
		}

		public function store()
		{
			$rol = $this->input->post("rol");
			$this->form_validation->set_rules("rol", "rol","required|is_unique[roles.rol]");
			$this->form_validation->set_message('is_unique','el rol ya existe');

			if ($this->form_validation->run()) {
				$data = array(
					'rol' => $rol,
					'estadoRol' => 1 
			);
				if ($this->Categorias_Model->save($data)) {
				$this->session->set_flashdata("success", "Se agrego el rol");
				redirect(base_url()."Administracion/Roles/agregar");
			}
			else{
				$this->session->set_flashdata("Error", "No se agrego el rol");
				redirect(base_url()."Administracion/Roles/agregar");
			}

		} 
		else {
			$this->agregar();
		}
		}

		public function editar($id)
		{
			$data = array('rol' => $this->Categorias_Model->getRol($id));
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Roles/editar",$data);
			$this->load->view("layouts/footer");
		}

		public function actualizar()
		{
			$codigo = $this->input->post("codigo");
			$rol = $this->input->post("rol");
			$this->form_validation->set_rules("rol", "rol","required|is_unique[roles.rol]");
			$this->form_validation->set_message('is_unique','el rol ya existe');

			if ($this->form_validation->run()) {
				$data = array(
					'rol' => $rol,
			);
				if ($this->Categorias_Model->actualizar($codigo,$data)) {
				$this->session->set_flashdata("success", "Se actualizo el rol");
				redirect(base_url()."Administracion/Roles/index/1");
			}
			else{
				$this->session->set_flashdata("Error", "No se actualizo el rol");
				redirect(base_url()."Administracion/Roles/editar",$codigo);
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
			$this->Categorias_Model->deshabilitar($id, $data);
			redirect(base_url()."Administracion/Roles/index/1");
		}else{
			$data = array(
				'estadoRol' => "1",
			);

			$this->Categorias_Model->deshabilitar($id, $data);
			redirect(base_url()."Administracion/Roles/index/0");
		}
		
	}
	}
?>