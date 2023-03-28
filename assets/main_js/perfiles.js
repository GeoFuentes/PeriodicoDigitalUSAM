$(document).on("ready", main);

///////DataTable///////////////

function main() {
    var table = $('#tb-perfiles').DataTable()
    table.destroy();
    table = $('#tb-perfiles').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": host + "periodico/Controller_perfiles/listar_perfiles",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [-1],
            "orderable": false,
        },],
    });
}

//////// Modal/////////////////

$(document).on("click", "#add", function () {
    $("#carga").fadeOut("slow");
    $("#action").val("create");
    $(".form-line").removeClass("focused");
    $("#developer_cu_form")[0].reset();
    $("#estado").val("");
    $("#estado").change();
    $("#form-title").text("Agregar Perfil");
    $("#nombreb").text("Agregar");
    $("#create_form_modal").modal("show");
});

/////// Crear y actualizar ///////////

$(document).on("submit", "#developer_cu_form", function (e) {
    e.preventDefault();
    var nombre = $("#nombre").val();
    var cargo = $("cargo").val();
    var url_foto = $("url_foto").val();
    var banner = $("banner").val();
    var fecha = $("#fecha_crea").val();
    var estado = $("#estado").val();

    if (nombre == '') {
        swal({
            title: "Campo nombre requerido",
            type: "warning"
        });
    } else if ( cargo == '') {
        swal({
            title: "Campo cargo requerido",
            type: "warning"
        });
    } else if (url_foto == '') {
        swal({
            title: "Foto perfil requerido",
            type: "warning"
        });
    } else if (banner == '') {
        swal({
            title: "Banner requerido",
            type: "warning"
        });
    } else if (fecha_crea == '') {
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
            url: "periodico/Controller_perfiles/actualizar_crear_perfiles",
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

///////////// Editar ////////////

$(document).on("click", "#editBtnId", function (e) {
    e.preventDefault();
    var editBtnId = $(this).attr('data-editBtnId');
    var action = 'fetchSingleRow';
    $.ajax({
        url: "periodico/Controller_perfiles/linea_actualizar",
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
            $("#nombre").val(data.nombre);
            $("#info").val(data.info);
            $("#cargo").val(data.cargo);
            $("#fecha_crea").val(data.fecha_crea);
            $("#fecha").change();
            $("#url_hidden").val(data.url_foto);
            $("#ban_hidden").val(data.banner);
            $("#form-title").text('Editar Perfil');
            $("#action").val('update');
            $("#nombreb").html('Actualizar');
            $("#updateId").val(editBtnId);
        }
    });
});
