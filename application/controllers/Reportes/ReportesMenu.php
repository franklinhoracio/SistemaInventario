<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportesMenu extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		if ($this->session->userdata("rol") != "Administrador" and $this->session->userdata("rol") != "Gerente") {
			redirect(base_url());
		}

		$this->load->model("Inventario/Inventario_Model");
		$this->load->model("Inventario/Ventas_Model");
		$this->load->model("AdminSis/Sucursales_Model");
	}
	public function index()
	{
		$this->load->view("layouts/header");
		$this->load->view("Reportes/reportesMenu");
		$this->load->view("layouts/footer");
	}

	public function inventarios()
	{	
		$inven = $this->Inventario_Model->inventarioGeneral();
		$total = 0;
		foreach ($inven as $invent ) {
			$total += ($invent->precioCIVA *$invent->Existencias); 
		}
		$data = $arrayName = array('inventarios' => $this->Inventario_Model->inventarioGeneral(),
			'sucursales' => $this->Sucursales_Model->listar(1),
			'total' => $total);
		$this->load->view("layouts/header");
		$this->load->view("Reportes/inventarios", $data);
		$this->load->view("layouts/footer");
	}

	public function inventarios2($id)
	{	
		$inven = $this->Inventario_Model->inventarioSucursal($id);
		$total = 0;
		foreach ($inven as $invent ) {
			$total += ($invent->precioCIVA *$invent->Existencias); 
		}
		$data = $arrayName = array('inventarios' => $this->Inventario_Model->inventarioSucursal($id),
			'sucursales' => $this->Sucursales_Model->listar(1),
			'total' => $total);
		$this->load->view("layouts/header");
		$this->load->view("Reportes/inventarios", $data);
		$this->load->view("layouts/footer");
	}

	public function ventas()
	{	
		$fechainicio = $this->input->post("fechainicio");
		$fechafin = $this->input->post("fechafin");
		if ($this->input->post("buscar") && !empty($fechainicio) && !empty($fechafin)) {
			$ventas = $this->Ventas_Model->getVentasbyDate($fechainicio,$fechafin);
		}
		else{
			$ventas = $this->Ventas_Model->reporteVentas();
		}

		$data = array(
			'detalles' => $ventas,
			'fechainicio' => $fechainicio,
			'fechafin' => $fechafin, 
		);

		$this->load->view("layouts/header");
		$this->load->view("Reportes/ventas", $data);
		$this->load->view("layouts/footer");
	}

	public function ventas1($id)
	{	$data = $arrayName = array('detalles' => $this->Ventas_Model->reporteVentas($id));
	$this->load->view("layouts/header");
	$this->load->view("Reportes/ventas", $data);
	$this->load->view("layouts/footer");
}
}
?>