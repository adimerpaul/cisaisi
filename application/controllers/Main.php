<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function index()
    {
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['css']="";
        $data['title']="Main";
        $this->load->View("templates/header",$data);
        $this->load->View("main");
        $data['js']="";
        $this->load->View("templates/footer",$data);
    }

}
