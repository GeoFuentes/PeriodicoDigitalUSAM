<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Noticias
                            <small>Aqui podras editar toda la información de las noticias del periodicos Patria Masferreriana</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown ">
                                <a aria-expanded="true" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button">
                                    <i class="material-icons waves-effect bg-<?php echo $tema; ?>" style="font-size: 30px" id="add">
                                        add_circle
                                    </i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="container-fluid">
                        <div class="col-xs-12">
                            <div class="body table-responsive">
                                <table id="tb-noticia" class="table table-bordered table-striped table-condensed">
                                    <thead class="">
                                        <tr>
                                            <th>#</th>
                                            <th>TITULO</th>
                                            <th>EDITOR</th>
                                            <th>REPORTERO</th>
                                            <th>CATEGORIA</th>
                                            <th>ENLACE</th>
                                            <th>EDICION</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-actions">
                                <div class="text-center paginacion">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>



<div class="modal fade" id="create_form_modal" data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="form-title"></h4>
            </div>
            <div class="modal-body">
                <div id="carga"></div>
                <form id="developer_cu_form">
                    <div class="modal-body users-cont">
                        <div class="row clearfix">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">receipt</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Titulo" id="titulo" name="titulo">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">receipt</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Subtitulo" name="subtitulo" id="subtitulo">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">add_a_photo</i>
                                </span>
                                <div class="form-line">
                                    <img src="" id="foto" style="width: 25%;">
                                    <input type="file" class="form-control date" placeholder="Portada" name="url_foto" id="url_foto">
                                    <input type="hidden" name="url" id="url">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Fotografo" name="fotografo" id="fotografo">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line" id="bs_datepicker_container">
                                    <input type="date" class="form-control date" placeholder="Fecha" name="fecha" id="fecha">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Editor" name="editor" id="editor">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Reportero" name="reportero" id="reportero">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">content_paste</i>
                                </span>
                                <div>
                                    <select name="categoria" id="categoria" data-live-search="true" style="width: 100%;">
                                        <option selected="selected" value="">*Seleccione una Categoria*</option>
                                        <?php foreach ($categorias as $c) { ?>
                                            <option value="<?php echo $c["id_cat_noticia"]; ?>" data-icon="<?php echo $c["nc_icono"]; ?>">
                                                <?php echo $c["nc_noticia"]; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">attach_file</i>
                                </span>
                                <div>
                                    <select name="edicion" id="edicion" data-live-search="true" style="width: 100%;">
                                        <option selected="selected" value="">*Seleccione una Edicion*</option>
                                        <?php foreach ($ediciones as $e) { ?>
                                            <option value="<?php echo $e["id_edicion"]; ?>">
                                                Edicion Nro <?php echo $e["num_edicion"]; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">bookmark</i>
                                </span>
                                <div>
                                    <select name="nivel" id="nivel" style="width: 100%;">
                                        <option selected="selected" value="">*Seleccione Nivel*</option>
                                        <option value="1" data-icon="fa fa-check-circle">Principal</option>
                                        <option value="2" data-icon="fa fa-times-circle">Secundaria</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="updateId" name="updateId">
                    <input type="hidden" id="fotoId" name="fotoId">
                    <input type="hidden" name="action" id="action" value="create">
            </div>
            <div class="modal-footer">
                <button class="btn bg-<?php echo $tema; ?> waves-effect" type="submit" name="submit" id="submit"><b id="nombreb"></b>
                </button>
                </form>
                <button class="btn btn-link waves-effect" id="cancelar" data-dismiss="modal" type="button">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="url_modal" data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="form-not"></h4>
            </div>
            <div class="modal-body">
                <div id="carga_url"></div>
                <a class="text-decoration-none" target="_blank" id="url_noti"></a>

            </div>
            <div class="modal-footer">
                <button class="btn btn-link waves-effect" id="cerrar" data-dismiss="modal" type="button">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nota_modal" data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="nota-title"></h4>
            </div>
            <div class="modal-body">
                <div id="carga-nota"></div>
                <form id="nota-form">
                    <div class="modal-body users-cont">
                        <div class="row clearfix">
                            <div class="body">
                                <textarea name="nota" id="nota"></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="updateIdNota" name="updateIdNota">
                    <input type="hidden" name="actionNota" id="actionNota">
            </div>
            <div class="modal-footer">
                <button class="btn bg-<?php echo $tema; ?> waves-effect" type="submit" name="submit" id="submit"><b id="btn-nota"></b></button>
                <button class="btn btn-link waves-effect" data-dismiss="modal" type="button">
                    Cancelar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="foto_modal" data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="foto-title"></h4>
            </div>
            <div class="modal-body">
                <div id="carga-foto"></div>
                <div class="modal-body users-cont">
                    <div class="row clearfix">
                        <div class="body">
                            <form id="frmFileUpload" class="dropzone">
                                <div class="dz-message" id='xd'>
                                    <div class="drag-icon-cph">
                                        <i class="material-icons">add_a_photo</i>
                                    </div>
                                    <h3>Arrastra o has click para subir una o mas imagenes.</h3>
                                    <em>(Solo se permite subir archivos de imagenes con un maximo <strong>20MB</strong> de espacio por imagen.)</em>
                                </div>
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                                <input id="notiId" name="notiId" type="hidden" />
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-link waves-effect" data-dismiss="modal" type="button">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="<?php echo base_url(); ?>assets/select2/css/select2.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/select2/js/select2.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/noticias.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/editor_noticia.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/foto_noticia.js"></script>