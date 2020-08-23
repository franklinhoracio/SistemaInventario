<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {

 
	public function listar($estado){
		$this->db->where("estadoCategoria", $estado);
		$resultado = $this->db->get("categoriasproductos");
		return $resultado->result();
	}

	public function save($data){
		return $this->db->insert("categoriasproductos", $data);
	}

	public function getCategoria($id){
		$this->db->where("idCategoria", $id);
		$resultado=$this->db->get("categoriasproductos");
		return $resultado->row();
	}
	
	public function actualizar($id, $data){
		$this->db->where("idCategoria", $id);
		return $this->db->update("categoriasproductos", $data);
	}

	public function deshabilitar($id,$data){
		$this->db->where("idCategoria", $id);
		return $this->db->update("categoriasproductos", $data);
	}

}