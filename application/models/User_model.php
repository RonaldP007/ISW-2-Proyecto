<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class User_model extends CI_model{
  
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

}

?>
