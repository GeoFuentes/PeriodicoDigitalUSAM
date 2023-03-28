$(document).on("ready",main);

function main(){
    listar_ediciones("",1,9);
}

$(document).on("keyup", "#busqueda", function () {
    var busqueda = $("#busqueda").val();
    var cantidad = $("#cantidad").val();
    listar_ediciones(busqueda,1,cantidad);
});

$(document).on("change", "#cantidad", function () {
    var busqueda = $("#busqueda").val();
    var cantidad = $("#cantidad").val();
    listar_ediciones(busqueda,1,cantidad);
});

$("body").on("click", ".pagination li", function () {
    var busqueda = $("#busqueda").val();
    var cantidad = $("#cantidad").val();
    indice = $(this).data("id");
    listar_ediciones(busqueda,indice,cantidad);
});

$(document).on("click", "#btnEdicion", function(e){
    e.preventDefault();
    var btnEdicionId = $(this).attr("data-btnEdicionId");
    localStorage.setItem("EdicionId", btnEdicionId);
    window.location.href = host + "noticias_edicion";
});

function listar_ediciones(buscar, pagina, cantidad){
    $.ajax({
        url: host+"Controller_web/listar_ediciones",
        type: "POST",
        data: {
            buscar: buscar,
            numeropagina: pagina,
            cantidad: cantidad
        },
        dataType: "json",
        success: function(response) {
            filas = "";
            $.each(response.ediciones, function(key, item) {
                    filas += '<div class="blog_section">';
                    filas += '<div class="service_img"><center><img class="img-responsive" src="'+host+'assets/upload/noticias/'+item.url+'" alt="#"/></center></div>';
                    filas += '<div class="blog_feature_cantant">';
                    filas += '<p class="blog_head">Edicion N° - '+item.num_edicion+'</p><br>';
                    filas += '<div class="text-primary"><strong>Ultima Noticia - '+item.titular+'</strong></div><br>';
                    filas += '<p>'+item.nota+'</p>';
                    filas += '<div class="post_info">';
                    filas += '<ul>';
                    filas += '<li><i class="fa fa-calendar" aria-hidden="true"></i>'+item.fecha_publicacion+'</li>';
                    filas += '</ul>';
                    filas += '</div>';
                    filas += '<div class="bottom_info">';
                    filas += '<br/>';
                    filas += '<div class="pull-left"><a class="btn sqaure_bt" id="btnEdicion" data-btnEdicionId="'+item.id_edicion+'" href="">Leer Mas<i class="fa fa-angle-right"></i></a></div>';
                    filas += '<div class="pull-right">';
                    filas += '<div class="shr">Share: </div>';
                    filas += '<div class="social_icon">';
                    filas += '<ul>';
                    filas += '<li class="fb"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
                    filas += '<li class="twi"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
                    filas += '<li class="gp"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>';
                    filas += '</ul>';
                    filas += '</div>';
                    filas += '</div>';
                    filas += '</div>';
                    filas += '</div>';
                    filas += '</div>';
                
                
            });
            $("#tb_ediciones").html(filas);

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