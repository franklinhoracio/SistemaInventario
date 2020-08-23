<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargos_Model extends CI_Model {

 
	public function listar($estado){
		$this->db->where("estadoRol", $estado);
		$resultado = $this->db->get("cargos");
		return $resultado->result();
	}

	public function save($data){
		return $this->db->insert("cargos", $data);
	}

	public function getCargo($id){
		$this->db->where("idCargo", $id);
		$resultado=$this->db->get("cargos");
		return $resultado->row();
	}
	
	public function actualizar($id, $data){
		$this->db->where("idCargo", $id);
		return $this->db->update("cargos", $data);
	}

	public function deshabilitar($id,$data){
		$this->db->where("idCargo", $id);
		return $this->db->update("cargos", $data);
	}

}