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
                    <th>Estudiante</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>User</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $suma=0;
                $query=$this->db->query("SELECT * FROM inscripcion ORDER BY fecha DESC ");
                foreach ($query->result() as $row){
                    $suma=$suma+intval(intval($row->monto)+intval($row->monto2));
                    echo "<tr class='gradeX'>
                                <td>".$this->User->consula('nombre','estudiante','ciestudiante',$row->ciestudiante)."</td>
                                <td>".$row->fecha."</td>
                                <td>".intval(intval($row->monto)+intval($row->monto2))."</td>
                                <td>".$this->User->consula('nombre','personal','ci',$row->ci)."</td>
                            </tr>";
                }
                ?>
                </tbody>
            </table>
            <h3>Suma : <?=$suma?></h3>
        </div>
    </section>
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>

            <h2 class="panel-title">INSCRITOS ESTUDIANTES HUANUNI</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none">
                <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>User</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $suma=0;
                $query=$this->db->query("SELECT * FROM inscripcion ORDER BY fecha DESC ");
                foreach ($query->result() as $row){
                    if($this->User->consula('codigo','estudiante','ciestudiante',$row->ciestudiante)=="C"){
                        $suma=$suma+intval(intval($row->monto)+intval($row->monto2));
                        echo "<tr class='gradeX'>
                                <td>".$this->User->consula('nombre','estudiante','ciestudiante',$row->ciestudiante)."</td>
                                <td>".$row->fecha."</td>
                                <td>".intval(intval($row->monto)+intval($row->monto2))."</td>
                                <td>".$this->User->consula('nombre','personal','ci',$row->ci)."</td>
                            </tr>";
                    }
                }
                ?>
                </tbody>
            </table>
            <h3>Suma : <?=$suma?></h3>
        </div>
    </section>
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>

            <h2 class="panel-title">INSCRITOS ESTUDIANTES CHALLAPATA</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none">
                <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>User</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $suma=0;
                $query=$this->db->query("SELECT * FROM inscripcion ORDER BY fecha DESC ");
                foreach ($query->result() as $row){
                    if($this->User->consula('codigo','estudiante','ciestudiante',$row->ciestudiante)=="B"){
                        $suma=$suma+intval(intval($row->monto)+intval($row->monto2));
                        echo "<tr class='gradeX'>
                                <td>".$this->User->consula('nombre','estudiante','ciestudiante',$row->ciestudiante)."</td>
                                <td>".$row->fecha."</td>
                                <td>".intval(intval($row->monto)+intval($row->monto2))."</td>
                                <td>".$this->User->consula('nombre','personal','ci',$row->ci)."</td>
                            </tr>";
                    }
                }
                ?>
                </tbody>
            </table>
            <h3>Suma : <?=$suma?></h3>
        </div>
    </section>

    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>

            <h2 class="panel-title">INSCRITOS ESTUDIANTES ORURO</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none">
                <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>User</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $suma=0;
                $query=$this->db->query("SELECT * FROM inscripcion ORDER BY fecha DESC ");
                foreach ($query->result() as $row){
                    if($this->User->consula('codigo','estudiante','ciestudiante',$row->ciestudiante)=="A"){
                        $suma=$suma+intval(intval($row->monto)+intval($row->monto2));
                        echo "<tr class='gradeX'>
                                <td>".$this->User->consula('nombre','estudiante','ciestudiante',$row->ciestudiante)."</td>
                                <td>".$row->fecha."</td>
                                <td>".intval(intval($row->monto)+intval($row->monto2))."</td>
                                <td>".$this->User->consula('nombre','personal','ci',$row->ci)."</td>
                            </tr>";
                    }
                }
                ?>
                </tbody>
            </table>
            <h3>Suma : <?=$suma?></h3>
        </div>
    </section>

    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>

            <h2 class="panel-title">INSCRITOS EXTERNOS</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none">
                <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>User</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $suma=0;
                $query=$this->db->query("SELECT * FROM inscripcion ORDER BY fecha DESC ");
                foreach ($query->result() as $row){
                    if($this->User->consula('codigo','estudiante','ciestudiante',$row->ciestudiante)!="ORURO" AND
                    $this->User->consula('codigo','estudiante','ciestudiante',$row->ciestudiante)!="CHALLAPATA" AND
                    $this->User->consula('codigo','estudiante','ciestudiante',$row->ciestudiante)!="ORURO" ){
                        $suma=$suma+intval(intval($row->monto)+intval($row->monto2));
                        echo "<tr class='gradeX'>
                                <td>".$this->User->consula('nombre','estudiante','ciestudiante',$row->ciestudiante)."</td>
                                <td>".$row->fecha."</td>
                                <td>".intval(intval($row->monto)+intval($row->monto2))."</td>
                                <td>".$this->User->consula('nombre','personal','ci',$row->ci)."</td>
                            </tr>";
                    }
                }
                ?>
                </tbody>
            </table>
            <h3>Suma : <?=$suma?></h3>
        </div>
    </section>

</section>
