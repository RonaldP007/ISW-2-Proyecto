<?php
defined('BASEPATH') OR exit('No cantidadect script access allowed');

class Ventas extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->model('Ventas_Model');


  } 

  //envia la informacion a la vista
	public function index(){
		$data['productos'] = $this->Ventas_Model->ver_ventas();
		$this->load->view("Ventas/Ventas_View", $data);
	}

	//guarda el registro de un nuevo Producto y valida si el id esta registrada
	public function nuevo_registro_p(){
		
		$resultado = $this->Ventas_Model->nuevo_registro(
		$this->input->post("id_producto"),
		$this->input->post("cantidad")
		);
		redirect("Ventas/index");

	}


	//suma un producto
  public function suma($id){

    $this->Ventas_Model->cantidad_Sum($id);
    redirect("Ventas/index");

  }

  //resta un producto
  public function resta($id){

    $this->Ventas_Model->cantidad_Rest($id);
    redirect("Ventas/index");

  }


  //borra un producto
  public function eliminar($id){
    
    $this->Ventas_Model->eliminar($id);
    redirect("Ventas/index");
 
	}
	
	//borra un producto
  public function eliminar_all(){
    
    $this->Ventas_Model->eliminar_all();
    redirect("Ventas/index");
 
  }

		




}
