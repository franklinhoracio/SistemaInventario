<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Traslados extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("AdminSis/Comprobantes_model");
		$this->load->model("AdminSis/Sucursales_Model");
		$this->load->model("AdminSis/Presentaciones_Model");
		$this->load->model("AdminSis/Usuarios_Model");
		$this->load->model("Inventario/Productos_Model");
		$this->load->model("Inventario/Traslados_Model");
		$this->load->model("Inventario/Inventario_Model");
	}

	public function traslados()
	{	
		$fechainicio = $this->input->post("fechainicio");

		if ($this->input->post("buscar") && !empty($fechainicio)) {
			$salidas = $this->Traslados_Model->listarTrasladosFecha($fechainicio);
		}
		else{
			$salidas =  $this->Traslados_Model->listarTraslados();
			
		}

		$data = array(
		'salidas' => $salidas,
		'fechainicio' => $fechainicio,
	);

		$this->load->view("layouts/header");
		$this->load->view("Inventario/Traslados/listar",$data);
		$this->load->view("layouts/footer");
	}
		public function index($idSucursal,$estado)
		{
			$data =  array('salidas' => $this->Traslados_Model->listar($idSucursal,$estado),
				'estado' => $estado,);
			$this->load->view("layouts/header");
			$this->load->view("Inventario/Traslados/listar",$data);
			$this->load->view("layouts/footer");
		}

		public function index2($idSucursal,$estado)
		{
			$data =  array('salidas' => $this->Traslados_Model->listar2(),
				'estado' => $estado,);
			$this->load->view("layouts/header");
			$this->load->view("Inventario/Traslados/listar",$data);
			$this->load->view("layouts/footer");
		}

		public function agregar($id)
		{
			$data = array('comprobante' => $this->Comprobantes_model->listar(1),
				'sucursales' => $this->Sucursales_Model->listar(1),
				'inventario' => $this->Inventario_Model->listar2($id),
				'trasnportistas' => $this->Usuarios_Model->listarTrasnportista(1));
			$this->load->view("layouts/header");
			$this->load->view("Inventario/Traslados/agregar", $data);
			$this->load->view("layouts/footer");
		}

		public function store()
		{

			$idcomprobante = $this->input->post("idcomprobante");
			$numero = $this->input->post("numero");
			$idsucursalR = $this->input->post("idsucursalr");
			$fecha = $this->input->post("fecha");
			$total = $this->input->post("Total");
			$idusuario = $this->session->userdata("idUsuario");
			$idSucursalE = $this->input->post("idsucursal");
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
			$idInventario= $this->input->post("idInventario");

			$data = array(
				'fecha' => $fecha,
				'idTipoDoc' => $idcomprobante,
				'numDocumento' => $numero,
				'importeTraslado' => $total,
				'idUsuario' => $idusuario,
				'idSucursalEnvia' => $idSucursalE,
				'idSucursalRecibe' => $idsucursalR,
				'estadoTraslado' => "Pendiente",
				'idTransportista' => $trasnportista
			);
			if ($this->Traslados_Model->save($data)) {
				$idtraslado = $this->Traslados_Model->ultimoId();
				$this->actualizarComprobante($idcomprobante);
				$this->guardarDetalle($idtraslado, $idLote, $idproducto, $cantidades, $precio, $importe, $idInventario);
				$this->session->set_flashdata("success", "Se realizo el traslado");
				redirect(base_url()."Inventario/Traslados/agregar/".$idSucursalE);
			}
			else{
				$this->session->set_flashdata("error", "No se realizo el traslado");
				redirect(base_url()."Inventario/Traslados/agregar/".$idSucursalE);
			}
		}

		protected function actualizarComprobante($idcomprobante){
			$comprobanteActual = $this->Comprobantes_model->getComprobante($idcomprobante);
			$data = array(
				'cantidad' => $comprobanteActual->cantidad + 1, 
			);
			$this->Comprobantes_model->actualizar($idcomprobante,$data);

		}


		protected function guardarDetalle($idtraslado, $idLote, $idproducto, $cantidades, $precio, $importe, $idInventario){

			for ($i=0; $i < count($idproducto); $i++) { 
				$data = array(
					'idTraslado' => $idtraslado,
					'idInventario' => $idInventario[$i],
					'idProducto' => $idproducto[$i],
					'idLote' => $idLote[$i],
					'cantidad' => $cantidades[$i], 
					'valorUnitario' => $precio[$i],
					'importeProducto' => $importe[$i]				   
				);

				$this->Traslados_Model->guardarDetalle($data);
			}
		}

		public function editar($id)
		{
			$data = array('producto' => $this->Traslados_Model->getProducto($id),
				'categorias' => $this->Comprobantes_model->listar(1),
				'presentaciones' => $this->Presentaciones_Model->listar(1));
			$this->load->view("layouts/header");
			$this->load->view("Inventario/Traslados/editar",$data);
			$this->load->view("layouts/footer");
		}

		public function actualizar($idTraslado,$estado)
		{
			$idSucursal = $this->session->userdata("idSucursal");
			$idusuario = $this->session->userdata("idUsuario");
			$rol = $this->session->userdata("rol");

			if ($estado == "Enviado") {

				$data = array(
					'estadoTraslado' => $estado,
				);
			}else{

				$data = array(
					'estadoTraslado' => $estado,
					'idUsuarioRecbice' => $idusuario
				);
			}
			if ($rol != "Administrador" and $rol != "Gerente") {
				if ($estado == "Enviado" OR $estado == "Pendiente") {
					if ($this->Traslados_Model->actualizar($idTraslado,$data)) {
						$this->session->set_flashdata("success", "Se actualizo el pedido");
						redirect(base_url()."Inventario/Traslados/index/".$idSucursal."/Enviado");
					}
					else{
						$this->session->set_flashdata("Error", "No se actualizo el pedido");
						redirect(base_url()."Inventario/Traslados/index/".$idSucursal."/Enviado");
					}
				}else{
					if ($this->Traslados_Model->actualizar($idTraslado,$data)) {
						$this->session->set_flashdata("success", "Se actualizo el pedido");
						redirect(base_url()."Inventario/Traslados/index2/".$idSucursal."/Recibido");
					}
					else{
						$this->session->set_flashdata("Error", "No se actualizo el pedido");
						redirect(base_url()."Inventario/Traslados/index2/".$idSucursal."/Recibido");
					}
				}
			}else{
				if ($this->Traslados_Model->actualizar($idTraslado,$data)) {
					$this->session->set_flashdata("success", "Se actualizo el pedido");
					redirect(base_url()."Inventario/Traslados/traslados");
				}
				else{
					$this->session->set_flashdata("Error", "No se actualizo el pedido");
					redirect(base_url()."Inventario/Traslados/traslados");
				}
			}



		}

		public function vista(){
			$idSalida = $this->input->post("idSalida");
			$data = array('traslados' => $this->Traslados_Model->getSalida($idSalida),
				'detalles' => $this->Traslados_Model->getDetalle($idSalida));
			$this->load->view("Inventario/Traslados/view",$data);
		}

		public function reporte($idSalida){
			$data = array('traslados' => $this->Traslados_Model->getSalida($idSalida),
				'detalles' => $this->Traslados_Model->getDetalle($idSalida),
				'observacion' => $this->Traslados_Model->getDetalleO2($idSalida));
			$this->load->view("Inventario/Traslados/reporte",$data);
		}

		public function addOb($idTraslado,$estado)
		{
			$data =  array('idTraslado' => $idTraslado ,
				'estado' => $estado,);
			$this->load->view("layouts/header");
			$this->load->view("Inventario/Traslados/observacion",$data);
			$this->load->view("layouts/footer");
		}

		public function storeObservacion()
		{
			$idusuario = $this->session->userdata("idUsuario");
			$idSucursal = $this->session->userdata("idSucursal");
			$rol = $this->session->userdata("rol");
			$observacion = $this->input->post("observacion");
			$idTraslado = $this->input->post("idTraslado");
			$estado = $this->input->post("estado");

			$data = array(
				'observacion' => $observacion,
				'idUsuario' => $idusuario,
				'idTraslado' => $idTraslado
			);

			if ($rol != "Administrador" and $rol != "Gerente") {
				if ($estado == "Enviado" OR $estado == "Pendiente") {
					if ($this->Traslados_Model->saveObservacion($data)) {
						$this->session->set_flashdata("success", "Se agrego observación al pedido");
						redirect(base_url()."Inventario/Traslados/index/".$idSucursal."/Enviado");
					}
					else{
						$this->session->set_flashdata("Error", "No se agrego observación al pedido");
						redirect(base_url()."Inventario/Traslados/index/".$idSucursal."/Enviado");
					}
				}else{
					if ($this->Traslados_Model->saveObservacion($data)) {
						$this->session->set_flashdata("success", "Se agrego observación al pedido");
						redirect(base_url()."Inventario/Traslados/index2/".$idSucursal."/Recibido");
					}
					else{
						$this->session->set_flashdata("Error", "No se agrego observación al pedido");
						redirect(base_url()."Inventario/Traslados/index2/".$idSucursal."/Recibido");
					}
				}
			}else{
				if ($this->Traslados_Model->saveObservacion($data)) {
					$this->session->set_flashdata("success", "Se agrego observación al pedido");
					redirect(base_url()."Inventario/Traslados/traslados");
				}
				else{
					$this->session->set_flashdata("Error", "No se agrego observación al pedido");
					redirect(base_url()."Inventario/Traslados/traslados");
				}
			}
		}

		public function vistaOb(){
			$idSalida = $this->input->post("idSalida");
			$data = array('traslados' => $this->Traslados_Model->getSalida($idSalida),
				'observacion' => $this->Traslados_Model->getDetalleO($idSalida));
			$this->load->view("Inventario/Traslados/viewO",$data);
		}

		public function proInventario(){
			$id = $this->input->post("id");
			$data = array('inventario' => $this->Inventario_Model->listar2($id));
			$this->load->view("Inventario/Traslados/inventario",$data);
		}

		public function proInventario2(){
			$id = $this->input->post("id");
			$data = array('inventario' => $this->Inventario_Model->listar2($id));
			$this->load->view("Inventario/Devoluciones/inventario",$data);
		}
	}
	?>