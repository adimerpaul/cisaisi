<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include 'barcode.php';

class Inscribir extends CI_Controller {

    public function index()
    {
//        if($_SESSION['ci']!="4079598"){
//            header("Location: ".base_url());
//        }
        $data['css']="
        		<!-- Specific Page Vendor CSS -->
                <link rel='stylesheet' href='".base_url()."assets/vendor/select2/select2.css' />
                <link rel='stylesheet' href='".base_url()."assets/vendor/jquery-datatables-bs3/assets/css/datatables.css' />        
                ";
        $data['title']="Realizar inscripcion";
        $this->load->View("templates/header",$data);
        $this->load->View("inscribir",$data);
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
    public function registro(){
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $ciestudiante=($_POST['ciestudiante']);
        $nombre=strtoupper($_POST['nombre']);
        $celular=$_POST['celular'];
        $email=$_POST['email'];
        $codigo=$_POST['codigo'];
        $tipopago=$_POST['tipopago'];
        $tipo=$_POST['tipo'];
        $carrera=strtoupper($_POST['carrera']);
        $material=$_POST['material'];
        $certificado=$_POST['certificado'];
        $codigoboleta=$_POST['codigoboleta'];
        $sede=$_POST['sede'];
        $estudianteinterno=$_POST['estudianteinterno'];
        $monto1=$_POST['monto1'];
        $monto2=$_POST['monto2'];
        /*
        try {
            $mi_archivo = 'foto';
            $config['upload_path'] = "fotos/";
            $config['file_name'] = $ciestudiante;
            $config['allowed_types'] = "*";
            $config['max_size'] = "50000";
            $config['max_width'] = "2000";
            $config['max_height'] = "2000";
            $config['overwrite']=true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($mi_archivo)) {
                //*** ocurrio un error
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();

            }

            $data['uploadSuccess'] = $this->upload->data();
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }*/

        //if ($tipopago=="")
        /*$now = date("Y-m-d H:i:s");
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
        }*/

        if($estudianteinterno==""){
        $this->db->query("INSERT INTO estudiante VALUES('$ciestudiante','$nombre','$celular','$email','$codigo','$carrera','$sede')");
        $this->db->query("INSERT INTO inscripcion(monto,tipo,codigoboleta,material,certificado,ci,ciestudiante,tipopago) VALUES('$monto1','$tipo','$codigoboleta','$material','$certificado','".$_SESSION['ci']."','$ciestudiante','$tipopago')");
        }else{
            if ($monto2=="0" || $monto2==""){
            $this->db->query("UPDATE estudiante SET celular='$celular',correo='$email',codigo='$codigo' WHERE ciestudiante='$ciestudiante'");
            $query=$this->db->query("SELECT * FROM inscripcion WHERE ciestudiante='$ciestudiante'");
            if ($query->num_rows()==0){
                $this->db->query("INSERT INTO inscripcion(monto,tipo,codigoboleta,material,certificado,ci,ciestudiante,tipopago) VALUES('$monto1','$tipo','$codigoboleta','$material','$certificado','".$_SESSION['ci']."','$ciestudiante','$tipopago')");
            }
            }else{
                $this->db->query("UPDATE inscripcion SET monto2='$monto2' WHERE ciestudiante='$ciestudiante'");
            }
        }
        header("Location: ".base_url()."inscribir");
    }
    public  function consulta(){
        $mostrar=$_POST['mostrar'];
        $tabla=$_POST['tabla'];
        $where=$_POST['where'];
        $dato=$_POST['dato'];
        $query=$this->db->query("SELECT $mostrar FROM $tabla WHERE $where='$dato'");
        $row=$query->row();
        echo $row->$mostrar;
    }
    public function modificar(){
        $monto=$_POST['monto1'];
        $monto2=$_POST['monto2'];
        $ciestudiante=$_POST['ciestudiante'];
        $now=date("Y-m-d h:i:s");
        if ($monto2!="" || $monto2!="0")
        $this->db->query("UPDATE inscripcion SET monto=$monto,monto2='$monto2',fecha2='$now' WHERE ciestudiante='$ciestudiante'");
        try {
            $mi_archivo = 'foto';
            $config['upload_path'] = "fotos/";
            $config['file_name'] = $ciestudiante;
            $config['allowed_types'] = "*";
            $config['max_size'] = "50000";
            $config['max_width'] = "2000";
            $config['max_height'] = "2000";
            $config['overwrite']=true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($mi_archivo)) {
                //*** ocurrio un error
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();

            }

            $data['uploadSuccess'] = $this->upload->data();
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
        header("Location: ".base_url()."inscribir");
    }
    public  function consultamonto(){
        $mostrar=$_POST['mostrar'];
        $tabla=$_POST['tabla'];
        $where=$_POST['where'];
        $dato=$_POST['dato'];
        $query=$this->db->query("SELECT $mostrar FROM $tabla WHERE $where='$dato'");
        $row=$query->row();
        echo $row->$mostrar;
    }
    public function boleta($idinscripcion){
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $query=$this->db->query("SELECT * FROM inscripcion WHERE idinscripcion='$idinscripcion'");
        $row=$query->row();
        $fecha=$row->fecha;
        $ciestudiante=$row->ciestudiante;
        $nombre=$this->User->consula('nombre','estudiante','ciestudiante',$row->ciestudiante);
        $monto=$row->monto;
        $monto2=$row->monto2;
        $codigoboleta=$row->codigoboleta;
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
        $pdf->Cell(30,0,utf8_decode(date("Y-m-d H:i:s")));

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('CI:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode($ciestudiante));

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(8,0,utf8_decode('Est.:'));
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(30,0,utf8_decode($nombre));

        if ($codigoboleta!="")
        $codigoboleta="N:".$codigoboleta;

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('Cuota 1:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(10,0,utf8_decode($monto." Bs".$codigoboleta));
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('Cuota 2:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(10,0,utf8_decode($monto2." Bs"));



        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('Atendido :'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode($personal));

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('Por concepto inscripción a CISAISI 2018'));

        barcode('codigos/'.$ciestudiante.'.png', $ciestudiante, 20, 'horizontal', 'code128', true);
        $pdf->Image('codigos/'.$ciestudiante.'.png',17,59,50,0,'PNG');
        $pdf->Output();
    }

}
