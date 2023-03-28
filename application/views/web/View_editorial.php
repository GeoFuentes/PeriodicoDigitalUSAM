<div id="inner_banner" class="section inner_banner_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="title-holder">
                        <div class="title-holder-cell text-left">
                            <div id="titulo"></div>
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
                    </select>
                </p>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="Buscar noticia..." />
                <br>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-8" id="tb_noticias">

                            
                                
                                
                                    
                                        
                                        
                                        
                                        
                                    
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                  <div align="center">
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
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/lista_editorial.js"></script>