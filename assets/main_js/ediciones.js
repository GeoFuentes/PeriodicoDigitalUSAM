$(document).on("ready", main);

function main() {
    var table = $('#tb-edicion').DataTable()
    table.destroy();
    table = $('#tb-edicion').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": host + "periodico/Controller_edicion/listar_edicion",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [-1],
            "orderable": false,
        },],
    });
}

$(document).on("click", "#add", function () {
    $("#carga").fadeOut("slow");
    $("#action").val("create");
    $(".form-line").removeClass("focused");
    $("#developer_cu_form")[0].reset();
    $("#estado").val("");
    $("#estado").change();
    $("#form-title").text("Agregar Edicion");
    $("#nombreb").text("Agregar");
    $("#create_form_modal").modal("show");
});

$(document).on("submit", "#developer_cu_form", function (e) {
    e.preventDefault();
    var edicion = $("#edicion").val();
    var fecha = $("#fecha").val();
    var estado = $("#estado").val();

    if (edicion == '') {
        swal({
            title: "Campo edicion requerido",
            type: "warning"
        });
    } else if (fecha == '') {
        swal({
            title: "Campo fecha requerido",
            type: "warning"
        });
    } else if (estado == '') {
        swal({
            title: "Campo estado requerido",
            type: "warning"
        });
    } else {
        $.ajax({
            url: "periodico/Controller_edicion/actualizar_crear_edicion",
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
                url: "periodico/Controller_edicion/eliminar_edicion",
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

$(document).on("click", "#editBtnId", function (e) {
    e.preventDefault();
    var editBtnId = $(this).attr('data-editBtnId');
    var action = 'fetchSingleRow';
    $.ajax({
        url: "periodico/Controller_edicion/linea_actualizar",
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
            $("#edicion").val(data.num_edicion);
            $("#fecha").val(data.fecha_publicacion);
            $("#fecha").change();
            $("#form-title").text('Editar edicion');
            $("#action").val('update');
            $("#nombreb").html('Actualizar');
            $("#updateId").val(editBtnId);
        }
    });
});