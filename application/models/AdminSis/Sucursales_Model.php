<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursales_Model extends CI_Model {

 
	public function listar($estado){
		$this->db->select("idSucursal, CONCAT(sucursal, ' ', ubicacion) as sucursal, estadoSucursal");
		$this->db->where("estadoSucursal", $estado);
		$resultado = $this->db->get("sucursales");
		return $resultado->result();
	}

	public function listar2($id){
		$this->db->select("CONCAT(sucursal, ' ', ubicacion) as sucursal, idSucursal, estadoSucursal");
		$this->db->where("idSucursal", $id);
		$resultado = $this->db->get("sucursales");
		return $resultado->row();
	}

	public function save($data){
		return $this->db->insert("sucursales", $data);
	}

	public function getSucursal($id){
		$this->db->where("idSucursal", $id);
		$resultado=$this->db->get("sucursales");
		return $resultado->row();
	}
	
	public function actualizar($id, $data){
		$this->db->where("idSucursal", $id);
		return $this->db->update("sucursales", $data);
	}

	public function deshabilitar($id,$data){
		$this->db->where("idSucursal", $id);
		return $this->db->update("sucursales", $data);
	}

}