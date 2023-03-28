
$(document).on("ready",get_noticias());
$(document).on("ready",get_galeria());
$(document).on("ready",get_sugerencias());


function get_noticias(){
    var noti = localStorage.getItem("NotiId");
    $.ajax({
        url: host+"Controller_web/get_noticia",
        type: "POST",
        data: {
          noticia: noti
        },
        dataType: "json",
        success: function(response) {
            filas = '';
            banner = '';
            titulo = '';
            categoria = '';
            $.each(response.noticia, function(key, item) {
                titulo = item.Titular;
                categoria = '<i class="'+item.nc_icono+'" aria-hidden="true"></i> '+item.nc_noticia;
                filas += '<div class="blog_feature_img"> <img class="img-responsive" src="'+host+'assets/upload/noticias/'+item.url+'" alt="#"></div>';
                filas += '<div class="blog_feature_cantant">';
                filas += '<p class="blog_head">'+item.Titular+'</p>';
                filas += '<p class="">'+item.Subtitulo+'</p>';
                filas += '<div class="post_info">';
                filas += '<ul>';
                filas += '<li><i class="'+item.nc_icono+'" aria-hidden="true"></i> '+item.nc_noticia+'</li>';
                filas += '<li><i class="fa fa-user" aria-hidden="true"></i> '+item.Editor+'</li>';
                filas += '<li><i class="fa fa-pencil" aria-hidden="true"></i> '+item.Reportero+'</li>';
                filas += '<li><i class="fa fa-camera" aria-hidden="true"></i> '+item.Fotografo+'</li>';
                filas += '<li><i class="fa fa-calendar" aria-hidden="true"></i> '+item.Fecha+'</li>';
                filas += '</ul>';
                filas += '</div>';
                filas += '<p>'+item.Nota+'';
                filas += '</div>';
                filas += '<div class="full testimonial_simple_say margin_bottom_30_all" style="margin-top:0;">';
                filas += '<div class="bottom_info margin_bottom_30_all">';
                filas += '<div class="pull-right">';
                filas += '<div class="shr">Compartir: </div>';
                filas += '<div class="social_icon">';
                filas += '<ul>';
                filas += '<li class="fb"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
                filas += '<li class="twi"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
                filas += '<li class="gp"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>';
                filas += '<li class="pint"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>';
                filas += '</ul>';
                filas += '</div>';
                filas += '</div>';
                filas += '</div>';
            });

            banner += '<h1 class="page-title">'+titulo+'</h1>';
            banner += '<ol class="breadcrumb">';
            banner += '<li><a href="'+host+'">Inicio</a></li>';
            banner += '<li class="active">'+categoria+'</li>';
            banner += '</ol>';
            
            $("#titulo").html(banner);
            $("#noticia").html(filas);
        }
    });
    
}

function get_galeria(){
    var noti = localStorage.getItem("NotiId");
    $.ajax({
        url: host+"Controller_web/get_galeria",
        type: "POST",
        data: {
          noticia: noti
        },
        dataType: "json",
        success: function(response) {
            filas = '';
            $.each(response.galeria, function(key, item) {
                filas += '<a class="custom-selector col-lg-4 col-md-4 col-sm-6 col-xs-6" data-fancybox="gallery" href="'+host+'assets/upload/noticias/'+item.url+'">';
                filas += '<img class="img-responsive thumbnail" style="width:100%; height: 150px; object-fit: cover !important; object-position: 100% 0;" src="'+host+'assets/upload/noticias/'+item.url+'">';
                filas += '</a>';
                
            });
            $("#galeria").html(filas);
        }
    });
}



function get_sugerencias(){
    $.ajax({
        url: host+"Controller_web/get_sugerencias",
        type: "POST",
        dataType: "json",
        success: function(response) {
            i = 0;
            c = 0;
            filas = '';
            $.each(response.sugerencias, function(key, item) {
                i++;
                c++;
                if(i == 1){
                    filas += '<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">';
                    filas += '<div class="full">';
                }
                filas += '<div class="blog_section">';
                filas += '<div class="blog_feature_img"><img class="img-responsive" src="'+host+'assets/upload/noticias/'+item.url+'" alt="#"></div>';
                if(c % 2 == 0){
                    filas += '<div class="blog_feature_cantant">';
                } else {
                    filas += '<div class="blog_feature_cantant theme_color_bg white_fonts"">';
                }
                filas += '<p class="blog_head">'+item.Titular+'</p>';
                filas += '<div class="post_info">';
                filas += '<ul>';
                filas += '<li><i class="'+item.nc_icono+'" aria-hidden="true"></i> '+item.nc_noticia+'</li>';
                filas += '<li><i class="fa fa-pencil" aria-hidden="true"></i> '+item.Reportero+'</li>';
                filas += '<li><i class="fa fa-calendar" aria-hidden="true"></i> '+item.Fecha+'</li>';
                filas += '</ul>';
                filas += '</div>';
                filas += '<p>'+item.Nota+'...';
                filas += '<div class="bottom_info">';
                filas += '<div class="pull-left"><a class="read_more" id="btnNoticia" data-btnNoticiaId="'+item.id_noticia+' href="">Leer Mas <i class="fa fa-angle-right"></i></a></div>';
                filas += '<div class="pull-right">';
                filas += '<div class="shr">Compartir: </div>';
                filas += '<div class="social_icon">';
                filas += '<ul>';
                filas += '<li class="fb"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
                filas += '<li class="twi"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
                filas += '<li class="gp"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>';
                filas += '<li class="pint"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>';
                filas += '</ul>';
                filas += '</div>';
                filas += '</div>';
                filas += '</div>';
                filas += '</div>';
                filas += '</div>';
                if(c % 3 == 0){
                    i = 0;
                    filas += '</div>';
                    filas += '</div>';
                }
                
            });
            $("#sugerencias").html(filas);
        }
    });
}

