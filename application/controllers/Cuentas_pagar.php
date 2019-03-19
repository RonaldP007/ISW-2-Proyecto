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


	public function fechas(){
		date_default_timezone_set("America/Costa_Rica");
		$array_fechas = $this->Cuentas_pagar_Model->ver_info_fecha();
		//var_dump($array_fechas);
		if($array_fechas[0] != false){
			$hoy = date("Y-m-d");
			$contador = 0;
			//echo $hoy;
			$date1 = new DateTime($hoy);	 
			
			foreach($array_fechas as $valores){
				$date2 = new DateTime($valores["fecha_pago"]);
				$diff = $date1->diff($date2);
				$dias = $diff->days;
				if($dias <= 5){
					$contador = $contador + 1;
				}
			}
			//echo $contador;
			return $contador;
			
		}else{
			return false;
		}

	}
	
}
?>
