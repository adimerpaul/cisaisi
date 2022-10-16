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
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Realizar Registro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url()?>Expositor/registro" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="nombre" class="col-sm-2 col-form-label">nombre</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nombre" placeholder="nombre"  name="nombre">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="CI" class="col-sm-2 col-form-label">CI</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="CI" placeholder="CI" required name="CI">
                                        <small id="mensaje" style="color: red"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="País" class="col-sm-2 col-form-label">Pais</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="País" placeholder="País" required name="pais">
                                    </div>
                                </div>
                                <div class="form-group row" id="contenedor" style="visibility: hidden">
                                    <label for="codigoboleta" class="col-sm-2 col-form-label">codigoboleta</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="codigoboleta" placeholder="codigoboleta" name="codigoboleta">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <a href="fotos/user.jpg" id="contenedorfoto"><img  src="fotos/user.jpg" id="foto"  alt="foto" width="200"></a>
                                    </div>
                                </div>
                                <div class="form-group row" id="contenedor" >
                                    <label for="codigoboleta" class="col-sm-2 col-form-label">Fotografia</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control"  name="foto">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Registrar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    
                    <th>Nombre</th>
                    <th>N</th>
                    <th>CI</th>
                    <th>sede</th>
                    <th>Usuario</th>
                    <th>Opciones</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $con=0;
                $query=$this->db->query("SELECT * FROM inscripcion  ");
                foreach ($query->result() as $row){
                    $con=$con+1;
                    echo "<tr class='gradeX'>

                                <td>".$this->User->consula('nombre','estudiante','ciestudiante',$row->ciestudiante)."</td>
                                <td>$con</td>
                                <td>".$row->ciestudiante." </td>
                                <td>".$this->User->consula('sede','estudiante','ciestudiante',$row->ciestudiante)."</td>
                                
                                <td>".$this->User->consula('nombre','personal','ci',$row->ci)."</td>
                                <td>
                                    <a href='".base_url()."Credencial/Boleta/".$row->ciestudiante."' ><li class='btn btn-sm btn-success fa fa-file'></li></a>
                                    <a href='".base_url()."Organizador/certificado/".$this->User->consula('nombre','estudiante','ciestudiante',$row->ciestudiante)."/ASISTENTE/".$row->ciestudiante." ' ><li class='btn btn-sm btn-warning fa fa-file-o'></li></a>
                                
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
                <h5 class="modal-title" id="exampleModalLabel">Realizar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url()?>inscribir/modificar" method="POST" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label for="Nombre" class="col-sm-2 col-form-label">Nombre</label>

                        <div class="col-sm-10">
                            <input type="text" min="0" max="250" class="form-control" id="Nombre" placeholder="Nombre" required name="nombre">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ci" class="col-sm-2 col-form-label">ci</label>

                        <div class="col-sm-10">
                            <input type="text" min="0" max="250" class="form-control" id="ci" placeholder="ci" required name="ci">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Pais" class="col-sm-2 col-form-label">Pais</label>

                        <div class="col-sm-10">
                            <input type="text" min="0" max="250" class="form-control" id="Pais" placeholder="Pais" required name="Pais">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <a href="fotos/user.jpg" id="contenedorfotom"><img  src="fotos/id_ex.jpg" id="fotom"  alt="foto" width="200"></a>
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label for="codigoboleta" class="col-sm-2 col-form-label">Fotografia</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control"  name="foto">
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