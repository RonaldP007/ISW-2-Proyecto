<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Fact_Credito_Model extends CI_model{

    public $id_usuario_credi;
    public $id_cliente_credito;
	public $fecha_credito;
	public $nombre_produc;
	public $precios_produc;
    public $cantidades_produc;  
    public $total_factura;
    public $total_creditar;
    public $total_adeudado;
    public $estado_factura;

    public function __construct(){
		$this->load->database();
    }
    
    public function registroCredito($id_usuario_credi, $id_cliente_credito, $fecha_credito, $nombre_produc, $precios_produc, $cantidades_produc, $total_factura, $total_creditar, $total_adeudado){
        $this->id_usuario_credi = $id_usuario_credi;
        $this->id_cliente_credito = $id_cliente_credito; 
        $this->fecha_credito = $fecha_credito;
        $this->nombre_produc = $nombre_produc;
        $this->precios_produc = $precios_produc;
        $this->cantidades_produc = $cantidades_produc;
        $this->total_factura = $total_factura;
        $this->total_creditar = $total_creditar;
        $this->total_adeudado = $total_adeudado;
        $this->estado_factura = false;
        
        return $this->db->insert('factura_credito', $this);
    }

    public function estadoCredito($usuario){
        $this->db->select('*');
        $this->db->from('factura_credito'); 
        $this->db->where('id_cliente_credito',$usuario);
        $query=$this->db->get();
    
        if($query->num_rows()>0){
          $valor = 1;
          return $valor;
    
        }else{
          $valor = 0;
          return $valor;
        }
    }
}