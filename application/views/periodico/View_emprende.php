<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Emprendedores
                            <small>Aqui podras editar toda la información de los emprendedores</small>
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
                                <table id="tb-perfiles" class="table table-bordered table-striped table-condensed">
                                    <thead class="">
                                        <tr>
                                            <th>#</th>
                                            <th>NOMBRE</th>
                                            <th>EMPRESA</th>
                                            <th>FECHA</th>
                                            <th>ESTADO</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>1</th>
                                            <th>Petronilo Bonifacio Martines</th>
                                            <td>CBN</td>
                                            <td>14/06/2020</td>
                                            <td>Activo</td>
                                            <td>
                                                <center>
                                                    <b class='tool'>
                                                        <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='notaBtnId' data-notaBtnId='" . $person->idperfiles . "'>description</i></b></button>
                                                        <span class='tooltip-css3'>NOTA</span>
                                                    </b>
                                                    <b class='tool'>
                                                        <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='btnComentario' data-btnComentario='" . $person->idperfiles . "'>photo_library</i></b></button>
                                                        <span class='tooltip-css3'>Galeria</span>
                                                    </b>
                                                    <b class='tool'>
                                                        <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='editBtnId' data-editBtnId='" . $person->idperfiles . "'>build</i></b></button>
                                                        <span class='tooltip-css3'>EDITAR</span>
                                                    </b>
                                                </center>
                                            </td>
                                        </tr>
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
<!-- end section -->
<!-- Modal -->
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
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Nombre empresa" id="" name="">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">bookmark</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Nombre emprendedor" id="" name="">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">bookmark</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Lema" id="" name="">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">add_a_photo</i>
                                    Perfil
                                </span>
                                <div class="form-line">
                                    <input type="file" class="form-control date" name="url_foto" id="url_foto">
                                    <input type="hidden" id="url_hidden" name="url_hidden">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">add_a_photo</i>
                                    Banner
                                </span>
                                <div class="form-line">
                                    <input type="file" class="form-control date" name="banner" id="banner">
                                    <input type="hidden" id="ban_hidden" name="ban_hidden">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line" id="bs_datepicker_container">
                                    <input type="date" class="form-control date" placeholder="Fecha" name="fecha_crea" id="fecha_crea">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">insert_emoticon</i>
                                </span>
                                <div>
                                    <select id="estado" name="estado" data-live-search="true">
                                        <option value="">*Seleccione Estado*</option>
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="updateId" name="updateId">
                    <input type="hidden" name="action" id="action" value="create">
            </div>
            <div class="modal-footer">
                <button class="btn bg-<?php echo $tema; ?> waves-effect" type="submit" name="submit" id="submit"><b id="nombreb"></b>
                </button>
                </form>
                <button class="btn btn-link waves-effect" data-dismiss="modal" type="button">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- end Modal -->
<!-- Modal nota -->
<div class="modal fade" id="nota_modal" data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="nota-title"></h4>
            </div>
            <div class="modal-body"> 
                <div id="carga-nota"></div>
                <form  id="nota-form">
                    <div class="modal-body users-cont">
                        <div class="row clearfix">
                            <div class="body">
                                <textarea name="nota" id="nota"></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="updateIdNota" name="updateIdNota">
                    <input type="hidden"  name="actionNota" id="actionNota">
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
<!-- end modal -->


<script src="<?php echo base_url(); ?>assets/select2/js/select2.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/emprendedores.js"></script>