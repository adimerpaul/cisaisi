<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'barcode.php';

class Acreditacion extends CI_Controller {

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
        $data['title']="Acreditacion";
        $this->load->View("templates/header",$data);
        $this->load->View("acreditacion");
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
                <script src='".base_url()."assets/javascripts/acreditacion.js'></script>
            ";
        $this->load->View("templates/footer",$data);
    }
    function entrega(){
        $idinscripcion=$_POST["idinscripcion"];
        $query=$this->db->query("SELECT * FROM material");
        foreach ($query->result() as $row){
            //echo $row->idmaterial." ". isset($_POST[$row->idmaterial])." "."<br>";
            if (isset($_POST[$row->idmaterial])){
                $this->db->query("INSERT INTO materialinscripcion(idinscripcion,idmaterial,ci) VALUES('$idinscripcion','".$row->idmaterial."','".$_SESSION['ci']."')");
            }
        }
    }
    function credencial($ci){
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
        /*$pdf->Ln(1);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(10,0,utf8_decode(''));
        $pdf->Cell(15,0,utf8_decode('Nro:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode(2));
        $pdf->Ln(5);
        $pdf->Cell(4,0,utf8_decode(''));
        $pdf->Cell(28,0,utf8_decode('UNIVERSIDAD TÉCNICA DE ORURO'));
        $pdf->Ln(3);
        $pdf->Cell(2,0,utf8_decode(''));
        $pdf->Cell(30,0,utf8_decode('FACULTAD NACIONAL DE INGENIERIA'));
        $pdf->Ln(3);
        $pdf->Cell(-2,0,utf8_decode(''));
        $pdf->Cell(30,0,utf8_decode('INGENIERIA DE SISTEMAS E INFORMATICA'));
*/
        barcode('codigos/'.$ci.'.png', $ci, 20, 'horizontal', 'code128', true);
        $pdf->Image('codigos/'.$ci.'.png',20,104,48,0,'PNG');
        $pdf->Output();
    }
    public function informe($idinscripcion){
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }

        require('fpdf.php');
        $query=$this->db->query("SELECT * FROM materialinscripcion WHERE idinscripcion='$idinscripcion'");
        $row=$query->row();
        //$nombre=$row->nombre;
        //$delegacion=$row->carrera;
        $pdf = new FPDF('P','mm',array(100,150));
        $pdf->AddPage();
        $pdf->Image('dist/sistemas.png',5,2,12);
        $pdf->Image('dist/informatica.png',75,3,9);
        $pdf->SetFont('Arial','B',9);
        $pdf->Ln(1);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(30,0,utf8_decode(''));
        $pdf->Cell(10,0,utf8_decode('Nro:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode($idinscripcion));
        $pdf->Ln(5);
        $pdf->Cell(4,0,utf8_decode(''));
        $pdf->Cell(28,0,utf8_decode('UNIVERSIDAD TÉCNICA DE ORURO'));
        $pdf->Ln(3);
        $pdf->Cell(2,0,utf8_decode(''));
        $pdf->Cell(30,0,utf8_decode('FACULTAD NACIONAL DE INGENIERIA'));
        $pdf->Ln(3);
        $pdf->Cell(-2,0,utf8_decode(''));
        $pdf->Cell(30,0,utf8_decode('INGENIERIA DE SISTEMAS E INFORMATICA'));
        //$pdf->Image('fotos/'.$ci.'.jpg',61,47,22);
        $pdf->SetFont('Arial','B',10);
        $pdf->Ln(5);
        $pdf->Cell(71,0,utf8_decode("Se entrego en conformidad :"),0,0,'L');
        $pdf->SetFont('Arial','B',10);
        $query=$this->db->query("SELECT * FROM materialinscripcion WHERE idinscripcion='$idinscripcion'");
        $pdf->SetFont('Arial','',10);
        $con=0;
        foreach ($query->result() as $row){
            if( substr($row->fecha,0,10) ==date("Y-m-d")){
                $pdf->Ln(7);
                $con=$con+1;
                $pdf->Cell(50,0,$con." .- ".utf8_decode($this->User->consula('nombre','material','idmaterial',$row->idmaterial)),0,0,'L');
            }
        }
        $pdf->Ln(15);
        $ciestudiante=$this->User->consula('ciestudiante','inscripcion','idinscripcion',$idinscripcion);

        $pdf->SetFont('Arial','',9);

        $pdf->Cell(70,5,utf8_decode(($this->User->consula('nombre','estudiante','ciestudiante',$ciestudiante))),'T',0,'C');
        /*$pdf->Ln(1);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(10,0,utf8_decode(''));
        $pdf->Cell(15,0,utf8_decode('Nro:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode(2));
        $pdf->Ln(5);
        $pdf->Cell(4,0,utf8_decode(''));
        $pdf->Cell(28,0,utf8_decode('UNIVERSIDAD TÉCNICA DE ORURO'));
        $pdf->Ln(3);
        $pdf->Cell(2,0,utf8_decode(''));
        $pdf->Cell(30,0,utf8_decode('FACULTAD NACIONAL DE INGENIERIA'));
        $pdf->Ln(3);
        $pdf->Cell(-2,0,utf8_decode(''));
        $pdf->Cell(30,0,utf8_decode('INGENIERIA DE SISTEMAS E INFORMATICA'));
*/
        $pdf->Output();
    }


}
