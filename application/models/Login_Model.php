<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function login($usuario){
		$this->db->select("u.*, CONCAT(e.nombresEmpleado, ' ', e.apellidosEmpleado) AS Nombre, e.correo, e.idSucursal, r.rol, c.cargo");
		$this->db->from("usuarios u");
		$this->db->join('empleados e', 'u.idEmpleado=e.idEmpleado');
		$this->db->join('roles r', 'u.idRol=r.idRol');
		$this->db->join('cargos c', 'e.idCargo=c.idCargo');
		$this->db->where("estadoUsuario", "1");
		$this->db->where("usuario", $usuario);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}
		else{
			return false;
		}
	}

}
