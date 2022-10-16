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
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>CI</th>
                    <th>País</th>
                    <th>Usuario</th>
                    <th>Opciones</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $query=$this->db->query("SELECT * FROM organizador WHERE ci_or in (select ciestudiante FROM estudiante) OR ci_or='10094169' OR ci_or='8567802' ");
                foreach ($query->result() as $row){
                    echo "<tr class='gradeX'>
                                <td>".$row->nombre."</td>
                                <td>".$row->ci_or." </td>
                                <td >".$row->comision."</td>
                                <td>".$this->User->consula('nombre','personal','ci',$row->ci)."</td>
                                <td>
                                    <a href='".base_url()."Organizador/credencial/".$row->ci_or."' ><li class='btn btn-sm btn-success fa fa-file'></li></a>
                                    <a href='".base_url()."Organizador/certificado/".$row->nombre."/ORGANIZADOR/".$row->ci_or." ' ><li class='btn btn-sm btn-warning fa fa-file-o'></li></a>
                                 </td>
                            </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- end: page -->
</section>