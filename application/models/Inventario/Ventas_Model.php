<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_Model extends CI_Model {

	public function listar(){
		$this->db->select("v.*, d.tipoDocumento, u.usuario, s.sucursal");
		$this->db->from("ventas v");
		$this->db->join('usuarios u', 'v.idUsuario=u.idUsuario');
		$this->db->join('tipodocumentos d', 'v.idTipoDoc=d.idTipoDoc');
		$this->db->join('sucursales s', 'v.idSucursal=s.idSucursal');
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function listar2($id){
		$this->db->select("v.*, d.tipoDocumento, u.usuario, s.sucursal");
		$this->db->from("ventas v");
		$this->db->join('usuarios u', 'v.idUsuario=u.idUsuario');
		$this->db->join('tipodocumentos d', 'v.idTipoDoc=d.idTipoDoc');
		$this->db->join('sucursales s', 'v.idSucursal=s.idSucursal');
		$this->db->where("v.idSucursal", $id);
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function save($data){
		return $this->db->insert('ventas', $data);
	}

	public function ultimoId(){
		$this->db->select_max('idVenta'); 
		$result = $this->db->get('ventas')->row_array();
		return $result['idVenta'];
	}

	public function guardarDetalle($data){
		return $this->db->query("CALL sp_detVenta(?,?,?,?,?,?,?,?)", $data);
	}


	public function getVenta($id){
		$this->db->select("v.*, d.tipoDocumento, u.usuario, CONCAT(e.nombresEmpleado, ' ', e.apellidosEmpleado) AS Nombre, s.sucursal");
		$this->db->from("ventas v");
		$this->db->join('usuarios u', 'v.idUsuario=u.idUsuario');
		$this->db->join('empleados e', 'u.idEmpleado=e.idEmpleado');
		$this->db->join('tipodocumentos d', 'v.idTipoDoc=d.idTipoDoc');
		$this->db->join('sucursales s', 'v.idSucursal=s.idSucursal');
		$this->db->where("idVenta", $id);
		$resultado=$this->db->get();
		return $resultado->row();
	}

	public function getDetalle($id){
		$this->db->select("dv.*, p.idProducto, p.producto, p.sabores, pr.presentacion");
		$this->db->from("detalleventas dv");
		$this->db->join('productos p', 'dv.idProducto=p.idProducto');
		$this->db->join('presentaciones pr', 'pr.idPresentacion=p.idPresentacion', 'left');
		$this->db->where("dv.idVenta", $id);
		$resultado=$this->db->get();
		return $resultado->result();
	}
	
	public function actualizar($id, $data){
		$this->db->where("idVenta", $id);
		return $this->db->update("ventas", $data);
	}

	public function reporteVentas(){
		$this->db->select("dv.*, v.fecha, u.usuario, s.sucursal, p.idProducto, p.producto, p.sabores, pr.presentacion");
		$this->db->from("detalleventas dv");
		$this->db->join('productos p', 'dv.idProducto=p.idProducto');
		$this->db->join('ventas v', 'dv.idVenta=v.idVenta');
		$this->db->join('usuarios u', 'v.idUsuario=u.idUsuario');
		$this->db->join('sucursales s', 'v.idSucursal=s.idSucursal');
		$this->db->join('presentaciones pr', 'pr.idPresentacion=p.idPresentacion', 'left');
		$resultado=$this->db->get();
		return $resultado->result();
	}

	public function getVentasbyDate($fechainicio,$fechafin){
		$this->db->select("dv.*, v.fecha, u.usuario, s.sucursal, p.idProducto, p.producto, p.sabores, pr.presentacion");
		$this->db->from("detalleventas dv");
		$this->db->join('productos p', 'dv.idProducto=p.idProducto');
		$this->db->join('ventas v', 'dv.idVenta=v.idVenta');
		$this->db->join('usuarios u', 'v.idUsuario=u.idUsuario');
		$this->db->join('sucursales s', 'v.idSucursal=s.idSucursal');
		$this->db->join('presentaciones pr', 'pr.idPresentacion=p.idPresentacion', 'left');
		$this->db->where("v.fecha >=",$fechainicio);
		$this->db->where("v.fecha <=",$fechafin);
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function devoVenta($data){
		return $this->db->query("CALL  sp_devVenta(?,?,?,?)", $data);
	}

}