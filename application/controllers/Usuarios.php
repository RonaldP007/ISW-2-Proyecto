<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Usuarios_Model');
		$this->load->model('Cuentas_pagar_Model');
		$this->load->library('session');
	
	  } 

  //envia la informacion a la vista
  public function getUsuarios(){

    $data['usuarios'] = $this->Usuarios_Model->ver_usuarios(); 
    $this->load->view("Usuarios/Usuarios_View", $data);

	}


	 //envia la informacion a la vista de edicion
	 public function Usuario($cedula){

    $data['usuarios'] = $this->Usuarios_Model->usuario($cedula);
    $this->load->view("Usuarios/Usuarios_Edit", $data);

	}

	 //carga la vista de registro
	 public function registro(){
    $this->load->view("Usuarios/Registrar_Usuario.php");
  } 


	//guarda el registro de un nuevo usuario y valida si la cedula esta registrada
	public function guardar(){
    
		$id_check= $this->Usuarios_Model->ID_check($this->input->post("cedula"));
		if($id_check){
		  $resultado = $this->Usuarios_Model->nuevo_user(
			$this->input->post("cedula"),
			$this->input->post("nombre"),
			$this->input->post("apellidos"),
			$this->input->post("telefono"),
			$this->input->post("direccion"),
			md5($this->input->post("pass")),
			$this->input->post("rol"),
			$this->input->post("estado") 
			);
			redirect("Usuarios/getUsuarios");
	   
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
		  redirect("Usuarios/registro");
		}
	}
	
	//borra un Usuario
	public function eliminar($cedula){
    
		$this->Usuarios_Model->eliminar($cedula);
		redirect("Usuarios/getUsuarios");
	 
	}

	//edita un Usuario
	public function editar($cedula){
    
		$this->Usuarios_Model->update_usuario($cedula); 
		redirect("Usuarios/getUsuarios");
	 
	}

	public function fechas(){
		date_default_timezone_set("America/Costa_Rica");
		$array_fechas = $this->Cuentas_pagar_Model->ver_info_fecha();
		//var_dump($array_fechas);
		$contador = 0;
		if($array_fechas[0] != false){
			$hoy = date("Y-m-d");
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
			$data['info'] = $contador;
			$this->load->view("header_user");
			$this->load->view("Usuarios/user_view", $data);
			$this->load->view("footer"); 
		}else{
			$data['info'] = $contador;
			$this->load->view("header_user");
			$this->load->view("Usuarios/user_view", $data);
			$this->load->view("footer"); 
		}

	}

	//realiza el logueo de un usuario
	public function login_user(){
		$user_login=array(
	
		'cedula'=>$this->input->post('cedula'),
		'pass'=>md5($this->input->post('pass')) 
		);
	
		$data=$this->Usuarios_Model->login_user($user_login['cedula'],$user_login['pass']); 
		//$info['datos'] = fechas();
		
		if($data){
			if($data["condicion"] === "a"){
				$this->session->set_userdata('cedula',$data['cedula']);
				$this->session->set_userdata('nombre',$data['nombre']);
				$this->session->set_userdata('rol',$data['rol']);
				$this->session->set_userdata('caja',$data['caja_activa']);
				
				//$this->load->view("Usuarios/user_view", $info);
				redirect("Usuarios/fechas");
			}
			else{
				$this->mensajes("Usuario Deshabilitado");
			}
		}
		else{  
		  $this->mensajes('Datos Incorrectos');
		}
	}

	public function mensajes($mjs){
		$this->session->set_flashdata('error_msg', $mjs);
		$this->load->view("header");
		$this->load->view("principal");
		$this->load->view("footer");
	}
	
	//cierra la sesion abierta
	public function user_logout(){ 
		$this->session->sess_destroy();
		redirect('principal/index', 'refresh');
	}

	//carga la vista de usuario
	public function user_view(){
		$this->load->view("header_user");
		$this->load->view("Usuarios/user_view");
		$this->load->view("footer"); 
	}
	
	//carga la vista de login
	public function login(){
		$this->load->view("Usuarios/login.php");
	} 

	public function cambioCaja(){
		$usuario = $this->input->post('usuario'); 
		
		$user_admin = array(
			'cedula'=>$this->input->post('admin'),
			'pass'=>md5($this->input->post('pass')) 
		);

		$datos = $this->Usuarios_Model->login_user($user_admin['cedula'],$user_admin['pass']);
		if($datos){

			if($datos["rol"] === "a"){ 
				$update = $this->Usuarios_Model->updateCaja($usuario);
				if($update){
					echo $_SESSION['caja'] = "0";
				}
				else{
					echo "change_failure";
				}
			}
			elseif($datos["rol"] === "u"){
				echo "admin";
			}
			
		}else{
			echo "fail_user";
		}

	}	


	//desactiva un usuario
	public function desactivar($id){

		$this->Usuarios_Model->update_usuario_desactivar($id); 
		redirect("Usuarios/getUsuarios");
		
	}
}
?>
