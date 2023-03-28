Dropzone.options.frmFileUpload = {
    url: host+"imagen_subir",
    // paramName: "file",
    params: {'param_1':'file','param_2':'notiId'},
    acceptedFiles: 'image/*',
    maxFilesize: 20,
    autoQueue: true,
    addRemoveLinks: true,
    dictCancelUpload: true,
    dictFileTooBig:"Archivo muy grande ({{filesize}}MB). Tamaño Maximo: {{maxFilesize}}MB.",
    dictInvalidFileType:"Solo se permite subir imagenes!",
    dictRemoveFile:"Eliminar Imagen",
    init: function(){},
    removedfile: function(file) {
        swal({
            title: "Estas seguro?",
            text: "Si eliminas la imagen, se borrara de forma permanente!",
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
        },function (isConfirm) {
            if (isConfirm) {
                var action = 'delete';
                var name = file.photo;
                var fotoId = file.fotoId;
                $.ajax({
                    type: 'POST',
                    url: host+"imagen_borrar",
                    data: {
                            action: action,
                            name: name,
                            fotoId: fotoId
                    },
                    beforeSend: function () { },
                    sucess: function(data){
                        if (data.trim() == 'deleted') {
                            swal("Eliminado!", "La acción se a completado exitosamente.", "success");
                        }
                    },
                    error: function () {
                        swal("Error", "Intenta de nuevo, si el error persiste contacta a tu administrador.", "error");
                    }
                });
                swal("Eliminado!", "La acción se a completado exitosamente.", "success");
                var _ref;
                if (file.previewElement) {
                    if ((_ref = file.previewElement) != null) {
                        _ref.parentNode.removeChild(file.previewElement);
                    }
                }
                return this._updateMaxFilesReachedClass();
            } else {
                swal("Cancelado", "La acción se a completado exitosamente.", "error");
            }
        });
    }
};

$(document).on("click", "#fotoBtnId", function () {
    // $('#frmFileUpload').empty();
    $('.dz-preview').remove();

    var notiId = $(this).attr("data-fotoBtnId");
    $("#notiId").val(notiId);
    var action = 'get';
    $.ajax({
        url: host+"imagen_obtener",
        type: "POST",
        data:{
                notiId: notiId,
                action: action
            },
        dataType: "json",
        beforeSend: function () {
            $("#carga-foto").css("display", "block");
            $("#foto_modal").modal("show");
        },
        success: function(response) {
            var myDropzone = Dropzone.forElement("#frmFileUpload");
            $.each(response.imagen, function(key, item) {
                var mockFile = { name: item.titulo_foto, size: 20000000, type: 'image/*', url: host+"assets/upload/noticias/"+item.url, fotoId: item.id_foto, photo:item.url };
                myDropzone.files.push(mockFile);
                myDropzone.emit('addedfile', mockFile);
                myDropzone.createThumbnailFromUrl(mockFile, mockFile.url);
                myDropzone.emit('complete', mockFile);
                myDropzone._updateMaxFilesReachedClass(); 
            });
            $("#foto-title").text("Galeria de Fotos");
            $("#foto_modal").modal("show");
        }
    });
});