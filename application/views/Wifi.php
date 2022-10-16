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
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                Realizar Registro
            </button>

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
                    <th>CI</th>
                    <th>País</th>
                    <th>Usuario</th>
                    <th>Opciones</th>

                </tr>
                </thead>
                <tbody>
                <?php
                //mysqli_connect("10.10.30.50", "root", "1a2s3d4f5g", "radius");
                /*$query=$this->db->query("SELECT * FROM expositor  ");
                foreach ($query->result() as $row){


                    echo "<tr class='gradeX'>
                                <td>".$row->nombre."</td>
                                <td>".$row->ci_ex." </td>
                                <td >".$row->pais."</td>
                                <td>".$this->User->consula('nombre','personal','ci',$row->ci)."</td>
                                <td>
                                    <a href='".base_url()."Expositor/credencial/".$row->ci_ex."' ><li class='btn btn-sm btn-success fa fa-file'></li></a>

                                 </td>
                            </tr>";
                }*/
                ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- end: page -->
</section>