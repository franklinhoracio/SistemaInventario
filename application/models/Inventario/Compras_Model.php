<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras_Model extends CI_Model {


	public function listar(){
		$this->db->select("c.*, d.tipoDocumento, u.usuario, s.sucursal, p.proveedor");
		$this->db->from("compras c");
		$this->db->join('usuarios u', 'c.idUsuario=u.idUsuario');
		$this->db->join('tipodocumentos d', 'c.idTipoDoc=d.idTipoDoc');
		$this->db->join('proveedores p', 'c.idProveedor=p.idProveedor');
		$this->db->join('sucursales s', 'c.idSucursal=s.idSucursal');
		$this->db->order_by("c.fecha");
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function save($data){
		return $this->db->insert('compras', $data);
	}

	public function ultimoId(){
		$this->db->select_max('idCompra'); 
		$result = $this->db->get('compras')->row_array();
		return $result['idCompra'];
	}

	public function guardarDetalle($data){
		return $this->db->query("CALL sp_detCompra(?,?,?,?,?,?,?,?)", $data);
	}


	public function getCompra($id){
		$this->db->select("c.*, d.tipoDocumento, u.usuario, s.sucursal, p.proveedor");
		$this->db->from("compras c");
		$this->db->join('usuarios u', 'c.idUsuario=u.idUsuario');
		$this->db->join('tipodocumentos d', 'c.idTipoDoc=d.idTipoDoc');
		$this->db->join('proveedores p', 'c.idProveedor=p.idProveedor');
		$this->db->join('sucursales s', 'c.idSucursal=s.idSucursal');
		$this->db->where("idCompra", $id);
		$resultado=$this->db->get();
		return $resultado->row();
	}

	public function getDetalle($id){
		$this->db->select("dc.*, p.idProducto, p.producto, p.sabores, pr.presentacion");
		$this->db->from("detallecompras dc");
		$this->db->join('productos p', 'dc.idProducto=p.idProducto');
		$this->db->join('presentaciones pr', 'pr.idPresentacion=p.idPresentacion', 'left');
		$this->db->where("dc.idCompra", $id);
		$resultado=$this->db->get();
		return $resultado->result();
	}
	
	public function actualizar($id, $data){
		$this->db->where("idCompra", $id);
		return $this->db->update("usuarios", $data);
	}

}