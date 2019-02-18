<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Clientes_Model extends CI_model{
  
  public $cedula;
  public $nombre;
  public $apellidos;
  public $telefono;
  public $direccion;
  

  public function __construct(){
    $this->load->database();
  }

   //registra la informacion de un nuevo cliente
   public function nuevo_cliente($cedula, $nombre, $apellidos,$telefono,$direccion){
    $this->cedula = $cedula;
    $this->nombre = $nombre;
    $this->apellidos = $apellidos;
    $this->telefono = $telefono;
    $this->direccion = $direccion;
    
    return $this->db->insert('clientes', $this);
  }

  // verifica si una cedula esta registrada
  public function id_check($cedula){

    $this->db->select('*');
    $this->db->from('clientes');
    $this->db->where('cedula',$cedula);
    $query=$this->db->get();

    if($query->num_rows()>0){
      
      return false;

    }else{

      return true;

    }
  }

     
    // Carga la informacion de los clientes
    public function ver_clientes(){

        $this->db->select('*');
        $this->db->from('clientes');
        //$this->db->where('id_usuario',$id_usuario);

        $result = $this->db->get();

        if(!$result->num_rows() == 1){

            return false;
        }

        return $result->result_array();

	}

	 // Carga la informacion de un cliente
	 public function cliente($cedula){

        $this->db->select('*');
        $this->db->from('clientes');
        $this->db->where('cedula',$cedula);

        $result = $this->db->get();

        return $result->result_array();

	}


	//Cambia la informacion de un cliente
	public function update_cliente($cedula){
		$data=array(
			'nombre' => $this->input->post('nombre'),
			'apellidos'=> $this->input->post('apellidos'),
			'telefono'=> $this->input->post('telefono'),
			'direccion'=> $this->input->post('direccion')
		);
		
		if($cedula==0){
			return $this->db->insert('clientes',$data);
		}else{
			$this->db->where('cedula',$cedula);
			return $this->db->update('clientes',$data);
		}        
  }
	

	//elimina un cliente
	public function eliminar($cedula){

		$this->db->delete("clientes", array("cedula" => $cedula));
	
	}
	

}
?>
