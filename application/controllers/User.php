<?php

class User extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->helper('url');
    $this->load->model('User_model');
    $this->load->library('session');

  } 
  //carga la vista de registro
  public function index(){
    $this->load->view("users/register.php");
  } 

  //carga la vista de login
  public function login(){
    $this->load->view("users/login.php");
  } 

  //guarda el registro de un nuevo usuario y valida si la cedula esta registrada
  public function guardar(){
    
    $id_check= $this->User_model->ID_check($this->input->post("cedula"));
    if($id_check){
      $resultado = $this->User_model->nuevo_user(
        $this->input->post("cedula"),
        $this->input->post("nombre"),
        $this->input->post("apellidos"),
        $this->input->post("telefono"),
        $this->input->post("direccion"),
        md5($this->input->post("pass")),
        $this->input->post("rol")
        );
        redirect("user/login");
   
    }else{
      $name= $this->input->post("nombre");
      $last= $this->input->post("apellidos");
      $tel=  $this->input->post("telefono");
      $dir= $this->input->post("direccion");
      $mensaje = "Esa cedula ya esta registrada";
      $clase = "danger";
      $this->session->set_flashdata(array(
        "mensaje" => $mensaje,
        "clase" => $clase,
        "nombre" => $name,
        "apellidos" => $last,
        "telefono" => $tel,
        "direccion" => $dir,
        ));
      redirect("user/index");
    }

  }

  //realiza el logueo de un usuario
  public function login_user(){
    $user_login=array(

    'cedula'=>$this->input->post('cedula'),
    'pass'=>md5($this->input->post('pass')) 
    );

    $data=$this->User_model->login_user($user_login['cedula'],$user_login['pass']);
    
    if($data){

      $this->session->set_userdata('cedula',$data['cedula']);
      $this->session->set_userdata('nombre',$data['nombre']);
      $this->session->set_userdata('rol',$data['rol']);

      redirect("user/user_view");

    }else{
      
      $this->session->set_flashdata('error_msg', 'Datos Incorrectos');
      $this->load->view("users/login.php");
     

    }
  }

  //cierra la sesion abierta
  public function user_logout(){

    $this->session->sess_destroy();
    redirect('user/login', 'refresh');
  }

  //carga la vista de usuario
  public function user_view(){

    $this->load->view("header_user");
    $this->load->view("users/user_view");
    $this->load->view("footer");
  }
}

?>
