<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_Model extends CI_Model {


	public function listar($estado){
		$this->db->select("u.*, CONCAT(e.nombresEmpleado, ' ', e.apellidosEmpleado) AS Nombre, e.correo, r.rol");
		$this->db->from("usuarios u");
		$this->db->join('empleados e', 'u.idEmpleado=e.idEmpleado');
		$this->db->join('roles r', 'u.idRol=r.idRol');
		$this->db->where("estadoUsuario", $estado);
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function listarTrasnportista($estado){
		$this->db->select("u.*, CONCAT(e.nombresEmpleado, ' ', e.apellidosEmpleado) AS Nombre, e.correo, r.rol");
		$this->db->from("usuarios u");
		$this->db->join('empleados e', 'u.idEmpleado=e.idEmpleado');
		$this->db->join('roles r', 'u.idRol=r.idRol');
		$this->db->where("estadoUsuario", $estado);
		$this->db->where("r.rol", "Transportista");
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function save($dataEmpleado, $dataUsuario){
		$this->db->trans_start();
		$this->db->insert('empleados', $dataEmpleado);
		$dataUsuario['idEmpleado'] = $this->db->insert_id();
		$this->db->insert("usuarios", $dataUsuario);
		$this->db->trans_complete();
		return !$this->db->trans_status() ? false : true;
	}


	public function getUsuario($id){
		$this->db->where("idEmpleado", $id);
		$resultado=$this->db->get("usuarios");
		return $resultado->row();
	}

	public function getEmpleado($id){
		$this->db->where("idEmpleado", $id);
		$resultado=$this->db->get("empleados");
		return $resultado->row();
	}
	
	public function actualizar($id, $data, $dataE){
		$this->db->trans_start();
		$this->db->where("idEmpleado", $id);
		$this->db->update("usuarios", $data);
		$this->db->where("idEmpleado", $id);
		$this->db->update("empleados", $dataE);
		$this->db->trans_complete();
		return !$this->db->trans_status() ? false : true;
	}

	public function deshabilitar($id,$data){
		$this->db->where("idUsuario", $id);
		return $this->db->update("usuarios", $data);
	}

	public function actualizarClave($id,$data){
		$this->db->where("idUsuario", $id);
		return $this->db->update("usuarios", $data);
	}

}