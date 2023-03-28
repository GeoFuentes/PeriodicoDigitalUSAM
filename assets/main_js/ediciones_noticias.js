$(document).on("ready",main);

function main(){
    listar_noticias("",1,9);
}

$(document).on("keyup", "#busqueda", function () {
    var busqueda = $("#busqueda").val();
    var cantidad = $("#cantidad").val();
    listar_noticias(busqueda,1,cantidad);
});

$(document).on("change", "#cantidad", function () {
    var busqueda = $("#busqueda").val();
    var cantidad = $("#cantidad").val();
    listar_noticias(busqueda,1,cantidad);
});

$("body").on("click", ".pagination li", function () {
    var busqueda = $("#busqueda").val();
    var cantidad = $("#cantidad").val();
    indice = $(this).data("id");
    listar_noticias(busqueda,indice,cantidad);
});

function listar_noticias(buscar, pagina, cantidad){
    var edicion = localStorage.getItem("EdicionId");
    $.ajax({
        url: host+"Controller_web/listar_edicion",
        type: "POST",
        data: {
            edicion: edicion,
            buscar: buscar,
            numeropagina: pagina,
            cantidad: cantidad
        },
        dataType: "json",
        success: function(response) {
            filas = "";
            if(response.totalregistros < 1){
                filas += '<div class="text-center"><h3 class="text-success">La Edición N° - '+edicion+' no tiene noticias.</h3></div>';
            }
            $.each(response.noticias, function(key, item) {
                
                filas += '<div class="col-md-4 service_blog margin_bottom_50">';
                filas += '<div class="full" style="height:500px;">';
                filas += '<div class="blog_section">';
                filas += '<div class="service_img"><center>';
                filas += '<img class="img-responsive" src="'+host+'assets/upload/noticias/'+item.url+'" style="width:100%; height: 200px; object-fit: cover !important; object-position: 100% 0;" alt="#"/>';
                filas += '</center></div>';
                filas += '<div class="blog_feature_cantant">';
                filas += '<div class="post_info">';
                filas += '<ul>';
                filas += '<li><i class="fa fa-user" aria-hidden="true"></i> '+item.Editor+'</li>';
                filas += '<li><i class="fa fa-comment" aria-hidden="true"></i> '+item.Reportero+'</li>';
                filas += '<li><i class="fa fa-calendar" aria-hidden="true"></i> '+item.Fecha+'</li>';
                filas += '</ul>';
                filas += '</div>';
                filas += '<div class="service_cont">';
                filas += '<hr>';
                filas += '<h3 class="service_head"><a id="btnNoticia" data-btnNoticiaId="'+item.id_noticia+'" href="">'+item.Titular+'</a></h3>';
                filas += '<p>'+item.Nota+'</p>';
                filas += '</div>';
                filas += '</div>';
                filas += '</div>';
                filas += '</div>';
                filas += '</div>';

                
            });
            $("#tb_noticias").html(filas);

            linkseleccionado = Number(pagina);
            //total registros
            totalregistros = response.totalregistros;
            //cantidad de registros por pagina
            cantidadregistros = response.cantidad;
            numerolinks = Math.ceil(totalregistros / cantidadregistros);
            paginador = "<ul class='pagination'>";
            if (linkseleccionado > 1) {
                paginador += "<li data-id='1'><a>&laquo;</a></li>";
                paginador += "<li data-id='" + (linkseleccionado - 1) + "'><a>&lsaquo;</a></li>";
            } else {
                paginador += "<li class='disabled'><a>&laquo;</a></li>";
                paginador += "<li class='disabled'><a>&lsaquo;</a></li>";
            }
            //muestro de los enlaces 
            //cantidad de link hacia atras y adelante
            cant = 2;
            //inicio de donde se va a mostrar los links
            pagInicio = (linkseleccionado > cant) ? (linkseleccionado - cant) : 1;
            //condicion en la cual establecemos el fin de los links
            if (numerolinks > cant) {
                //conocer los links que hay entre el seleccionado y el final
                pagRestantes = numerolinks - linkseleccionado;
                //defino el fin de los links
                pagFin = (pagRestantes > cant) ? (linkseleccionado + cant) : numerolinks;
            } else {
                pagFin = numerolinks;
            }
            for (var i = pagInicio; i <= pagFin; i++) {
                if (i == linkseleccionado) paginador += "<li class='active'><a" + i + "</a></li>";
                else paginador += "<li data-id='"+i+"'><a>" + i + "</a></li>";
            }
            //condicion para mostrar el boton sigueinte y ultimo
            if (linkseleccionado < numerolinks) {
                paginador += "<li data-id='" + (linkseleccionado - 1) + "'><a>&rsaquo;</a></li>";
                paginador += "<li data-id='"+numerolinks+"'><a>&raquo;</a></li>";
            } else {
                paginador += "<li class='disabled'><a>&rsaquo;</a></li>";
                paginador += "<li class='disabled'><a>&raquo;</a></li>";
            }
            paginador += "</ul>";
            $(".paginacion").html(paginador);
        }
    });
}