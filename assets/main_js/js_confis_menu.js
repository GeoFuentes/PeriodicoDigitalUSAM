$(document).on("ready", function() {


    var datofull = localStorage.getItem('datofull'); 
    $("#ocuno").val(localStorage.getItem("position"));

    if (datofull == 'si') {
        $("section.content").css("margin", "100px 20px 0 20px");
        $(".min-menu").css("display", "inline-block");
        $("#leftsidebar").css("display","none");
    }else{
       if (window.innerWidth > 1169) {
        if (localStorage.getItem("position") == 1) {
        $("section.content").css("margin", "100px 20px 0 20px");
        $(".min-menu").css("display", "inline-block");
        $("#leftsidebar").css("display","none");
    } else if (localStorage.getItem("position") == 0) {
        $(".min-menu").css("display", "none");
        $("#leftsidebar").css("display","block");
        $("section.content").css("margin", "100px 20px 0 240px");
    }
    }else{
         $("#desmen").css("display", "none");
    } 
    }

    

    $(".modal-header").css("cursor", "move");
    $(".modal").draggable({
        handle: '.modal-header',
    });
})


function full_screen(d = ''){



}

/*setInterval(comprueba_sesion, 40000);

function comprueba_sesion() {
    $.ajax({
        url: host + 'Controller_home/comprueba_sesion',
        method: 'POST',
        data: {},
        beforeSend: function() {},
        success: function(data) {
            if (data.trim() == 'expiro') {
                $("#sesion").modal('show');
            } else {}
        },
        error() {}
    })
}

function aniamas() {
    $("#sesion").animateCss('hinge');
    location.reload();
}*/

function cambio_cliente(valor1, valor2) {
    var cliente = valor1;
    var nombre = valor2;
    $.ajax({
        url: host + "Controller_home/cambio_cliente",
        method: "POST",
        data: {
            cliente: cliente,
            nombre: nombre
        },
        beforeSend: function() {},
        success: function() {
            location.reload();
        },
        error: function() {},
    })
}
$(document).ready(function() {
    $('.ir-arriba').click(function() {
        $('body, html').animate({
            scrollTop: '0px'
        }, 300);
    });
    $(window).scroll(function() {
        if ($(this).scrollTop() > 0) {
            $('.ir-arriba').slideDown(300);
        } else {
            $('.ir-arriba').slideUp(300);
        }
    });
});
Offline.on('confirmed-down', function() {
    /*$("#modal_dino").modal("show");*/
});
Offline.on('confirmed-up', function() {
    /*$("#modal_dino").modal("hide");*/
});
var run = function() {
    if (Offline.state === 'up') Offline.check();
}
setInterval(run, 40000);
$(document).on("click", "#desmen", function() {
    if ($("#ocuno").val() == 0) {
        $("#leftsidebar").fadeOut();
        $("section.content").css("margin", "100px 20px 0 20px");
        $("#ocuno").val("1");
        $(".min-menu").fadeIn();
        localStorage.setItem("position", 1);
    } else if ($("#ocuno").val() == 1) {
        $("#leftsidebar").fadeIn();
        $("section.content").css("margin", "100px 20px 0 240px");
        $("#ocuno").val("0");
        $(".min-menu").fadeOut()
        localStorage.setItem("position", 0);
    }
})