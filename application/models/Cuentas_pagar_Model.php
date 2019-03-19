<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Cuentas_pagar_Model extends CI_model{
  
  public $numero_factura;
  public $id_proveedor;
  public $monto;
  public $fecha_pago;


  public function __construct(){
	$this->load->database();
	
  }

   //registra la informacion de una nueva Cuenta;
   public function nueva_cuenta($numero_factura,$id_proveedor,$monto,$fecha_pago){
		$this->numero_factura = $numero_factura;	
		$this->id_proveedor = $id_proveedor;
		$this->monto = $monto;
		$this->fecha_pago = $fecha_pago;		
		return $this->db->insert('cuentasxpagar', $this);
  }

     
    // Carga la informacion de los cuentasxpagar
    public function ver_Cuentas_pagar(){

		$this->db->select('cp.id,cp.numero_factura,cp.id_proveedor,cp.monto,cp.fecha_pago,pv.nombre_pv');
		$this->db->from('cuentasxpagar cp');
		$this->db->join('proveedores pv', 'cp.id_proveedor = pv.id');

		$result = $this->db->get();

		if(!$result->num_rows() == 1){

			return false;
		}

		return $result->result_array();

	}
	

	//elimina una cuenta a pagar
	public function eliminar($id){

		$this->db->delete("cuentasxpagar", array("id" => $id));
	
	}



	//Busca la informacion de las fechas de  pagos
	public function ver_info_fecha(){
	
		$this->db->select('fecha_pago');
		$this->db->from('cuentasxpagar');
	
		$result = $this->db->get();
	
		if(!$result->num_rows() == 1){
	
			return false;
		}
	
		return $result->result_array();
	}
	

}
?>
