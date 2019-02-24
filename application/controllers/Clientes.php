<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->model('Clientes_Model');


  } 

  //envia la informacion a la vista
  public function getClientes(){

    $data['clientes'] = $this->Clientes_Model->ver_clientes();
    $this->load->view("Clientes/Clientes_View", $data);

	}


	 //envia la informacion a la vista de edicion
	 public function Cliente($cedula){

    $data['cliente'] = $this->Clientes_Model->cliente($cedula);
    $this->load->view("Clientes/Cliente_Edit", $data);

	}

	 //carga la vista de registro
	 public function registro(){
    $this->load->view("Clientes/Registrar_Cliente.php");
  } 


	//guarda el registro de un nuevo cliente y valida si la cedula esta registrada
  public function nuevo_cliente(){
    
    $id_check= $this->Clientes_Model->id_check($this->input->post("cedula"));
    if($id_check){
      $resultado = $this->Clientes_Model->nuevo_cliente(
        $this->input->post("cedula"),
        $this->input->post("nombre"),
        $this->input->post("apellidos"),
        $this->input->post("telefono"),
        $this->input->post("direccion")
        );
        redirect("Clientes/getClientes");
   
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
      redirect("Clientes/registro");
		}	
	}
	
	//borra un cliente
	public function eliminar($cedula){
    
		$this->Clientes_Model->eliminar($cedula);
		redirect("Clientes/getClientes");
	 
	}

	//edita un cliente
	public function editar($cedula){
    
		$this->Clientes_Model->update_cliente($cedula);
		redirect("Clientes/getClientes");
	 
	}

	


}
?>
