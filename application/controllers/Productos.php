<?php
defined('BASEPATH') OR exit('No cantidadect script access allowed');

class Productos extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->model('Productos_Model');


  } 

  //envia la informacion a la vista
  public function getProductos(){

    $data['productos'] = $this->Productos_Model->ver_productos();
    $this->load->view("Productos/Productos_View", $data);

	}


	 //envia la informacion a la vista de edicion
	 public function Producto($id){

    $data['producto'] = $this->Productos_Model->producto($id);
    $this->load->view("Productos/Productos_Edit", $data);

	}

	 //carga la vista de registro
	 public function registro(){
    $this->load->view("Productos/Registrar_Producto.php");
  } 


	//guarda el registro de un nuevo Producto y valida si el id esta registrada
  public function nuevo_producto(){
    
    $id_check= $this->Productos_Model->id_check($this->input->post("id"));
    if($id_check){
      $resultado = $this->Productos_Model->nuevo_producto(
        $this->input->post("nombre"),
				$this->input->post("cantidad"),
				$this->input->post("precio"),
				$this->input->post("proveedor")
        );
        redirect("Productos/getProductos");
   
    }else{
		$name= $this->input->post("nombre");
		$cantidad= $this->input->post("cantidad");
		$tel=  $this->input->post("precio");
		$proveedor=  $this->input->post("proveedor");
		$mensaje = "Esa id ya esta registrada";
		$clase = "danger";
		$this->session->set_flashdata(array(
			"mensaje" => $mensaje,
			"clase" => $clase,
			"nombre" => $name,
			"cantidad" => $cantidad,
			"precio" => $tel,
			"proveedor" => $proveedor
		
			));
			redirect("Productos/registro");
			}	
	}
	
	//borra un Productos
	public function eliminar($id){
    
		$this->Productos_Model->eliminar($id);
		redirect("Productos/getProductos");
	 
	}

	//edita un Productos
	public function editar($id){
    
		$this->Productos_Model->update_producto($id);
		redirect("Productos/getProductos");
	 
	}
}
?>
