<form id="save-teme">
    <section class="content">
    <div class="container-fluid">
        <!-- Color Pickers -->
        <div class="row clearfix">
            <div class="">
                <div class="card">
                    <div class="header">
                        <h2>
                            BARRA DE NAVEGACIÓN SUPERIOR
                            <small>
                                Crea tu propio tema personalizado
                            </small>
                        </h2>
                        <div style="position: fixed;z-index: 1;left: 90%;top:15%">
                            <button form="save-teme" class="btn bg-<?php echo $tema; ?> waves-effect" style="height: 75px" type="submit">Guardar tema</button>
                        </div>
                        
                    </div>
                    <div class="body">
                        <div class="container-fluid">
                            <div class="col-md-6">
                                <b>
                                    CARA SUPERIOR
                                </b>
                                <div class="colorpicker">
                                    <div class="form-line">
                                        <input class="form-control" type="text" value="fff" id="barra_superior_1" name="barra_superior_1"></input>
                                    </div>
                                    <span class="input-group-addon "> 
                                        <b style="font-size: 10px;color:black;background: white;"> click aqui </b>
                                    </span>
                                </div>
                                <b>
                                    CARA INFERIOR
                                </b>
                                <div class="colorpicker">
                                    <div class="form-line">
                                        <input class="form-control" type="text" value="fff" id="barra_superior_2" name="barra_superior_2"></input>
                                    </div>
                                    <span class="input-group-addon">
                                        <b style="font-size: 10px;color:black;background: white;"> click aqui </b>
                                    </span>
                                </div>
                                <b>
                                    COLOR DE TEXTO
                                </b>
                                <div class="colorpicker">
                                    <div class="form-line">
                                        <input class="form-control" type="text" value="fff" id="texto_barra_superior" name="texto_barra_superior"></input>
                                    </div>
                                    <span class="input-group-addon">
                                        <b style="font-size: 10px;color:black;background: white;"> click aqui </b>
                                    </span>
                                </div>

                                <b class="btn bg-<?php echo $tema; ?> waves-effect" id="nab">Probar</b>
                            </div>
                            <div class="col-md-6">
                                <div id="prueba-nav" style="height: 60px;margin-top: 105px;border: 1px solid #0B0101;border-style: dotted;">

                                    <div class="col-md-5" align="left"><h4 class="txt-hd">Nombre sistema</h4></div>
                                    <div class="col-md-5" align="right"><h4 class="txt-hd">Cliente</h4></div>


                                </div>
                            </div>

                        </div>
                    </div>

                </div>



                <div class="card">
                    <div class="header">
                        <h2>
                            BARRA DE NAVEGACIÓN INFERIOR
                            <small>
                                Crea tu propio tema personalizado
                            </small>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="container-fluid">

                            <div class="container-fluid">
                                <div class="col-md-6">
                                    <b>
                                        CARA SUPERIOR
                                    </b>
                                    <div class="colorpicker">
                                        <div class="form-line">
                                            <input class="form-control" type="text" value="fff" id="barra_inferior_1" name="barra_inferior_1"></input>
                                        </div>
                                        <span class="input-group-addon  btn-block">
                                            <b style="font-size: 10px;color:black;background: white;"> click aqui </b>
                                        </span>
                                    </div>
                                    <b>
                                        CARA INFERIOR
                                    </b>
                                    <div class="colorpicker">
                                        <div class="form-line">
                                            <input class="form-control" type="text" value="fff" id="barra_inferior_2" name="barra_inferior_2"></input>
                                        </div>
                                        <span class="input-group-addon">
                                            <b style="font-size: 10px;color:black;background: white;"> click aqui </b>
                                        </span>
                                    </div>
                                    <b>
                                        COLOR DE TEXTO
                                    </b>
                                    <div class="colorpicker">
                                        <div class="form-line">
                                            <input class="form-control" type="text" value="fff" id="texto_barra_inferior" name="texto_barra_inferior"></input>
                                        </div>
                                        <span class="input-group-addon">
                                            <b style="font-size: 10px;color:black;background: white;"> click aqui </b>
                                        </span>
                                    </div>

                                    <b class="btn bg-<?php echo $tema; ?> waves-effect" id="nabin">Probar</b>
                                </div>
                                <div class="col-md-6">
                                    <div id="prueba-navin" style="height: 40px;margin-top: 115px;border: 1px solid #0B0101;border-style: dotted;">
                                        <h5 align="center" class="txt-hd2">PANEL DE NAVEGACIÓN</h5>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>



                <div class="card">
                    <div class="header">
                        <h2>
                            BANER Y FOTO DE USUARIO
                            <small>
                                Crea tu propio tema personalizado
                            </small>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="container-fluid">
                            <div class="col-md-3">
                                <label for="foto_usuario" align="center"  class="control-label ">
                                    <h1 class="fa fa-camera"></h1>
                                    Seleccionar foto usuario
                                </label>
                                <br>
                                <label for="foto_banner" align="center"  class="control-label ">
                                    <h1 class="fa fa-camera"></h1>
                                    Seleccionar foto banner
                                </label>
                                <input style="display: none;" type="file" class="form-control" name="foto_usuario" id="foto_usuario">
                                <input style="display: none;" type="file" class="form-control" name="foto_banner" id="foto_banner">
                                <input type="hidden" class="form-control" name="foto_banner2" id="foto_banner2">
                                <br><br>
                                <div class="demo-checkbox">
                                    <input checked="" class="filled-in chk-col-blue" name="foto_usuario2" id="foto_usuario2" type="checkbox">
                                    <label for="foto_usuario2">
                                        USAR FOTO DE USUARIO
                                    </label>
                                </div>

                            </div>

                            <div class="col-md-4" align="center">
                                <img class="" id="banner" width="260" height="175" style="position: relative;" />
                                <img class="img-circle" id="usuario"   width="70" height="70" style="position: relative;right: 250px;bottom: 25px;display: none;" />

                            </div>

                            <div class="col-md-4" align="center">
                                <img id="tr_banner" class="" width="260" height="175"  />
                                <img id="tr_usuario" class="img-circle" width="70" height="70"  />

                            </div>


                        </div>
                    </div>

                </div>

                <div class="card">
                    <div class="header">
                        <h2>
                            COLOR DE TABLAS
                            <small>
                                Crea tu propio tema personalizado
                            </small>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="container-fluid">
                            <div class="col-md-6">
                                <b>
                                    COLOR ENCABEZADO
                                </b>
                                <div class="colorpicker">
                                    <div class="form-line">
                                        <input class="form-control" type="text" value="fff" id="encabezado_tabla" name="encabezado_tabla"></input>
                                    </div>
                                    <span class="input-group-addon">
                                        <b style="font-size: 10px;color:black;background: white;"> click aqui </b>
                                    </span>
                                </div>
                                <b>
                                    COLOR TEXTO
                                </b>
                                <div class="colorpicker">
                                    <div class="form-line">
                                        <input class="form-control" type="text" value="fff" id="texto_tabla" name="texto_tabla"></input>
                                    </div>
                                    <span class="input-group-addon">
                                        <b style="font-size: 10px;color:black;background: white;"> click aqui </b>
                                    </span>
                                </div>
                                <b class="btn bg-<?php echo $tema; ?> waves-effect" id="prueba-tabla">Probar</b>
                            </div>

                            <div class="col-md-6" >
                                <div class="body table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr class="tr-table">
                                                <th>#</th>
                                                <th>FIRST NAME</th>
                                                <th>LAST NAME</th>
                                                <th>USERNAME</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td>Larry</td>
                                                <td>Jellybean</td>
                                                <td>@lajelly</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">5</th>
                                                <td>Larry</td>
                                                <td>Kikat</td>
                                                <td>@lakitkat</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>





