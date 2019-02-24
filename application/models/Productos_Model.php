<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Productos_Model extends CI_model{
  
  public $id;
  public $nombre;
  public $cantidad;
  public $precio;
  public $id_proveedor;
  

  public function __construct(){
    $this->load->database();
  }

   //registra la informacion de un nuevo Productos;
   public function nuevo_Producto($nombre,$cantidad,$precio,$id_proveedor){
		$this->nombre = $nombre;
		$this->cantidad = $cantidad;
		$this->precio = $precio;
		$this->id_proveedor = $id_proveedor;
		
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

			$this->db->select('p.id,p.nombre,p.cantidad,p.precio,p.id_proveedor,pv.nombre_pv');
			$this->db->from('productos p');
			$this->db->join('proveedores pv', 'p.id_proveedor = pv.id');

        $result = $this->db->get();

        if(!$result->num_rows() == 1){

            return false;
        }

        return $result->result_array();

	}

	 // Carga la informacion de un Productos
	 public function producto($id){

				$this->db->select('p.id,p.nombre,p.cantidad,p.precio,p.id_proveedor,pv.nombre_pv');
				$this->db->from('productos p');
				$this->db->join('proveedores pv', 'p.id_proveedor = pv.id');
        $this->db->where('p.id',$id);

        $result = $this->db->get();

        return $result->result_array();

	}


	//Cambia la informacion de un Producto
	public function update_producto($id){
		$data=array(
			'nombre' => $this->input->post('nombre'),
			'cantidad'=> $this->input->post('cantidad'),
			'precio'=> $this->input->post('precio'),
			'id_proveedor'=> $this->input->post('id_proveedor')
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
