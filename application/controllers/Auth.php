<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Login_Model");
		
	}
	public function index()
	{
		if ($this->session->userdata("login")) {
			redirect(base_url()."dashboard");
		}
		else{
			$this->load->view("admin/login");
			$this->session->set_flashdata("error","Inicie sesión");
		}
	}

	public function login(){
		$usuario = $this->input->post("usuario");
		$password = $this->input->post("pass");
		$res = $this->Login_Model->login($usuario);

		if (!$res) {
			$this->session->set_flashdata("error","El usuario y/o contraseña son incorrectos");
			redirect(base_url());
		}
		else{

			if (password_verify($password, $res->clave)) {
				$data  = array(
					'idUsuario' => $res->idUsuario,
					'usuario' => $res->usuario,
					'rol' => $res->rol,
					'idSucursal' => $res->idSucursal,
					'Nombre' => $res->Nombre,
					'cargo' => $res->cargo,
					'login' => TRUE
				);
				$this->session->set_userdata($data);
				if ($this->session->userdata("cargo")=="Vendedor"){
					$idS=$this->session->userdata("idSucursal");
					redirect(base_url()."Inventario/Ventas/agregar/".$idS);
				}else{
					redirect(base_url()."dashboard");
				}
//Inventario/Ventas/agregar/<?php echo $this->session->userdata("idSucursal")
			}else{
				$this->session->set_flashdata("error","El usuario y/o contraseña son incorrectos");
				redirect(base_url());
			}

		}
	} 


	public function logout(){
		$data  = array(
			'login' => FALSE
		);
		$this->session->set_userdata($data);
		redirect(base_url());
	}

	
}
