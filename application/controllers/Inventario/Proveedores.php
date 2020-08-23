<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Inventario/Proveedores_Model");
	}

	public function index($estado)
	{
		$data =  array('proveedores' => $this->Proveedores_Model->listar($estado), 
			'estado' =>$estado,);
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Proveedores/listar",$data);
		$this->load->view("layouts/footer");
	}

	public function agregar()
	{
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Proveedores/agregar");
		$this->load->view("layouts/footer");
	}

	public function store()
	{
		$proveedor = $this->input->post("proveedor");
		$registroFiscal = $this->input->post("registroFiscal");
		$telefono = $this->input->post("telefono");
		$correo = $this->input->post("correo");
		$nombreContacto = $this->input->post("nombreContacto");
		$telefonoContacto = $this->input->post("telefonoContacto");
		$this->form_validation->set_rules("proveedor", "proveedor","required");
		$this->form_validation->set_rules("telefono", "telefono","required");
		//$this->form_validation->set_rules("correo", "correo","required");

		if ($this->form_validation->run()) {
			$data = array(
				'proveedor' => $proveedor,
				'registroFiscal' => $registroFiscal,
				'telefono' => $telefono,
				'correo' => $correo,
				'nombreContacto' => $nombreContacto,
				'telefonoContacto' => $telefonoContacto,
				'estadoProveedor' => 1 
			);
			if ($this->Proveedores_Model->save($data)) {
				$this->session->set_flashdata("success", "Se agrego el proveedor");
				redirect(base_url()."Inventario/Proveedores/agregar");
			}
			else{
				$this->session->set_flashdata("Error", "No se agrego el proveedor");
				redirect(base_url()."Inventario/Proveedores/agregar");
			}

		} 
		else {
			$this->agregar();
		}
	}

		public function add2(){
		$data = $this->input->post();
		$data2 = array(
			'proveedor' => $data['proveedores'], 
			'telefono' => $data['telefono'],
			'estadoProveedor' => 1 
		);
		$this->Proveedores_Model->save($data2);
	}

	public function editar($id)
	{
		$data = array('proveedor' => $this->Proveedores_Model->getProveedor($id),);
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Proveedores/editar",$data);
		$this->load->view("layouts/footer");
	}

	public function actualizar()
	{
		$codigo = $this->input->post("codigo");
		$proveedor = $this->input->post("proveedor");
		$registroFiscal = $this->input->post("registroFiscal");
		$telefono = $this->input->post("telefono");
		$correo = $this->input->post("correo");
		$nombreContacto = $this->input->post("nombreContacto");
		$telefonoContacto = $this->input->post("telefonoContacto");
		$this->form_validation->set_rules("proveedor", "proveedor","required");
		$this->form_validation->set_rules("telefono", "telefono","required");
		$this->form_validation->set_rules("correo", "correo","required");

		if ($this->form_validation->run()) {
			$data = array(

				'proveedor' => $proveedor,
				'registroFiscal' => $registroFiscal,
				'telefono' => $telefono,
				'correo' => $correo,
				'nombreContacto' => $nombreContacto,
				'telefonoContacto' => $telefonoContacto,
			);
			if ($this->Proveedores_Model->actualizar($codigo,$data)) {
				$this->session->set_flashdata("success", "Se actualizo el proveedor");
				redirect(base_url()."Inventario/Proveedores/index/1");
			}
			else{
				$this->session->set_flashdata("Error", "No se actualizo el proveedor");
				redirect(base_url()."Inventario/Proveedores/editar",$codigo);
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
				'estadoProveedor' => "0",
			);
			$this->Proveedores_Model->deshabilitar($id, $data);
			redirect(base_url()."Inventario/Proveedores/index/1");
		}else{
			$data = array(
				'estadoProveedor' => "1",
			);

			$this->Proveedores_Model->deshabilitar($id, $data);
			redirect(base_url()."Inventario/Proveedores/index/0");
		}
		
	}
}
?>