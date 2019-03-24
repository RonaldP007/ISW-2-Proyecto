<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fiadores extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->model('Fiadores_Model');


  } 

  //envia la informacion a la vista
  public function getFiadores(){

    $data['fiadores'] = $this->Fiadores_Model->ver_fiadores();
    $this->load->view("Fiadores/Fiadores_View", $data);

	}


	 //envia la informacion a la vista de edicion
	 public function Fiador($id){

    $data['fiador'] = $this->Fiadores_Model->Fiador($id);
    $this->load->view("Fiadores/Fiador_Edit", $data);

	}

	 //carga la vista de registro
	 public function registro(){
    $this->load->view("Fiadores/Registrar_Fiador.php");
  } 


	//guarda el registro de un nuevo Fiador y valida si el id esta registrada
  public function nuevo_fiador(){
    
    $id_check= $this->Fiadores_Model->cedula_check($this->input->post("cedula"));
    if($id_check){
      $resultado = $this->Fiadores_Model->nuevo_fiador(
				$this->input->post("cedula"),
				$this->input->post("nombre"),
				$this->input->post("apellidos"),
				$this->input->post("telefono"),
				$this->input->post("direccion"),
				$this->input->post("estado")
				);
				redirect("Fiadores/getFiadores");
   
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
      redirect("Fiadores/registro");
		}	
	}
	
	//borra un Fiadores
	public function eliminar($id){
    
		$this->Fiadores_Model->eliminar($id);
		redirect("Fiadores/getFiadores");
	 
	}

	//edita un Fiadores
	public function editar($id){
    
		$this->Fiadores_Model->update_fiador($id);
		redirect("Fiadores/getFiadores");
	 
	}

	//desactiva un Fiador
	public function desactivar($id){

		$this->Fiadores_Model->update_fiador_desactivar($id); 
		redirect("Fiadores/getFiadores");
		
	}
}
?>
