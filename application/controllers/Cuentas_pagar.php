<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas_pagar extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->model('Cuentas_pagar_Model');
	$this->load->model('Proveedores_Model', 'proveedor');

  } 

  //envia la informacion a la vista
 	public function getCuentas_pagar(){

    	$data['Cuentas_pagar'] = $this->Cuentas_pagar_Model->ver_Cuentas_pagar();
    	$this->load->view("Cuentas_pagar/Cuentas_pagar_View", $data);

	}


	//carga la vista de registro
	public function registro(){
		$pro['provedor'] = $this->proveedor->ver_proveedores();
		$this->load->view("Cuentas_pagar/Registrar_Cuentas_pagar.php",$pro);
	} 
	
	
	
	
	//guarda el registro de una nueva cuenta a pagar
	public function nueva_cuenta(){
		
		$resultado = $this->Cuentas_pagar_Model->nueva_cuenta(
		$this->input->post("numero_factura"),
		$this->input->post("proveedor"),
		$this->input->post("monto"),
		$this->input->post("fecha_pago")
		
		);
		redirect("Cuentas_pagar/getCuentas_pagar");
	   
	
	}
		
	//borra una cuenta
	public function eliminar($id){
	
		$this->Cuentas_pagar_Model->eliminar($id);
		redirect("Cuentas_pagar/getCuentas_pagar");
		
	}
	
}
?>
