<?php
defined('BASEPATH') OR exit('No cantidadect script access allowed');

class Ventas extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->model('Ventas_Model');
    $this->load->model('Productos_Model', 'productos');

  } 

  //envia la informacion a la vista
	public function index(){
		$data['productos'] = $this->Ventas_Model->ver_ventas();
		$this->load->view("Ventas/Ventas_View", $data);
  }
  
  public function msj($mensaje){

    if($mensaje == "pro"){
      $this->session->set_flashdata('msg_error', 'Este producto no existe.');
    }

    redirect("Ventas/index");
  }

	//guarda el registro de un nuevo Producto y valida si el id esta registrada
	public function nuevo_registro_p(){
    
    $checkProd = $this->productos->id_check($this->input->post("id_producto"));

    if($checkProd){
      $this->msj("pro");
    }
    else{
      $resultado = $this->Ventas_Model->nuevo_registro(
        $this->input->post("id_producto"),
        $this->input->post("cantidad")
        );
        redirect("Ventas/index");
    }
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
