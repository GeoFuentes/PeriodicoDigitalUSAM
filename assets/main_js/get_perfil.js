$("#preload").load(function(evt){
    $(this).fadeIn(1000);
});

$(document).on("ready",get_perfil());

function get_perfil(){
    var perfil = localStorage.getItem("PerfilId");
    filas = '';
    banner = '';
    var foto = '';
    var nombre = '';

    $.ajax({
        url: host+"Controller_web/get_perfil",
        type: "POST",
        data: {
            perfil: perfil
        },
        dataType: "json",
        success: function(response) {
            filas = '';
            banner = '';
            $.each(response.perfil, function(key, item) {
                nombre = item.nombre;
                foto = item.banner;
                
                if(foto !== ''){
                    banner += '<div id="preload" class="section padding_layout_1 testmonial_section white_fonts" style="background-image: url('+host+'assets/upload/perfiles/'+item.banner+');">';
                    banner += '<div class="container">';
                    banner += '<div class="row">';
                    banner += '<div class="col-md-12">';
                    banner += '<div class="full">';
                    banner += '<div class="main_heading text_align_left">';
                    banner += '<h2 style="text-transform: none;">Que opinan sobre '+nombre+'?</h2>';
                    banner += '<p class="large">Aqui tenemos algunas opiniones.</p>';
                    banner += '</div>';
                    banner += '</div>';
                    banner += '</div>';
                    banner += '</div>';
                    banner += '<div class="row">';
                    banner += '<div class="col-sm-7">';
                    banner += '<div class="full">';
                    $.each(response.comentarios, function(key, item) {
                        banner += '<div id="testimonial_slider" class="carousel slide" data-ride="carousel" style="height:175px;">';
                        banner += '<div class="carousel-inner">';
                        banner += '<div class="carousel-item active">';
                        banner += '<div class="testimonial-container">';
                        banner += '<div class="testimonial-content">'+item.comentario+'</div>';
                        banner += '<div class="testimonial-photo"> <img src="'+host+'assets/upload/perfiles/'+item.foto_comen+'" class="img-responsive" alt="#" width="150" height="150"> </div>';
                        banner += '<div class="testimonial-meta">';
                        banner += '<h4>'+item.nombre+'</h4>';
                        banner += '<span class="testimonial-position">'+item.titulo+'</span>';
                        banner += '</div>';
                        banner += '</div>';
                        banner += '<br>';
                        banner += '<br>';
                        banner += '</div>';
                        banner += '</div>';
                        banner += '</div>';
                    });
                    banner += '</div>';
                    banner += '</div>';
                    banner += '</div>';
                    banner += '<div class="col-sm-5">';
                    banner += '<div class="full"> </div>';
                    banner += '</div>';
                    banner += '</div>';
                    banner += '</div>';
                    banner += '</div>';
                } else {
                    banner += '<div id="inner_banner" class="section inner_banner_section">';
                    banner += '<div class="container">';
                    banner += '<div class="row">';
                    banner += '<div class="col-md-12">';
                    banner += '<div class="full">';
                    banner += '<div class="title-holder">';
                    banner += '<div class="title-holder-cell text-left">';
                    banner += '<h1 class="page-title">'+nombre+'</h1>';
                    banner += '<ol class="breadcrumb">';
                    banner += '<li><a href="'+host+'">Inicio</a></li>';
                    banner += '<li class="active"> Perfil </li>';
                    banner += '</ol>';
                    banner += '</div>';
                    banner += '</div>';
                    banner += '</div>';
                    banner += '</div>';
                    banner += '</div>';
                    banner += '</div>';
                    banner += '</div>';
                }

                filas = '';
                filas += '<div class="blog_feature_cantant">';
                filas += '<p class="blog_head">'+nombre+'</p>';
                filas += '<div class="post_info">';
                filas += '<ul>';
                filas += '<li><i class="fa fa-user" aria-hidden="true"></i> '+item.cargo+'</li>';
                filas += '<li><i class="fa fa-calendar" aria-hidden="true"></i> '+item.fecha_crea+'</li>';
                filas += '</ul>';
                filas += '</div>';
                filas += '<p> '+item.info+' </p>';
                filas += '</div>';
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
            $("#banner").html(banner);
            $("#perfil").html(filas);
        }
    });
}
