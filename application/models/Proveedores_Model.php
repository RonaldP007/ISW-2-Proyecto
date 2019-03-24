<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Proveedores_Model extends CI_model{

  public $nombre_pv;
  public $direccion;
  public $telefono;
	public $correo;
	public $estado;
  

  public function __construct(){
    $this->load->database();
  }

   //registra la informacion de un nuevo Proveedor;
   public function nuevo_Proveedor($nombre_pv,$direccion,$telefono,$correo,$estado){
		$this->nombre_pv = $nombre_pv;
		$this->direccion = $direccion;
		$this->telefono = $telefono;
		$this->correo = $correo;
		$this->estado = "a";
		
		return $this->db->insert('proveedores', $this);
  }

  // verifica si una id esta registrada
  public function id_check($id){

    $this->db->select('*');
    $this->db->from('proveedores');
    $this->db->where('id',$id);
    $query=$this->db->get();

    if($query->num_rows()>0){
      
      return false;

    }else{

      return true;

    }
  }

     
  // Carga la informacion de los Proveedores
  public function ver_proveedores(){

    $this->db->select('*');
    $this->db->from('proveedores');
    $this->db->where('estado',"a");

    $result = $this->db->get();

    if(!$result->num_rows() == 1){

        return false;
    }

    return $result->result_array();

	}

	// Carga la informacion de un Proveedor
	public function proveedor($id){

    $this->db->select('*');
    $this->db->from('proveedores');
    $this->db->where('id',$id);

    $result = $this->db->get();

    return $result->result_array();

	}


	//Cambia la informacion de un Proveedor
	public function update_proveedor($id){
		$data=array(
			'nombre_pv' => $this->input->post('nombre_pv'),
			'direccion'=> $this->input->post('direccion'),
			'telefono'=> $this->input->post('telefono'),
			'correo'=> $this->input->post('correo')
		);
		
		
    $this->db->where('id',$id);
    return $this->db->update('proveedores',$data);
          
  }
	

	//elimina un Proveedor
	public function eliminar($id){

		$this->db->delete("proveedores", array("id" => $id));
	
	}

		//desactiva de un Proveedor
		public function update_proveedor_desactivar($id){
			$data=array(
				'estado'=> "d",
			);
			
			
			$this->db->where('id',$id);
			return $this->db->update('proveedores',$data);
						
		}
	

}
?>
