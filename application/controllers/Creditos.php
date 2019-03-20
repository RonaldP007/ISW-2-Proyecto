<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creditos extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->model('Fact_Credito_Model');
    $this->load->model('Facturas_Model');
    $this->load->model('Ventas_Model');
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
  }

  //envia la informacion a la vista de Facturas creditos
	public function fact_credito(){
		$data['facturas'] = $this->Fact_Credito_Model->ver_facturas();
		$this->load->view("Facturas_credito/Facturas_Credito", $data);
	}

	//carga la informacion detallada de una factura credito
  public function get_info_factura_cred($id){
    $data['factura'] = $this->Fact_Credito_Model->ver_info_factura($id);
    $this->load->view("Facturas_credito/Factura_detalle_credito", $data);
  }

  //registra la factura credito en facturas pagas y elimina la factura credito
  public function pagarCredito($idFact){
    $credito = [];
    $credito = $this->Fact_Credito_Model->ver_info_factura($idFact);
    foreach($credito as $item){
      $usuario = $item["id_usuario_credi"]; //id_usuario_credi
      $productos = $item["nombre_produc"];//nombre_produc
      $precios_producto = $item["precios_produc"];//precios_produc
      $cantidades_producto = $item["cantidades_produc"];//cantidades_produc
      $total_factura = $item["total_factura"];//total_factura
    }

    date_default_timezone_set("America/Costa_Rica");
		$hoy = date("Y-m-d");

    $insert = $this->Facturas_Model->new_factura($usuario, $hoy, $productos, $precios_producto, $cantidades_producto, $total_factura);
    if($insert){
      $delete = $this->Fact_Credito_Model->deleteCredito($idFact);
      if($delete){
        redirect("Creditos/fact_credito");
      }
    }
  }
}
