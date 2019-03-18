<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creditos extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->model('Fact_Credito_Model');
    $this->load->model('Productos_Model');
    $this->load->model('Ventas_Model');
  }

  public function comprobarCreditos(){
    $usuario = $this->input->post("id");
    $estado = $this->Fact_Credito_Model->estadoCredito($usuario);
    if($estado == 1){
      echo 1;
    }else{
      echo 0;
    }
  }

  public function guardarCredito(){
    $cliente = $this->input->post("user");// id cliente
    $monto = $this->input->post("monto1");//monto a creditar
    $idproductos = $this->input->post("id_producto1"); //
    $nombre_pro = $this->input->post("nombre_pro1"); 
    $precio_pro = $this->input->post("precio_pro1");
    $cantidad_pro = $this->input->post("cantidad_pro1"); 
    $subtotal_pro = $this->input->post("subtotal_pro1"); 
    $total_pro1 = $this->input->post("total_pro1"); 

    //echo var_dump($subtotal_pro);
    $total_deuda = $total_pro1 - $monto;
    if($total_deuda == 0){
      $total_deuda = $total_pro1;
    }
    $this->Fact_Credito_Model->registroCredito($_SESSION['cedula'], $cliente, date("Y-m-d"), implode(";",$nombre_pro), implode(";", $precio_pro), implode(";", $cantidad_pro), $total_pro1, $monto, $total_deuda);
    
    //rebaja el stock de los productos
    for($i = 0; $i < count($idproductos);$i++){
      $stock = $this->Ventas_Model->stock_restar($idproductos[$i],$cantidad_pro[$i]);
    }

    $this->Ventas_Model->eliminar_all();
    /*$valor = $this->Ventas_Model->ver_ventas();
    if($valor != true){
      echo "carro malo";
    }*/
  }
}
