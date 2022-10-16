<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include 'barcode.php';

class Asistencia extends CI_Controller {

    public function index()
    { 
        $this->load->View("sistencia");
    }
    public function controlar()
    {
    	$ciestudiante=$_POST['ciestudiante'];
    	$this->db->query("INSERT INTO asistencia(idestudiante) VALUES('$ciestudiante')");
    	$data['mensaje']="Registrado correctamente";
		$this->load->View("sistencia",$data);
    }
 }