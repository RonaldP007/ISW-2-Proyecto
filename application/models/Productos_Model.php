<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Productos_Model extends CI_model{
  
  public $id;
  public $nombre;
  public $cantidad;
  public $precio;
  public $proveedor;
  

  public function __construct(){
    $this->load->database();
  }

   //registra la informacion de un nuevo Productos;
   public function nuevo_Producto($nombre,$cantidad,$precio,$proveedor){
		$this->nombre = $nombre;
		$this->cantidad = $cantidad;
		$this->precio = $precio;
		$this->proveedor = $proveedor;
		
		return $this->db->insert('productos', $this);
  }

  // verifica si una id esta registrada
  public function id_check($id){

    $this->db->select('*');
    $this->db->from('productos');
    $this->db->where('id',$id);
    $query=$this->db->get();

    if($query->num_rows()>0){
      
      return false;

    }else{

      return true;

    }
  }

     
    // Carga la informacion de los Productos
    public function ver_productos(){

        $this->db->select('*');
        $this->db->from('productos');
        //$this->db->where('id_usuario',$id_usuario);

        $result = $this->db->get();

        if(!$result->num_rows() == 1){

            return false;
        }

        return $result->result_array();

	}

	 // Carga la informacion de un Productos
	 public function producto($id){

        $this->db->select('*');
        $this->db->from('productos');
        $this->db->where('id',$id);

        $result = $this->db->get();

        return $result->result_array();

	}


	//Cambia la informacion de un Producto
	public function update_producto($id){
		$data=array(
			'nombre' => $this->input->post('nombre'),
			'cantidad'=> $this->input->post('cantidad'),
			'precio'=> $this->input->post('precio'),
			'proveedor'=> $this->input->post('proveedor')
		);
		
		if($id==0){
			return $this->db->insert('productos',$data);
		}else{
			$this->db->where('id',$id);
			return $this->db->update('productos',$data);
		}        
  }
	

	//elimina un Producto
	public function eliminar($id){

		$this->db->delete("productos", array("id" => $id));
	
	}
	
}
?>
