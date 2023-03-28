<!DOCTYPE html>
<html lang="es">

<head>
    <title>Iniciar sesión | USAM</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/img/intesal.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/css/main.css">

    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.js"></script>
    <!--===============================================================================================-->
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form validate-form">

                    <?php echo form_open(base_url() . 'Controller_home/login'); ?>
                    <span class="login100-form-title p-b-43">
                        <img src="<?php echo base_url(); ?>assets/login/images/logo-patria.jpeg" width="150" style="border-radius: 100%;">

                    </span>


                    <div class="wrap-input100 validate-input" data-validate="Usuario requerido">
                        <input class="input100" type="email" name="username" id="username" placeholder="CORREO" required="" value="<?php if (isset($_SESSION['correo'])) : ?>
                            <?php echo $_SESSION['correo'] ?>
                        <?php endif ?>">
                        <span class="focus-input100"></span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Contraseña requerida">
                        <input class="input100" type="password" name="password" id="password" placeholder="CONTRASEÑA" required="" value="">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-t-3 p-b-25">
                        <a href="javascript:mostrarContrasena()"><small>Mostrar Contraseña</small></a>
                    </div>

                    <?php if (isset($_SESSION['mensaje_error'])) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>ERROR!</strong> Usuario o contraseña incorrectos
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif ?>
                    <?php if (isset($_SESSION['estado_msg'])) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Advertencia: </strong> Su usuario esta inactivo, por favor contactar al administrador.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <div class="container-login100-form-btn">
                        <input class="login100-form-btn" type="submit" value="Ingresar">
                    </div>

                    <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
                            ¿Olvidaste tu contraseña?<br>Ponte en contacto con el administrador del sistema <br> ( <a href="https://www.usam.edu.sv">Universidad Salvadoreña Alberto Masferrer</a> )
                        </span>
                    </div>

                    <?php echo form_close(); ?>
                </div>

                <div class="login100-more" style="background: url(<?php echo base_url(); ?>assets/login/images/fondo-patria.jpeg) no-repeat fixed center;
                                                                                                                           -webkit-background-size: cover;
                                                                                                                           -moz-background-size: cover;
                                                                                                                           -o-background-size: cover;
                                                                                                                           background-size: cover;">
                    <!-- <video class="video_background" src="<?php echo base_url(); ?>assets/login/images/intro_forest.mp4" loop autoplay preload muted>Video</video> -->
                </div>
            </div>
        </div>

    </div>

    <?php
    $this->session->unset_userdata('correo');
    $this->session->unset_userdata('mensaje_error');
    $this->session->unset_userdata('estado_msg');
    ?>
    <!--===============================================================================================-->

</body>

</html>

<script>
    function mostrarContrasena() {
        var tipo = document.getElementById("password");
        if (tipo.type == "password") {
            tipo.type = "text";
        } else {
            tipo.type = "password";
        }
    }
</script>