<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noinscritos extends CI_Controller {

    public function index()
    {
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['css']="";
        $data['title']="INSCRITOS TOTALES";
        $this->load->View("templates/header",$data);
        $this->load->View("noinscritos",$data);
        $data['js']="";
        $this->load->View("templates/footer2",$data);
    }
}