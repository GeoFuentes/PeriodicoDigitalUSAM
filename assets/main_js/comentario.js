$(document).on("click", "#btnComentario", function () {
    var idperfiles = $(this).attr("data-btnComentario");
    $("#idperfiles").val(idperfiles);
    listar_comentarios(idperfiles);
    $("#carga-comentario").fadeOut("slow");
    $(".form-line").removeClass("focused");
    $("#form-comentario")[0].reset();
    $("#comentario-title").text("Agregar Comentario");    
    $("#nombreb").text("Agregar");
    $("#modal-perfil").modal("show");
});

function listar_comentarios(perfilId){
    var action = 'get';
    $.ajax({
        url: host+"periodico/Controller_comentario/listar_comentarios",
        type: "POST",
        data:{
            perfilId: perfilId,
            action: action
        },
        dataType: "json",
        success: function(response) {
            table = "";
            var i = 0;
            $.each(response.comen, function(key, item) {
                i++;
                estado = item.estado;
                table += '<tr>';					
                table += '<td>'+i+'</td>';
                table += '<td>'+item.nombre+'</td>';
                table += '<td>'+item.titulo+'</td>';									
                table += '<td>'+item.comentario+'</td>';
                if(estado == 1){
                    table += "<td><i class='material-icons' style='color:green;'>done</i></td>";
                } else {
                    table += "<td><i class='material-icons' style='color:red;'>clear</i></td>";
                }
                table += '<td><img src=" '+ host +'assets/upload/perfiles/'+ item.foto_comen + '" width="50"></td>';
                table += '<td><center><button id="btnEditComen" data-btnEditComen="'+item.idComentario+'" class="btn bg-teal waves-effect btn-xs"><i class="material-icons" style="font-size: 30px">create</i></center></button></td>';				
                table += '</td>';
                table += '</tr>';
            });
            if (i == 0){
                table += '<tr><td colspan="7"><h4 align="center">Sin Comentarioss!</h4></td></tr>';
            }
            $("#tb-comentario tbody").html(table);
        }
    });
}

$(document).on("submit", "#form-comentario", function (e) {e.preventDefault();
    var idperfiles = $("#idperfiles").val();
    var nombre = $("#nombreComen").val();    
    var comentario = $("#comentario").val();
	var titulo = $("titulo").val();
	var estado = $("estado_comen").val();
	var foto_comen = $("#foto_comen").val();
    var foto_hidden = $("#com_hidden").val();

    if (nombre == '') {
        swal({
            title: "Campo nombre requerido",
            type: "warning"
        });
    } else if (comentario == '') {
        swal({
            title: "Campo comentario requerido",
            type: "warning"
        });
    } else if (titulo == '') {
        swal({
            title: "Campo titulo requerido",
            type: "warning"
        }); 
	} else if (foto_comen && foto_hidden == '') {
		swal({
			title: "Fotografia requerida",
			type: "warning"
		});
	} else if (estado == '') {
		swal({
			title: "Estado requerido",
			type: "warning"
		});
    } else {
        $.ajax({
            url: "periodico/Controller_comentario/actualizar_crear_comentario",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#carga-comentario").css("display", "block");
            },
            success: function (data) {
                $("#estado_comen").val("");
                $("#estado_comen").change();
                listar_comentarios(idperfiles);
                $("#carga-comentario").fadeOut("slow");
                if (data.trim() == 'created') {
                    showNotification('bg-teal', 'Registro agregado con exito', 'top', 'center', 'animated zoomInDown', 'animated zoomOutDown');
                    $("#form-comentario")[0].reset();
                }
                if (data.trim() == 'update') {
                    $("#actionComen").val('create');
                    showNotification('bg-teal', 'Registro actualizado con exito', 'top', 'center', 'animated zoomInDown', 'animated zoomOutDown');
                    $("#form-comentario")[0].reset();
                }
            }
        });
    }
});


    $(document).on("click", "#btnEditComen", function (e) {
        e.preventDefault();
        var btnEditComen = $(this).attr('data-btnEditComen');
        var action = 'fetchSingleRow';
        $.ajax({
            url: "periodico/Controller_comentario/linea_actualizar",
            method: "POST",
            data: {
                btnEditComen: btnEditComen,
                action: action
            },
            dataType: "json",
            beforeSend: function () {
                $("#carga-comentario").css("display", "block");                
            },
            success: function (data) {
                $("#carga-comentario").fadeOut("slow");
                $("#estado_comen").val(data.estado);
                $("#estado_comen").change();
                $("#nombreComen").val(data.nombre);
                $("#comentario").val(data.comentario);
                $("#titulo").val(data.titulo);
                $("#idperfiles").val(data.idperfiles);                              
                $("#com_hidden").val(data.foto_comen);
                $("#actionComen").val('update');
                // $("#nombreb").html('Actualizar');
                $("#updateIdComen").val(data.idComentario);
            }
        });
    });
    