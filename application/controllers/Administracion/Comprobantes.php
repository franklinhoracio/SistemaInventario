<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Comprobantes extends CI_Controller
	{
		public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("AdminSis/Comprobantes_model");
	}
		
		public function index($estado)
		{
			$data =  array('comprobantes' => $this->Comprobantes_model->listar($estado), 
						   'estado' =>$estado,);
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Comprobantes/listar",$data);
			$this->load->view("layouts/footer");
		}

		public function agregar()
		{
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Comprobantes/agregar");
			$this->load->view("layouts/footer");
		}

		public function store()
		{
			$comprobante = $this->input->post("comprobante");
			$this->form_validation->set_rules("comprobante", "comprobante","required|is_unique[tipodocumentos.tipoDocumento]");
			$this->form_validation->set_message('is_unique','El comprobante ya existe');

			if ($this->form_validation->run()) {
				$data = array(
					'tipoDocumento' => $comprobante,
					'estadoTipoDoc' => 1 
			);
				if ($this->Comprobantes_model->save($data)) {
				$this->session->set_flashdata("success", "Se agrego comprobante");
				redirect(base_url()."Administracion/Comprobantes/agregar");
			}
			else{
				$this->session->set_flashdata("Error", "No se agrego comprobante");
				redirect(base_url()."Administracion/Comprobantes/agregar");
			}

		} 
		else {
			$this->agregar();
		}
		}

		public function editar($id)
		{
			$data = array('comprobante' => $this->Comprobantes_model->getComprobante($id));
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Comprobantes/editar",$data);
			$this->load->view("layouts/footer");
		}

		public function actualizar()
		{
			$codigo = $this->input->post("codigo");
			$comprobante = $this->input->post("comprobante");
			$this->form_validation->set_rules("comprobante", "comprobante","required|is_unique[tipodocumentos.tipoDocumento]");
			$this->form_validation->set_message('is_unique','El comprobante ya existe');

			if ($this->form_validation->run()) {
				$data = array(
					'tipoDocumento' => $comprobante,
			);
				if ($this->Comprobantes_model->actualizar($codigo,$data)) {
				$this->session->set_flashdata("success", "Se actualizo comprobante");
				redirect(base_url()."Administracion/Comprobantes/index/1");
			}
			else{
				$this->session->set_flashdata("Error", "No se actualizo comprobante");
				redirect(base_url()."Administracion/Comprobantes/editar",$codigo);
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
				'estadoTipoDoc' => "0",
			);
			$this->Comprobantes_model->deshabilitar($id, $data);
			redirect(base_url()."Administracion/Comprobantes/index/1");
		}else{
			$data = array(
				'estadoTipoDoc' => "1",
			);

			$this->Comprobantes_model->deshabilitar($id, $data);
			redirect(base_url()."Administracion/Comprobantes/index/0");
		}
		
	}
	}
?>