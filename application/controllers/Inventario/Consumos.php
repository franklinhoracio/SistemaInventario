<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumos extends CI_Controller
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
		$this->load->model("Inventario/Consumos_Model");
		$this->load->model("Inventario/Inventario_Model");
	}

	public function index()
	{
		$data =  array('despachos' => $this->Consumos_Model->listar(),);
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Consumos/listar",$data);
		$this->load->view("layouts/footer");
	}

	public function index2($idSucursal)
	{
		$data =  array('despachos' => $this->Consumos_Model->listar2($idSucursal),);
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Consumos/listar",$data);
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
			$this->load->view("Inventario/Consumos/agregarAdmi", $data);
			$this->load->view("layouts/footer");
		}else{
			$this->load->view("layouts/header");
			$this->load->view("Inventario/Consumos/agregar2", $data);
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
		$razon = $this->input->post("razon");
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
			'numDocumento' => 0000,
			'importeDespacho' => $total,
			'idUsuario' => $idusuario,
			'idSucursal' => $idSucursalE,
			'razonDespacho' => $razon
		);
		if ($this->Consumos_Model->save($data)) {
			$idDespcho = $this->Consumos_Model->ultimoId();
			$this->guardarDetalle($idDespcho, $idLote, $idproducto, $cantidades, $precio, $iva, $importe, $idInventario);
			$this->session->set_flashdata("success", "Se realizo el despacho");
			redirect(base_url()."Inventario/consumos/agregar/".$idSucursalE);
		}
		else{
			$this->session->set_flashdata("error", "No se realizo el despacho");
			redirect(base_url()."Inventario/consumos/agregar/".$idSucursalE);
		}
	}

	protected function actualizarComprobante($idcomprobante){
		$comprobanteActual = $this->Comprobantes_model->getComprobante($idcomprobante);
		$data = array(
			'cantidad' => $comprobanteActual->cantidad + 1, 
		);
		$this->Comprobantes_model->actualizar($idcomprobante,$data);

	}


	protected function guardarDetalle($idDespcho, $idLote, $idproducto, $cantidades, $precio, $iva, $importe, $idInventario){

		for ($i=0; $i < count($idproducto); $i++) { 
			$data = array(
				'idTraslado' => $idDespcho,
				'idInventario' => $idInventario[$i],
				'idProducto' => $idproducto[$i],
				'idLote' => $idLote[$i],
				'cantidad' => $cantidades[$i],
				'valorUnitario' => $precio[$i],
				'importeProducto' => $importe[$i]				   
			);
			
			$this->Consumos_Model->guardarDetalle($data);
		}
	}

	public function editar($id)
	{
		$data = array('producto' => $this->Consumos_Model->getProducto($id),
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
		$idDespcho = $this->input->post("idDespcho");
		$data = array('despachos' => $this->Consumos_Model->getDespacho($idDespcho),
			'detalles' => $this->Consumos_Model->getDetalle($idDespcho));
		$this->load->view("Inventario/Consumos/view",$data);
	}

	public function reporte($idDespcho){
		$data = array('despachos' => $this->Consumos_Model->getDespacho($idDespcho),
			'detalles' => $this->Consumos_Model->getDetalle($idDespcho));
		$this->load->view("Inventario/Consumos/reporte",$data);
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

}
?>

