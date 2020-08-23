<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores_Model extends CI_Model {


	public function listar($estado){
		$this->db->select("p.*");
		$this->db->from("proveedores p");
		$this->db->where("estadoProveedor", $estado);
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function save($data){
		return $this->db->insert('proveedores', $data);
	}


	public function getProveedor($id){
		$this->db->where("idProveedor", $id);
		$resultado=$this->db->get("proveedores");
		return $resultado->row();
	}
	
	public function actualizar($id, $data){
		$this->db->where("idProveedor", $id);
		return $this->db->update("proveedores", $data);
	}

	public function deshabilitar($id,$data){
		$this->db->where("idProveedor", $id);
		return $this->db->update("proveedores", $data);
	}

	public function buscarProve($valor)
	{
		$this->db->select("idProveedor, proveedor as label");
		$this->db->from("proveedores");
		$this->db->like("proveedor",$valor);
		$resultado = $this->db->get();
		return $resultado->result_array();
	}

}