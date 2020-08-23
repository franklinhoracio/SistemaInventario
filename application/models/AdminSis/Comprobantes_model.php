<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comprobantes_model extends CI_Model {

 
	public function listar($estado){
		$this->db->where("estadoTipoDoc", $estado);
		$resultado = $this->db->get("tipodocumentos");
		return $resultado->result();
	}

	public function save($data){
		return $this->db->insert("tipodocumentos", $data);
	}

	public function getComprobante($id){
		$this->db->where("idTipoDoc", $id);
		$resultado=$this->db->get("tipodocumentos");
		return $resultado->row();
	}
	
	public function actualizar($id, $data){
		$this->db->where("idTipoDoc", $id);
		return $this->db->update("tipodocumentos", $data);
	}

	public function deshabilitar($id,$data){
		$this->db->where("idTipoDoc", $id);
		return $this->db->update("tipodocumentos", $data);
	}

}