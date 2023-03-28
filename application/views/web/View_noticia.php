<!-- inner page banner -->
<div id="inner_banner" class="section inner_banner_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="title-holder">
            <div class="title-holder-cell text-left" id="titulo"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end inner page banner -->
<!-- section -->
<div class="section padding_layout_1 blog_grid">
  <div class="container">
    <div class="row">
    <div class="col-md-2"></div>
      <div class="col-lg-8 col-md-9 col-sm-12 col-xs-12 pull-center">
        <div class="full">
          <div class="blog_section margin_bottom_0" >
            <div id="noticia"></div>
            <div id="galeria"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="section padding_layout_1 blog_grid">
  <div class="container">
    <div class="row" id="sugerencias"></div>
  </div>
</div>
  </div>
</div>
<!-- ACA ABAJO  -->
<?php if (isset($noti)): ?>
  <script>
    localStorage.setItem("NotiId", <?= $noti; ?>);
  </script>
<?php endif; ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/get_noticia.js"></script>
<script type="text/javascript">

$(document).ready(function(){

	var NotiId = localStorage.getItem("NotiId");
	var CatId = localStorage.getItem("CatId");

    $.ajax({
      url: host + 'periodico/contadores/Controller_contador_noticia/set_cooki',
      type: 'post',
      data: {
        NotiId:NotiId,
        CatId:CatId
      },
      success:function(data){
        console.log(data.trim())
      }
    })
})
</script>