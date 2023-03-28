<?php
$idrol = $this->session->userdata('idrol');
$menu_rol = $this->Usuarios->menu_principal($idrol);
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>SISTEMA INTEGRADO</title>
    
        <script type="text/javascript">
            localStorage.setItem("datofull", 'no')
        </script>

        <link rel="icon" href="<?php echo base_url(); ?>assets/img/intesal.png" type="image/x-png">

        <link href="<?php echo base_url(); ?>assets/fonts/icon.css" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url(); ?>assets/fonts/css.css" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/plugins/node-waves/waves.css" rel="stylesheet" />

        <link href="<?php echo base_url(); ?>assets/plugins/animate-css/animate.css" rel="stylesheet" />

        <link href="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/plugins/multi-select/css/multi-select.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet"/>

        <link href="<?php echo base_url(); ?>assets/plugins/nouislider/nouislider.min.css" rel="stylesheet"/>

        <link  href="<?php echo base_url(); ?>assets/dataTables.bootstrap.min.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/css/themes/all-themes.css" rel="stylesheet" />

        <link href="<?php echo base_url(); ?>assets/fontawesome/css/all.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

        <link href="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/plugins/nestable/jquery-nestable.css" rel="stylesheet" />

        <link href="<?php echo base_url(); ?>assets/plugins/waitme/waitMe.css" rel="stylesheet"/>

        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet"/>

        <link href="<?php echo base_url(); ?>assets/plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/offline-theme-dark.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/offiline_lengua.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/main_css.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/sinconeccion/index.css" rel="stylesheet" >

        <link href="<?php echo base_url(); ?>assets/plugins/morrisjs/morris.css" rel="stylesheet"/>

        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/node-waves/waves.js"></script>

        <script src="<?php echo base_url(); ?>assets/fecha-js/moment.js"></script>

        <script src="<?php echo base_url(); ?>assets/fecha-js/moment-with-locales.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/autosize/autosize.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/pages/forms/basic-form-elements.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/pages/ui/animations.js"></script>       

        <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>    
        <!-- Custom Js -->
        <script src="<?php echo base_url(); ?>assets/js/admin.js"></script>

        <script src="<?php echo base_url(); ?>assets/jquery-ui.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/pages/ui/notifications.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/nestable/jquery.nestable.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
        <!-- Demo Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.bundle.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/pages/charts/chartjs.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/demo.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/jquery-spinner/js/jquery.spinner.js"></script>

        <script src="<?php echo base_url(); ?>assets/offline.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/jquery.slimscroll.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.js"></script>

        <script src="<?php echo base_url(); ?>assets/main_js/js_confis_menu.js"></script>
        
        <script src="<?php echo base_url(); ?>assets/js/pages/ui/tooltips-popovers.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/morrisjs/morris.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/raphael/raphael.min.js">
        </script>

        <script>
                    host = "<?php echo base_url(); ?>"
                    tema = "<?php echo $tema; ?>"
        </script>
    </head>

    <body class="theme-<?php echo $tema; ?>">
        <span class="ir-arriba fa fa-arrow-up animated flipInX"></span>
        <nav class="navbar" style="
             background: -webkit-linear-gradient(<?php echo $barra_superior_1 ?>,<?php echo $barra_superior_2; ?>); 
             background: -o-linear-gradient(<?php echo $barra_superior_1 ?>,<?php echo $barra_superior_2; ?>); 
             background: -moz-linear-gradient(<?php echo $barra_superior_1 ?>,<?php echo $barra_superior_2; ?>); 
             background: linear-gradient(<?php echo $barra_superior_1 ?>,<?php echo $barra_superior_2; ?>);">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>sistema"><img class="img img-thumbnail" src="<?php echo base_url(); ?>assets/img/logo.png" width="100" height="20" alt=" " /></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        
                        <?php if (isset($menu_rol)): ?>

                            <?php $i = 500; foreach ($menu_rol as $m): $i++;?> 
                             <?php
                                $submenu = $this->Usuarios->submenu($m['id_menu'], $idrol);
                                $url = $this->uri->segment(1);
                                $string = "select 
                                menu
                                from gu_menu
                                inner join
                                gu_opcion
                                on gu_opcion.id_menu= gu_menu.id_menu
                                where gu_opcion.url = '$url'
                                group by menu";
                                $r = $this->db->query($string);
                                $r = $r->result();
                                $menu = "";
                                foreach ($r as $key => $value) {
                                    $menu = $value->menu;
                                }

                                if ($m['menu'] == $menu) {
                                    $menu = "active";
                                }
                                ?>
                             <div class="btn-group min-menu" role="group" style="margin-top: 20px;display: none;" >

                                        <button style="background: #FFFFFF50;color:#FFFFFF;" aria-expanded="true" aria-haspopup="true" class="btn waves-effect dropdown-toggle" data-toggle="dropdown" id="<?php echo $i; ?>" type="button">
                                            <i  class="<?php echo $m['icono'] ?>" style="font-size: 12px;"> <?php echo ucwords($m['menu']) ?></i> 
                                            <span class="caret">
                                            </span>
                                        </button>
                                        <ul aria-labelledby="<?php echo $i; ?>" class="dropdown-menu">
                                            <?php foreach ($submenu as $key => $o): ?>
                                              <li>
                                                <a href="<?php echo base_url() . $o['url'] ?>" class=" waves-effect waves-block">
                                                    <?php echo ucwords($o['opcion']) ?>
                                                </a>
                                            </li>  
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                            <?php endforeach ?>                
                        <?php endif ?> 
                        <div class="btn-group user-helper-dropdown min-menu" style="background: white;cursor: pointer;margin-top:20px;display: none;">
                            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="<?php echo base_url(); ?>close_session"><i class="material-icons">input</i>Cerrar sesión</a></li>
                            </ul>
                        </div>
                    </ul>
                    <ul class="nav navbar-nav navbar-left">
                       <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" id="desmen">
                                <i class="material-icons">
                                    swap_horiz
                                </i>
                            </a>
                            <input type="hidden" id="ocuno" value="0">
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
        <!-- #Top Bar -->
        <section>
            <div class="page-loader-wrapper">
                <div class="loader">
                    <div class="preloader">
                        <div class="spinner-layer pl-<?php echo $tema; ?>">
                            <div class="circle-clipper left">
                                <div class="circle">
                                </div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle">
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>
                        Espera...
                    </p>
                </div>
            </div>
            <aside id="leftsidebar" class="sidebar" >
                <!-- User Info -->
                <div class="user-info">
                    <div class="image" align="center">
                        <img src="<?php echo base_url(); ?>assets/tema/<?php echo $foto_usuario; ?>" width="55" height="55" alt=" " />
                    </div>
                    <div class="info-container">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['nombre_completo'] ?></div>
                        <div class="email"><?php echo $_SESSION['usuario'] ?></div>
                        <div class="btn-group user-helper-dropdown">
                            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="<?php echo base_url(); ?>close_session"><i class="material-icons">input</i>Cerrar sesión</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #User Info -->
                <!-- Menu -->
                <div class="menu imgs" >
                    <ul class="list">
                        <li style="
                            background: -webkit-linear-gradient(<?php echo $barra_inferior_1; ?>,<?php echo $barra_inferior_2; ?>); 
                            background: -o-linear-gradient(<?php echo $barra_inferior_1; ?>,<?php echo $barra_inferior_2; ?>); 
                            background: -moz-linear-gradient(<?php echo $barra_inferior_1; ?>,<?php echo $barra_inferior_2; ?>); 
                            background: linear-gradient(<?php echo $barra_inferior_1; ?>,<?php echo $barra_inferior_2; ?>); 
                            color: <?php echo $texto_barra_inferior; ?>;
                            text-align:center;font-family: arial" class="header">PANEL DE NAVEGACIÓN</li>
                            <?php
                            $c = "";
                            if ($this->uri->segment(1) == "sistema") {
                                $c = "active";
                            }
                            ?>
                        <li class="<?php echo $c; ?>">
                            <a href="<?php echo base_url(); ?>sistema">
                                <i class="material-icons">home</i>
                                <span>INICIO</span>
                            </a>
                        </li>
                        
                        <?php if (isset($menu_rol)): ?>
                            <?php foreach ($menu_rol as $m): ?>
                                <?php
                                $submenu = $this->Usuarios->submenu($m['id_menu'], $idrol);


                                $url = $this->uri->segment(1);

                                $string = "select 
                                menu
                                from gu_menu
                                inner join
                                gu_opcion
                                on gu_opcion.id_menu= gu_menu.id_menu
                                where gu_opcion.url = '$url'
                                group by menu";
                                $r = $this->db->query($string);
                                $r = $r->result();
                                $menu = "";
                                foreach ($r as $key => $value) {
                                    $menu = $value->menu;
                                }

                                if ($m['menu'] == $menu) {
                                    $menu = "active";
                                }
                                ?>
                                <li class=" <?php echo $menu; ?>" >
                                    <a href="javascript:void(0);" class="menu-toggle eftfech">
                                        <i class="material-icons bds"><i  class="<?php echo $m['icono'] ?>"></i></i>
                                        <span class=""><p style="font-family: solid;"><?php echo ucwords($m['menu']) ?></p></span>
                                    </a>
                                    <ul class="ml-menu" style="background: #CFD4F320;">
                                        <?php foreach ($submenu as $key => $o): ?>

                                            <?php
                                            $clach = "";
                                            if ($url == $o['url']):
                                                $clach = "active";
                                                ?>

            <?php endif ?>
                                            <li class="eftfec <?php echo $clach; ?>">
                                                <a href="<?php echo base_url() . $o['url'] ?>">
                                                    <span style='font-size:13px;font-family: solid'><?php echo ucwords($o['opcion']) ?></span>
                                                </a>
                                            </li>  
                                <?php endforeach ?>

                                    </ul>
                                </li>
    <?php endforeach ?>

