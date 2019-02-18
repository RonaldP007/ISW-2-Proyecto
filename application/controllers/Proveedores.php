<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->model('Proveedores_Model');


  } 

  //envia la informacion a la vista
  public function getProveedores(){

    $data['proveedores'] = $this->Proveedores_Model->ver_proveedores();
    $this->load->view("Proveedores/Proveedores_View", $data);

	}


	 //envia la informacion a la vista de edicion
	 public function Proveedor($id){

    $data['proveedor'] = $this->Proveedores_Model->proveedor($id);
    $this->load->view("Proveedores/Proveedor_Edit", $data);

	}

	 //carga la vista de registro
	 public function registro(){
    $this->load->view("Proveedores/Registrar_Proveedor.php");
  } 


	//guarda el registro de un nuevo PROVEEDOR y valida si el id esta registrada
  public function nuevo_proveedor(){
    
    $id_check= $this->Proveedores_Model->id_check($this->input->post("id"));
    if($id_check){
      $resultado = $this->Proveedores_Model->nuevo_proveedor(
        $this->input->post("nombre"),
				$this->input->post("direccion"),
				$this->input->post("telefono"),
				$this->input->post("correo")
        );
        redirect("Proveedores/getProveedores");
   
    }else{
			$name= $this->input->post("nombre");
			$dir= $this->input->post("direccion");
      $tel=  $this->input->post("telefono");
      $correo=  $this->input->post("correo");
      $mensaje = "Esa id ya esta registrada";
      $clase = "danger";
      $this->session->set_flashdata(array(
        "mensaje" => $mensaje,
        "clase" => $clase,
        "nombre" => $name,
        "direccion" => $dir,
				"telefono" => $tel,
				"correo" => $correo
       
        ));
      redirect("Proveedores/registro");
		}	
	}
	
	//borra un Proveedores
	public function eliminar($id){
    
		$this->Proveedores_Model->eliminar($id);
		redirect("Proveedores/getProveedores");
	 
	}

	//edita un Proveedores
	public function editar($id){
    
		$this->Proveedores_Model->update_proveedor($id);
		redirect("Proveedores/getProveedores");
	 
	}
}
?>
