<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Bitacora de acciones
                                <small>Aqui se encuentran todas las acciones y procesos realizados dentro del sistema</small>
                            </h2>
                        </div>
                        <br>

                        <p><div class="col-md-2 " >
                            
                               <select name="cantidad" id="cantidad" class="form-control show-tick">
                                <option value="20">Mostrar por:</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="60">60</option>
                                <option value="70">70</option>
                                <option value="80">80</option>
                                <option value="90">90</option>
                                <option value="100">100</option>
                            </select> 

                            
                    </div></p>
                        <p>
                         <div class="col-md-8">
                        
                           <div class="input-group">
                                        <div class="form-line">
                                             <input class="btn-block form-control" placeholder="Buscar" type="text" id="busqueda" name="busqueda">
                                        </div>
                                    </div>  
                    </div>   
                        </p>
                    
<div class="container-fluid">
    <div class="col-xs-12">
         <div class="body table-responsive">
                           <table id="tbacciones" class="table table-striped table-bordered">
                            <thead class="">
                                <tr>
                                    <th class="">
                                        CORRELATIVO
                                    </th>
                                    <th>
                                        FECHA Y HORA
                                    </th>
                                    <th class="">
                                        IP
                                    </th>
                                    <th class="">
                                        ACCION
                                    </th>
                                    <th class="">
                                        TABLA
                                    </th>
                                    <th class="">
                                        USUARIO
                                    </th>
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





<script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/bitacora_acciones.js"></script>
