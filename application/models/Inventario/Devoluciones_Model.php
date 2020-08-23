<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devoluciones_Model extends CI_Model {

	public function listarDev(){
		$this->db->select("d.*, CONCAT(td.tipoDocumento, ' ',d.numDocumento) as Comprobante, u.usuario, se.sucursal as sucursale");
		$this->db->from("devolucionestraslados d");
		$this->db->join('usuarios u', 'd.idUsuario=u.idUsuario');
		$this->db->join('tipodocumentos td', 'd.idTipoDoc=td.idTipoDoc');
		$this->db->join('sucursales se', 'd.idSucursalDevuelve=se.idSucursal');
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function listarDevFecha($fechainicio){
		$this->db->select("d.*, CONCAT(td.tipoDocumento, ' ',d.numDocumento) as Comprobante, u.usuario, se.sucursal as sucursale");
		$this->db->from("devolucionestraslados d");
		$this->db->join('usuarios u', 'd.idUsuario=u.idUsuario');
		$this->db->join('tipodocumentos td', 'd.idTipoDoc=td.idTipoDoc');
		$this->db->join('sucursales se', 'd.idSucursalDevuelve=se.idSucursal');
		$this->db->where("fecha =",$fechainicio);
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function getDev($id){
		$this->db->select("d.*, td.tipoDocumento, u.usuario, CONCAT(se.sucursal, ' ', se.ubicacion) as sucursale");
		$this->db->from("devolucionestraslados d");
		$this->db->join('usuarios u', 'd.idUsuario=u.idUsuario');
		$this->db->join('tipodocumentos td', 'd.idTipoDoc=td.idTipoDoc');
		$this->db->join('sucursales se', 'd.idSucursalDevuelve=se.idSucursal');
		$this->db->where("idDevolucionTraslado", $id);
		$resultado=$this->db->get();
		return $resultado->row();
	}

	public function getDetalle($id){
		$this->db->select("dv.*, p.idProducto, CONCAT(p.producto,' ', p.sabores) as Producto, p.producto, p.precioCIVA, pr.presentacion");
		$this->db->from("detalledevtraslados dv");
		$this->db->join('productos p', 'dv.idProducto=p.idProducto');
		$this->db->join('presentaciones pr', 'pr.idPresentacion=p.idPresentacion', 'left');
		$this->db->where("dv.idDevolucionTraslado", $id);
		$resultado=$this->db->get();
		return $resultado->result();
	}

	public function save($data){
		return $this->db->insert('devolucionestraslados', $data);
	}

	public function ultimoId(){
		$this->db->select_max('idDevolucionTraslado'); 
		$result = $this->db->get('devolucionestraslados')->row_array();
		return $result['idDevolucionTraslado'];
	}

	public function guardarDetalle($data){
		return $this->db->query("CALL sp_detDevolucionTraslado(?,?,?,?,?,?,?,?)", $data);
	}

	
	public function editar($id, $data){
		$this->db->where("idInventarioDev", $id);
		return $this->db->update("inventariodevoluciones", $data);
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
}