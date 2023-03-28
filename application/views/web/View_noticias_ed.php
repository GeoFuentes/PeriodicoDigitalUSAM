<div id="inner_banner" class="section inner_banner_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="title-holder">
                        <div class="title-holder-cell text-left">
                            <h1 class="page-title"><?= $titulo ?></h1>
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url(); ?>">Inicio</a></li>
                                <li class="active"><?= $titulo ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section padding_layout_1 light_silver">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <p>
                    <strong>Mostrar por : </strong>
                    <select name="cantidad" id="cantidad">
                        <option value="9">9</option>
                        <option value="12">12</option>
                        <option value="12">15</option>
                        <option value="12">18</option>
                    </select>
                </p>
            </div>
            <div class="col-md-3" >
                <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="Buscar noticia..." />
                <br>
            </div>
            <div class="full">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="tb_noticias"></div>
            </div>
            <div class="row">
                  <div align="center"></div>  
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function(){

	var EdiId = localStorage.getItem("EdicionId");
	var CatId = localStorage.getItem("CatId");
    console.log(EdiId);

     $.ajax({
      url: host + 'periodico/contadores/Controller_contador_edicion/set_cooki',
      type: 'post',
      data: {
        EdiId:EdiId,
        CatId:CatId
      },
      success:function(data){
        console.log(data.trim())
      }
    }) 
})
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/ediciones_noticias.js"></script>