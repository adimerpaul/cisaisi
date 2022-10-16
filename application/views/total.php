<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/buttons.dataTables.min.css">
<section role="main" class="content-body">
    <header class="page-header">
        <h2><?=$title?></h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Main</span></li>
                <li><span><?=$title?></span></li>
            </ol>

            <a class="sidebar-right-toggle" ><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>

            <h2 class="panel-title"><?=$title?></h2>
            <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>n</th>
                <th>id</th>
                <th>ci</th>
                <th>nombre</th>
                <th>sede</th>
                <th>couta1</th>
                <th>couta2</th>
                <td>credencial</td>
                <td>folder</td>
                <td>boligrafo</td>
                <td>maletin</td>
                <td>certificado</td>
                <td>fiesta</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            $con=0;
            $query=$this->db->query("SELECT i.`idinscripcion` as 'id',i.ciestudiante as 'ci',e.nombre as 'nombre',e.codigo as 'sede',i.monto as 'cuota1',i.monto2 as 'cuota2',
(SELECT COUNT(*) FROM materialinscripcion WHERE idmaterial=2 AND idinscripcion=i.idinscripcion ) as 'credencial', 
(SELECT COUNT(*) FROM materialinscripcion WHERE idmaterial=3 AND idinscripcion=i.idinscripcion ) as 'folder',
(SELECT COUNT(*) FROM materialinscripcion WHERE idmaterial=4 AND idinscripcion=i.idinscripcion ) as 'boligrafo',
(SELECT COUNT(*) FROM materialinscripcion WHERE idmaterial=5 AND idinscripcion=i.idinscripcion ) as 'maletin',
(SELECT COUNT(*) FROM materialinscripcion WHERE idmaterial=6 AND idinscripcion=i.idinscripcion ) as 'cd',
(SELECT COUNT(*) FROM materialinscripcion WHERE idmaterial=7 AND idinscripcion=i.idinscripcion ) as 'certificado',
(SELECT COUNT(*) FROM materialinscripcion WHERE idmaterial=8 AND idinscripcion=i.idinscripcion ) as 'fiesta'
FROM inscripcion i  INNER JOIN estudiante e
on i.ciestudiante=e.ciestudiante");
            
            foreach ($query->result() as $row) {
                $con=$con+1;
                echo "<tr>
                        <td>$con</td>
                        <td>".$row->id."</td>
                        <td>".$row->ci."</td>
                        <td>".$row->nombre."</td>
                        <td>".$row->sede."</td>
                        <td>".$row->cuota1."</td>
                        <td>".$row->cuota2."</td>
                        <td>".$row->credencial."</td>
                        <td>".$row->folder."</td>
                        <td>".$row->boligrafo."</td>
                        <td>".$row->maletin."</td>
                        <td>".$row->certificado."</td>
                        <td>".$row->fiesta."</td>
                    </tr>";
            }
             ?>
            
        </tbody>
    </table>
        </header>
        <div class="panel-body">
        </div>
    </section>

</section>


<script type="text/javascript" src="<?=base_url()?>js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jszip.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/pdfmake.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/vfs_fonts.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend:'copy', attr: { id: 'allan' } }, 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>

