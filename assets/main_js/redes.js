$(document).on("ready", main);

function main() {
    var table = $('#tb-redes').DataTable()
    table.destroy();
    table = $('#tb-redes').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": host + "periodico/Controller_redes/listar_redes",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [-1],
            "orderable": false,
        },],
    });
}

// Modal Carrousel //
$(document).on("click", "#add", function () {
    $("#carga").fadeOut("slow");
    $("#action").val("create");
    $(".form-line").removeClass("focused");
    $("#developer_cu_form")[0].reset();
    $("#icono").val("");
    $("#icono").change();
    $("#estado").val("");
    $("#estado").change();
    $("#form-title").text("Agregar Red");
    $("#nombreb").text("Agregar");
    $("#create_form_modal").modal("show");
});

// Crear y Actualizar Carrousel //

$(document).on("submit", "#developer_cu_form", function (e) {
    e.preventDefault();
    var redes_sociales = $("#redes_sociales").val();
    var url = $("#url").val();
    var icono = $("#icono").val();
    var entidad = $("#entidad").val();
    //var url
    var estado = $("#estado").val();

    if (redes_sociales == '') {
        swal({
            title: "Campo Redes Sociales requerido",
            type: "warning"
        });
    }  else if (estado == '') {
        swal({
            title: "Campo Estado requerido",
            type: "warning"
        });
    }  else if (url == '') {
        swal({
            title: "Campo URL requerido",
            type: "warning"
        });
    } else if (entidad == '') {
        swal({
            title: "Campo entidad requerido",
            type: "warning"
        });
    }
    else {
        $.ajax({
            url: "periodico/Controller_redes/actualizar_crear_redes",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#carga").css("display", "block");
            },
            success: function (data) {
                $("#carga").fadeOut("slow");
                if (data.trim() == 'created') {
                    showNotification('bg-teal', 'Registro agregado con exito', 'top', 'center', 'animated zoomInDown', 'animated zoomOutDown');
                    $("#create_form_modal").modal('hide');
                    if ($('.modal-backdrop').is(':visible')) {
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    };
                    $("#developer_cu_form")[0].reset();
                }
                $("#create_form_modal").modal('hide');
                if (data.trim() == 'update') {
                    showNotification('bg-teal', 'Registro actualizado con exito', 'top', 'center', 'animated zoomInDown', 'animated zoomOutDown');
                    $("#developer_cu_form")[0].reset();
                }
                main();
            }
        });
    }
});

// Editar //

$(document).on("click", "#editBtnId", function (e) {
    e.preventDefault();
    var editBtnId = $(this).attr('data-editBtnId');
    var action = 'fetchSingleRow';
    $.ajax({
        url: "periodico/Controller_redes/linea_actualizar",
        method: "POST",
        data: {
            editBtnId: editBtnId,
            action: action
        },
        dataType: "json",
        beforeSend: function () {
            $("#carga").css("display", "block");
            $("#create_form_modal").modal('show');
        },
        success: function (data) {
            $("#carga").fadeOut("slow");
            $("#estado").val(data.estado);
            $("#estado").change();
            $("#red_social").val(data.red_social);
            $("#url").val(data.url);
            $("#icono").val(data.icono);
            $("#icono").change();
            $("#entidad").val(data.entidad);
            $("#form-title").text('Editar Red');
            $("#action").val('update');
            $("#nombreb").html('Actualizar');
            $("#updateId").val(editBtnId);
        }
    });
});

// Eliminar Carrousel //

$(document).on("click", "#delteBtnId", function (e) {
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
    }, function (isConfirm) {
        if (isConfirm) {
            var action = 'delete';
            $.ajax({
                url: "periodico/Controller_redes/eliminar_redes",
                method: "POST",
                data: {
                    delteBtnId: delteBtnId,
                    action: action
                },
                beforeSend: function () { },
                success: function (data) {
                    if (data.trim() == 'deleted') {
                        swal("Eliminado!", "La acción se a completado exitosamente.", "success");
                        main();
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