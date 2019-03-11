<?php
defined('BASEPATH') OR exit('No cantidadect script access allowed');

class Ventas extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->model('Ventas_Model');
		$this->load->model('Productos_Model', 'productos');
		$this->load->model('Facturas_Model');

  } 

  //envia la informacion a la vista
	public function index(){
		$data['productos'] = $this->Ventas_Model->ver_ventas();
		$this->load->view("Ventas/Ventas_View", $data); 
  }
  
  public function msj($mensaje){

    if($mensaje == "pro"){
      $this->session->set_flashdata('msg_error', 'Este producto no existe.');
    }

    redirect("Ventas/index");
  }

	//guarda el registro de un nuevo Producto y valida si el id esta registrada
	public function nuevo_registro_p(){
    
    $checkProd = $this->productos->id_check($this->input->post("id_producto"));

    if($checkProd){
      $this->msj("pro");
    }
    else{
      $resultado = $this->Ventas_Model->nuevo_registro(
        $this->input->post("id_producto"),
        $this->input->post("cantidad")
        );
        redirect("Ventas/index");
    }
	}


	//suma un producto
  public function suma($id){

    $this->Ventas_Model->cantidad_Sum($id);
    redirect("Ventas/index");

  }

  //resta un producto
  public function resta($id){

    $this->Ventas_Model->cantidad_Rest($id);
    redirect("Ventas/index");

  }


  //borra un producto
  public function eliminar($id){
    
    $this->Ventas_Model->eliminar($id);
    redirect("Ventas/index");
 
	}
	
	//borra un producto
  public function eliminar_all(){
    
    $this->Ventas_Model->eliminar_all();
    redirect("Ventas/index");
 
	}
	

	//realiza la compra del contenido con las validaciones correspondientes
  public function comprar($url){
    
    $datos = $url;//obtiene los valores de la url
    $array_url = urldecode($datos);//decodifica los datos
    $data['matriz'] = unserialize($array_url);//deserializa los datos
    $matriz = $data['matriz'];

    $id_producto_array = $matriz[0];        
    $nombre_array = $matriz[1];
    $cantidad_array = $matriz[2];
    $precio_array = $matriz[3];
    $subtotal_array = $matriz[4];
		$total = $matriz[5];
		
		//echo var_dump($total);
    //$total_u;

    //almacenara ia informacion si los productos comprados estan en en stock
    //$producto_fail = array();

   //compara la cantidad de producto que se desea comprar con la cantidad en stock
   /*for($i = 0; $i < count($cantidad_array); $i++){
      $solicitado = $cantidad_array [$i];
      $stock = $this->Carrito_model->stock($id_producto_array[$i]);

      if($solicitado > $stock){//si lo solicitado es mayor al stock se agreaga al array
         $producto_fail[] = $id_producto_array[$i];

      }
   }

    if(count($producto_fail) >0){//carga el carrito de compra para informar que hay productos insuficientes

      $estado = 'p';
      $data['articulos'] = $this->Carrito_model->getCarrito_user($_SESSION['cedula'],$estado);
      $data['total'] = $this->Carrito_model->getTotal($_SESSION['cedula'],$estado);
      $data['id_prod_ins'] = $producto_fail;
      $this->load->view("carrito/carrito_view", $data);

    }else{*///si no hay problema realiza la compra
			
			//Crea la factura de la compra
     // foreach($total as $unid){
        //$total_u = $unid["totales"];
     // }
      $this->Facturas_Model->new_factura($_SESSION['cedula'], date("Y-m-d"), implode(";",$nombre_array), implode(";", $cantidad_array), implode(";", $precio_array), $total);
      
      //cambia el estado de los productos del carrito y rebaja el stock de los productos
    /*  for($i = 0; $i < count($id_car_array);$i++){
        $result = $this->Carrito_model->cambiar_estado($id_car_array[$i]);
        $stock = $this->Carrito_model->stock_restar($id_producto_array[$i],$cantidad_array[$i]);
      }

      redirect("factura/getFacturas");
		} */
	
			$this->Ventas_Model->eliminar_all();
    	redirect("Ventas/index");
  } 

		




}
