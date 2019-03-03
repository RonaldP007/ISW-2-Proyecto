<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Ventas_Model extends CI_model{
  
	public $id;
	//public $id_usuario;
	public $id_producto;
	public $cantidad;
	//public $total;


	public function __construct(){
		$this->load->database();
	}

	//registra la informacion de un nuevo producto para vender;
	public function nuevo_registro($id_producto, $cantidad){
		$this->id_producto = $id_producto;	
		$this->cantidad = $cantidad;
		
		return $this->db->insert('ventas', $this);
	}


 	// Carga la informacion de los Productos
 	public function ver_ventas(){

		$this->db->select('v.id, v.id_producto, v.cantidad, p.nombre, p.precio');
		$this->db->from('ventas v');
		$this->db->join('productos p', 'v.id_producto = p.id');

		$result = $this->db->get();

		if(!$result->num_rows() == 1){

			return false;
		}

		return $result->result_array();

	}

	//suma una unidad a un elemento del producto
	public function cantidad_Sum($id){

		$this->db->set('cantidad', 'cantidad +1', false);
		$this->db->where('id',$id); 
		$result = $this->db->update('ventas');

	}

	//resta una unidad a un elemento del producto
	public function cantidad_Rest($id){

		$this->db->set('cantidad', 'cantidad -1', false);
		$this->db->where('id',$id); 
		$result = $this->db->update('ventas');
	
	}
	
	//elimina un elemento del producto
	public function eliminar($id){
	
		$this->db->delete("ventas", array("id" => $id));
	
	}


	//elimina todos los elementos en la venta
	public function eliminar_all(){
	
		$this->db->empty_table('ventas'); 
	
	}
	
	



}
