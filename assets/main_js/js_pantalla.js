$(document).on("ready", main);

function main() {
    var table = $('#tbl_pantalla').DataTable()
    table.destroy();
    table = $('#tbl_pantalla').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": host + "Controller_pantalla/lista_pantalla",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [-1],
            "orderable": false,
        }, ],
    });
}

$(document).on("click", "#add", function() {
    $("#carga").fadeOut("slow");
    $("#action").val("crear");
    $(".form-line").removeClass("focused");
    $("#form-pantalla")[0].reset();
    $("#titulo_modal").text("Agregar pantalla");
    $("#boton").text("Agregar");
    $("#modal-pantalla").modal("show");
})

$(document).on("click", "#editar", function() {
    var id_pantalla = $(this).attr("data-permiso");
    $.ajax({
        url: host + "Controller_pantalla/linea_pantalla",
        method: "POST",
        data: {
            id_pantalla: id_pantalla
        },
        dataType: "json",
        beforeSend: function() {
            $("#carga").css("display", "block");
            $(".form-line").addClass("focused");
            $("#modal-pantalla").modal("show");
        },
        success: function(data) {
            $("#carga").fadeOut("slow");
            $("#titulo_modal").text("Editar pantalla");
            $("#boton").text("Actualizar");
            $("#action").val("actualizar");
            $("#url_permiso").val(data.url_permiso);
            $("#nombre_permiso").val(data.nombre_permiso);
            $("#updateId").val(data.id_permiso);
        },
        error: function(estado, tipoerror, errorhttp) {
            $("#modal-pantalla").modal("hide");
            showNotification('bg-pink', tipoerror + ' ' + estado.status + '<hr>' + errorhttp, 'top', 'right', 'animated bounceIn', 'animated bounceOut');
        }
    })
})


$(document).on("submit", "#form-pantalla", function(e) {
    e.preventDefault();
    $.ajax({
        url: host + "Controller_pantalla/insert_update_pantalla",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("#carga").css("display", "block");
        },
        success: function(data) {
            $("#carga").fadeOut("slow");
            if (data.trim() == 'update') {
                showNotification('bg-blue', 'Actualizado con exito', 'top', 'right', 'animated bounceIn', 'animated bounceOut');
            } else if (data.trim() == 'insert') {
                showNotification('bg-green', 'Creado con exito', 'top', 'right', 'animated bounceIn', 'animated bounceOut');
            }
            $("#modal-pantalla").modal("hide");
            main();
        },
        error: function(estado, tipoerror, errorhttp) {
            showNotification('bg-pink', tipoerror + ' ' + estado.status + '<hr>' + errorhttp, 'top', 'right', 'animated bounceIn', 'animated bounceOut');
        }
    })
})


$(document).on("click", "#eliminar", function(e) {
    e.preventDefault();
    var id = $(this).attr('data-permiso');
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
                url: host + "Controller_pantalla/eliminar_pantalla",
                method: "POST",
                data: {
                    id: id
                },
                beforeSend: function() {},
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