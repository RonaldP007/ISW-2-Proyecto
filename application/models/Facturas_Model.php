<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Facturas_Model extends CI_model{
  

    public $id_user;
	public $fecha;
	public $productos_nombres;
	public $precios;
    public $cantidades;  
    public $totales;

    public function __construct(){
        $this->load->database();
    }

	//registra la informacion de una nueva factura
	public function new_factura($id_user, $fecha, $productos_nombres, $precios, $cantidades, $totales){

        $this->id_user = $id_user;
        $this->fecha = $fecha;
        $this->productos_nombres = $productos_nombres;
        $this->precios = $precios;
        $this->cantidades = $cantidades;
        $this->totales = $totales;
        
        return $this->db->insert('facturas', $this);
	}
	
	// Carga la informacion de las facturas del usuario
    public function ver_facturas(){

        $this->db->select('*');
        $this->db->from('facturas');
        $result = $this->db->get();

        if(!$result->num_rows() == 1){

            return false;
        }

        return $result->result_array();

	}
	
	//Busca la informacion de una factura
	public function ver_info_factura($id){
	
	$this->db->select('*');
	$this->db->from('facturas');
	$this->db->where('id',$id);

	$result = $this->db->get();

	if(!$result->num_rows() == 1){

		return false;
	}

	return $result->result_array();
	}




}
