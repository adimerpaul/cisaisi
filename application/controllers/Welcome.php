<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function login(){
	    $user=$_POST['user'];
        $password=$_POST['password'];
	    $query=$this->db->query("SELECT * FROM usuario WHERE user='$user' AND password='$password' AND ( ci='4079598' OR ci='7336199' OR ci='3030' OR ci='11111' OR ci='22222')");
	    if($query->num_rows()==1){
            $row=$query->row();
            //echo $row->ci;
            $_SESSION['nombre']=$this->User->consula("nombre","personal","ci",$row->ci);
            //echo $_SESSION['nombre'];
            $_SESSION['ci']=$this->User->consula("ci","personal","ci",$row->ci);
            $_SESSION['tipo']=$row->tipo;
            $_SESSION['password']=$row->password;
            header("Location: ".base_url()."main");
        }else{
            header("Location: ".base_url()."welcome");
        }
    }
    public function salir(){
	    session_destroy();
	    header("Location: ".base_url());
    }
}
