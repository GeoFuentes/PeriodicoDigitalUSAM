<!-- inner page banner -->
<div id="inner_banner" class="section inner_banner_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="title-holder">
            <div class="title-holder-cell text-left">
              <h1 class="page-title">Perfiles</h1>
              <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li class="active">Lista de perfiles</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end inner page banner -->

<!-- section -->
<div class="section padding_layout_1 light_silver">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <div class="full">
              <div class="main_heading text_align_center">
                  <h1>Perfiles</h1>
              </div>
          </div>
      </div>
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
      <div class="col-md-3">
          <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="Buscar perfil..." />
          <br>
      </div>
      <div class="col-md-12" id="tb_perfiles"></div>
      <div class="col-md-12">
        <br>
        <div class="center paginacion"></div>
        <div>
        </div>
        <br>
        <br>
        <br>
      </div>
    </div>
  </div>
</div>
<!-- end section -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/lista_perfiles.js"></script>