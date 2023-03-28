<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Roles & permisos
                            <small>Aqui podras administrar los permisos y accesos del sistema junto con sus roles</small>
                        </h2>
                        <ul class="header-dropdown m-r--5" >
                                    <li class="dropdown ">
                                        <a aria-expanded="true" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button">
                                            <i class="material-icons waves-effect bg-<?php echo $tema; ?>" style="font-size: 30px" id="add">
                                                add_circle
                                            </i>
                                        </a>
                                    </li>
                                </ul>
                    </div>
                    <br>

                    <div class="container-fluid">
                        <div class="col-xs-12">
                            <div class="body table-responsive">
                                <table id="tbrol" class="table table-bordered table-striped table-condensed flip-content">
                                    <thead class="flip-content bordered-palegreen">
                                        <tr>
                                            <th>
                                                CORRELATIVO
                                            </th>
                                            <th>
                                                ROL
                                            </th>
                                            <th>
                                                PERMISOS
                                            </th>
                                            <th>
                                                ACCIONES
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-actions">
                                <div class="text-center paginacion">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>







<div class="modal" id="create_form_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-changue ">
            <div class="modal-header">
                <h2 align="center" class="pmd-cart-title-text" id="form-title1"></h2>
            </div>
            <div class="modal-body modal-slim">
                <div id="carga"></div>

                <form id="form-per" role="form" action="<?php echo base_url(); ?>Controller_home/guardar_asignacion_menu" method="post">
                    <input type="hidden" name="id_rol_asignar" id="id_rol_asignar">

                    <div class="contenido" align="center" id="tbper"></div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" id="btnactualizar" class="btn bg-<?php echo $tema; ?>">Guardar</button>
                <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-update-rol" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h2 align="center" class="pmd-cart-title-text" id="form-title2"></h2>
            </div>
            <div class="modal-body">
                <div id="carga2"></div>
                <form class="" id="developer_cu_form">

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">beenhere</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control date" placeholder="Nombre del rol" id="rol" name="rol">
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <select name="id_permiso" id="id_permiso" class="form-control" data-live-search="true">
                            <option value="">SELECCIONA PANTALLA</option>
                            <?php foreach ($pantalla as $key => $value) : ?>
                                <option value="<?php echo $value->id_permiso ?>"><?php echo $value->nombre_permiso ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="modal-footer">

                        <div class="pmd-modal-action" align="center">
                            <input type="hidden" id="updateId" name="updateId">
                            <input type="hidden" name="action" id="action" value="create">
                            <button type="submit" name="submit" id="submit" class="btn bg-<?php echo $tema; ?>"><b id="nombreb"></b></button>
                            <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('.modal-slim').slimScroll({
        color: '#00f',
        height: '400px',
        alwaysVisible: true,
        disableFadeOut: false
    });
    $(document).on("ready", main);

    function main() {
        var table = $('#tbrol').DataTable()
        table.destroy();
        table = $('#tbrol').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": host + "Controller_roles/listar_rol",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [-1],
                "orderable": false,
            }, ],
        });
    }

    $(document).on("click", "#delteBtnId", function(e) {
        e.preventDefault();
        var delteBtnId = $(this).attr('data-delteBtnId');
        swal({
            title: "Estas seguro?",
            text: "Si completas la acción ya no podras recuperar tus datos! ",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, Continuar!",
            cancelButtonText: "No, Cancelar!",
            closeOnConfirm: false,
            closeOnCancel: false,
            type: "info",
            showLoaderOnConfirm: true,
            animation: "slide-from-top",
            html: true
        }, function(isConfirm) {
            if (isConfirm) {
                var action = 'delete';
                $.ajax({
                    url: "<?php echo base_url(); ?>Controller_roles/eliminar_rol",
                    method: "POST",
                    data: {
                        delteBtnId: delteBtnId,
                        action: action
                    },
                    beforeSend: function() {
                        $('#carga-datos').css('display', 'block');
                    },
                    success: function(data) {
                        if (data.trim() == 'deleted') {
                            swal("Eliminado!", "La acción se a completado exitosamente.", "success");
                            main();
                        }
                    },
                    error: function() {
                        swal("Error", "Intenta de nuevo, si el error persiste contacta a tu administrador.", "error");
                    }
                });
            } else {
                swal("Cancelado", "La acción se a completado exitosamente.", "error");
            }
        });
    });

    $(document).on("click", "#add", function () {
        $("#carga2").fadeOut("slow");
        $("#action").val("create");
        $(".form-line").removeClass("focused");
        $("#developer_cu_form")[0].reset();
        $("#form-title2").text('Crear rol');
        $("#nombreb").html('Agregar');
        $("#modal-update-rol").modal("show");
    });

    $(document).on("click", "#editBtnId", function(e) {
        e.preventDefault();
        var editBtnId = $(this).attr('data-editBtnId');
        var action = 'fetchSingleRow';
        $.ajax({
            url: "<?php echo base_url(); ?>Controller_roles/linea_actualizar",
            method: "POST",
            data: {
                editBtnId: editBtnId,
                action: action
            },
            dataType: "json",
            beforeSend: function() {
                $("#carga").css("display", "block");
                $("#modal-update-rol").modal('show');
            },
            success: function(data) {
                $("#carga2").fadeOut("slow");
                $("#developer_cu_form").css('display', 'block');
                $("#tbper, #form-per").css('display', 'none');

                $("#rol").val(data.rol);
                $("#id_permiso").val(data.id_permiso);
                $("#id_permiso").change();
                $("#form-title2").text('Editar rol');
                $("#action").val('update');
                $("#nombreb").html('Actualizar');
                $("#updateId").val(editBtnId);
            }
        });
    });
    $(document).on("submit", "#developer_cu_form", function(e) {
        e.preventDefault();
        var rol = $("#rol").val();
        var id_permiso = $("#id_permiso").val();
        if (rol == '') {
            swal({
                title: "Campo rol requerido",
                type: "warning"
            });
        } else if (rol.length < 4) {
            swal({
                title: "Escribe almenos 4 caracteres",
                type: "error"
            });
        } else if (rol.length > 20) {
            swal({
                title: "Limite de caracteres 40",
                type: "error"
            });
        } else if (id_permiso == '') {
            swal({
                title: "Selecciona un permiso",
                type: "warning"
            });
        } else {
            $.ajax({
                url: "<?php echo base_url(); ?>Controller_roles/actualizar_crear_rol",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $("#carga").css("display", "block");
                },
                success: function(data) {
                    $("#carga").fadeOut("slow");
                    if (data.trim() == 'created') {
                        showNotification('bg-teal', 'Registro agregado con exito', 'top', 'center', 'animated zoomInDown', 'animated zoomOutDown');
                        $("#modal-update-rol").modal('hide');
                        if ($('.modal-backdrop').is(':visible')) {
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                        };
                        $("#developer_cu_form")[0].reset();
                    }
                    $("#modal-update-rol").modal('hide');
                    if (data.trim() == 'update') {
                        showNotification('bg-teal', 'Registro actualizado con exito', 'top', 'center', 'animated zoomInDown', 'animated zoomOutDown');
                        $("#developer_cu_form")[0].reset();
                    }
                    main();
                }
            });
        }
    });
    $("#btnactualizar").click(actualizar);

    function actualizar() {
        var formData = new FormData($("#form-per")[0]);
        var id_rol = $(this).attr("data-permisos");
        $('#id_rol_asignar').val(id_rol);
        $.ajax({
            url: "<?php echo base_url(); ?>Controller_roles/guardar_asignacion_menu",
            type: "POST",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $("#carga").css("display", "block");
            },
            success: function(data) {
                $("#carga").fadeOut("slow");
                showNotification('bg-teal', 'Permisos actualizados con exito', 'top', 'center', 'animated zoomInDown', 'animated zoomOutDown');
                $("#create_form_modal").modal('hide');
                if ($('.modal-backdrop').is(':visible')) {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                };
                $("#form-per")[0].reset();
                main();
                menu();
            },
            error: function() {

                $("#create_form_modal").modal('hide');
                if ($('.modal-backdrop').is(':visible')) {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                };
                $("#form-per")[0].reset();
                main();
                cargar_menu();
            }
        });
    }
    $(document).on("click", "#permisos", function(e) {
        e.preventDefault();
        var permisos = $(this).attr("data-permisos");
        $('#id_rol_asignar').val(permisos);
        $.ajax({
            url: "<?php echo base_url(); ?>Controller_roles/permisos",
            method: "POST",
            data: {
                permisos: permisos
            },
            dataType: "json",
            beforeSend: function() {
                $("#carga").css("display", "block");
            },
            success: function(data) {
                $("#carga").fadeOut("slow");
                $("#developer_cu_form").css('display', 'none');
                $("#tbper, #form-per").css('display', 'block');
                $("#create_form_modal").modal('show');
                $("#form-title1").html('<div>Rol ' + data.xd2 + '</div>');
                $("#tbper").html(data.xd);
            }
        });
    });
</script>