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
            <form method="post" action="<?=base_url()?>diario/report">
                <div class="form-group">
                    <label for="fecha">Seleccionar fecha</label>
                    <input type="date" class="form-control" id="fecha" aria-describedby="emailHelp" name="fecha" value="<?=date('Y-m-d')?>">
                    <small id="emailHelp" class="form-text text-muted">Seleccionar la fecha que desea realizar el arqueo </small>
                </div>
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Visualizar</button>
            </form>
        </div>
    </section>

    <!-- end: page -->
</section>