<?php endif ?>

                    </ul>
                </div>
                <!-- #Menu -->
                <!-- Footer -->
                <div class="legal">
                    <div class="copyright">
                        &copy; 2019 - 2019 <a href="javascript:void(0);">ADMINISTRACIÓN</a>
                    </div>
                </div>
                <!-- #Footer -->
            </aside>

        </section>

        <style>
            
            section.content {
                margin: 100px 15px 0 240px;
                -moz-transition: 0.5s;
                -o-transition: 0.5s;
                -webkit-transition: 0.5s;
                transition: 0.5s;
            }

            .ir-arriba {
            display:none;
            padding:20px;
            background:<?php echo $barra_superior_2; ?>;
            font-size:20px;
            color:#fff;
            cursor:pointer;
            position: fixed;
            bottom:20px;
            right:20px;
            z-index: 1;
        }
                    #leftsidebar{
                max-width: 225px 
            }
            .bds{
                font-size: 15px;
            }

            .eftfec:hover{
                background:#BFCEEF20;
            }
            .eftfech:hover{
                background:#A9BDE920;
            }
            .modal-header{
                background: <?php echo $encabezado_modal; ?>; 
                color: <?php echo $texto_modal; ?>;
                font-family: arial;
            }
            
            table thead tr{
                background:  <?php echo $encabezado_tabla ?>;
                color: <?php echo $texto_tabla ?>;
            }
    
            .sidebar .user-info {
                padding: 13px 15px 12px 15px;
                white-space: nowrap;
                position: relative;
                border-bottom: 1px solid #e9e9e9;
                background: url("<?php echo base_url(); ?>assets/tema/<?php echo $foto_banner; ?>");
                height: 135px; 
            }

            .addcla{
                margin:100px 20px 0 20px;
            }

        </style>

        <script>
        
        </script>

        <!--div class="modal animated tada" id="sesion" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-col-black">
                    <div class="modal-header">
                        <h4 class="modal-title" align="center">
                            SESIÓN CADUCADA
                        </h4>
                    </div>
                    <div class="modal-body" align="center">
                        <img class="img img-responsive " src="<?php echo base_url(); ?>assets/img/expiro.jpg" alt="">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-link waves-effect" onclick="aniamas()">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div-->