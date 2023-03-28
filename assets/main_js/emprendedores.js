// modal 1
$(document).on("click", "#add", function () {
    $("#carga").fadeOut("slow");
    $("#action").val("create");
    $(".form-line").removeClass("focused");
    $("#developer_cu_form")[0].reset();
    $("#estado").val("");
    $("#estado").change();
    $("#form-title").text("Agregar Emprendedor");
    $("#nombreb").text("Agregar");
    $("#create_form_modal").modal("show");
});
// modal 2

