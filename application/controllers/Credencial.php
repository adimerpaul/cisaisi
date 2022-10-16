<?php
/**
 * Created by PhpStorm.
 * User: Data
 * Date: 09/11/2018
 * Time: 11:46
 */
include 'barcode.php';
class Credencial extends CI_Controller{
    public function index(){
    if($_SESSION['tipo']==""){
        header("Location: ".base_url());
    }
    $data['css']="
        		<!-- Specific Page Vendor CSS -->
                <link rel='stylesheet' href='".base_url()."assets/vendor/select2/select2.css' />
                <link rel='stylesheet' href='".base_url()."assets/vendor/jquery-datatables-bs3/assets/css/datatables.css' />        
                ";
    $data['title']="Credencial";
    $this->load->View("templates/header",$data);
    $this->load->View("credencial",$data);
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
                <script src='".base_url()."assets/javascripts/inscribir.js'></script>
            ";
    $this->load->View("templates/footer",$data);
}
public function boleta($ci){
    if($_SESSION['tipo']==""){
        header("Location: ".base_url());
    }

    require('fpdf.php');
    $query=$this->db->query("SELECT * FROM estudiante WHERE ciestudiante='$ci'");
    $row=$query->row();
    $nombre=$row->nombre;
    $delegacion=$row->carrera;
    $pdf = new FPDF('P','mm',array(100,150));
    $pdf->AddPage();
    if(file_exists('fotos/'.$ci.'.jpg')){
        $pdf->Image('fotos/'.$ci.'.jpg',61,47,22);
    }else{
        $pdf->Image('fotos/user.jpg',61,47,22);
    }
    $pdf->Ln(65);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(71,0,utf8_decode($nombre),0,0,'C');
    $pdf->Ln(19);
    $pdf->Cell(71,0,utf8_decode($delegacion),0,0,'C');

    barcode('codigos/'.$ci.'.png', $ci, 20, 'horizontal', 'code128', true);
    $pdf->Image('codigos/'.$ci.'.png',20,104,48,0,'PNG');
    $pdf->Output();
}

}