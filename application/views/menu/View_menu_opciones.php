<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Opciones de menú
                                <small>Aqui podras administrar las url y nombres de las opciones de los diferentes menú</small>
                            </h2>
                        </div>
                        <br>
<div class="col-md-1">
                           
                                <button type="button" id="create_acc_btn" data-toggle="modal" data-target="#create_form_modal" onclick="$('#carga').css('display','none')" class="btn bg-<?php echo $tema; ?> waves-effect btn-block">
                                    <i class="material-icons" >add_box</i>
                                </button>
                            
                        </div> 
                    
<div class="container-fluid">
    <div class="col-xs-12">
            <div class="panel-group accordion accordion-semi" role="tablist" aria-multiselectable="true" id="opciones" ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




<div class="modal" id="create_form_modal" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div id="carga"></div>
                                <div class="modal-header pmd-modal-bordered">
                                    <h2 class="pmd-cart-title-text" id="form-title"></h2>
                                </div>
                                <form class="" id="developer_cu_form">
                                    <div class="modal-body">
                                        <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">rate_review</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date" placeholder="Nombre opción" id="opcion" name="opcion">
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">wb_auto</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date" placeholder="Dirección url" id="url" name="url">
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">insert_emoticon</i>
                                        </span>
                                        <div >
                                            <select class="form-control" id="id_menu" name="id_menu"  data-live-search="true">
                                            <option value="">-Seleccione el menu-</option>
                                            <?php foreach ($menus as $m) { ?>
                                                <option value="<?php echo $m["id_menu"]; ?>">
                                                    <?php echo $m['menu']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        </div>
                                    </div> 

                                        
                                    </div>
                                    <div class="modal-footer">
                                        <div class="pmd-modal-action">
                                            <input type="hidden" id="updateId" name="updateId">
                                            <input type="hidden"  name="action" id="action" value="create">
                                            <button type="submit"  name="submit" id="submit" class="btn bg-<?php echo $tema; ?>" ><b id="nombreb"></b></button>
                                            <button data-dismiss="modal" class="btn btn-default">Cancelar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


<script type="text/javascript">
    function opciones() {
        $.ajax({
            url: "<?php echo base_url(); ?>Controller_menu_opciones/listar_menu_acordion",
            method: "POST",
            success: function (data) {
                $("#opciones").html(data);
            }
        });
    }


    $(document).on("click", "#delteBtnId", function (e) {
        e.preventDefault();
        var delteBtnId = $(this).attr('data-delteBtnId');
        swal({
            title: "Estas seguro?",
            text: "Si completas la acción ya no podras recuperar tus datos! " + "<h2 id='carga-datos' style='display:none;'>" + "<i class='fa fa-history fa-spin'></i>" + "</h2>",
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
        }, function (isConfirm) {
            if (isConfirm) {
                var action = 'delete';
                $.ajax({
                    url: "<?php echo base_url(); ?>Controller_menu_opciones/eliminar_opcion",
                    method: "POST",
                    data: {
                        delteBtnId: delteBtnId,
                        action: action
                    },
                    beforeSend: function () {
                    },
                    success: function (data) {
                        if (data.trim() == 'deleted') {
                            swal("Eliminado!", "La acción se a completado exitosamente.", "success");
                            opciones();
                        }
                    },
                    error: function () {
                        swal("Error", "Intenta de nuevo, si el error persiste contacta a tu administrador.", "error");
                    }
                });
            } else {
                swal("Cancelado", "La acción se a completado exitosamente.", "error");
            }
        });
    });

    $(document).on("click", "#create_acc_btn", function (e) {
        e.preventDefault();
        $("#developer_cu_form")[0].reset();
        $("#form-title").text('Crear Opción');
        $("#action").val('create');
        $("#nombreb").html('Crear');
    });
    $(document).on("click", "#editBtnId", function (e) {
        e.preventDefault();
        var editBtnId = $(this).attr('data-editBtnId');
        var action = 'fetchSingleRow';
        $.ajax({
            url: "<?php echo base_url(); ?>Controller_menu_opciones/linea_actualizar",
            method: "POST",
            data: {
                editBtnId: editBtnId,
                action: action
            },
            dataType: "json",
            beforeSend: function () {
               $("#carga").css("display","block");
               $("#create_form_modal").modal('show');
            },
            success: function (data) {
                $("#carga").fadeOut("slow");
                $("#opcion").val(data.opcion);
                $("#url").val(data.url);
                $("#id_menu").val(data.id_menu);
                $("#id_menu").change();
                $("#form-title").text('Editar opción');
                $("#action").val('update');
                $("#nombreb").html('Actualizar');
                $("#updateId").val(editBtnId);
            }
        });
    });
    $(document).on("submit", "#developer_cu_form", function (e) {
        e.preventDefault();
        var url = $("#url").val();
        var opcion = $("#opcion").val();
        var id_menu = $("#id_menu").val();
        if (url == '') {
            swal({
                title: "Campo url requerido",
                type: "warning"
            });
        } else if (opcion == '') {
            swal({
                title: "Campo opcion requerido",
                type: "warning"
            });
        } else if (id_menu == '') {
            swal({
                title: "Seleccione un menu",
                type: "warning"
            });
        } else {
            $.ajax({
                url: "<?php echo base_url(); ?>Controller_menu_opciones/actualizar_crear_opcion",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function() {
                         $("#carga").css("display","block");
                     },
                success: function (data) {
                    $("#carga").fadeOut("slow");
                    if (data.trim() == 'created') {
                        showNotification('bg-teal', 'Registro agregado con exito', 'top', 'center', 'animated zoomInDown', 'animated zoomOutDown');
                        $("#create_form_modal").modal('hide');
                        if ($('.modal-backdrop').is(':visible')) {
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                        }
                        ;
                        $("#developer_cu_form")[0].reset();
                    }
                    $("#create_form_modal").modal('hide');
                    if (data.trim() == 'update') {
                        showNotification('bg-teal', 'Registro actualizado con exito', 'top', 'center', 'animated zoomInDown', 'animated zoomOutDown');
                        $("#developer_cu_form")[0].reset();
                    }
                    opciones();
                }
            });
        }
    });
    opciones();
</script>

