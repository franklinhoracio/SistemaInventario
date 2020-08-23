<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumos_Model extends CI_Model {

	public function listar(){
		$this->db->select("des.*, d.tipoDocumento, u.usuario, s.sucursal");
		$this->db->from("despachos des");
		$this->db->join('usuarios u', 'des.idUsuario=u.idUsuario');
		$this->db->join('tipodocumentos d', 'des.idTipoDoc=d.idTipoDoc');
		$this->db->join('sucursales s', 'des.idSucursal=s.idSucursal');
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function listar2($id){
		$this->db->select("v.*, d.tipoDocumento, u.usuario, s.sucursal");
		$this->db->from("despachos v");
		$this->db->join('usuarios u', 'v.idUsuario=u.idUsuario');
		$this->db->join('tipodocumentos d', 'v.idTipoDoc=d.idTipoDoc');
		$this->db->join('sucursales s', 'v.idSucursal=s.idSucursal');
		$this->db->where("v.idSucursal", $id);
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function save($data){
		return $this->db->insert('despachos', $data);
	}

	public function ultimoId(){
		$this->db->select_max('idDespacho'); 
		$result = $this->db->get('despachos')->row_array();
		return $result['idDespacho'];
	}

	public function guardarDetalle($data){
		return $this->db->query("CALL sp_detalleDespacho(?,?,?,?,?,?,?)", $data);
	}


	public function getDespacho($id){
		$this->db->select("des.*, d.tipoDocumento, u.usuario, CONCAT(e.nombresEmpleado, ' ', e.apellidosEmpleado) AS Nombre, s.sucursal");
		$this->db->from("despachos des");
		$this->db->join('usuarios u', 'des.idUsuario=u.idUsuario');
		$this->db->join('empleados e', 'u.idEmpleado=e.idEmpleado');
		$this->db->join('tipodocumentos d', 'des.idTipoDoc=d.idTipoDoc');
		$this->db->join('sucursales s', 'des.idSucursal=s.idSucursal');
		$this->db->where("idDespacho", $id);
		$resultado=$this->db->get();
		return $resultado->row();
	}

	public function getDetalle($id){
		$this->db->select("dd.*, p.idProducto, p.producto, p.sabores, pr.presentacion");
		$this->db->from("detalledespachos dd");
		$this->db->join('productos p', 'dd.idProducto=p.idProducto');
		$this->db->join('presentaciones pr', 'pr.idPresentacion=p.idPresentacion', 'left');
		$this->db->where("dd.idDespacho", $id);
		$resultado=$this->db->get();
		return $resultado->result();
	}
	
	public function actualizar($id, $data){
		$this->db->where("idDespacho", $id);
		return $this->db->update("despachos", $data);
	}

	public function reporteVentas(){
		$this->db->select("dd.*, d.fecha, u.usuario, s.sucursal, p.idProducto, p.producto, p.sabores, pr.presentacion");
		$this->db->from("detalledespachos dd");
		$this->db->join('productos p', 'dd.idProducto=p.idProducto');
		$this->db->join('despachos d', 'dd.idDespacho=d.idDespacho');
		$this->db->join('usuarios u', 'd.idUsuario=u.idUsuario');
		$this->db->join('sucursales s', 'd.idSucursal=s.idSucursal');
		$this->db->join('presentaciones pr', 'pr.idPresentacion=p.idPresentacion', 'left');
		$resultado=$this->db->get();
		return $resultado->result();
	}

	public function getVentasbyDate($fechainicio,$fechafin){
		$this->db->select("dd.*, d.fecha, u.usuario, s.sucursal, p.idProducto, p.producto, p.sabores, pr.presentacion");
		$this->db->from("detalledespachos dd");
		$this->db->join('productos p', 'dd.idProducto=p.idProducto');
		$this->db->join('despachos d', 'dd.idDespacho=d.idDespacho');
		$this->db->join('usuarios u', 'd.idUsuario=u.idUsuario');
		$this->db->join('sucursales s', 'd.idSucursal=s.idSucursal');
		$this->db->join('presentaciones pr', 'pr.idPresentacion=p.idPresentacion', 'left');
		$this->db->where("d.fecha >=",$fechainicio);
		$this->db->where("d.fecha <=",$fechafin);
		$resultado = $this->db->get();
		return $resultado->result();
	}

}