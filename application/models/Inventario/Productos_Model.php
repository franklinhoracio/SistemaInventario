<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {

 
	public function listar($estado){
		$this->db->select("p.*, c.categoriaProd, pr.presentacion");
		$this->db->from("productos p");
		$this->db->join('categoriasproductos c', 'p.idCategoria=c.idCategoria');
		$this->db->join('presentaciones pr', 'p.idPresentacion=pr.idPresentacion', 'left');
		$this->db->where("estadoCategoria", "1");
		$this->db->where("estadoProducto", $estado);
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function save($data){
		return $this->db->insert("productos", $data);
	}

	public function getProducto($id){
		$this->db->where("idProducto", $id);
		$resultado=$this->db->get("productos");
		return $resultado->row();
	}
	
	public function actualizar($id, $data){
		$this->db->where("idProducto", $id);
		return $this->db->update("productos", $data);
	}

	public function deshabilitar($id,$data){
		$this->db->where("idProducto", $id);
		return $this->db->update("productos", $data);
	}

	public function buscarPro($valor)
	{
		$this->db->select("p.idProducto as idProducto, p.codigoBarra, CONCAT(producto, ' ', sabores)  as label, pr.idPresentacion as idPresentacion, pr.presentacion as presentacion");
		$this->db->from("productos p");
		$this->db->join('presentaciones pr', 'p.idPresentacion=pr.idPresentacion', 'left');
		$this->db->like("producto",$valor);
		$this->db->or_like("codigoBarra",$valor);
		$this->db->or_like("sabores",$valor);
		$resultado = $this->db->get();
		return $resultado->result_array();
	}

	function buscarProducto($codigo){
	$this->db->where('codigoBarra', $codigo);
	$query = $this->db->get('productos');
	
	return $query->row_array();
}

}