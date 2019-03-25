<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->model('Clientes_Model');  
    $this->load->model('Fact_Credito_Model');

  } 

  //envia la informacion a la vista
  public function getClientes(){

    $data['clientes'] = $this->Clientes_Model->ver_clientes();
    $this->load->view("Clientes/Clientes_View", $data);

	}


	 //envia la informacion a la vista de edicion
	 public function Cliente($cedula){

		$data['cliente'] = $this->Clientes_Model->cliente($cedula);
		$data['fiadores'] = $this->Clientes_Model->ver_fiadores();
    $this->load->view("Clientes/Cliente_Edit", $data);

	}

	 //carga la vista de registro
	 public function registro(){
		$fiadores['fiadores'] = $this->Clientes_Model->ver_fiadores();
    $this->load->view("Clientes/Registrar_Cliente.php",$fiadores);
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
				$this->input->post("direccion"),
				$this->input->post("fiador"),
				$this->input->post("estado") 
        );
        redirect("Clientes/getClientes");
   
    }else{
      $name= $this->input->post("nombre");
      $last= $this->input->post("apellidos");
      $tel=  $this->input->post("telefono");
			$dir= $this->input->post("direccion");
			$fiador= $this->input->post("fiador");
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
    $estad = "pasar";
    $credito = $this->input->post('estado');

    if ($credito === "a"){
      $this->Clientes_Model->update_cliente($cedula);
		  redirect("Clientes/getClientes");
    }
    elseif ($credito === "d") {
      $estado = $this->Fact_Credito_Model->estadoCredito($cedula);//este verifica el estado de creditos
      foreach($estado as $datos){
        $estad = $datos["estado_factura"];
      }
      
      if($estad === "p"){
        $_SESSION['mensaje'] = "pendiente";
        $this->Cliente($cedula);
      }
      elseif($estad === "pasar"){
        $this->Clientes_Model->update_cliente($cedula);
		    redirect("Clientes/getClientes");
      }
    }
	}

  //verifica usuario para ver si existe, tambien si tiene fiador y creditos aprobados.
  public function verificarCliente(){
    $valorusuario = array();
    $estado = array();
    $resultado = "nada";
    $cont_fiador;
    $valor = "";
    $idusuario = $this->input->post("id");
    $valorusuario = $this->Clientes_Model->cliente($idusuario);
    $estado = $this->Fact_Credito_Model->estadoCredito($idusuario);//este verifica el estado de creditos

    if($valorusuario){//verifica si el usuario se encuentra registrado.

      //este foreach recorer la lista para ver si el estado de la facura es pendiente o esta paga
      foreach($estado as $item){ $valor = $item["estado_factura"]; }
      if($valor == "p"){
        $resultado = "pendiente";
      } 

      if($resultado != "pendiente"){
        //este foreach recorer la lista para ver si el cliente tiene fiador
        foreach($valorusuario as $item){ $estado = $item['estado'] ; $fiador = $item['id_fiador']; }

        if($estado == "a"){
          if($fiador != "0"){$cont_fiador = "con_fia";}else{$cont_fiador = "sin_fia";}

          echo $cont_fiador;
        }else{
          echo "deshabi";
        }

      }else{
        echo "p"; //indica que el credito esta pendiente
      }
    }
    else{
      echo "f"; //indica que el usuario no esta registrado 
    }
  }

}
?>
