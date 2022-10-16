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
            <!-- Modal -->
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Fecha</th>
                    <th>Tipo Monto</th>
                    <th>Material</th>
                    <th>User</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query=$this->db->query("SELECT * FROM inscripcion WHERE (monto<200 ) ORDER BY fecha DESC ");
                foreach ($query->result() as $row){
                     if($row->monto2+$row->monto<200)
                        echo "<tr class='gradeX'>
                                <td>".$this->User->consula('nombre','estudiante','ciestudiante',$row->ciestudiante)."</td>
                                <td>".$row->fecha."</td>
                                <td>".$row->monto." ".$row->monto2."</td>
                                <td>".$this->User->consula('nombre','personal','ci',$row->ci)."</td>
                                <td>
                                    <a href='".base_url()."inscribir/boleta/".$row->idinscripcion."' ><li class='btn btn-sm btn-success fa fa-file'></li></a>
                                    <li class='btn btn-sm btn-warning fa fa-edit' data-toggle='modal' data-target='#modificar'
                                    data-monto1='".$row->monto."'
                                    data-monto2='".$row->monto2."'
                                    data-ciestudiante='".$row->ciestudiante."'
                                    ></li>
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
<div class="modal fade" id="modificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Realizar cobro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url()?>Deudores/modificar" method="POST" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label for="monto1m" class="col-sm-2 col-form-label">monto1m</label>
                        <input type="text" name="ciestudiante"  id="ciestudiantem" hidden>
                        <div class="col-sm-10">
                            <!--input type="number" min="0" max="250" class="form-control" id="monto1m" placeholder="monto1m" required name="monto1" -->
                            <label id="monto1m"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label id="faltante" hidden></label>
                        <label for="monto2m" class="col-sm-2 col-form-label">monto2m</label>
                        <div class="col-sm-10">
                            <input type="number" min="0" max="250" class="form-control " id="monto2m" placeholder="monto2m"  name="monto2">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <a href="fotos/user.jpg" id="contenedorfotom"><img  src="fotos/user.jpg" id="fotom"  alt="foto" width="200"></a>
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label for="codigoboleta" class="col-sm-2 col-form-label">Fotografia</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control"  name="foto">
                        </div>
                    </div>
                    <div class="form-group row" hidden>
                        <label for="material" class="col-sm-2 col-form-label">material</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="material" placeholder="material" required name="material" value="no">
                        </div>
                    </div>
                    <div class="form-group row" hidden>
                        <label for="certificado" class="col-sm-2 col-form-label">certificado</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="certificado" placeholder="certificado" required name="certificado" value="no">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Modificar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
