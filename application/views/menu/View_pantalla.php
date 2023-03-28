<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Pantallas registradas
                                <small>Aqui se encuentran todas las pantallas registradas</small>
                            </h2>
                            <ul class="header-dropdown m-r--5" >
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
                       <div class="">
                          <div class="body table-responsive">
                            <table id="tbl_pantalla" class="table table-bordered table-hover">
                                  <thead>
                                    <tr>
                                      <th class="">#</th>
                                      <th class="">URL</th>
                                      <th class="">NOMBRE</th>
                                      <th class=""><center>ACCIONES</center></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<div class="modal fade in" id="modal-pantalla" role="dialog" tabindex="-1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="titulo_modal">
                                </h4>
                            </div>
                            <div class="modal-body">
                              <div id="carga"></div>
                              <form id="form-pantalla">
                                <div class="form-group form-float">
                                    <div class="form-line ">
                                        <input type="text" class="form-control" id="nombre_permiso" name="nombre_permiso">
                                        <label class="form-label">NOMBRE</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line ">
                                        <input type="text" class="form-control" id="url_permiso" name="url_permiso">
                                        <label class="form-label">URL</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="updateId" name="updateId">
                                <input type="hidden"  name="action" id="action" value="create">
                                <button class="btn waves-effect bg-<?php echo $tema; ?>" type="submit" id="boton">
                                </button>
                              </form>
                                <button class="btn btn-link waves-effect" data-dismiss="modal" type="button">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/js_pantalla.js"></script>

