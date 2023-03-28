$(document).on("ready", main);

function main() {
    var table = $('#tb-noticia').DataTable()
    table.destroy();
    table = $('#tb-noticia').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": host + "periodico/Controller_noticia/listar_noticia",
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
    $("#categoria").val("");
    $("#foto").attr('src', '');
    $("#categoria").change();
    $("#edicion").val("");
    $("#edicion").change();
    $("#nivel").val("");
    $("#nivel").change();
    $("#form-title").text("Agregar Noticia");
    $("#nombreb").text("Agregar");
    $("#create_form_modal").modal("show");
});

$(document).on("click", "#urlBnt", function(e){
    e.preventDefault();
    var urlBtnId = $(this).attr('data-urlBtnId');
    var action = 'fetchSingleRow';
    $.ajax({
        url: "periodico/Controller_noticia/mostrar_url",
        method: "POST",
        data: {
            urlBtnId: urlBtnId,
            action: action
        },
        dataType: "json",
        beforeSend: function () {
            $("#carga_url").css("display", "block");
            $("#url_modal").modal('show');
        },
        success: function (data) {
            $("#carga_url").fadeOut("slow");
            $("#form-not").text('Enlace de la noticia '+data.Titular);

            if(data.url_noti == null){
                $("#url_noti").text(host+"noticia/"+data.id_noticia);
                $("#url_noti").attr('href', host+"noticia/"+data.id_noticia);
            }else{
                $("#url_noti").text(data.url_noti);
                $("#url_noti").attr('href', data.url_noti);
            }
        }
    });
})

$(document).on("click", "#editBtnId", function (e) {
    e.preventDefault();
    var editBtnId = $(this).attr('data-editBtnId');
    var action = 'fetchSingleRow';
    $.ajax({
        url: "periodico/Controller_noticia/linea_actualizar",
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
            $("#titulo").val(data.Titular);
            $("#subtitulo").val(data.Subtitulo);
            $("#foto").attr('src', host + 'assets/upload/noticias/' + data.url);
            $("#url").val(data.url);
            $("#fotografo").val(data.Fotografo);
            $("#fecha").val(data.Fecha);
            $("#editor").val(data.Editor);
            $("#reportero").val(data.Reportero);
            $("#categoria").val(data.id_cat_noticia);
            $("#categoria").change();
            $("#edicion").val(data.id_edicion);
            $("#edicion").change();
            $("#nivel").val(data.id_cat_nivel);
            $("#nivel").change();
            $("#form-title").text('Editar noticia');
            $("#action").val('update');
            $("#nombreb").html('Actualizar');
            $("#updateId").val(editBtnId);
            $("#fotoId").val(data.fotoId);
        }
    });
});

$(document).on("click", "#cancelar", function (e) {
    $("#titulo").val("");
    $("#subtitulo").val("");
    $("#categoria").val("");
    $("#foto").attr('src', '');
    $("#url").val("");
    $("#fecha").val("");
    $("#fotografo").val("");
    $("#reportero").val("");
    $("#editor").val("");
    $("#categoria").change();
    $("#edicion").val("");
    $("#edicion").change();
    $("#nivel").val("");
    $("#nivel").change();
});

$(document).on("click", "#delteBtnId", function(e){
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
            var action = 'delete_noti';
            $.ajax({
                url: "periodico/Controller_noticia/eliminar_noticia",
                method: "POST",
                data: {
                    delteBtnId: delteBtnId,
                    action: action
                },
                beforeSend: function () { },
                success: function (data) {
                    if (data.trim() == 'deleted_news') {
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


$(document).on("submit", "#developer_cu_form", function (e) {
    e.preventDefault();
    var titulo = $("#titulo").val();
    var url_foto = $("#url_foto").val();
    var url = $("#url").val();
    var fotografo = $("#fotografo").val();
    var fecha = $("#fecha").val();
    var editor = $("#editor").val();
    var reportero = $("#reportero").val();
    var categoria = $("#categoria").val();
    var edicion = $("#edicion").val();
    var nivel = $("#nivel").val();

    if (titulo == '') {
        swal({
            title: "Campo titulo requerido!",
            type: "warning"
        });
    } else if (url_foto == '' && url == '') {
        swal({
            title: "Imagen requerida!",
            type: "warning"
        });
    } else if (fotografo == '') {
        swal({
            title: "Campo fotografo requerido!",
            type: "warning"
        });
    } else if (fecha == '') {
        swal({
            title: "Campo fecha requerido!",
            type: "warning"
        });
    } else if (editor == '' && reportero == '') {
        swal({
            title: "Se necesita un editor o un reportero!",
            type: "warning"
        });
    } else if (categoria == '') {
        swal({
            title: "Seleccione una Categoria!",
            type: "warning"
        });
    } else if (edicion == '') {
        swal({
            title: "Seleccione una Edicion!",
            type: "warning"
        });
    } else if (nivel == '') {
        swal({
            title: "Seleccione el Nivel!",
            type: "warning"
        });
    } else {
        $.ajax({
            url: "periodico/Controller_noticia/actualizar_crear_noticia",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#carga").css("display", "block");
            },
            dataType: "json",
            success: function (data) {
                $("#carga").fadeOut("slow");
                if (data.message == 'created') {
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