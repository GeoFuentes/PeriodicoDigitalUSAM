<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Redes
                            <small>Aqui podras editar toda la información de las redes</small>
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
                                <table id="tb-redes" class="table table-bordered table-striped table-condensed">
                                    <thead class="">
                                        <tr>
                                            <th>CORRELATIVO</th>
                                            <th>RED SOCIAL</th>
                                            <th>URL</th>
                                            <th width="200">ICONO</th>
                                            <th>ENTIDAD</th>
                                            <th>ESTADO</th>
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
                                    <i class="material-icons">bookmark</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Red Social" id="red_social" name="red_social">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">public</i>
                                </span>
                                <div class="form-line">
                                <input type="text" class="form-control date" placeholder="URL" name="url" id="url">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">insert_emoticon</i>
                                </span>
                                <div>
                                    <select id="icono" name="icono" data-live-search="true">
                                    <option value="" selected="selected">*Seleccione Icono*</option>
                                        <option value="fa fa-facebook" data-icon="fa fa-facebook">Facebook</option>
                                        <option value="fa fa-twitter" data-icon="fa fa-twitter">Twitter</option>
                                        <option value="fa fa-instagram"data-icon="fa fa-instagram">Instagram</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">bookmark</i>
                                </span>
                                <div class="form-line">
                                <input type="text" class="form-control date" placeholder="Entidad" name="entidad" id="entidad">
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
                        <div class="modal-footer">
                            <input type="hidden" id="updateId" name="updateId">
                            <input type="hidden" name="action" id="action" value="create">
                            <button class="btn bg-<?php echo $tema; ?> waves-effect" type="submit" name="submit" id="submit"><b id="nombreb"></b></button>
                            <button class="btn btn-link waves-effect" data-dismiss="modal" type="button">Cancelar</button>
                        </div>
                        </form>
                        </div>
                    </div>
            </div>
            
        </div>

        <script src="<?php echo base_url(); ?>assets/select2/js/select2.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/redes.js"></script>