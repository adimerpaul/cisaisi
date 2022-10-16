<?php
/**
 * Created by PhpStorm.
 * User: Data
 * Date: 09/11/2018
 * Time: 15:04
 */
include 'barcode.php';
include('phpqrcode/qrlib.php');
class Organizador extends CI_Controller
{
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
        $data['title']="Agregar Expositor";
        $this->load->View("templates/header",$data);
        $this->load->View("organizador",$data);
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

    public function credencial($ci){
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }

        require('fpdf.php');
        $query=$this->db->query("SELECT * FROM organizador WHERE ci_or='$ci'");
        $row=$query->row();
        $nombre=$row->nombre;
        $delegacion=$row->comision;
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


    public function certificado($nombre,$participacion,$ci){
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $nombre=urldecode($nombre);
        $participacion=urldecode($participacion);
        require('fpdf.php');
        $pdf = new FPDF('L','mm','Letter');
        $pdf->AddPage();
        $pdf->Ln(65);
        $pdf->SetFont('Arial','B',25);
        $pdf->Cell(235,0,utf8_decode($nombre),0,0,'C');
        $pdf->Ln(30);
        $pdf->SetFont('Arial','B',25);
        $pdf->Cell(235,0,utf8_decode($participacion),0,0,'C');
        barcode('codigos/'.$ci.'.png', $ci, 20, 'horizontal', 'code128', true);
        $pdf->Image('codigos/'.$ci.'.png',20,150,35,0,'PNG');
        $pdf->Image('codigos/cero.png',20,155,35,0,'PNG');
        $content = $nombre." CISAISI-2018";
        QRcode::png($content,"hola.png",QR_ECLEVEL_L,10,2);
        $pdf->Image('hola.png',220,135,28,0,'PNG');
        $pdf->Output();

    }
}