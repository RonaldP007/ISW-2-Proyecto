<?php
class Principal extends CI_Controller{

    public function __construct(){
        parent::__construct();
       
    }

    //carga la vista principal
    public function index(){
        
        $this->load->view("header");
        $this->load->view("principal");
        $this->load->view("footer");
    }

}
?>
