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


	//envia la informacion a la vista de edicion
	public function Fiador($id){

		$data['fiador'] = $this->Fiadores_Model->Fiador($id);
		$this->load->view("Fiadores/Fiador_Edit", $data);
	
	}
	
	
	
	
	//guarda el registro de un nuevo Fiador y valida si el id esta registrada
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
	
	//edita un Fiadores
	public function editar($id){
	
		$this->Fiadores_Model->update_fiador($id);
		redirect("Fiadores/getFiadores");
		
	}
}
?>
