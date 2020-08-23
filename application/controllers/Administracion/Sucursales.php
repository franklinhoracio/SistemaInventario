<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Sucursales extends CI_Controller
	{
		public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("AdminSis/Sucursales_Model");
	}
		
		public function index($estado)
		{
			$data =  array('sucursales' => $this->Sucursales_Model->listar($estado), 
						   'estado' =>$estado,);
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Sucursales/listar",$data);
			$this->load->view("layouts/footer");
		}

		public function agregar()
		{
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Sucursales/agregar");
			$this->load->view("layouts/footer");
		}

		public function store()
		{
			$sucursal = $this->input->post("sucursal");
			$ubicacion = $this->input->post("ubicacion");
			$this->form_validation->set_rules("sucursal", "sucursal","required");
			$this->form_validation->set_rules("ubicacion", "ubicacion","required");

			if ($this->form_validation->run()) {
				$data = array(
					'sucursal' => $sucursal,
					'ubicacion' => $ubicacion,
					'estadoSucursal' => 1 
			);
				if ($this->Sucursales_Model->save($data)) {
				$this->session->set_flashdata("success", "Se agrego la sucursal");
				redirect(base_url()."Administracion/Sucursales/agregar");
			}
			else{
				$this->session->set_flashdata("Error", "No se agrego la sucursal");
				redirect(base_url()."Administracion/Sucursales/agregar");
			}

		} 
		else {
			$this->agregar();
		}
		}

		public function editar($id)
		{
			$data = array('sucursal' => $this->Sucursales_Model->getSucursal($id));
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Sucursales/editar",$data);
			$this->load->view("layouts/footer");
		}

		public function actualizar()
		{
			$codigo = $this->input->post("codigo");
			$sucursal = $this->input->post("sucursal");
			$ubicacion = $this->input->post("ubicacion");
			$this->form_validation->set_rules("sucursal", "sucursal","required");
			$this->form_validation->set_rules("ubicacion", "ubicacion","required");;

			if ($this->form_validation->run()) {
				$data = array(
					'sucursal' => $sucursal,
					'ubicacion' => $ubicacion,
			);
				if ($this->Sucursales_Model->actualizar($codigo,$data)) {
				$this->session->set_flashdata("success", "Se actualizo la sucursal");
				redirect(base_url()."Administracion/Sucursales/index/1");
			}
			else{
				$this->session->set_flashdata("Error", "No se actualizo la sucursal");
				redirect(base_url()."Administracion/Sucursales/editar",$codigo);
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
				'estadoSucursal' => "0",
			);
			$this->Sucursales_Model->deshabilitar($id, $data);
			redirect(base_url()."Administracion/Sucursales/index/1");
		}else{
			$data = array(
				'estadoSucursal' => "1",
			);

			$this->Sucursales_Model->deshabilitar($id, $data);
			redirect(base_url()."Administracion/Sucursales/index/0");
		}
		
	}
	}
?>