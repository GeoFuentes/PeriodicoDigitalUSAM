CKEDITOR.replace('nota', {
    customConfig: '<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor_nota.js'
});
CKEDITOR.config.height = 500;

$(document).on("click", "#notaBtnId", function (e) {
    e.preventDefault();
    var editBtnId = $(this).attr('data-notaBtnId');
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
            $("#carga-nota").css("display", "block");
            $("#nota_modal").modal("show");
        },
        success: function (data) {
            $("#carga-nota").fadeOut("slow");
            CKEDITOR.instances["nota"].setData(data.info)
            $("#updateIdNota").val(editBtnId);
            $("#actionNota").val('nota');
            $("#nota-title").text("Editor de la Nota");
            $("#btn-nota").text("Guardar");
            $("#nota_modal").modal("show");
        }
    });
});

$(document).on("submit", "#nota-form", function (e) {
    e.preventDefault();
    var nota = $("#nota").val();

    if (nota == '') {
        swal({
            title: "Campo nota requerido!",
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
                $("#carga-nota").css("display", "block");
            },
            success: function (data) {
                $("#carga-nota").fadeOut("slow");
                $("#nota_modal").modal('hide');
                if (data.trim() == 'nota') {
                    showNotification('bg-teal', 'Nota actualizada con exito!', 'top', 'center', 'animated zoomInDown', 'animated zoomOutDown');
                    $("#nota-form")[0].reset();
                }
                main();
            }
        });
    }
});