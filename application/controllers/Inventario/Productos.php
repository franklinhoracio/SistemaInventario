	<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("AdminSis/Categorias_Model");
		$this->load->model("AdminSis/Presentaciones_Model");
		$this->load->model("Inventario/Productos_Model");
	}

	public function index($estado)
	{
		$data =  array('productos' => $this->Productos_Model->listar($estado), 
			'estado' =>$estado,);
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Productos/listar",$data);
		$this->load->view("layouts/footer");
	}

	public function agregar()
	{
		$data = array('categorias' => $this->Categorias_Model->listar(1),
			'presentaciones' => $this->Presentaciones_Model->listar(1));
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Productos/agregar", $data);
		$this->load->view("layouts/footer");
	}

	public function store()
	{
		$producto = $this->input->post("producto");
		$precio = $this->input->post("precio");
		$codigoBarra = $this->input->post("codigoBarra");
		$stockMinimo = $this->input->post("stockMinimo");
		$presentacion = $this->input->post("presentacion");
		$categoria = $this->input->post("categoria");
		$sabores = $this->input->post("sabores");
		$this->form_validation->set_rules("producto", "producto","required");
		$this->form_validation->set_rules("precio", "precio","required");
		//$this->form_validation->set_rules("codigoBarra", "codigo de barra","required");
		//$this->form_validation->set_rules("stockMinimo", "stock Mínimo","required");
		$this->form_validation->set_rules("presentacion", "presentacion","required");
		$this->form_validation->set_rules("categoria", "categoria","required");
		if ($this->form_validation->run()) {
			$precioSIVA = round($precio / 1.13,2);
			$data = array(
				'producto' => $producto,
				'precioSIVA' => $precioSIVA,
				'precioCIVA' => $precio,
				'codigoBarra' => 0,
				'stockMinimo' => 0,
				'idPresentacion' => $presentacion,
				'idCategoria' => $categoria,
				'estadoProducto' => 1, 
				'sabores' => $sabores 
			);
			if ($this->Productos_Model->save($data)) {
				$this->session->set_flashdata("success", "Se agrego el producto");
				redirect(base_url()."Inventario/Productos/agregar");
			}
			else{
				$this->session->set_flashdata("Error", "No se agrego el producto");
				redirect(base_url()."Inventario/Productos/agregar");
			}

		} 
		else {
			$this->agregar();
		}
	}

	public function add2(){
		$data = $this->input->post();
		$precioSIVA = round($data['precio'] / 1.13,2);
		$data2 = array(
			'producto' => $data['producto'], 
			'precioSIVA' => $precioSIVA, 
			'precioCIVA' => $data['precio'], 
			'idPresentacion' => $data['presentacion'], 
			'idCategoria' => $data['categoria'], 
		);
		$this->Productos_Model->save($data2);
	}

	public function editar($id)
	{
		$data = array('producto' => $this->Productos_Model->getProducto($id),
			'categorias' => $this->Categorias_Model->listar(1),
			'presentaciones' => $this->Presentaciones_Model->listar(1));
		$this->load->view("layouts/header");
		$this->load->view("Inventario/Productos/editar",$data);
		$this->load->view("layouts/footer");
	}

	public function actualizar()
	{
		$codigo = $this->input->post("codigo");
		$producto = $this->input->post("producto");
		$precio = $this->input->post("precio");
		$codigoBarra = $this->input->post("codigoBarra");
		$stockMinimo = $this->input->post("stockMinimo");
		$presentacion = $this->input->post("presentacion");
		$categoria = $this->input->post("categoria");
		$sabores = $this->input->post("sabores");
		$this->form_validation->set_rules("producto", "producto","required");
		$this->form_validation->set_rules("precio", "precio","required");
		//$this->form_validation->set_rules("codigoBarra", "codigo de barra","required");
		//$this->form_validation->set_rules("stockMinimo", "stock Minimo","required");
		$this->form_validation->set_rules("presentacion", "presentacion","required");
		$this->form_validation->set_rules("categoria", "categoria","required");

		if ($this->form_validation->run()) {
			$precioSIVA = round($precio / 1.13,2);
			$data = array(
				'producto' => $producto,
				'precioSIVA' => $precioSIVA,
				'precioCIVA' => $precio,
				'codigoBarra' => $codigoBarra,
				'stockMinimo' => $stockMinimo,
				'idPresentacion' => $presentacion,
				'idCategoria' => $categoria,
				'sabores' => $sabores,
			);
			if ($this->Productos_Model->actualizar($codigo,$data)) {
				$this->session->set_flashdata("success", "Se actualizo el producto");
				redirect(base_url()."Inventario/Productos/index/1");
			}
			else{
				$this->session->set_flashdata("Error", "No se actualizo el producto");
				redirect(base_url()."Inventario/Productos/editar",$codigo);
			}

		} 
		else {
			$this->editar($codigo);
		}
	}

	public function deshabilitar(){
		$id = $this->input->post('id');
		$estado = $this->input->post('estado');
		if ($estado == 1) {
			$data = array(
				'estadoProducto' => "0",
			);
			$this->Productos_Model->deshabilitar($id, $data);
			redirect(base_url()."Inventario/Productos/index/1");
		}else{
			$data = array(
				'estadoProducto' => "1",
			);

			$this->Productos_Model->deshabilitar($id, $data);
			redirect(base_url()."Inventario/Productos/index/0");
		}
		
	}
}
?>