<div class="card">
                    <div class="header">
                        <h2>
                            COLOR DE CUADROS DE DIALOGO
                            <small>
                                Crea tu propio tema personalizado
                            </small>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="container-fluid">
                            <div class="col-md-6">
                                <b>
                                    COLOR DE ENCABEZADO
                                </b>
                                <div class="colorpicker">
                                    <div class="form-line">
                                        <input class="form-control" type="text" value="fff" id="encabezado_modal" name="encabezado_modal"></input>
                                    </div>
                                    <span class="input-group-addon">
                                        <b style="font-size: 10px;color:black;background: white;"> click aqui </b>
                                    </span>
                                </div>
                                 <b>
                                    COLOR TEXTO
                                </b>
                                <div class="colorpicker">
                                    <div class="form-line">
                                        <input class="form-control" type="text" value="fff" id="texto_modal" name="texto_modal"></input>
                                        <input type="hidden" id="tema" name="tema">
                                    </div>
                                    <span class="input-group-addon">
                                        <b style="font-size: 10px;color:black;background: white;"> click aqui </b>
                                    </span>
                                </div>
                                <b class="btn bg-<?php echo $tema; ?> waves-effect" id="prueba-modal">Probar</b>
                            </div>

                            <div class="col-md-6" >
                                <div class="container-fluid">
                                    <div style="display: block;">
                                        <div class="modal-dialog modal-sm" >
                                            <div class="modal-content">
                                                <div class="modal-header mu">
                                                    <h4 class="modal-title" >
                                                        Modal title
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="body">
                                                <form id="form_validation_stats">
                                                    <div class="form-group form-float">
                                                        <div class="form-line focused warning">
                                                            <input type="text" class="form-control" value="form">
                                                            <label class="form-label">Form</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line focused error">
                                                            <input type="text" class="form-control" value="form">
                                                            <label class="form-label">Form</label>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <b class="btn btn-link waves-effect" type="b">
                                                        SAVE CHANGES
                                                    </b>
                                                    <b class="btn btn-link waves-effect" data-dismiss="modal" type="b">
                                                        CLOSE
                                                    </b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>






