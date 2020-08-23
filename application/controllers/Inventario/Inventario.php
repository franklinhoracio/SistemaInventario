<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("AdminSis/Sucursales_Model");
		$this->load->model("Inventario/Inventario_Model");
		$this->load->model("Inventario/Productos_Model");
	}
	public function index()
	{
		$this->load->view("layouts/header");
		$this->load->view("Inventario/menuInventario");
		$this->load->view("layouts/footer");
	}

	public function sucursales()
	{	
		$data =  array('sucursales' => $this->Sucursales_Model->listar(1),);
	$this->load->view("layouts/header");
	$this->load->view("Inventario/InventarioSucursales/inventarioSucursales",$data);
	$this->load->view("layouts/footer");
}

public function sucursal($id)
{	$data =  array('inventarios' => $this->Inventario_Model->listar($id),
	'sucursal' => $this->Sucursales_Model->listar2($id));
$this->load->view("layouts/header");
$this->load->view("Inventario/InventarioSucursales/inventario",$data);
$this->load->view("layouts/footer");
}


public function view()
{	
	$idInventario = $this->input->post("idInventario");
	$idSucursal = $this->input->post("idSucursal");
	$data =  array('inventarios' => $this->Inventario_Model->view($idInventario,$idSucursal));
	$this->load->view("Inventario/InventarioSucursales/view",$data);
}

public function editar($id)
{	$data = array('inventario' => $this->Inventario_Model->getInventario($id),);
$this->load->view("layouts/header");
$this->load->view("Inventario/InventarioSucursales/editar",$data);
$this->load->view("layouts/footer");
}

public function editar2()
{	
	$sucursal = $this->input->post("sucursal");
	$idInventario = $this->input->post("idInventario");
	$cantidad = $this->input->post("cantidad");
	$descripcion = $this->input->post("descripcion");

	$data = array(

		'idInventario' => $idInventario,
		'cantidad' => $cantidad,
		'descripcion' => $descripcion,
	);
	if ($this->Inventario_Model->editar($data)) {
		$this->session->set_flashdata("success", "Se actualizo la existencia del producto");
		redirect(base_url()."Inventario/Inventario/sucursales");
	}
	else{
		$this->session->set_flashdata("Error", "No se actualizo la existencia del producto");
		redirect(base_url()."Inventario/Inventario/editar",$idInventario);
	}


}

public function cargar($id)
{	$data = array('sucursal' => $id);
$this->load->view("layouts/header");
$this->load->view("Inventario/InventarioSucursales/cargar",$data);
$this->load->view("layouts/footer");
}

public function cargar2()
{	
	$sucursal = $this->input->post("sucursal");
	$idproducto = $this->input->post("idproductos");
	$cantidades = $this->input->post("cantidades");
	$this->cargar3($sucursal,$idproducto,$cantidades);

}

public function cargar3($sucursal,$idproducto,$cantidades)
{	

	for ($i=0; $i < count($idproducto); $i++) {
		$data = array(

			'producto' => $idproducto[$i],
			'cantidad' => $cantidades[$i],
			'costou' => 0.00,
			'fechaV' => NULL,
			'sucursal' => $sucursal,
		);
		$this->Inventario_Model->cargar($data);
	}
	$this->session->set_flashdata("success", "Se cargo inventario");
	redirect(base_url()."Inventario/Inventario/sucursales");
}

public function kardex($idProducto, $idSucursal)
{
	$fechainicio = $this->input->post("fechainicio");
	$fechafin = $this->input->post("fechafin");

	if ($this->input->post("buscar") && !empty($fechainicio) && !empty($fechafin)) {
		$data = array('inventario' =>$this->Inventario_Model->kardexPorFecha($idProducto, $idSucursal, $fechainicio, $fechafin),
			'sucursal' => $this->Sucursales_Model->listar2($idSucursal),
			'producto' => $this->Productos_Model->getProducto($idProducto));
	}else{
		$data = array('inventario' =>$this->Inventario_Model->kardex($idProducto, $idSucursal),
			'sucursal' => $this->Sucursales_Model->listar2($idSucursal),
			'producto' => $this->Productos_Model->getProducto($idProducto));
	}

	$this->load->view("layouts/header");
	$this->load->view("Inventario/InventarioSucursales/kardex",$data);
	$this->load->view("layouts/footer");
}

}
?>