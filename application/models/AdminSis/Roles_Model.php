<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_Model extends CI_Model {

 
	public function listar($estado){
		$this->db->where("estadoRol", $estado);
		$resultado = $this->db->get("roles");
		return $resultado->result();
	}

	public function save($data){
		return $this->db->insert("roles", $data);
	}

	public function getRol($id){
		$this->db->where("idRol", $id);
		$resultado=$this->db->get("roles");
		return $resultado->row();
	}
	
	public function actualizar($id, $data){
		$this->db->where("idRol", $id);
		return $this->db->update("roles", $data);
	}

	public function deshabilitar($id,$data){
		$this->db->where("idRol", $id);
		return $this->db->update("roles", $data);
	}

}