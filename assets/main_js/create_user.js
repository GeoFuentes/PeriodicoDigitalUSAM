 $(document).on("ready", main);

function main() {
    var table = $('#tbuser').DataTable()
    table.destroy();
    table = $('#tbuser').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": host + "Controller_usuarios/listar_usuario",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [-1],
            "orderable": false,
        },],
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
                 url: "Controller_usuarios/eliminar_usuario",
                 method: "POST",
                 data: {
                     delteBtnId: delteBtnId,
                     action: action
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

$(document).on("click", "#add", function () {
    $("#carga").fadeOut("slow");
    $("#action").val("create");
    $(".form-line").removeClass("focused");
    $("#developer_cu_form")[0].reset();
    $("#form-title").text('Crear usuario');
    $("#nombreb").html('Agregar');
    $("#create_form_modal").modal("show");
})

//  $(document).on("click", "#create_acc_btn", function(e) {
//      e.preventDefault();
//      $("#developer_cu_form")[0].reset();
//      $("#form-title").text('Crear usuario');
//      $("#action").val('create');
//      $("#nombreb").html('Crear');
//  });

 $(document).on("click", "#editBtnId", function(e) {
     e.preventDefault();
     var editBtnId = $(this).attr('data-editBtnId');
     var action = 'fetchSingleRow';
     $.ajax({
         url: "Controller_usuarios/linea_actualizar",
         method: "POST",
         data: {
             editBtnId: editBtnId,
             action: action
         },
         dataType: "json",
         beforeSend: function() {
             $("#carga").css("display","block");
             $("#create_form_modal").modal('show');
         },
         success: function(data) {
             $("#carga").fadeOut("slow");
             $("#id_rol").val(data.id_rol);
             $("#id_rol").change();
             $("#nombre").val(data.nombre);
             $("#nombre_completo").val(data.nombre_completo);
             $("#estado").val(data.estado);
             $("#estado").change();
             $("#form-title").text('Editar usuario');
             $("#action").val('update');
             $("#nombreb").html('Actualizar');
             $("#updateId").val(editBtnId);
         }
     });
 });
 
 $(document).on("submit", "#developer_cu_form", function(e) {
     e.preventDefault();
     var nombre = $("#nombre").val();
     var nombre_completo = $("#nombre_completo").val();
     var clave = $("#clave").val();
     var id_rol = $("#id_rol").val();
     var estado = $("#estado").val();
     var clave2 = $("#clave2").val();
     var action = $("#action").val();
     if (nombre == '') {
         swal({
             title: "Campo nombre requerido",
             type: "warning"
         });
     } else if (nombre_completo == '') {
         swal({
             title: "Campo Nombre completo requerido",
             type: "warning"
         });
     } else if (id_rol == '') {
         swal({
             title: "Campo rol requerido",
             type: "warning"
         });
     } else if (estado == '') {
         swal({
             title: "Campo estado requerido",
             type: "warning"
         });
     } else if (action == 'create' && clave == '') {
         swal({
             title: "Campo clave requerido",
             type: "warning"
         });
     } else {
         $.ajax({
             url: "Controller_usuarios/actualizar_crear_usuario",
             method: "POST",
             data: new FormData(this),
             contentType: false,
             processData: false,
             beforeSend: function() {
             $("#carga").css("display","block");
         },
             success: function(data) {
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