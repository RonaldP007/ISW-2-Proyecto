<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Fiadores_Model extends CI_model{
  
  public $cedula;
  public $nombre;
  public $apellidos;
  public $telefono;
  public $direccion;


  public function __construct(){
    $this->load->database();
  }

   //registra la informacion de un nuevo Fiador;
   public function nuevo_Fiador($cedula,$nombre,$apellidos,$telefono,$direccion){
		$this->cedula = $cedula;	
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->telefono = $telefono;
		$this->direccion = $direccion;
		
		return $this->db->insert('fiadores', $this);
  }

  // verifica si una cedula esta registrada
  public function cedula_check($cedula){

    $this->db->select('*');
    $this->db->from('fiadores');
    $this->db->where('cedula',$cedula);
    $query=$this->db->get();

    if($query->num_rows()>0){
      
      return false;

    }else{

      return true;

    }
  }

     
    // Carga la informacion de los Fiadores
    public function ver_fiadores(){

        $this->db->select('*');
        $this->db->from('fiadores');
        //$this->db->where('cedula_usuario',$cedula_usuario);

        $result = $this->db->get();

        if(!$result->num_rows() == 1){

            return false;
        }

        return $result->result_array();

	}

	 // Carga la informacion de un Fiador
	 public function fiador($cedula){

        $this->db->select('*');
        $this->db->from('fiadores');
        $this->db->where('cedula',$cedula);

        $result = $this->db->get();

        return $result->result_array();

	}


	//Cambia la informacion de un Fiador
	public function update_fiador($cedula){
		$data=array(
			'nombre' => $this->input->post('nombre'),
			'apellidos' => $this->input->post('apellidos'),
			'telefono'=> $this->input->post('telefono'),
			'direccion'=> $this->input->post('direccion')
		);
		
		if($cedula==0){
			return $this->db->insert('fiadores',$data);
		}else{
			$this->db->where('cedula',$cedula);
			return $this->db->update('fiadores',$data);
		}        
  }
	

	//elimina un Fiador
	public function eliminar($cedula){

		$this->db->delete("fiadores", array("cedula" => $cedula));
	
	}
	

}
?>
