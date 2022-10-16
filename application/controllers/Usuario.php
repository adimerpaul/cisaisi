<?php
/**
 * Created by PhpStorm.
 * User: Data
 * Date: 25/10/2018
 * Time: 16:25
 */

class Usuario extends CI_Controller{

    public function index()
    {
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['css']="
        		<!-- Specific Page Vendor CSS -->
                <link rel='stylesheet' href='".base_url()."assets/vendor/select2/select2.css' />
                <link rel='stylesheet' href='".base_url()."assets/vendor/jquery-datatables-bs3/assets/css/datatables.css' />        
                ";
        $data['title']="Controlar usuarios";
        $this->load->View("templates/header",$data);
        $this->load->View("usuario",$data);
        $data['js']="
                <!-- Specific Page Vendor -->
                <script src='".base_url()."assets/vendor/select2/select2.js'></script>
                <script src='".base_url()."assets/vendor/jquery-datatables/media/js/jquery.dataTables.js'></script>
                <script src='".base_url()."assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js'></script>
                <script src='".base_url()."assets/vendor/jquery-datatables-bs3/assets/js/datatables.js'></script>
           		<!-- Examples -->
                <script src='".base_url()."assets/javascripts/tables/examples.datatables.default.js'></script>
                <script src='".base_url()."assets/javascripts/tables/examples.datatables.row.with.details.js'></script>
                <script src='".base_url()."assets/javascripts/tables/examples.datatables.tabletools.js'></script>

            ";
        $this->load->View("templates/footer",$data);
    }
    public function registro(){
        $ci=$_POST['ci'];
        $nombre=$_POST['nombre'];
        $celular=$_POST['celular'];
        $user=$_POST['user'];
        $password=$_POST['password'];
        $tipo=$_POST['tipo'];
        $this->db->query("INSERT INTO personal VALUES('$ci','$nombre','$celular')");
        $this->db->query("INSERT INTO usuario VALUES('$ci','$user','$password','$tipo')");
        header("Location: ".base_url()."Usuario");
    }
    public function borrar($ci){
        $this->db->query("DELETE FROM personal WHERE ci='$ci'");
        header("Location: ".base_url()."Usuario");
    }
}