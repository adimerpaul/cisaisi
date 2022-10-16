<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diario extends CI_Controller {

    public function index()
    {
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['css']="";
        $data['title']="Diario";
        $this->load->View("templates/header",$data);
        $this->load->View("diario");
        $data['js']="";
        $this->load->View("templates/footer",$data);
    }
    public  function report(){
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['css']="";
        $data['title']="Reporte Diario";
        $data['fecha']=$_POST['fecha'];
        $this->load->View("templates/header",$data);
        $this->load->View("report");
        $data['js']="";
        $this->load->View("templates/footer",$data);
    }
    public function boleta($fecha){
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }



        $personal=$this->User->consula('nombre','personal','ci',$_SESSION['ci']);

        $total=0;
        $query=$this->db->query("SELECT * FROM inscripcion WHERE ci='".$_SESSION['ci']."' ORDER BY fecha DESC ");
        foreach ($query->result() as $row){
            if($row->tipo=="BOLETA"){
                $row->monto=0;
            }
            if(substr( $row->fecha,0,10)==$fecha ){
                $total=$total+$row->monto;
            }

        }
        $query=$this->db->query("SELECT * FROM inscripcion WHERE ci2='".$_SESSION['ci']."' ORDER BY fecha DESC ");
        foreach ($query->result() as $row){
            if(substr( $row->fecha2,0,10)==$fecha){
                $total=$total+$row->monto2;
            }

        }

        $this->db->query("INSERT INTO monto(ci,monto) VALUES ('".$_SESSION['ci']."','$total')");





        require('fpdf.php');

        $pdf = new FPDF('P','mm',array(80,250));


        $pdf->AddPage();
        $pdf->Image('dist/sistemas.png',2,2,12);
        $pdf->Image('dist/informatica.png',68,3,9);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(30,0,utf8_decode(''));

        $pdf->Cell(4,0,utf8_decode('N: '));
        $pdf->Cell(28,0,utf8_decode($this->db->insert_id()));
        $pdf->Ln(1);
        $pdf->SetFont('Arial','B',9);
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
        $pdf->Cell(15,0,utf8_decode(''));
        $pdf->Cell(30,0,utf8_decode('REPORTE DIARIO'));

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('Usuario :'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode($personal));

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('Fecha y hora:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode(date("Y-m-d H:i:s")));

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(30,0,utf8_decode('Monto de la fecha:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode(date($fecha)));


        $total=0;
        $query=$this->db->query("SELECT * FROM inscripcion WHERE ci='".$_SESSION['ci']."'    ORDER BY fecha DESC ");
        foreach ($query->result() as $row){
            if($row->tipo=="BOLETA"){
                $row->monto=0;
            }
            if(substr( $row->fecha,0,10)==$fecha ){
                $pdf->Ln(4);
                $pdf->SetFont('Arial','',7);
                $pdf->Cell(55,0,utf8_decode($this->User->consula('nombre','estudiante','ciestudiante',$row->ciestudiante)));
                $pdf->SetFont('Arial','',7);
                $pdf->Cell( 10, 0, utf8_decode($row->monto), 0, 0, 'R' );
                $total=$total+$row->monto;
            }

        }
        $query=$this->db->query("SELECT * FROM inscripcion WHERE ci2='".$_SESSION['ci']."' ORDER BY fecha DESC ");
        foreach ($query->result() as $row){
            if(substr( $row->fecha2,0,10)==$fecha){
                $pdf->Ln(4);
                $pdf->SetFont('Arial','',7);
                $pdf->Cell(55,0,utf8_decode($this->User->consula('nombre','estudiante','ciestudiante',$row->ciestudiante)));
                $pdf->SetFont('Arial','',7);
                $pdf->Cell( 10, 0, utf8_decode($row->monto2), 0, 0, 'R' );
                //$pdf->Cell(20,0,utf8_decode($row->monto2));
                $total=$total+$row->monto2;
            }

        }

        $pdf->Ln(7);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(55,0,utf8_decode('TOTAL'));
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode($total));



        $pdf->Ln(20);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(35,0,utf8_decode('Recibi conforme '));
        $pdf->Cell(25,0,utf8_decode('Entregue conforme'));

        $pdf->Output();
    }
}
