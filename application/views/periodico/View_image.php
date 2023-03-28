<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            DropzoneJs
                            <small>Prueba para subir imagenes</small>
                        </h2>
                    </div>
                    <div class="container-fluid">
                        <div class="col-xs-12">
                            <div class="body">
                                <form id="frmFileUpload" class="dropzone">
                                    <div class="dz-message">
                                        <div class="drag-icon-cph">
                                            <i class="material-icons">add_a_photo</i>
                                        </div>
                                        <h3>Arrastra o has click para subir una o mas imagenes.</h3>
                                        <em>(Solo se permite subir archivos de imagenes con un maximo <strong>20MB</strong> de espacio por imagen.)</em>
                                    </div>
                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='fotoBtnId' data-fotoBtnId='gilberto se la come xD'>add_to_photos</i></b></button>
                    <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='prueba'>add_to_photos</i></b></button> -->
                    <!-- <div class="container-fluid">
                        <div class="col-xs-12">
                        <div class="table table-responsive">
                            <table id="tbprueba" class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th><center>xD</center></th>
                                        <th><center>Imagen</center></th>
                                        <th><center>Url</center></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
</section>


<script type="text/javascript">
    // $(document).on("click", "#fotoBtnId", function () {
    //     var foto = $(this).attr("data-fotoBtnId");
    //     localStorage.setItem("foto",foto);
    //     swal("Prueba!", foto, "success");
    // });

    // $(document).on("click", "#prueba", function () {
    //     var foto = localStorage.getItem("foto");
    //     swal("Prueba!", foto, "success");
    // });

    // $(document).on("ready", main);

    // function main() {
    //     $.ajax({
    //         url: host+"imagen_obtener",
    //         type: "POST",
    //         dataType: "json",
    //         success: function(response) {
    //             filas = "";
    //             var i = 0;
    //             $.each(response.imagen, function(key, item) {
    //                 i++;
    //                 filas += '<tr>';
    //                 filas += '<td>'+i+'</td>';
    //                 filas += '<td>'+item.titulo_foto+'</td>';
    //                 filas += '<td>'+item.url+'</td>';
    //                 filas += '</tr>';
    //             });
    //             $("#tbprueba tbody").html(filas);
    //         }
    //     });
    // }

    Dropzone.options.frmFileUpload = {
        url: host+"imagen_prueba",
        paramName: "file",
        // params: {'param_1':'file','para_2':'notiId'},
        acceptedFiles: 'image/*',
        maxFilesize: 20,
        autoQueue: true,
        addRemoveLinks: true,
        dictCancelUpload: true,
        dictFileTooBig:"Archivo muy grande ({{filesize}}MB). Tamaño Maximo: {{maxFilesize}}MB.",
        dictInvalidFileType:"Solo se permite subir imagenes!",
        dictRemoveFile:"Eliminar Imagen",
        // dictRemoveFileConfirmation: "Desea eliminar esta Imagen?",
        // dictCancelUploadConfirmation:"Desea eliminar esta imagen?",
        // dictCancelUpload:"Eliminar Imagen",
        init: function(){
            var myDropzone = this;
            $.ajax({
                url: host+"imagen_obtener",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    $.each(response.imagen, function(key, item) {
                        var mockFile = { name: item.titulo_foto, size: 20000000, type: 'image/*', url: host+"assets/upload/noticias/"+item.url, foto: item.url};
                        myDropzone.files.push(mockFile);
                        myDropzone.emit('addedfile', mockFile);
                        myDropzone.createThumbnailFromUrl(mockFile, mockFile.url);
                        myDropzone.emit('complete', mockFile);
                        myDropzone._updateMaxFilesReachedClass(); 
                    });
                }
            });

            // var mockFile = { name: "xd", size: 20000000, type: 'image/*', url: host+"assets/upload/noticias/17446365.png" };
            // myDropzone.files.push(mockFile);
            // myDropzone.emit('addedfile', mockFile);
            // myDropzone.createThumbnailFromUrl(mockFile, mockFile.url);
            // myDropzone.emit('complete', mockFile);
            // myDropzone._updateMaxFilesReachedClass();
        },
        // accept: function(file, done) {
        //     if (file.name == "prueba.png") {
        //         done("Naha, you don't.");
        //     } else {
        //         done(); 
        //     }
        // },
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
                    var name = file.foto;
                    $.ajax({
                        type: 'POST',
                        url: host+"imagen_borrar",
                        data: {
                                action: action,
                                name: name
                        },
                        beforeSend: function () { },
                        sucess: function(data){
                            console.log('success: ' + data);
                        }
                    });
                    var _ref;
                    if (file.previewElement) {
                        if ((_ref = file.previewElement) != null) {
                            _ref.parentNode.removeChild(file.previewElement);
                            swal("Eliminado!", "La acción se a completado exitosamente.", "success");
                        }
                    }
                    return this._updateMaxFilesReachedClass();
                } else {
                    swal("Cancelado", "La acción se a completado exitosamente.", "error");
                }
            });
        }
    };
</script>