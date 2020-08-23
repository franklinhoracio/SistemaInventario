<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("AdminSis/Categorias_Model");
		$this->load->model("AdminSis/Comprobantes_model");
		$this->load->model("AdminSis/Presentaciones_Model");
		$this->load->model("Inventario/Productos_Model");
		$this->load->model("Inventario/Proveedores_Model");
		$this->load->model("Inventario/Compras_Model");
	}

	public function index()
	{
		$data =  array('compras' => $this->Compras_Model->listar(),);
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Compras/listar",$data);
		$this->load->view("layouts/footer");
	}

	public function buscarPro(){
		$valor = $this->input->post("valor");
		$producto = $this->Productos_Model->buscarPro($valor);
		echo json_encode($producto);
	}

	public function buscarProducto(){
		$valor = $this->input->post("bpro");
		$producto = $this->Productos_Model->buscarProducto($valor);
		echo json_encode($producto);
	}

	public function buscarProve(){
		$valor = $this->input->post("valor");
		$proveedor = $this->Proveedores_Model->buscarProve($valor);
		echo json_encode($proveedor);
	}

	public function agregar()
	{
		$data = array('comprobante' => $this->Comprobantes_model->listar(1),
					  'proveedores' => $this->Proveedores_Model->listar(1),
					  'categorias' => $this->Categorias_Model->listar(1),
					  'presentaciones' => $this->Presentaciones_Model->listar(1));
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Compras/agregar", $data);
		$this->load->view("layouts/footer");
	}

	public function store()
	{

		$idcomprobante = $this->input->post("comprobantes");
		$numero = $this->input->post("numero");
		$idproveedor = $this->input->post("idproveedor");
		$fecha = $this->input->post("fecha");
		$subtotal = $this->input->post("subtotal");
		$igc = $this->input->post("igc2");
		$total = $this->input->post("total");
		$idusuario = $this->session->userdata("idUsuario");
		$idSucursal = $this->session->userdata("idSucursal");

		$idproducto = $this->input->post("idproductos");
		$idLote = $this->input->post("idLote");
		$precio = $this->input->post("precio");			
		$cantidades = $this->input->post("cantidades");
		$iva = $this->input->post("iva");
		$importe= $this->input->post("importe");
		$fechaV = $this->input->post("fechaV");

		$data = array(
			'fecha' => $fecha,
			'idTipoDoc' => $idcomprobante,
			'numDocumento' => $numero,
			'costo' => $subtotal,
			'iva' => $igc,
			'importeCompra' => $total,
			'idUsuario' => $idusuario,
			'idSucursal' => $idSucursal,
			'idProveedor' => $idproveedor,
		);
		if ($this->Compras_Model->save($data)) {
			$idcompra = $this->Compras_Model->ultimoId();
			$this->guardarDetalle($idcompra, $idLote, $idproducto, $cantidades, $precio, $iva,  $fechaV, $importe);
			$this->session->set_flashdata("success", "Se agrego la factura y el producto");
			redirect(base_url()."Inventario/Compras/agregar");
		}
		else{
			$this->session->set_flashdata("error", "No se agrego la factura y el producto");
			redirect(base_url()."Inventario/Compras/agregar");
		}
	}


	protected function guardarDetalle($idcompra, $idLote, $producto, $cantidades, $precio, $iva, $fechaV, $importe){

		for ($i=0; $i < count($producto); $i++) { 
			$data = array(
				'idCompra' => $idcompra,
				'idProducto' => $producto[$i],
				'idLote' => $idLote[$i],
				'fechaVencimiento' => $fechaV[$i], 
				'cantidad' => $cantidades[$i], 
				'valorUnitario' => $precio[$i],
				'iva' =>  $iva[$i],
				'importeProducto' => $importe[$i]				   
			);
			
			$this->Compras_Model->guardarDetalle($data);
		}
	}

	public function editar($id)
	{
		$data = array('producto' => $this->Compras_Model->getProducto($id),
			'categorias' => $this->Comprobantes_model->listar(1),
			'presentaciones' => $this->Presentaciones_Model->listar(1));
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Compras/editar",$data);
		$this->load->view("layouts/footer");
	}

	public function actualizar()
	{
		$codigo = $this->input->post("codigo");
		$producto = $this->input->post("producto");
		$precio = $this->input->post("precio");
		$codigoBarra = $this->input->post("codigoBarra");
		$stockMinimo = $this->input->post("stockMinimo");
		$presentacion = $this->input->post("presentacion");
		$categoria = $this->input->post("categoria");
		$this->form_validation->set_rules("producto", "producto","required");
		$this->form_validation->set_rules("precio", "precio","required");
		$this->form_validation->set_rules("codigoBarra", "codigo de barra","required");
		$this->form_validation->set_rules("stockMinimo", "stock Minimo","required");
		$this->form_validation->set_rules("presentacion", "presentacion","required");
		$this->form_validation->set_rules("categoria", "categoria","required");

		if ($this->form_validation->run()) {
			$data = array(
				'producto' => $producto,
				'precioVenta' => $precio,
				'codigoBarra' => $codigoBarra,
				'stockMinimo' => $stockMinimo,
				'idPresentacion' => $presentacion,
				'idCategoria' => $categoria,
			);
			if ($this->Compras_Model->actualizar($codigo,$data)) {
				$this->session->set_flashdata("success", "Se actualizo el producto");
				redirect(base_url()."Inventario/Compras/index/1");
			}
			else{
				$this->session->set_flashdata("Error", "No se actualizo el producto");
				redirect(base_url()."Inventario/Compras/editar",$codigo);
			}

		} 
		else {
			$this->editar($codigo);
		}
	}

	public function vista(){
		$idCompra = $this->input->post("idCompra");
		$data = array('compras' => $this->Compras_Model->getCompra($idCompra),
			'detalles' => $this->Compras_Model->getDetalle($idCompra));
		$this->load->view("Inventario/Compras/view",$data);
	}
}
?>