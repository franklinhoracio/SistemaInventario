<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Devoluciones extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Inventario/Inventario_Model");
		$this->load->model("AdminSis/Comprobantes_model");
		$this->load->model("AdminSis/Sucursales_Model");
		$this->load->model("AdminSis/Presentaciones_Model");
		$this->load->model("AdminSis/Usuarios_Model");
		$this->load->model("Inventario/Productos_Model");
		$this->load->model("Inventario/Devoluciones_Model");
	}

	public function index()
	{
		$fechainicio = $this->input->post("fechainicio");

		if ($this->input->post("buscar") && !empty($fechainicio)) {
			$salidas = $this->Devoluciones_Model->listarDevFecha($fechainicio);
		}
		else{
			$salidas =  $this->Devoluciones_Model->listarDev();
			
		}

		$data = array(
			'devoluciones' => $salidas,
			'fechainicio' => $fechainicio,
		);

		$this->load->view("layouts/header");
		$this->load->view("Inventario/Devoluciones/listar", $data);
		$this->load->view("layouts/footer");
	}

	public function inventarioDevoluciones()
	{	$data =  array('inventarios' => $this->Inventario_Model->inventarioDevoluciones());
	$this->load->view("layouts/header");
	$this->load->view("Inventario/InventarioSucursales/inventarioDevoluciones",$data);
	$this->load->view("layouts/footer");
}

public function agregar()
{
	$data = array('comprobante' => $this->Comprobantes_model->listar(1),
		'sucursales' => $this->Sucursales_Model->listar(1),
		'trasnportistas' => $this->Usuarios_Model->listarTrasnportista(1));
	$this->load->view("layouts/header");
	$this->load->view("Inventario/Devoluciones/agregar", $data);
	$this->load->view("layouts/footer");
}

public function store()
{

	$fecha = $this->input->post("fecha");
	$idcomprobante = $this->input->post("idcomprobante");
	$numero = $this->input->post("numero");
	$total = $this->input->post("Total");
	$idusuario = $this->session->userdata("idUsuario");
	$idSucursalD = $this->input->post("idsucursal");
	$idsucursalR = $this->input->post("idsucursalr");
		//$trasnportista = $this->input->post("trasnportista");
	if (empty($_POST['trasnportista'])) {
		$trasnportista = NULL; 
	}else{
		$trasnportista = $this->input->post("trasnportista");
	}

	$idproducto = $this->input->post("idproductos");
	$idLote = $this->input->post("idLote");
	$precio = $this->input->post("precio");			
	$cantidades = $this->input->post("cantidades");
	$importe= $this->input->post("importe");
	$costoUnitario= $this->input->post("costoUnitario");
	$idInventario= $this->input->post("idInventario");

	$data = array(
		'fecha' => $fecha,
		'idTipoDoc' => $idcomprobante,
		'numDocumento' => $numero,
		'importeDevTraslado' => $total,
		'idUsuario' => $idusuario,
		'idSucursalDevuelve' => $idSucursalD,
		'idSucursalRecibe' => $idsucursalR
	);
	if ($this->Devoluciones_Model->save($data)) {
		$idDevo = $this->Devoluciones_Model->ultimoId();
		$this->actualizarComprobante($idcomprobante);
		$this->guardarDetalle($idDevo, $idLote, $idproducto, $cantidades, $precio, $importe, $costoUnitario, $idInventario);
		$this->session->set_flashdata("success", "Se realizo la devolución");
		redirect(base_url()."Inventario/Devoluciones/agregar");
	}
	else{
		$this->session->set_flashdata("error", "No se realizo la devolución");
		redirect(base_url()."Inventario/Devoluciones/agregar");
	}
}

protected function actualizarComprobante($idcomprobante){
	$comprobanteActual = $this->Comprobantes_model->getComprobante($idcomprobante);
	$data = array(
		'cantidad' => $comprobanteActual->cantidad + 1, 
	);
	$this->Comprobantes_model->actualizar($idcomprobante,$data);

}


protected function guardarDetalle($idDevo, $idLote, $idproducto, $cantidades, $precio, $importe, $costoUnitario,$idInventario){

	for ($i=0; $i < count($idproducto); $i++) { 
		$data = array(
			'idDevolucionTraslado' => $idDevo,
			'idProducto' => $idproducto[$i],
			'idLote' => $idLote[$i],
			'cantidad' => $cantidades[$i], 
			'costoUnitario' => $costoUnitario[$i],
			'importeProducto' => $importe[$i],				   
			'precio' => $precio[$i],
			'idInventario' => $idInventario[$i]
		);

		$this->Devoluciones_Model->guardarDetalle($data);
	}
}

public function vista(){
	$idDevolucion = $this->input->post("idDevolucion");
	$data = array('devoluciones' => $this->Devoluciones_Model->getDev($idDevolucion),
		'detalles' => $this->Devoluciones_Model->getDetalle($idDevolucion));
	$this->load->view("Inventario/Devoluciones/view",$data);
}

public function proInventario(){
	$id = $this->input->post("id");
	$data = array('inventario' => $this->Inventario_model->listar2(5));
	$this->load->view("Inventario/Devoluciones/inventario",$data);
}

public function editar(){
	$id = $this->input->post('id');
	$precio = $this->input->post('precio');
	$data2 = array(
		'precio' => $precio, 
	);
	$this->Devoluciones_Model->editar($id, $data2);
}
}
?>