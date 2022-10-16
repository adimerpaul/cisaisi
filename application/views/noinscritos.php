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
                <th>ciestudiante</th>
                <th>nombre</th>
                <th>codigo</th>
                <th>carrera</th>
                <th>sede</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $con=0;
            $query=$this->db->query("SELECT * FROM `estudiante` WHERE (`codigo`='A' OR `codigo`='B' OR `codigo`='C') AND ciestudiante not in (SELECT ciestudiante from inscripcion)");
            
            foreach ($query->result() as $row) {
            	$con=$con+1;
                echo "<tr>
                        <td>$con</td>
                        <td>".$row->ciestudiante."</td>
                        <td>".$row->nombre."</td>
                        <td>".$row->codigo."</td>
                        <td>".$row->carrera."</td>
                        <td>".$row->sede."</td>
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

