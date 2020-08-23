<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Categorias extends CI_Controller
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
			$data =  array('categorias' => $this->Categorias_Model->listar($estado), 
						   'estado' =>$estado,);
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Categorias/listar",$data);
			$this->load->view("layouts/footer");
		}

		public function agregar()
		{
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Categorias/agregar");
			$this->load->view("layouts/footer");
		}

		public function store()
		{
			$categoria = $this->input->post("categoria");
			$this->form_validation->set_rules("categoria", "categoria","required|is_unique[categoriasproductos.categoriaProd]");
			$this->form_validation->set_message('is_unique','La categoría ya existe');

			if ($this->form_validation->run()) {
				$data = array(
					'categoriaProd' => $categoria,
					'estadoCategoria' => 1 
			);
				if ($this->Categorias_Model->save($data)) {
				$this->session->set_flashdata("success", "Se agrego la categoría");
				redirect(base_url()."Administracion/Categorias/agregar");
			}
			else{
				$this->session->set_flashdata("Error", "No se agrego la categoría");
				redirect(base_url()."Administracion/Categorias/agregar");
			}

		} 
		else {
			$this->agregar();
		}
		}

		public function editar($id)
		{
			$data = array('categoria' => $this->Categorias_Model->getCategoria($id));
			$this->load->view("layouts/header");
			$this->load->view("AdminSis/Categorias/editar",$data);
			$this->load->view("layouts/footer");
		}

		public function actualizar()
		{
			$codigo = $this->input->post("codigo");
			$categoria = $this->input->post("categoria");
			$this->form_validation->set_rules("categoria", "categoria","required|is_unique[categoriasproductos.categoriaProd]");
			$this->form_validation->set_message('is_unique','La categoría ya existe');

			if ($this->form_validation->run()) {
				$data = array(
					'categoriaProd' => $categoria,
			);
				if ($this->Categorias_Model->actualizar($codigo,$data)) {
				$this->session->set_flashdata("success", "Se actualizo la categoría");
				redirect(base_url()."Administracion/Categorias/index/1");
			}
			else{
				$this->session->set_flashdata("Error", "No se actualizo la categoría");
				redirect(base_url()."Administracion/Categorias/editar",$codigo);
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
				'estadoCategoria' => "0",
			);
			$this->Categorias_Model->deshabilitar($id, $data);
			redirect(base_url()."Administracion/Categorias/index/1");
		}else{
			$data = array(
				'estadoCategoria' => "1",
			);

			$this->Categorias_Model->deshabilitar($id, $data);
			redirect(base_url()."Administracion/Categorias/index/0");
		}
		
	}
	}
?>