<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("AdminSis/Comprobantes_model");
		$this->load->model("AdminSis/Sucursales_Model");
		$this->load->model("AdminSis/Presentaciones_Model");
		$this->load->model("AdminSis/Categorias_Model");
		$this->load->model("Inventario/Productos_Model");
		$this->load->model("Inventario/Ventas_Model");
		$this->load->model("Inventario/Inventario_Model");
	}

	public function index()
	{
		$data =  array('ventas' => $this->Ventas_Model->listar(),);
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Ventas/listar",$data);
		$this->load->view("layouts/footer");
	}

	public function abc()
	{
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Ventas/devVenta");
		$this->load->view("layouts/footer");
	}

	public function index2($idSucursal)
	{
		$data =  array('ventas' => $this->Ventas_Model->listar2($idSucursal),);
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Ventas/listar",$data);
		$this->load->view("layouts/footer");
	}

	public function agregar($id)
	{
		$data = array('comprobante' => $this->Comprobantes_model->listar(1),
			'sucursales' => $this->Sucursales_Model->listar(1),
			'inventario' => $this->Inventario_Model->listar2($id),
			'categorias' => $this->Categorias_Model->listar(1));
		
		if ($this->session->userdata("rol")== "Administrador") {
			$this->load->view("layouts/header");
			$this->load->view("Inventario/Ventas/agregar3", $data);
			$this->load->view("layouts/footer");
		}else{
			$this->load->view("layouts/header");
			$this->load->view("Inventario/Ventas/agregar3", $data);
			$this->load->view("layouts/footer");
		}

	}

	public function buscarInv(){
		$idSucursal = $this->session->userdata("idSucursal");
		$valor = $this->input->post("valor");
		$producto = $this->Inventario_Model->buscarInv($idSucursal,$valor);
		echo json_encode($producto);
	}

	public function store()
	{

		//$idcomprobante = $this->input->post("comprobantes");
		//$numero = $this->input->post("numero");
		$fecha = $this->input->post("fecha");
		$subtotal = $this->input->post("subtotal");
		$igc = $this->input->post("igc2");
		$total = $this->input->post("Total");
		$idusuario = $this->session->userdata("idUsuario");
		$idSucursalE = "";
		if (empty($_POST['idsucursal'])) {
			$idSucursalE = $this->session->userdata("idSucursal");
		}else{
			$idSucursalE = $this->input->post("idsucursal");
		}		

		$idproducto = $this->input->post("idproductos");
		$idLote = $this->input->post("idLote");
		$precio = $this->input->post("precio");			
		$cantidades = $this->input->post("cantidades");
		$iva = $this->input->post("iva");
		$importe= $this->input->post("importe");
		$idInventario= $this->input->post("idInventario");

		$data = array(
			'fecha' => $fecha,
			'idTipoDoc' => 1,
			'precio' => $subtotal,
			'iva' => $igc,
			'importeVenta' => $total,
			'idUsuario' => $idusuario,
			'idSucursal' => $idSucursalE
		);
		if ($this->Ventas_Model->save($data)) {
			$idventa = $this->Ventas_Model->ultimoId();
			$this->guardarDetalle($idventa, $idLote, $idproducto, $cantidades, $precio, $iva, $importe, $idInventario);
			$this->session->set_flashdata("success", "Se realizo la venta");
			redirect(base_url()."Inventario/Ventas/agregar/".$idSucursalE);
		}
		else{
			$this->session->set_flashdata("error", "No se realizo la venta");
			redirect(base_url()."Inventario/Ventas/agregar/".$idSucursalE);
		}
	}

	protected function actualizarComprobante($idcomprobante){
		$comprobanteActual = $this->Comprobantes_model->getComprobante($idcomprobante);
		$data = array(
			'cantidad' => $comprobanteActual->cantidad + 1, 
		);
		$this->Comprobantes_model->actualizar($idcomprobante,$data);

	}


	protected function guardarDetalle($idventa, $idLote, $idproducto, $cantidades, $precio, $iva, $importe, $idInventario){

		for ($i=0; $i < count($idproducto); $i++) { 
			$data = array(
				'idTraslado' => $idventa,
				'idInventario' => $idInventario[$i],
				'idProducto' => $idproducto[$i],
				'idLote' => $idLote[$i],
				'cantidad' => $cantidades[$i],
				'valorUnitario' => $precio[$i], 
				'iva' => $iva[$i], 
				'importeProducto' => $importe[$i]				   
			);
			
			$this->Ventas_Model->guardarDetalle($data);
		}
	}

	public function editar($id)
	{
		$data = array('producto' => $this->Ventas_Model->getProducto($id),
			'categorias' => $this->Comprobantes_model->listar(1),
			'presentaciones' => $this->Presentaciones_Model->listar(1));
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Ventas/editar",$data);
		$this->load->view("layouts/footer");
	}

	public function actualizar($idTraslado,$estado)
	{
		$idSucursal = $this->session->userdata("idSucursal");
		$idusuario = $this->session->userdata("idUsuario");

	}


	public function vista(){
		$idVenta = $this->input->post("idVenta");
		$data = array('ventas' => $this->Ventas_Model->getVenta($idVenta),
			'detalles' => $this->Ventas_Model->getDetalle($idVenta));
		$this->load->view("Inventario/Ventas/view",$data);
	}

	public function vistaPro(){
		$id = $this->session->userdata("idSucursal");
		$idCategoria = $this->input->post("idCategoria");
		$idSucursal = $this->input->post("idSucursal");
		$data = array();
		if ($idSucursal == null) {
			$data = array('inventario' => $this->Inventario_Model->listarPorCategoria($id,$idCategoria));
		}else{
			$data = array('inventario' => $this->Inventario_Model->listarPorCategoria($idSucursal,$idCategoria));
		}
		$this->load->view("Inventario/Ventas/productos",$data);
	}
//agregar devolucion del producto
	public function addDevo(){
		$idSucursalE = $this->session->userdata("idSucursal");
		$data = $this->input->post();
		$data2 = array(
			'producto' => $data['idProDev'],
			'cant' => $data['cantidadDev'],
			'sucursal' => $idSucursalE,
			'desc1' => "Devolucion sobre venta",
		);
		$this->Ventas_Model->devoVenta($data2);
	}

}
?>

