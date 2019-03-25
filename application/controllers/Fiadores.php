<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fiadores extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->model('Fiadores_Model');
		$this->load->model('Clientes_Model');
		$this->load->model('Fact_Credito_Model');

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
		$contador = 0;
		$mensaje = null;
		//solicita los clientes que esten con el id del fiador que se le esta pasando.
		$clientes = $this->Clientes_Model->infoClientes($id);

		if($clientes){
			foreach($clientes as $item){
				$estad_credi = $this->Fact_Credito_Model->estadoCredito($item["cedula"]);

				if($estad_credi){
					foreach($estad_credi as $item2){ $valor = $item2["estado_factura"]; }
				
					if($valor == "p"){
						$contador = $contador + 1;
					}
				}
			}
		}

		if($contador > 0){
			$mensaje = "Tiene creditos que pagar.";
			$this->session->set_flashdata('error_msg', $mensaje);
			$this->getFiadores();
		}
		else{

			$result = $this->Fiadores_Model->update_fiador_desactivar($id); 
			if($result){

				//verifica si hay clientes con el id del fiador que se le esta pasando por parametro.
				if($clientes){
					foreach($clientes as $datos){
						$cedula = $datos["cedula"];
						$nombre = $datos["nombre"];
						$apellidos = $datos["apellidos"];
						$telefono = $datos["telefono"];
						$direccion = $datos["direccion"];
						$fiador = 0;
						$estado = $datos["estado"];

						$this->Clientes_Model->update_cliente_fiador($cedula, $nombre, $apellidos, $telefono, $direccion, $fiador, $estado);					
					}

					$this->getFiadores();
				}
				else{
					$this->getFiadores();
				}			
			}
			else{
				///mensaje de error
				$this->getFiadores();
			}

		}
	}
}
?>
