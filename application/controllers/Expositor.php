<?php
include 'barcode.php';

class Expositor extends CI_Controller {

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
        $this->load->View("Pexpositor",$data);
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

        $ci_ex=($_POST['CI']);
        $nombre=strtoupper($_POST['nombre']);
        $pais=strtoupper($_POST['pais']);


        $this->db->query("INSERT INTO expositor (nombre,ci_ex,pais,ci) VALUES('$nombre','$ci_ex','$pais','".$_SESSION['ci']."')");
        try {
            $mi_archivo = 'foto';
            $config['upload_path'] = "fotos/";
            $config['file_name'] = $ci_ex;
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
            
          //header("Location: ".base_url()."expositor");
        
        
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

if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }

        $ci_ex=($_POST['CI']);
        $nombre=strtoupper($_POST['nombre']);
        $pais=strtoupper($_POST['pais']);



        $this->db->query("UPDATE inscripcion SET nombre=$nombre,monto2='$monto2',fecha2='$now' WHERE ciestudiante='$ciestudiante'");
        try {
            $mi_archivo = 'foto';
            $config['upload_path'] = "fotos/";
            $config['file_name'] = $ci_ex;
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
        /*
                $pdf->Ln(5);
                $title='FACULTAD NACIONAL DE INGENIERIA';
                $w = $pdf->GetStringWidth($title);
                $pdf->SetX((210-$w)/2);
                $pdf->Cell($w,9,utf8_decode($title));
                $pdf->Ln(5);
                $title='INGENIERIA DE SISTEMAS E INFORMATICA';
                $w = $pdf->GetStringWidth($title);
                $pdf->SetX((210-$w)/2);
                $pdf->Cell($w,9,utf8_decode($title));

                $pdf->Image('dist/informatica.png',180,5,20);
                $pdf->Ln(15);
                $pdf->SetFont('Arial','B',14);
                $title='FORMULARIO DE EQUIPOS VII OLIMPIADA DE PROGRAMACIÓN 2018';
                $w = $pdf->GetStringWidth($title)+6;
                $pdf->SetX((210-$w)/2);
                $pdf->Cell($w,9,utf8_decode($title),1,1,'C');

        */
        barcode('codigos/'.$ciestudiante.'.png', $ciestudiante, 20, 'horizontal', 'code128', true);
        $pdf->Image('codigos/'.$ciestudiante.'.png',17,59,50,0,'PNG');
        $pdf->Output();
    }

    function credencial($ci){
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }

        require('fpdf.php');
        $query=$this->db->query("SELECT * FROM expositor WHERE ci_ex='$ci'");
        $row=$query->row();
        $nombre=$row->nombre;
        $delegacion=$row->pais;

        $pdf = new FPDF('P','mm',array(100,150));

        $pdf->AddPage();
        if(file_exists('fotos/'.$ci.'.jpg')){
            $pdf->Image('fotos/'.$ci.'.jpg',61,47,22,22);
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