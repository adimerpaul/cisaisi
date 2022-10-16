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
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">
                <li class="fa fa-user"></li> Nuevo usuario
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Realizar cobro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url()?>Usuario/registro" method="POST">
                                <div class="form-group row">
                                    <label for="ci" class="col-sm-2 col-form-label">ci</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ci" placeholder="ci" required name="ci">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nombre" class="col-sm-2 col-form-label">nombre</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nombre" placeholder="nombre" required name="nombre">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="celular" class="col-sm-2 col-form-label">celular</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="celular" placeholder="celular" required name="celular">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="user" class="col-sm-2 col-form-label">user</label>
                                    <div class="col-sm-10">
                                        <input type="user" class="form-control" id="user" placeholder="user" required name="user">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" placeholder="password" required name="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tipo" class="col-sm-2 col-form-label">tipo</label>
                                    <div class="col-sm-10">
                                        <select name="tipo" id="tipo" class="form-control" >
                                            <option value="">Selecionar..</option>
                                            <option value="ADMIN">ADMIN</option>
                                            <option value="ESTUDIANTE">ESTUDIANTE</option>
                                            <option value="ACREDITADOR">ACREDITADOR</option>
                                        </select>
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
                    <th>CI</th>
                    <th>Nombre</th>
                    <th>User</th>
                    <th>Celular</th>
                    <th>Tipo</th>
                    <th>Opcion</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query=$this->db->query("SELECT * FROM personal  ");
                foreach ($query->result() as $row){
                    echo "<tr class='gradeX'>
                                <td>".$row->ci."</td>
                                <td>".$row->nombre."</td>
                                <td>".$this->User->consula('user','usuario','ci',$row->ci)."</td>
                                <td class='center'>".$row->celular."</td>
                                <td>".$this->User->consula('tipo','usuario','ci',$row->ci)."</td>
                                <td><a href='".base_url()."Usuario/borrar/".$row->ci."' class='borrar' id='myAnchor'><li class='btn btn-sm btn-danger fa fa-warning'></li></a></td>
                            </tr>";
                }
                ?>

                </tbody>
            </table>
            <script>
                var x = document.getElementsByClassName("borrar");
                var i;
                for (i = 0; i < x.length; i++) {
                    x[i].addEventListener("click", function(event){
                        if (!confirm("Seguro de eliminar?")) {
                            event.preventDefault();
                        }
                    });
                }
            </script>
        </div>
    </section>

    <!-- end: page -->
</section>
