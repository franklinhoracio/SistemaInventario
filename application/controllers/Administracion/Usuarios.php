<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("AdminSis/Sucursales_Model");
		$this->load->model("AdminSis/Cargos_Model");
		$this->load->model("AdminSis/Roles_Model");
		$this->load->model("AdminSis/Usuarios_Model");
	}

	public function index($estado)
	{
		$data =  array('usuarios' => $this->Usuarios_Model->listar($estado), 
			'estado' =>$estado,);
		$this->load->view("layouts/header");
		$this->load->view("AdminSis/Usuarios/listar",$data);
		$this->load->view("layouts/footer");
	}

	public function agregar()
	{
		$data = array('sucursales' => $this->Sucursales_Model->listar(1),
			'cargos' => $this->Cargos_Model->listar(1),
			'roles' => $this->Roles_Model->listar(1),);
		$this->load->view("layouts/header");
		$this->load->view("AdminSis/Usuarios/agregar", $data);
		$this->load->view("layouts/footer");
	}

	public function store()
	{

		//tabla Empleados
		$nombre = $this->input->post("nombre");
		$apellido = $this->input->post("apellido");
		$dui = $this->input->post("dui");
		$nit = $this->input->post("nit");
		$telefono = $this->input->post("telefono");
		$correo = $this->input->post("correo");
		$direccion = $this->input->post("direccion");
		$cargo = $this->input->post("cargo");
		$sucursal = $this->input->post("sucursal");
		$this->form_validation->set_rules("nombre", "nombre","required");
		$this->form_validation->set_rules("apellido", "apellido","required");
		//$this->form_validation->set_rules("dui", "DUI","required");
		//$this->form_validation->set_rules("nit", "NIT","required");
		//$this->form_validation->set_rules("telefono", "telefono","required");
		//$this->form_validation->set_rules("correo", "correo","required");
		//$this->form_validation->set_rules("direccion", "direccion","required");
		$this->form_validation->set_rules("cargo", "cargo","required");
		$this->form_validation->set_rules("sucursal", "sucursal","required");

		//tabla usuarios
		$usuario = $this->input->post("usuario");
		$clave = $this->input->post("clave");
		$clave2 = password_hash($clave, PASSWORD_DEFAULT);
		$rol = $this->input->post("rol");
		$this->form_validation->set_rules("usuario", "usuario","required|is_unique[usuarios.usuario]");
		$this->form_validation->set_rules("clave", "clave","required");
		$this->form_validation->set_rules("rol", "rol","required");
		$this->form_validation->set_rules('confirmar_clave', 'Confirmar Clave', 'required|matches[clave]');
		$this->form_validation->set_message('is_unique','el usuario ya existe');
		if ($this->form_validation->run()) {
			$dataEmpleado = array(
				'nombresEmpleado' => $nombre,
				'apellidosEmpleado' => $apellido,
				'dui' => $dui,
				'nit' => $nit,
				'telefono' => $telefono,
				'correo' => $correo,
				'direccion' => $direccion,
				'idCargo' => $cargo,
				'idSucursal' => $sucursal,
				'estadoEmpleado' => 1 
			);

			$dataUsuario = array(
				'usuario' => $usuario,
				'clave' => $clave2,
				'idRol' => $rol,
				'estadoUsuario' => 1,
			);
			if ($this->Usuarios_Model->save($dataEmpleado, $dataUsuario)) {
				$this->session->set_flashdata("success", "Se agrego el usuario,
					Su contraseña es: ".$clave);
				redirect(base_url()."Administracion/Usuarios/agregar");
			}
			else{
				$this->session->set_flashdata("Error", "No se agrego el usuario");
				redirect(base_url()."Administracion/Usuarios/agregar");
			}

		} 
		else {
			$this->agregar();
		}
	}

	public function editar($id)
	{
		$data = array('usuario' => $this->Usuarios_Model->getUsuario($id),
			'empleado' => $this->Usuarios_Model->getEmpleado($id),
			'sucursales' => $this->Sucursales_Model->listar(1),
			'cargos' => $this->Cargos_Model->listar(1),
			'roles' => $this->Roles_Model->listar(1));
		$this->load->view("layouts/header");
		$this->load->view("AdminSis/Usuarios/editar",$data);
		$this->load->view("layouts/footer");
	}

	public function actualizar()
	{	$codigo = $this->input->post("codigo");
	$nombre = $this->input->post("nombre");
	$apellido = $this->input->post("apellido");
	$dui = $this->input->post("dui");
	$nit = $this->input->post("nit");
	$telefono = $this->input->post("telefono");
	$correo = $this->input->post("correo");
	$direccion = $this->input->post("direccion");
	$cargo = $this->input->post("cargo");
	$sucursal = $this->input->post("sucursal");
	$this->form_validation->set_rules("nombre", "nombre","required");
	$this->form_validation->set_rules("apellido", "apellido","required");
	$this->form_validation->set_rules("dui", "DUI","required");
	$this->form_validation->set_rules("nit", "NIT","required");
	$this->form_validation->set_rules("telefono", "telefono","required");
	$this->form_validation->set_rules("correo", "correo","required");
	$this->form_validation->set_rules("direccion", "direccion","required");
	$this->form_validation->set_rules("cargo", "cargo","required");
	$this->form_validation->set_rules("sucursal", "sucursal","required");

		//tabla usuarios
	$usuario = $this->input->post("usuario");
	$rol = $this->input->post("rol");

	if ($this->form_validation->run()) {
		$dataEmpleado = array(
			'nombresEmpleado' => $nombre,
			'apellidosEmpleado' => $apellido,
			'dui' => $dui,
			'nit' => $nit,
			'telefono' => $telefono,
			'correo' => $correo,
			'direccion' => $direccion,
			'idCargo' => $cargo,
			'idSucursal' => $sucursal,
		);

		$dataUsuario = array(
			'usuario' => $usuario,
			'idRol' => $rol,
		);
		if ($this->Usuarios_Model->actualizar($codigo,$dataUsuario,$dataEmpleado)) {
			$this->session->set_flashdata("success", "Se actualizaron los datos del usuario");
			redirect(base_url()."Administracion/Usuarios/index/1");
		}
		else{
			$this->session->set_flashdata("Error", "No se actualizaron los datos del usuario");
			redirect(base_url()."Administracion/Usuarios/editar",$codigo);
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
			'estadoUsuario' => "0",
		);
		$this->Usuarios_Model->deshabilitar($id, $data);
		redirect(base_url()."Administracion/Usuarios/index/1");
	}else{
		$data = array(
			'estadoUsuario' => "1",
		);

		$this->Usuarios_Model->deshabilitar($id, $data);
		redirect(base_url()."Administracion/Usuarios/index/0");
	}

}

public function editarClave($id)
{
	$data = array('usuario' => $this->Usuarios_Model->getUsuario($id));
	$this->load->view("layouts/header");
	$this->load->view("AdminSis/Usuarios/editarClave",$data);
	$this->load->view("layouts/footer");
}

public function cambiarClave(){
	$codigo = $this->input->post('codigo');
	$clave = $this->input->post("clave");
	$clave2 = password_hash($clave, PASSWORD_DEFAULT);
	$this->form_validation->set_rules("clave", "clave","required");
	$this->form_validation->set_rules('confirmar_clave', 'Confirmar Clave', 'required|matches[clave]');
	if ($this->form_validation->run()) {
		$data = array(
			'clave' => $clave2,
		);
		if ($this->Usuarios_Model->actualizarClave($codigo,$data)) {
			$data  = array(
				'login' => FALSE
			);
			$this->session->set_flashdata("error", "Se cambio la contraseña");
			$this->session->set_userdata($data);
			redirect(base_url());
		}
		else{
			$this->session->set_flashdata("Error", "No se actualizo la contraseña");
			redirect(base_url()."Administracion/Usuarios/editarClave",$codigo);
		}
	}else {
		$this->editarClave($codigo);
	}

}
}
?>