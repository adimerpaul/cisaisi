
<!doctype html>
<html class="fixed">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title><?=$title?></title>

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/stylesheets/theme.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/stylesheets/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/stylesheets/theme-custom.css">

    <!-- Head Libs -->
    <script src="<?=base_url()?>assets/vendor/modernizr/modernizr.js"></script>
    <?=$css?>

</head>
<body>
<section class="body">

    <!-- start: header -->
    <header class="header">
        <div class="logo-container">
            <a href="../" class="logo">
                <img src="<?=base_url()?>assets/images/logo.png" height="35" alt="Porto Admin" />
            </a>
            <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <!-- start: search & user box -->
        <div class="header-right">

            <form action="pages-search-results.html" class="search nav-form">
                <div class="input-group input-search">
                    <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                    <span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
                </div>
            </form>

            <span class="separator"></span>

            <ul class="notifications">
                <li>
                    <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                        <i class="fa fa-bell"></i>
                        <span class="badge">3</span>
                    </a>

                    <div class="dropdown-menu notification-menu">
                        <div class="notification-title">
                            <span class="pull-right label label-default">3</span>
                            Alerts
                        </div>

                        <div class="content">
                            <ul>
                                <li>
                                    <a href="#" class="clearfix">
                                        <div class="image">
                                            <i class="fa fa-thumbs-down bg-danger"></i>
                                        </div>
                                        <span class="title">Server is Down!</span>
                                        <span class="message">Just now</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="clearfix">
                                        <div class="image">
                                            <i class="fa fa-lock bg-warning"></i>
                                        </div>
                                        <span class="title">User Locked</span>
                                        <span class="message">15 minutes ago</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="clearfix">
                                        <div class="image">
                                            <i class="fa fa-signal bg-success"></i>
                                        </div>
                                        <span class="title">Connection Restaured</span>
                                        <span class="message">10/10/2014</span>
                                    </a>
                                </li>
                            </ul>

                            <hr />

                            <div class="text-right">
                                <a href="#" class="view-more">View All</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

            <span class="separator"></span>

            <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                    <figure class="profile-picture">
                        <img src="<?=base_url()?>assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="<?=base_url()?>assets/images/!logged-user.jpg" />
                    </figure>
                    <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                        <span class="name"><?=$_SESSION['nombre']?></span>
                        <span class="role"><?=strtolower ($_SESSION['tipo'])?></span>
                    </div>

                    <i class="fa custom-caret"></i>
                </a>

                <div class="dropdown-menu">
                    <ul class="list-unstyled">
                        <li class="divider"></li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="<?=base_url()?>Welcome/salir"><i class="fa fa-power-off"></i> Salir</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end: search & user box -->
    </header>
    <!-- end: header -->

    <div class="inner-wrapper">
        <!-- start: sidebar -->
        <aside id="sidebar-left" class="sidebar-left">

            <div class="sidebar-header">
                <div class="sidebar-title text-white" style="color: white">
                    Navigation
                </div>
                <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>

            <div class="nano">
                <div class="nano-content">
                    <nav id="menu" class="nav-main" role="navigation">

                        <?php
                        $query=$this->db->query("SELECT * 
                                                    FROM tipomenu 
                                                    INNER JOIN menu ON tipomenu.idmenu=menu.idmenu
                                                    WHERE tipomenu.tipo='".$_SESSION['tipo']."'");

                        foreach ($query->result() as $row){
                            echo "<ul class='nav nav-main'>
                                        <li>
                                            <a href='".base_url()."".$row->url."'>
                                                <i class='fa ".$row->icono."' aria-hidden='true'></i>
                                                <span>".$row->nombre."</span>
                                            </a>
                                        </li>
                                    </ul>";
                        }
                        ?>
                    </nav>


                    <hr class="separator" />

                    <div class="sidebar-widget widget-stats" >
                        <div class="widget-header" >
                            <h6 style="color: white">Registros</h6>
                            <div class="widget-toggle" style="color: white" >+</div>
                        </div>
                        <?php
                        $query=$this->db->query("SELECT count(*) as cantidad FROM usuario WHERE tipo='ADMIN'");
                        $row=$query->row();
                        $cadmin=$row->cantidad;
                        $query=$this->db->query("SELECT count(*) as cantidad FROM usuario WHERE tipo='ESTUDIANTE'");
                        $row=$query->row();
                        $cestudiante=$row->cantidad;
                        $query=$this->db->query("SELECT count(*) as cantidad FROM inscripcion");
                        $row=$query->row();
                        $inscritos=$row->cantidad;
                        ?>
                        <div class="widget-content">
                            <ul>
                                <li>
                                    <span class="stats-title">Adminitradores</span>
                                    <span class="stats-complete"><?=$cadmin?></span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="<?=$cadmin?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$cadmin?>%;">
                                            <span class="sr-only"><?=$cadmin?> Complete</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <span class="stats-title">Estudiantes</span>
                                    <span class="stats-complete"><?=$cestudiante?></span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="<?=$cestudiante?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$cestudiante?>%;">
                                            <span class="sr-only"><?=$cestudiante?> Complete</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <span class="stats-title">Inscritos</span>
                                    <span class="stats-complete"><?=$inscritos?></span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="<?=$inscritos?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$inscritos?>%;">
                                            <span class="sr-only"><?=$inscritos?> Complete</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </aside>
        <!-- end: sidebar -->
