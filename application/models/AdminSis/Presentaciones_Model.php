<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presentaciones_model extends CI_Model {

 
	public function listar($estado){
		$this->db->where("estadoPresentacion", $estado);
		$resultado = $this->db->get("presentaciones");
		return $resultado->result();
	}

	public function save($data){
		return $this->db->insert("presentaciones", $data);
	}

	public function getPresentacion($id){
		$this->db->where("idPresentacion", $id);
		$resultado=$this->db->get("presentaciones");
		return $resultado->row();
	}
	
	public function actualizar($id, $data){
		$this->db->where("idPresentacion", $id);
		return $this->db->update("presentaciones", $data);
	}

	public function deshabilitar($id,$data){
		$this->db->where("idPresentacion", $id);
		return $this->db->update("presentaciones", $data);
	}

}