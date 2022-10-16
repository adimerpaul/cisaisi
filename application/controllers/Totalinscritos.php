<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Totalinscritos extends CI_Controller {

    public function index()
    {
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['css']="";
        $data['title']="INSCRITOS TOTALES";
        $this->load->View("templates/header",$data);
        $this->load->View("total",$data);
        $data['js']="";
        $this->load->View("templates/footer2",$data);
    }
    public function registro(){
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $ciestudiante=$_POST['ciestudiante'];
        $nombre=$_POST['nombre'];
        $celular=$_POST['celular'];
        $email=$_POST['email'];
        $codigo=$_POST['codigo'];
        $tipopago=$_POST['tipopago'];
        $tipo=$_POST['tipo'];
        $carrera=$_POST['carrera'];
        $material=$_POST['material'];
        $certificado=$_POST['certificado'];
        $codigoboleta=$_POST['codigoboleta'];
        //if ($tipopago=="")
        $now = date("Y-m-d H:i:s");
        $date = "2018-11-08 00:00:00";
        if( $now <= $date ){
            if($tipopago=="ESTUDIANTE INTERNO"){
                $monto="200";

            }else{
                $monto="300";
            }
        }else{
            if($tipopago=="ESTUDIANTE INTERNO"){
                $monto="250";
            }else{
                $monto="350";
            }
        }
        $this->db->query("INSERT INTO estudiante VALUES('$ciestudiante','$nombre','$celular','$email','$codigo')");
        $this->db->query("INSERT INTO inscripcion(monto,tipo,codigoboleta,carrera,material,certificado,ci,ciestudiante) VALUES('$monto','$tipo','$codigoboleta','$carrera','$material','$certificado','".$_SESSION['ci']."','$ciestudiante')");
        header("Location: ".base_url()."Inscritos");
    }
    public function boleta($idinscripcion){
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $query=$this->db->query("SELECT * FROM inscripcion");
        $row=$query->row();
        $fecha=$row->fecha;
        $ciestudiante=$row->ciestudiante;
        $nombre=$this->User->consula('nombre','estudiante','ciestudiante',$row->ciestudiante);
        $monto=$row->monto;
        $personal=$this->User->consula('nombre','personal','ci',$_SESSION['ci']);

        require('fpdf.php');
        $pdf = new FPDF('P','mm',array(80,80));
        $pdf->AddPage();
        $pdf->Image('dist/sistemas.png',2,2,12);
        $pdf->Image('dist/informatica.png',68,3,9);
        $pdf->SetFont('Arial','B',9);
        $pdf->Ln(1);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(10,0,utf8_decode(''));
        $pdf->Cell(15,0,utf8_decode('Nro:'));
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




        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('Fecha y hora:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode($fecha));

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('CI:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode($ciestudiante));

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('Estudiante:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode($nombre));

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('Monto:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode($monto." Bs"));


        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('Atendido :'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode($personal));

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('Por concepto inscripción a CISAISI 2018'));
        $pdf->Output();


    }
    public function borrar($idinscirpcion){
        $this->db->query("DELETE FROM inscripcion WHERE idinscripcion='$idinscirpcion'");
        header("Location: ".base_url()."inscritos");
    }

}
