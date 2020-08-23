<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Traslados_Model extends CI_Model {

	public function listarTraslados(){
		$this->db->select("t.*, CONCAT(d.tipoDocumento, ' ',t.numDocumento) as Comprobante, u.usuario, se.sucursal as sucursale, sr.sucursal as sucursalr");
		$this->db->from("traslados t");
		$this->db->join('usuarios u', 't.idUsuario=u.idUsuario');
		$this->db->join('tipodocumentos d', 't.idTipoDoc=d.idTipoDoc');
		$this->db->join('sucursales se', 't.idSucursalEnvia=se.idSucursal');
		$this->db->join('sucursales sr', 't.idSucursalRecibe=sr.idSucursal');
		$this->db->order_by('t.numDocumento', 'DESC');
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function listarTrasladosFecha($fechainicio){
		$this->db->select("t.*, CONCAT(d.tipoDocumento, ' ',t.numDocumento) as Comprobante, u.usuario, se.sucursal as sucursale, sr.sucursal as sucursalr");
		$this->db->from("traslados t");
		$this->db->join('usuarios u', 't.idUsuario=u.idUsuario');
		$this->db->join('tipodocumentos d', 't.idTipoDoc=d.idTipoDoc');
		$this->db->join('sucursales se', 't.idSucursalEnvia=se.idSucursal');
		$this->db->join('sucursales sr', 't.idSucursalRecibe=sr.idSucursal');
		$this->db->where("fecha =",$fechainicio);
		$this->db->order_by('t.estadoTraslado', 'DESC');
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function listar($idsucursal,$estado){
		$this->db->select("t.*, CONCAT(d.tipoDocumento, ' ',t.numDocumento) as Comprobante, u.usuario, se.sucursal as sucursale, sr.sucursal as sucursalr");
		$this->db->from("traslados t");
		$this->db->join('usuarios u', 't.idUsuario=u.idUsuario');
		$this->db->join('tipodocumentos d', 't.idTipoDoc=d.idTipoDoc');
		$this->db->join('sucursales se', 't.idSucursalEnvia=se.idSucursal');
		$this->db->join('sucursales sr', 't.idSucursalRecibe=sr.idSucursal');
		$this->db->where("t.idSucursalEnvia", $idsucursal);
		$this->db->where('t.estadoTraslado !=', $estado);
		$this->db->order_by('t.estadoTraslado', 'DESC');
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function listar2(){
		$this->db->select("t.*, CONCAT(d.tipoDocumento, ' ',t.numDocumento) as Comprobante, u.usuario, se.sucursal as sucursale, sr.sucursal as sucursalr");
		$this->db->from("traslados t");
		$this->db->join('usuarios u', 't.idUsuario=u.idUsuario');
		$this->db->join('tipodocumentos d', 't.idTipoDoc=d.idTipoDoc');
		$this->db->join('sucursales se', 't.idSucursalEnvia=se.idSucursal');
		$this->db->join('sucursales sr', 't.idSucursalRecibe=sr.idSucursal');
		$this->db->where('t.estadoTraslado', "Enviado");
		$this->db->order_by('t.estadoTraslado', 'DESC');
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function save($data){
		return $this->db->insert('traslados', $data);
	}

	public function ultimoId(){
		$this->db->select_max('idTraslado'); 
		$result = $this->db->get('traslados')->row_array();
		return $result['idTraslado'];
	}

	public function guardarDetalle($data){
		return $this->db->query("CALL sp_detTraslado(?,?,?,?,?,?,?)", $data);
	}

	public function getSalida($id){
		$this->db->select("t.*, d.tipoDocumento, u.usuario, CONCAT(e.nombresEmpleado, ' ', e.apellidosEmpleado) AS Nombre, CONCAT(se.sucursal, ' ', se.ubicacion) as sucursale, CONCAT(sr.sucursal, ' ', sr.ubicacion) as sucursalr");
		$this->db->from("traslados t");
		$this->db->join('usuarios u', 't.idUsuario=u.idUsuario');
		$this->db->join('usuarios us', 'us.idUsuario=t.idTransportista', 'left');
		$this->db->join('tipodocumentos d', 't.idTipoDoc=d.idTipoDoc');
		$this->db->join('empleados e', 'us.idEmpleado=e.idEmpleado', 'left');
		$this->db->join('sucursales se', 't.idSucursalEnvia=se.idSucursal');
		$this->db->join('sucursales sr', 't.idSucursalRecibe=sr.idSucursal');
		$this->db->where("idTraslado", $id);
		$resultado=$this->db->get();
		return $resultado->row();
	}

	public function getDetalle($id){
		$this->db->select("dt.*, p.idProducto, CONCAT(p.producto,' ', p.sabores) as Producto, p.producto, pr.presentacion");
		$this->db->from("detalletraslados dt");
		$this->db->join('productos p', 'dt.idProducto=p.idProducto');
		$this->db->join('presentaciones pr', 'pr.idPresentacion=p.idPresentacion', 'left');
		$this->db->where("dt.idTraslado", $id);
		$resultado=$this->db->get();
		return $resultado->result();
	}
	
	public function actualizar($id, $data){
		$this->db->where("idTraslado", $id);
		return $this->db->update("traslados", $data);
	}

	public function saveObservacion($data){
		return $this->db->insert('observaciones', $data);
	}

	public function getDetalleO($id){
		$this->db->select("o.*, u.usuario");
		$this->db->from("observaciones o");
		$this->db->join('usuarios u', 'o.idUsuario=u.idUsuario');
		$this->db->where("o.idTraslado", $id);
		$resultado=$this->db->get();
		return $resultado->result();
	}

	public function getDetalleO2($id){
		$this->db->select("o.*, u.usuario");
		$this->db->from("observaciones o");
		$this->db->join('usuarios u', 'o.idUsuario=u.idUsuario');
		$this->db->where("o.idTraslado", $id);
		$resultado=$this->db->get();
		return $resultado->row();
	}
}