<div class="card">
                    <div class="header">
                        <h2>
                            TEMA GENERAL
                            <small>
                                Crea tu propio tema personalizado
                            </small>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="container-fluid">
                            <div class="tab-pane fade in active in active" id="skins" role="tabpanel">
                        <ul class="demo-choose-skin">
                            <li data-theme="red" class="teme">
                                <div class="red">
                                </div>
                                <span>
                                    Red
                                </span>
                            </li>
                            <li data-theme="pink" class="teme">
                                <div class="pink">
                                </div>
                                <span>
                                    Pink
                                </span>
                            </li>
                            <li data-theme="purple" class="teme">
                                <div class="purple">
                                </div>
                                <span>
                                    Purple
                                </span>
                            </li>
                            <li data-theme="deep-purple" class="teme">
                                <div class="deep-purple">
                                </div>
                                <span>
                                    Deep Purple
                                </span>
                            </li>
                            <li data-theme="indigo" class="teme">
                                <div class="indigo">
                                </div>
                                <span>
                                    Indigo
                                </span>
                            </li>
                            <li data-theme="blue" class="teme">
                                <div class="blue">
                                </div>
                                <span>
                                    Blue
                                </span>
                            </li>
                            <li data-theme="light-blue" class="teme">
                                <div class="light-blue">
                                </div>
                                <span>
                                    Light Blue
                                </span>
                            </li>
                            <li data-theme="cyan" class="teme">
                                <div class="cyan">
                                </div>
                                <span>
                                    Cyan
                                </span>
                            </li>
                            <li data-theme="teal" class="teme">
                                <div class="teal">
                                </div>
                                <span>
                                    Teal
                                </span>
                            </li>
                            <li data-theme="green" class="teme">
                                <div class="green">
                                </div>
                                <span>
                                    Green
                                </span>
                            </li>
                            <li data-theme="light-green" class="teme">
                                <div class="light-green">
                                </div>
                                <span>
                                    Light Green
                                </span>
                            </li>
                            <li data-theme="lime" class="teme">
                                <div class="lime">
                                </div>
                                <span>
                                    Lime
                                </span>
                            </li>
                            <li data-theme="yellow" class="teme">
                                <div class="yellow">
                                </div>
                                <span>
                                    Yellow
                                </span>
                            </li>
                            <li data-theme="amber" class="teme">
                                <div class="amber">
                                </div>
                                <span>
                                    Amber
                                </span>
                            </li>
                            <li data-theme="orange" class="teme">
                                <div class="orange">
                                </div>
                                <span>
                                    Orange
                                </span>
                            </li>

                            <li data-theme="blue-grey" class="teme">
                                <div class="blue-grey">
                                </div>
                                <span>
                                    Blue Grey
                                </span>
                            </li>
                        </ul>
                    </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </section>
