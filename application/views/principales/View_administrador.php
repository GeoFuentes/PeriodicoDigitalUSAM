<section class="content">
    <div class="container-fluid">



        <div class="block-header">
            <h2>
                Accesos directos
            </h2>
        </div>
        <!-- Widgets -->
        <?php if ($idrol == 1 || $idrol == 2) : ?>
            <div class="row clearfix">

                <a href="<?php echo base_url() ?>users">
                    <div class="col-md-2">
                        <div class="info-box bg-<?php echo $tema; ?> hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">
                                    contacts
                                </i>
                            </div>
                            <div class="content">
                                <div class="text">
                                    <b>
                                        <p>Usuarios</p>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="<?php echo base_url() ?>permissions_roles">
                    <div class="col-md-2">
                        <div class="info-box bg-<?php echo $tema; ?> hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">
                                    no_encryption
                                </i>
                            </div>
                            <div class="content">
                                <div class="text">
                                    <b>
                                        <p>Permisos</p>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="<?php echo base_url() ?>log_of_session">
                    <div class="col-md-2">
                        <div class="info-box bg-<?php echo $tema; ?> hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">
                                    sync
                                </i>
                            </div>
                            <div class="content">
                                <div class="text">
                                    <b>
                                        <p>Sesiones</p>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="<?php echo base_url() ?>log_of_actions">
                    <div class="col-md-2">
                        <div class="info-box bg-<?php echo $tema; ?> hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">
                                    border_color
                                </i>
                            </div>
                            <div class="content">
                                <div class="text">
                                    <b>
                                        <p>Acciones</p>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="<?php echo base_url() ?>noticia_admin">
                    <div class="col-md-2">
                        <div class="info-box bg-<?php echo $tema; ?> hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">
                                    receipt
                                </i>
                            </div>
                            <div class="content">
                                <div class="text">
                                    <b>
                                        <p>Noticias</p>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="<?php echo base_url() ?>edicion_admin">
                    <div class="col-md-2">
                        <div class="info-box bg-<?php echo $tema; ?> hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">
                                    folder
                                </i>
                            </div>
                            <div class="content">
                                <div class="text">
                                    <b>
                                        <p>EDICIONES</p>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="<?php echo base_url() ?>carrousel">
                    <div class="col-md-2">
                        <div class="info-box bg-<?php echo $tema; ?> hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">
                                    layers
                                </i>
                            </div>
                            <div class="content">
                                <div class="text">
                                    <b>
                                        <p>CARROUSEL</p>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        <?php endif; ?>
        <?php if ($idrol == 4) : ?>
            <div class="row clearfix">
                <a href="<?php echo base_url() ?>noticia_admin">
                    <div class="col-md-2">
                        <div class="info-box bg-<?php echo $tema; ?> hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">
                                    receipt
                                </i>
                            </div>
                            <div class="content">
                                <div class="text">
                                    <b>
                                        <p>Noticias</p>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="<?php echo base_url() ?>edicion_admin">
                    <div class="col-md-2">
                        <div class="info-box bg-<?php echo $tema; ?> hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">
                                    folder
                                </i>
                            </div>
                            <div class="content">
                                <div class="text">
                                    <b>
                                        <p>EDICIONES</p>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="<?php echo base_url() ?>carrousel">
                    <div class="col-md-2">
                        <div class="info-box bg-<?php echo $tema; ?> hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">
                                    layers
                                </i>
                            </div>
                            <div class="content">
                                <div class="text">
                                    <b>
                                        <p>CARROUSEL</p>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endif; ?>
</section>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/js_p_bodega.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/js_p_oferta.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/js_p_admin.js"></script>