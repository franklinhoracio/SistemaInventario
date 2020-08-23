<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Presentaciones extends CI_Controller
	{
		public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("AdminSis/Presentaciones_Model");
	}
		
		public function index($estado)
		{
			$data =  array('presentaciones' => $this->Presentaciones_Model->listar($estado), 
						   'estado' =>$estado,);
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Presentaciones/listar",$data);
			$this->load->view("layouts/footer");
		}

		public function agregar()
		{
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Presentaciones/agregar");
			$this->load->view("layouts/footer");
		}

		public function store()
		{
			$presentacion = $this->input->post("presentacion");
			$this->form_validation->set_rules("presentacion", "presentacion","required|is_unique[presentaciones.presentacion]");
			$this->form_validation->set_message('is_unique','La presentacion ya existe');

			if ($this->form_validation->run()) {
				$data = array(
					'presentacion' => $presentacion,
					'estadoPresentacion' => 1 
			);
				if ($this->Presentaciones_Model->save($data)) {
				$this->session->set_flashdata("success", "Se agrego la presentación");
				redirect(base_url()."Administracion/Presentaciones/agregar");
			}
			else{
				$this->session->set_flashdata("Error", "No se agrego la presentación");
				redirect(base_url()."Administracion/Presentaciones/agregar");
			}

		} 
		else {
			$this->agregar();
		}
		}

		public function editar($id)
		{
			$data = array('presentacion' => $this->Presentaciones_Model->getPresentacion($id));
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Presentaciones/editar",$data);
			$this->load->view("layouts/footer");
		}

		public function actualizar()
		{
			$codigo = $this->input->post("codigo");
			$presentacion = $this->input->post("presentacion");
			$this->form_validation->set_rules("presentacion", "presentación","required|is_unique[presentaciones.presentacion]");
			$this->form_validation->set_message('is_unique','La presentación ya existe');

			if ($this->form_validation->run()) {
				$data = array(
					'presentacion' => $presentacion,
			);
				if ($this->Presentaciones_Model->actualizar($codigo,$data)) {
				$this->session->set_flashdata("success", "Se actualizo la presentación");
				redirect(base_url()."Administracion/Presentaciones/index/1");
			}
			else{
				$this->session->set_flashdata("Error", "No se actualizo la presentación");
				redirect(base_url()."Administracion/Presentaciones/editar",$codigo);
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
				'estadoPresentacion' => "0",
			);
			$this->Presentaciones_Model->deshabilitar($id, $data);
			redirect(base_url()."Administracion/Presentaciones/index/1");
		}else{
			$data = array(
				'estadoPresentacion' => "1",
			);

			$this->Presentaciones_Model->deshabilitar($id, $data);
			redirect(base_url()."Administracion/Presentaciones/index/0");
		}
		
	}
	}
?>

