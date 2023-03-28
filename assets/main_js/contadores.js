$(document).on("ready",listar_ediciones);
$(document).on("ready",listar_noticias);
$(document).on("ready",obtener_categoria);


function obtener_categoria(){
    filas = "<h1 class='page-title'>Tendencias</h1>";
    $("#titulo").html(filas);
}

function listar_noticias(){
    $.ajax({
        url: host+"Controller_web/listar_contadores",
        type: "POST",
        dataType: "json",
        success: function(response) {
            filas = "";
            $.each(response.table, function(key, item) {
                filas += '<div class="col-md-4 service_blog margin_bottom_50">';
                filas += '<div class="full" style="height:500px;">';
                filas += '<div class="service_img"><center><img class="img-responsive" src="'+host+'assets/upload/noticias/'+item.url+'" style="width:100%; height: 250px; object-fit: cover !important; object-position: 100% 0;" alt="#"/></center></div>';
                filas += '<div class="blog_feature_cantant">';
                filas += '<ul>';
                filas += '<li><i class="fa fa-user" aria-hidden="true"></i> '+item.Editor+'</li>';
                filas += '<li><i class="fa fa-comment" aria-hidden="true"></i> '+item.Reportero+'</li>';
                filas += '<li><i class="fa fa-calendar" aria-hidden="true"></i> '+item.Fecha+'</li>';
                filas += '<li><i class="fa fa-eye" aria-hidden="true"></i> '+item.top+'</li>';
                filas += '</ul>';
                filas += '<div class="post_info">';
                filas += '<br>';
                filas += '<br>';
                filas += '<h3 class="service_head"><a id="btnNoticia" data-btnNoticiaId="'+item.id_noticia+'" href="">'+item.Titular+'</a></h3>';
                filas += '<div class="hidden-xs"><p>'+item.Nota+'......</p></div>';
                filas += '</div>';
                filas += '</div>';
                filas += '</div>';
                filas += '</div>';
            });
            $("#tb_noticias").html(filas);

           
        }
    });

    

    
}

function listar_ediciones(){
    $.ajax({
        url: host+"Controller_web/listar_contadores_edi",
        type: "POST",
        dataType: "json",
        success: function(response) {
            filas = "";
            $.each(response.table, function(key, item) {
                    
                filas += '<div class="col-md-4 service_blog margin_bottom_50">';
                filas += '<div class="full" style="height:500px;">';
                filas += '<div class="service_img"><center><img class="img-responsive" src="'+host+'assets/upload/noticias/'+item.url+'" style="width:100%; height: 250px; object-fit: cover !important; object-position: 100% 0;" alt="#"/></center></div>';
                filas += '<div class="blog_feature_cantant">';
                filas += '<ul>';
                filas += '<li><i class="fa fa-calendar" aria-hidden="true"></i> '+item.fecha_publicacion+'</li>';
                filas += '<li><i class="fa fa-eye" aria-hidden="true"></i> '+item.top+'</li>';
                filas += '</ul>';
                filas += '<div class="post_info">';
                filas += '<br>';
                filas += '<br>';
                filas += '<h3 class="service_head"><a id="btnEdicion" data-btnEdicionId="'+item.id_edicion+'" href=""> Edicion N°' +item.num_edicion+'</a></h3>';
                filas += '<div class="hidden-xs"><p>'+item.nota+'......</p></div>';
                filas += '</div>';
                filas += '</div>';
                filas += '</div>';
                filas += '</div>';     
                
                
            });
            $("#tb_ediciones").html(filas);
        }
    });
}

$(document).on("click", "#btnEdicion", function(e){
    e.preventDefault();
    var btnEdicionId = $(this).attr("data-btnEdicionId");
    localStorage.setItem("EdicionId", btnEdicionId);
    window.location.href = host + "noticias_edicion";
});