<?php
/**
 * Created by PhpStorm.
 * User: Data
 * Date: 09/11/2018
 * Time: 15:47
 */
include 'barcode.php';
class Linea extends CI_Controller
{
    public function index()
    {
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }

        require('fpdf.php');
        $query=$this->db->query("SELECT * FROM inscripcion ");
        $pdf = new FPDF('P','mm','legal');
        $pdf->AddPage();
        $yfoto=0;
        $ycodigo=0;
        foreach ($query->result() as $row){
        $nombre=$this->User->consula('nombre','estudiante','ciestudiante',$row->ciestudiante);
        $delegacion=$this->User->consula('sede','estudiante','ciestudiante',$row->ciestudiante);
        $ci=$row->ci;
        if(file_exists('fotos/'.$row->ciestudiante.'.jpg')){
            $pdf->Image('fotos/'.$row->ciestudiante.'.jpg',142,$yfoto,22,22);
        }else{
            $pdf->Image('fotos/user.jpg',142,$yfoto,22,22);
        }

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(90,0,utf8_decode($nombre),0,0,'L');
        $pdf->Cell(75,0,utf8_decode($delegacion),0,0,'L');
            $pdf->Ln(20);
        barcode('codigos/'.$row->ciestudiante.'.png', $row->ciestudiante, 20, 'horizontal', 'code128', true);
        $pdf->Image('codigos/'.$row->ciestudiante.'.png',165,$ycodigo+5,48,0,'PNG');

        $yfoto=$yfoto+20;
        $ycodigo=$ycodigo+20;
            if($yfoto>300){
                $yfoto=0;
                $pdf->AddPage();
            }
            if($ycodigo>300){
                $ycodigo=0;
            }
        }

        $pdf->Output();
    }
}