</form>
<script>

    function read_imagen_usuario(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#usuario').attr('src', e.target.result);
                $('#usuario').css("width", "70px");
                $('#usuario').css("height", "70px");
                $('#usuario').css("position", "relative");
                $('#usuario').css("right", "80px");
                $('#usuario').css("bottom", "160px");
            }
            reader.readAsDataURL(input.files[0]);
            $("#usuario").css("display", "block");
        }
    }

    function read_imagen_banner(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#banner').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            $("#banner").css("display", "block");
        }
    }

    $("#foto_usuario").change(function () {
        read_imagen_usuario(this);
    });
    $("#foto_banner").change(function () {
        read_imagen_banner(this);
    });



   
    $(document).on("click", "#nab", function () {

        var one = $("#barra_superior_1").val();
        var two = $("#barra_superior_2").val();
        var tree = $("#texto_barra_superior").val();

        $("#prueba-nav").css("background", "-webkit-linear-gradient(" + one + "," + two + ")");
        $("#prueba-nav").css("background", "-o-linear-gradient(" + one + "," + two + ")");
        $("#prueba-nav").css("background", "-moz-linear-gradient(" + one + "," + two + ")");
        $("#prueba-nav").css("background", "background: linear-gradient(" + one + "," + two + ")");
        $("#prueba-nav").css("height", "60px");
        $("#prueba-nav").css("margin-top", "105px");
        $(".txt-hd").css("color", tree);

    });
    $(document).on("click", "#nabin", function () {

        var one = $("#barra_inferior_1").val();
        var two = $("#barra_inferior_2").val();
        var tree = $("#texto_barra_inferior").val();

        $("#prueba-navin").css("background", "-webkit-linear-gradient(" + one + "," + two + ")");
        $("#prueba-navin").css("background", "-o-linear-gradient(" + one + "," + two + ")");
        $("#prueba-navin").css("background", "-moz-linear-gradient(" + one + "," + two + ")");
        $("#prueba-navin").css("background", "background: linear-gradient(" + one + "," + two + ")");
        $("#prueba-navin").css("height", "40px");
        $("#prueba-navin").css("margin-top", "115px");
        $(".txt-hd2").css("color", tree);

    });

    $(document).on("click", "#prueba-tabla", function () {
        var color_encabezado = $("#encabezado_tabla").val();
        var color_texto = $("#texto_tabla").val();
        $(".tr-table").css("background", color_encabezado);
        $(".tr-table").css("color", color_texto);
    })

    $(document).on("click", "#prueba-modal", function () {
        var color_encabezado = $("#encabezado_modal").val();
        var color_texto = $("#texto_modal").val();
        $(".mu").css("background", color_encabezado);
        $(".mu").css("color", color_texto);
    })

    $(document).on("click",".teme",function(){
        var data = $(this).attr("data-theme");
        $(".teme").removeClass("active")
        $(this).addClass("active")
        $("#tema").val(data);
    })
    
    $(document).on("submit","#save-teme",function(e){
        e.preventDefault();
        $.ajax({
            url: host + "Controller_tema/guardar_tema",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend:function(){

            },
            success:function(){
                showNotification('bg-teal', 'Tema Guardado con exito', 'top', 'center', 'animated zoomInDown', 'animated zoomOutDown');
                location.reload()
            },
            error:function(){
                showNotification('bg-pink', 'Ocurrio un error intenta más tarde', 'top', 'center', 'animated zoomInDown', 'animated zoomOutDown');
            }
        })
    })

    function get_tema(){
        $.ajax({
            url: host + "Controller_tema/get_tema",
            method: "POST",
            dataType: "json",
            beforeSend:function(){

            },
            success:function(data){
                $('#barra_superior_1').val(data.barra_superior_1);
                $('#barra_superior_2').val(data.barra_superior_2);
                $('#texto_barra_superior').val(data.texto_barra_superior);
                $('#barra_inferior_1').val(data.barra_inferior_1);
                $('#barra_inferior_2').val(data.barra_inferior_2);
                $('#texto_barra_inferior').val(data.texto_barra_inferior);
                $('#encabezado_tabla').val(data.encabezado_tabla);
                $('#texto_tabla').val(data.texto_tabla);
                $('#encabezado_modal').val(data.encabezado_modal);
                $('#texto_modal').val(data.texto_modal);
                $('#tema').val(data.tema);
                $('#barra_superior_1').change();
                $('#barra_superior_2').change();
                $('#texto_barra_superior').change();
                $('#barra_inferior_1').change();
                $('#barra_inferior_2').change();
                $('#texto_barra_inferior').change();
                $('#encabezado_tabla').change();
                $('#texto_tabla').change();
                $('#encabezado_modal').change();
                $('#texto_modal').change();
                $('#tema').change();

                $('#foto_banner2').val(data.foto_banner);
                $('#foto_usuario2').val(data.foto_usuario);

                $('#tr_banner').attr('src',host + "assets/tema/" + data.foto_banner);
                $('#tr_usuario').attr('src',host + "assets/tema/" + data.foto_usuario);
                $('#tr_banner').css("position","relative");
                $('#tr_usuario').css("position","relative");
                $('#tr_usuario').css("right","250px");
                $('#tr_usuario').css("bottom","35px");


            },
            error:function(){

            }
        })
    }
get_tema()

 $(function () {
        $('.colorpicker').colorpicker();
    })

</script>