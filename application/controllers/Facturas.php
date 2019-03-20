<?php
defined('BASEPATH') OR exit('No cantidadect script access allowed');

class Facturas extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->model('Facturas_Model');
		$this->load->model('Ventas_Model'); 
	
	}

	//envia la informacion a la vista
	public function index(){
		$data['facturas'] = $this->Facturas_Model->ver_facturas();
		$this->load->view("Facturas/Facturas_View", $data);
	}

	//carga la informacion de una factura
    public function get_info_factura($id){

        $data['factura'] = $this->Facturas_Model->ver_info_factura($id);
        $this->load->view("Facturas/Factura_detalle_View", $data);

    }









}
