<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario_Model extends CI_Model {

	public function view($idInventario,$idSucursal){
		$this->db->select("i.*, s.sucursal, ps.producto, ps.sabores, ps.precioCIVA, ps.stockMinimo, ps.codigoBarra, p.presentacion");
		$this->db->from("inventario i");
		$this->db->join("sucursales s","s.idSucursal=i.idSucursal", 'left');
		$this->db->join("productos ps","ps.idProducto=i.idProducto", 'left');
		$this->db->join("presentaciones p","p.idPresentacion=ps.idPresentacion", 'left');
		$this->db->where("s.estadoSucursal", "1");
		$this->db->where("ps.estadoProducto", "1");
		$this->db->where("i.idProducto", $idInventario);
		$this->db->where("s.idSucursal", $idSucursal);
		$this->db->order_by("i.idProducto");
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function listar2($id){
		$this->db->select("i.*, s.sucursal, CONCAT(ps.producto, ' ', ps.sabores) as producto, ps.stockMinimo, ps.codigoBarra, ps.precioCIVA, p.presentacion, ps.idPresentacion");
		$this->db->from("inventario i");
		$this->db->join("sucursales s","s.idSucursal=i.idSucursal");
		$this->db->join("productos ps","i.idProducto=ps.idProducto");
		$this->db->join("presentaciones p","p.idPresentacion=ps.idPresentacion", 'left');
		$this->db->where("s.estadoSucursal", "1");
		$this->db->where("ps.estadoProducto", "1");
		$this->db->where("s.idSucursal", $id);
		$this->db->where("i.existencias >", "0");
		$this->db->group_by("i.idInventario");
		$this->db->order_by("i.idProducto");
		$resultado = $this->db->get();
		return $resultado->result();
	}


	public function inventarioDevoluciones(){
		$this->db->select("i.*, ps.producto, ps.sabores, ps.precioCIVA, sum(i.existencias) as Existencias, sum(i.costoExistencias) as Costo_Existencias,  ps.stockMinimo, p.presentacion");
		$this->db->from("inventariodevoluciones i");
		$this->db->join("productos ps","ps.idProducto=i.idProducto", 'left');
		$this->db->join("presentaciones p","p.idPresentacion=ps.idPresentacion", 'left');
		$this->db->where("ps.estadoProducto", "1");
		$this->db->group_by("i.idProducto");
		$this->db->order_by("i.idInventarioDev", "ASC");
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function buscarInv($id,$valor){
		$this->db->select("i.*, s.sucursal, CONCAT(ps.producto, ' ',ps.sabores) AS label, ps.stockMinimo, p.presentacion, ps.idPresentacion, ps.precioCIVA, c.idCategoria");
		$this->db->from("inventario i");
		$this->db->join("sucursales s","s.idSucursal=i.idSucursal");
		$this->db->join("productos ps","i.idProducto=ps.idProducto");
		$this->db->join("categoriasproductos c","c.idCategoria=ps.idCategoria");
		$this->db->join("presentaciones p","p.idPresentacion=ps.idPresentacion", 'left');
		$this->db->where("s.estadoSucursal", "1");
		$this->db->where("ps.estadoProducto", "1");
		$this->db->where("s.idSucursal", $id);
		$this->db->where("i.existencias >", "0");
		//$this->db->like("producto",$valor);
		$this->db->like("codigoBarra",$valor);
		$this->db->group_by("i.idInventario");
		$this->db->order_by("i.idProducto");
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function listarPorCategoria($id, $idCategoria){
		$this->db->select("i.*, s.sucursal, CONCAT(ps.producto, ' ',ps.sabores) AS Producto, ps.stockMinimo, p.presentacion, ps.idPresentacion, ps.precioCIVA, c.idCategoria");
		$this->db->from("inventario i");
		$this->db->join("sucursales s","s.idSucursal=i.idSucursal");
		$this->db->join("productos ps","i.idProducto=ps.idProducto");
		$this->db->join("categoriasproductos c","c.idCategoria=ps.idCategoria");
		$this->db->join("presentaciones p","p.idPresentacion=ps.idPresentacion", 'left');
		$this->db->where("s.estadoSucursal", "1");
		$this->db->where("ps.estadoProducto", "1");
		$this->db->where("s.idSucursal", $id);
		$this->db->where("ps.idCategoria", $idCategoria);
		$this->db->group_by("i.idInventario");
		$this->db->order_by("i.idProducto");
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function inventarioGeneral(){
		$this->db->select("i.*, ps.producto, ps.sabores, ps.precioCIVA, sum(i.existencias) as Existencias, sum(i.costoExistencias) as Costo_Existencias,  ps.stockMinimo, p.presentacion, s.sucursal");
		$this->db->from("inventario i");
		$this->db->join("sucursales s","s.idSucursal=i.idSucursal", 'left');
		$this->db->join("productos ps","ps.idProducto=i.idProducto", 'left');
		$this->db->join("presentaciones p","p.idPresentacion=ps.idPresentacion", 'left');
		$this->db->where("s.estadoSucursal", "1");
		$this->db->where("ps.estadoProducto", "1");
		$this->db->group_by("i.idProducto");
		$this->db->group_by("i.idSucursal");
		$this->db->order_by("i.idSucursal", "ASC");
		$this->db->order_by("i.idInventario", "ASC");
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function inventarioSucursal($id){
		$this->db->select("i.*, ps.producto, ps.sabores, ps.precioCIVA, sum(i.existencias) as Existencias, sum(i.costoExistencias) as Costo_Existencias,  ps.stockMinimo, p.presentacion, s.sucursal");
		$this->db->from("inventario i");
		$this->db->join("sucursales s","s.idSucursal=i.idSucursal", 'left');
		$this->db->join("productos ps","ps.idProducto=i.idProducto", 'left');
		$this->db->join("presentaciones p","p.idPresentacion=ps.idPresentacion", 'left');
		$this->db->where("s.estadoSucursal", "1");
		$this->db->where("ps.estadoProducto", "1");
		$this->db->where("s.idSucursal", $id);
		$this->db->group_by("i.idProducto");
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function listar($id){
		$this->db->select("i.*, ps.producto, ps.sabores, ps.precioCIVA, sum(i.existencias) as Existencias, sum(i.costoExistencias) as Costo_Existencias,  ps.stockMinimo, ps.codigoBarra, p.presentacion");
		$this->db->from("inventario i");
		$this->db->join("sucursales s","s.idSucursal=i.idSucursal", 'left');
		$this->db->join("productos ps","ps.idProducto=i.idProducto", 'left');
		$this->db->join("presentaciones p","p.idPresentacion=ps.idPresentacion", 'left');
		$this->db->where("s.estadoSucursal", "1");
		$this->db->where("ps.estadoProducto", "1");
		$this->db->where("s.idSucursal", $id);
		$this->db->group_by("i.idProducto");
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function getInventario($id){
		$this->db->select("i.*, CONCAT(ps.producto, ' ',ps.sabores) AS Producto");
		$this->db->from("inventario i");
		$this->db->join("productos ps","ps.idProducto=i.idProducto", 'left');
		$this->db->where("idInventario", $id);
		$resultado=$this->db->get();
		return $resultado->row();
	}

	public function editar($data){
		return $this->db->query("CALL  sp_editInventario(?,?,?)", $data);
	}

	public function cargar($data){
		return $this->db->query("CALL  sp_cargaInventarios(?,?,?,?,?)", $data);
	}

	public function kardex($idProducto, $idSucursal)
	{
		$this->db->select("mi.fechaMovimiento, mi.descripcion, mi.cantEntrada, mi.cUnitEntrada, mi.importeEntrada, mi.cantSalida, mi.cUnitSalida, mi.importeSalida, mi.cantExistencias, mi.cUnitExistencias, mi.importeExistencias");
		$this->db->from("movimientosinventario mi");
		$this->db->join("sucursales b","b.idSucursal=mi.idSucursal", 'left');
		$this->db->join("productos ps","ps.idProducto=mi.idProducto", 'left');
		$this->db->where("mi.idProducto", $idProducto);
		$this->db->where("mi.idSucursal", $idSucursal);
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function kardexPorFecha($idProducto, $idSucursal, $fechainicio, $fechafin)
	{
		$this->db->select("mi.fechaMovimiento, mi.descripcion, mi.cantEntrada, mi.cUnitEntrada, mi.importeEntrada, mi.cantSalida, mi.cUnitSalida, mi.importeSalida, mi.cantExistencias, mi.cUnitExistencias, mi.importeExistencias");
		$this->db->from("movimientosinventario mi");
		$this->db->join("sucursales b","b.idSucursal=mi.idSucursal", 'left');
		$this->db->join("productos ps","ps.idProducto=mi.idProducto", 'left');
		$this->db->where("mi.idProducto", $idProducto);
		$this->db->where("mi.idSucursal", $idSucursal);
		$this->db->where("mi.fechaMovimiento >=", $fechainicio);
		$this->db->where("mi.fechaMovimiento<=", $fechafin);
		$resultado = $this->db->get();
		return $resultado->result();
	}

}