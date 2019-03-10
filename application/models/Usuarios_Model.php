<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Usuarios_Model extends CI_model{
  
  public $cedula;
  public $nombre;
  public $apellidos;
  public $telefono;
  public $direccion;
  public $pass; 
  public $rol;
  

  public function __construct(){
    $this->load->database();
  }

  public function verificarAdmin(){

  }

  //registra la informacion de un nuevo usuario
  public function nuevo_user($cedula, $nombre, $apellidos,$telefono,$direccion,$pass,$rol){
    $this->cedula = $cedula;
    $this->nombre = $nombre;
    $this->apellidos = $apellidos;
    $this->telefono = $telefono;
    $this->direccion = $direccion;
    $this->pass = $pass;
    $this->rol = $rol;
    
    return $this->db->insert('usuarios', $this);
  }


  // verifica si la cedula esta registrada
  public function id_check($cedula){

    $this->db->select('*');
    $this->db->from('usuarios');
    $this->db->where('cedula',$cedula);
    $query=$this->db->get();

    if($query->num_rows()>0){
      
      return false;

    }else{

      return true;

    }
  }
  
  //extrae la cedula y contraseña de un usuario
  public function login_user($id,$pass){

    $this->db->select('*'); 
    $this->db->from('usuarios');
    $this->db->where('cedula',$id);
    $this->db->where('pass',$pass);

    if($query=$this->db->get()){

      return $query->row_array();
    
    }else{

      return false;
    }
	}


  // Carga la informacion de los usuarios
  public function ver_usuarios(){

		$this->db->select('*');
		$this->db->from('usuarios');
		//$this->db->where('id_usuario',$id_usuario);

		$result = $this->db->get();

		if(!$result->num_rows() == 1){

				return false;
		}

		return $result->result_array();

  }

  // Carga la informacion de un usuario
  public function usuario($cedula){

      $this->db->select('*');
      $this->db->from('usuarios');
      $this->db->where('cedula',$cedula);

      $result = $this->db->get();

      return $result->result_array();

  }


  //Cambia la informacion de un usuario 
  public function update_usuario($cedula){
    $data=array(
      'nombre' => $this->input->post('nombre'),
      'apellidos'=> $this->input->post('apellidos'),
      'telefono'=> $this->input->post('telefono'),
      'direccion'=> $this->input->post('direccion')
    );

    if($cedula==0){
      return $this->db->insert('usuarios',$data);
    }else{
      $this->db->where('cedula',$cedula);
      return $this->db->update('usuarios',$data);
    }        
  }


  //elimina un cliente
  public function eliminar($cedula){

    $this->db->delete("usuarios", array("cedula" => $cedula));

  }

  public function validarAdmin(){
    
  }
}

?>
